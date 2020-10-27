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

/*
 * This file is called after before your unversioned 'load.php' and
 * load some default configurations.
 *
 * You can override most of them from your 'load.php'. Example:
 *
 *    define( 'SOMETHING', 'value' );
 */

// define latest conference (may be different to the one of the current site)
define( 'THIS_CONFERENCE_UID', 'itwikicon-2020' );

// room permalink for this conference
define( 'ROOM_PERMALINK', 'room.php/%2$s' );

// do not put ?l=it in URLs
define( 'NO_LANGUAGE_IN_URLS', true );

// require the upstream generic configuration file shared for all the conferences
require __DIR__ . '/../load.php';

// require some custom 2020 stuff
require __DIR__ . '/include/functions.php';
