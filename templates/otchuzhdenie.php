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

$title = "Договор отчуждения товарного знака, передача прав на знак";
$description = " Оформим передачу прав на товарный знак через договор отчуждения. Регистрация договора уступки в Роспатенте под ключ с финансовой гарантией. Цена 9990 руб.";
$keywords = "договор отчуждения товарного знака, передача прав на товарный знак, смена владельца товарного знака";
$work = "Мы работаем по всей России";
$h1 = "<h1 class=\"blue\">Отчуждение прав на товарный знак <span class=\"nowrap\">за 9 990 руб.</span></h1>";
$h2 = "<h2>Когда необходимо передать <span>товарный знак?</span></h2>";
$delivery_geo_text = "<p>Мы отправим свидетельство о регистрации  вашего товарного знака Почтой России заказным письмом с уведомлением. На юридический адрес вашей компании.</p>
                    <p>Впрочем, мы успешно сотрудничаем с курьерскими службами, такими как DPD, DHL, СДЭК. Вы можете сказать о своем выборе доставки нашему менеджеру. Свидетельство регистрации товарного знака будет доставлен вам прямо в руки.</p>";
$address =  "";


foreach (['title', 'description', 'keywords', 'work', 'h1', 'h2', 'delivery_geo_text', 'address'] as $var_name) {
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
    <meta property="og:title" content="Подготовка и регистрация договора уступки прав на товарный знак">
    <meta property="og:description"
          content="Соберем необходимые документы по передаче прав на товарный знак. Смена владельца товарного знака за 9 990 руб.">

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

<body id="otchuzhdenie"  <?= $app->isGeo() ? 'class="geo"' : '' ?> >

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
                <p class="subtitle"><span>Под ключ,</span> с фин. гарантией</p>
            </div>
            <div class="columns columns-new">
                <div class="form-container">
                    <div class="form-container-inner">
                        <p class="form-title">Акция! Смена владельца с гарантией. </p>
                        <p class="form-subtitle">Под ключ. Без доплат. 9990 руб.</p>
                        <form method="post" action="success.php">
                            <input type="hidden" name="title" value="Premium"><span class="name"></span>
                            <select class="custom-list" name="packages">
                                <option value="Отчуждение прав под ключ 9990 руб" data-title="Акция! Смена владельца с гарантией." data-subtitle="Под ключ. Без доплат. 9990 руб." data-form="Premium">Отчуждение прав под ключ 9990 руб</option>
                                <option value="Простой договор отчуждения 9990 руб" data-title="Договор на переуступку прав." data-subtitle="Составим. Проконсультируем. Оформим" data-form="Full">Простой договор отчуждения 9990 руб</option>
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
                    <li><p><span class="blue">За 24 часа подадим заявление в ФИПС</span> Соберем данные по знаку. Подготовим договор.</p></li>
                    <li><p><span class="blue">Отчуждение “под ключ”</span> Без скрытых платежей и доплат.  По договору.</p></li>
                    <li><p><span class="blue">45 дней</span> проходит от заявки до смены владельца.</p></li>
                    <li><p><span class="blue">Вы экономите <span class="nowrap">10 000 руб.</span> на оплате гос. пошлин.</span> 30% скидка для клиентов патентного бюро Железно.</p></li>
                    <li><p><span class="blue">Даем финансовые гарантии</span> Оформим отчуждение прав на знак или вернем деньги.</p></li>
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
                        <p class="new-clients"><span class="vertical">Сегодня</span>Без доплат в процессе работы <br /> Без скрытых платежей</p>
                        <p class="action-date"><span class="blue">Железно</span></p>
                    </div>
                    <div class="column">
                        <p class="present"><span class="green">Передача прав на знак</span> за <span class="nowrap">9 990 руб</span></p>
                        <p class="note">&nbsp;</p>
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
                    <p class="subtitle"><span>4 стандартные ситуации</span> по смене прав</p>
                </div>
                <div id="sphere-slider" class="columns">
                    <div> 
                        <div id="change-entity" class="sphere <?= $webp ?>">
                            <p class="sphere-title">Смена юрлица</p>
                            <p><span>Стандартная ситуация, когда без передачи прав на знак не обойтись.</span>
                            </p>
                            <p>Переход с ИП на ООО, либо открытие нового юрлица однозначно потребует смену владельца товарного знака.</p>
                            <p>73% клиентов обращается к нам именно с этой проблемой.</p>
                        </div>
                    </div>
                    <div>
                        <div id="sale-trademark" class="sphere <?= $webp ?>">
                            <p class="sphere-title">Продажа товарного знака</p>
                            <p><span>Вы можете продать товарный знак, как полностью, так и частично.</span></p>
                            <p>Даже самый активный бизнес не использует больше 10% от перечня товаров или услуг в классах МКТУ на свой товарный знак.</p>
                            <p>Кому-то нужен выпуск одного товара под вашим знаком, и вы всегда сможете договориться о продаже знака только в рамках этого ограничения.</p>
                        </div>
                    </div>
                    <div>
                        <div id="economy" class="sphere <?= $webp ?>">
                            <p class="sphere-title">Экономия на налогах</p>
                            <p><span>Товарный знак - это важнейший актив бизнеса.</span></p>
                            <p>Не только репутационный, но и финансовый. Передавая знак от своего ООО к ИП вы сможете легально экономить на налогах и выводить наличность. <b>Подробнее ниже</b></p>
                        </div>
                    </div>
                    <div>
                        <div id="sale-business" class="sphere <?= $webp ?>">
                            <p class="sphere-title">Продажа бизнеса</p>
                            <p><span>Увеличьте доход от продажи своего бизнеса.</span> Включите цену на товарный знак в полную стоимость. Перерегистрация прав на ваш товарный знак - лишний довод к покупке.</p>
                        </div>
                    </div>
                </div>
                <div class="img-container">
                    <picture>
                        <source class="lazy" data-src="images/sphere-man.webp" type="image/webp">
                        <img class="lazy" data-src="images/sphere-man.png" alt="Регистрация товарного знака в России "
                             title="Кому необходим товарный знак?">
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
                <h3>Передача прав на товарный знак <span>за 3 простых шага</span></h3>
                <p class="subtitle"><span>Мы всегда на связи.</span> Подробно рассказываем о том, что происходит с заявкой</p>
            </div>
            <p class="registration-subtitle">В первые <span class="green nowrap">24 часа</span> подготовим договор отчуждения и отправим заявку на смену владельца</p>
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
                    <p>Готовим договор отчуждения.</p>
                    <p>Подаем документы в Роспатент.</p>
                    <p class="summary">3-24 часа</p>
                </div>
                <div id="step6" class="step <?= $webp ?>">
                    <p class="step-title">Вы получаете приложение к свидетельству с новым владельцем</p>
                    <p>Запись публикуется в реестрах.</p>
                    <p>Смена владельца подтверждена.</p>
                    <p class="summary">до 2 месяцев</p>
                </div>
            </div>
        </div><!-- end of content-container -->
    </div><!-- end of registration --> 
    
    <div class="action">
        <div class="content-big-container">
            <div class="content-container">
                <div class="columns">
                    <div class="column">
                        <p class="new-clients"><span class="vertical">Акция</span> для новых клиентов <span
                                    class="action-info">с <?php echo($action_begin); ?>
                                по <?php echo($action_end); ?></span></p>
                        <p class="action-date">осталось дней: <span
                                    class="blue"><?php echo($action_days_show); ?></span></p>
                    </div>
                    <div class="column">
                        <p class="present"><span class="green">Лучший тариф</span> по спец цене</p>
                        <p class="note">Фин.гарантия. Экономия <span class="nowrap">7000 руб.</span></p>
                        <p class="present">Тариф под ключ по <span class="green">старой цене 9990 руб.</span></p>
                        <p class="note"><a class="fancybox" href="/images/prikaz.jpg">приказ о проведении рекламой акции №82</a></p>
                    </div>
                </div>
            </div><!-- end of content-container -->
        </div><!-- end of content-big-container -->
    </div><!-- end of action -->      
    
    <div id="packages">
        <div class="content-container">
            <div class="title-container">
                <p class="title">2 железных варианта <span>сотрудничества</span></p>
                <p class="subtitle"><span>Цены на услуги фиксированные</span> Никаких доплат и скрытых платежей</p>
            </div>
            <div class="columns">
                <div class="column small">
                    <p class="column-title"><span class="blue">Базовый</span> - Договор по переуступке прав на товарный знак</p>
                    <ul>
                        <li>Подготовка договора отчуждения</li>
                        <li>Сбор данных по товарному знаку</li>
                        <li>Консультация</li>
                    </ul>
                    <p class="price"><span class="value">9 990</span> <span class="cur">Р</span></p>
                    <div class="button-container">
                        <a href="#order-modal" class="button fancybox" data-package="Вариант 1">Оставить заявку</a>
                    </div>
                </div>
                <div class="column big">
                    <p class="column-title"><span class="blue">Под ключ</span> - Смена владельца товарного знака с гарантией</p>
                    <ul>
                        <li>Подготовка договора отчуждения</li>
                        <li>Регистрация договора в Роспатенте</li>
                        <li>Финансовая гарантия</li>
                        <li>Сбор данных по товарному знаку</li>
                        <li>Консультационная поддержка на всех этапах</li>
                    </ul>
                    <p class="price"><span class="value">9 990</span> <span class="cur">Р</span> <span class="old"><span class="value">17 000</span> <span class="cur">Р</span></span></p>
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
                    <p class="title">Начните смену владельца <span>прямо сейчас</span></p>
                    <p class="subtitle"><span>Готовый договор отчуждения</span> уже сегодня!</p>
                </div>
            </div><!-- end of content-container -->
        </div><!-- end of full-width-container -->
        <div class="content-container">
            <div class="columns">
                <div class="column">
                    <p class="order-block-title">За Вас:</p>
                    <ul>
                        <li><span>Подготовим</span> все необходимые документы</li>
                        <li><span>Оформим</span> договор отчуждения</li>
                        <li><span>Зарегистрируем заявку</span> в Роспатенте</li>
                        <li><span>Рассчитаем госпошлины</span> с 30% скидкой</li>
                        <li><span>Сменим</span> владельца товарного знака</li>
                    </ul>
                    <div class="additional">
                        <p><span>1 год сервиса Iron Brand в подарок!</span> <sup>*</sup> при оформлении заявки <span
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
                                <input type="hidden" name="title" value="otchuzhdenie"><span class="name"></span>
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
                                <source class="lazy" data-src="images/feedback/client_7.webp" type="image/webp">
                                <img class="lazy" data-src="images/feedback/client_7.jpg"
                                     alt="Отзыв клиента о патентном бюро Железно" title="Отзывы о патентном бюро">
                            </picture>
                        </div>
                        <div class="client-info">
                            <p><b>Торопов Константин</b></p>
                            <p>Индивидуальный предприниматель</p>
                            <p>Сфера деятельности - производство и ритейл</p>
                            <p>Работаем с 2019 года<br/>Оформлен <b>1 договор отчуждения</b></p>
                        </div>
                    </div>
                    <div class="text">
                        <p class="feedback-title">Специалисты патентного бюро “Железно” помогли оформить сделку на отчуждение, и через 1,5 месяца я стал счастливым владельцем товарного знака.</p>
                        <p>Как и многие собственники небольшого бизнеса, я понятия не имел, зачем нужно регистрировать товарные знаки. Когда решил продавать свою продукцию на “Озоне”, выяснилось, что без товарного знака этого не сделать.</p>
                        <p>Обратился в патентное бюро “Железно” за помощью. На этапе проверки выяснилось, что мой знак уже зарегистрирован в нужном классе МКТУ, но можно связаться с хозяином знака и попытаться договориться.</p>
                        <p class="more hidden">Оказалось, что товарный знак владелец не использует и готов его продать. Специалисты патентного бюро “Железно” помогли оформить сделку на отчуждение, и через 1,5 месяца я стал счастливым владельцем товарного знака.</p>
                        <p class="more hidden">После этой истории зарегистрировал еще 1 свой знак. Теперь считаю, что вложения в интеллектуальную собственность необходимы, если вы всерьез занимаетесь своим делом и планируете развивать бизнес. Спасибо сотрудникам “Железно” не только за успешное отчуждение, но и за подробные консультации.</p>
                        <p class="more-button"><span class="blue">Подробнее</span></p>
                    </div>
                </div>
                <div class="item">
                    <div class="client columns">
                        <div class="img-container">
                            <picture>
                                <source class="lazy" data-src="images/feedback/client_8.webp" type="image/webp">
                                <img class="lazy" data-src="images/feedback/client_8.jpg" alt="Отзывы о патентных бюро"
                                     title="Патентное бюро Железно отзыв">
                            </picture>
                        </div>
                        <div class="client-info">
                            <p><b>Крючкова Марина Витальевна</b></p>
                            <p>Директор</p>
                            <p>Сфера деятельности - ритейл, интернет-магазины</p>
                            <p>Работаем с 2017 года<br/>Оформлен <b>1 договор отчуждения</b>, зарегистрировано <span class="nowrap"><b>3 знака</b></span></p>
                        </div>
                    </div>
                    <div class="text">
                        <p class="feedback-title">Когда мы столкнулись с проблемой, нам четко и профессионально помогли ее решить.</p>
                        <p>Мы регистрируем товарные знаки на новые товары в бюро “Железно”. Радует ответственный подход сотрудников к работе и человеческое отношение к клиенту. Менеджеры переживают, как за себя.</p>
                        <p>Когда мы столкнулись с проблемой, нам четко и профессионально помогли ее решить. Товарный знак, который был нужен, оказался занят. Варианты доработки мы не рассматривали, тогда менеджер Павел предложил вариант отчуждения.</p>
                        <p>С владельцем мешающего знака удалось договориться. Мы подписали договор, юристы “Железно” зарегистрировали его в ФИПС и МЫ ПОЛУЧИЛИ СВОЙ ЗНАК!</p>
                        <p>Спасибо вам, ребята! Буду рекомендовать вас всем!</p>
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
                <p class="title">Регистрация товарного знака <span class="green">Новые тарифы</span></p>
                <a href="/" target="_blank" class="button button-green">Подробнее</a>
            </div>
        </div><!-- end of content-container -->        
    </div><!-- end of reg-znak -->    
    
    <div class="order-block">
        <div class="full-width-container">
            <div class="content-container">
                <div class="title-container">
                    <p class="title">Начните смену владельца <span>прямо сейчас</span></p>
                    <p class="subtitle"><span>Готовый договор отчуждения</span> уже сегодня!</p>
                </div>
            </div><!-- end of content-container -->
        </div><!-- end of full-width-container -->
        <div class="content-container">
            <div class="columns">
                <div class="column">
                    <p class="order-block-title">За Вас:</p>
                    <ul>
                        <li><span>Подготовим</span> все необходимые документы</li>
                        <li><span>Оформим</span> договор отчуждения</li>
                        <li><span>Зарегистрируем заявку</span> в Роспатенте</li>
                        <li><span>Рассчитаем госпошлины</span> с 30% скидкой</li>
                        <li><span>Сменим</span> владельца товарного знака</li>
                    </ul>
                    <div class="additional">
                        <p><span>1 год сервиса Iron Brand в подарок!</span> <sup>*</sup> при оформлении заявки <span
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
                                <input type="hidden" name="title" value="otchuzhdenie"><span class="name"></span>
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
    
    <div id="faq" class="<?= $webp ?>">
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
<link rel="stylesheet" href="styles/slick-slider.css"/>
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