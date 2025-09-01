(function ($) {
    "use strict";

    $(document).on('click', '.lawfiz-notice .button-primary', function (e) {
        e.preventDefault();

        var $self = $(this);
        if ('install-activate' === $self.data('action') && !$self.hasClass('init')) {
            $self.addClass('init');
            $self.html('Installing Spiraclethemes Site Library <span class="dot-flashing"></span>');

            var spiraclethemesSiteLibraryData = {
                'action': 'lawfiz_install_activate_spiraclethemes_site_library',
                'nonce': lawfiz_localize.spiraclethemes_site_library_nonce
            };

            $.post(lawfiz_localize.ajax_url, spiraclethemesSiteLibraryData)
                .done(function (response) {
                    if (response.success) {
                        console.log('Plugin installed');
                        $self.html('Redirecting to Demo Import Page <span class="dot-flashing"></span>');
                        setTimeout(function () {
                            window.location = $self.attr('href');
                        }, 1000);
                    }
                })
                .fail(function (xhr, textStatus, e) {
                    console.error('Failed to install plugin:', e);
                    $self.parent().after('<div class="plugin-activation-warning">' + lawfiz_localize.failed_message + '</div>');
                });
        }
    });
})(jQuery);
