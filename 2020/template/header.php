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

/**
 * Available arguments:
 *
 * $title: page title
 */

$page_title = $title ?? $conference->getConferenceTitle();

$page_url = $url ?? URL;
?>
<!DOCTYPE html>
<html lang="<?= latest_language()->getISO() ?>">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title><?= esc_html( sprintf(
	__( "%s - %s" ),
	$page_title,
	isset( $title ) ? $conference->getConferenceTitle() : $conference->getConferenceSubtitle()
  ) ) ?></title>

  <!-- CSS  -->
  <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
  <link href="<?= ROOT ?>/css/material-design-iconfont/material-design-icons.css" rel="stylesheet" />
  <link href="<?= ROOT ?>/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?= ROOT ?>/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="icon" type="image/jpeg" href="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4a/ItWikiCon_2020_coin_version.svg/36px-ItWikiCon_2020_coin_version.svg.png" />
  <link rel="copyright" href="//creativecommons.org/licenses/by-sa/4.0/" />
  <meta name="generator" content="suckless-conference" />
  <meta property="og:image" content="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/ItWikiCon2020_Dante.svg/1024px-ItWikiCon2020_Dante.svg.png" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="<?= esc_attr( site_page( $url, true ) ) ?>/" />
  <meta property="og:title" content="<?= esc_attr( $page_title ) ?>" />
  <meta property="og:description" content="La conferenza nazionale dei progetti Wikimedia" />
</head>
<body>
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="#" class="brand-logo">
	<?= esc_html( $conference->getConferenceAcronym() ) ?>
	<!--
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4a/ItWikiCon_2020_coin_version.svg/52px-ItWikiCon_2020_coin_version.svg.png" alt="itWikiCon 2020 logo" />
	-->
      </a>

      <ul class="right">
        <li><a class="smooth-scroll" href="<?= ROOT ?>/#program"><?= __( "Programma" ) ?></a></li>
      </ul>

    </div>
  </nav>
