jQuery(function ($) {
    $( '.posted-on' ).prepend( '<i class="icon-calendar"></i>&nbsp;' );
  
    $( ".image-source" ).map(function() {
        let element = $(this);
        let content = element.html();
        // let modifiedContent = content.replace(/(\r\n|\n|\r)/gm," ");
        // element.html(modifiedContent);


        let html = $.parseHTML( content ),
        nodeNames = [];
        $.each( html, function( i, el ) {
            nodeNames[ i ] = el;
            console.log(el);
        });
    });
});