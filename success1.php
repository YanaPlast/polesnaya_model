<?php
/*
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
*/
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

    $date_full = explode(".", date("d.m.Y", strtotime("+30 DAYS")));
    $date_short = date("d.m", strtotime("+30 DAYS"));
    $rus_month = $Month_r[$date_full[1]];
    $rus_date = $date_full[0].'&nbsp;'.$rus_month.'&nbsp;'.$date_full[2];


    $last_year = date("Y", strtotime("-1 YEAR"));

    function LastModified($file = ''){

        if(empty($file)){
            $file = __FILE__;
        }

        if(!file_exists($file)){
            return;
        }
        $LastModified_unix = strtotime(date("D, d M Y H:i:s", filectime($file)));
        $LastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;
        if (isset($_ENV['HTTP_IF_MODIFIED_SINCE'])){
            $IfModifiedSince = strtotime(substr($_ENV['HTTP_IF_MODIFIED_SINCE'], 5));
        }
        if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])){
            $IfModifiedSince = strtotime(substr($_SERVER['HTTP_IF_MODIFIED_SINCE'], 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
            exit;
        }
        header('Last-Modified: '. $LastModified);
    }
    LastModified();

    // Backgrounds
    $webp = 'img';
    if( strpos( $_SERVER['HTTP_ACCEPT'], 'image/webp' ) !== false ) {
        $webp = 'webp';
    }
	
		$method = $_SERVER['REQUEST_METHOD'];

	//Подготавливаем тело письма
		if ( $method === 'POST' ) {
			require('amo/in.php');
			$message = "";
			$c = "";
			foreach ( $_POST as $key => $value ) {
				$message_value = $value;
				$message_key = "";
					if ($key === "name") $message_key = "Имя";
					if ($key === "phone") $message_key = "Телефон";
					if ($key === "email") $message_key = "Email";
					if ($key === "utm_source") $message_key = "utm source";
					if ($key === "utm_medium") $message_key = "utm medium";
					if ($key === "utm_campaign") $message_key = "utm campaign";
					if ($key === "utm_content") $message_key = "utm content";
					if ($key === "utm_term") $message_key = "utm term";
					$message .= "
					" . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
						<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$message_key</b></td>
						<td style='padding: 10px; border: #e9e9e9 1px solid;'>$message_value</td>
					</tr>
					";

			}
			$message = "<table style='width: 100%;'>$message</table>";
			//отправляем письмо
			
			$headers  = "Content-type: text/html; charset=UTF-8 \r\n"; 
			$headers .= "From: Товарный знак <from@tovarnyj-znak.ru>\r\n"; 
			$headers .= "Reply-To: from@tovarnyj-znak.ru\r\n"; 
			
			mail("agt.patent@mail.ru", "Заявка с сайта", $message, $headers); 
		}

?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
<meta name="format-detection" content="telephone=no">
<meta http-equiv="x-rim-auto-match" content="none">

<title>Спасибо за заявку - &#174; &#8482; </title>
<meta name="description" content="" />
<meta name="keywords" content="" />
 
<link href="https://tovarnyj-znak.ru" rel="canonical" />
<link rel="shortcut icon" href="favicon.ico" />
    
<link rel="preload" href="styles/fonts/DINPro.woff2" as="font" type="font/woff2" crossorigin="anonymous">
<link rel="preload" href="styles/fonts/DINPro-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous">
<link rel="preload" href="styles/fonts/DINPro-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous">
<link rel="preload" href="styles/fonts/DINPro-Light.woff2" as="font" type="font/woff2" crossorigin="anonymous">
<link rel="preload" href="styles/fonts/DINPro-Italic.woff2" as="font" type="font/woff2" crossorigin="anonymous">
<link rel="preload" href="styles/fonts/DINPro-MediumItalic.woff2" as="font" type="font/woff2" crossorigin="anonymous">
<link rel="preload" href="styles/fonts/DINPro-CondensedLight.woff2" as="font" type="font/woff2" crossorigin="anonymous">
<link rel="preload" href="styles/fonts/DINPro-CondensedRegular.woff2" as="font" type="font/woff2" crossorigin="anonymous">
<link rel="preload" href="styles/fonts/DINPro-CondensedMedium.woff2" as="font" type="font/woff2" crossorigin="anonymous">
<link rel="preload" href="styles/fonts/DINPro-CondensedBold.woff2" as="font" type="font/woff2" crossorigin="anonymous"> <link rel="preload" href="styles/fonts/DINPro-CondensedBoldItalic.woff2" as="font" type="font/woff2" crossorigin="anonymous">
<link rel="preload" href="styles/fonts/RUBSN.woff2" as="font" type="font/woff2" crossorigin="anonymous"> 
<link rel="dns-prefetch" href="//yastatic.net/">
<link rel="dns-prefetch" href="//google-analytics.com/">    

<link rel="stylesheet" href="styles/critical.css">    
<!--[if lt IE 9]> <script src="scripts/html5.js"></script> <![endif]-->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TJFHL4B');</script>
<!-- End Google Tag Manager -->
</head>
    
<body>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TJFHL4B"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	
    <header id="header" class="<?=$webp?>">
            
            <div id="top">
                <div class="content-container">
                    <div class="columns">
                        <div class="logo">
                            <a href="/" class="img-container">
                                <picture>
                                    <source srcset="images/logo.webp" type="image/webp">
                                    <img src="images/logo.jpg" alt="" title="Патентное бюро Железно">
                                </picture>    
                            </a>
                            <p>Патентное бюро</p>
                        </div>
                        <div class="top-middle">
                            <p>Мы работаем по всей России</p>
                        </div>
                        <div class="phone-block">                    
                            <a class="phone" href="tel:84951047454">8 495 104-74-54</a>                    
                        </div>
                    </div>
                </div><!-- end of content-container -->
            </div><!-- end of top -->
            
            <div id="header-main" class="columns">
                <div class="content-container">
                    <div class="title-container">
                        <div>
                            <h1 class="blue">Пока мы проверяем ваш знак, <span>почитайте о "Железно"</span></h1>                            
                        </div>                        
                        <ul class="features success">
                            <li><a href="/#spheres"><span class="green">4 неочевидных причины зарегистрировать товарный знак</span></a></li>
                            <li><a href="/#selection"><span class="green">Как правильно выбрать патентное бюро</span></a></li>
                            <li><a href="/#packages"><span class="green">3 варианта сотрудничества. Цены</span></a></li>
                            <li><a href="/#register-quick"><span class="green">Ускорение регистрации</span></a></li>
                            <li><a href="/#registration"><span class="green">Регистрация вашего знака за 6 простых шагов</span></a></li>
                            <li><a href="/#feedback"><span class="green">Отзывы</span></a></li>
                        </ul>
                        <p class="subtitle">График работы нашего офиса: <br />Пн-Пт, с 09:00 до 18:00 (Мск)</p>                        
                    </div>
                </div><!-- end of content-container -->
            </div><!-- end of header-main -->
                
    </header><!-- end of header -->
    
    <link rel="stylesheet" href="styles/styles.css"> 
    
    <style>
        body{
            background: #2e3439;
        }
        #header-inner{
            height: 100vh;
        }
        #header-main .title-container{
            float: none;
            width: 100%;
        }
        #header-main .features.success{
            display: inline-block;
            width: 100%;
            margin: 50px 0 35px;
        }
        #header-main .features.success li{
            padding: 0;            
            margin: 0 0 20px;
            background: none;
            text-align: left;            
        }
        #header-main .features li a{
            display: inline-block;
            width: auto;
            font-family: 'DINPro-Condensed', Arial, sans-serif;
            font-size: 24px;
            line-height: 24px;
            font-weight: 600;
            color: #aed6a3;
            margin: 0;
            text-decoration: underline;
            padding: 15px;
            margin: 0;
            background-color: #1a1c1e;
            background-color: rgba(26,28,30,0.7);
            background-color: transparent \7;
            -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#4c1a1c1e, endColorstr=#4c1a1c1e)";            
        }
        #header-main .features li a:hover{
            text-decoration: none;
        }
    </style>
    
    <script src="scripts/jquery.js"></script>
	<script type="text/javascript" src="./scripts/utm_parser.js"></script>
</body>
</html>