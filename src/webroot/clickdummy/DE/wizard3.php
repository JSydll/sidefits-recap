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
		<div id="wizard">
			<div class="content-block">
				<h2>Step<span class="black">3</span></h2>
				<h3>Fordere deine Sidefits direkt heraus!</h3>
				
				<ul class="content-list sidefits-list challenge">
					<li>
						<div class="image">
							<img src="images/Usr_phil.png" alt="">
						</div>
						<div>
							<img class="challenged" src="images/B_challenged.png" alt="" title="" />
							<p>
								<h4>Phil</h4>
								<i>Crossfit, Klettern, Studio</i>
							</p>
						</div>
					</li>
				</ul>
				<span style="position: absolute; margin-top: 0.5em; color: #4CB0A9; left: 0;">Wie<br />w&auml;re es<br />mit...</span>
				<ul class="content-list sidefits-list challenge" style="border: none;">
					<li>
						<div class="image">
							<img src="images/Usr_lisa.png" alt=""/>
						</div>
						<div>
						  <p>
								<h4>Lisa</h4>
								<i>Studio, Crossfit</i>
								<span style="float: right; color: #4CB0A9"><img width="15px" height="auto" src="images/b_add.png" alt="" title="" /> Hinzuf&uuml;gen</span>
						  </p>
                        </div>
							
					</li>
					<li>
						<div class="image">
							<img src="images/Usr_chris.png" alt=""/>
						</div>
						<div>
							<p>
								<h4>Chris</h4>
								<i>Freeletics, Studio</i>
								<span style="float: right; color: #4CB0A9"><img width="15px" height="auto" src="images/b_add.png" alt="" title="" /> Hinzuf&uuml;gen</span>
							</p>
						</div>
					</li>
					<li>
						<div>
							<img class="" width="15px" height="auto" src="images/b_add.png" alt="" title="" style="margin-left: 75px;" /> <span style="color: #4CB0A9">Weitere hinzuf&uuml;gen</span>
						</div>
					</li>
				</ul>
				<br />
				<p>Je mehr Sidefits du direkt herausforderst, desto bekannter wird deine Herausforderung. Aber keine Sorge: Wir werden auch so andere Sportler mit dieser Herausforderung konfrontieren.</p>
				<br /><br />
				<a href="postchallenge.php"><div class="button" style="height: 25px; float: right"><span class="linkindicwrap"><span class="linkindic"><span style="color: #FFFFFF;">LOS </span>GEHT'S!</span></span></div></span></a>
			</div>
		</div>
	</div>
</body>
</html>