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

// the Event we want to visit
$event = null;

// load this conference
//$conference = ( new QueryConference() )
//	->whereConferenceUID( THIS_CONFERENCE_UID )
//	->queryRow();

// no conference no party
//if( !$conference ) {
//	error_die( sprintf(
//		"missing conference %s",
//		THIS_CONFERENCE_UID
//	) );
//}

// event UID
$event_slug = $_SERVER['PATH_INFO'] ?? null;
if( !$event_slug ) {
	error_die( "missing event UID" );
}

// remove unuseful slashes
$event_slug = trim( $event_slug, _ );

// 123-something
$event_slug_parts = explode( '-', $event_slug );

// no ID no party
$event_ID = $event_slug_parts[0] ?? 0;
$event_ID = (int) $event_ID;

if( $event_ID ) {

	// Event
	$event = FullEvent::factory()
		->whereEventID( $event_ID )
		->queryRow();

} else {
	// else use the complete Event slug

	// Event
	$event = FullEvent::factory()
		->whereEventUID( $event_slug )
		->queryRow();

}

// no Event no party
if( !$event ) {
	error_die( "missing event $event_slug" );
}

// inherit the Conference information from the Event object
// the $conference is read from the website header
$conference = $event;

// check if this is the correct permalink
if( site_page( $_SERVER['REQUEST_URI'], true ) !== $event->getEventStandardURL( true ) ) {
	http_redirect( $event->getEventStandardURL( true ) );
}

// Event speakers
$speakers   = event_users_2020( $event, 'speaker'    );
$moderators = event_users_2020( $event, 'moderator' );

// create an array of links
$links_speaker = [];
$links_moderator = [];
foreach( $speakers as $user ) {
	$links_speaker[]   = user_link_2020( $user );
}
foreach( $moderators as $user ) {
	$links_moderator[] = user_link_2020( $user );
}


// print the website header
template_2020( 'header', [
	'conference' => $conference,
	'title' => $event->getEventTitle(),
	'url'   => $event->getEventURL(),
] );
?>

<div class="container">
	<h1><?= esc_html( $event->getEventTitle() ) ?> &ndash; <?= esc_html( $conference->getConferenceAcronym() ) ?></h1>

	<!-- start speakers -->
	<?php if( $links_speaker ): ?>
	<div class="itwikicon-user">
		<p class="flow-text"><?= __( "di" ) ?> <?= implode( ', ', $links_speaker ) ?></p>
	</div>
	<?php endif ?>
	<!-- end speakers -->

	<!-- start moderator -->
	<?php if( $links_moderator ): ?>
	<div class="itwikicon-user">
		<p><?= __( "Moderatori:" ) ?> <?= implode( ', ', $links_moderator ) ?>.</p>
	</div>
	<?php endif ?>
	<!-- end speaker -->

	<!-- Start files -->
	<?php $sharables = $event->factorySharebleByEvent()
		->select( Sharable::fields() )
		->whereSharableIsRoot()
		->selectSharableHasChildren()
		->queryGenerator();
	?>
	<?php if( $sharables->valid() ): ?>
	<div class="section">
		<div class="row">
			<?php foreach( $sharables as $sharable ): ?>

				<?php
					// the sharable may have some children
					// See https://gitpull.it/T557
					$child_sharables = [];
					if( $sharable->get( 'sharable_has_children' ) ) {
						$child_sharables = ( new QuerySharable() )
							->whereSharableParent( $sharable )
							->queryResults();
					}

					$all_sharables = array_merge( [ $sharable ], $child_sharables );
				?>


			<div class="col s12">
				<div class="card-panel">
				<?php if( $sharable->isSharableDownloadable() ): ?>

					<!-- if video -->
					<?php if( $sharable->isSharableVideo() ): ?>

						<?php if( $sharable->hasSharableTitle() ): ?>
							<h3><?php printf(
								__( "Rivedi: %s" ),
								'<em>' . esc_html( $sharable->getSharableTitle() ) . '</em>'
							) ?></h3>
						<?php else: ?>
							<h3><?= __( "Rivedi intervento" ) ?></h3>
						<?php endif ?>

						<?php if( $event->isEventPassed() ): ?>
						<div class="event-hour">
							<p class="flow-text"><?= __( "Rivedi l'intervento del" ) ?> <?= $event->getEventStart( 'd' ) ?> <?= __( "ottobre" ) ?> <?= __( "delle ore" ) ?> <b><?= $event->getEventStart( 'H:i' ) ?>&ndash;<?= $event->getEventEnd( 'H:i' ) ?></b> in stanza "<?= esc_html( $event->getRoomName() ) ?>":</p>
						</div>
						<?php endif ?>

						<video class="responsive-video" controls="controls">
							<source src="<?= esc_attr( $sharable->getSharablePath() ) ?>" type="<?= esc_attr( $sharable->getSharableMIME() ) ?>" />
							<?php foreach( $child_sharables as $child_sharable ): ?>
								<source src="<?= esc_attr( $child_sharable->getSharablePath() ) ?>" type="<?= esc_attr( $child_sharable->getSharableMIME() ) ?>" />
							<?php endforeach ?>
						</video>

						<?= sharable_edit( $event, $sharable ) ?>

						<!-- other video formats -->
						<?php foreach( $all_sharables as $child_sharable ): ?>
							<p class="flow-text">
							<?php printf(
								__("Scarica in formato %s distribuibile sotto licenza %s."),
								HTML::a(
									$child_sharable->getSharablePath(),
									icon_2020('attachment', 'left') .
									esc_html( $child_sharable->getSharableMIME() ),
									null,
									null,
									'target="_blank"'
								),
								$sharable->getSharableLicense()->getLink()
							) ?>
							</p>

							<?= sharable_edit( $event, $child_sharable ) ?>

						<?php endforeach ?>
						<!-- end other video formats -->

					<!-- end if video -->
					<?php else: ?>
					<!-- start if not video -->

						<!-- downloadable but not video -->
						<?php foreach( $all_sharables as $child_sharable ): ?>
							<p class="flow-text">
							<?php printf(
								__("Scarica %s distribuibile sotto licenza %s."),
								HTML::a(
									$child_sharable->getSharablePath(),
									icon_2020('attachment', 'left') .
									esc_html( $child_sharable->getSharableTitle() ),
									null,
									null,
									'target="_blank"'
								),
								$sharable->getSharableLicense()->getLink()
							) ?>
							</p>

							<?= sharable_edit( $event, $child_sharable ) ?>

						<?php endforeach ?>
						<!-- downloadable but not video -->

					<?php endif ?>
					<!-- end if not video -->

				<?php else: ?>
					<p class="flow-text">
						<?php printf(
							__("Vedi %s distribuibile sotto licenza %s."),
							HTML::a(
								$sharable->getSharablePath(),
								icon_2020('share', 'left') .
								esc_html( $sharable->getSharableTitle( [ 'prop' => true ] ) ),
								null,
								null,
								'target="_blank"'
							),
							$sharable->getSharableLicense()->getLink()
						) ?>
					</p>

					<?= sharable_edit( $event, $child_sharable ) ?>

				<?php endif ?>

				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
	<?php endif ?>
	<!-- End files -->

	<?= sharable_edit( $event ) ?>

	<?php if( $event->hasEventAbstract() ): ?>
		<h3><?= __( "Abstract" ) ?></h3>
		<div class="card-panel">
			<?= $event->getEventAbstractHTML( [
				'p' => 'flow-text',
			] ) ?>
		</div>
	<?php endif ?>

	<?php if( !$event->isEventPassed() ): ?>
	<div class="card-panel">
		<div class="event-hour">
			<p class="flow-text"><?= __( "Collegati il" ) ?> <?= $event->getEventStart( 'd' ) ?> <?= __( "ottobre" ) ?> <?= __( "alle" ) ?> <b><?= $event->getEventStart( 'H:i' ) ?>&ndash;<?= $event->getEventEnd( 'H:i' ) ?></b> in <?= esc_html( $event->getRoomName() ) ?>.</p>
		</div>
		<p><a class="btn-large waves-effect" href="<?= esc_attr( $event->getRoomURL() ) ?>">
			<i class="material-icons right">play_arrow</i>
			<?= esc_html( $event->getRoomName() ) ?>
		</a></p>
	</div>
	<?php endif ?>

	<div class="card-panel">

		<?php if( $event->hasEventDescription() ): ?>
			<?= $event->getEventDescription() ?>

			<div class="divider"></div>
		<?php endif ?>

		<p><?= HTML::a(
			$event->getEventExternalURL(),
			__( "Maggiori informazioni su Meta-wiki" )
		) ?></p>
	</div>

        <?php
	// previous talk in the same Room
        $previouss = $event->factoryPreviousFullEvent( [ 'whatever-room' => true ] )
                ->select( Event::fields() )
		->select( Conference::fields() )
                ->limit( 2 )
                ->queryResults();

	// next talk in the same room
        $nexts = $event->factoryNextFullEvent( [ 'whatever-room' => true ] )
                ->select( Event::fields() )
		->select( Conference::fields() )
                ->limit( 2 )
                ->queryResults();

	// in the meanwhile
	$durings = $event->factoryMeanwhileFullEvent()
		->limit( 2 )
		->queryResults();
      ?>

        <?php if( $previouss || $nexts || $durings ): ?>
        <!-- Stard previous/before -->
        <div class="divider"></div>
        <div class="section">
                <div class="row">
                        <div class="col s12 m6">
                                <?php if( $previouss ): ?>
                                        <h3><i class="material-icons left">navigate_before</i><?= __("Preceduto da") ?></h3>
					<?php foreach( $previouss as $previous ): ?>
                                        <p class="flow-text">
                                                <?= HTML::a(
                                                        $previous->getEventURL(),
                                                        esc_html( $previous->getEventTitle() )
                                                ) ?>
                                                <time datetime="<?= $previous->getEventStart('Y-m-d H:i') ?>"><?= $previous->getEventHumanStart() ?></time>
                                        </p>
					<?php endforeach ?>
                                <?php endif ?>
                        </div>
                        <div class="col s12 m6 right-align">
                                <?php if( $nexts ): ?>
                                        <h3><?= __("A seguire") ?><i class="material-icons right">navigate_next</i></h3>
					<?php foreach( $nexts as $next ): ?>
                                        <p class="flow-text">
                                                <?= HTML::a(
                                                        $next->getEventURL(),
                                                        esc_html( $next->getEventTitle() )
                                                ) ?>
                                                <time datetime="<?= $next->getEventStart('Y-m-d H:i') ?>"><?= $next->getEventHumanStart() ?></time>
                                        </p>
					<?php endforeach ?>
                                <?php endif ?>
                        </div>
                        <div class="col s12">
                                <?php if( $durings ): ?>
                                        <h3><?= __("Nello stesso momento") ?><i class="material-icons">play_arrow</i></h3>
					<?php foreach( $durings as $during ): ?>
                                        <p class="flow-text">
                                                <?= HTML::a(
                                                        $during->getEventURL(),
                                                        esc_html( $during->getEventTitle() )
                                                ) ?>
                                                <time datetime="<?= $during->getEventStart('Y-m-d H:i') ?>"><?= $during->getEventHumanStart() ?></time>
                                        </p>
					<?php endforeach ?>
                                <?php endif ?>
                        </div>
                </div>
        </div>
        <!-- End previous/before -->
        <?php endif ?>

	<?php if( $event->isEventEditable() ): ?>
		<p><?= HTML::a(
			$event->getEventEditURL(),
			'[edit]'
		) ?></p>
	<?php endif ?>
</div>

<?php
// print the website header
template_2020( 'footer', [
	'conference' => $conference,
] );
