<!-- Start Matomo code -->

<?php if( do_not_track() ): ?>

	<!-- Good for you! You are in Do Not Track mode! No JavaScript tracking! -->
	<!-- Anyway... we can track you even without this pixel, so here you are a pixel -->
	<p class="matomo-pixel"><img src="https://matomo.itwikicon.org/matomo.php?idsite=13&amp;rec=1" style="border:0;" alt="" /></p>

<?php elseif( is_logged() ): ?>

	<!-- Good for you! You are an internal! No tracking! -->

<?php else: ?>

	<!-- You are not in Do Not Track mode so here you are some cute Free as in Freedom trackers for stats reasons -->
	<script>
	  var _paq = window._paq || [];
	  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
	  _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
	  _paq.push(["setCookieDomain", "*.itwikicon.org"]);
	  _paq.push(['trackPageView']);
	  _paq.push(['enableLinkTracking']);
	  (function() {
	    var u="https://matomo.itwikicon.org/";
	    _paq.push(['setTrackerUrl', u+'matomo.php']);
	    _paq.push(['setSiteId', '13']);
	    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
	    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
	  })();
	</script>
	<noscript><p class="matomo-pixel"><img src="https://matomo.itwikicon.org/matomo.php?idsite=13&amp;rec=1" style="border:0;" alt="" /></p></noscript>

<?php endif ?>

<!-- End Matomo Code -->
