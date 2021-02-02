<?php
session_start();

$Month_r = array(
    "01" => "января",
    "02" => "февраля",
    "03" => "марта",
    "04" => "апреля",
    "05" => "мая",
    "06" => "июня",
    "07" => "июля",
    "08" => "августа",
    "09" => "сентября",
    "10" => "октября",
    "11" => "ноября",
    "12" => "декабря");

$action_start = strtotime("10 February 2020");
$action_days = ceil((time() - $action_start) / (60 * 60 * 24));
$cycles = ceil($action_days / 14);
$action_days_show = $cycles * 14 - $action_days + 1;
$action_begin = date("d.m", ($action_start + ($cycles - 1) * 14 * 60 * 60 * 24));
$action_end = date("d.m", ($action_start + $cycles * 14 * 60 * 60 * 24));
$action_end_full = explode(".", date("d.m.Y", ($action_start + $cycles * 14 * 60 * 60 * 24)));
$rus_month = $Month_r[$action_end_full[1]];
$action_end_rus_short = $action_end_full[0] . '&nbsp;' . $rus_month;
$action_end_rus = $action_end_full[0] . '&nbsp;' . $rus_month . '&nbsp;' . $action_end_full[2];
$last_year = date("Y", strtotime("-1 YEAR"));

$app->getSitePageActiveLastModified();

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

// Backgrounds
$webp = 'img';
if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false) {
    $webp = 'webp';
}

$gtm_id = $app->getVar('gtm_id') ? $app->getVar('gtm_id') : 'TJFHL4B';

$gtm_head = $app->gtm_head($gtm_id, 4000);
$gtm_head .= $app->getVar('goo_verify') ? $app->getVar('goo_verify') : '';
$gtm_head .= $app->getVar('ya_verify') ? $app->getVar('ya_verify') : '';

$gtm_body = $app->gtm_body($gtm_id);

$title = "Патентное бюро Железно, отзывы и рекомендации клиентов";
$description = "Отзывы о патентном бюро Железно. Рекомендательные письма от клиентов и партнеров.";
$keywords = "отзыв, патентный, бюро, Железно";
$work = "Мы работаем по всей России";
$h1 = "<h1>Патетнтное бюро Железно: <span>отзывы и рекомендации</span></h1>";
$og_title = "Отзывы о патентном бюро Железно и рекомендации клиентов";
$og_desc = "Патентное бюро Железно. Читайте отзывы и рекомендации клиентов на официальном сайте компании.";
$schema = "Отзывы клиентов о работе патентного бюро Железно. Рекомендательные письма и истории успешных регистраций.";
$address =  "";


foreach (['title', 'description', 'keywords', 'work', 'h1', 'og_title', 'og_desc', 'schema', 'address'] as $var_name) {
    if ($app->getVar($var_name)) {
        ${$var_name} = $app->getVar($var_name);
    }
}

?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="x-rim-auto-match" content="none">

    <title><?= $title ?></title>
    <meta name="description" content="<?= $description ?>"/>
    <meta name="keywords" content="<?= $keywords ?>"/>
    <link href="<?= $app->urlRelCanonical() ?>" rel="canonical"/>
    <link rel="shortcut icon" href="favicon.ico"/>
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Патентное бюро Железно">
    <meta property="og:url" content="<?= $app->urlRelCanonical() ?>">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:image" content="https://tovarnyj-znak.ru/images/og_image.jpg">
    <meta property="og:title" content="<?= $og_title ?>">
    <meta property="og:description" content="<?= $og_desc ?>">

    <link rel="preload" href="styles/fonts/DINPro.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-Light.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-Italic.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-MediumItalic.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-CondensedLight.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-CondensedRegular.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-CondensedMedium.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-CondensedBold.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-CondensedBoldItalic.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/RUBSN.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="dns-prefetch" href="//yastatic.net/">
    <link rel="dns-prefetch" href="//google-analytics.com/">

    <link rel="stylesheet" href="styles/critical.css">
    <!--[if lt IE 9]>
    <script src="scripts/html5.js"></script> <![endif]-->


    <?= $gtm_head ?>


    <script type="text/javascript">
        var __cs = __cs || [];
        __cs.push(["setCsAccount", "eQZbq56HiIiC2kheP3C1pDE4TUg9A1NO"]);
    </script>
    <script type="text/javascript" async src="https://app.uiscom.ru/static/cs.min.js"></script>

</head>

<body id="otzyvy">

<?= $gtm_body ?>
    
<header id="header">

    <div id="top">
        <div class="content-container">
            <div class="menu-container show-mobile">
                <span>&nbsp;</span>
                <ul class="menu">
                    <li><a href="#order-now" class="button-scroll">Оставить заявку</a></li>
                    <li><a href="#consultation" class="button-scroll">Бесплатная консультация</a></li>
                    <li><a href="#call-modal" class="fancybox">Заказать звонок</a></li>         
                </ul>
            </div>              
            <div class="columns">              
                <div class="logo">
                    <a href="/" class="img-container">
                        <picture>
                            <source srcset="images/logo.webp" type="image/webp">
                            <img src="images/logo.jpg" alt="регистрация товарных знаков" title="Патентное бюро Железно">
                        </picture>
                    </a>
                    <p>Патентное бюро</p>
                </div>
                <div class="top-middle">
                    <p><?= $work ?></p>
                </div>
                <div class="phone-block">
                    <a class="phone" href="tel:84951047454">8 495 104-74-54</a>
                    <a class="button button-light fancybox" href="#call-modal">Заказать звонок</a>
                    <a class="whatsapp" href="https://api.whatsapp.com/send?phone=79229092784<?= $whatsapp_text ?>" target="_blank"></a>
                </div>
            </div>
        </div><!-- end of content-container -->
    </div><!-- end of top -->

</header><!-- end of header -->    
    
<main id="content">    
    
    <div id="feedback-gallery" data-role="Review" data-url="/command/review/items.json">
        <div class="content-container">
            <div class="title-container">
                <h1>Патетнтное бюро Железно: <span>отзывы и рекомендации</span></h1>
            </div>            
            <div class="gallery columns" data-role="grid">
                <div class="item">
                    <a class="fancybox-gallery" data-fancybox="otzyvy" href="https://bipbap.ru/wp-content/uploads/2017/05/000001210.jpg">
                        <picture>
                            <img class="lazy" data-src="https://bipbap.ru/wp-content/uploads/2017/05/000001210.jpg" alt=""/>
                        </picture>                    
                    </a>          
                    <p class="info"><span class="name">"Название"</span>, <span class="sphere">сфера деятельности</span></p>
                </div>
                <div class="item">
                    <a class="fancybox-gallery" data-fancybox="otzyvy" href="https://i.pinimg.com/originals/ca/5c/d5/ca5cd5ff9299ccfcf9347ca7486f10e1.png">
                        <picture>
                            <img class="lazy" data-src="https://i.pinimg.com/originals/ca/5c/d5/ca5cd5ff9299ccfcf9347ca7486f10e1.png" alt=""/>
                        </picture>                    
                    </a>          
                    <p class="info"><span class="name">"Название"</span>, <span class="sphere">сфера деятельности</span></p>
                </div>
                <div class="item">
                    <a class="fancybox-gallery" data-fancybox="otzyvy" href="https://bipbap.ru/wp-content/uploads/2017/05/000001210.jpg">
                        <picture>
                            <img class="lazy" data-src="https://via.placeholder.com/255x360" alt=""/>
                        </picture>                    
                    </a>          
                    <p class="info"><span class="name">"Какое-то длинное название из нескольких слов"</span>, <span class="sphere">какое-то длинное название сферы деятельности</span></p>
                </div>
                <div class="item">
                    <a class="fancybox-gallery" data-fancybox="otzyvy" href="https://i.pinimg.com/originals/ca/5c/d5/ca5cd5ff9299ccfcf9347ca7486f10e1.png">
                        <picture>
                            <img class="lazy" data-src="https://via.placeholder.com/255x360" alt=""/>
                        </picture>                    
                    </a>          
                    <p class="info"><span class="name">"Название"</span>, <span class="sphere">сфера деятельности</span></p>
                </div> 
                <div class="item">
                    <a class="fancybox-gallery" data-fancybox="otzyvy" href="https://bipbap.ru/wp-content/uploads/2017/05/000001210.jpg">
                        <picture>
                            <img class="lazy" data-src="https://via.placeholder.com/255x360" alt=""/>
                        </picture>                    
                    </a>          
                    <p class="info"><span class="name">"Название"</span>, <span class="sphere">сфера деятельности</span></p>
                </div>
                <div class="item">
                    <a class="fancybox-gallery" data-fancybox="otzyvy" href="https://bipbap.ru/wp-content/uploads/2017/05/000001210.jpg">
                        <picture>
                            <img class="lazy" data-src="https://via.placeholder.com/255x360" alt=""/>
                        </picture>                    
                    </a>          
                    <p class="info"><span class="name">"Название"</span>, <span class="sphere">сфера деятельности</span></p>
                </div>
                <div class="item">
                    <a class="fancybox-gallery" data-fancybox="otzyvy" href="https://bipbap.ru/wp-content/uploads/2017/05/000001210.jpg">
                        <picture>
                            <img class="lazy" data-src="https://via.placeholder.com/255x360" alt=""/>
                        </picture>                    
                    </a>          
                    <p class="info"><span class="name">"Название"</span>, <span class="sphere">сфера деятельности</span></p>
                </div>
                <div class="item">
                    <a class="fancybox-gallery" data-fancybox="otzyvy" href="https://bipbap.ru/wp-content/uploads/2017/05/000001210.jpg">
                        <picture>
                            <img class="lazy" data-src="https://via.placeholder.com/255x360" alt=""/>
                        </picture>                    
                    </a>          
                    <p class="info"><span class="name">"Название"</span>, <span class="sphere">сфера деятельности</span></p>
                </div>                
            </div>
            <div class="button-container">
                <div class="button" data-role="btn_more" >Смотреть еще</div>
            </div>
            <div class="info">
                <p><span>Регистрация товарных знаков и защита интеллектуальной собственности</span> - ключевая деятельность патентного бюро Железно.</p>
                <p>Мы - компания узкого профиля.</p>
                <p>Не раздуваем перечень юридических услуг и смежных направлений, а сконцентрированы только на одном - защите интеллектуальной собственности. И стремимся довести свою работу до идеала.</p>
                <p>Мы <span>не бросаем клиентов</span> после подачи заявки на регистрацию. Наша работа заканчивается только тогда, когда <span>вы получаете свидетельство о регистрации</span>.</p>
                <p>Мы будем признательны, если и вы оставите свой отзыв о патентном бюро Железно. Пишите — <a href="mailto:chief@tovarnyj-znak.ru" class="mail nowrap">chief@tovarnyj-znak.ru</a>.</p>
            </div>
        </div><!-- end of content-container -->
    </div><!-- end of feedback-gallery -->
    
    <div id="order-now" class="order-block">
        <div class="full-width-container">
            <div class="content-container">
                <div class="title-container">
                    <p class="title">Начните регистрацию <span>прямо сейчас</span></p>
                    <p class="subtitle"><span>Пока ваш знак</span> не зарегистрировал кто-то другой</p>
                </div>
            </div><!-- end of content-container -->
        </div><!-- end of full-width-container -->
        <div class="content-container">
            <div class="columns">
                <div class="column">
                    <p class="order-block-title">Бесплатно:</p>
                    <ul>
                        <li><span>Расскажем,</span> как с помощью бренда можно зарабатывать, а ещё —  бороться с конкурентами</li>
                        <li><span>Подберем</span> классы МКТУ</li>
                        <li><span>Рассчитаем</span> итоговую стоимость гос. пошлин</li>
                        <li>Приоритет на знак за вами.</li>
                    </ul>
                    <div class="additional">
                        <p><span>Подарок — 1 год сервиса Iron Brand!</span> <sup>*</sup> при оформлении заявки <span
                                    class="action-date" data-text="до <?php echo($action_end); ?>"></span></p>
                    </div>
                </div>
                <div class="form-block">
                    <p class="vertical">Оставьте заявку!</p>
                    <div class="form-container">
                        <div class="form-container-inner">
                            <p class="form-title">Бесплатная проверка</p>
                            <p class="form-subtitle">Мы перезвоним за 10 минут</p>
                            <form method="post" action="success.php">
                                <input type="hidden" name="title" value="Main-form"><span class="name"></span>
                                <label for="name" class="columns"><input type="text" name="name" placeholder="Ваше имя"
                                                                         data-hint="имя" autocomplete="off"><span
                                            class="name"></span></label>
                                <label for="phone" class="columns"><input type="text" name="phone" placeholder="Ваш телефон"
                                                                          data-hint="телефон" autocomplete="off"><span
                                            class="phone"></span></label>
                                <label for="email" class="columns"><input type="email" name="email"
                                                                          placeholder="Email (не обязательно)"
                                                                          data-hint="email" autocomplete="off"><span
                                            class="email"></span></label>
                                <input type="submit" value="Оставить заявку" class="button button-green">
                            </form>
                            <p class="whatsapp">или <a href="https://api.whatsapp.com/send?phone=79229092784<?= $whatsapp_text ?>" target="_blank">напишите нам в Whatsapp</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end of content-container -->
    </div><!-- end of order-block -->  
    
    <div id="consultation" class="consultation">
        <div class="content-container">
            <div class="columns">
                <div class="title-container <?= $webp ?>">
                    <p class="consultation-title">Быстрая консультация</p>
                    <p class="subtitle">Наш специалист перезвонит вам <span>в течение 10 минут</span></p>
                </div>
                <div class="form-container">
                    <form method="post" action="success.php">
                        <input type="hidden" name="title" value="consultation" autocomplete="off"><span
                                class="name"></span>
                        <label for="name" class="columns"><input type="text" name="name" placeholder="Ваше имя"
                                                                 data-hint="имя" autocomplete="off"><span
                                    class="name"></span></label>
                        <label for="phone" class="columns"><input type="text" name="phone" placeholder="Ваш телефон"
                                                                  data-hint="телефон" autocomplete="off"><span
                                    class="phone"></span></label>
                        <select class="custom-list" name="usluga">
                            <option value="Регистрация товарного знака">Регистрация товарного знака</option>
                            <option value="Ускоренная регистрация товарного знака">Ускоренная регистрация товарного знака</option>
                            <option value="Продление товарного знака">Продление товарного знака</option>
                            <option value="Аннулирование товарного знака">Аннулирование товарного знака</option>
                            <option value="Другой вопрос">Другой вопрос</option>
                        </select>
                        <input type="submit" value="Есть вопрос" class="button">
                    </form>
                </div>
            </div>
        </div><!-- end of content-container -->
    </div><!-- end of consultation -->    

</main><!-- end of content -->   
    
<footer id="footer">
    <div class="content-container">
        <div class="columns">
            <div class="logo">
                <div class="img-container">
                    <picture>
                        <source class="lazy" data-src="images/logo-footer.webp" type="image/webp">
                        <img class="lazy" data-src="images/logo-footer.jpg" alt="Патентное бюро Железно"
                             title="Официальный сайт патетного бюро Железно">
                    </picture>
                </div>
                <p>Патентное бюро</p>
            </div>
            <ul id="footer-menu">
                <li><a href="/">Регистрация товарного знака</a></li>
                <li><a href="/prodlenie">Продление товарного знака</a></li>
                <li><a href="/dogovor-otchuzhdeniya-peredacha-prava">Отчуждение товарного знака</a></li>
                <li><a href="/licenzionnyj-dogovor">Лицензионный договор</a></li>
            </ul>            
            <div id="requisites">
                <p>ООО Патентное бюро "ЖЕЛЕЗНО"</p>
                <p>ИНН 4345497285</p>
                <p>ОГРН 1194350012867</p>
            </div>
            <div class="contacts">
                <a class="phone" href="tel:84951047454">8 (495) 104-74-54</a>
                <a class="email" href="mailto:info@tovarnyj-znak.ru">info@tovarnyj-znak.ru</a>
                <p class="whatsapp"><a href="https://api.whatsapp.com/send?phone=79229092784<?= $whatsapp_text ?>" target="_blank">Написать в Whatsapp</a></p>
            </div>
            <div class="copyright columns">
                <p>Все права защищены. Использование материалов разрешено только с согласия правообладателей.</p>
                <p>Полное или частичное копирование сайта запрещено и преследуется по закону.</p>
            </div>
        </div>
    </div><!-- end of content-container -->
</footer>    
    
<div id="call-modal" class="form-popup">
    <div class="form-container">
        <p class="modal-title">Заказать звонок</p>
        <p class="modal-subtitle">Мы перезвоним в течение 10 минут</p>
        <form method="post" action="success.php">
            <input type="hidden" name="title" value="otchuzhdenie"><span class="name"></span>
            <label for="name" class="columns"><input type="text" name="name" placeholder="Ваше имя" data-hint="имя"
                                                     autocomplete="off"><span class="name"></span></label>
            <label for="phone" class="columns"><input type="text" name="phone" placeholder="Ваш телефон"
                                                      data-hint="телефон" autocomplete="off"><span class="phone"></span></label>
            <input type="submit" value="Заказать звонок" class="button button-green">
        </form>
    </div>
</div>

<div id="patent-modal" class="form-popup">
    <div class="popup-container">
    </div>
</div>
    
<link rel="stylesheet" href="styles/styles.css">
<link rel="stylesheet" href="fancy/jquery.fancybox.min.css"/>

<script src="scripts/jquery.js"></script>
<script src="scripts/Review.js"></script>
<script src="scripts/custom.js"></script>
<script src="fancy/jquery.fancybox.min.js"></script>
<script src="scripts/jquery.maskedinput.js" async></script>
<script src="scripts/lazyload.min.js" async></script>
<script type="text/javascript" src="./scripts/utm_parser.js"></script>

<script type="application/ld+json">
        {
          "@context": "http://schema.org",
          "@type": "LocalBusiness",
          "name": "ООО Патентное бюро ЖЕЛЕЗНО",
          "description": "<?= $schema ?>",
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