( function ( $ ) {

$( function () {

	$( '.sidenav' ).sidenav();
	$( '.parallax' ).parallax();

	/**
	 * Smooth scroll to an element
	 */
	function smoothScroll( $el ) {
		$( 'html,body' ).animate( { scrollTop: $el.offset().top }, 900 );
	};

	// See https://stackoverflow.com/a/14805615
	$( '.smooth-scroll' ).click( function( event ) {

		// smooth scroll only if in same page
		if( this.href.indexOf( window.location.href ) > -1 ) {
			smoothScroll( $(this.hash) );
			event.preventDefault();
		}
	} );
} );

} )( jQuery ); // end of jQuery name space
