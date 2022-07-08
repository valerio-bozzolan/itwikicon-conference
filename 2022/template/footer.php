<?php
# itWikiCon website - conference management system based on LinuxDayTorino's website
# Copyright (C) 2020, 2022 Valerio Bozzolan, contributors
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
  <footer class="page-footer blue">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <h5 class="white-text"><?= esc_html( $conference->getConferenceTitle() ) ?></h5>
          <p class="grey-text text-lighten-4"><?= sprintf(
		__( "Un ringraziamento a tutti i volontari che stanno rendendo possibile questa edizione. La prima edizione post-pandemia, interamente progettata con %s. Buon divertimento!" ),
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

	  <p><a href="https://meta.wikimedia.org/wiki/itWikiCon/2022/" class="btn waves-effect white black-text"><i class="material-icons left">sentiment_very_satisfied</i><?= __( "Domande frequenti" ) ?></a></p>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
	<p>
      	<?= HTML::a(
		'https://meta.wikimedia.org/wiki/ItWikiCon/2022',
		__( "Realizzato dai volontari itWikiCon 2022" ),
		null,
		'blue-text text-lighten-5'
	) ?> |
	<?= HTML::a(
		'https://phabricator.wikimedia.org/tag/itwikicon-2022/',
		__( "Segnala un'idea o un problema" ),
		null,
		'blue-text text-lighten-5'
	) ?>
	</p>
	<p>
	  <p><a class="white-text" href="https://www.itwikicon.org/privacy-policy/"><?=  __( "Informativa sulla privacy per il sito" ) ?></a>.
	     <a class="white-text" href="https://foundation.wikimedia.org/wiki/Privacy_policy"><?= __( "Informativa sulla privacy per i materiali multimediali" ) ?></a>.
	</p>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="/javascript/jquery/jquery.min.js"></script>
  <script src="<?= ROOT ?>/js/materialize.js"></script>
  <script src="<?= ROOT ?>/js/init.js"></script>

  <?php template_2022( 'matomo' ) ?>

  </body>
</html>
