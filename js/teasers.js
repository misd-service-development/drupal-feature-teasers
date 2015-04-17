(function ($) {

    Drupal.behaviors.cambridgeTeasers = {
        attach: function (context, settings) {
            $('.view-content > .campl-row', context).each(function () {
                var $teasers = $('.campl-teaser-border', this);

                if (Modernizr.mq('only screen and (min-width: 768px)')) {
                    $teasers.matchHeight(false);
                }

                $(window).resize(function () {
                    if (Modernizr.mq('only screen and (max-width: 767px)')) {
                        $teasers.height('auto');
                    } else {
                        $teasers.matchHeight(false);
                    }
                });
            });
        }
    };

})(jQuery);
