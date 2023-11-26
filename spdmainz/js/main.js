jQuery(function ($) {

    // Remove Top-Link
    $( '#topcontrol' ).remove();

    // Image Source von bei Seiten mit Feature Image
    var pagefeat = $( '.kt-feature-image' );
    if (pagefeat.length != 0) {
        let isc = $( '.image-source' );
        let isc_first = Object.values(isc)[0];
        let el = $(isc_first).prev().children();
        el = Object.values(el)[0];
        el.innerHTML += isc_first.outerHTML;
        isc_first.remove();
    }

});