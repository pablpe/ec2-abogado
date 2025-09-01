
(function ($) {

    $(window).load(function () {
        $("#pre-loader").delay(500).fadeOut();
        $(".loader-wrapper").delay(1000).fadeOut("slow");

    });

    $(document).ready(function () {

        $(".toggle-button").click(function () {
            $(this).parent().toggleClass("menu-collapsed");
        });
    });

})(this.jQuery);