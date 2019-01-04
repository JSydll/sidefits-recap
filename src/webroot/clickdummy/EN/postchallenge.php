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
    <script language="javascript" type="text/javascript">
    window.setTimeout(function(){
            window.location = "dashboard.php";    
        }, 6000);    
    </script>
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
		<div id="postchallenge">
			<div class="content-block">
			     <p style="margin-top: 10px;"><h3>Wonderful, your Sidefits will be challenged soon!</h3></p>
                 <p style="margin-top: 20px;">But remember: You'll have to complete it first, before anyone can be challenged. It will soon appear on your 'Upcoming Challenges' tab.</p>
                 <p style="margin-top: 20px; font-size: 70%">If you don't get redirected in a few seconds, <a href="dashboard.php">please click here</a>.</p>	
            </div>
		</div>
	</div>
</body>
</html>