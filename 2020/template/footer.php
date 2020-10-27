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
  <footer class="page-footer teal">
    <div class="container">
      <div class="row">
	<div class="col s12 m4 l2">
		<div class="hide-on-med-and-up center-align">
			<a href="<?= ROOT ?>/"><img class="responsive-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d8/ItWikiCon_2020_round_sticker.svg/240px-ItWikiCon_2020_round_sticker.svg.png" alt="itWikiCon 2020 logo" /></a>
		</div>
		<div class="hide-on-small-only">
			<img class="responsive-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d8/ItWikiCon_2020_round_sticker.svg/240px-ItWikiCon_2020_round_sticker.svg.png" alt="itWikiCon 2020 logo" />
		</div>
	</div>
        <div class="col s12 m8 offset-l2 l8">
          <h5 class="white-text"><?= esc_html( $conference->getConferenceTitle() ) ?></h5>
          <p class="grey-text text-lighten-4"><?= sprintf(
		__( "Un ringraziamento a tutti i volontari che hanno reso possibile questa edizione. La prima edizione nazionale, online ed interamente progettata con %s. Buon divertimento!" ),
		HTML::a(
			__( "https://it.wikipedia.org/wiki/Software_libero" ),
			__( "Software Libero" ),
			null,
			'white-text'
		)
	  ) ?></p>
		<p><?= sprintf(
			__( "Salvo ove diversamente indicato i contenuti sono liberamente rilasciati in licenza %s" ),
			Licenses::instance()->get( 'cc-by-sa-4.0' )->getLink( 'blue-text text-lighten-5' )
		) ?></p>

	  <p><a href="https://meta.wikimedia.org/wiki/itWikiCon/2020/FAQ" class="btn waves-effect white black-text"><i class="material-icons left">sentiment_very_satisfied</i><?= __( "Domande frequenti" ) ?></a></p>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
	<p>
      	<?= HTML::a(
		'https://meta.wikimedia.org/wiki/ItWikiCon/2020/Team',
		__( "Realizzato dai volontari itWikiCon 2020" ),
		null,
		'blue-text text-lighten-5'
	) ?> |
	<?= HTML::a(
		'https://phabricator.wikimedia.org/tag/itwikicon-2020/',
		__( "Segnala un'idea o un problema" ),
		null,
		'blue-text text-lighten-5'
	) ?>
	</p>
	<p>
	  <p><a class="white-text" href="https://www.itwikicon.org/privacy-policy/"><?=  __( "Informativa sulla privacy per il sito" ) ?></a>.
	     <a class="white-text" href="https://www.garr.tv/page/privacy-policy-it"><?= __( "Informativa sulla privacy per le dirette e la chat" ) ?></a>.
	</p>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="/javascript/jquery/jquery.min.js"></script>
  <script src="<?= ROOT ?>/js/materialize.js"></script>
  <script src="<?= ROOT ?>/js/init.js"></script>

  <?php template_2020( 'matomo' ) ?>

  </body>
</html>
