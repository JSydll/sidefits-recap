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
<title>Sidefits - FitTest Checkout</title>

<!-- =========================
      FAV AND TOUCH ICONS
============================== -->
<link rel="icon" href="images/favicon.ico">
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

<!-- =========================
     STYLESHEETS
============================== -->
<!-- BOOTSTRAP -->
<link rel="stylesheet" href="css/bootstrap.min.css">

<!-- FONT ICONS -->
<link rel="stylesheet" href="assets/elegant-icons/style.css">
<link rel="stylesheet" href="assets/app-icons/styles.css">
<!--[if lte IE 7]><script src="lte-ie7.js"></script><![endif]-->

<!-- WEB FONTS -->
<link href='http://fonts.googleapis.com/css?family=Roboto:100,300,100italic,400,300italic' rel='stylesheet' type='text/css'>

<!-- CAROUSEL AND LIGHTBOX -->
<link rel="stylesheet" href="css/owl.theme.css">
<link rel="stylesheet" href="css/owl.carousel.css">
<link rel="stylesheet" href="css/nivo-lightbox.css">
<link rel="stylesheet" href="css/nivo_themes/default/default.css">

<!-- ANIMATIONS -->
<link rel="stylesheet" href="css/animate.min.css">

<!-- CUSTOM STYLESHEETS -->
<link rel="stylesheet" href="css/styles-payment.css">

<!-- COLORS -->
<link rel="stylesheet" href="css/colors/blue-munsell-greybg.css">

<!-- RESPONSIVE FIXES -->
<link rel="stylesheet" href="css/responsive.css">


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
                    <h1><img src="images/Icon_Celebration.png" style="height: 80px; width: 80px; margin-right: 20px" /> Gratulation!</h1>
                    <div class="sf-header-block">
                        <span class="sf-content-text">
                            Du hast den FitTest erfolgreich abgeschlossen und Deine Daten wurden gesichert.
                        </span>
                    </div>
                    <div class="sf-test-block">
                        Hier noch einmal unsere verschiedenen Auswertungsmodelle. W&auml;hle einfach das 
                        f&uuml;r Dich passende Modell aus und best&auml;tige/ bezahle Deine Auswertung.
                        <br />
                        <div class="row">
                        <?php 
                            $status1 = "";
                            $status2 = "";
                            $status3 = "";
                            ?>
                            <div class="col-md-4 col-sm-4">
                                <div id="option-free" class="package-small-tile <?php echo $status1; ?>">
                    				<h2>Free</h2>
                                    <div class="price">
                    					<h2><span class="sign">&euro;</span>0</h2>        
                                    </div>
                                    <div class="calltoaction <?php echo $status1; ?>">
                                        <button class="btn btn-default btn-lg package-select" value="1">Ausw&auml;hlen!</button>
                                    </div>
                                    <br />
                                    <a class="featlist-expand" href="javascript: void(0)">Inhalte anzeigen <i class="arrow_carrot-down_alt2"></i></a>
                    				<ul class="featlist">
                    				<br />
                    					<li><i class="main-color icon_check_alt2"></i> FitTest mit Erkl&auml;rungen</li>
                    					<li><i class="main-color icon_check_alt2"></i> Pers&ouml;nliche Schnellauswertung</li>
                    				</ul>
                    				<br />
                    			</div>
                		    </div>
                		    <div id="option-basic" class="col-md-4 col-sm-4">
                                <div class="package-small-tile <?php echo $status2; ?>">
                    				<h2>Basic</h2>
                                    <div class="price">                                        
        					            <h2><span class="oldprice strikethrough">&euro; 9,90</span> <span class="sign">&euro;</span>7<span class="sign">90</span></h2>
                                    </div>
                                    <div class="calltoaction <?php echo $status2; ?>">
                                        <button class="btn btn-default btn-lg package-select" value="2">Ausw&auml;hlen!</button>
                                    </div>
                                    <br />
                                    <a class="featlist-expand" href="javascript: void(0)">Inhalte anzeigen <i class="arrow_carrot-down_alt2"></i></a>
                    				<ul class="featlist">
                    				<br />
                    					<li><i class="main-color icon_check_alt2"></i> FitTest mit Erkl&auml;rungen</li>
                    					<li><i class="main-color icon_check_alt2"></i> Pers&ouml;nliche Detailauswertung</li>
                    					<li><i class="main-color icon_check_alt2"></i> Geld-Zur&uuml;ck-Garantie</li>
                    				</ul>
                    				<br />
                    			</div>
                		    </div>
                		    <div id="option-plus" class="col-md-4 col-sm-4">
                                <div class="package-small-tile <?php echo $status3; ?> ">
                    				<h2>Plus</h2>
                                    <div class="price">                               
        					            <h2><span class="oldprice strikethrough">&euro; 19,90</span> <span class="sign">&euro;</span>14<span class="sign">90</span></h2>
                                    </div>
                                    <div class="calltoaction <?php echo $status3; ?>">
                                        <button class="btn btn-default btn-lg package-select" value="3">Ausw&auml;hlen!</button>
                                    </div>
                                    <br />
                                    <a class="featlist-expand" href="javascript: void(0)">Inhalte anzeigen <i class="arrow_carrot-down_alt2"></i></a>
                    				<ul class="featlist">
                    				<br />
                    					<li><i class="main-color icon_check_alt2"></i> FitTest mit Erkl&auml;rungen</li>
                    					<li><i class="main-color icon_check_alt2"></i> Pers&ouml;nliche Detailauswertung</li>
                    					<li><i class="main-color icon_check_alt2"></i> Pers&ouml;nliche Trainingsempfehlungen <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;f&uuml;r alle Bereiche</li>
                    					<li><i class="main-color icon_check_alt2"></i> Geld-Zur&uuml;ck-Garantie</li>
                    				</ul>
                    				<br />
                    			</div>
                		    </div>
            			</div>
                        <br />
                        <div id="free-eval">
                            <div id="free-eval-confirm">
                                <i class="icon_check_alt2"></i> 
                                Wir haben Deine Auswahl registriert! Vielen Dank!<br />
                                    Du wirst in 8 Sekunden zu unserer Vision weitergeleitet...
                            </div>
                            <div id="free-eval-error">
                                <td><i class="icon_check_alt2"></i> 
                                Leider ist etwas schiefgegangen. <a href="index-de.php#contact">Bitte schreibe uns eine kurze Nachricht.</a>
                            </div>
                            <button type="submit" name="free-eval-submit" id="free-eval-submit" class="ui-shadow ui-btn ui-corner-all">
                                Kostenlose Auswertung best&auml;tigen
                            </button>
                        </div>
                        <div id="payment-options">
                            Du kannst bequem mit PayPal oder per Bank&uuml;berweisung zahlen.<br /><br />
                            <div id="paypal-package2" class="<?php echo $status2; ?>">
               <!-- BUTTON BASIC PACKAGE --> 
                                <h4>Auswertung Basic bestellen!</h4>                
                <!-- END -->
                            </div>
                            <div id="paypal-package3" class="<?php echo $status3; ?>">
                <!-- BUTTON PLUS PACKAGE -->
                                <h4>Auswertung Plus bestellen!</h4>
                <!-- END -->
                            </div>    
                            <br /><br />
                            
                            <a href="javascript: void(0)" id="manualpay-select">Per &Uuml;berweisung zahlen <i class="arrow_carrot-down_alt2"></i></a>
                            
                            <br />
                            
                            <div id="manualpay">
                            </div>
                        </div>
                    </div>
               
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