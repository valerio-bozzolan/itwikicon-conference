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
			<img class="responsive-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d8/ItWikiCon_2020_round_sticker.svg/240px-ItWikiCon_2020_round_sticker.svg.png" alt="itWikiCon 2020 logo" />
		</div>
		<div class="hide-on-small-only">
			<img class="responsive-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d8/ItWikiCon_2020_round_sticker.svg/240px-ItWikiCon_2020_round_sticker.svg.png" alt="itWikiCon 2020 logo" />
		</div>
	</div>
        <div class="col s12 m8 offset-l2 l8">
          <h5 class="white-text"><?= esc_html( $conference->getConferenceTitle() ) ?></h5>
          <p class="grey-text text-lighten-4"><?= __( "Questa edizione è interamente organizzata da volontari. Scopri chi siamo e perché lo facciamo." ) ?></p>
	  <a href="https://meta.wikimedia.org/wiki/itWikiCon/2020/FAQ" class="btn waves-effect white black-text"><?= __( "F.A.Q." ) ?></a>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      	<?= sprintf(
		__( "Realizzato dai %s" ),
		'<a class="blue-text text-lighten-5" href="https://phabricator.wikimedia.org/tag/itwikicon-2020/">' . __( "volontari itWikiCon 2020" ) . '</a>'
	) ?>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
