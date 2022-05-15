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

// print the website header
template_2020( 'header', [
	'conference' => $conference,
] );
?>

	<div class="row valign-wrapperr" id="what-is-it">
		<div class="col s12 l8">
			<div id="leading-banner" class="center-align hoverable"><img class="responsive-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/ItWikiCon2020_Dante.svg/1024px-ItWikiCon2020_Dante.svg.png" alt="itWikiCon 2020 community whishlist"></div>
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

  <!-- survey parallax -->
  <div class="parallax-container valign-wrapper">
    <div class="parallax"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/ItWikiCon_2020_community_survey_results.jpg/1280px-ItWikiCon_2020_community_survey_results.jpg" alt="itWikiCon community survey post-it"></div>
  </div>
  <!-- end survey parallax -->

  <div class="container" id="program">
    <div class="section">

      <div class="row">

	<div class="col s12">
		<div class="card-panel orange">
			<p class="flow-text"><?= __( "Stanco dei soliti questionari compilabili in meno di un'ora e 45 minuti? Prova il nostro!" ) ?></p>
			<p><a href="https://meta.wikimedia.org/wiki/ItWikiCon/2020/Sondaggio/2" class="btn-large blue waves-effect">
				<i class="material-icons left">insert_chart</i>
				Questionario finale!
			</a>
			</p>
		</div>
	</div>

        <div class="col s12" id="program-day-1">
          <h3><i class="mdi-content-send brown-text"></i></h3>
          <h2 class="center-align"><?= __( "Programma completo" ) ?></h2>

	<p class="flow-text"><?= __( "Sessioni 24 ottobre" ) ?></p>

	<?php
		// print the first day table
		template_2020( 'day-one' );
	?>

	<div class="divider"></div>

	<p class="flow-text"><?= __( "Eventi speciali 24 ottobre" ) ?></p>

	<div class="card-panel">
		<?php event_2020( 242 ) /* caccia al tesoro */ ?>
	</div>

	<div class="divider" id="program-day-2"></div>

	<p class="flow-text"><?= __( "Sessioni 25 ottobre" ) ?></p>

	<?php
		// print the second day table
		template_2020( 'day-two' );
	?>

        </div>
      </div>

    </div>
  </div>

	<div class="container">
		<div class="card-panel">
			<p class="flow-text"><?= __( "Vuoi una pausa? Gira fra i poster e incontra gli autori!") ?></p>	
			<a class="btn blue waves-effect" href="https://meta.wikimedia.org/wiki/ItWikiCon/2020/Poster">
				<i class="material-icons left">free_breakfast</i>
				<?= __( "Corridoio poster" ) ?>
			</a>
		</div>
		<div class="card-panel">
			<p><?= sprintf(
				__( "Ma non è finita! Ti piacciono il <b>software libero</b> e le <b>libertà digitali</b>? Scopri le sessioni parallele sul sito del Linux Day 2020!" )
			) ?><br />
			<a href="https://www.linuxday.it/2020/programma/"><?= __( "Programma Linux Day 2020" ) ?></a></p>
		</div>
	</div>

<?php

// print the website footer
template_2020( 'footer', [
	'conference' => $conference,
] );
