jQuery(function ($) {

    // Set default header/post image height for new posts
    if (typeof typenow !== 'undefined') {
        if (typenow === 'post') {
            if ($( '#_kad_posthead_height' ).val() == "") {
                $( '#_kad_posthead_height' ).val('600');
            }
        }
    }

    // Set events category automatically
    if (typeof typenow !== 'undefined') {
        if(typenow === 'event') {
            let title = document.title.split('‹');
            title = title[1].split('—');
            let sitename = title[0].trim();
            var str = $('.ms-global-categories').html();
            var html = $.parseHTML( str ),
            nodeNames = [];
            $.each( html, function( i, el ) {
                nodeNames[ i ] = el;
                if(el.nodeValue != null) {
                    if(el.nodeValue.trim() == sitename) {
                        let id = nodeNames[i - 1].value;
                        $('input[type="checkbox"][value="' + id + '"]').prop('checked', true);
                    }
                }
            });
        }
    }


});