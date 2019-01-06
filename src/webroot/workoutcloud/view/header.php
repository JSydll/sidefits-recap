<?php
// HEADER ////////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html ng-app="workoutBox">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
        <meta name="fragment" content="!"/>
        <title>Find and create the most versatile workouts in the world. Now!</title>

        <meta name="description" content="The Sidefits WorkoutCloud suggests you the perfect bodyweight workout and lets you create your own workouts with ease. Start today!"/>
        <meta name="author" content="Sidefits"/>
        <meta name="keywords" content="sidefits, workoutcloud, workout, fitness, generator, ,wod, sixpack, crossfit, ,bodyweight, training, situps, squats, workout database, training database, creator, baukasten"/>

        <!-- Bootstrap Style Sheets -->
        <link rel="stylesheet" href="js/vendor/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="css/theme.min.css" type="text/css" />

        <!-- Bootstrap social -->
        <link rel="stylesheet" href="js/vendor/font-awesome/css/font-awesome.min.css" type="text/css" />
        <link rel="stylesheet" href="js/vendor/bootstrap-social/bootstrap-social.css" type="text/css" />

        <!-- General site styling -->
        <link href="css/styles.css" type="text/css" rel="stylesheet" media="all" />

        <!-- Lightbox styling -->
        <link rel="stylesheet" href="js/vendor/ekko-lightbox/ekko-lightbox.min.css" type="text/css" />

        <!-- WEB FONTS -->
        <link href='//fonts.googleapis.com/css?family=Roboto:100,300,100italic,400,300italic' rel='stylesheet' type='text/css'/>


        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod? n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n; n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0; t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window, document,'script','//connect.facebook.net/en_US/fbevents.js'); fbq('init', '954468861319103'); fbq('track', "PageView");</script> <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=954468861319103&ev=PageView&noscript=1"/></noscript>
        <!-- jQuery -->
        <script language="javascript" type="text/javascript" src="js/jquery-1.11.3.min.js"></script>

        <!-- Angular JS -->
        <script src="js/angular.min.js"></script>

        <!-- Inluding Angular UI Tree  -->
        <script language="javascript" type="text/javascript" src="js/angular-ui-tree.min.js"></script>
        <link rel="stylesheet" href="css/angular-ui-tree.min.css" type="text/css" />

        <!-- Angular UI Router with addon-->
        <script language="javascript" type="text/javascript" src="js/vendor/angular-ui-router/release/angular-ui-router.min.js"></script>
        <script language="javascript" type="text/javascript" src="js/vendor/ui-router-extras/release/ct-ui-router-extras.min.js"></script>

        <!-- Angular UI -->
        <script language="javascript" type="text/javascript" src="js/ui-bootstrap-tpls-1.2.4.min.js"></script>

        <!-- Angular Translate -->
        <script language="javascript" type="text/javascript" src="js/vendor/angular-translate/angular-translate.min.js"></script>
        <script language="javascript" type="text/javascript" src="js/vendor/angular-translate-loader-static-files/angular-translate-loader-static-files.min.js"></script>

        <!-- Angular Site Loading Bar -->
        <link rel="stylesheet" href="css/loading-bar.min.css" type="text/css" />
        <script language="javascript" type="text/javascript" src="js/loading-bar.min.js"></script>

        <!-- Angular Update Meta Tags -->
        <script language="javascript" type="text/javascript" src="js/vendor/angular-update-meta/dist/update-meta.min.js"></script>

        <!-- Angular Socialshare -->
        <script language="javascript" type="text/javascript" src="js/vendor/angular-socialshare/dist/angular-socialshare.min.js"></script>

        <!-- Angular Number Picker -->
        <script language="javascript" type="text/javascript" src="js/angular-number-picker.min.js"></script>

        <!-- Angular File Upload -->
        <script language="javascript" type="text/javascript" src="js/vendor/ng-file-upload/ng-file-upload.min.js"></script>
        <script language="javascript" type="text/javascript" src="js/vendor/ng-file-upload/ng-file-upload-shim.min.js"></script>

        <!-- Angular Toggle Switch -->
        <link rel="stylesheet" href="js/vendor/angular-toggle-switch/angular-toggle-switch-bootstrap-3.css" type="text/css" />
        <script language="javascript" type="text/javascript" src="js/vendor/angular-toggle-switch/angular-toggle-switch.min.js"></script>

        <!-- Angular range slider -->
        <script language="javascript" type="text/javascript" src="js/vendor/angular-slider/rzslider.min.js"></script>
        <link rel="stylesheet" href="js/vendor/angular-slider/rzslider.min.css" type="text/css" />

        <!-- Angular Animate -->
        <script src="js/vendor/angular-animate.js"></script>

        <!-- Angular Messages -->
        <script src="js/vendor/angular-messages.js"></script>

        <!-- Angular Resource -->
        <script src="js/vendor/angular-resource.js"></script>

        <!-- Angular Sanitize -->
        <script src="js/vendor/angular-sanitize.js"></script>

        <!-- Toastr -->
        <link href="css/angular-toastr.css" rel="stylesheet"/>
        <script src="js/vendor/angular-toastr.tpls.min.js"></script>

        <!-- Satellizer -->
        <script src="js/satellizer.min.js"></script>

        <!-- Angular Multi Step Form -->
        <script language="javascript" type="text/javascript" src="js/vendor/angular-multi-step-form/angular-multi-step-form.min.js"></script>

        <!-- Angulartics -->
        <script src="js/vendor/angulartics-0.20.0/dist/angulartics.min.js"></script>
        <script language="javascript" type="text/javascript" src="js/vendor/angulartics-0.20.0/dist/angulartics-google-analytics.min.js"></script>

        <!-- Angular App Control Script -->
        <script language="javascript" type="text/javascript" src="js/appControl.js"></script>
        <!-- Angular Controllers -->
        <script src="js/controllers/workoutCreator.js"></script>
        <script src="js/controllers/proposeExercise.js"></script>
        <script src="js/controllers/inviteFriends.js"></script>
        <script src="js/controllers/home.js"></script>
        <script src="js/controllers/search.js"></script>
        <script src="js/controllers/fullWorkout.js"></script>
        <script src="js/controllers/send-mail.js"></script>
        <script src="js/directives/passwordStrength.js"></script>
        <script src="js/directives/passwordMatch.js"></script>
        <script src="js/directives/loading.js"></script>
        <script src="js/directives/highlightSearch.js"></script>
        <script src="js/controllers/login.js"></script>
        <script src="js/controllers/forgotPassword.js"></script>
        <script src="js/controllers/resetPassword.js"></script>
        <script src="js/controllers/signup.js"></script>
        <script src="js/controllers/confirm.js"></script>
        <script src="js/controllers/logout.js"></script>
        <script src="js/controllers/profile.js"></script>
        <script src="js/controllers/partners.js"></script>
        <script src="js/controllers/fullUser.js"></script>
        <script src="js/controllers/favorites.js"></script>
        <script src="js/controllers/followers.js"></script>
        <script src="js/controllers/nav.js"></script>
        <script src="js/controllers/footer.js"></script>
        <script src="js/services/account.js"></script>
        <script src="js/services/factories.js"></script>

        <!-- HTML Video extended support -->
        <script src="js/vendor/video-js/video.js"></script>
        <link rel="stylesheet" href="js/vendor/video-js/video-js.css" type="text/css" />
    </head>
    <body ng-cloak>
