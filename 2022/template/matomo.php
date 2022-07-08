<!-- Start Matomo code -->

<?php if( do_not_track() ): ?>

<!-- Good for you! You are in Do Not Track mode! No JavaScript tracking! -->
<!-- Anyway... everybody can track you using server-side log analysis, so -->
<!-- here a small image pixel instead of the JavaScript tracker and without cookies -->
<noscript><p><img src="https://matomo.itwikicon.org/matomo.php?idsite=13&amp;rec=1&amp;cookie=0" style="border:0;" alt="" /></p></noscript>

<?php elseif( is_logged() ): ?>

<!-- Good for you! You are an internal! No tracking! -->

<?php else: ?>

<!-- You have NOT "Do Not Track" mode enabled in your browser! OH NO! -->
<!-- That's a TERRIBLE idea! Here a Free/Libre and Open Source tracker able tu suck your data -->
<script type="text/javascript">
  var _paq = window._paq || [];
  _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
  _paq.push(["disableCookies"]); // it means that we do not push cookies to you! awesome! <3
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
<noscript><p><img src="https://matomo.itwikicon.org/matomo.php?idsite=13&amp;rec=1" style="border:0;" alt="" /></p></noscript>

<?php endif ?>

<!-- End Matomo Code -->
