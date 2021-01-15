(function ($) {
    $(function () {
        // Hide the description for any lgpd checkboxes.
        var container = $('.lgpd_consent_agreement').parent();
        var desc = container.find('.description');

        if(!desc.length) {
            container = container.parent();
            desc = container.next('.description');
        }

        desc.hide();

        $('<a href="javascript:void(0)" class="lgpd_agreed_toggle">?</a>')
            .appendTo(container)
            .click(function () {
                var desc = $(this).parent().find('.description');
                if(!desc.length) {
                    desc = $(this).parent().next('.description');
                }

                desc.slideToggle()
            });

        // Do the same for implicit
        container = $('.lgpd_consent_implicit').parent();
        desc = container.find('.description');
        desc.hide();

        $('<a href="javascript:void(0)" class="lgpd_agreed_toggle">?</a>')
            .appendTo(container)
            .click(function () {
                $(this).parent().find('.description').slideToggle()
            });
    });
})(jQuery);
