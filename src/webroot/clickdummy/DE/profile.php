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
				<a href="#" class="notification"><img src="images/b_challenge.png" alt="notifications"/></a>
				<a href="#" class="message"><img src="images/b_message.png" alt="messages"/></a>
				<a href="#" class="settings"><img src="images/b_settings.png" alt="settings"/></a>
			</div>
		</div>
		<div id="profile">
			<h2 class="strong">Lora</h2>				
			<div class="content-block">
				<div class="profile-image">
					<img class="autofit" src="images/Usr_lora_profile.png" alt="" />
				</div>
				<div class="profile-misc">
					<div class="points">
						<span class="value">76</span><span class="unit">FP</span>
					</div>
					<div class="scala">
						<div style="left:60%;" class="indicator">
							<img src="images/Stat_indic_small.png" alt="" />
						</div>
						<img src="images/Stat_scale_small.png" alt="" />
					</div>
					<p>Hamburg<br /><i>Touch Rugby, Ultimate Frisbee, Volleyball, Laufen</i></p>
				</div>
				<br class="clear" />
				<div class="profile-body">
					<h3>Profilinformationen</h3>
					<p>Hier erscheinen die Profilinhalte wie etwa bevorzugte Workoutzeiten und -intensit&auml;ten, Teilnahmen an Veranstaltungen und Herausforderungen, allgemeine Ziele, Zitate von Idolen, Kommunikationskan&auml;le etc..</p><br />
					<h4>Kommentar</h4>
					<p>Dieser Entwurf nimmt an, dass Lora alle Profilinhalte mit ihren potentiellen Sidefits teilt. Sie kann diese Einstellungen jedoch jederzeit in ihren Kontoeinstellungen &auml;ndern.</p>
					<br /><br /><p class="right vMiddle">
						<a href="#" class="settings"><img width="20" height="auto" src="images/b_add.png" alt="add"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="#" class="notification"><img width="30" height="auto" src="images/b_challenge_dark.png" alt="notifications"/></a>&nbsp;&nbsp;&nbsp;
						<a href="#" class="message"><img width="35" height="auto" src="images/b_message_dark.png" alt="messages"/></a>
					</p>
				</div>
			</div>
		</div>
		<br class="clear" />
	</div>
</body>
</html>