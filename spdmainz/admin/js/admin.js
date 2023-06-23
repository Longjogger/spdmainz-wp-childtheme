jQuery(function ($) {

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