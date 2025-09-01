
(function ($) {

    $(window).load(function () {
        $("#pre-loader").delay(500).fadeOut();
        $(".loader-wrapper").delay(1000).fadeOut("slow");

    });

    $(document).ready(function () {

        $(".toggle-button").click(function () {
            $(this).parent().toggleClass("menu-collapsed");
        });

        /*--- adding dropdown class to menu -----*/
        $("ul.sub-menu").parent().addClass("dropdown");
        $("ul.sub-menu").addClass("dropdown-menu");
        $("ul#menuid li.dropdown a").addClass("dropdown-toggle");
        $("ul.sub-menu li a").removeClass("dropdown-toggle");
        $('nav li.dropdown > a').append('<span class="caret"></span>');
        $('a.dropdown-toggle').attr('data-toggle', 'dropdown');

        /*-- Mobile menu --*/
        if ($('#navbar-collapse-2').length) {
            $('#navbar-collapse-2 .navigation li.dropdown').append(function () {
                return '<i class="bi bi-caret-down-fill" aria-hd="true"></i>';
            });
            $('#navbar-collapse-2 .navigation li.dropdown .bi').on('click', function () {
                $(this).parent('li').children('ul').slideToggle();
            });
        }

        /*-- navbar toggle */
        var obtn = $('.navbar-toggler');
        obtn.on('click', function () {
            $('.offcanvas-header .btn-close').focus();
        });

        /*-- tooltip --*/
        $('[data-toggle="tooltip"]').tooltip();

        /*-- Button Up --*/
        var btnUp = $('<div/>', { 'class': 'btntoTop' });
        btnUp.appendTo('body');
        $(document).on('click', '.btntoTop', function (e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 700);
        });

        $(window).on('scroll', function () {
            if ($(this).scrollTop() > 200)
                $('.btntoTop').addClass('active');
            else
                $('.btntoTop').removeClass('active');
        });


        /*-- Reload page when width is between 320 and 768px and only from desktop */
        var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;
        $(window).on('resize', function () {
            var win = $(this); //this = window
            if (win.width() > 320 && win.width() < 991 && isMobile == false && !$("body").hasClass("elementor-editor-active")) {
                location.reload();
            }
        });
    });

})(this.jQuery);