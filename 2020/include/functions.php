<?php
# Linux Day Torino website
# Copyright (C) 2019, 2020, 2021 Valerio Bozzolan and contributors
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU Affero General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
# GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with this program. If not, see <http://www.gnu.org/licenses/>.

/**
 * Require a certain page from the template directory
 *
 * @param $name string page name (to be sanitized)
 * @param $args mixed arguments to be passed to the page scope
 */
function template_2020( $template_name, $template_args = [] ) {
	extract( $template_args, EXTR_SKIP );
	return require ABSPATH . "/2020/template/$template_name.php";
}

/**
 * Spawn a 2020 Event
 *
 * @param int $id Event ID
 */
function event_2020( $id ) {

	$event = ( new QueryEvent() )
		->whereEventID( $id )
		->select( Conference::fields() )
		->select( Event::fields() )
		->select( Room::fields() )
		->select( Track::fields() )
		->select( Room::fields() )
		->select( Chapter::fields() )
		->selectEventHasVideo()
		->selectEventHasDocument()
		->joinConference()
		->joinTrack(   'LEFT' )
		->joinRoom(    'LEFT' )
		->joinChapter( 'LEFT' )
		->queryRow();

	template_2020( 'event-brief', [
		'event' => $event,
	] );
}

/**
 * Print an icon for the 2020 website
 *
 * See https://materializecss.com/icons.html
 *
 * @param string $name Icon name
 * @param string $classes CSS classes
 * @return string
 */
function icon_2020( $name, $classes = null ) {
	$classes = $classes ? " $classes" : '';
	return sprintf(
		'<i class="material-icons%s">%s</i>',
		$classes,
		$name
	);
}

/**
 * Query some Event Users
 *
 * @param  Event  $event
 * @param  string $role Choose 'speaker' or 'moderator'
 * @return Generator
 */
function event_users_2020( $event, $role ) {

	$users =
	        ( new QueryEventUser() )
			->joinUser()
			->whereEvent( $event )
			->whereEventUserRole( $role )
			->orderByEventUserOrder()
			->queryGenerator();

	return $users;
}

/**
 * Link to an User of the itWikiCon 2020
 *
 * @param User $user
 * @return string HTML firm
 */
function user_link_2020( $user ) {

	$name = esc_html( $user->getUserDisplayName() );

	// print the Meta-wiki permalink
	if( $user->has( User::META_WIKI ) ) {
		$name = HTML::a( $user->getUserMetaWikiURL(), $name );
	}

	return $name;
}

/**
 * Print the URL to a Sharable
 *
 * @param  Event    $event
 * @param  Sharable $sharable
 * @param  string   $text
 * @return string HTML
 */
function sharable_edit( $event, $sharable = null, $text = null ) {

	$s = '';

	// no editable, no party
	if( $event->isEventEditable() ) {

		// displayed text
		if( !$text ) {
			$text = $sharable ? __( "modifica" ) : __( "aggiungi" );
		}

		// edit or creation URL
		$url = $sharable
			? $sharable->getSharableEditURL()
			: Sharable::editURL( [
				'event_ID' => $event->getEventID(),
			] );

		// create link
		$s = HTML::a( $url, esc_html( $text ) );
	}

	// [edit]
	if( $s ) {
		$s = "[$s]";
	}

	return $s;
}
