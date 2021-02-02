(function ($) {
    
    var clickEvent = document.ontouchstart !== null ? 'click' : 'touchstart';
    
    // всплывающее окно
    $(".fancybox").fancybox();     
    
    // проверка форм на ошибки
    $('.form-container form').on('submit', function (e) {
        var formId = $(this).find('input[name="title"]').val();
        var arrayOpt = [],
            pattern = /([<>'"#])+/i,
            itsOK = true,
            check = true;

        if ($(this).find('input[name="phone"]').val().replace(/\D+/g, "") == "") {
            $phone = $(this).find('input[name="phone"]');
            $phone.closest('label').addClass('error');
            $phone.val('Вы не ввели ' + $(this).find('input[name="phone"]').data('hint'));
            check = false;
            e.preventDefault();
        }

        if (check == true) {
            var oldval = $(this).find('input[type="submit"]').val();
            $(this).find('input[type="submit"]').val("Подождите...");
            $(this).find('input[type="submit"]').attr("disabled", "disabled");
            setTimeout(() => {
                $(this).find('input[type="submit"]').removeAttr("disabled");
                $(this).find('input[type="submit"]').val(oldval);
            }, 6000);
            window.dataLayer.push({'event': formId});
            
        }

    });

    // убираем сообщение об ошибке на форме при установке курсора
    $('.form-container form input:not([type="submit"])').on(clickEvent, function () {
        if ($(this).closest('label').hasClass('error')) {
            $(this).val('');
            $(this).closest('label').removeClass('error');
        }

    });    

    "use strict";

    // Preload
    $(window).on('load', function () { // makes sure the whole site is loaded
        $('[data-loader="circle-side"]').fadeOut(); // will first fade out the loading animation
        $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
        $('body').delay(350).css({
            'overflow': 'visible'
        });
    })

    // Submit loader mask
    $('form#wrapped').on('submit', function (e) {
        var form = $("form#wrapped");
        form.validate();
        if (form.valid()) {
            form.find('input[name="package"]').val(form.find('input[name="question_2"]').val());
            $("#loader_form").fadeIn();
            //alert('Спасибо! С Вами свяжется менеджер!');
            ///window.location = '/';

           // e.preventDefault();
        }
    });

    // Radio focus/click border
    $('.container_radio.version_2 input[type="radio"], .container_check.version_2 input[type="checkbox"]').click(function () {
        $(this).parent().addClass('active').siblings('label').removeClass('active')
    });

    // Button start scroll to section
    $('a[href^="#"].mobile_btn').on('click', function (e) {
        e.preventDefault();
        var target = this.hash;
        var $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 400, 'swing', function () {
            window.location.hash = target;
        });
    });


    // Float labels
    var floatlabels = new FloatLabels('form', {
        style: 1
    });

    // Accordion
    function toggleChevron(e) {
        $(e.target)
            .prev('.card-header')
            .find("i.indicator")
            .toggleClass('ti-minus ti-plus');
    }

    $('.accordion_2').on('hidden.bs.collapse shown.bs.collapse', toggleChevron);

    function toggleIcon(e) {
        $(e.target)
            .prev('.panel-heading')
            .find(".indicator")
            .toggleClass('ti-minus ti-plus');
    }

    // Faq page smooth scroll to anchor id
    $('#faq_box a[href^="#"]').on('click', function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
            || location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - 195
                }, 800);
                return false;
            }
        }
    });

    // Cat link active
    $('ul#cat_nav li a').on('click', function () {
        $('ul#cat_nav li a.active').removeClass('active');
        $(this).addClass('active');
    });

    // Menu
    var overlayNav = $('.cd-overlay-nav'),
        overlayContent = $('.cd-overlay-content'),
        navigation = $('.cd-primary-nav'),
        toggleNav = $('.cd-nav-trigger');

    //inizialize navigation and content layers
    layerInit();
    $(window).on('resize', function () {
        window.requestAnimationFrame(layerInit);
    });

    //open/close the menu and cover layers
    toggleNav.on('click', function () {
        if (!toggleNav.hasClass('close-nav')) {
            //it means navigation is not visible yet - open it and animate navigation layer
            toggleNav.addClass('close-nav');

            overlayNav.children('span').velocity({
                translateZ: 0,
                scaleX: 1,
                scaleY: 1,
            }, 500, 'easeInCubic', function () {
                navigation.addClass('fade-in');
            });
        } else {
            //navigation is open - close it and remove navigation layer
            toggleNav.removeClass('close-nav');

            overlayContent.children('span').velocity({
                translateZ: 0,
                scaleX: 1,
                scaleY: 1,
            }, 500, 'easeInCubic', function () {
                navigation.removeClass('fade-in');

                overlayNav.children('span').velocity({
                    translateZ: 0,
                    scaleX: 0,
                    scaleY: 0,
                }, 0);

                overlayContent.addClass('is-hidden').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
                    overlayContent.children('span').velocity({
                        translateZ: 0,
                        scaleX: 0,
                        scaleY: 0,
                    }, 0, function () {
                        overlayContent.removeClass('is-hidden')
                    });
                });
                if ($('html').hasClass('no-csstransitions')) {
                    overlayContent.children('span').velocity({
                        translateZ: 0,
                        scaleX: 0,
                        scaleY: 0,
                    }, 0, function () {
                        overlayContent.removeClass('is-hidden')
                    });
                }
            });
        }
    });

    function layerInit() {
        var diameterValue = (Math.sqrt(Math.pow($(window).height(), 2) + Math.pow($(window).width(), 2)) * 2);
        overlayNav.children('span').velocity({
            scaleX: 0,
            scaleY: 0,
            translateZ: 0,
        }, 50).velocity({
            height: diameterValue + 'px',
            width: diameterValue + 'px',
            top: -(diameterValue / 2) + 'px',
            left: -(diameterValue / 2) + 'px',
        }, 0);

        overlayContent.children('span').velocity({
            scaleX: 0,
            scaleY: 0,
            translateZ: 0,
        }, 50).velocity({
            height: diameterValue + 'px',
            width: diameterValue + 'px',
            top: -(diameterValue / 2) + 'px',
            left: -(diameterValue / 2) + 'px',
        }, 0);
    }

})(window.jQuery); 

$(document).ready(function () {
  
});