<?php
session_start();

$app->getSitePageActiveLastModified();

$gtm_id = $app->getVar('gtm_id') ? $app->getVar('gtm_id') : 'TJFHL4B';

$gtm_head = $app->gtm_head($gtm_id, 4000);
$gtm_head .= $app->getVar('goo_verify') ? $app->getVar('goo_verify') : '';
$gtm_head .= $app->getVar('ya_verify') ? $app->getVar('ya_verify') : '';

$gtm_body = $app->gtm_body($gtm_id);

$address =  "";

foreach (['address'] as $var_name) {
    if ($app->getVar($var_name)) {
        ${$var_name} = $app->getVar($var_name);
    }
}

$utm_source = isset($_GET['utm_source']) ? $_GET['utm_source'] : null;
$whatsapp_text = '&text=%D0%9C%D0%BD%D0%B5%20%D0%BD%D1%83%D0%B6%D0%BD%D0%B0%20%D0%BA%D0%BE%D0%BD%D1%81%D1%83%D0%BB%D1%8C%D1%82%D0%B0%D1%86%D0%B8%D1%8F';
if (stripos($utm_source, 'yandex') !== FALSE) {
    $whatsapp_text = '&text=%D0%9D%D1%83%D0%B6%D0%BD%D0%B0%20%D0%BA%D0%BE%D0%BD%D1%81%D1%83%D0%BB%D1%8C%D1%82%D0%B0%D1%86%D0%B8%D1%8F';
} else if (stripos($utm_source, 'google') !== FALSE) {
    $whatsapp_text = '&text=%D0%9D%D1%83%D0%B6%D0%BD%D0%B0%20%D0%BA%D0%BE%D0%BD%D1%81%D1%83%D0%BB%D1%8C%D1%82%D0%B0%D1%86%D0%B8%D1%8F.';
} else if (stripos($utm_source, 'fb') !== FALSE) {
    $whatsapp_text = '&text=%D0%9D%D1%83%D0%B6%D0%BD%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%B0%D1%8F%20%D0%BA%D0%BE%D0%BD%D1%81%D1%83%D0%BB%D1%8C%D1%82%D0%B0%D1%86%D0%B8%D1%8F';
} else if (stripos($utm_source, 'vk') !== FALSE) {
    $whatsapp_text = '&text=%D0%9D%D1%83%D0%B6%D0%BD%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%B0%D1%8F%20%D0%BA%D0%BE%D0%BD%D1%81%D1%83%D0%BB%D1%8C%D1%82%D0%B0%D1%86%D0%B8%D1%8F.';
} else if (stripos($utm_source, 'mytarget') !== FALSE) {
    $whatsapp_text = '&text=%D0%9C%D0%BD%D0%B5%20%D0%BD%D1%83%D0%B6%D0%BD%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%B0%D1%8F%20%D0%BA%D0%BE%D0%BD%D1%81%D1%83%D0%BB%D1%8C%D1%82%D0%B0%D1%86%D0%B8%D1%8F';
}

?>
<!DOCTYPE html>
<html lang="ru-RU" prefix="og: http://ogp.me/ns#" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Проверить товарный знак онлайн бесплатно по базам Роспатента</title>
    <meta name="description" content="Проверьте свое название или товарный знак онлайн. Бесплатно! Полная проверка по базам Роспатента, экспертный поиск, подбор классов МКТУ. Патентное бюро Железно - ТОП-3 регистраторов Роспатента"/>
    <meta name="keywords" content="проверить, проверка, товарный, знак, онлайн, бесплатно, Роспатент"/>
    <link href="<?= $app->urlRelCanonical() ?>" rel="canonical"/>
    <link rel="shortcut icon" href="/favicon.ico"/>
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Патентное бюро Железно">
    <meta property="og:url" content="<?= $app->urlRelCanonical() ?>">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:image" content="https://tovarnyj-znak.ru/images/og_image.jpg">
    <meta property="og:title" content="Бесплатная проверка товарного знака по базам Роспатента онлайн">
    <meta property="og:description"
          content="Полная проверка товарного знака по закрытым базам Роспатента. Бесплатно. Экспертный поиск и подбор классов МКТУ. ">    
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700&display=swap" rel="stylesheet">
    <link href="/pages/quiz/css/bootstrap.min.css" rel="stylesheet">
	<link href="/pages/quiz/css/menu.css" rel="stylesheet">
    <link href="/pages/quiz/css/style.css" rel="stylesheet">
	<link href="/pages/quiz/css/vendors.css" rel="stylesheet">
	<script src="/pages/quiz/js/modernizr.js"></script>
	<script src="/pages/quiz/js/jquery-3.2.1.min.js"></script>
    <script src="/scripts/utm_parser.js"></script>
	<script type="text/javascript">
		$(function () {
			$(".js-form__input--tel").inputmask("mask", {"mask": "9 (999) 999-99-99"});
		});
	</script>
	
<script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    
<?= $gtm_head ?>    

</head>

<body>
    <?= $gtm_body ?>
    
    <div class="wrapper">
        <div id="preloader">
            <div data-loader="circle-side"></div>
        </div>

        <div id="loader_form">
            <div data-loader="circle-side-2"></div>
        </div>

        <header>
            <div class="container">
                <div id="top" class="row">
                        <a href="/" class="col-12 col-xl-4 logo">
                            <div class="img-container">
                                <img src="/pages/quiz/images/logo.jpg" alt="">
                            </div>
                            <p>Патентное бюро</p>
                        </a>
                        <div class="col-12 col-xl-3 top-middle">
                            <p>Мы работаем по всей России</p>
                        </div>
                        <div class="col-12 col-xl-5 phone-block">
                            <a class="phone" href="tel:84951047454">8 495 104-74-54</a>
                            <a class="button button-light fancybox" href="#call-modal">Заказать звонок</a>
                            <a class="whatsapp" href="https://api.whatsapp.com/send?phone=79229092784<?= $whatsapp_text ?>" target="_blank"></a>
                        </div>
                    </div>
                </div>
        </header>

        <div class="container">
            <div id="form_container">
                <div class="row no-gutters">
                    <div class="col-lg-4 d-sm-block">
                        <div id="left_form">
                            <figure><img src="/pages/quiz/images/r.png" alt="" width="100" height="100" style="filter: invert(100%);"></figure>
                            <h2>Регистрация <span>товарного знака</span></h2>
                            <p class="zelezno">Патентное бюро "Железно"</p>
                            <ul>
                                <li>за <span class="nowrap">24 ч</span> - закрепим знак за вами</li>
                                <li>97% успешных регистраций</li>
                                <li>в ТОП-3 регистраторов Роспатента</li>
                            </ul>
                            <p><span class="nowrap blue">0 р</span> - полный экспертный поиск по закрытым базам Роспатента, консультация патентного поверенного, подбор классов МКТУ. <br>
                            или <br>
                            <span class="nowrap blue">19990 р</span> - регистрация под ключ. 100% финансовая гарантия</p>
                            <a href="https://api.whatsapp.com/send?phone=79229092784<?= $whatsapp_text ?>" class="btn_1 rounded yellow purchase" target="_blank">Написать в WhatsApp</a>
                            <p><a href="tel:84951047454" class="phone" target="_blank">Бесплатная горячая линия: <span class="nowrap">8 495 104-74-54</span></a></p>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div id="wizard_container">
                            <div id="top-wizard">
                                <div id="progressbar"></div>
                                <span id="location"></span>
                            </div>
                            <form id="wrapped" method="post">
                                <input type="hidden" name="title" value="quiz">
                                <input type="hidden" name="package" value="">
                                <input id="website" name="website" type="text" value="">
                                <div id="middle-wizard">

                                    <div class="step">
                                        <h1>Бесплатная проверка товарного знака</h1>
                                        <h3 class="main_question"><i class="arrow_right"></i>Какой товарный знак проверяем? Укажите название (товарный знак) и сферу деятельности</h3>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="name">Название *</label>
                                                    <input type="text" name="question_1" id="name" class="form-control required">
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Сфера деятельности *</label>
                                                    <input type="text" name="question_2" id="name" class="form-control required">
                                                </div>
                                            </div>
                                        </div>
                                        <p>Патентный отдел проверит ваш знак по указанным сферам деятельности, подберет классы МКТУ.</p>
                                        <p><b>Это абсолютно бесплатно для вас</b></p>
                                    </div>

                                    <div class="submit step" id="end">
                                        <h3 class="main_question"><i class="arrow_right"></i>Ваш знак на проверке. Процедура занимает 2-4 часа. Оставьте контактные данные для получения отчета. Мы свяжемся с вами раньше, если  возникнут вопросы по знаку.</h3>
                                        <div class="form-group add_top_30">
                                            <label for="name">Имя *</label>
                                            <input type="text" name="name" id="name" class="form-control required">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Телефон *</label>
                                            <input name="phone" id="phone" type="tel" class="form-control required js-form__input--tel">
                                        </div>
                                        <div class="text-center">
                                            <div class="form-group terms">
                                                <label class="container_check">Я даю согласие на обработку персональных данных
                                                    <input type="checkbox" name="terms" value="Yes" class="required" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div id="bottom-wizard">
                                    <button type="button" name="backward" class="backward">Назад</button>
                                    <button type="button" name="forward" class="forward">Далее&nbsp;&nbsp;⟶</button>
                                    <button type="submit" name="process" class="submit">Далее&nbsp;&nbsp;⟶</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	

<div class="container">
    <footer id="home" class="clearfix">
        <p>Copyright © 2020 Железно. Все права защищены.</p>
    </footer>
</div>

<div class="cd-overlay-nav">
    <span></span>
</div>
<div class="cd-overlay-content">
    <span></span>
</div>
    
<div id="call-modal" class="form-popup">
    <div class="form-container">
        <p class="modal-title">Заказать звонок</p>
        <p class="modal-subtitle">Мы перезвоним в течение <span class="nowrap">10 минут</span></p>
        <form method="post" action="success.php">
            <input type="hidden" name="title" value="Call-order"><span class="name"></span>
            <label for="name" class="columns"><input type="text" name="name" placeholder="Ваше имя" data-hint="имя"
                                                     autocomplete="off"><span class="name"></span></label>
            <label for="phone" class="columns"><input class="js-form__input--tel" type="text" name="phone" placeholder="Ваш телефон"
                                                      data-hint="телефон" autocomplete="off"><span class="phone"></span></label>
            <input type="submit" value="Заказать звонок" class="button button-green">

        </form>
    </div>
</div>
    
    <link rel="stylesheet" href="/fancy/jquery.fancybox.min.css"/>

    <script src="/fancy/jquery.fancybox.min.js"></script>
	<script src="/pages/quiz/js/jquery.mask.min.js"></script>
    <script src="/pages/quiz/js/common_scripts.min.js"></script>
	<script src="/pages/quiz/js/velocity.min.js"></script>
	<script src="/pages/quiz/js/common_functions.js"></script>
	<script src="/pages/quiz/js/func_1.js"></script>
    <script src="/pages/quiz/js/custom.js"></script>
    
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "LocalBusiness",
            "name": "ООО Патентное бюро ЖЕЛЕЗНО",
            "description": "Бесплатно проверим ваш товарный знак по закрытым базам Роспатента. Онлайн. Подберем классы МКТУ. Патентное бюро Железно - ТОП-3 регистраторов Роспатента",
            "image": "https://tovarnyj-znak.ru/images/logo.jpg",
            "telephone": "8 495 104 74 54",
            "email": "info@tovarnyj-znak.ru",
            "url": "https://tovarnyj-znak.ru",
            <?= $address ?>
            "areaServed": "Россия",
            "openingHours": ["Mo-Su"], 
            "currenciesAccepted": "RUB",
            "priceRange": "$$",
            "founder": "Александра Морозова"
        }


    </script>    

</body>
</html>