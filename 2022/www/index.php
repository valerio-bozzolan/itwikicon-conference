<?php
# itWikiCon website - conference management system based on LinuxDayTorino's website
# Copyright (C) 2016, 2017, 2018, 2019, 2020, 2022 Valerio Bozzolan, Catrin Vimercati, Ludovico Pavesi, contributors
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
				<p class="flow-text"><?= esc_html( __( "Quest'anno l'evento si terrà di persona a Verbania!" ) ) ?></p>
			<p><a href="#step-1" class="btn-large waves-effect blue smooth-scroll"><?= icon_2022( 'info', 'left' ) ?> <?= __( "Info" ) ?></a></p>
		</div>
	</div>
</div>

<div class="container" id="info">

	<div class="section">
	<div class="row">

	<div class="col s12">
		<div id="step-1"></div>
		<h2 class="blue-text">Come partecipare alla itWikiCon 2022?</h2>
		<div class="card-panel">
			<h3 class="blue-text">Passo 1 - Registrazione</h3>
			<p>Se desideri partecipare di persona, compila il modulo di registrazione:<br />
				<a class="btn-large blue waves-effect" href="https://survey.itwikicon.org/index.php/394377" rel="noopener noreferrer nofollow"><?=
					icon_2022( 'group_add', 'left' )
					.
					__( "Registrazione" )
				?></a>
			</p>
		</div>
	</div>

	<div class="col s12">
		<div id="step-2"></div>
		<div class="card-panel">
			<h3 class="blue-text">Passo 2 - Pagamento</h3>
			<p>Se desideri partecipare di persona, paga la quota di partecipazione:<br />
				<a class="btn-large blue waves-effect" href="https://www.paypal.com/donate/?hosted_button_id=35MC3WB2QRP7L" target="_blank"><?=
					icon_2022( 'payment', 'left' )
					.
					__( "Pagamento PayPal" )
				?></a>
			</p>
		</div>
	</div>

	<div class="col s12">
		<div id="step-3"></div>
		<div class="card-panel">
			<h3 class="blue-text">Passo 3 - Viaggio e preferenze alimentari</h3>
			<p>Compilare il questionario anonimo su viaggio e preferenze alimentari:<br />
				<a class="btn-large blue waves-effect" href="https://survey.itwikicon.org/index.php/471745"><?=
					icon_2022( 'train', 'left' )
					.
					__( "Viaggio e pref. alimentari" )
				?></a>
			</p>
		</div>
	</div>

	<div class="col s12">
		<div id="step-4"></div>
		<div class="card-panel">
			<h3 class="blue-text">Passo 4 - Informazioni</h3>
			<p>Ti invitiamo inoltre ad iscriverti al canale Telegram itWikiCon (<a href="https://t.me/itwikicon"><span style="color: #000080;"><span style="color: #0000ff;">https://t.me/itwikicon</span></span></a>) per essere sempre aggiornato in tempo reale su eventuali modifiche al programma e per ricevere altre informazioni utili.</p>
			<p>Per qualsiasi domanda puoi scrivere su meta: <span style="color: #0000ff;"><a style="color: #0000ff;" href="https://meta.wikimedia.org/wiki/Talk:ItWikiCon/2022/Partecipanti">https://meta.wikimedia.org/wiki/Talk:ItWikiCon/2022/Partecipanti</a></span> oppure via e-mail a: info@itwikicon.org</p>
			<p>Ci vediamo a Verbania! ❤️</p>
		</div>
	</div>

	</div>
	</div>
</div>

<div class="container" id="program">

	<div class="row">
        <div class="col s12" id="program-day-1">
		<h3 class="blue-text"><?= __( "Partecipa al programma" ) ?></h3>
		<p><?= __( "La conferenza non si realizza da sola." ) ?>
			<?= HTML::a(
				'https://meta.wikimedia.org/wiki/ItWikiCon/2022/Programma',
				__( "Partecipa al programma su Meta-wiki" )
			)  ?>!
		</p>

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

<?php

// print the website footer
template_2022( 'footer', [
	'conference' => $conference,
] );
