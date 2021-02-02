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

$title = "Лицензионный договор на товарный знак с регистрацией, стоимость 9990 руб";
$description = "Регистрация лицензионного договора на товарные знаки. Разработаем договор и зарегистрируем в Роспатенте. Цена - от 9900 руб. Скидка 30% на госпошлину. Передача прав под ключ с гарантией.";
$keywords = "Лицензионный, договор, стоимость, регистрация, товарный, знак, исключительное право";
$work = "Мы работаем по всей России";
$h1 = "<h1 class=\"blue\">Лицензионный договор <span>на товарный знак</span></h1>";
$h2 = "<h2>Лицензионный договор <span>передачи права на знак</span></h2>";
$og_title = "Передача прав на товарный знак по лицензионному договору - от 9990 руб";
$og_desc = "Лицензионный договор на передачу прав под ключ. Разработаем, зарегистрируем и получим подтверждающие документы на знак. От 9990 руб. Финансовая гарантия по договору. Скидка на госпошлины - 30%.";
$schema = "Лицензионный договор для передачи прав на товарные знаки, услуги. Полное делопроизводство: подготовим договор, зарегистрируем и получим для вас подтверждающие документы. -30% на госпошлины. Патентное бюро Железно.";
$address =  "";


foreach (['title', 'description', 'keywords', 'work', 'h1', 'h2', 'og_title', 'og_desc', 'schema', 'address'] as $var_name) {
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
    <meta property="og:image" content="<?= $app->urlRelCanonical() ?>images/header-bg.jpg">
    <meta property="og:title" content="<?= $og_title ?>">
    <meta property="og:description" content="<?= $og_desc ?>">

    <link rel="preload" href="styles/fonts/DINPro.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-Light.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-Italic.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-MediumItalic.woff2" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-CondensedLight.woff2" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-CondensedRegular.woff2" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-CondensedMedium.woff2" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-CondensedBold.woff2" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="styles/fonts/DINPro-CondensedBoldItalic.woff2" as="font" type="font/woff2"
          crossorigin="anonymous">
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

<body id="license"  <?= $app->isGeo() ? 'class="geo"' : '' ?> >

<?= $gtm_body ?>
    
<header id="header" class="<?= $webp ?>">

    <div id="top">
        <div class="content-container">
            <div class="menu-container show-mobile">
                <span>&nbsp;</span>
                <ul class="menu">
                    <li><a href="#money" class="button-scroll">Что дает</a></li>
                    <li><a href="#packages" class="button-scroll">Тарифы</a></li>
                    <li><a href="#team" class="button-scroll">О нас</a></li>
                    <li><a href="#feedback" class="button-scroll">Отзывы</a></li>
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
    
    <div id="header-main">
        <div class="content-container">
            <div class="title-container">
                <div>
                    <?= $h1 ?>
                </div>
                <p class="subtitle"><span>с регистрацией в Роспатенте</span> под ключ, с фин. гарантией</p>
            </div>
            <div class="columns columns-new">
                <div class="form-container">
                    <div class="form-container-inner">
                        <p class="form-title">Лицензионный договор "под ключ"</p>
                        <p class="form-subtitle">2 мес. 9990 руб. 100% гарантия</p>
                        <form method="post" action="success.php">
                            <input type="hidden" name="title" value="Full"><span class="name"></span>
                            <select class="custom-list" name="packages">
                                <option value="Стандартный договор 9990 руб" data-title='Лицензионный договор "под ключ"' data-subtitle="2 мес. 9990 руб. 100% гарантия" data-form="Full">Стандартный договор 9990 руб</option>                                
                                <option value="Индивидуальный договор 19990 руб" data-title="Индивидуалный договор. 19990 руб." data-subtitle="Сбулицинзирование. Исключительные права. Сложные расчеты" data-form="Premium">Индивидуальный договор 19990 руб</option>
                            </select>
                            <label for="name" class="columns">
                                <input type="text" name="name" placeholder="Ваше имя" data-hint="имя" autocomplete="off">
                                <span class="name"></span>
                            </label>
                            <label for="phone" class="columns">
                                <input type="text" name="phone" placeholder="Ваш телефон" data-hint="телефон" autocomplete="off">
                                <span class="phone"></span>
                            </label>
                            <input type="submit" value="Оставить заявку" class="button button-green">
                        </form>
                        <p class="whatsapp">или <a href="https://api.whatsapp.com/send?phone=79229092784<?= $whatsapp_text ?>" target="_blank">напишите нам в Whatsapp</a></p>
                    </div>
                </div>            
                <ul class="features">
                    <li><p><span class="blue">Индивидуальный договор лицензии</span> Разработаем под вас. Учтем все риски.</p></li>
                    <li><p><span class="blue">Зарегистрируем “под ключ”</span> Без скрытых платежей и доплат.</p></li>
                    <li><p><span class="blue">45 дней</span> проходит от заявки до регистрации лицензии.</p></li>
                    <li><p><span class="blue">Вы экономите <span class="nowrap">10 000 руб.</span> на оплате гос. пошлин.</span> 30% скидка для клиентов патентного бюро Железно.</p></li>
                    <li><p><span class="blue">Даем финансовые гарантии</span> Оформим лицензию на знак или вернем деньги.</p></li>
                </ul>   
            </div>
        </div><!-- end of content-container -->
    </div><!-- end of header-main -->    

</header><!-- end of header -->    
    
<main id="content">    
    
    <div class="action">
        <div class="content-big-container">
            <div class="content-container">
                <div class="columns">
                    <div class="column">
                        <p class="new-clients"><span class="vertical">Включено</span>Разработка договора<br /> Регистрация	 в Роспатенте</p>
                        <p class="action-date"><span class="blue">Железно</span></p>
                    </div>
                    <div class="column">
                        <p class="present"><span class="green">Договор под ключ с регистрацией</span> за <span class="nowrap">9 990 руб</span></p>
                        <p class="note hide-mobile">&nbsp;</p>
                        <p class="present">Несем полную финансовую <span class="green">гарантию</span></p>
                        <p class="note">прописано в договоре</p>
                    </div>
                </div>
            </div><!-- end of content-container -->
        </div><!-- end of content-big-container -->
    </div><!-- end of action --> 
    
    <div id="spheres">
        <div class="content-container">
            <div class="inner">
                <div class="title-container">
                    <?= $h2 ?>
                    <p class="subtitle"><span>Когда необходим?</span> 4 стандартные ситуации</p>
                </div>
                <div id="sphere-slider" class="columns">
                    <div> 
                        <div id="sale-rights" class="sphere <?= $webp ?>">
                            <p class="sphere-title">Законные схемы оптимизации налогов</p>
                            <p><span>В вашем бизнесе несколько юр. лиц. Вы можете экономить 9%</span></p>
                            <p>Оформив лицензию на использование товарного знака, вы даете своей бухгалтерии дополнительные возможности оптимизации налогов. <b>Подробности ниже</b></p>
                            <p></p>
                        </div>
                    </div>
                    <div>
                        <div id="sale-trademark" class="sphere <?= $webp ?>">
                            <p class="sphere-title">Деньги из воздуха</p>
                            <p><span>Используйте свой знак на 100%</span></p>
                            <p>Даже самый активный бизнес не использует больше 10% от перечня товаров или услуг, в которых он зарегистрирован.</p>
                            <p>Кому-то нужен выпуск одного товара под вашим брендом, и вы всегда сможете договориться об аренде знака только в рамках определенного ограничения.</p>
                        </div>
                    </div>
                    <div>
                        <div id="distributor-search" class="sphere <?= $webp ?>">
                            <p class="sphere-title">Франшиза</p>
                            <p><span>Франшиза подразумевает передачу прав на использование знака.</span></p>
                            <p>Оформление происходит через лицензионный договор</p>
                            <p><b>Другая ситуация: </b>есть несколько претендентов-дистрибьюторов, но вы не знаете, кто из них эффективнее. Оформив неисключительную лицензию, вы предоставите право работать с вами всем. А потом оставите лучшего в своей команде. </p>
                        </div>
                    </div>
                    <div>
                        <div id="business-expansion" class="sphere <?= $webp ?>">
                            <p class="sphere-title">Отказали в регистрации знака</p>
                            <p><span>Вы не смогли зарегистрировать свой знак, так как есть уже подобный. Вы не можете позволить себе ребрендинг.</span> Можно договориться с действующим владельцем и заключить лицензионный договор на право использования. Указать виды товаров и услуг, территорию,  срок действия договора и прописать стоимость лицензирования. Владельцы знаков охотно идут навстречу, ведь в этой ситуации все выигрывают.</p>
                        </div>
                    </div>                        
                </div>
                <div class="img-container">
                    <picture>
                        <source class="lazy" data-src="images/sphere-man.webp" type="image/webp">
                        <img class="lazy" data-src="images/sphere-man.png" alt="Лицензионный договор на товарный знак"
                             title="Лицензионный договор на интеллектуальную собственность">
                    </picture>
                </div>
            </div>
        </div><!-- end of content-container -->
    </div><!-- end of spheres -->

    <div id="money">
        <div class="content-container">
            <div class="columns">
                <div class="column">
                    <p class="additional-title"><span>Кроме этого, </span>новый владелец товарного знака может:</p>
                    <ul>
                        <li><span>Легально снизить налоги </span>ИП&nbsp;&mdash; директор компании и владелец знака, ООО&nbsp;&mdash;
                            ведет деятельность, и перечисляет деньги ИП за использование товарного знака. 9% экономите
                            на налогах и выводите наличность. По опыту наших клиентов, затраты на оформление знака <b>окупаются
                                только за счет экономии на налогах за 4&ndash;5 месяцев</b>.
                        </li>
                        <li><span>Взыскать с тех, кто использует товарный знак до <span
                                        class="nowrap">5 000 000 руб.</span></span> Цветочный магазин «Макси Флора»
                            <span class="nowrap">(г. Киров)</span> взыскал со своего конкурента <span class="nowrap">500 тыс. руб.</span>
                            за использование своего названия в контекстной рекламе Яндекса. Ежегодно в России
                            рассматривается <b>~ 25 000 подобных дел</b>.
                        </li>
                        <li><span>Защитить свой бизнес от патентных троллей и конкурентов</span> Интернет-магазин
                            Names.ru работал с <span class="nowrap">1998 г.</span>, оборот <span
                                    class="nowrap">2 млрд</span> в год. В <span class="nowrap">2008 г.</span> компания
                            <span class="nowrap">ООО «Неймс»</span> регистрирует товарный знак NAMES и через суд
                            запрещает работу магазина. На сегодня сайт names.ru не работает, срок апелляции истек. <b>Такое
                                может произойти с каждым!</b></li>
                    </ul>
                </div>
            </div>
        </div><!-- end of content-container -->
    </div><!-- end of money -->   
    
    <div id="registration">
        <div class="content-container">
            <div class="title-container">
                <h3>Лицензия на товарный знак или ПО <span>за 3 простых шага</span></h3>
                <p class="subtitle"><span>Мы всегда на связи.</span> Подробно рассказываем о том, что происходит с заявкой</p>
            </div>
            <p class="registration-subtitle">Учтем все возможные риски. Разработаем для вас индивидуальный договор.</p>
            <div class="columns">
                <div id="step1" class="step <?= $webp ?>">
                    <p class="step-title">Вы оставляете заявку</p>
                    <p>Мы перезваниваем.</p>
                    <p>Обсуждаем условия лицензирования.</p>
                    <p class="summary">10 минут</p>
                </div>
                <div id="step2" class="step <?= $webp ?>">
                    <p class="step-title">Мы работаем с Роспатентом</p>
                    <p>Разрабатываем и согласуем с вами лицензионный договор.</p>
                    <p>Формируем квитанции на оплату госпошлин со скидкой в 30%.</p>
                    <p>Отправляем договор в Роспатент.</p>
                    <p class="summary">24 часа</p>
                </div>
                <div id="step6" class="step <?= $webp ?>">
                    <p class="step-title">Вы получаете оригинал лицензионного договора, зарегистрированный Роспатентом</p>
                    <p>Запись публикуется в реестрах.</p>
                    <p>Права нового владельца подтверждены.</p>
                    <p class="summary">до 2 месяцев</p>
                </div>
            </div>
        </div><!-- end of content-container -->
    </div><!-- end of registration --> 
    
    <div id="packages">
        <div class="content-container">
            <div class="title-container">
                <p class="title">2 железных варианта <span>сотрудничества</span></p>
                <p class="subtitle"><span>Цены на услуги фиксированные</span> Никаких доплат и скрытых платежей</p>
            </div>
            <div class="columns">
                <div class="column small">
                    <p class="column-title"><span class="blue">Стандарт</span> - стандартное лицензирование. Известны срок, стоимость и территория.</p>
                    <ul>
                        <li>Проверка полномочий правообладателя и отсутствия обременений объекта;</li>
                        <li>Подготовка лицензионного договора;</li>
                        <li>Консультации;</li>
                        <li>Подача документов в Роспатент;</li>
                        <li>Ответы на запросы Роспатента;</li>
                        <li>Полное делопроизводство;</li>
                        <li>Получение оригинала лицензии.</li>
                     </ul>
                    <p class="price"><span class="value">9 990</span> <span class="cur">Р</span></p>
                    <div class="button-container">
                        <a href="#order-modal" class="button fancybox" data-package="Вариант 1">Оставить заявку</a>
                    </div>
                </div>
                <div class="column big">
                    <p class="column-title"><span class="blue">Персональный</span> - тариф при сложных условиях оплаты, расторжения и применения договора. Сублицензия. Исключительные права.</p>
                    <ul>
                        <li>Проверка полномочий правообладателя и отсутствия обременений объекта;</li>
                        <li><b>Подготовка индивидуального лицензионного договора;</b></li>
                        <li>Консультации;</li>
                        <li>Подача документов в Роспатент;</li>
                        <li>Ответы на запросы Роспатента;</li>
                        <li>Полное делопроизводство;</li>
                        <li>Получение оригинала лицензии.</li>
                    </ul>
                    <p class="price"><span class="value">19 990</span> <span class="cur">Р</span> <span class="old"><span class="value">24 900</span> <span class="cur">Р</span></span></p>
                    <div class="button-container">
                        <a href="#order-modal" class="button fancybox" data-package="Вариант 2">Оставить заявку</a>
                    </div>
                </div>
            </div>
        </div><!-- end of content-container -->
    </div><!-- end of packages -->   
    
</main><!-- end of content -->   
    
<section id="additional-blocks">
    
    <div class="order-block">
        <div class="full-width-container">
            <div class="content-container">
                <div class="title-container">
                    <p class="title">Предоставьте права на интеллектуальную собственность <span>новому владельцу</span></p>
                    <p class="subtitle"><span>Индивидуальный лицензионный договор.</span> Учтем все риски.</p>
                </div>
            </div><!-- end of content-container -->
        </div><!-- end of full-width-container -->
        <div class="content-container">
            <div class="columns">
                <div class="column">
                    <p class="order-block-title">За Вас:</p>
                    <ul>
                        <li><span>Подготовим</span> все необходимые документы</li>
                        <li><span>Оформим</span> договор лицензирования</li>
                        <li><span>Зарегистрируем договор</span> в Роспатенте</li>
                        <li><span>Рассчитаем госпошлины</span> с 30% скидкой</li>
                        <li><span>Добавим</span> совладельца товарного знака</li>
                    </ul>
                    <div class="additional">
                        <p><span>Скидка при лицензировании 2 и более продуктов</span> <sup>*</sup> при оформлении заявки <span
                                    class="action-date" data-text="до <?php echo($action_end); ?>"></span></p>
                    </div>
                </div>
                <div class="form-block">
                    <p class="vertical">Оставьте заявку!</p>
                    <div class="form-container">
                        <div class="form-container-inner">
                            <p class="form-title">Бесплатная консультация</p>
                            <p class="form-subtitle">Мы перезвоним в течение 10 минут</p>
                            <form method="post" action="success.php">
                                <input type="hidden" name="title" value="license"><span class="name"></span>
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
    
    <div id="team">
        <div class="content-container">
            <div class="title-container">
                <p class="title">Защитите свой бизнес <span>вместе с ЖЕЛЕЗНО</span></p>
            </div>
            <div class="columns">
                <div class="column">
                    <p class="subtitle">Видео о компании</p>
                    <div id="video-team" class="video"></div>
                    <p class="subtitle">История патентного бюро:</p>
                    <p>2013 год - На нашу производственную компанию напали патентные тролли. Бизнес оказался под
                        угрозой. Патентные бюро не смогли нас защитить. Судебные процессы.</p>
                    <p>2014 год - Ценой проб и ошибок мы отстояли свой бизнес. И поняли, что интеллектуальная
                        собственность – главнейший актив любой компании.</p>
                    <p>2015 год – Создание патентного отдела. Учеба в ВОИС ( Швейцария), курсы ФИПС, академия
                        Сколково.</p>
                    <p>2016 год – Выделение отдела в отдельный бизнес и первые внешние клиенты.</p>
                    <p>2018 год – Патентное бюро полного цикла. От стратегии по защите интеллектуальной собственности до
                        полной ее реализации.</p>
                </div>
                <div class="column">
                    <p class="subtitle">Сотрудники Патентного бюро</p>
                    <div id="team-slider">
                        <a class="fancybox-gallery" data-fancybox="team"
                           data-caption="Морозова Александра, управляющий патентного бюро"
                           href="images/team/sotrudnik1.jpg">
                            <picture>
                                <source class="lazy" data-src="images/team/sotrudnik1-mini.webp" type="image/webp">
                                <img class="lazy" data-src="images/team/sotrudnik1-mini.jpg" alt=""/>
                            </picture>
                            <p class="team-info">
                                <span class="team-name">Морозова Александра</span>
                                <span class="team-position">Управляющий патентного бюро</span>
                            </p>
                        </a>
                        <a class="fancybox-gallery" data-fancybox="team"
                           data-caption="Овсянникова Наталья, патентный поверенный" href="images/team/sotrudnik2.jpg">
                            <picture>
                                <source class="lazy" data-src="images/team/sotrudnik2-mini.webp" type="image/webp">
                                <img class="lazy" data-src="images/team/sotrudnik2-mini.jpg" alt=""/>
                            </picture>
                            <p class="team-info">
                                <span class="team-name">Овсянникова Наталья</span>
                                <span class="team-position">Патентный поверенный</span>
                            </p>
                        </a>
                        <a class="fancybox-gallery" data-fancybox="team"
                           data-caption="Лучинина Елена, руководитель отдела сопровождения"
                           href="images/team/sotrudnik3.jpg">
                            <picture>
                                <source class="lazy" data-src="images/team/sotrudnik3-mini.webp" type="image/webp">
                                <img class="lazy" data-src="images/team/sotrudnik3-mini.jpg" alt=""/>
                            </picture>
                            <p class="team-info">
                                <span class="team-name">Лучинина Елена</span>
                                <span class="team-position">Руководитель отдела сопровождения</span>
                            </p>
                        </a>
                        <a class="fancybox-gallery" data-fancybox="team"
                           data-caption="Шаклеин Александр, помощник патентного поверенного"
                           href="images/team/sotrudnik4.jpg">
                            <picture>
                                <source class="lazy" data-src="images/team/sotrudnik4-mini.webp" type="image/webp">
                                <img class="lazy" data-src="images/team/sotrudnik4-mini.jpg" alt=""/>
                            </picture>
                            <p class="team-info">
                                <span class="team-name">Шаклеин Александр</span>
                                <span class="team-position">Помощник патентного поверенного</span>
                            </p>
                        </a>
                        <a class="fancybox-gallery" data-fancybox="team"
                           data-caption="Ваймер Антонина, помощник патентного поверенногоа"
                           href="images/team/sotrudnik5.jpg">
                            <picture>
                                <source class="lazy" data-src="images/team/sotrudnik5-mini.webp" type="image/webp">
                                <img class="lazy" data-src="images/team/sotrudnik5-mini.jpg" alt=""/>
                            </picture>
                            <p class="team-info">
                                <span class="team-name">Ваймер Антонина</span>
                                <span class="team-position">Помощник патентного поверенного</span>
                            </p>
                        </a>
                        <a class="fancybox-gallery" data-fancybox="team"
                           data-caption="Большаов Дмитрий, руководитель патентного отдела"
                           href="images/team/sotrudnik6.jpg">
                            <picture>
                                <source class="lazy" data-src="images/team/sotrudnik6-mini.webp" type="image/webp">
                                <img class="lazy" data-src="images/team/sotrudnik6-mini.jpg" alt=""/>
                            </picture>
                            <p class="team-info">
                                <span class="team-name">Большаков Дмитрий</span>
                                <span class="team-position">Руководитель патентного отдела</span>
                            </p>
                        </a>
                        <a class="fancybox-gallery" data-fancybox="team"
                           data-caption="Никулина Дина, специалист по сопровождению клиентов"
                           href="images/team/sotrudnik7.jpg">
                            <picture>
                                <source class="lazy" data-src="images/team/sotrudnik7-mini.webp" type="image/webp">
                                <img class="lazy" data-src="images/team/sotrudnik7-mini.jpg" alt=""/>
                            </picture>
                            <p class="team-info">
                                <span class="team-name">Никулина Дина</span>
                                <span class="team-position">Специалист по сопровождению клиентов</span>
                            </p>
                        </a>
                        <a class="fancybox-gallery" data-fancybox="team"
                           data-caption="Ермаков Александр, эксперт по доработке знаков"
                           href="images/team/sotrudnik8.jpg">
                            <picture>
                                <source class="lazy" data-src="images/team/sotrudnik8-mini.webp" type="image/webp">
                                <img class="lazy" data-src="images/team/sotrudnik8-mini.jpg" alt=""/>
                            </picture>
                            <p class="team-info">
                                <span class="team-name">Ермаков Александр</span>
                                <span class="team-position">Эксперт по доработке знаков</span>
                            </p>
                        </a>
                        <a class="fancybox-gallery" data-fancybox="team"
                           data-caption="Бабинцева Наталья, эксперт по документообороту"
                           href="images/team/sotrudnik9.jpg">
                            <picture>
                                <source class="lazy" data-src="images/team/sotrudnik9-mini.webp" type="image/webp">
                                <img class="lazy" data-src="images/team/sotrudnik9-mini.jpg" alt=""/>
                            </picture>
                            <p class="team-info">
                                <span class="team-name">Бабинцева Наталья</span>
                                <span class="team-position">Эксперт по документообороту</span>
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div><!-- end of content-container -->
    </div><!-- end of team -->

    <?php
    /* towns-robbers */

    //if (isset($_GET['test'])){
    $domain = $app->moduleDomain;
    if ($domain->isDefDomain()) {
        $block_name_var = 'includes';
        $block_clear = 'cities';
        $file = $app->getLayoutDir() . '/' . $block_name_var . '/' . $block_clear . '.php';

        if (file_exists($file)) {
            include_once $file;
        }
    }

    if ($domain->isDomainGeo()) {

        if (count($app->getReestrItemsDomainActive()) == 0) {
            $block_name_var = 'includes';
            $block_clear = 'cities_zero';
            $file = $app->getLayoutDir() . '/' . $block_name_var . '/' . $block_clear . '.php';

            if (file_exists($file)) {
                include_once $file;
            }
        } else {

            $block_name_var = 'includes';
            $block_clear = 'cities_hero';
            $file = $app->getLayoutDir() . '/' . $block_name_var . '/' . $block_clear . '.php';

            if (file_exists($file)) {
                include_once $file;
            }

        }


    }
    //}

    ?>


    <div id="feedback">
        <div class="content-container">
            <div class="title-container">
                <h3>Реальные отзывы<span>о бюро Железно</span></h3>
            </div>
            <div id="feedback-slider" class="columns">
                <div class="item">
                    <div class="client columns">
                        <div class="img-container">
                            <picture>
                                <source class="lazy" data-src="images/feedback/client_9.webp" type="image/webp">
                                <img class="lazy" data-src="images/feedback/client_9.jpg"
                                     alt="Отзыв клиента о патентном бюро Железно" title="Отзывы о патентном бюро">
                            </picture>
                        </div>
                        <div class="client-info">
                            <p><b>Татаринов Арсений</b></p>
                            <p>Генеральный директор, собственник бизнеса</p>
                            <p>Сфера деятельности - производство, оптовые продажи</p>
                            <p>Работаем с 2018 года<br/>Оформлен <b>1 лицензионный договор</b>, зарегистрировано<span class="nowrap"><b> 2 товарных знака</b></span></p>
                        </div>
                    </div>
                    <div class="text">
                        <p class="feedback-title">Регистрация лицензии - 2 месяца, без задержек и неожиданностей.</p>
                        <p>Мы искали дистрибьюторов в регионах. По нашей бизнес-модели, в каждой области должен быть только 1 агент, поэтому лучшего выбирали на конкурсной основе.</p>
                        <p>Для этого разработали неисключительную лицензию на срок 6 месяцев. По результатам продаж за этот период самый сильный продавец на рынке был определен. Ему и предоставили исключительное право на 5 лет по договору лицензирования.</p>
                        <p>Оба договора (на исключительную и неисключительную лицензию) разработало для нас патентное бюро “Железно”. Регистрация лицензии - 2 месяца, без задержек и неожиданностей.</p>
                        <p>Выражаю благодарность коллективу патентного бюро за слаженную и грамотную работу. Будем сотрудничать с вами и дальше.</p>
                    </div>
                </div>
                <div class="item">
                    <div class="client columns">
                        <div class="img-container">
                            <picture>
                                <source class="lazy" data-src="images/feedback/client_10.webp" type="image/webp">
                                <img class="lazy" data-src="images/feedback/client_10.jpg" alt="Отзывы о патентных бюро"
                                     title="Патентное бюро Железно отзыв">
                            </picture>
                        </div>
                        <div class="client-info">
                            <p><b>Куликова Евгения</b></p>
                            <p>Индивидуальный предприниматель</p>
                            <p>Сфера деятельности - ритейл</p>
                            <p>Работаем с 2019 года<br/>Оформлен <b>1 лицензионный договор</b>, зарегистрирован <span class="nowrap"><b>1 товарный знак</b></span></p>
                        </div>
                    </div>
                    <div class="text">
                        <p class="feedback-title">Лучше бы я сразу обратилась сюда. Пошлины через бюро оплачиваются со скидкой 30%, да и компания отвечает за результат.</p>
                        <p>У меня свой бизнес по продаже товаров для творчества и детских игрушек. Решив открыть новую точку в торговом центре, столкнулась с проблемой. Администрация требовала свидетельство о том, что название моего магазина зарегистрировано в Роспатенте как товарный знак.</p>
                        <p>Конечно же, мой бренд не был зарегистрирован. Я решила регистрироваться самостоятельно и сразу получила отказ от Роспатента. Аналогичный знак уже был занят. Деньги, потраченные на госпошлину, я потеряла - скупой платит дважды.</p>
                        <p class="more hidden">Спасибо патентному бюро “Железно”. Здесь мне подсказали, что можно заключить лицензионный договор с собственником мешающего знака, тем более, что в нужном мне классе МКТУ наши бизнесы не пересекались.</p>
                        <p class="more hidden">Специалисты из “Железно” разработали лицензионный договор для моего случая, помогли связаться с собственником похожего знака и оформили передачу прав в Роспатенте.</p>
                        <p class="more hidden">Лучше бы я сразу обратилась сюда. Пошлины через бюро оплачиваются со скидкой 30%, да и компания отвечает за результат. После этого случая зарегистрировала в “Железно” еще 1 торговый знак! Всем рекомендую эту компанию.</p>
                        <p class="more-button"><span class="blue">Подробнее</span></p>
                    </div>
                </div>
            </div>
            <div class="title-container">
                <p class="title">Не все верят отзывам в интернете, <span>поэтому ...</span></p>
                <p class="subtitle">Мы подготовили для вас сканы писем наших клиентов. <span>Убедитесь сами!</span></p>
            </div>
            <div class="gallery gallery-3 columns">
                <div class="item-3">
                    <a class="fancybox-gallery" data-fancybox="otzyvy" href="images/feedback/otzyv1.jpg">
                        <picture>
                            <source class="lazy" data-src="images/feedback/otzyv1-mini.webp" type="image/webp">
                            <img class="lazy" data-src="images/feedback/otzyv1-mini.jpg" alt=""/>
                        </picture>
                    </a>
                    <p class="info"><span>"Гоу Мобайл"</span>, Рекламное агенство</p>
                </div>
                <div class="item-3">
                    <a class="fancybox-gallery" data-fancybox="otzyvy" href="images/feedback/otzyv2.jpg">
                        <picture>
                            <source class="lazy" data-src="images/feedback/otzyv2-mini.webp" type="image/webp">
                            <img class="lazy" data-src="images/feedback/otzyv2-mini.jpg" alt=""/>
                        </picture>
                    </a>
                    <p class="info"><span>"Умное топливо"</span>, Производство угольных брикетов</p>
                </div>
                <div class="item-3">
                    <a class="fancybox-gallery" data-fancybox="otzyvy" href="images/feedback/otzyv3.jpg">
                        <picture>
                            <source class="lazy" data-src="images/feedback/otzyv3-mini.webp" type="image/webp">
                            <img class="lazy" data-src="images/feedback/otzyv3-mini.jpg" alt=""/>
                        </picture>
                    </a>          
                    <p class="info"><span>"Черный кант"</span>, Производство одежды и обуви</p>
                </div>            
            </div> 
            <div class="button-container">
                <a class="button" href="/otzyvy" target="_blank">Еще отзывы</a>
            </div>
        </div><!-- end of content-container -->
    </div><!-- end of feedback -->  
    
    <div class="order-block">
        <div class="full-width-container">
            <div class="content-container">
                <div class="title-container">
                    <p class="title">Предоставьте права на интеллектуальную собственность <span>новому владельцу</span></p>
                    <p class="subtitle"><span>Индивидуальный лицензионный договор.</span> Учтем все риски.</p>
                </div>
            </div><!-- end of content-container -->
        </div><!-- end of full-width-container -->
        <div class="content-container">
            <div class="columns">
                <div class="column">
                    <p class="order-block-title">За Вас:</p>
                    <ul>
                        <li><span>Подготовим</span> все необходимые документы</li>
                        <li><span>Оформим</span> договор лицензирования</li>
                        <li><span>Зарегистрируем договор</span> в Роспатенте</li>
                        <li><span>Рассчитаем госпошлины</span> с 30% скидкой</li>
                        <li><span>Добавим</span> совладельца товарного знака</li>
                    </ul>
                    <div class="additional">
                        <p><span>Скидка при лицензировании 2 и более продуктов</span> <sup>*</sup> при оформлении заявки <span
                                    class="action-date" data-text="до <?php echo($action_end); ?>"></span></p>
                    </div>
                </div>
                <div class="form-block">
                    <p class="vertical">Оставьте заявку!</p>
                    <div class="form-container">
                        <div class="form-container-inner">
                            <p class="form-title">Бесплатная консультация</p>
                            <p class="form-subtitle">Мы перезвоним в течение 10 минут</p>
                            <form method="post" action="success.php">
                                <input type="hidden" name="title" value="license"><span class="name"></span>
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
    
    <!--<div id="faq" class="<?= $webp ?>">
        <div class="content-container">
            <div class="faq-inner">
                <div class="title-container">
                    <p class="title">5 главных вопросов <span>о смене владельца товарного знака</span></p>
                </div>
                <ol>
                    <li>
                        <p class="question">Обязательно ли участие патентного поверенного в регистрации передачи знака?</p>
                        <div class="answer">
                            <p>Не обязательно, но без него высока вероятность технических ошибок, ведущих к отказу от регистрации договора или её задержке. Патентный поверенный участвует в составлении договора продажи знака и подает документы в ведомство. У патентных поверенных, работающих с ведомством онлайн, есть 30% скидка при уплате госпошлин.</p>
                            <p><b>Наш патентный поверенный - Овсянникова Наталья св-во №821</b></p>
                        </div>
                    </li>
                    <li>
                        <p class="question">Какова процедура передачи прав на товарный знак?</p>
                        <div class="answer">
                            <p>Чтобы договор продажи товарного знака вошёл в силу, его регистрируют в патентном ведомстве с внесением записи в Госреестр товарных знаков. При этом выплачивается госпошлина. Иногда при частичной уступке предварительно вносят изменения в Госреестр, удаляя из-под охраны товарные позиции, однородные передаваемым.</p>
                        </div>
                    </li>
                    <li>
                        <p class="question">Какие бывают виды передачи прав на товарный знак?</p>
                        <div class="answer">
                            <p>Права на товарный знак могут передаваться окончательно (продаваться) или передаваться на время по лицензии. Продажа может быть полной - по всем группам товаров и услуг, для которых зарегистрирован знак, или частичной, когда знак передается лишь по части позиций. При частичной уступке нельзя разделять однородные группы товаров.</p>
                        </div>
                    </li>
                    <li>
                        <p class="question">Может ли одно обозначение принадлежать разным владельцам?</p>
                        <div class="answer">
                            <p>Да, если знаки зарегистрированы в разных патентных зонах, или если их владельцы, используют их для обозначения отличающихся товаров или услуг. В международном классификаторе выделены 45 классов товаров и услуг. Можно владеть и частью класса.</p>
                        </div>
                    </li>
                    <li>
                        <p class="question">Каковы сроки регистрации передачи прав на знак?</p>
                        <div class="answer">
                            <p>Регистрация договора продажи прав на товарный знак в отсутствие возражений экспертизы занимает до 2 месяцев. Ошибки в договоре, необходимость внесения предварительных изменений в Госреестр товарных знаков могут увеличить этот срок. <b>Средний срок клиентов патентного бюро ЖЕЛЕЗНО - 45 дней.</b></p>
                        </div>
                    </li>
                </ol>
            </div>
        </div><!-- end of content-container
    </div><!-- end of faq -->    
    
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
                            <option value="Передача прав на товарный знак">Передача прав на товарный знак</option>
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

</section><!-- end of additional-blocks -->    
    
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
            <input type="hidden" name="title" value="license"><span class="name"></span>
            <label for="name" class="columns"><input type="text" name="name" placeholder="Ваше имя" data-hint="имя"
                                                     autocomplete="off"><span class="name"></span></label>
            <label for="phone" class="columns"><input type="text" name="phone" placeholder="Ваш телефон"
                                                      data-hint="телефон" autocomplete="off"><span class="phone"></span></label>
            <input type="submit" value="Заказать звонок" class="button button-green">
        </form>
    </div>
</div>

<div id="order-modal" class="form-popup">
    <div class="form-container">
        <p class="modal-title">Оставить заявку</p>
        <p class="modal-subtitle">Мы перезвоним в течение 10 минут</p>
        <form method="post" action="success.php">
            <input type="hidden" name="title" value="otchuzhdenie"><span class="name"></span>
            <label for="name" class="columns"><input type="text" name="name" placeholder="Ваше имя" data-hint="имя"
                                                     autocomplete="off"><span class="name"></span></label>
            <label for="phone" class="columns"><input type="text" name="phone" placeholder="Ваш телефон"
                                                      data-hint="телефон" autocomplete="off"><span class="phone"></span></label>
            <label for="email" class="columns"><input type="email" name="email" placeholder="Email (не обязательно)"
                                                      data-hint="email" autocomplete="off"><span
                        class="email"></span></label>
            <input type="hidden" name="package" value="">
            <input type="submit" value="Оставить заявку" class="button button-green">
        </form>
    </div>
</div>

<div id="patent-modal" class="form-popup">
    <div class="popup-container">
    </div>
</div>
    
<link rel="stylesheet" href="styles/styles.css">
<link rel="stylesheet" href="fancy/jquery.fancybox.min.css"/>
<link rel="stylesheet" href="styles/slick-slider.min.css"/>
<?=  $app->isGeo() ? '<link rel="stylesheet" href="styles/geo-ip.css" />' : '' ?>

<script src="scripts/jquery.js"></script>
<script src="scripts/custom.js"></script>
<script src="fancy/jquery.fancybox.min.js"></script>
<script src="scripts/jquery-spincrement.js"></script>
<script src="scripts/slick-slider.min.js"></script>
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
<script type="text/javascript">
    $('a[href="#order-modal"]').eq(0).on('click', function() {
        console.log(1);
        $('#order-modal').find('input[name="title"]').val("Full")
    });
    $('a[href="#order-modal"]').eq(1).on('click', function() {
        console.log(2);
        $('#order-modal').find('input[name="title"]').val("Premium")
    });

    
    $('a[href="#order-modal"]').eq(2).on('click', function() {
        console.log(3);
        $('#order-modal').find('input[name="title"]').val("Self")
    });
    window.dataLayer = window.dataLayer || [];
</script>
</body>
</html>    