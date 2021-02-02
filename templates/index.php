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

$gtm_head = $app->gtm_head($gtm_id, 0);
$gtm_head .= $app->getVar('goo_verify') ? $app->getVar('goo_verify') : '';
$gtm_head .= $app->getVar('ya_verify') ? $app->getVar('ya_verify') : '';

$gtm_body = $app->gtm_body($gtm_id);

$title = "Регистрация товарного знака за 24 часа - ® ™ ";
$description = "Оставьте заявку на регистрацию товарного знака, торговой марки или бренда. Добъёмся за 24 часа официальной регистрации вашего знака через Роспатент. Стоимость регистрации знака снижена. Защити свое право на бренд!";
$keywords = "регистрация товарного знака, торговый знак, товарная марка, патентное бюро";
$work = "Мы работаем по всей России";
$h1 = "<h1 class=\"blue\">Регистрация товарного знака <span>с гарантией</span></h1>";
$h2 = "<h2>Почему важно зарегистрировать <span>товарный знак?</span></h2>";
$h3_selection = '<h3>Как правильно выбрать <span class="green">патентное бюро?</span></h3>';
$delivery_geo_text = "<p>Мы отправим свидетельство о регистрации  вашего товарного знака Почтой России заказным письмом с уведомлением. На юридический адрес вашей компании.</p>
                    <p>Впрочем, мы успешно сотрудничаем с курьерскими службами, такими как DPD, DHL, СДЭК. Вы можете сказать о своем выборе доставки нашему менеджеру. Свидетельство регистрации товарного знака будет доставлен вам прямо в руки.</p>";

$client_get = 'свидетельство на товарный знак';
$top_utp_one = '<p>За 24 часа <span class="blue">документально закрепим </span> ваше право на знак</p>';
$present = '<span class="green">Лучший тариф</span> по спец цене';
$sphere_one_title = 'Сфера IT / Стартапы';
$sphere_one_text = '<span>Наличие товарного знака&nbsp;&mdash; дополнительный плюс для инвестора.</span> Инвесторы всегда просчитывают риски. Они вряд ли захотят вкладывать деньги в проект, название которого могут забрать конкуренты.';

$order_block_title = 'Начните регистрацию <span>прямо сейчас</span>';
$order_block_utp_one = '<span>Проверим</span> любое количество вариантов по закрытым базам Роспатента';
$alt_man = 'Свой бренд под ключ - без переплат';
$pr1 = 'ИП&nbsp;&mdash; директор компании и владелец знака, ООО&nbsp;&mdash;ведет деятельность, и перечисляет деньги ИП за использование товарного знака. <b>9% экономите на налогах и выводите наличность. </b> По опыту наших клиентов, затраты на оформление знака <b>окупаются только за счет экономии на налогах за 4&ndash;5 месяцев</b>.';
$pr2 = 'Вся сложность регистрации товарного знака заключается не в формировании пакета документов. А в том, чтобы проверить знак перед подачей заявки:';
$pr3 = 'Именно поэтому важно ответственно подойти к выбору компании, которой вы доверите регистрацию вашего знака.';
$alt_man1 = 'Ошибки при оформлении торгового знака';
$alt_man2 = 'Как зарегистрировать товарный знак';
$pr4 = 'Важно! На этом этапе вы ничего не платите&nbsp;&mdash; ни нам, ни государству. Если вдруг на этапе экспертного поиска окажется что ваш знак требует доработки&nbsp;&mdash; мы просто отзовем ранее поданную заявку и подадим новую.';
$alt_man3 = 'Цена за услуги регистрации товарных знаков &mdash; завышена';
$alt_man4 = 'Сколько стоит регистрация товарного знака';
$alt_man5 = 'Договор на регистрацию товарного знака не гарантирует результата';
$pr5 = 'Многие компании считают: отказ экспертизы &mdash; не их вина. Они свою работу сделали &mdash; знак проверили, заявку оформили &mdash; услугу оказали. Дальше все зависит от эксперта и они не могут отвечать за его работу. Поэтому в случае отказа деньги за оказанные услуги они не возвращают. <b>Правильно ли это?</b>';
$pr6 = 'Проблема в том, что экспертиза &mdash; процесс субъективный. Для одного человека знаки кажутся абсолютно разными, а другому кажется что они похожи. Именно на личное впечатление опирается эксперт, когда выносит решение по товарному знаку.';
$alt_man6 = 'Регистрация товарного знака под ключ цена';
$pr7 = 'Наш результат &mdash; не заполненная заявка, не отчет о проверке знака!';
$pr8 = 'Подадим заявку на знак за 4990&nbsp;руб.';
$pr9 = 'Ваш знак точно никто не займет';
$pr10 = 'Уточняем информацию о знаке.';
$pr11 = 'Мы бесплатно <span>проверяем ваш знак</span>';
$pr12 = 'Приоритет на знак за вами.';
$pr13 = '<span>Расскажем,</span> как с помощью товарного знака можно зарабатывать и бороться с конкурентами';
$pr14 = '<p>До "Железно" успели поработать с двумя московскими компаниями.</p><p>Первые брали с нас деньги за исправление собственных ошибок.';
$pr15 = 'Но и на этом они не остановились - перед получением свидетельства, попросили доплатить <span class="nowrap">6000</span> руб. за направление ходатайства об оплате пошлины. Мы отказались, наш бухгалтер сделал это за 15 минут.</p>';
$pr16 = '<p>Мы сразу не поняли всей серьезности ситуации и просто промолчали. Ведь эту коптильню кроме нас продавали еще 5 или 6 компаний по всей России. И продавали уже достаточно давно &mdash; 5-6 лет.</p>';
$pr17 = 'Без зарегистрированного товарного знака, любой ушлый конкурент может отобрать у вас все, просто зарегистрировав ваше название на себя.';
$pr18 = '<p>Компанию Железно выбрали по результатам внутреннего конкурса. Мы прекрасно понимали, что наши товарные знаки уникальные и их точно зарегистрируют. Поэтому основным критерием выбора была конечная цена за весь цикл регистрации.</p>
<p>Как мы и думали, регистрация прошла как по маслу. Работой компании довольны, все задачи отрабатывали быстро.</p>
<p>Хочется обратиться ко всем компаниям, которые до сих пор работают без зарегистрированного товарного знака. Коллеги, не жалейте денег на регистрацию. Вы вкладываете колоссальные силы, деньги и время в раскрутку своего бренда! Даже если у вас небольшая пекарня или обувной магазин, люди идут на ваше имя, они его знают и помнят.';
$pr19 = 'Идея зарегистрировать товарный знак возникла не случайно.';
$pr20 = '5 главных вопросов <span>о регистрации товарного знака';
$pr21 = 'Успех самостоятельной регистрации товарных знаков составляет не более 35%.';
$pr22 = 'При обращении в Роспатент через патентное бюро «Железно» вы гарантировано получите скидку 30% на оплату гос. пошлины. А это 10-15 т.р. чистой выгоды..';
$pr23 = 'Несвоевременная оплата гос. пошлин: + 3&ndash;4 месяца;';
$pr24 = 'По статистике наших заявок, <b>отказы не превышают 5%</b> от общего числа поданных на регистрацию знаков.';
$pr25 = 'Обратите внимание, что в случае ликвидации компании или замены юридического лица необходимо оформить переход прав товарного знака.';
$pr26 = 'Я хотел бы зарегистрировать знак на территории другого государства? Сможете мне помочь?';
$pr28 = '+ 1 год сервиса Iron Brand в подарок';
$pr29 = '1 год сервиса Iron Brand <span class="green">в подарок!';
$header_class = '';

$blazon_src = $app->getVar('blazon_src');

$address =  "";
$package4 =  "";

foreach (['title', 'description', 'keywords', 'work', 'h1', 'h2', 'h3_selection', 'delivery_geo_text', 'client_get',
             'top_utp_one', 'present', 'sphere_one_title', 'sphere_one_text', 'order_block_title', 'order_block_utp_one',
             'alt_man', 'pr1', 'pr2', 'pr3', 'alt_man1', 'alt_man2', 'pr4', 'alt_man3', 'alt_man4', 'alt_man5', 'pr5', 'pr6', 'alt_man6', 'pr7', 'pr8', 'pr9', 'pr10', 'pr11', 'pr12', 'pr13', 'pr14', 'pr15', 'pr16', 'pr17', 'pr18', 'pr19', 'pr20', 'pr21', 'pr22', 'pr23', 'pr24', 'pr25', 'pr26', 'pr28', 'pr29', 'header_class', 'address', 'package4'] as $var_name) {
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
    <meta property="og:image" content="<?= $app->urlRelCanonical() ?>images/og_image.jpg">
    <meta property="og:title" content="Зарегистрируй товарный знак. Защити бизнес от конкурентов.">
    <meta property="og:description"
          content="Оставьте заявку на регистрацию торговой марки &#8482; пока не поздно.Ускоренные схемы регистрации. Проверка по закрытым базам ФИПС">

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
<?php
if ($app->isGeo()){
if (isset($_GET['test'])){
    ex($blazon_src);
}
    echo "<style>#top .top-middle p {    background-image: url('{$blazon_src}'); }</style>";
}
?>

<body <?= $app->isGeo() ? 'class="geo"' : '' ?> >

<?= $gtm_body ?>

<header id="header" class="<?= $webp ?> <?= $header_class?>">

    <?
    $block_name_var = 'block_header';
    $blocks_main = ['anticrisis-top', 'top', 'header-main'];

    if ($app->getVar($block_name_var)) {
        $block_main_vars = explode(',', $app->getVar($block_name_var));
        if (count($block_main_vars)) {
            $blocks_main = $block_main_vars;
        }
    }

    foreach ($blocks_main as $block) {
        $block_clear = trim($block);
        $block_var = $app->getVar($block_clear);
        if ($block_var) {
            echo $block_var;
        } else {
            if (file_exists($app->getLayoutDir() . '/' . $block_name_var . '/' . $block_clear . '.php')) {
                include_once $app->getLayoutDir() . '/' . $block_name_var . '/' . $block_clear . '.php';
            }
        }
    }
    ?>

</header><!-- end of header -->

<main id="content">

    <?
    $block_name_var = 'block_main';
    $blocks_main = ['spheres', 'money', 'selection', 'compare', 'digits', 'packages', 'price-increase', 'quick', 'anticrisis', 'registration', 'roadmap', 'order-block1', 'team', 'cities', 'feedback', 'order-block2', 'faq', 'delivery', 'consultation'];

    if ($app->getVar($block_name_var)) {
        $block_main_vars = explode(',', $app->getVar($block_name_var));
        if (count($block_main_vars)) {
            $blocks_main = $block_main_vars;
        }
    }


    foreach ($blocks_main as $block) {
        $block_var = $app->getVar($block);
        if ($block_var) {
            echo $block_var;
        } else {
            if (file_exists($app->getLayoutDir() . '/' . $block_name_var . '/' . $block . '.php')) {
                include_once $app->getLayoutDir() . '/' . $block_name_var . '/' . $block . '.php';
            } 
        }
    }
    ?>

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

<div id="roadmap-modal" class="form-popup">
    <div class="form-container">
        <p class="modal-title">Скачать <br/> дорожную карту</p>
        <form method="post" action="success.php">
            <input type="hidden" name="title" value="Map" autocomplete="off"><span class="name"></span>
            <label for="name" class="columns"><input type="text" name="name" placeholder="Ваше имя" data-hint="имя"
                                                     autocomplete="off"><span class="name"></span></label>
            <label for="email" class="columns"><input type="email" name="email" placeholder="Email" data-hint="email"
                                                      autocomplete="off"><span class="email"></span></label>
            <input type="submit" value="Скачать" class="button button-green">
        </form>
    </div>
</div>

<div id="free-docs" class="form-popup">
    <div class="big-container">
        <div class="form-container <?= $webp ?>">
            <p class="modal-title">Вам нужна эта информация!</p>
            <p class="modal-subtitle">Получите <span>бесплатно</span> документы, которые сэкономят ваше время и деньги!
            </p>
            <ul>
                <li><span>Таблица патентных бюро</span> Сравнительная таблиц с ценами и условиями сотрудничества.</li>
                <li><span>5 ошибок при выборе патентного бюро</span> Как не переплатить за услуги и гарантированно
                    зарегистрировать знак. Разбор схем мошенничества.
                </li>
                <li><span>7 способов “наказать” конкурентов с помощью товарного знака.</span> Примеры. Судебная
                    практика. Контактная информация.
                </li>
            </ul>
            <form method="post" action="success.php">
                <input type="hidden" name="title" value="Free_docs">
                <p class="modal-subtitle">Напишите нам в Whatsapp, и мы вышлем вам документы</p>
                <div class="button-container">
                    <a class="button button-light" href="https://api.whatsapp.com/send?phone=79229092784&text=%D0%A5%D0%BE%D1%87%D1%83%20%D0%BF%D0%BE%D0%BB%D1%83%D1%87%D0%B8%D1%82%D1%8C%20%D0%B4%D0%BE%D0%BA%D1%83%D0%BC%D0%B5%D0%BD%D1%82%D1%8B" target="_blank">написать в Whatsapp</a>                    
                </div>
                <p class="no-whatsapp">У меня нет Whatsapp</p>
                <div class="additional-block">
                    <p class="note">Оставьте номер телефона, и мы перезвоним, чтобы согласовать удобный для вас способ получения документов.</p>
                    <div class="columns">
                        <label for="phone" class="columns"><input type="text" name="phone" placeholder="Ваш телефон" data-hint="телефон"><span class="phone"></span></label>
                        <input type="submit" value="Получить документы" class="button button-green">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="patent-modal" class="form-popup">
    <div class="popup-container">
    </div>
</div>
    
<div id="info-modal" class="form-popup">
    <div class="info-container">
        <p class="modal-title">Товарный знак "Под ключ" <span class="green">со скидкой <span class="nowrap">2000 руб.</span></span></p>
        <p class="modal-subtitle">Новогодняя акция от патентного бюро "Железно".</p>
        <div class="text">
            <ol>
                <li>Назовите менеджеру <span class="green">промокод 2021</span></li>
                <li>Получите скидку 10% на регистрацию знака</li>
            </ol>
            <p><b>Промокод действует только <span class="green">до 31 января</span></b>.</p>
            <p>Успей оставить заявку!</p>
        </div>
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
    $('a[href="#order-modal"]').on('click', function() {
        var package, form_title;
        
        package = $(this).data('package');
        
        switch (package) {
          case 'Вариант 1':
            form_title = 'Self';
            break;
          case 'Вариант 2':
            form_title = 'Full';
            break;
          case 'Вариант 3':
            form_title = 'Premium';
            break;
          case 'Вариант 4':
            form_title = 'Logo-brand';
            break;
          case 'Вариант 5':
            form_title = 'Price-fix';
            break;                
          default:
            form_title = 'Self';
        }       
        
        $('#order-modal').find('input[name="title"]').val(form_title);
        
        window.dataLayer = window.dataLayer || [];
        
    });
</script>
</body>
</html>