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
 * This file is called after your unversioned 'load.php' and
 * load some default configurations.
 *
 * You can override most of them from your 'load.php'. Example:
 *
 *    define( 'SOMETHING', 'value' );
 */

// define latest conference (may be different to the one of the current site)
define_default( 'LATEST_CONFERENCE_UID', 'itwikicon2020' );

// the repository
define_default( 'REPO', 'https://github.com/LinuxDayTorino/LinuxDay-Torino-website' );

// as default everything is indexed by the search engines
define_default( 'NOINDEX', false );

// custom Sessionuser class related to suckless-conference and not suckless-php
define_default( 'SESSIONUSER_CLASS', 'User' );

// define default site name
define_default( 'SITE_NAME', 'itWikiCon' );

// define default short site name
define_default( 'SITE_NAME_SHORT', SITE_NAME );

// define default site description
define_default( 'SITE_DESCRIPTION', __( "La conferenza dei progetti Wikimedia della comunita italofona" ) );

// when 1 every non-standard URL will be redirected to its canonical version
define_default( 'FORCE_PERMALINK', 1 );

// register every language supported in the l10n directory
register_language( 'it_IT', [ 'it' ], 'it_IT.UTF-8', 'it', 'Italiano' );

// register site languages
register_default_language( 'it_IT' );

// eventually allow to call some other things when everything is loaded
// e.g. this is useful to do a kind of if IP !== xxx then redirect after everything is loaded
if( file_exists( 'load-post-secret.php' ) ) {
	require 'load-post-secret.php';
}
