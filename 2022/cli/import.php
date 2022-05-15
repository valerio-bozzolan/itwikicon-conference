#!/usr/bin/php
<?php
# itWikiCon 2020
# Copyright (C) 2020 Valerio Bozzolan
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU Affero General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This script import contents from Meta-wiki
 */

require 'load.php';

// query this Conference
$conference = ( new QueryConference() )
	->whereConferenceUID( THIS_CONFERENCE_UID )
	->queryRow();

// no Conference no party
if( !$conference ) {
	echo "missing conference\n";
	exit;
}

// current Confererence ID
$conference_ID = $conference->getConferenceID();

// room number to Room ID
$ROOMS = [
	'1' => 36,
	'2' => 37,
	'1 e 2' => 36,
	'caccia al tesoro' => 38,
	'ospiti' => 39,
];

// template arguments
TemplateArg::add( 'titolo' );
TemplateArg::add( 'abstract' );
TemplateArg::add( 'descrizione' );
TemplateArg::add( 'note' );
TemplateArg::add( 'chi' );
TemplateArg::add( 'giorno' );
TemplateArg::add( 'ora inizio' );
TemplateArg::add( 'ora fine' );
TemplateArg::add( 'moderatori' );
TemplateArg::add( 'traccia', function ( $track ) use ( $ROOMS ) {

	$track = $ROOMS[ $track ] ?? null;
	if( !$track ) {
		error( "bad room $track" );
	}

	return $track;
} );

// wikimedia meta
$meta = \wm\MetaWiki::instance();

// months and related number
$MONTHS = [
	'gennaio'   => '01',
	'febbraio'  => '02',
	'marzo'     => '03',
	'aprile'    => '04',
	'maggio'    => '05',
	'giugno'    => '06',
	'luglio'    => '07',
	'agosto'    => '08',
	'settembre' => '09',
	'ottobre'   => '10',
	'novembre'  => '11',
	'dicembre'  => '12',
];

// API query category members
$queries =
	$meta->createQuery( [
		// generator of category members
		'action'    => 'query',
		'generator' => 'categorymembers',
		'gcmtitle'  => 'Category:ItWikiCon 2020 - Programma',

		// for each page retrieved from the generator ask the revision
		'prop'      => 'revisions',
		'rvslots'   => 'main',
		'rvprop'    => [
			'ids',
			'timestamp',

			// we can ask the content and manually parse it with regexes, or just get the id and call API parse
			// 'content',
		],
	] );

// for each API query request
foreach( $queries as $query ) {

	// for each page found during this request
	foreach( $query->query->pages as $page ) {

		// page ID
		$pageid = $page->pageid;

		// page title
		$page_title = $page->title;

		// Meta-wiki page URL
		$page_url = 'https://meta.wikimedia.org/wiki/' . urlencode( str_replace( ' ', '_', $page_title ) );

		// revisions is an array of just one element
		$revisions = $page->revisions ?? [];
		foreach( $revisions as $revision ) {

			// revision ID
			$revid = $revision->revid;

			// parse the templates
			// https://www.mediawiki.org/w/api.php?action=help&modules=parse
			$parse_request =
				$meta->fetch( [
					'action' => 'parse',
					'oldid'  => $revid,
					'prop'   => 'parsetree',
				] );

			// DOM tree as XML
			$tree = $parse_request->parse->parsetree->{'*'} ?? null;
			if( $tree ) {
				$reader = simplexml_load_string( $tree );

				$template = $reader->template;
				$template_title = trim( $template->title );
				if( $template_title === 'ItWikiCon/2020/Session' ) {

					$template_values = [];

					// template arguments
					foreach( $template->part as $template_part ) {

						// argument title and its value ( | name = value )
						$part_name  = trim( $template_part->name );
						$part_value = trim( $template_part->value );

						// find the template value
						$template_value = TemplateArg::createValue( $part_name, $part_value );
						if( $template_value ) {
							$template_values[] = $template_value;
						}
					}

					// finally extract the template parameters
					// $pageid
					$event_title       = TemplateArgValue::findAndGetValue( $template_values, 'titolo' );
					$event_who         = TemplateArgValue::findAndGetValue( $template_values, 'chi' );
					$event_moderators  = TemplateArgValue::findAndGetValue( $template_values, 'moderatori' );
					$abstract          = TemplateArgValue::findAndGetValue( $template_values, 'abstract' );
					$note              = TemplateArgValue::findAndGetValue( $template_values, 'note' );
					$giorno            = TemplateArgValue::findAndGetValue( $template_values, 'giorno' );
					$ora_inizio        = TemplateArgValue::findAndGetValue( $template_values, 'ora inizio' );
					$ora_fine          = TemplateArgValue::findAndGetValue( $template_values, 'ora fine' );
					$event_description = TemplateArgValue::findAndGetValue( $template_values, 'descrizione' );
					$lingua            = TemplateArgValue::findAndGetValue( $template_values, 'lingua', 'it' );
					$room_ID           = TemplateArgValue::findAndGetValue( $template_values, 'traccia' );

					// parse the wikitext
					$event_description = from_wikitext_to_html( $meta, $event_description );
					$abstract          = from_wikitext_to_html( $meta, $abstract );

					// 24 ottobre
					$giorno_dd_mm = explode( ' ', $giorno );
					if( count( $giorno_dd_mm ) !== 2 ) {
						echo "Skip $giorno\n";
						continue;
					}

					$giorno_dd_mm[1] = $MONTHS[ $giorno_dd_mm[1] ]; // ottobre -> 10
					$event_start = sprintf(
						'%s-%s-%s %s:00',
						date( 'Y' ),
						$giorno_dd_mm[1],
						$giorno_dd_mm[0],
						$ora_inizio
					);
					$event_end = sprintf(
						'%s-%s-%s %s:00',
						date( 'Y' ),
						$giorno_dd_mm[1],
						$giorno_dd_mm[0],
						$ora_fine
					);

					// event UID
					$event_uid = generate_slug( $event_title );

					// option used to remember the Meta pageid -> Event ID
					$option_name_meta_pageid = "event-from-meta-pageid-$pageid";

					// basic data to be always updated
					$basic_data = [
						'event_title'               => $event_title,
						'event_url'                 => $page_url,
						'event_uid'                 => $event_uid,
						"event_description_$lingua" => $event_description,
						"event_abstract_$lingua"    => $abstract,
						"event_note_$lingua"        => $note,
						'event_language'            => $lingua,
						'event_start'               => $event_start,
						'event_end'                 => $event_end,
						'room_ID'                   => $room_ID,
					];

					// start a MariaDB transaction
					query( 'START TRANSACTION' );

					// check if this page is new
					$event_ID = get_option( $option_name_meta_pageid );
					if( $event_ID ) {

						// update
						echo "Updating $event_title\n";

						( new QueryEvent() )
							->whereEventID( $event_ID )
							->update( $basic_data );

					} else {

						echo "Inserting $event_title\n";

						query( 'START TRANSACTION' );

						// insert
						( new QueryEvent() )
							->insertRow( array_merge( $basic_data, [
								'conference_ID'             => $conference_ID,
								'event_uid'                 => $event_uid,
							] ) );

						$event_ID = last_inserted_ID();

						set_option( $option_name_meta_pageid, $event_ID, false );

						query( 'COMMIT' );
					}

					// wiki usernames
					$wiki_usernames = [
						'speaker'   => suck_wiki_usernames( $event_who ),
						'moderator' => suck_wiki_usernames( $event_moderators ),
					];

					foreach( $wiki_usernames as $role => $users ) {
						foreach( $users as $wiki_username ) {

							// check if an user associated to this Meta-wiki nick exists
							$user_talk =
								( new QueryUser() )
									->whereMetaUsername( $wiki_username )
									->queryRow();

							if( $user_talk ) {

								$user_talk_ID = $user_talk->getUserID();


							} else {

								// eventually guess the user surname
								$name_parts = explode( ' ', $wiki_username, 2 );
								$user_name    = $name_parts[0] ?? $wiki_username;
								$user_surname = $name_parts[1] ?? '';

								// eventually strip "(ASD)" from surname
								if( $user_surname ) {
									$user_surname_parts = explode( ' (', 2 );
									$user_surname = $user_surname_parts[0] ?? $user_surname;
								}

								// create the User
								( new QueryUser() )
									->insertRow( [
										User::UID       => generate_slug( $wiki_username ),
										User::NAME      => $user_name,
										User::SURNAME   => $user_surname,
										User::META_WIKI => $wiki_username,
										User::IS_PUBLIC => 1,
										User::IS_ACTIVE => 0,
										USER::ROLE      => 'user',
									] );

								echo "Creating $wiki_username\n";
								$user_talk_ID = last_inserted_ID();
							}

							// check if that User is related to this Event
							$user_talk_relation =
							( new Query() )
								->from( 'event_user' )
								->whereInt( User::ID,  $user_talk_ID )
								->whereInt( Event::ID, $event_ID     )
								->queryRow();

							// relate the User to this Event
							if( !$user_talk_relation ) {
								echo "Connecting $role to event...\n";
								insert_row( EventUser::T, [
									User::ID  => $user_talk_ID,
									Event::ID => $event_ID,
									EventUser::ROLE => $role,
								] );
							}
						}
					}

					// commit the MariaDB transaction
					query( 'COMMIT' );
				}
			}
		}
	}
}

/**
 * A very dummy function to suck some usernames from the wikitext
 */
function suck_wiki_usernames( $wikitext ) {

	$users = [];

	// strange cases:
	//  [[:it:s:Utente:|OrbiliusMagister]] damn ORBILIUS! asd
	$founds = preg_match_all( '/\[\[:?User:(.+?)([\|\]])/i', $wikitext, $matches );
	for( $i = 0; $i < $founds; $i++ ) {
		$user = trim( $matches[1][$i] );
		$user = str_replace( '_', ' ', $user );

		// AAAAAAAAAAAASD DAMN MARCO CHEMELLO
		if( $user === 'Marco Chemello (WMIT)' ) {
			$user = 'Marcok';
		}

		$users[] = $user;
	}

	array_unique( $users );

	return $users;
}

function from_wikitext_to_html( $wiki, $wikitext ) {

	// no wikitext no party
	if( !$wikitext ) {
		return $wikitext;
	}

	$request =
		$wiki->fetch( [
			'action' => 'parse',
			'contentmodel' => 'wikitext',
			'text'   => $wikitext,
			'disablelimitreport' => 1,
		] );

	$html = $request->parse->text->{'*'} ?? '';

	$html = str_replace( 'href="/wiki/', 'https://meta.wikimedia.org/wiki/', $html );

	return $html;
}

class TemplateArg {

	private $name;

	private $callback;

	public static $args = [];

	public function __construct( $name, $callback ) {
		$this->name = $name;
		$this->callback = $callback;
	}

	public function getName() {
		return $this->name;
	}

	public function normalizeValue( $value ) {
		if( $this->callback ) {
			$value = call_user_func( $this->callback, $value );
		}
		return $value;
	}

	/**
	 * Add a template argument in the known list of arguments
	 */
	public static function add( $name, $callback = null ) {
		self::$args[] = new TemplateArg( $name, $callback );
	}

	public static function createValue( $name, $value ) {

		$arg = self::find( $name );
		if( $arg ) {
			return new TemplateArgValue( $arg, $value );
		}

		return false;
	}

	public static function find( $name ) {

		foreach( self::$args as $arg ) {
			if( $arg->getName() === $name ) {
				return $arg;
			}
		}

		return false;
	}

}

class TemplateArgValue {

	private $arg;

	private $value;

	public function __construct( TemplateArg $arg, $value ) {
		$this->arg = $arg;
		$this->value = $value;
	}

	public function getValue( $default_value = null ) {
		$value = $this->value;
		$value = $this->arg->normalizeValue( $value );
		if( !$value ) {
			$value = $default_value;
		}
		return $value;
	}

	public function getArg() {
		return $this->arg;
	}

	public function getName() {
		return $this->getArg()->getName();
	}

	public static function find( $all, $name ) {
		foreach( $all as $one ) {
			if( $one->getName() === $name ) {
				return $one;
			}
		}
		return false;
	}

	public static function findAndGetValue( $all, $name, $default_value = null ) {

		$value = $default_value;

		$one = self::find( $all, $name );
		if( $one ) {
			$value = $one->getValue( $default_value );
		}

		return $value;
	}
}
