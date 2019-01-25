(function ($) {
    "use strict";

    /* Mobile menu click then remove
    ==========================*/
    $(".mainmenu-area #primary_menu li a").on("click", function () {
        $(".navbar-collapse").removeClass("in");
    });

    /* Scroll to top
    ===================*/
    $.scrollUp({
        scrollText: '<i class="icofont icofont-bubble-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });

    /*--------------------
     MAGNIFIC POPUP JS
     ----------------------*/
    $('.video-popup').magnificPopup({
        type: 'iframe',
        removalDelay: 500, //delay removal by X to allow out-animation
        callbacks: {
            beforeOpen: function () {
                // just a hack that adds mfp-anim class to markup
                this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                this.st.mainClass = this.st.el.attr('data-effect');
            }
        },
        iframe: {
            markup: '<div class="mfp-iframe-scaler">' +
                '<div class="mfp-close"></div>' +
                '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                '<div class="mfp-title">Some caption</div>' +
                '</div>'
        },
        gallery: {
            enabled: true
        },
        closeOnContentClick: true,
        midClick: true
    });


    $('.bg-slider').owlCarousel({
        loop: true,
        margin: 0,
        responsiveClass: true,
        nav: true,
        autoplay: true,
        autoplayTimeout: 4000,
        smartSpeed: 1000,
        navText: ['<i class="icofont icofont-rounded-left"></i>', '<i class="icofont icofont-rounded-right"></i>'],
        items: 1
    });

    /*  mixItUp active*/
    $('.filter-item').mixItUp();

    // Select all links with hashes
    $('.mainmenu-area a[href*="#"]')
        // Remove links that don't actually link to anything
        .not('[href="#"]')
        .not('[href="#0"]')
        .on('click',function (event) {
            // On-page links
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                location.hostname == this.hostname
            ) {
                // Figure out element to scroll to
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                // Does a scroll target exist?
                if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000, function () {
                        // Callback after animation
                        // Must change focus!
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        };
                    });
                }
            }
        });

    /*---------------------------
        MICHIMP INTEGRATION
    -----------------------------*/
    $('#mc-form').ajaxChimp({
        url: 'https://quomodosoft.us14.list-manage.com/subscribe/post?u=b2a3f199e321346f8785d48fb&amp;id=d0323b0697', //Set Your Mailchamp URL
        callback: function (resp) {
            if (resp.result === 'success') {
                $('.subscrie-form, .join-button').fadeOut();
                $('body').css('overflow-y', 'scroll');
            }
        }
    });


    $('.join-button a').on('click', function () {
        $('.subscrie-form').fadeIn(500);
        $('body').css('overflow-y', 'hidden');
        return false;
    })

    $('.subscrie-form .subs-close').on('click', function () {
        $('.subscrie-form').fadeOut(500);
        $('body').css('overflow-y', 'scroll');
        return false;
    });

    /* Preloader Js
    ===================*/
    $(window).on("load", function () {
        $('.preloade').fadeOut(500);
    });
})(jQuery);
