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
		<div class="column-swiper">
			<div class="column" id="col-dashboard">
				<a class="next" href="#"><span class="linkindicwrap"><span class="linkindic"><img src="images/b_arrow_right.png" alt="" /></span></span></a>
				<h2>My Sidefits</h2>
				<div class="content-block sidefits">
					<ul class="content-list sidefits-list">
						<li>
							<div class="image">
								<img src="images/Usr_phil.png" alt="" />
							</div>
							<div>
								<div class="buttonlinks">
									<!--<a href="#"><img class="add" src="images/b_add.png" alt="add" /></a>-->
									<a href="#"><img class="challenge" src="images/b_challenge_dark.png" alt="challenge" /></a>
									<a href="#"><img class="message" src="images/b_message_dark.png" alt="message" /></a>
								</div>
								<h4>Phil</h4>
								<p>
									Copenhagen<br />
									<i>Crossfit, Climbing, Gym</i><br />
									<i>Obstacle Races</i>
								</p>
							</div>
						</li>
						<li>
							<div class="image">
								<img src="images/Usr_lisa.png" alt="" />
							</div>
							<div>
								<div class="buttonlinks">
									<!--<a href="#"><img class="add" src="images/b_add.png" alt="add" /></a>-->
									<a href="#"><img class="challenge" src="images/b_challenge_dark.png" alt="challenge" /></a>
									<a href="#"><img class="message" src="images/b_message_dark.png" alt="message" /></a>
								</div>
								<h4>Lisa</h4>
								<p>
									Munich<br />
									<i>Gym, Crossfit</i><br />
									<i>none yet</i>
								</p>
							</div>
						</li>
						<li>
							<div class="image">
								<img src="images/Usr_chris.png" alt="" />
							</div>
							<div>
								<div class="buttonlinks">
									<!--<a href="#"><img class="add" src="images/b_add.png" alt="add" /></a>-->
									<a href="#"><img class="challenge" src="images/b_challenge_dark.png" alt="challenge" /></a>
									<a href="#"><img class="message" src="images/b_message_dark.png" alt="message" /></a>
								</div>
								<h4>Chris</h4>
								<p>
									Copenhagen<br />
									<i>Freeletics, Gym</i><br />
									<i>none yet</i>
								</p>
							</div>
						</li>
					</ul>
					<h3>Also following</h3>
					<ul class="content-list separated sidefits-list">
						<li>
							<div class="image">
								<img src="images/Usr_peter.png" alt="" />
							</div>
							<div>
								<div class="buttonlinks">
									<!--<a href="#"><img class="add" src="images/b_add.png" alt="add" /></a>-->
									<a href="#"><img class="challenge" src="images/b_challenge_dark.png" alt="challenge" /></a>
									<a href="#"><img class="message" src="images/b_message_dark.png" alt="message" /></a>
								</div>
								<h4>Peter</h4>
								<p>
									Kiel<br />
									<i>Crossfit,Gym</i><br />
									<i>Obstacle Races</i>
								</p>
							</div>
						</li>
					</ul>
					<a href="#" class="left" style="font-weight: bold;"><span style="color: #4CB0A9;">+</span> Add a friend</a>
					<br class="clear" />
				</div>
			</div>
			<div class="column" id="col-dashboard">
				<a class="prev" href="#"><span class="linkindicwrap"><span class="linkindic"><img src="images/b_arrow_left.png" alt="" /></span></span></a>
				<a class="next" href="#"><span class="linkindicwrap"><span class="linkindic"><img src="images/b_arrow_right.png" alt="" /></span></span></a>
				<h2>Hey Josch, what's up?</h2>				
				<div class="content-block challenges">
					<h3>New Challenges waiting:</h3>
					<ul class="content-list separated challenges-list">
						<li>
							<div class="image">
								<img src="images/Misc_pullup.png" alt="" />
							</div>
							<div>
								<div class="points">
									<span>+</span> <span class="value">50</span><span class="unit">CP</span>
								</div>
								<h4>Death by Pullups</h4>
								<p>Are you fit enough to beat the champs at the bar? Let‘s go, find it out!</p>
								<div class="textlinks">
									<a href="#" class="green">Participate</a>
									<a href="#" class="green">Remember</a>
									<a href="#" class="green">Share</a>
								</div>
							</div>
						</li>
						<li>
							<div class="image">
								<img src="images/Misc_run.png" alt="" />
							</div>
							<div>
								<div class="points">
									<span>+</span> <span class="value">70</span><span class="unit">CP</span>
								</div>
								<h4>Burning Legs</h4>
								<p>Today is totally no skip legs day! Prove that you have what it takes.</p>
								<div class="textlinks">
									<a href="#" class="green">Participate</a>
									<a href="#" class="green">Remember</a>
									<a href="#" class="green">Share</a>
								</div>
							</div>
						</li>
					</ul>
					<a href="#" class="left color-link">More...</a>
					<a href="createChallenge.php" class="right color-link"><span class="linkindicwrap"><span class="linkindic">Create Challenge</span></span></a>
					<br class="clear" />
				</div>
				<div class="content-block sidefits">
					<h3>Do you know those Sidefits?</h3>
					<ul class="content-list separated sidefits-list">
						<li>
							<div class="image">
								<a href="profile.php"><img src="images/Usr_lora.png" alt="" /></a>
							</div>
							<div>
								<div class="buttonlinks">
									<a href="#"><img class="add" src="images/b_add.png" alt="add" /></a>
									<a href="#"><img class="challenge" src="images/b_challenge_dark.png" alt="challenge" /></a>
									<a href="#"><img class="message" src="images/b_message_dark.png" alt="message" /></a>
								</div>
								<h4><a href="profile.php"><span class="linkindicwrap"><span class="linkindic">Lora</span></span></a></h4>
								<p>
									Munich<br />
									<i>Crossfit, Running, Teamsports, Marathon, Halfmarathon</i>
								</p>
							</div>
						</li>
					</ul>
					<a href="#" class="left color-link">More...</a>
					<a href="#" class="right color-link">Invite Friends</a>
					<br class="clear" />
				</div>
				<div class="content-block events">
					<h3>How about the next big thing?</h3>
					<ul class="content-list separated events-list">
						<li>
							<div class="image">
								<img src="images/Misc_mudder.png" alt="" />
							</div>
							<div>
								<div class="date">
									<span class="day-month">0x.0x.</span><span class="year">15</span>
								</div>
								<h4>Tough Mudder Hamburg</h4>
								<p>
									<i>Obstacle Run</i><br />
									"There's nothing like that feeling when you made it!"
								</p>
								<div class="textlinks">
									<a href="#" class="green">Participate</a>
									<a href="#" class="green">Remember</a>
									<a href="#" class="green">Share</a>
								</div>
							</div>
						</li>
						<li>
							<div class="image">
								<img src="images/Misc_reborn.png" alt="" />
							</div>
							<div>
								<div class="date">
									<span class="day-month">06.06.</span><span class="year">15</span>
								</div>
								<h4>Reborn Raw Hamburg</h4>
								<p>
									<i>Obstacle Run</i><br />
									"There's nothing like that feeling when you made it!"
								</p>
								<div class="textlinks">
									<a href="#" class="green">Participate</a>
									<a href="#" class="green">Remember</a>
									<a href="#" class="green">Share</a>
								</div>
							</div>
						</li>
					</ul>
					<a href="#" class="left color-link">More...</a>
					<a href="#" class="right color-link">Create Event</a>
					<br class="clear" />
				</div>
			</div>
			<div class="column" id="col-dashboard">
				<a class="prev" href="#"><span class="linkindicwrap"><span class="linkindic"><img src="images/b_arrow_left.png" alt="" /></span></span></a>
				<a class="next" href="#"><span class="linkindicwrap"><span class="linkindic"><img src="images/b_arrow_right.png" alt="" /></span></span></a>
				<h2>Upcoming Challenges &amp; Events</h2>				
				<div class="content-block events">
					<h3>Shortly due</h3>
					<ul class="content-list separated challenges-list">
						<li>
							<div class="image">
								<img src="images/Misc_pullup.png" alt="" />
							</div>
							<div>
								<div class="points">
									<span>+</span> <span class="value">50</span><span class="unit">CP</span><br />
									<br />
									<a href="#"><img src="images/B_submenu.png" alt="" /></a>
								</div>
								<h4>Death by pullups</h4>
								<div class="date">
									<span class="day-month">0x.0x.</span><span class="year">15</span>
								</div>
								<p>
									Each minute do as many pullups as the current time states. Until death.
								</p>
							</div>
							<div class="participations">
								<img src="images/Usr_unknown_small.png" alt="" class="none" /><span>Invite Sidefits<br />to participate!</span>
							</div>
						</li>
					</ul>
					<h3>Ongoing</h3>
					<ul class="content-list separated challenges-list">
						<li>
							<div class="image">
								<img src="images/Misc_king.png" alt="" />
							</div>
							<div>
								<div class="points">
									<span>+</span> <span class="value">40</span><span class="unit">CP</span><br />
									<br />
									<a href="#"><img src="images/B_submenu.png" alt="" /></a>
								</div>
								<h4>KING & QUEEN otw</h4>
								<div class="date">
									<span class="day-month">0x.0x.</span><span class="year">15</span>
								</div>
								<p>
									Finish our special workout of the week as fast as you can and win the crown.
								</p>
							</div>
							<div class="participations">
								<span>Sidefits<br />participating:</span>
								<img src="images/Usr_chris_small.png" alt="" />
								<img src="images/Usr_lisa_small.png" alt="" />
								<img src="images/Usr_phil_small.png" alt="" />
							</div>
						</li>
					</ul>
					<!--
					<a href="#" class="left color-link">More...</a>
					<a href="#" class="right color-link">Create Event</a>
					-->
					<br class="clear" />
				</div>
			</div>
			<div class="column" id="col-dashboard">
				<a class="prev" href="#"><span class="linkindicwrap"><span class="linkindic"><img src="images/b_arrow_left.png" alt="" /></span></span></a>
				<h2>Completed Challenges & Events</h2>				
				<div class="content-block events">
					<h3 class="block">
						Last Month
						<div class="sum"><span>A total of </span><span>120</span><span>CP</span></div>
					</h3>
					<ul class="content-list separated challenges-list">
						<li>
							<div class="image">
								<img src="images/Misc_pullup.png" alt="" />
							</div>
							<div>
								<div class="points">
									<span class="operate">earned</span> <span class="value">50</span><span class="unit">CP</span><br />
									<br />
								</div>
								<h4>Death by pullups</h4>
								<p>
									<i>Completed on: 12.11.2014</i><br />
									Result: <strong>Finish 8th minute</strong>
								</p>
								<div class="scala">
									<div style="left:20%;" class="indicator">
										<img src="images/Stat_indic_small.png" alt="" />
									</div>
									<img src="images/Stat_scale_small.png" alt="" />
								</div>
							</div>
						</li>
						<li>
							<div class="image">
								<img src="images/Misc_run.png" alt="" />
							</div>
							<div>
								<div class="points">
									<span class="operate">earned</span> <span class="value">40</span><span class="unit">CP</span><br />
									<br />
									<a href="#"><img src="images/B_redo.png" alt="" /></a>
								</div>
								<h4>Fast as Hell (10km)</h4>
								<p>
									<i>Completed on: 08.11.2014</i><br />
									Result: <strong>10km in 39:44min</strong>
								</p>
								<div class="scala">
									<div style="left:82%;" class="indicator">
										<img src="images/Stat_indic_small.png" alt="" />
									</div>
									<img src="images/Stat_scale_small.png" alt="" />
								</div>
							</div>
						</li>
					</ul>
					<!--
					<a href="#" class="left color-link">More...</a>
					<a href="#" class="right color-link">Create Event</a>
					-->
					<br class="clear" />
				</div>
			</div>
			<br class="clear" />
		</div>
	</div>
</body>
</html>