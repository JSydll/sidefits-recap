<?php
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
	<title>Sidefits</title>
	<script src="jquery-1.11.1.min.js"></script>
	<script src="hammer.min.js"></script>
	<script src="script.js"></script>
	<link rel="stylesheet" href="style.css" />
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic|Roboto+Condensed:300,300italic' rel='stylesheet' type='text/css'/>
</head>
<body>
	<?php include("menu.php"); ?>
	<div id="page">
		<div id="header">
			<a href="#menu" id="menubutton"><img id="icon" src="images/B_sidefits_icon.png" alt="icon" /></a>
			<div class="buttons">
				<a href="#" class="settings"><img src="images/b_settings.png" alt="settings"/></a>
			</div>
		</div>
		<div id="analytics">
		<h2>Mein Fitness Status</h2>
			<div class="content-block">
				<div class="points main">
						<span class="value">102</span><span class="unit">FP</span><br />
						<div class="scala">
    						<div style="left:70%;" class="indicator">
    							<img src="images/Stat_indic_small.png" alt="" />
    						</div>
    						<img src="images/Stat_scale_big.png" alt="" />
    					</div>
					</div>
					<p>
                    Dieser Wert repr&auml;sentiert deine derzeitige Konstitution.
                    </p>
                    <p>
                    Im Folgenden sind die letzten Testergebnisse in den f&uuml;nf Dimensionen der Konstitution aufgezeigt.
                    </p>
                    <p>
                    <ul>
                        <li>
                            <span style="float: left"><span class="title"><span style="color: #4CB0A9">CARDIO<br />VASCUL&Auml;RE</span><br />AUSDAUER</span></span>
                            <span style="float: right">
                                <div class="points small">
            						<span class="value">24</span><span class="unit">FP</span><br />
            						<div class="scala">
                						<div style="left:80%;" class="indicator">
                							<img src="images/Stat_indic_small.png" alt="" />
                						</div>
                						<img src="images/Stat_scale_small.png" alt="" />
                					</div>
            					</div>
                            </span>
                        </li>
                        <li>
                            <span style="clear: both; float: left"><span class="title"><span style="color: #4CB0A9">MUSKUL&Auml;RE</span><br />AUSDAUER</span></span>
                            <span style="float: right">
                                <div class="points small">
            						<span class="value">20</span><span class="unit">FP</span><br />
            						<div class="scala">
                						<div style="left:55%;" class="indicator">
                							<img src="images/Stat_indic_small.png" alt="" />
                						</div>
                						<img src="images/Stat_scale_small.png" alt="" />
                					</div>
            					</div>
                            </span>
                        </li>
                        <li>
                            <span style="clear: both; float: left"><span class="title"><span style="color: #4CB0A9">MUSKUL&Auml;RE</span><br />KRAFT</span></span>
                            <span style="float: right">
                                <div class="points small">
            						<span class="value">18</span><span class="unit">FP</span><br />
            						<div class="scala">
                						<div style="left:45%;" class="indicator">
                							<img src="images/Stat_indic_small.png" alt="" />
                						</div>
                						<img src="images/Stat_scale_small.png" alt="" />
                					</div>
            					</div>
                            </span>
                        </li>
                        <li>
                            <span style="clear: both; float: left"><span class="title"><span style="color: #4CB0A9">BODY</span><br />COMPOSITION</span></span>
                            <span style="float: right">
                                <div class="points small">
            						<span class="value">21</span><span class="unit">FP</span><br />
            						<div class="scala">
                						<div style="left:75%;" class="indicator">
                							<img src="images/Stat_indic_small.png" alt="" />
                						</div>
                						<img src="images/Stat_scale_small.png" alt="" />
                					</div>
            					</div>
                            </span>
                        </li>
                        <li style="border-bottom: none;">
                            <span style="clear: both; float: left"><span class="title"><span style="color: #4CB0A9">FLEXIBILIT&Auml;T</span></span></span>
                            <span style="float: right">
                                <div class="points small">
            						<span class="value">19</span><span class="unit">FP</span><br />
            						<div class="scala">
                						<div style="left:50%;" class="indicator">
                							<img src="images/Stat_indic_small.png" alt="" />
                						</div>
                						<img src="images/Stat_scale_small.png" alt="" />
                					</div>
            					</div>
                            </span>
                        </li>
                    </ul>
                    </p>
                    <p>
                    <h3>Meine Testergebnisse im Zeitverlauf</h3>
                    <br class="clear" />
                    <img src="images/Stat_graph_full.png" style="max-width: 300px; margin: 2em 0;" alt="" />
                    </p>
                    <div style="width: 100%; height: 10px"></div>   
				<a href=""><div class="button" style="height: 25px; clear: both; float: left;">KOMPLETTE <span style="color: #FFFFFF;">ANALYSE</span></div></a>
			    <a href=""><div class="button" style="height: 25px; float: right;"><span style="color: #FFFFFF;">TEST</span> WIEDERHOLEN</div></a>
            </div>
		</div>
	</div>
</body>
</html>