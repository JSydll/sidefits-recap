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
				<h2>Meine Sidefits</h2>
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
									Kopenhagen<br />
									<i>Crossfit, Klettern, Studio</i><br />
									<i>Hindernisl&auml;ufe</i>
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
									M&uuml;nchen<br />
									<i>Studio, Crossfit</i><br />
									<i>keine bis jetzt</i>
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
									Kopenhagen<br />
									<i>Freeletics, Studio, Laufen</i><br />
									<i>keine bis jetzt</i>
								</p>
							</div>
						</li>
					</ul>
					<h3>Auch gefolgt</h3>
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
									<i>Crossfit, Studio</i><br />
									<i>Hindernisl&auml;ufe</i>
								</p>
							</div>
						</li>
					</ul>
					<a href="#" class="left color-link">+ Freund(e) hinzuf&uuml;gen</a>
					<br class="clear" />
				</div>
			</div>
			<div class="column" id="col-dashboard">
				<a class="prev" href="#"><span class="linkindicwrap"><span class="linkindic"><img src="images/b_arrow_left.png" alt="" /></span></span></a>
				<a class="next" href="#"><span class="linkindicwrap"><span class="linkindic"><img src="images/b_arrow_right.png" alt="" /></span></span></a>
				<h2>Hey Josch, wie geht's?</h2>				
				<div class="content-block challenges">
					<h3>Neue Herausforderungen warten</h3>
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
								<p>Bist du fit genug, die Meister an der Klimmzugstange zu schlagen? Finde es heraus!</p>
								<div class="textlinks">
									<a href="#" class="green">Teilnehmen</a>
									<a href="#" class="green">Merken</a>
									<a href="#" class="green">Teilen</a>
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
								<p>Heute ist definitiv kein "Skip Legs Day"! Zeige, dass es in dir steckt.</p>
								<div class="textlinks">
									<a href="#" class="green">Teilnehmen</a>
									<a href="#" class="green">Merken</a>
									<a href="#" class="green">Teilen</a>
								</div>
							</div>
						</li>
					</ul>
					<a href="#" class="left color-link">Mehr...</a>
					<a href="createChallenge.php" class="right color-link"><span class="linkindicwrap"><span class="linkindic">Herausforderung erstellen</span></span></a>
					<br class="clear" />
				</div>
				<div class="content-block sidefits">
					<h3>Kennst du diese Sidefits?</h3>
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
									Hamburg<br />
									<i>Crossfit, Running und mehr</i><br />
									<i>Hindernisl&auml;ufe</i>
								</p>
							</div>
						</li>
					</ul>
					<a href="#" class="left color-link">Mehr...</a>
					<a href="#" class="right color-link">Freunde einladen</a>
					<br class="clear" />
				</div>
				<div class="content-block events">
					<h3>Was kommt als N&auml;chstes?</h3>
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
									<i>Hindernislauf</i><br />
									"Es gibt nichts besseres als das Gef&uuml;hl wenn du es geschafft hast!"
								</p>
								<div class="textlinks">
									<a href="#" class="green">Teilnehmen</a>
									<a href="#" class="green">Merken</a>
									<a href="#" class="green">Teilen</a>
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
									<i>Hindernislauf</i><br />
									"Sweat, Fear and Pain - das Versprechen wird gehalten - und ist es wert!"
								</p>
								<div class="textlinks">
									<a href="#" class="green">Teilnehmen</a>
									<a href="#" class="green">Merken</a>
									<a href="#" class="green">Teilen</a>
								</div>
							</div>
						</li>
					</ul>
					<a href="#" class="left color-link">Mehr...</a>
					<a href="#" class="right color-link">Trainingschallenge erstellen</a>
					<br class="clear" />
				</div>
			</div>
			<div class="column" id="col-dashboard">
				<a class="prev" href="#"><span class="linkindicwrap"><span class="linkindic"><img src="images/b_arrow_left.png" alt="" /></span></span></a>
				<a class="next" href="#"><span class="linkindicwrap"><span class="linkindic"><img src="images/b_arrow_right.png" alt="" /></span></span></a>
				<h2>N&auml;chste Herausforderungen &amp; Events</h2>				
				<div class="content-block events">
					<h3>Bald f&auml;llig</h3>
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
									Jede Minute so viele Klimmz&uuml;ge machen, wie die Anzahl bisheriger Minuten.
								</p>
							</div>
							<div class="participations">
								<img src="images/Usr_unknown_small.png" alt="" class="none" /><span>Lade Sidefits zum<br />Teilnehmen ein!</span>
							</div>
						</li>
					</ul>
					<h3>Laufend</h3>
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
								<h4>KING & QUEEN der Woche</h4>
								<div class="date">
									<span class="day-month">0x.0x.</span><span class="year">15</span>
								</div>
								<p>
									Beende unser spezielles Workout der Woche so schnell wie m&ouml;glich und erobere die Krone!
								</p>
							</div>
							<div class="participations">
								<span>Teilnehmende<br />Sidefits:</span>
								<img src="images/Usr_chris_small.png" alt="" />
								<img src="images/Usr_lisa_small.png" alt="" />
								<img src="images/Usr_phil_small.png" alt="" />
							</div>
						</li>
					</ul>
					<br class="clear" />
				</div>
			</div>
			<div class="column" id="col-dashboard">
				<a class="prev" href="#"><span class="linkindicwrap"><span class="linkindic"><img src="images/b_arrow_left.png" alt="" /></span></span></a>
				<h2>Beendete Herausforderungen &amp; Events</h2>				
				<div class="content-block events">
					<h3 class="block">
						Letzter Monat
						<div class="sum"><span>Insgesamt </span><span>120</span><span>CP</span></div>
					</h3>
					<ul class="content-list separated challenges-list">
						<li>
							<div class="image">
								<img src="images/Misc_pullup.png" alt="" />
							</div>
							<div>
								<div class="points">
									<span>+</span> <span class="value">50</span><span class="unit">CP</span><br />
									<br />
								</div>
								<h4>Death by pullups</h4>
								<p>
									<i>Beendet am: 12.11.2014</i><br />
									Ergebnis: <strong>8te Minute geschafft</strong>
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
									<span>+</span> <span class="value">40</span><span class="unit">CP</span><br />
									<br />
									<a href="#"><img src="images/B_redo.png" alt="" /></a>
								</div>
								<h4>Fast as Hell (10km)</h4>
								<p>
									<i>Beendet am: 08.11.2014</i><br />
									Ergebnis: <strong>10km in 39:44min</strong>
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

					<br class="clear" />
				</div>
			</div>
			<br class="clear" />
		</div>
	</div>
</body>
</html>