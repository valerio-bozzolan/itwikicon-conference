<?php
# itWikiCon website - conference management system based on LinuxDayTorino's website
# Copyright (C) 2016, 2017, 2018, 2019, 2020, 2022 Valerio Bozzolan, Ludovico Pavesi, contributors
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

// print the website header
template_2022( 'header', [
	'conference' => $conference,
] );
?>

	<div class="row valign-wrapperr" id="what-is-it">
		<div class="col s12 l8">
			<div id="leading-banner" class="center-align hoverable"><img class="responsive-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9c/ItWikiCon_Verbania_2022_candidacy_logo.svg/640px-ItWikiCon_Verbania_2022_candidacy_logo.svg.png" alt="" /></div>
		</div>
		<div class="col s12 l4">
			<div class="card-panel hoverable" id="what-is-it-section">
				<h2><?= __( "Cos'è" ) ?></h2>
				<p class="flow-text"><?= sprintf(
					__( "L'%s è %s." ),
					'<b>' . esc_html( $conference->getConferenceTitle() ) . '</b>',
					esc_html( $conference->getConferenceSubtitle() )
				) ?></p>

				<p class="flow-text"><?= esc_html( __( "Quest'anno l'evento si terrà per la prima volta completamente online!" ) ) ?></p>
				<p><a href="#program" class="btn-large waves-effect blue smooth-scroll"><i class="material-icons left">access_time</i> <?= __( "Programma Completo" ) ?></a></p>
			</div>
		</div>
	</div>

  <div class="container" id="program">
    <div class="section">

      <div class="row">

        <div class="col s12" id="program-day-1">
          <h3><i class="mdi-content-send brown-text"></i></h3>
          <h2 class="center-align"><?= HTML::a(
		'https://meta.wikimedia.org/wiki/ItWikiCon/2022/Programma',
		__( "Programma completo" )
	)  ?></h2>

	<?php
		// print the first day table
		template_2022( 'day-one' );
	?>

	<div class="divider"></div>

	<?php
		// print the second day table
		template_2022( 'day-two' );
	?>

        </div>
      </div>

    </div>
  </div>

<?php

// print the website footer
template_2022( 'footer', [
	'conference' => $conference,
] );
