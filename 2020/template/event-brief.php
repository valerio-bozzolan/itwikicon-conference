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

?>

	<div class="event-track-<?= $event->getTrackUID() ?> event-id-<?= $event->getEventID() ?>">

		<?php if( $event->hasEventLanguage() && $event->getEventLanguage() !== 'it' ): ?>
			<b><?= esc_html( $event->getEventLanguage() ) ?></b>
		<?php endif ?>

		<a href="<?= esc_attr( $event->getEventURL() ) ?>" class="flow-text"><?= esc_html( $event->getEventTitle() ) ?></a>

		<div>
			<?= $event->getEventStart( 'H:i' ) ?>&ndash;<?= $event->getEventEnd( 'H:i' ) ?>
		</div>
		<div>
			<em><?= esc_html( $event->getRoomName() ) ?></em>
		</div>

		<?php if( $event->isEventEditable() ): ?>
			<?= HTML::a(
				$event->getEventEditURL(),
				'[edit]'
			) ?>
		<?php endif ?>
	</div>
