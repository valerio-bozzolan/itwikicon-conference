<?php
# itWikiCon website - conference management system based on LinuxDayTorino's website
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
 * Template used to display a single event briefly
 *
 * Variables that should be available:
 *
 *  $event Event: current Event
 *     Note that the Event should have these additional attributes:
 *        event_has_video
 *        event_has_document
 */

// query all the Users maintaining this Event
$users =
	( new QueryEventUser() )
		->joinUser()
		->whereEvent( $event )
		->whereEventUserIsSpeaker()
		->orderByEventUserOrder()
		->queryGenerator();
?>

	<div class="event-track-<?= $event->getTrackUID() ?> event-id-<?= $event->getEventID() ?>">

		<?php if( $event->hasEventLanguage() && $event->getEventLanguage() !== 'it' ): ?>
			<b><?= esc_html( $event->getEventLanguage() ) ?></b>
		<?php endif ?>

		<p class="flow-text event-brief-title">
		<?php if( $event->isEventAborted() ): ?>
			<s><a href="<?= esc_attr( $event->getEventStandardURL() ) ?>"><?= esc_html( $event->getEventTitle() ) ?></a></s>
			<em><?= __( "sessione annullata" ) ?></em>
		<?php else: ?>
			<a href="<?= esc_attr( $event->getEventStandardURL() ) ?>"><?= esc_html( $event->getEventTitle() ) ?></a>

		<?php endif ?>
		</p>

		<div class="event-hour">
			<?= $event->getEventStart( 'H:i' ) ?>&ndash;<?= $event->getEventEnd( 'H:i' ) ?>
		</div>

		<div class="itwikicon-users">
			<?php foreach( $users as $user ): ?>

				<div class="itwikicon-user">
				<?php

					// check if the User has an account in Wikimedia Meta-wiki
					if( $user->has( User::META_WIKI ) ) {

						// print the Meta-wiki permalink
						echo HTML::a(
							$user->getUserMetaWikiURL(),
							esc_html( $user->getUserDisplayName() )
						);


					} else {

						echo esc_html( $user->getUserDisplayName() );

					}

				?>
				</div>

			<?php endforeach ?>
		</div>

		<!-- print the view button only if the event is not aborted nor passed -->
		<?php if( !$event->isEventAborted() && !$event->isEventPassed() ): ?>

			<div class="event-room">
				<p class="right-align"><?= HTML::a(
					$event->getRoomURL(),
					$event->getRoomName().
					'<i class="material-icons right">play_arrow</i>',
					null,
					'btn white blue-text waves-effect'
				) ?>
				</p>
			</div>

		<?php endif ?>
		<!-- end print the view button only if the event is not aborted nor passed -->

		<!-- start event player -->
		<?php if( $event->get( 'event_has_video' ) ): ?>
			<p>
				<a class="btn blue waves-effect" href="<?= esc_attr( $event->getEventURL() ) ?>">
					<?= icon_2020( 'play_arrow', 'left' ) ?>
					<?= __( "Rivedi" ) ?>
				</a>
			</p>
		<?php endif ?>
		<!-- end event player -->

		<!-- start event documents -->
		<?php if( $event->get( 'event_has_document' ) ): ?>
			<p>
				<a class="btn blue waves-effect" href="<?= esc_attr( $event->getEventURL() ) ?>">
					<?= icon_2020( 'attachment', 'left' ) ?>
					<?= __( "Materiali" ) ?>
				</a>
			</p>
		<?php endif ?>
		<!-- end event documents -->

		<?php if( $event->isEventEditable() ): ?>
			<?= HTML::a(
				$event->getEventEditURL(),
				'[edit]'
			) ?>
		<?php endif ?>

	</div>
