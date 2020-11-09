<?php
# Linux Day Torino website
# Copyright (C) 2019, 2020 Valerio Bozzolan and contributors
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
		->joinConference()
		->joinTrack( 'LEFT' )
		->joinRoom(  'LEFT' )
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
