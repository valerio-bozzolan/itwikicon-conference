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
				<p class="flow-text"><?= esc_html( __( "Quest'anno l'evento si terrà completamente online!" ) ) ?></p>
				<p><a href="#program" class="btn-large waves-effect blue"><i class="material-icons left">access_time</i> <?= __( "Programma Completo" ) ?></a></p>
			</div>
		</div>
	</div>

  <!-- survey parallax -->
  <div class="parallax-container valign-wrapper">
    <div class="parallax"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/ItWikiCon_2020_community_survey_results.jpg/1280px-ItWikiCon_2020_community_survey_results.jpg" alt="Unsplashed background img 2"></div>
  </div>
  <!-- end survey parallax -->

  <div class="container" id="program">
    <div class="section">

      <div class="row">
        <div class="col s12 center" id="program-day-1">
          <h3><i class="mdi-content-send brown-text"></i></h3>
          <h2><?= __( "Programma Completo" ) ?></h2>

	<p class="flow-text"><?= __( "Sessioni 24 ottobre" ) ?></p>

<table class="highlight">
<tbody>
<tr>
<th class="hide-on-small-only"></th>
<th><?= __( "Stanza 1" ) ?></th>
<th><?= __( "Stanza 2" ) ?></th>
</tr>
<tr>
<td class="hide-on-small-only">10:00&nbsp;-&nbsp;10:15</td>
<td colspan="2" rowspan="2" style="background-color:#0c7bc0ff;color:white;text-align:center"><b>Plenaria di apertura</b></td>
</tr>
<tr>
<td class="hide-on-small-only">10:15&nbsp;-&nbsp;10:30</td>
</tr>
<tr>
<td class="hide-on-small-only">10:30&nbsp;-&nbsp;10:45</td>
<td rowspan="3"><?php event_2020( 269 ) /* Wikimedia 2030: cosa cambierà e come partecipare */ ?></td>
<td rowspan="3"><?php event_2020( 251 ) /* Introduzione a Wikidata */ ?></td>
</tr>
<tr>
<td class="hide-on-small-only">10:45&nbsp;-&nbsp;11:00</td>
</tr>
<tr>
<td class="hide-on-small-only">11:00&nbsp;-&nbsp;11:15</td>
</tr>
<tr>
<td class="hide-on-small-only">11:15&nbsp;-&nbsp;11:30</td>
<td colspan="2" style="background-color:#d9d2e9;text-align:center">Pausa</td>
</tr>
<tr>
<td class="hide-on-small-only">11:30&nbsp;-&nbsp;11:45</td>
<td rowspan="2"><?php event_2020( 263 ) /* progetti fratelli */ ?></td>
<td rowspan="2"><?php event_2020( 268 ) /* Wikidata per WLM */ ?></td>
</tr>
<tr>
<td class="hide-on-small-only">11:45&nbsp;-&nbsp;12:00</td>
</tr>
<tr>
<td class="hide-on-small-only">12:00&nbsp;-&nbsp;12:15</td>
<td colspan="2" style="background-color:#d9d2e9;text-align:center;">Pausa</td>
</tr>
<tr>
<td class="hide-on-small-only">12:15&nbsp;-&nbsp;12:30</td>
<td rowspan="4"><?php event_2020( 263 ) /* progetti fratelli */ ?></td>
<td rowspan="4"><?php event_2020( 244 ) /* Come i piccoli musei possono collaborare con i progetti Wikimedia */ ?></td>
</tr>
<tr>
<td class="hide-on-small-only">12:30&nbsp;-&nbsp;12:45</td>
</tr>
<tr>
<td class="hide-on-small-only">12:45&nbsp;-&nbsp;13:00</td>
</tr>
<tr>
<td class="hide-on-small-only">13:00&nbsp;-&nbsp;13:15</td>
</tr>
<tr>
<td class="hide-on-small-only">13:15&nbsp;-&nbsp;13:30</td>
<td colspan="2" rowspan="4" style="background-color:#d9d2e9;text-align:center"><b>Pranzo</b></td>
</tr>
<tr>
<td class="hide-on-small-only">13:30&nbsp;-&nbsp;13:45</td>
</tr>
<tr>
<td class="hide-on-small-only">13:45&nbsp;-&nbsp;14:00</td>
</tr>
<tr>
<td class="hide-on-small-only">14:00&nbsp;-&nbsp;14:15</td>
</tr>
<tr>
<td class="hide-on-small-only">14:15&nbsp;-&nbsp;14:30</td>
<td rowspan="2"><?php event_2020( 243 ) /* Certificare le conoscenze Wikimedia: un framework */ ?></td>
<td rowspan="2"><?php event_2020( 259 ) /* milleuno domande che non vi siete mai fatti ma di cui vi daremo la risposta con SPARQL */ ?></td>
</tr>
<tr>
<td class="hide-on-small-only">14:30&nbsp;-&nbsp;14:45</td>
</tr>
<tr>
<td class="hide-on-small-only">14:45&nbsp;-&nbsp;15:00</td>
<td colspan="2" style="background-color:#d9d2e9;text-align:center">Pausa</td>
</tr>
<tr>
<td class="hide-on-small-only">15:00&nbsp;-&nbsp;15:15</td>
<td colspan="2" rowspan="4" style="background-color:#faf6d7;text-align:center"><?php event_2020( 241 ) /* Alessandro Barbero */ ?></td>
</tr>
<tr>
<td class="hide-on-small-only">15:15&nbsp;-&nbsp;15:30</td>
</tr>
<tr>
<td class="hide-on-small-only">15:30&nbsp;-&nbsp;15:45</td>
</tr>
<tr>
<td class="hide-on-small-only">15:45&nbsp;-&nbsp;16:00</td>
</tr>
<tr>
<td class="hide-on-small-only">16:00&nbsp;-&nbsp;16:15</td>
<td colspan="2" style="background-color:#d9d2e9;text-align:center">Pausa</td>
</tr>
<tr>
<td class="hide-on-small-only">16:15&nbsp;-&nbsp;16:30</td>
<td rowspan="2"><?php event_2020( 260 ) /* Openedu */ ?></td>
<td rowspan="2"><?php event_2020( 250 ) /* Introduzione a OpenStreetMap */ ?></td>
</tr>
<tr>
<td class="hide-on-small-only">16:30&nbsp;-&nbsp;16:45</td>
</tr>
<tr>
<td class="hide-on-small-only">16:45&nbsp;-&nbsp;17:00</td>
<td colspan="2" style="background-color:#d9d2e9;text-align:center">Pausa</td>
</tr>
<tr>
<td class="hide-on-small-only">17:00&nbsp;-&nbsp;17:15</td>
<td rowspan="4"><?php event_2020( 265 ) /* Vikidia */ ?></td>
<td rowspan="4"><?php event_2020( 258 ) /* Mappare il passato: Open History Map */ ?></td>
</tr>
<tr>
<td class="hide-on-small-only">17:15&nbsp;-&nbsp;17:30</td>
</tr>
<tr>
<td class="hide-on-small-only">17:30&nbsp;-&nbsp;17:45</td>
</tr>
<tr>
<td class="hide-on-small-only">17:45&nbsp;-&nbsp;18:00</td>
</tr>
<tr>
<td class="hide-on-small-only">18:00&nbsp;-&nbsp;18:15</td>
<td colspan="2" style="background-color:#d9d2e9;text-align:center">Pausa</td>
</tr>
<tr>
<td class="hide-on-small-only">18:15&nbsp;-&nbsp;18:30</td>
<td rowspan="3" style="background-color:#faf6d7;"><?php event_2020( 257 ) /* Lydia Pintscher: What's new on the Wikidata features this year? */ ?></td>
<td rowspan="3"><?php event_2020( 246 ) /* Edutainment ai tempi del Covid-19 - Wikipedia & OpenStreetMap al servizio del mondo ludico */ ?></td>
</tr>
<tr>
<td class="hide-on-small-only">18:30&nbsp;-&nbsp;18:45</td>
</tr>
<tr>
<td class="hide-on-small-only">18:45&nbsp;-&nbsp;19:00</td>
</tr>
<tr>
<td class="hide-on-small-only">19:00&nbsp;-&nbsp;19:15</td>
<td colspan="2" rowspan="4" style="background-color:#faf6d7;"><?php event_2020( 254 ) /* Katherine Maher */ ?></td>
</tr>
<tr>
<td class="hide-on-small-only">19:15&nbsp;-&nbsp;19:30</td>
</tr>
<tr>
<td class="hide-on-small-only">19:30&nbsp;-&nbsp;19:45</td>
</tr>
<tr>
<td class="hide-on-small-only">19:45&nbsp;-&nbsp;20:00</td>
</tr>
</tbody>
</table>

	<div class="divider" id="program-day-2"></div>

	<p class="flow-text"><?= __( "Sessioni 24 ottobre" ) ?></p>

<table class="highlight">
<tbody>
<tr>
<th class="hide-on-small-only"></th>
<th><?= __( "Stanza 1" ) ?></th>
<th><?= __( "Stanza 2" ) ?></th>
</tr>
<tr>
<td class="hide-on-small-only">10:00&nbsp;-&nbsp;10:15</td>
<td colspan="2" rowspan="4" style="background-color:#faf6d7;"><?php event_2020( 253 ) /* Jimbo Wales */ ?></td>
</tr>
<tr>
<td class="hide-on-small-only">10:15&nbsp;-&nbsp;10:30</td>
</tr>
<tr>
<td class="hide-on-small-only">10:30&nbsp;-&nbsp;10:45</td>
</tr>
<tr>
<td class="hide-on-small-only">10:45&nbsp;-&nbsp;11:00</td>
</tr>
<tr>
<td class="hide-on-small-only">11:00&nbsp;-&nbsp;11:15</td>
<td colspan="2" style="background-color:#d9d2e9;text-align:center">Pausa</td>
</tr>
<tr>
<td class="hide-on-small-only">11:15&nbsp;-&nbsp;11:30</td>
<td rowspan="3"><?php event_2020( 261 ) /* Perché non posso fotografare la piazza del mio paese? */ ?></td>
<td rowspan="3"><?php event_2020( 248 ) /* Il Daty Pywikibot - Ovvero: come ho imparato a non preoccuparmi e ad amare il web semantico */ ?></td>
</tr>
<tr>
<td class="hide-on-small-only">11:30&nbsp;-&nbsp;11:45</td>
</tr>
<tr>
<td class="hide-on-small-only">11:45&nbsp;-&nbsp;12:00</td>
</tr>
<tr>
<td class="hide-on-small-only">12:00&nbsp;-&nbsp;12:15</td>
<td colspan="2" style="background-color:#d9d2e9;text-align:center">Pausa</td>
</tr>
<tr>
<td class="hide-on-small-only">12:15&nbsp;-&nbsp;12:30</td>
<td rowspan="2"><?php event_2020( 255 ) /* La data visualization sui progetti Wikimedia */ ?></td>
<td rowspan="4"><?php event_2020( 264 ) /* Template e Lua: corso accelerato */ ?></td>
</tr>
<tr>
<td class="hide-on-small-only">12:30&nbsp;-&nbsp;12:45</td>
</tr>
<tr>
<td class="hide-on-small-only">12:45&nbsp;-&nbsp;13:00</td>
<td rowspan="2"><?php event_2020( 266 ) /* Voci semi-protette all'infinito */ ?></td>
</tr>
<tr>
<td class="hide-on-small-only">13:00&nbsp;-&nbsp;13:15</td>
</tr>
<tr>
<td class="hide-on-small-only">13:15&nbsp;-&nbsp;13:30</td>
<td colspan="2" rowspan="4" style="background-color:#d9d2e9;text-align:center"><b>Pranzo</b> in contemporanea con:<br />
	<?php event_2020( 247 ) /* Esplorando Busto Arsizio – tour virtuale interattivo */ ?>
</td>
</tr>
<tr>
<td class="hide-on-small-only">13:30&nbsp;-&nbsp;13:45</td>
</tr>
<tr>
<td class="hide-on-small-only">13:45&nbsp;-&nbsp;14:00</td>
</tr>
<tr>
<td class="hide-on-small-only">14:00&nbsp;-&nbsp;14:15</td>
</tr>
<tr>
<td class="hide-on-small-only">14:15&nbsp;-&nbsp;14:30</td>
<td rowspan="2"><?php event_2020( 256 ) /* La gestione dei conflitti nei progetti Wikimedia, modalità a confronto */ ?></td>
<td rowspan="2"><?php event_2020( 240 ) /* Accessibilità e usabilità dei progetti Wikimedia */ ?></td>
</tr>
<tr>
<td class="hide-on-small-only">14:30&nbsp;-&nbsp;14:45</td>
</tr>
<tr>
<td class="hide-on-small-only">14:45&nbsp;-&nbsp;15:00</td>
<td colspan="2" style="background-color:#d9d2e9;text-align:center">Pausa</td>
</tr>
<tr>
<td class="hide-on-small-only">15:00&nbsp;-&nbsp;15:15</td>
<td rowspan="3"><?php event_2020( 262 ) /* Qual è il nostro nome? Wikipedia, Wikimedia e il rebranding */ ?></td>
<td rowspan="3"><?php event_2020( 267 ) /* WikiBase, partendo da zero */ ?></td>
</tr>
<tr>
<td class="hide-on-small-only">15:15&nbsp;-&nbsp;15:30</td>
</tr>
<tr>
<td class="hide-on-small-only">15:30&nbsp;-&nbsp;15:45</td>
</tr>
<tr>
<td class="hide-on-small-only">15:45&nbsp;-&nbsp;16:00</td>
<td colspan="2" style="background-color:#d9d2e9;text-align:center">Pausa</td>
</tr>
<tr>
<td class="hide-on-small-only">16:00&nbsp;-&nbsp;16:15</td>
<td rowspan="3"><?php event_2020( 272 ) /* Wikisource: gli strumenti per facilitarsi la vita */ ?></td>
<td rowspan="3"><?php event_2020( 252 ) /* itWikicon nei prossimi anni */ ?></td>
</tr>
<tr>
<td class="hide-on-small-only">16:15&nbsp;-&nbsp;16:30</td>
</tr>
<tr>
<td class="hide-on-small-only">16:30&nbsp;-&nbsp;16:45</td>
</tr>
<tr>
<td class="hide-on-small-only">16:45&nbsp;-&nbsp;17:00</td>
<td colspan="2" style="background-color:#d9d2e9;text-align:center">Pausa</td>
</tr>
<tr>
<td class="hide-on-small-only">17:00&nbsp;-&nbsp;17:15</td>
<td><?php event_2020( 270 ) /* Wikinotizie non è triste come pensate */ ?></td>
<td><?php event_2020( 245 ) /* Community Health Metrics: presentazione del progetto */ ?></td>
</tr>
<tr>
<td class="hide-on-small-only">17:15&nbsp;-&nbsp;17:30</td>
<td colspan="2" style="background-color:#d9d2e9;text-align:center">Pausa</td>
</tr>
<tr>
<td class="hide-on-small-only">17:30&nbsp;-&nbsp;17:45</td>
<td rowspan="2"><?php event_2020( 249 ) /* Iniziativa per la Sostenibilità – che c'è di nuovo? */ ?></td>
<td rowspan="2"><?php event_2020( 271 ) /* Wikiproxy: come Wikipedia può sopravvivere alle censure dei governi */ ?></td>
</tr>
<tr>
<td class="hide-on-small-only">17:45&nbsp;-&nbsp;18:00</td>
</tr>
<tr>
<td class="hide-on-small-only">18:00&nbsp;-&nbsp;18:15</td>
<td colspan="2" rowspan="2" style="background-color:#0c7bc0ff;color:white;text-align:center"><b>Saluti finali</b></td>
</tr>
<tr>
<td class="hide-on-small-only">18:15&nbsp;-&nbsp;18:30</td>
</tr>
</tbody>
</table>

        </div>
      </div>

    </div>
  </div>

	<div class="container">
		<div class="card-panel">
			<h3><?= __( "…e molto altro!" ) ?></h3>
			<p><?= sprintf(
				__( "Ma non è finita! Ti piace il <b>software libero</b>? e le <b>libertà digitali</b>? Scopri le sessioni parallele al Linux Day 2020!" )
			) ?><br />
			<a href="https://www.linuxday.it/2020/programma/"><?= __( "Programma Linux Day 2020" ) ?></a></p>
		</div>
	</div>

<?php

// print the website footer
template_2020( 'footer', [
	'conference' => $conference,
] );
