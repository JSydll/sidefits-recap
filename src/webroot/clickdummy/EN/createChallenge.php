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
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic|Roboto+Condensed:300,300italic' rel='stylesheet' type='text/css'>
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
			<h2>Create A New Challenge</h2>
		<div id="create-challenge">
			<div class="content-block">
				<h3>Select your sports and click on one of the buttons</h3>

				
			
				<p style="text-align: center;">
				<br />
				<input type="text" placeholder="e.g. 'Crossfit'" class="searchfield" /><button></button>
				<br /><br /><br />
				<a href="wizard.php" class="button big" >SEARCH <span style="color: #FFFFFF;">IN SIDEFITS</span></a><br />
				<a href="wizard.php" class="button big" ><span class="linkindicwrap"><span class="linkindic"><span style="color: #FFFFFF;">USE THE</span> WIZARD</span></span></a>
				</p>
			</div>
		</div>
	</div>
</body>
</html>