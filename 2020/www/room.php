<?php
# itWikiCon website - conference management system based on LinuxDayTorino's website
# Copyright (C) 2016, 2017, 2018, 2019, 2020 Valerio Bozzolan, Ludovico Pavesi
# From Linux Day Torino 2016
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

// load all the stuff
require 'load.php';

// load this conference
$conference = ( new QueryConference() )
	->whereConferenceUID( THIS_CONFERENCE_UID )
	->queryRow();

// no conference no party
if( !$conference ) {
	error_die( sprintf(
		"missing conference %s",
		THIS_CONFERENCE_UID
	) );
}

// room UID
$room_uid = $_SERVER['PATH_INFO'] ?? null;
if( !$room_uid ) {
	error_die( "missing room UID" );
}

// remove unuseful slashes
$room_uid = trim( $room_uid, _ );

// Room
$room = ( new QueryRoom() )
	->whereRoomUID( $room_uid )
	->queryRow();

// no Room no party
if( !$room ) {
	error_die( "missing room $room_uid" );
}

// check if this is the correct permalink
if( site_page( $_SERVER['REQUEST_URI'], true ) !== $room->getRoomURL( true ) ) {
	http_redirect( $room->getRoomURL( true ) );
}

// another eve
$events =
	( new QueryEvent() )
		->select( Event     ::fields() )
		->select( Conference::fields() )
		->select( Track     ::fields() )
		->select( Chapter   ::fields() )
		->select( Room      ::fields() )
		->selectEventHasVideo()
		->joinConference()
		->joinTrackChapterRoom()
		->whereRoom( $room )
		->orderBy( 'event_start' )
		->queryGenerator();

// print the website header
template_2020( 'header', [
	'conference' => $conference,
] );
?>

<div class="container">
	<h1><?= esc_html( $room->getRoomName() ) ?> &ndash; <?= esc_html( $conference->getConferenceAcronym() ) ?></h1>
	<?php template_2020( 'alert' ) ?>
</div>
<div class="row">
	<div class="col s12 l7">

		<?php if( $room->getRoomPlayerURL() ): ?>
		<div class="card-panel">
			<div class="video-container">
				<iframe src="<?= esc_attr( $room->getRoomPlayerURL() ) ?>" width="1920" height="1080" frameborder="0" scrolling="no" marginwidth="0" allow="autoplay; fullscreen;" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
			</div>
			<?php if( $room->getRoomMeetingURL() ): ?>
			<p><?= __( "La chat non è sufficiente? Prendi un paio di auricolari ed entra nella stanza!" ) ?><br />
			   <?= sprintf(
				__( "La partecipazione implica l'accettazione della %s." ),
				HTML::a(
					'https://meta.wikimedia.org/wiki/ItWikiCon/2020/Friendly_space_policy',
					"Friendly Space Policy"
				)
			) ?> <i class="material-icons right">sentiment_very_satisfied</i></p>
			<p><a class="btn blue waves-effect" href="<?= esc_attr( $room->getRoomMeetingURL() ) ?>" target="_blank">
			<i class="material-icons left">headset_mic</i>
			<?= __( "Entra nella Stanza" ) ?>
			</a></p>
			<?php endif ?>

		</div>
		<?php endif ?>

	</div>
	<div class="col s12 l5">
		<div class="card-panel">
			<?php if( $room->getRoomChatURL() ): ?>
			<div class="hide-on-med-and-down">
				<iframe class="embedded-chat" src="<?= esc_attr( $room->getRoomChatURL() ) ?>?layout=embedded" width="100%" height="600"></iframe>
			</div>
			<p><a class="btn waves-effect" href="<?= esc_attr( $room->getRoomChatURL() ) ?>" target="_blank">
					<i class="material-icons left">chat_bubble</i>
					<?= sprintf(
						__( "Apri Chat %s" ),
						$room->getRoomName()
					) ?>
			</a></p>
			<p><?= sprintf(
				__( "Questa è la Chat %1\$s per interagire con questa diretta in %1\$s." ),
				$room->getRoomName()
			) ?></p>
			<p><?= sprintf(
				__( "Nota: questa stanza ospiterà molte altre sessioni oltre alla diretta che vedi! Se vuoi fare una domanda a chi non è ora in diretta, puoi farlo nella chat generica:" ),
				$room->getRoomName()
			) ?><br />
			<?php endif ?>
			<a class="btn waves-effect" href="https://chat.linux.it/channel/itwikicon-bar" target="_blank">
				<i class="material-icons left">chat_bubble</i>
				<?= __( "Apri Chat Generica" ) ?>
			</a></p>
			<small><?= __( "Se vedi un errore in Chat, clicca sul pulsante blu \"Accedi per iniziare a parlare\" e su Registra un nuovo account o accedendo." ) ?></small>
		</div>
	</div>

</div>

<div class="container">
<div class="row">
	<?php $last_d = 0 ?>

	<?php foreach( $events as $event ): ?>

		<!-- print the heading just if the day changes -->
		<?php $event_d = $event->getEventStart( 'd' ) ?>
		<?php if( $event_d != $last_d ): ?>
			<?php $last_d = $event_d ?>

			<div class="col s12">
				<h3><?= sprintf(
					__( "Programma %s del %s" ),
					esc_html( $room->getRoomName() ),
					$event->getEventStart( __( 'd/m/Y' ) )
				) ?></h3>
			</div>
		<?php endif ?>

		<div class="col s12">
			<div class="card-panel">
				<?php template_2020( 'event-brief', [ 'event' => $event ] ) ?>
			</div>
		</div>
	<?php endforeach ?>
</div>

	<div class="row">
		<div class="col s12">
			<p>
				<?= sprintf(
					__( "Scopri le altre attività parallele alla %s" ),
					esc_html( $room->getRoomName() )
				) ?><br />
				<a class="btn waves-effect" href="<?= ROOT ?>/">
				<i class="material-icons left">access_time</i>
				<?= __( "Programma completo" ) ?>
			</a></p>
		</div>
	</div>
</div>

<?php
// print the website header
template_2020( 'footer', [
	'conference' => $conference,
] );
