jQuery(function ($) {
$( ".teamshowcasefree_style01" ).map(function() {
        if(!$(this).is(':has(.tp-team-pro-thumbnail-01)')) {
            $(this).prepend('<div class="tp-team-pro-thumbnail-01"><img src="/wp-content/themes/spdmainz/images/person.svg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="Person" decoding="async" sizes="(max-width: 900px) 100vw, 900px" width="900" height="900"><div class="tp-team-pro-overlay-content-01 no-ovelay"><ul class="tp-team-pro-social-01"></ul></div></div>');
        }
    });
});