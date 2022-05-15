<!-- Start Matomo code -->

<?php if( do_not_track() ): ?>

	<!-- Good for you! You are in Do Not Track mode! No JavaScript tracking! -->
	<!-- Anyway... we can track you even without this pixel, so here you are a pixel -->
	<!-- Matomo pixel code here -->

<?php elseif( is_logged() ): ?>

	<!-- Good for you! You are an internal! No tracking! -->

<?php else: ?>

	<!-- Matomo code here -->

<?php endif ?>

<!-- End Matomo Code -->
