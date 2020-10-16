<?php
# itWikiCon 2020
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

template_2020( 'header', [
	'conference' => $conference,
] );

$events = ( new QueryEvent() )
	->whereConference( $conference )
	->orderBy( Event::START )
	->orderBy( Event::END )
	->queryGenerator();
	?>

		<?php foreach( $events as $event ): ?>

			<pre><?= esc_html( sprintf(
				'<?php event_2020( %d ) /* %s */ ?>',
				$event->getEventID(),
				$event->getEventTitle()
			) ) ?></pre>

		<?php endforeach ?>

<?php

template_2020( 'footer', [
	'conference' => $conference,
] );
