$(document).ready(function () {

    $.close_flag = false;

    var clickEvent = document.ontouchstart !== null ? 'click' : 'touchstart';

    // преобразование select в ul/li
    var selects = [];
    $('body').find('.custom-list').each(function () {
        selects.push($(this));
    });

    selects.forEach(function (item, i, selects) {
        // Элемент select, который будет замещаться:
        var select = item;
        var selectBoxContainer = $('<div>', {
            class: 'custom-select',
            html: '<div class="selectBox"></div>'
        });
        var dropDown = $('<ul>', {class: 'dropDown'});
        var selectBox = selectBoxContainer.find('.selectBox');

        // Цикл по оригинальному элементу select
        select.find('option').each(function (i) {
            var option = $(this);
            if (i == 0) {
                selectBox.html(option.text());
                //return true;
            }

            // Создаем выпадающий пункт в соответствии с данными select:
            var li = $('<li>', {
                html: option.text()
            });

            li.on(clickEvent, function () {
                selectBox.html(option.text());
                dropDown.trigger('hide');

                // Когда происходит событие click, мы также отражаем изменения в оригинальном элементе select:
                select.val(option.val());
                return false;
            });

            dropDown.append(li);
        });

        selectBoxContainer.append(dropDown.hide());
        select.hide().after(selectBoxContainer);

        // Привязываем пользовательские события show и hide к элементу dropDown:
        dropDown.bind('show', function () {
            if (dropDown.is(':animated')) {
                return false;
            }
            selectBox.addClass('expanded');
            dropDown.slideDown();
        }).bind('hide', function () {
            if (dropDown.is(':animated')) {
                return false;
            }
            selectBox.removeClass('expanded');
            dropDown.slideUp();
        }).bind('toggle', function () {
            if (selectBox.hasClass('expanded')) {
                dropDown.trigger('hide');
            } else dropDown.trigger('show');
        });

        selectBox.on(clickEvent, function () {
            dropDown.trigger('toggle');
            return false;
        });

        // Если нажать кнопку мыши где-нибудь на странице при открытом элементе dropDown, он будет спрятан:
        $(document).on(clickEvent, function () {
            dropDown.trigger('hide');
        });

    });

    var show1 = true;
    $(window).on("scroll load resize", function () {
        if ((!show1) || ($("#header-main").length == 0)) {
            return false;
        } // Отменяем показ анимации, если она уже была выполнена или нет нужного блока
        if ($(document).scrollTop() + $(window).height() > $("#header-main").offset().top && $(document).scrollTop() - $("#header-main").offset().top < $("#header-main").height()) {
            $(".spincrement").spincrement({
                thousandSeparator: "",
                duration: 4000
            });
            show1 = false;
        }
    });

    var show2 = true;
    $(window).on("scroll load resize", function () {
        if ((!show2) || ($("#digits").length == 0)) {
            return false;
        } // Отменяем показ анимации, если она уже была выполнена или нет нужного блока
        if ($(document).scrollTop() + $(window).height() > $("#digits").offset().top && $(document).scrollTop() - $("#digits").offset().top < $("#digits").height()) {
            $(".spincrement").spincrement({
                thousandSeparator: "",
                duration: 4000
            });
            show2 = false;
        }
    });
    
    // показать всплывашку об акции
    var trigger = $(location).attr('href').indexOf('ny2020');
    
    if (trigger > 0){
        setTimeout(function(){
            $.fancybox.open($('#info-modal'));
            $.close_flag = true;
         }, 1500);
    }

    // всплывающее окно
    $(".fancybox").fancybox();

    // галерея
    $(".fancybox-gallery").fancybox({
        loop: true,
        animationEffect: 'zoom',
        transitionEffect: 'slide',
        transitionDuration: 500
    });

    // наведение на миниатюры галереи
    hover_effect();

    // Кнопка "Подробнее"
    $('.more-button span').on(clickEvent, function () {
        $(this).closest('.text').find('.more').toggleClass('hidden');
        if ($(this).closest('.text').find('.more').hasClass('hidden')) {
            $(this).text('Подробнее');
        } else {
            $(this).text('Свернуть');
        }
    });

    // Выбор типа пакета
    $('#packages .button, #anticrisis .button').on(clickEvent, function () {
        $('#order-modal input[name="package"]').val($(this).data('package'));
    });

    // FAQ
    $('#faq li').on(clickEvent, function () {
        $(this).toggleClass('opened');
        if ($(this).hasClass('opened')) {
            $(this).find('.answer').slideDown(300);
        } else {
            $(this).find('.answer').slideUp(300);
        }
    });
    $('#faq li .answer').on(clickEvent, function (e) {
        e.stopPropagation();
    });
    
    // меню на мобильных
    $('#top .menu-container span').on(clickEvent, function() {
        $('#top .menu').toggleClass('visible');
    });    

    // проверка форм на ошибки
    $('.form-container form').on('submit', function (e) {
        var formId = $(this).find('input[name="title"]').val();
        var arrayOpt = [],
            pattern = /([<>'"#])+/i,
            itsOK = true,
            check = true;

        if (formId == "Map") {

            if ($(this).find('input[name="email"]').val() == "") {
                $mail = $(this).find('input[name="email"]');
                $mail.closest('label').addClass('error');
                $mail.val('Вы не ввели ' + $mail.data('hint'));
                check = false;
                e.preventDefault();
            }

        } else {

            if ($(this).find('input[name="phone"]').val().replace(/\D+/g, "") == "") {
                $phone = $(this).find('input[name="phone"]');
                $phone.closest('label').addClass('error');
                $phone.val('Вы не ввели ' + $(this).find('input[name="phone"]').data('hint'));
                check = false;
                e.preventDefault();
            }

            /*        $(this).find('input:not([type="submit"])').each(function(index) {
                        if($(this).val() == "") {
                            $(this).closest('label').addClass('error');
                            $(this).val('Вы не ввели ' + $(this).data('hint'));
                            check = false;
                            e.preventDefault();
                        }
                    });*/

        }

        if (check == true) {
            var oldval = $(this).find('input[type="submit"]').val();
            $(this).find('input[type="submit"]').val("Подождите...");
            $(this).find('input[type="submit"]').attr("disabled", "disabled");
            setTimeout(function() {
                $(this).find('input[type="submit"]').removeAttr("disabled");
                $(this).find('input[type="submit"]').val(oldval);
            }, 6000);
            window.dataLayer.push({'event': formId});

            $.close_flag = true; // не показываем всплывашку, если отправлена заявка
        }

    });

    // убираем сообщение об ошибке на форме при установке курсора
    $('.form-container form input:not([type="submit"])').on(clickEvent, function () {
        if ($(this).closest('label').hasClass('error')) {
            $(this).val('');
            $(this).closest('label').removeClass('error');
        }

    });
    
    // подгрузка видео с YouTube при скроллинге
    function loadVideo(videoUrl, videoBlock) {
        var videoTag = '<iframe src="' + videoUrl + '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
        $(videoBlock).html(videoTag);
    }

    function loadShowVideo (videoUrl, videoBlock) {
        if ($('*').is(videoBlock)) {
            var vFlag = true;
            $(window).on('scroll',function(){
                if ($(window).scrollTop() > ($(videoBlock).offset().top - 2000) && vFlag) {
                vFlag = false;
                    if ($(videoBlock).find('iframe').length == 0) {
                        loadVideo(videoUrl, videoBlock);
                    }
                }
            });
        }
    }

    loadShowVideo('https://www.youtube.com/embed/wqWDSNqeI6E', '#video-team');     

    // плавная прокрутка
    $('.button-scroll').on(clickEvent, function(){
        var scroll_el = $(this).attr('href')
        if ($(scroll_el).length != 0) { 
            $('html, body').animate({ scrollTop: $(scroll_el).offset().top - 50}, 500);
        }
        if (($(this).parent().parent().hasClass('menu'))){
            $('#top .menu').removeClass('visible');
        }        
        return false;
    });

    // всплывашка при уходе
    setTimeout(function() {
          $(document).mouseleave(function(e) {
              if ((e.pageY - $(document).scrollTop() <= 5)&&($.close_flag == false)&&(!($("form input").is(":focus")))&&($('body').find($('#free-docs')).length > 0)){
                  $.fancybox.open($('#free-docs'));
                  $.close_flag = true;
              }
          });
      }, 5000);

    // список зарегистрированных товарных знаков в городе

    $('[data-role="city-item"]').on(clickEvent, function(e){

        $.ajax('/city-detail', {
            type: 'post',
            dataType: 'json',
            data: {domain_name: $(e.currentTarget).attr('data-domain_name')},
            success: function(data) {

                if (data.success) {
                    let $modal = $('#patent-modal');

                    $modal.find('.popup-container').html(data.html);
                    $.fancybox.open($modal);

                }
            }
        });
    });
    
    // переход по ссылке патента из блока на странице
    $('.patent-list .link').on('click', function(){
        var link;
        
        link = $(this).data('url');        
        
        $('<a href="'+ link +'" target="_blank"></a>')[0].click();
                
    }); 
    
    // Кнопка "Нет Whatsapp"
    $('#free-docs .no-whatsapp').on(clickEvent, function () {
        $(this).toggleClass('checked');
        
        if ($(this).hasClass('checked')){
            $('#free-docs .additional-block').addClass('visible');
        } else {
            $('#free-docs .additional-block').removeClass('visible');            
        }
    }); 
    
    // меняем заголовки в форме в зависимости от тарифа
    $('#header-main .custom-select li').on('click touchstart', function() {
        var current_item, tarif, title, subtitle, tag;

        current_item = $(this).closest('form').find('.custom-list').val();        
        tarif = $('#header-main').find('option[value="' + current_item + '"]');        
        title = tarif.data('title');
        subtitle = tarif.data('subtitle');
        tag = tarif.data('form');
        
        $('#header-main .form-title').text(title);
        $('#header-main .form-subtitle').text(subtitle);
        $('#header-main').find('input[name="title"]').val(tag);
    });    
    
    // слайдеры для мобильных
    if (document.documentElement.clientWidth < 768) {
        init_team();
        init_sphere();
        init_reasons();
    }

    // слайдер отзывов
    if (document.documentElement.clientWidth < 980) {
        init_slider();
    }
    

// слайдер для Пяти причин...

    $(window).resize(function () {
        if ((document.documentElement.clientWidth < 980)&&(document.documentElement.clientWidth >= 768)) {
            if (($('#feedback-slider').length > 0) && (!($('#feedback-slider').hasClass('slick-slider')))) {
                init_slider();
            }
            if (($('#team-slider').length > 0) && ($('#team-slider').hasClass('slick-slider'))) {
                $('#team-slider').slick('unslick');
            }
            if (($('#sphere-slider').length > 0) && ($('#sphere-slider').hasClass('slick-slider'))) {
                $('#sphere-slider').slick('unslick');
            }
            if (($('#five-reasons-slider').length > 0) && ($('#five-reasons-slider').hasClass('slick-slider'))) {
                $('#five-reasons-slider').slick('unslick');
            }           
        } else if (document.documentElement.clientWidth < 768) {
            if (($('#feedback-slider').length > 0) && (!($('#feedback-slider').hasClass('slick-slider')))) {
                init_slider();
            }            
            if (($('#team-slider').length > 0) && (!($('#team-slider').hasClass('slick-slider')))) {
                init_team();
            }
            if (($('#sphere-slider').length > 0) && (!($('#sphere-slider').hasClass('slick-slider')))) {
                init_sphere();
            }       
            if (($('#five-reasons-slider').length > 0) && (!($('#sphere-slider').hasClass('slick-slider')))) {
                init_reasons();
            }     
        } else {
            if (($('#feedback-slider').length > 0) && ($('#feedback-slider').hasClass('slick-slider'))) {
                $('#feedback-slider').slick('unslick');
            }
            if (($('#team-slider').length > 0) && ($('#team-slider').hasClass('slick-slider'))) {
                $('#team-slider').slick('unslick');
            }
            if (($('#sphere-slider').length > 0) && ($('#sphere-slider').hasClass('slick-slider'))) {
                $('#sphere-slider').slick('unslick');
            }      
            if (($('#five-reasons-slider').length > 0) && ($('#five-reasons-slider').hasClass('slick-slider'))) {
                $('#sphere-slider').slick('unslick');
            }       
        }
    });    

});

// слайдер отзывов для мобилок
function init_slider() {
    $('#feedback-slider').slick({
        infinite: true,
        arrows: true,
        dots: true,
        adaptiveHeight: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
}

// слайдер команда для мобилок
function init_team() {
    $('#team-slider').slick({
        infinite: true,
        arrows: true,
        dots: false,
        adaptiveHeight: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
}

// слайдер сфер для мобилок
function init_sphere() {
    $('#sphere-slider').slick({
        infinite: true,
        arrows: true,
        dots: true,
        adaptiveHeight: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
}

function init_reasons() {
    $('#five-reasons-slider').slick({
        infinite: true,
        arrows: true,
        dots: true,
        adaptiveHeight: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
}

// наведение на миниатюры галереи
function hover_effect(){
    var a = jQuery;
    a(".fancybox-gallery").mouseenter(function () {
        var b = a("div.gallery_zoom", this);
        if (!b.length) {
            b = a('<div class="gallery_zoom" style="position:absolute">').hide().appendTo(this);
            a("img:first", b).detach();
        }
        b.fadeIn("fast")
    })
    .mouseleave(function () {
        a("div", this).fadeOut("fast")
    });
}