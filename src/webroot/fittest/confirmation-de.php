<?php 
?>
<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="description" content="Sidefits liefert Dir das perfekte Workout, Empfehlungen f&uuml;r aufregende Sportveranstaltungen und bietet die einzigartige M&ouml;glichkeit, Gleichgesinnte kennenzulernen. Von Sportlern f&uuml;r Sportler - egal auf welchem Level oder mit welchem Ziel.">
<meta name="keywords" content="Sidefits, sport, training, partner, trainingspartner, Veranstaltungen, Matching, Workout, Sportnetzwerk">
<meta name="author" content="Sidefits">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- SITE TITLE -->
<title>Sidefits - FitTest Payment Confirmation</title>

<!-- =========================
      FAV AND TOUCH ICONS
============================== -->
<link rel="icon" href="images/favicon.ico"/>
<link rel="apple-touch-icon" href="images/apple-touch-icon.png"/>
<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png"/>
<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png"/>

<!-- =========================
     STYLESHEETS
============================== -->
<!-- BOOTSTRAP -->
<link rel="stylesheet" href="css/bootstrap.min.css"/>

<!-- FONT ICONS -->
<link rel="stylesheet" href="assets/elegant-icons/style.css"/>
<link rel="stylesheet" href="assets/app-icons/styles.css"/>
<!--[if lte IE 7]><script src="lte-ie7.js"></script><![endif]-->

<!-- WEB FONTS -->
<link href='http://fonts.googleapis.com/css?family=Roboto:100,300,100italic,400,300italic' rel='stylesheet' type='text/css'/>

<!-- CAROUSEL AND LIGHTBOX -->
<link rel="stylesheet" href="css/owl.theme.css"/>
<link rel="stylesheet" href="css/owl.carousel.css"/>
<link rel="stylesheet" href="css/nivo-lightbox.css"/>
<link rel="stylesheet" href="css/nivo_themes/default/default.css"/>

<!-- ANIMATIONS -->
<link rel="stylesheet" href="css/animate.min.css"/>

<!-- CUSTOM STYLESHEETS -->
<link rel="stylesheet" href="css/styles-payment.css"/>

<!-- COLORS -->
<link rel="stylesheet" href="css/colors/blue-munsell-greybg.css"/>

<!-- RESPONSIVE FIXES -->
<link rel="stylesheet" href="css/responsive.css"/>


<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<script src="js/respond.min.js"></script>
<![endif]-->

<!-- JQUERY -->
<script src="js/jquery-1.11.1.min.js"></script>

<script language="javascript" type="text/javascript" src="js/jquery.mobile-1.4.5.min.js"></script>
<link rel="stylesheet" href="css/jquery.mobile.icons-1.4.5.min.css" type="text/css" />
<link rel="stylesheet" href="css/jquery.mobile-1.4.5.css" type="text/css" />

<script language="javascript" type="text/javascript" src="js/formactions.js"></script>
<script language="javascript" type="text/javascript" src="js/TimeCircles.js"></script>
<link rel="stylesheet" href="css/TimeCircles.css" type="text/css" />

<script language="javascript" type="text/javascript" src="js/timerfunctions.js"></script>

<link rel="stylesheet" href="css/sf-theme.css" type="text/css" />
</head>

<body>
<!-- =========================
     PRE LOADER
============================== -->
<div class="preloader">
  <div class="status">&nbsp;</div>
</div>

<!-- =========================
     HEADER
============================== -->
<header class="header" data-stellar-background-ratio="0.5" id="home">

<!-- COLOR OVER IMAGE -->
<div class="color-overlay"> 
    <?php include("header.php"); ?>
    
    <div data-role="content" class="sf-content">
        <div class="ui-responsive">
            <div class="sf-content-bg">
        	   <div class="sf-content-block ui-content">
        	   
        	   <?php // The confirmation of an successful payment follows.
                    if($_SESSION["paystatus"] == "Completed") : ?>
                    <h1><img src="images/Icon_Happy.png" style="height: 80px; width: 80px; margin-right: 20px"/>Vielen Dank!</h1>
                    <div class="sf-header-block">
                        <span class="sf-content-text">
                            Wir haben Deine Zahlung erhalten und beginnen sofort mit der Auswertung.
                        </span>
                    </div>
                    <div class="sf-test-block">
                        <span class="sf-content-text">
                            Umgehend erh&auml;lst Du per Email die Auswertung Deines Testes.<br /><br /> 
                            Da wir Dich nur &uuml;ber Deine Email erreichen k&ouml;nnen, pr&uuml;fe bitte nochmals, ob selbige 
                            korrekt ist: <?php if(isset($_SESSION["email"])) echo $_SESSION["email"]; else echo "ACHTUNG! Keine Email hinterlegt!"; ?>.<br /><br />
                            Fehler gefunden? Kein Problem, kehre einfach nochmals zu Deinen Ergebnissen zur&uuml;ck 
                            (<a href="test-de.php?sft=<?php if(isset($_SESSION["sft"])) echo $_SESSION['sft']; ?>">hier</a>) und berichtige Deine Angabe.
                            Sie wird automatisch gespeichert, sobald Du den n&auml;chsten Schritt anw&auml;hlst.<br /><br />
                            <a href="/" class="col-link">Zur&uuml;ck zur Startseite.</a>   
                            <br /><br />
                        </span>
                    </div>
                <?php // The payment was not executed or aborted. 
                    else: ?>
                    <h2><img src="images/Icon_Sad.png" style="height: 80px; width: 80px; margin-right: 20px"/> Uuups. Da ist etwas schief gelaufen.</h2>
                    <div class="sf-header-block">
                        <span class="sf-content-text">
                            Leider konnte die Zahlung nicht abgeschlossen werden. M&ouml;chtest Du wirklich auf personalisierte, 
                            detaillierte Auswertungen zu Deinem Fitness- und Gesundheitszustand verzichten? <br />
                        </span>
                    </div>
                    <div class="sf-test-block">
                        <span class="sf-content-text">
                            Brauchst Du Hilfe? Wir helfen Dir gerne weiter! Bei Fragen stehen wir Dir jederzeit per 
                            <a href="index-de.php#contact" class="col-link">Kontaktformular</a> oder auf 
                            <a href="#" class="col-link">Facebook</a> zur Verf&uuml;gung.<br /><br />
                            Du m&ouml;chtest keine Auswertung? Kein Problem. Solltest Du es Dir zu einem sp&auml;teren Zeitpunkt anders &uuml;berlegen, 
                            kannst Du einfach mit dem Link aus der ersten Best&auml;tigungsmail auf Deine Ergebnisse zur&uuml;ck gelangen und die Auswertung 
                            bestellen. <br /><br />
                        </span>
                    </div>
                <?php endif; ?>
               </div>           	   
            </div>
        </div>
    </div>
    
</div>

<footer class="deep-dark-bg">

<div class="container" style="padding-top: 50px">

	<!-- LOGO -->
	<img src="images/logo.png" alt="LOGO" class="responsive-img">

	<!-- SOCIAL ICONS -->
	<ul class="social-icons">
		<li><a href="#" target="_blank"><i class="social_facebook_square"></i></a></li>
		<li><a href="#" target="_blank"><i class="social_instagram_square"></i></a></li>
		<li><a href="#"><i class="icon_mail "></i></a></li>

	</ul>

	<!-- COPYRIGHT TEXT -->
	<p class="copyright">
	   <p class="white-text">
	       Diese Website und das Projekt Sidefits sind mit Herz in Hamburg/ Kopenhagen erstellt.<br />
	       Wir m&ouml;chten allen unseren Unterst&uuml;tzern auf unserem Weg danken!<br /><br />
	       Die Verantwortlichen sind mit dem Kontaktformular oder unter folgender Adresse zu erreichen:<br />
            Joschka Seydell<br />
            Osterbrook 22 <br />
            20537 Hamburg<br /><br />
            Alle Verlinkungen zu externen Ressourcen werden bei der Einrichtung nach bestem Wissen gepr&uuml;ft, jedoch nicht weiter beobachtet.<br />
            Daher &uuml;bernehmen wir keine Verantwortung f&uuml;r diese Inhalte.
       </p>
	   <br />
	   <p class="white-text">
       Copyright 2019 by Sidefits.
       </p>
	</p>

</div>
<!-- /END CONTAINER -->

</footer>
<!-- /END FOOTER -->

<!-- =========================
     SCRIPTS
============================== -->

<script src="js/bootstrap.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.localScroll.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/nivo-lightbox.min.js"></script>
<script src="js/simple-expand.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/retina.min.js"></script>
<script src="js/jquery.nav.js"></script>
<script src="js/matchMedia.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.fitvids.js"></script>
<script src="js/custom.js"></script>
</body>
</html>