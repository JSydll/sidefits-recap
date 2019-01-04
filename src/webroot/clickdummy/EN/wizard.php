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
			<h2>Let's do some challenging magic!</h2>
		<div id="wizard">
			<div class="content-block">
				<p><a href="javascript:void(0)" onclick="showhelp();"><span class="linkindicwrap"><span class="helper linkindic"><img src="images/B_help.png" width="15" height="15" alt="" /> Show me some explanations</span></span></a></p>
                <div id="helpbox">
                    <a href="javascript:void(0)" onclick="hidehelp();"><span style="float: right; color: #4CB0A9">CLOSE</span></a>
                    <br style="clear: both"/>
                    <p>Our Challenge Wizard helps you to create demanding challenges for you and your Sidefits.</p>
                    <p>After selecting your preferred difficulty and challenge type the wizard will suggest suitable exercises.</p>
                    <p>Be aware that you have to complete your own challenge before it's going to be published.</p>
                    
                </div>
                
				<h2>Step<span class="black">1</span></h2>
				<h3>Select your exercises and round settings</h3>
				
				<div class="selectblock">
					<span class="title"><span style="color: #4CB0A9">UPPER</span><br />BODY</span>
					<ul>
						<li>
							<input type="checkbox" id="cb1" /><label for="cb1">Pushups</label>
						</li>
						<li>
							<input type="checkbox" id="cb2" /><label for="cb2">Bodyweight Tricep Curls</label>
						</li>
						<li>
							<input type="checkbox" id="cb3" /><label for="cb3">Pullups</label>
						</li>
					</ul>
					<br class="clear" />
				</div>
				
				<div class="selectblock">
					<span class="title"><span style="color: #4CB0A9">CORE</span></span>
					<ul>
						<li>
							<input type="checkbox" id="cb4" /><label for="cb4">Situps</label>
						</li>
						<li>
							<input type="checkbox" id="cb5" /><label for="cb5">Plank</label>
						</li>
						<li>
							<input type="checkbox" id="cb6" /><label for="cb6">Bicycle</label>
						</li>
					</ul>
					<br class="clear" />
				</div>
				
				<div class="selectblock">
					<span class="title"><span style="color: #4CB0A9">LOWER</span><br />BODY</span>
					<ul>
						<li>
							<input type="checkbox" id="cb4" /><label for="cb4">Walking Lunges</label>
						</li>
						<li>
							<input type="checkbox" id="cb5" /><label for="cb5">Box Jumps</label>
						</li>
						<li>
							<input type="checkbox" id="cb6" /><label for="cb6">Squats</label>
						</li>
					</ul>
					<br class="clear" />
				</div>
				
				<div class="selectblock">
					<span class="title"><span style="color: #4CB0A9">FULL<br />BODY</span><br />EFFECT</span>
					<ul>
						<li>
							<input type="checkbox" id="cb4" /><label for="cb4">Walking Lunges</label>
						</li>
						<li>
							<input type="checkbox" id="cb5" /><label for="cb5">Box Jumps</label>
						</li>
						<li>
							<input type="checkbox" id="cb6" /><label for="cb6">Squats</label>
						</li>
					</ul>
					<br class="clear" />
				</div>
				
				<div class="total-rounds">
					<label>Total rounds:</label>
					<input type="text" class="small" value="5" />
				</div>
				
				
				<h3>Setup your exercises (repetitions/ time in sec)</h3>
				<ul class="repetitions">
					<li class="exercise">
						<span class="title">Pullups</span>
						<ul>
							<li><input type="text" class="small" value="25"/></li>
							<li><input type="text" class="small" value="20"/></li>
							<li><input type="text" class="small" value="15"/></li>
							<li><input type="text" class="small" value="10"/></li>
							<li><input type="text" class="small" value="5"/></li>
							<li><a class="add" href="#">+</a></li>
						</ul>
					<li class="exercise">
						<span class="title">Situps</span>
						<ul>
							<li><input type="text" class="small" value="50"/></li>
							<li><input type="text" class="small" value="40"/></li>
							<li><input type="text" class="small" value="30"/></li>
							<li><input type="text" class="small" value="20"/></li>
							<li><input type="text" class="small" value="10"/></li>
							<li><a class="add" href="#">+</a></li>
						</ul>
					<li class="exercise">
						<span class="title">Squats</span>
						<ul>
							<li><input type="text" class="small" value="50"/></li>
							<li><input type="text" class="small" value="40"/></li>
							<li><input type="text" class="small" value="30"/></li>
							<li><input type="text" class="small" value="20"/></li>
							<li><input type="text" class="small" value="10"/></li>
							<li><a class="add" href="#">+</a></li>
						</ul>
					<li class="exercise">
						<span class="title">Burpees</span>
						<ul>
							<li><input type="text" class="small" value="25"/></li>
							<li><input type="text" class="small" value="20"/></li>
							<li><input type="text" class="small" value="15"/></li>
							<li><input type="text" class="small" value="10"/></li>
							<li><input type="text" class="small" value="5"/></li>
							<li><a class="add" href="#">+</a></li>
						</ul>
					</li>
				</ul>
				
				<a href="wizard2.php"><div class="button" style="height: 25px; float: right"><span class="linkindicwrap"><span class="linkindic"><span style="color: #FFFFFF;">NEXT </span>STEP</span></span></div></a>
			</div>
		</div>
	</div>
</body>
</html>