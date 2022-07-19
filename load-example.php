<?php
/**
 * EDIT THIS FILE TO CONFIGURE YOUR ITWIKICON WEBSITE AND SAVE AS 'load.php'
 *
 * The file 'load.php' is called in this way since it loads everything.
 * The file 'load.php' - if missing - can be copied from 'load-example.php'.
 * The file 'load.php' contains secret information and should be kept unversioned.
 *
 * HAPPY EDITING!
 */

/**
 * Database configuration
 *
 * You should already have a database and a dedicated user to it
 * with at least these privileges:
 *   SELECT, UPDATE, INSERT, DELETE
 *
 * So here you establish the database connection.
 */
$username = 'itwikicon_conference';
$database = 'itwikicon_conference';
$password = 'insert here your very secret database user password';
$location = 'localhost';

/**
 * Database prefix
 *
 * This can be used if you need a prefix in front of every database table.
 * You can leave this empty to have no prefix (default)
 * Or you can set something like 'itwikic_' as database table prefix.
 *
 * This is useful if you have cheap hosting services with only 1 database
 * but you have multiple websites in it.
 */
$prefix = '';

/**
 * URL relative pathname
 *
 * As default you can leave this empty ('') if you have an URL like this:
 *   https://example.com/
 *
 * or you can set something like 'conference/' if you have an URL like this:
 *   https://example.com/conference/
 *
 * Note that this configuration should not start with a slash since it's implicit.
 */
define( 'ROOT', '' );

/**
 * Filesystem absolute pathname
 *
 * As default you can leave this to this directory (__DIR__) to indicate that your
 * itwikicon-conference points to this very same directory.
 *
 * Or if you have weird configuration you can set something else.
 */
define( 'ABSPATH', __DIR__ );

/**
 * Contact email
 *
 * Feel free to change this to your own e-mail address for contact purposes.
 */
define( 'CONTACT_EMAIL', 'info@example.com' );

/**
 * Current conference
 *
 * This configuration should points to the most useful conference
 * that should be available to the users as default.
 *
 * The value should be a valid Conference UID.
 *
 * In the database, that's conference.conference_uid.
 */
define( 'CURRENT_CONFERENCE_UID', 'itwikicon-2022' );

/**
 * Markdown library
 *
 * Path to your markdown library (in Ubuntu this should be OK)
 */
define( 'LIBMARKDOWN_PATH', '/usr/share/php/Michelf/Markdown.inc.php' );

/**
 * Localization fixes
 *
 * Here you may want to put some fixes for escapeshellarg() in your
 * local language. Or not? Boh.
 */
setlocale( LC_CTYPE, 'C.UTF-8' );

/**
 * Load dependencies
 *
 * In total you should load these frameworks:
 *
 *   - suckless-php
 *   - suckless-conference
 *   - boz-mw
 *
 * As default they are just installed all together in the same place,
 * so just going up (/../) should be enough to find them.
 *
 * Feel free to change these pathnames for your needs, so you can
 * move these dependencies elsewhere (like in /usr/share/php or whatever).
 *
 * If this generates an exception, you have not read the README.
 */
require __DIR__ . '/../suckless-php/load.php';
require __DIR__ . '/../suckless-conference/load.php';
require __DIR__ . '/../boz-mw/autoload.php';
