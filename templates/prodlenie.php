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

$title = "Продление товарного знака";
$description = "Продлите срок действия регистрации товарного знака. Продление товарных знаков через патентное бюро онлайн.";
$keywords = "пролить срок действия товарного знака, продлить товарный знак";
$work = "Мы работаем по всей России";
$h1 = "<h1 class=\"blue\">Продлим Товарный знак <span class=\"nowrap\">за 6 990 руб.</span></h1>";
$delivery_geo_text = "<p>Мы отправим свидетельство о регистрации  вашего товарного знака Почтой России заказным письмом с уведомлением. На юридический адрес вашей компании.</p>
                    <p>Впрочем, мы успешно сотрудничаем с курьерскими службами, такими как DPD, DHL, СДЭК. Вы можете сказать о своем выборе доставки нашему менеджеру. Свидетельство регистрации товарного знака будет доставлен вам прямо в руки.</p>";
$address =  "";

foreach (['title', 'description', 'keywords', 'work', 'h1', 'delivery_geo_text', 'address'] as $var_name) {
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
    <meta property="og:image" content="<?= $app->urlRelCanonical() ?>/images/header-bg.jpg">
    <meta property="og:title" content="Продли срок действия своего товарного знака. Защити бизнес от конкурентов.">
    <meta property="og:description"
          content="Оставьте заявку на продение знака пока не поздно.Ускоренные схемы продления. Ускоренная работа с ФИПС">

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

<body id="prodlenie"  <?=$app->isGeo() ? 'class="geo"' : '' ?> >

<?= $gtm_body ?>

<header id="header" class="<?= $webp ?>">

    <div id="top">
        <div class="content-container">
            <div class="menu-container show-mobile">
                <span>&nbsp;</span>
                <ul class="menu">
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
                <p class="subtitle">Продлите знак <span>на 10 лет</span>!</p>
            </div>
            <div class="columns columns-new">
                <div class="form-container">
                    <div class="form-container-inner">
                        <p class="form-title">Нарушен срок продления?</p>
                        <p class="form-subtitle">6990 руб. Под ключ. Без доплат</p>
                        <form method="post" action="success.php">
                            <input type="hidden" name="title" value="Premium"><span class="name"></span>
                            <select class="custom-list" name="packages">
                                <option value="Срочное продление" data-title="Нарушен срок продления?" data-subtitle="6990 руб. Под ключ. Без доплат" data-form="Premium">Срочное продление 6990 руб.</option>                                
                                <option value="Стандартное продление 6990 руб." data-title="Продлим товарный знак" data-subtitle="6990 руб. Под ключ. Без доплат" data-form="Full">Стандартное продление 6990 руб.</option>
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
                    <li><p><span class="blue">45 дней</span> проходит от заявки до продления.</p></li>
                    <li><p><span class="blue">Продление “под ключ”</span> Без скрытых платежей и доплат. По договору.</p></li>
                    <li><p><span class="blue">Даже если срок продления прошел</span> Подготовим ходатайство. Подадим заявку в ФИПС за <span class="nowrap">24 часа</span>.</p></li>
                    <li><p><span class="blue">Вы экономите <span class="nowrap">10 000 руб.</span> на оплате гос. пошлин.</span> 30% скидка для клиентов патентного бюро Железно.</p></li>
                    <li><p><span class="blue">Даем финансовые гарантии</span> Продлим ваш знак или вернем деньги.</p></li>
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
                        <p class="new-clients"><span class="vertical">Срочно</span> Даже если вы пропустили срок
                            продления</p>
                        <p class="action-date"><span class="blue">Есть выход</span></p>
                    </div>
                    <div class="column">
                        <p class="present"><span class="green">Продлим ваш знак</span> за <span
                                    class="nowrap">6 990 руб</span></p>
                        <p class="note">&nbsp;</p>
                        <p class="present">Несем полную финансовую <span class="green">гарантию</span></p>
                        <p class="note">прописано в договоре</p>
                    </div>
                </div>
            </div><!-- end of content-container -->
        </div><!-- end of content-big-container -->
    </div><!-- end of action -->

    <div id="registration">
        <div class="content-container">
            <div class="title-container">
                <h2>Продлите срок товарного знака <span>за 3 простых шага</span></h2>
                <p class="subtitle"><span>Мы всегда на связи.</span> Подробно рассказываем о том, что происходит с
                    заявкой</p>
            </div>
            <p class="registration-subtitle">В первые <span class="green nowrap">24 часа</span> подготовим документы и подадим заявку на продление</p>
            <div class="columns">
                <div id="step1" class="step <?= $webp ?>">
                    <p class="step-title">Вы оставляете заявку</p>
                    <p>Мы перезваниваем.</p>
                    <p>Уточняем информацию о знаке.</p>
                    <p class="summary">10 минут</p>
                </div>
                <div id="step2" class="step <?= $webp ?>">
                    <p class="step-title">Заключаем договор</p>
                    <p>Формируем квитанции на оплату госпошлин со скидкой в 30%.</p>
                    <p>Подаем за вас заявку в ФИПС.</p>
                    <p class="summary">3-24 часа</p>
                </div>
                <div id="step6" class="step <?= $webp ?>">
                    <p class="step-title">Вы получаете приложение к свидетельству с новым сроком</p>
                    <p>Запись публикуется в реестрах.</p>
                    <p>Знак продлен на 10 лет.</p>
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
                    <p class="column-title"><span class="blue">Стандарт</span> - стандартное продление товарного знака
                    </p>
                    <ul>
                        <li>Подготовка документов в ФИПС</li>
                        <li>Электронная подача заявки</li>
                        <li>Расчет и формирование квитанций со скидкой в 30%</li>
                        <li>Ответы на запросы</li>
                        <li>Контроль внесения изменений в реестры</li>
                    </ul>
                    <p class="price"><span class="value">6 990</span> <span class="cur">Р</span></p>
                    <div class="button-container">
                        <a href="#order-modal" class="button fancybox" data-package="Вариант 1">Оставить заявку</a>
                    </div>
                </div>
                <div class="column big">
                    <p class="column-title"><span class="blue">Без паники</span> - продление знака в случае нарушении
                        сроков продления</p>
                    <ul>
                        <li><b>Ходатайство о продлении сроков продления</b></li>
                        <li>Подготовка документов в ФИПС</li>
                        <li>Электронная подача заявки</li>
                        <li>Расчет и формирование квитанций со скидкой в 30%</li>
                        <li>Ответы на запросы</li>
                        <li>Контроль внесения изменений в реестры</li>
                    </ul>
                    <p class="price"><span class="value">6 990</span> <span class="cur">Р</span> <span class="old"><span class="value">9 000</span> <span class="cur">Р</span></span></p>                    
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
                    <p class="title">Начните продление <span>прямо сейчас</span></p>
                    <p class="subtitle"><span>Пока ваш знак</span> не перехватил кто-то другой</p>
                </div>
            </div><!-- end of content-container -->
        </div><!-- end of full-width-container -->
        <div class="content-container">
            <div class="columns">
                <div class="column">
                    <p class="order-block-title">За Вас:</p>
                    <ul>
                        <li><span>Мы подготовим</span> все необходимые документы</li>
                        <li><span>Отправим заявку</span> в ФИПС</li>
                        <li><span>Ответим на запросы</span> экспертов</li>
                        <li><span>Рассчитаем госпошлины</span> с 30% скидкой</li>
                        <li><span>Продлим</span> ваш знак на 10 лет</li>
                    </ul>
                    <div class="additional">
                        <p><span>Ходатайство о продлении товарного знака</span> <sup>*</sup> при необходимости <span
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
                                <input type="hidden" name="title" value="Main-form"><span class="name"></span>
                                <label for="name" class="columns"><input type="text" name="name" placeholder="Ваше имя"
                                                                         data-hint="имя" autocomplete="off"><span
                                            class="name"></span></label>
                                <label for="phone" class="columns"><input type="text" name="phone"
                                                                          placeholder="Ваш телефон"
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
                                <source class="lazy" data-src="images/feedback/client_5.webp" type="image/webp">
                                <img class="lazy" data-src="images/feedback/client_5.jpg"
                                     alt="Отзыв клиента о патентном бюро Железно" title="Отзывы о патентном бюро">
                            </picture>
                        </div>
                        <div class="client-info">
                            <p><b>Пасегов Станислав</b></p>
                            <p>Индивидуальный предприниматель</p>
                            <p>Сферы деятельности: производство, розничная продажа</p>
                            <p>Работаем с 2019 года <br/>
                                Продлили <b>1 товарный знак</b>, зарегистрировали <b>2 знака</b></p>
                        </div>
                    </div>
                    <div class="text">
                        <p class="feedback-title">Несмотря на просрочку, продлили мой знак без доплат, по стандартному тарифу</p>
                        <p>С экспертами компании “Железно” я познакомился, когда другие фирмы отказались мне помочь. Спасибо бюро “Железно”! Помогли в ситуации, которая казалась безвыходной.</p>
                        <p>Дело было так:</p>
                        <p>Мы забыли, что пора продлять товарный знак. Юрист спохватилась, когда пошла уже вторая неделя просрочки.</p>
                        <p>В 2 юридических фирмах нашего города продлять знак отказались и предложили зарегистрировать его заново. А это в 5 раз дороже.</p>
                        <p class="more hidden">Я стал искать профильную компанию и попал на сайт патентного бюро“Железно”. Здесь мне не отказали, приняли заявку, несмотря на просрочку, и продлили мой знак без каких-либо доплат, по стандартному тарифу. Юристы подготовили ходатайство, оно и помогло отстоять мой знак. Не понятно только, почему фирмы, к которым я обратился в начале, этого не сделали.</p>
                        <p class="more-button"><span class="blue">Подробнее</span></p>
                    </div>
                </div>
                <div class="item">
                    <div class="client columns">
                        <div class="img-container">
                            <picture>
                                <source class="lazy" data-src="images/feedback/client_6.webp" type="image/webp">
                                <img class="lazy" data-src="images/feedback/client_6.jpg" alt="Отзывы о патентных бюро"
                                     title="Патентное бюро Железно отзыв">
                            </picture>
                        </div>
                        <div class="client-info">
                            <p><b>Мещерякова Полина</b></p>
                            <p>Исполнительный директор</p>
                            <p>Сферы деятельности: производство одежды, розничная продажа</p>
                            <p>Работаем с 2018 года. <br/> Продлили <b>2 товарных знака</b>, зарегистрировали <b>5 знаков</b></p>
                        </div>
                    </div>
                    <div class="text">
                        <p class="feedback-title">Продление товарного знака стоит 6990 руб. Другие компании берут больше.</p>
                        <p>С компанией “Железно” работаем 2 года. Сначала зарегистрировали здесь товарный знак. Качество услуг понравилось - продолжили сотрудничать.</p>
                        <p>На сегодняшний день зарегистрировали через “Железно” несколько новых знаков и продлили 2 основных. Нравится оперативность и профессионализм сотрудников. При этом очень приятные цены.</p>
                        <p>Продление товарного знака стоит 6990 руб. Другие компании берут больше. </p>
                        <p>Я не юрист и мне трудно разбираться в сложных терминах и законах, но менеджеры всегда всё пояснят, подскажут и помогут. Спасибо патентному бюро “Железно” за безупречный сервис, индивидуальный подход к клиенту и просто человеческое отношение.</p>
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

    <div id="reg-znak">
        <div class="content-container">
            <div class="title-container">
                <p class="title">Зарегистрируйте <span class="green">еще один знак</span></p>
                <a href="/" target="_blank" class="button button-green">Подробнее</a>
            </div>
        </div><!-- end of content-container -->
    </div><!-- end of reg-znak -->

    <div class="order-block">
        <div class="full-width-container">
            <div class="content-container">
                <div class="title-container">
                    <p class="title">Начните продление <span>прямо сейчас</span></p>
                    <p class="subtitle"><span>Пока ваш знак</span> не перехватил кто-то другой</p>
                </div>
            </div><!-- end of content-container -->
        </div><!-- end of full-width-container -->
        <div class="content-container">
            <div class="columns">
                <div class="column">
                    <p class="order-block-title">За Вас:</p>
                    <ul>
                        <li><span>Мы подготовим</span> все необходимые документы</li>
                        <li><span>Отправим заявку</span> в ФИПС</li>
                        <li><span>Ответим на запросы</span> экспертов</li>
                        <li><span>Рассчитаем госпошлины</span> с 30% скидкой</li>
                        <li><span>Продлим</span> ваш знак на 10 лет</li>
                    </ul>
                    <div class="additional">
                        <p><span>Ходатайство о продлении товарного знака</span> <sup>*</sup> при необходимости <span
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
                                <input type="hidden" name="title" value="Main-form"><span class="name"></span>
                                <label for="name" class="columns"><input type="text" name="name" placeholder="Ваше имя"
                                                                         data-hint="имя" autocomplete="off"><span
                                            class="name"></span></label>
                                <label for="phone" class="columns"><input type="text" name="phone"
                                                                          placeholder="Ваш телефон"
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

    <div id="faq" class="<?= $webp ?>">
        <div class="content-container">
            <div class="faq-inner">
                <div class="title-container">
                    <p class="title">5 главных вопросов <span>о продлении товарного знака</span></p>
                </div>
                <ol>
                    <li>
                        <p class="question">Когда нужно продлять знак?</p>
                        <div class="answer">
                            <p>Срок действия товарного знака составляет 10 лет с даты подачи заявки.</p>
                            <p>Заявление на продление необходимо подать в течение последнего года действия товарного знака.</p>
                            <p>Продлевать действие товарного знака можно неограниченное количество раз, каждый раз еще на десять лет.</p>
                        </div>
                    </li>
                    <li>
                        <p class="question">Сколько времени занимает продление товарного знака?</p>
                        <div class="answer">
                            <p>Срок предоставления услуги Роспатентом - <b>60 рабочих дней.</b></p>
                        </div>
                    </li>
                    <li>
                        <p class="question">Какие пошлины платятся за продление товарного знака?</p>
                        <div class="answer">
                            <p><b>При продлении товарного знака через нашу компанию</b> вы получаете скидку 30% на все пошлины Роспатента.</p>
                            <p>Стандартный размер пошлин за продление - 20000 + 1000 руб. за каждый из классов МКТУ свыше 5.</p>
                            <p>Размер пошлин при работе через нашу компанию - 14000 + 700 руб. <b>(Ваша экономия - 30%)</b></p>
                        </div>
                    </li>
                    <li>
                        <p class="question">Что делать, если не успели вовремя продлить?</p>
                        <div class="answer">
                            <p>Осуществить продление товарного знака можно в течение последнего года срока его действия. Если вы пропустили этот срок - ничего страшного. </p>
                            <p>У вас есть возможность получить <b> дополнительные 6 месяцев</b> на осуществление процедуры продления. В таком случае, необходимо одновременно подавать ходатайство о продлении срока действия товарного знака и заявление о восстановлении срока. </p>
							<p>Стандартный размер пошлин за восстановление срока - 2500 руб.</p> 
							<p>Размер пошлин при работе через нашу компанию - 1750 руб. <b>(Ваша экономия - 30%)</b></p>
							<p>P.S. Если вы просрочили срок продления более чем на 6 месяцев, то знак все-равно можно спасти. <b>Оставьте заявку, мы объясним что нужно делать в таком случае.</b></p>
							

							
                        </div>
                    </li>
                    <li>
                        <p class="question">Какие документы потребуются для продления товарного знака?</p>
                        <div class="answer">
                            <p>Только реквизиты вашей компании. Продление происходит полностью в электронном виде. Доверенность не требуется.</p>
                        </div>
                    </li>
                </ol>
            </div>
        </div><!-- end of content-container -->
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
                            <option value="Продление товарного знака">Продление товарного знака</option>
							 <option value="Регистрация товарного знака">Регистрация товарного знака</option>
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
            <input type="hidden" name="title" value="Call-order"><span class="name"></span>
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
            <input type="hidden" name="title" value=""><span class="name"></span>
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
<link rel="stylesheet" href="styles/slick-slider.css"/>
<?= $app->isGeo() ? '<link rel="stylesheet" href="styles/geo-ip.css" />' : '' ?>

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
          "description": "Регистрация товарного знака под ключ. Защитим ваш бизнес. Без скрытых платежей и переплат. За 24 часа",
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