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
<title>Sidefits - FitTest</title>

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
<link rel="stylesheet" href="css/styles-test.css">

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
<script language="javascript" type="text/javascript" src="js/formactions.js"></script>

<script language="javascript" type="text/javascript" src="js/jquery.mobile-1.4.5.min.js"></script>
<link rel="stylesheet" href="css/jquery.mobile.icons-1.4.5.min.css" type="text/css" />
<link rel="stylesheet" href="css/jquery.mobile-1.4.5.css" type="text/css" />

<link rel="stylesheet" href="css/sf-theme.css" type="text/css" />

<!-- HTML VIDEO SUPPORT -->
<script language="javascript" type="text/javascript" src="js/video.js"></script>
<link rel="stylesheet" href="css/video-js.css" type="text/css" />
<script language="javascript" type="text/javascript" src="js/audio.js"></script>
<link rel="stylesheet" href="css/audio-js.css" type="text/css" />
<script language="javascript" type="text/javascript">
AudioJS.setupAllWhenReady();
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
        	   <div data-role="tabs">
                    <div data-role="navbar">
                        <ul>
                            <li><a id="tab-step1" href="#step1" data-theme="a" data-ajax="false" data-transition="slide"><img src="images/Icon_Data.png" style="height: 1.5em;"/></a></li>
                            <li><a id="tab-step2" href="#step2" data-theme="a" data-ajax="false" data-transition="slide"><img src="images/Icon_Flex.png" style="height: 1.5em;"/></a></li>
                            <li><a id="tab-step3" href="#step3" data-theme="a" data-ajax="false" data-transition="slide"><img src="images/Icon_Muscle.png" style="height: 1.5em;"/></a></li>
                            <li><a id="tab-step4" href="#step4" data-theme="a" data-ajax="false" data-transition="slide"><img src="images/Icon_Cardio.png" style="height: 1.5em;"/></a></li>
                        </ul>
                    </div>
                    
                    <div id="step1" class="ui-content">
                        <div class="sf-content-block">
                            <h3>Schritt 1: Pers&ouml;nliche Informationen</h3>
                                <div class="sf-header-block">
                                    <h4>Der Test im &Uuml;berblick</h4>
                                    <div style="width: 100%; text-align: center"><img src="images/Test_contents_b.png" style="width: 70%"/></div>
                                    <br /><br />
                                    <span class="sf-content-text">Hinweis: Sidefits wird Deine Daten niemals an Dritte weitergeben.
                                        Die hier erhobenen Informationen dienen alleine zur bestm&ouml;glichen
                                        Auswertung der Testergebnisse.<br /></span>
                                    <div id="notification-positive"><br />Wir haben Dir soeben eine Email gesendet! Von dort aus kannst Du jederzeit zum Test zur&uuml;ckkehren.<br /><br /></div>
                                </div>
                                <div id="step1-formfeedback"></div>
                                <div class="sf-test-block">
                                    <div data-role="fieldcontain">
                                        <label for="step1-name">Dein Name: </label>
                                        <input class="step1-inputs" tabindex="1" name="step1-name" id="step1-name" value="<?php echo $_SESSION["name"]; ?>" type="text"/>
                                    </div>
                                    <div data-role="fieldcontain">
                                        <label for="step1-age">Dein Alter: </label>
                                        <input class="step1-inputs" tabindex="2" name="step1-age" id="step1-age" value="<?php echo $_SESSION["age"]; ?>" type="number"/>
                                    </div>
                                    <fieldset class="ui-field-contain">
                                        <label for="step1-sex">Dein Geschlecht:</label>
                                        <select class="step1-inputs" tabindex="3" name="step1-sex" id="step1-sex" data-role="slider" data-mini="true">
                                            <option value="1" <?php if($_SESSION["sex"]==1) echo "selected=\"\""; ?>>m</option>
                                            <option value="0" <?php if($_SESSION["sex"]==0) echo "selected=\"\""; ?>>w</option>
                                        </select>
                                    </fieldset>
                                    <div data-role="fieldcontain">
                                        <label for="step1-height">Deine K&ouml;rpergr&ouml;&szlig;e (cm): </label>
                                        <input class="step1-inputs" tabindex="4" name="step1-height" id="step1-height" value="<?php echo $_SESSION["height"]; ?>" placeholder="(cm)" type="number" step="0.01"/>
                                    </div>
                                    <div data-role="fieldcontain">
                                        <label for="step1-weight">Dein Gewicht (kg): </label>
                                        <input class="step1-inputs" tabindex="5" name="step1-weight" id="step1-weight" value="<?php echo $_SESSION["weight"]; ?>" placeholder="(kg)" type="number" step="0.01"/>
                                    </div>
                                </div>
                                
                                <button type="submit" tabindex="6" id="step1-submit" class="ui-shadow ui-btn ui-corner-all">N&auml;chster Schritt</button>
                       </div>
                    </div>
                    <div id="step2" class="ui-content">
                        <div class="sf-content-block">
                            <h3>Schritt 2: Flexibilit&auml;t</h3>
                                <div class="sf-test-block">
                                    <h3>Sit &amp; Reach Test</h3>
                                    <span class="sf-content-text">
                                        <video id="test-sitnreach-vid" class="video-js vjs-tech test-video"
                                                preload="auto" controls>
                                             <source src="videos/SitnReach.mp4" type='video/mp4' />
                                             <source src="videos/SitnReach.webm" type='video/webm' />
                                             <p class="vjs-no-js">Um dieses Video abzuspielen, aktiviere JavaScript oder nutze einen Browser, der HTML5 Video unterst&uuml;tzt. </p>
                                        </video>
                                        <br /><br />
                                        <a href="javascript: void(0)" class="testexplain sitreach-expl col-link">Erkl&auml;rungen <i class="arrow_carrot-down_alt2"></i></a>
                                        <div id="sitreach-expl">                               
                                            <h5>So weit wie m&ouml;glich mit ausgestreckten Beinen vorbeugen</h5>
                                            Lege Deine F&uuml;&szlig;e b&uuml;ndig an eine Stufe/ Kante an und halte die Beine durchgestreckt. 
                                            Probiere, wie weit Du Deine H&auml;nde in Richtung Deiner F&uuml;&szlig;e ausstrecken kannst. 
                                            Kommst Du noch nicht an Deine F&uuml;&szlig;e, nimm das Lineal in eine Hand, setze es an der Kante 
                                            an und schiebe Deine Hand so weit wie m&ouml;glich vor. Wenn du weiter kommst, lege das Lineal auf der 
                                            Kante ab, strecke Deine H&auml;nde so weit es geht und lege eine Hand fest auf das Lineal. 
                                            Nun kannst Du die Weite nach dem Muster a) -3 cm oder b) 3 cm eintragen. Die Skala vieler 
                                            Lineale beginnt erst 1 cm weiter oben, rechne dies ggf. dazu. Angaben auf 0.5 cm genau sind ausreichend.   <br /><br />
                                        </div>
                                    </span>
                                    <div data-role="fieldcontain">
                                        <label for="step2-sitreach">Reichweite (cm): </label>
                                        <input class="step2-inputs" tabindex="7" name="step2-sitreach" id="step2-sitreach" value="<?php echo $_SESSION["sitreach"]; ?>" placeholder="(cm)" type="number" step="0.01"/>
                                    </div>
                                </div>
                                <div class="sf-test-block">
                                    <h3>Rotationstest</h3>
                                    <span class="sf-content-text">
                                        <video id="test-rotation-vid" class="video-js vjs-tech test-video"
                                                preload="auto" controls>
                                             <source src="videos/Rotationstest.mp4" type='video/mp4' />
                                             <source src="videos/Rotationstest.webm" type='video/webm' />
                                             <p class="vjs-no-js">Um dieses Video abzuspielen, aktiviere JavaScript oder nutze einen Browser, der HTML5 Video unterst&uuml;tzt. </p>
                                        </video>
                                        <br /><br />
                                        <a href="javascript: void(0)" class="testexplain rotation-expl col-link">Erkl&auml;rungen <i class="arrow_carrot-down_alt2"></i></a>
                                        <div id="rotation-expl">
                                            <h4>So viele Rotationen in 20 Sekunden wie m&ouml;glich</h4>
                                            Stelle Dich mit dem R&uuml;cken zu einer Wand. W&auml;hrend der &Uuml;bung musst Du abwechselnd
                                            einen Punkt zwischen Deinen Beinen und einen Punkt hinter Dir, etwa auf Schulterh&ouml;he an der Wand, ber&uuml;hren.
                                            Dazu beuge Dich zun&auml;chst vor, ber&uuml;hre den Punkt zwischen Deinen Beinen, richte Dich wieder auf und
                                            rotiere Deinen K&ouml;rper um einen Fu&szlig;. Nach der Ber&uuml;hrung der Wand rotiere in die gleiche Richtung zur&uuml;ck.
                                            Bei der n&auml;chsten Runde drehe Dich andersherum. Eine Runde gilt als abgeschlossen, wenn Du beide Punkte ber&uuml;hrt hast
                                            und die 20 Sekunden noch nicht um sind.   <br /><br />
                                        </div>
                                    </span>
                                    <div data-role="fieldcontain">
                                        <label for="step2-rotation">Wiederholungen: </label>
                                        <input class="step2-inputs" tabindex="8" name="step2-rotation" id="step2-rotation" value="<?php echo $_SESSION["rotation"]; ?>" type="number"/>
                                    </div>
                                </div>
                                
                                <fieldset class="ui-grid-a">
                                    <div class="ui-block-a"><button id="step2-back" class="ui-shadow ui-btn ui-corner-all">Zur&uuml;ck</button></div>
                                    <div class="ui-block-b"><button tabindex="9" id="step2-submit" type="submit" class="ui-shadow ui-btn ui-corner-all">N&auml;chster Schritt</button></div>
                                </fieldset>
                       </div>
                    </div>
                    <div id="step3" class="ui-content">
                        <div class="sf-content-block">
                            <h3>Schritt 3: Muskelkraft und -ausdauer</h3>
                                <div class="sf-test-block">
                                    <h3>Standweitsprung</h3>
                                    <span class="sf-content-text">
                                         <video id="test-broadj-vid" class="video-js vjs-tech test-video"
                                                preload="auto" controls>
                                             <source src="videos/Standweitsprung.mp4" type='video/mp4' />
                                             <source src="videos/Standweitsprung.webm" type='video/webm' />
                                             <p class="vjs-no-js">Um dieses Video abzuspielen, aktiviere JavaScript oder nutze einen Browser, der HTML5 Video unterst&uuml;tzt. </p>
                                        </video>
                                        <br /><br />
                                        <a href="javascript: void(0)" class="testexplain broadj-expl col-link">Erkl&auml;rungen <i class="arrow_carrot-down_alt2"></i></a>
                                        <div id="broadj-expl">
                                            <h5>So weit wie m&ouml;glich aus dem Stand springen</h5>
                                           Markiere Dir mit dem Lineal eine Ziellinie. Nun gehst Du in jeder Runde genau einen Fu&szlig; weiter zur&uuml;ck und 
                                           springst von dort auf die Linie. Schaffst du z.B. in der 6. Runde nicht mehr, auf oder hinter die Ziellinie zu springen, 
                                           trage 5 Schritte ein. Au&szlig;erdem ben&ouml;tigen wir noch Deine Schuhgr&ouml;&szlig;e.   <br /><br />
                                        </div>
                                    </span>
                                    <fieldset class="ui-grid-a">
                                        <div class="ui-block-a">
                                            <div data-role="fieldcontain">
                                                <label for="step3-broadj-size">Schuhgr&ouml;&szlig;e (EU): </label>
                                                <input tabindex="10" class="step3-inputs" name="step3-broadj-size" id="step3-broadj-size" value="<?php echo $_SESSION["broadj-size"]; ?>" type="number" step="0.5"/>
                                             </div>
                                        </div>
                                        <div class="ui-block-b">
                                            <div data-role="fieldcontain">
                                                <label for="step3-broadj-steps">Anzahl der Schritte: </label> 
                                                <input tabindex="11" class="step3-inputs" name="step3-broadj-steps" id="step3-broadj-steps" value="<?php echo $_SESSION["broadj-steps"]; ?>" type="number"/>
                                            </div>
                                        </div>
                                    </fieldset> 
                                </div>
                                <div class="sf-test-block">
                                    <h3>Plank</h3>
                                    <span class="sf-content-text">
                                        <video id="test-plank-vid" class="video-js vjs-tech test-video"
                                                preload="auto" controls>
                                             <source src="videos/Plank.mp4" type='video/mp4' />
                                             <source src="videos/Plank.webm" type='video/webm' />
                                             <p class="vjs-no-js">Um dieses Video abzuspielen, aktiviere JavaScript oder nutze einen Browser, der HTML5 Video unterst&uuml;tzt. </p>
                                        </video>
                                        <br /><br />
                                        <a href="javascript: void(0)" class="testexplain plank-expl col-link">Erkl&auml;rungen <i class="arrow_carrot-down_alt2"></i></a>
                                        <div id="plank-expl">
                                            <h5>So lange wie m&ouml;glich halten</h5>
                                           Bei der Plank (oder auch Unterarmst&uuml;tz) st&uuml;tzt Du Dich aus der Bauchlage auf Deine Ellbogen und F&uuml;&szlig;e. 
                                           Halte Deine K&ouml;rperspannung, sodass Deine H&uuml;ften in einer Linie mit Deinen F&uuml;&szlig;en und Schultern sind.  <br /><br />
                                        </div>
                                    </span>
                                    <fieldset class="ui-grid-a">
                                        <div class="ui-block-a">
                                            <div data-role="fieldcontain">
                                                <label for="step3-plank-min">Anzahl Minuten: </label>
                                                <input tabindex="12" class="step3-inputs" name="step3-plank-min" id="step3-plank-min" value="<?php echo $_SESSION["plank-min"]; ?>" placeholder="Minuten" type="number"/>
                                        
                                            </div>
                                        </div>
                                        <div class="ui-block-b">
                                            <div data-role="fieldcontain">
                                                <label for="step3-plank-sec">Anzahl Sekunden: </label>
                                                <input tabindex="13" class="step3-inputs" name="step3-plank-sec" id="step3-plank-sec" value="<?php echo $_SESSION["plank-sec"]; ?>" placeholder="Sekunden" type="number"/>
                                            </div>
                                        </div>
                                    </fieldset>             
                                </div>
                                <div class="sf-test-block" id="test-pull">
                                    <h3>Klimmz&uuml;ge</h3>
                                    <span class="sf-content-text">
                                        <video id="test-pull-vid" class="video-js vjs-tech test-video"
                                                preload="auto" controls>
                                             <source src="videos/Pullup.mp4" type='video/mp4' />
                                             <source src="videos/Pullup.webm" type='video/webm' />
                                             <p class="vjs-no-js">Um dieses Video abzuspielen, aktiviere JavaScript oder nutze einen Browser, der HTML5 Video unterst&uuml;tzt. </p>
                                        </video>
                                        <br /><br />
                                        <a href="javascript: void(0)" class="testexplain pull-expl col-link">Erkl&auml;rungen <i class="arrow_carrot-down_alt2"></i></a>
                                        <div id="pull-expl">
                                            <h5>So viele Wiederholungen wie m&ouml;glich</h5>
                                           Ziehe Dich an einer Kante oder Stange (auf Spielpl&auml;tzen findest Du h&auml;ufig letztere) so hoch, dass Dein 
                                           Kinn dar&uuml;ber ist. Du kannst sowohl im Vordergriff, als auch im Hintergriff Klimmz&uuml;ge machen. <br /><br />
                                        </div>
                                    </span>
                                    <div data-role="fieldcontain">
                                        <label for="step3-pull">Anzahl Klimmz&uuml;ge: </label>
                                        <input tabindex="14" class="step3-inputs" name="step3-pull" id="step3-pull" value="<?php echo $_SESSION["pull"]; ?>" type="number"/>
                                    </div>
                                </div>
                                <div class="sf-test-block" id="test-flexedhang">
                                    <h3>Flexed Hang</h3>
                                    <span class="sf-content-text">
                                        <video id="test-flexedhang-vid" class="video-js vjs-tech test-video"
                                                preload="auto" controls>
                                             <source src="videos/Flexedhang.mp4" type='video/mp4' />
                                             <source src="videos/Flexedhang.webm" type='video/webm' />
                                             <p class="vjs-no-js">Um dieses Video abzuspielen, aktiviere JavaScript oder nutze einen Browser, der HTML5 Video unterst&uuml;tzt. </p>
                                        </video>
                                        <br /><br />
                                        <a href="javascript: void(0)" class="testexplain flexhang-expl col-link">Erkl&auml;rungen <i class="arrow_carrot-down_alt2"></i></a>
                                        <div id="flexhang-expl">
                                            <h5>So lange wie m&ouml;glich halten</h5>
                                           Halte Dich an einer Kante oder Stange mit angewinkelten Armen so lange wie m&ouml;glich fest. Du kannst einen Stuhl 
                                           oder Sprung nutzen, um in diese Position zu kommen. <br /><br />
                                        </div>
                                    </span>
                                    <div data-role="fieldcontain">
                                        <label for="step3-flexhang">Anzahl Sekunden: </label>
                                        <input tabindex="15" class="step3-inputs" name="step3-flexhang" id="step3-flexhang" value="<?php echo $_SESSION["flexhang"]; ?>" placeholder="Flexed Hang (Sek.)" type="number"/>
                                    </div>
                                </div>
                                <div class="sf-test-block" id="test-PU">
                                    <h3>Liegest&uuml;tze</h3>
                                    <span class="sf-content-text">
                                        <video id="test-PU-vid" class="video-js vjs-tech test-video"
                                                preload="auto" controls>
                                             <source src="videos/Pushup.mp4" type='video/mp4' />
                                             <source src="videos/Pushup.webm" type='video/webm' />
                                             <p class="vjs-no-js">Um dieses Video abzuspielen, aktiviere JavaScript oder nutze einen Browser, der HTML5 Video unterst&uuml;tzt. </p>
                                        </video>
                                        <br /><br />
                                        <a href="javascript: void(0)" class="testexplain PU-expl col-link">Erkl&auml;rungen <i class="arrow_carrot-down_alt2"></i></a>
                                        <div id="PU-expl">
                                            Bilder<br /><br />
                                            <h5>So viele Wiederholungen wie m&ouml;glich</h5>
                                           St&uuml;tze Dich vorw&auml;rts auf den H&auml;nden (etwa schulterbreit) und F&uuml;&szlig;en, wobei Deine H&uuml;ften in einer 
                                           Linie zu Deinen F&uuml;&szlig;en und Schultern bleibt. Nun beuge die Arme bis Deine Brust etwa 10 cm vor dem Boden ist 
                                           und dr&uuml;cke Dich wieder hoch. Dies ist eine Wiederholung. <br /><br />
                                        </div>
                                    </span>
                                    <div data-role="fieldcontain">
                                        <label for="step3-PU">Anzahl Liegest&uuml;tzen: </label>
                                        <input tabindex="16" class="step3-inputs" name="step3-PU" id="step3-PU" value="<?php echo $_SESSION["PU"]; ?>" placeholder="Liegest&uuml;tze" type="number"/>      
                                    </div>
                                </div>
                                <div class="sf-test-block" id="test-PUmod">
                                    <h3>Liegest&uuml;tze auf Knien</h3>
                                    <span class="sf-content-text">
                                        <video id="test-PUmod-vid" class="video-js vjs-tech test-video"
                                                preload="auto" controls>
                                             <source src="videos/KneePU.mp4" type='video/mp4' />
                                             <source src="videos/KneePU.webm" type='video/webm' />
                                             <p class="vjs-no-js">Um dieses Video abzuspielen, aktiviere JavaScript oder nutze einen Browser, der HTML5 Video unterst&uuml;tzt. </p>
                                        </video>
                                        <br /><br />
                                        <a href="javascript: void(0)" class="testexplain PUmod-expl col-link">Erkl&auml;rungen <i class="arrow_carrot-down_alt2"></i></a>
                                        <div id="PUmod-expl">
                                            <h5>So viele Wiederholungen wie m&ouml;glich</h5>
                                           St&uuml;tze Dich vorw&auml;rts auf den H&auml;nden (etwa schulterbreit) und Knien, wobei Deine H&uuml;ften in einer
                                           Linie zu Deinen Knien und Schultern bleibt. &Uuml;berkreuze Deine F&uuml;&szlig;e nicht. Nun beuge die Arme bis Deine Brust 
                                           etwa 10 cm vor dem Boden ist und dr&uuml;cke Dich wieder hoch. Dies ist eine Wiederholung. <br /><br />
                                        </div>
                                    </span>
                                    <div data-role="fieldcontain">
                                        <label for="step3-PUmod">Anzahl Liegest&uuml;tzen: </label> 
                                        <input tabindex="17" class="step3-inputs" name="step3-PUmod" id="step3-PUmod" value="<?php echo $_SESSION["PUmod"]; ?>" placeholder="Liegest&uuml;tze" type="number"/>
                                    </div>
                                </div>
                                <fieldset class="ui-grid-a">
                                    <div class="ui-block-a"><button id="step3-back" class="ui-shadow ui-btn ui-corner-all">Zur&uuml;ck</button></div>
                                    <div class="ui-block-b"><button tabindex="18" id="step3-submit" type="submit" class="ui-shadow ui-btn ui-corner-all">N&auml;chster Schritt</button></div>
                                </fieldset>
                        </div>
                    </div>
                    <div id="step4" class="ui-content">
                        <div class="sf-content-block">
                            <h3>Schritt 4: Cardio &amp; Agilit&auml;t</h3>
                                <div class="sf-test-block">
                                    <h3>Cooper Test</h3>
                                    <span class="sf-content-text">
                                            <h5>Laufe so weit wie m&ouml;glich in 12 Minuten</h5>
                                           Entweder kannst du mit Hilfe einer Tracking App deine Distanz messen, oder aber auf einer festgelegten
                                           Rundstrecke z.B. auf einem Sportplatz (400m Bahnen) laufen. Du bestimmst dein Tempo selbst - versuche jedoch,
                                           zu weit wie m&ouml;glich zu kommen. Danach hast du den FitTest fast geschafft!<br /><br />
                                    </span>
                                    <div data-role="fieldcontain">
                                        <label for="step4-cooper">Distanz (km): </label>
                                        <input tabindex="18" class="step4-inputs" name="step4-cooper" id="step4-cooper" value="<?php echo $_SESSION["cooper"]; ?>" type="number"/>
                                    </div>
                                </div>
                                <div class="sf-test-block">
                                    <h3>Erholungspuls</h3>
                                    <span class="sf-content-text">
                                        <video id="test-puls-vid" class="video-js vjs-tech test-video"
                                                preload="auto" controls>
                                             <source src="videos/Erholungspuls.mp4" type='video/mp4' />
                                             <source src="videos/Erholungspuls.webm" type='video/webm' />
                                             <p class="vjs-no-js">Um dieses Video abzuspielen, aktiviere JavaScript oder nutze einen Browser, der HTML5 Video unterst&uuml;tzt. </p>
                                        </video>
                                        <br /><br />
                                        <a href="javascript: void(0)" class="testexplain recovrate-expl col-link">Erkl&auml;rungen <i class="arrow_carrot-down_alt2"></i></a>
                                        <div id="recovrate-expl">
                                            <h5>Puls 3 Minuten nach Belastung</h5>
                                            Messe am Handgelenk oder Hals Deinen Puls, nachdem Du 3 Minuten Pause seit dem Cooper Test gemacht hast. 
                                            Z&auml;hle dazu 1 Minute lang die sp&uuml;rbaren Schl&auml;ge. <br /><br />
                                        </div>
                                    </span>
                                    <div data-role="fieldcontain">
                                        <label for="step4-recovrate">Erholungspuls nach 3 Min.: </label>
                                        <input tabindex="19" class="step4-inputs" name="step4-recovrate" id="step4-recovrate" value="<?php echo $_SESSION["recovrate"]; ?>" placeholder="Puls nach 3 Min." type="number"/>
                                    </div>
                                </div>
                                <div id="test-not-complete">
                                    Bitte absolviere zuerst alle &Uuml;bungen des FitTests bevor du zur Auswertung weitergehst. <br />
                                    Auf diese Weise k&ouml;nnen wir dir einen echten Mehrwert bieten.<br /><br />
                                    Du kannst den Test zu einem anderen Zeitpunkt weitermachen und dann einfach &uuml;ber den Link in 
                                    deiner Registrierungsemail zu diesen Seiten zur&uuml;ckkehren. Allerdings solltest du zwischen der 
                                    ersten und letzten &Uuml;bung nicht mehr als drei Tage verstreichen lassen. 
                                </div>
                                <fieldset class="ui-grid-a">
                                    <div class="ui-block-a"><button id="step4-back" class="ui-shadow ui-btn ui-corner-all">Zur&uuml;ck</button></div>
                                    <div class="ui-block-b"><button tabindex="20" id="step4-submit" type="submit" class="ui-shadow ui-btn ui-corner-all">Test abschlie&szlig;en</button></div>
                                </fieldset>
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
	<span class="copyright">
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