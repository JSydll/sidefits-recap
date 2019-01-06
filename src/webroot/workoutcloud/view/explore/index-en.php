<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="description" content="With Sidefits, you get your perfect workout, recommendations for exciting sports events and meet people on the same track. From athletes for athletes - no matter what level or goals you pursue.">
<meta name="keywords" content="Sidefits, sports, training, partner, buddy, sports events, match, workout, sports network">
<meta name="author" content="Sidefits">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<meta property=”og:title” content=”Sidefits - Enhance your sports experience” />
<meta property=”og:type” content=”website” />
<meta property=”og:url” content=”http://sidefits.com” />
<meta property=”og:image” content=”http://sidefits.com/images/apple-touch-icon-114x114.png” />
<meta property=”og:description” content=”With Sidefits, you get your perfect workout, recommendations for exciting sports events and meet people on the same track. From athletes for athletes - no matter what level or goals you pursue.” />

<!-- SITE TITLE -->
<title>Sidefits - Enhancing your sports experience</title>

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
<link rel="stylesheet" href="css/styles.css">

<!-- COLORS -->
<link rel="stylesheet" href="css/colors/blue-munsell.css">

<!-- RESPONSIVE FIXES -->
<link rel="stylesheet" href="css/responsive.css">


<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<script src="js/respond.min.js"></script>
<![endif]-->

<!-- JQUERY -->
<script src="js/jquery-1.11.1.min.js"></script>

<script language="javascript" type="text/javascript">
    function allowDrop(ev){
        ev.preventDefault();
    }
    function drag(ev){
        ev.dataTransfer.setData("Text",ev.target.id);
    }
    function drop(ev){
        ev.preventDefault();
        var data=ev.dataTransfer.getData("Text");
        ev.target.parentNode.replaceChild(document.getElementById(data), ev.target);
        document.getElementById(data).className = "";
    }
    
    function submit_product(){
        var features = $(".selfeat").serialize();
        alert(features);
    }
</script>

<style>
.selfeat {
    height:150px; width: 150px; 
    background-color: #111111;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    float: left;
    margin: 5px; 
    padding: 10px;  
}
.selfeat h3 {
    font-size: 15px; line-height: 1.2em;
}
.replacable {
    width: 100%; height: 100%;
}
@media (max-width: 767px) {
    .droparea {
        display: none;
    }
}
</style>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56616740-3', 'auto');
  ga('send', 'pageview');

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
<div class="color-overlay"> <!-- To make header full screen. Use .full-screen class with color overlay. Example: <div class="color-overlay full-screen">  -->

	<!-- STICKY NAVIGATION -->
	<div class="navbar navbar-inverse bs-docs-nav navbar-fixed-top sticky-navigation">
		<div class="container">
			<div class="navbar-header">
				
				<!-- LOGO ON STICKY NAV BAR -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#kane-navigation">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>

				<a class="navbar-brand" href="https://sidefits.com"><img src="images/Icon.png" alt=""></a>
				
			</div>
			
			<!-- NAVIGATION LINKS -->
			<div class="navbar-collapse collapse" id="kane-navigation">
				<ul class="nav navbar-nav navbar-right main-navigation">
					<li><a href="#issues">The problem</a></li>
					<li><a href="#ourstory">Our story</a></li>
					<li><a href="#goals">Goals</a></li>
					<li><a href="#contact">Contact</a></li>
				</ul>
			</div>
			
			<div class="lang-select">
                <a href="#" class="current-lang">EN</a> - <a href="index-de.php">DE</a>
            </div>
		</div> <!-- /END CONTAINER -->
	</div> <!-- /END STICKY NAVIGATION -->
	
	
	<!-- CONTAINER -->
	<div class="container">
		
		<!-- ONLY LOGO ON HEADER -->
		<div class="only-logo">
			<div class="navbar">
				<div class="navbar-header">
					<img src="images/logo.png" alt="">
				</div>
			</div>
		</div> <!-- /END ONLY LOGO ON HEADER -->
		
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				
				<!-- HEADING AND BUTTONS -->
				<div class="intro-section">
					
					<!-- WELCOM MESSAGE -->
					<h1 class="intro">We're passionate about sports.</h1>
					<h3 class="white-text">Switching off. Keeping the balance. Exploring the limits. People on the same track.</h3>
					
					<!-- BUTTON -->
					<div class="buttons" id="download-button">
						
						<a href="https://sidefits.com" class="btn btn-default btn-lg standard-button">Find your perfect workout now</a>
						
					</div>
					<!-- /END BUTTONS -->
					
				</div>
				<!-- /END HEADNING AND BUTTONS -->
				
			</div>
		</div>
		<!-- /END ROW -->
		
	</div>
	<!-- /END CONTAINER -->
</div>
<!-- /END COLOR OVERLAY -->
</header>
<!-- /END HEADER -->

<!-- =========================
     SERVICES
============================== -->
<section class="services" id="issues">

<div class="container">

	<!-- SECTION HEADER -->
	<div class="section-header wow fadeIn animated" data-wow-offset="10" data-wow-duration="1.5s">

		<!-- SECTION TITLE -->
		<h2 class="white-text">Everyone of us experiences these issues.</h2>

		<div class="colored-line">
		</div>
		<div class="section-description">
			<h3>Sports can give you so much - but sometimes it's getting hard to keep it up.</h3>
		</div>
		<div class="colored-line">
		</div>

	</div>
	<!-- /END SECTION HEADER -->

	<div class="row">

		<!-- SINGLE SERVICE -->
		<div class="col-md-4 single-service wow fadeIn animated" data-wow-offset="10" data-wow-duration="1.5s">

			<!-- SERVICE ICON -->
			<div class="service-icon">
				<i class="icon_dislike"></i>
			</div>

			<!-- SERVICE HEADING -->
			<h3>No Motivation</h3>

			<!-- SERVICE DESCRIPTION -->
			<p>
				 ... to get up from the couch? We experienced ourselves that if you loose motivation to get up and do some sports, you're loosing fun as well. And let's not talk about progress in that case...
			</p>

		</div>
		<!-- /END SINGLE SERVICE -->

		<!-- SINGLE SERVICE -->
		<div class="col-md-4 single-service wow fadeIn animated" data-wow-offset="10" data-wow-duration="1.5s">

			<!-- SERVICE ICON -->
			<div class="service-icon">
				<i class="icon_profile"></i>
			</div>

			<!-- SERVICE HEADING -->
			<h3>Feeling alone</h3>

			<!-- SERVICE DESCRIPTION -->
			<p>
                ... at the gym again? Ok, sometimes you just need to let off some steam alone. But on most days, a workout together with friends gets you that extra motivation you need.
			</p>

		</div>
		<!-- /END SINGLE SERVICE -->

		<!-- SINGLE SERVICE -->
		<div class="col-md-4 single-service wow fadeIn animated" data-wow-offset="10" data-wow-duration="1.5s">

			<!-- SERVICE ICON -->
			<div class="service-icon">
				<i class="icon_compass_alt"></i>
			</div>

			<!-- SERVICE HEADING -->
			<h3>Missing the focus</h3>

			<!-- SERVICE DESCRIPTION -->
			<p>
				 ... and a goal to work on? Not everyone has a coach who sets the bar height. And being fit is one thing. Another is to prove the results of your hard work from time to time in a sports event. 
			</p>

		</div>
		<!-- /END SINGLE SERVICE -->

	</div>
	<!-- /END ROW -->

</div>
<!-- /END CONTAINER -->

</section>
<!-- /END FEATURES SECTION -->

<!-- =========================
     TESTIMONIALS
============================== -->
<section class="testimonials" id="ourstory">

<div class="color-overlay">

	<div class="container wow fadeIn animated" data-wow-offset="10" data-wow-duration="1.5s">

		<!-- FEEDBACKS -->
		<div id="feedbacks" class="owl-carousel owl-theme">

			<!-- SINGLE FEEDBACK -->
			<div class="feedback">

				<!-- IMAGE -->
				<div class="image">
					<!-- i class=" icon_quotations"></i -->
					<img src="images/Phil.png" alt="">
				</div>

				<div class="message">
                    I always struggled to find a suitable partner to climb with, who has the same ambitions and is on a similar level as I am. With Sidefits, we are going to change that!
				</div>

				<div class="white-line">
				</div>

				<!-- INFORMATION -->
				<div class="name">
					Phil
				</div>
				<div class="company-info">
					Co-Founder<br />
					Marketing - Finance
				</div>

			</div>
			<!-- /END SINGLE FEEDBACK -->

			<!-- SINGLE FEEDBACK -->
			<div class="feedback">

				<!-- IMAGE -->
				<div class="image">
					<!-- i class=" icon_quotations"></i -->
					<img src="images/Josch.png" alt="">
				</div>

				<div class="message">
                    You know these people who are always searching the next challenge? I'm one of these guys. And it's getting really uncomfy around me, if I'm not getting new food. But finding someone with the same passion as well as new training input takes up so much time!
				</div>

				<div class="white-line">
				</div>

				<!-- INFORMATION -->
				<div class="name">
					Josch
				</div>
				<div class="company-info">
					Co-Founder<br />
					Tech - Design
				</div>

			</div>
			<!-- /END SINGLE FEEDBACK -->

		</div>
		<!-- /END FEEDBACKS -->

	</div>
	<!-- /END CONTAINER -->

</div>
<!-- /END COLOR OVERLAY -->

</section>
<!-- /END TESTIMONIALS SECTION -->

<!-- =========================
     BRIEF LEFT SECTION
============================== -->
<section class="app-brief" id="goals">

<div class="container">

	<div class="row">

		<!-- PHONES IMAGE -->
		<div class="col-md-6 wow fadeInRight animated" data-wow-offset="10" data-wow-duration="1.5s">
			<div class="phone-image">
				<img src="images/2-iphone-left.png" alt="">
			</div>
		</div>

		<!-- RIGHT SIDE WITH BRIEF -->
		<div class="col-md-6 left-align wow fadeInLeft animated" data-wow-offset="10" data-wow-duration="1.5s">

			<!-- SECTION TITLE -->
			<h2 class="white-text">What we're about to do.</h2>

			<div class="colored-line-left">
			</div>

			<p>
                Sidefits is about creating a space for all the needs of sports people - on every level. From athletes for athletes. We spoke to you and worked with sports scientists to figure out some strings to pull first - but this is just the beginning! Your feedback is most important for us. Share your thoughts, we're happy to hear them.
			</p>

			<!-- FEATURE LIST -->
			<ul class="feature-list">
				<li><i class="icon_loading"></i> Let's break the vicious circle of loosing motivation, leading to less fun.</li>
				<li><i class="icon_link_alt "></i> Let's connect you with the right people and the right information.</li>
				<li><i class="icon_close"></i> Let's make searching obsolete.</li>
			</ul>
            

		</div>
		<!-- /END RIGHT BRIEF -->
    <div style="clear: both"></div>
	<div class="section-header wow fadeIn animated" data-wow-offset="10" data-wow-duration="1.5s">
		<h3>You want to know more?</h3>
        <div class="colored-line">
    	</div>
        <div class="section-description">
			It's more fun to unpack your presents on your birthday, not the day before - trust us. Have a little patience and be the first to know.<br /><br />
			<a href="#earlyaccess" class="col-link"><i class="arrow_carrot-down_alt2" style="font-size: 40px;"></i></a>
		</div>

	</div>
    
	</div>
	<!-- /END ROW -->

</div>
<!-- /END CONTAINER -->

</section>
<!-- /END SECTION -->

<!-- =========================
     FOOTER 
============================== -->
<footer>

<div class="container" id="contact">
	
	<div class="contact-box wow rotateIn animated" data-wow-offset="10" data-wow-duration="1.5s">
		
		<!-- CONTACT BUTTON TO EXPAND OR COLLAPSE FORM -->
		
		<a class="btn contact-button expand-form expanded"><i class="icon_mail_alt col_link"></i></a>
		
		<!-- EXPANDED CONTACT FORM -->
		<div class="row expanded-contact-form">
			
			<div class="col-md-8 col-md-offset-2">
				
				<!-- FORM -->
				<form class="contact-form" id="contact" role="form">
					
					<!-- IF MAIL SENT SUCCESSFULLY -->
					<h4 class="success">
						<i class="icon_check"></i> Your message has been sent successfully.
					</h4>
					
					<!-- IF MAIL SENDING UNSUCCESSFULL -->
					<h4 class="error">
						<i class="icon_error-circle_alt"></i> E-mail must be valid and message must be longer than 1 character.
					</h4>
					
					<div class="col-md-6">
						<input class="form-control input-box" id="name" type="text" name="name" placeholder="Your Name">
					</div>
					
					<div class="col-md-6">
						<input class="form-control input-box" id="email" type="email" name="email" placeholder="Your Email">
					</div>
					
					<div class="col-md-12">
						<input class="form-control input-box" id="subject" type="text" name="subject" placeholder="Subject">
						<textarea class="form-control textarea-box" id="message" rows="8" placeholder="Message"></textarea>
					</div>
					
					<button class="btn btn-primary standard-button2 ladda-button" type="submit" id="submit" name="submit" data-style="expand-left">Send Message</button>
					
				</form>
				<!-- /END FORM -->
				
			</div>
			
		</div>
		<!-- /END EXPANDED CONTACT FORM -->
		
	</div>
	<!-- /END CONTACT BOX -->
	
	<!-- LOGO -->
	<img src="images/logo.png" alt="LOGO" class="responsive-img">
	
	<!-- SOCIAL ICONS -->
	<ul class="social-icons">
		<li><a href="http://facebook.com/Sidefits" target="_blank"><i class="social_facebook_square"></i></a></li>
		<li><a href="http://instagram.com/sidefits_official" target="_blank"><i class="social_instagram_square"></i></a></li>
		<li><a href="mailto:info@sidefits.com"><i class="icon_mail "></i></a></li>

	</ul>
	
	<!-- COPYRIGHT TEXT -->
	<p class="copyright">
	   <p>
        This website and the project Sidefits are made with love in Hamburg/ Copenhagen.<br />
        We would like to thank all the people helping us on our journey!<br /><br />
        You can reach the responsibles with the contact form above or at the following address:<br />
        Joschka Sondhof und Philipp M&auml;gel GbR<br />
        Osterbrook 22<br />
        20537 Hamburg<br /><br />
        Please be advised that any links to external sources are tested on implementation time but not further monitored afterwards. <br />
        Therefore, we do not take responsibility for this type of content. 
       </p>
	   <br />
	   <p>
       Copyright 2016 by Sidefits.
       </p>		
	</p>

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