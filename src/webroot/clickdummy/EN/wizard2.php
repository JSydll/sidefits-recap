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
		<div id="wizard">
			<div class="content-block">
				<h2>Step<span class="black">2</span></h2>
				<h3>Just a little bit of text work</h3>
				
				<form>
					<div class="textfield">
						<label for="">Name</label>
						<input type="text" />
					</div>
					<div class="textarea">
						<label for="">Short description</label>
						<textarea rows="4" name="" id="" ></textarea>
						<br />
					</div>
					<div class="textfield">
						<label for="">Due date</label>
						<input type="text" placeholder="never" />
					</div>
					<div class="imageupload">
						<img src="images/Usr_unknown_medium.png" alt="" />
						<label for="">Select a preview picture</label>
					</div>
				</form>
				<br />
				<a href="wizard3.php"><div class="button" style="height: 25px; float: right"><span class="linkindicwrap"><span class="linkindic"><span style="color: #FFFFFF;">LAST </span>STEP</span></span></div></a>
			</div>
		</div>
	</div>
</body>
</html>