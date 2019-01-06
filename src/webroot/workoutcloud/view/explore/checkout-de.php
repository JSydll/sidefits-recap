<?php session_start();

?>
<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="description" content="Sidefits liefert Dir das perfekte Workout, Empfehlungen f&uuml;r aufregende Sportveranstaltungen und bietet die einzigartige M&ouml;glichkeit, Gleichgesinnte kennenzulernen. Von Sportlern f&uuml;r Sportler - egal auf welchem Level oder mit welchem Ziel.">
<meta name="keywords" content="Sidefits, sport, training, partner, trainingspartner, Veranstaltungen, Matching, Workout, Sportnetzwerk">
<meta name="author" content="Sidefits">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<meta property="og:title" content="Sidefits - Enhance your sports experience" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://sidefits.com" />
<meta property="og:image" content="http://sidefits.com/images/apple-touch-icon-114x114.png" />
<meta property="og:description" content="Sidefits liefert Dir das perfekte Workout, Empfehlungen f&uuml;r aufregende Sportveranstaltungen und bietet die einzigartige M&ouml;glichkeit, Gleichgesinnte kennenzulernen. Von Sportlern f&uuml;r Sportler - egal auf welchem Level oder mit welchem Ziel." />

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
</script>

<script language="javascript" type="text/javascript" src="js/jquery.mobile-1.4.5.min.js"></script>
<link rel="stylesheet" href="css/jquery.mobile.icons-1.4.5.min.css" type="text/css" />
<link rel="stylesheet" href="css/jquery.mobile-1.4.5.css" type="text/css" />

<script language="javascript" type="text/javascript" src="js/formactions.js"></script>
<script language="javascript" type="text/javascript" src="js/TimeCircles.js"></script>
<link rel="stylesheet" href="css/TimeCircles.css" type="text/css" />

<script language="javascript" type="text/javascript" src="js/timerfunctions.js"></script>

<link rel="stylesheet" href="css/sf-theme.css" type="text/css" />

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56616740-3', 'auto');
  ga('send', 'pageview');

</script>
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
                            
                            if(isset($_SESSION["sel-package"])){
                                if($_SESSION["sel-package"] == 1){
                                        $status1 = "selected";
                                        $status2 = "not-selected";
                                        $status3 = "not-selected";
                                } else if($_SESSION["sel-package"] == 2){
                                        $status1 = "not-selected";
                                        $status2 = "selected";
                                        $status3 = "not-selected";
                                } else if($_SESSION["sel-package"] == 3){
                                        $status1 = "not-selected";
                                        $status2 = "not-selected";
                                        $status3 = "selected";    
                                }
                            }
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
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="DLZKWRCWD2ZTA">
                                    <input type="image" src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="Jetzt einfach, schnell und sicher online bezahlen – mit PayPal.">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
                                </form>

                <!-- END -->
                            </div>
                            <div id="paypal-package3" class="<?php echo $status3; ?>">
                <!-- BUTTON PLUS PACKAGE -->
                                <h4>Auswertung Plus bestellen!</h4>
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="KH82757VJVCVG">
                                    <input type="image" src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="Jetzt einfach, schnell und sicher online bezahlen – mit PayPal.">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
                                </form>
                <!-- END -->
                            </div>    
                            <br /><br />
                            
                            <a href="javascript: void(0)" id="manualpay-select">Per &Uuml;berweisung zahlen <i class="arrow_carrot-down_alt2"></i></a>
                            
                            <br />
                            
                            <div id="manualpay">
                                <?php if(isset($_SESSION["usr_token"])) : ?>
                                <div>Bitte &uuml;berweise den Betrag <br />
                                <span id="manpay-price" class="price">Preis</span> <br />
                                mit dem Betreff <h4><?php  echo $_SESSION["usr_token"]; ?></h4> <br />                            
                                auf folgendes Konto:<br />
                                    Joschka Sondhof<br />
                                    Knt. 83286900<br />
                                    BLZ: 20190003<br />
                                </div>
                                <div>Sobald Deine Zahlung eingegangen ist, beginnen wir sofort mit der Auswertung Deines Tests. 
                                    Du erh&auml;lst dann nochmals eine Best&auml;tigung.<br /><br /></div>
                                <div>
                                    <div id="manpay-confirm">
                                        <table border="0" cellspacing="3">
                                        <tr><td><i class="icon_check_alt2"></i></td>
                                            <td>Wir haben Deine Auswahl registriert! Vielen Dank!<br />
                                            Du wirst nun zu unserer Vision weitergeleitet...</td>
                                        </tr>
                                        </table>
                                    </div>
                                    <div id="manpay-error">
                                        <table border="0" cellspacing="3">
                                        <tr><td><i class="icon_check_alt2"></i></td>
                                            <td>Leider ist etwas schiefgegangen. <a href="index-de.php#contact">Bitte schreibe uns eine kurze Nachricht.</a></td>
                                        </tr>
                                        </table>
                                    </div>
                                    <input type="hidden" id="sel_package_price" name="sel_package_price" value=""/>
                                    <button type="submit" name="manpay-confirm-submit" id="manpay-confirm-submit" class="ui-shadow ui-btn ui-corner-all">
                                        Manuelle &Uuml;berweisung ausw&auml;hlen
                                    </button>
                                </div>
                                <?php else : ?>
                                <div style="margin-bottom: 50px;"><h3>Oha! Da ist etwas auf der Strecke geblieben...</h3>
                                    Wir konnten Deinen Datensatz nicht wiederfinden.
                                    Solltest Du diese Seite manuell eingetippt und aufgerufen haben,
                                    starte den Test bitte <a href="index-de.php#dotest">&uuml;ber unsere Startseite</a>.
                                    Wenn Du den Test bereits einmal begonnen hast, kannst Du &uuml;ber den Link
                                    in Deiner Best&auml;tigungsemail zu Deinen Ergebnissen zur&uuml;ckkehren.
                                </div>
                                <?php endif; ?>
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
		<li><a href="http://facebook.com/Sidefits" target="_blank"><i class="social_facebook_square"></i></a></li>
		<li><a href="http://instagram.com/sidefits_official" target="_blank"><i class="social_instagram_square"></i></a></li>
		<li><a href="mailto:info@sidefits.com"><i class="icon_mail "></i></a></li>

	</ul>

	<!-- COPYRIGHT TEXT -->
	<span class="copyright">
	   <p class="white-text">
	       Diese Website und das Projekt Sidefits sind mit Herz in Hamburg/ Kopenhagen erstellt.<br />
	       Wir m&ouml;chten allen unseren Unterst&uuml;tzern auf unserem Weg danken!<br /><br />
	       Die Verantwortlichen sind mit dem Kontaktformular oder unter folgender Adresse zu erreichen:<br />
            Joschka Sondhof und Philipp M&auml;gel GbR<br />
            Osterbrook 22 <br />
            20527 Hamburg<br /><br />
            Alle Verlinkungen zu externen Ressourcen werden bei der Einrichtung nach bestem Wissen gepr&uuml;ft, jedoch nicht weiter beobachtet.<br />
            Daher &uuml;bernehmen wir keine Verantwortung f&uuml;r diese Inhalte.
       </p>
	   <br />
	   <p class="white-text">
       Copyright 2016 by Sidefits.
       </p>
	</span>

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