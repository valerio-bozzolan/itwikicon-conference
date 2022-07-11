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
				<p class="flow-text"><?= esc_html( __( "Finalmente l'evento si terrà nuovamente di persona… a Verbania!" ) ) ?></p>
			<p><a href="#step-1" class="btn-large waves-effect blue smooth-scroll"><?= icon_2022( 'info', 'left' ) ?> <?= __( "Info" ) ?></a></p>
		</div>
	</div>
</div>

<div id="step-1"></div>
<h2 class="blue-text center"><b>Come partecipare</b> dal vivo alla itWikiCon 2022?</h2>
<p class="center">Segui tutti i passi per ogni partecipante.<br /><em><small><?= sprintf( __( "Tempo richiesto: %s minuti" ), '10-15' ) ?></small></em></p>

<div class="container" id="info">

	<div class="section">
	<div class="row">

	<div class="col s12">
		<div class="card-panel">
			<h3 class="blue-text">Passo 1 - Registrazione</h3>
			<p>Per favore compila il modulo di registrazione individuale:<br />
				<em><small><?= sprintf( __( "Tempo richiesto: %d minuti" ), 8 ) ?></small></em><br />
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
			<p>Per favore aiuta questo evento organizzato dalla community, pagando la quota di partecipazione che copre pasti catering ecc.<br />
			Questa spesa ti sarà rimborsata se richiederai la borsa di partecipazione e se non saranno terminate.<br />
			Apri la pagina e clicca su <em>Contribuisci</em>:<br />
			<br />Non usiamo PayPal ma Splitted che ha sede in provincia di Milano. È semplice da usare.<br />
				<em><small><?= sprintf( __( "Tempo richiesto: %d minuti" ), 2 ) ?></small></em><br />
				<a class="btn-large blue waves-effect" href="https://splitted.it/itwikicon-2022/" target="_blank"><?=
					icon_2022( 'payment', 'left' )
					.
					__( "Pagamento partecipazione" )
				?></a>
			</p>
		</div>
	</div>

	<div class="col s12">
		<div id="step-3"></div>
		<div class="card-panel">
			<h3 class="blue-text">Passo 3 - Viaggio ed esigenze alimentari</h3>
			<p>Compilare il questionario anonimo su viaggio e le tue esigenze alimentari.<br />
			<p>Notare che è separato così questi dati sensibili rimangono anonimi.<br />
				<small><?= sprintf( __( "Tempo richiesto: %d minuti" ), 2 ) ?></small><br />
				<a class="btn-large blue waves-effect" href="https://survey.itwikicon.org/index.php/471745"><?=
					icon_2022( 'train', 'left' )
					.
					__( "Viaggio ed esigenze alimentari" )
				?></a>
			</p>
		</div>
	</div>

	<div class="col s12">
		<div id="step-4"></div>
		<div class="card-panel">
			<h3 class="blue-text">Fine! Ci vediamo a Verbania ❤️</h3>
			<p>Strumenti utili per rimanere informati fino ad allora:</p>
			<ul class="collection">
				<li class="collection-item">
					Per conoscere e organizzarsi con gli altri partecipanti su meta-wiki:<br />
					<a class="blue-text" href="https://meta.wikimedia.org/wiki/ItWikiCon/2022/Partecipanti"><?= icon_2022( 'group', 'left' ) ?> pagina dei partecipanti itWikiCon 2022 su Meta-wiki</a>
				</li>
				<li class="collection-item">
					Per stare in chat con organizzatori e partecipanti e ricevere in tempo reale<br />(consigliamo di silenziare le notifiche - così si chatta solo quando si è in chat, ma si ricevono comunque gli annunci fissati in alto)<br />
					<a class="blue-text" href="https://t.me/itwikicon"><?= icon_2022( 'chat', 'left' ) ?>gruppo Telegram @itwikicon</a>
				</li>
				<li class="collection-item">
					Per inoltrare una domanda personale:<br />
					<a href="mailto:info@itwikicon.org"><?= icon_2022( 'mail', 'left' ) ?> info@itwikicon.org</a>
				</li>
			</ul>
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
