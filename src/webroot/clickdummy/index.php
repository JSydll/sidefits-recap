<?php
if(isset($_POST['lang_select'])){
    $lang = $_POST['lang_select'];
    unset($_POST['lang_select']);
    header("Location: ".$lang."/dashboard.php");
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
	<title>Sidefits</title>
	<script src="jquery-1.11.1.min.js"></script>
    <script language="javascript" type="text/javascript" src="jquery.mobile-1.4.5.min.js"></script>	
    <link rel="stylesheet" href="jquery.mobile-1.4.5.min.css" type="text/css" />
	<link rel="stylesheet" href="style.css" />
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic|Roboto+Condensed:300,300italic' rel='stylesheet' type='text/css'/>
    <style>
    .ui-page-theme-a {
        background-color: #4CB0A9;
        text-shadow: none;
    }
    .ui-page-theme-a .ui-bar-inherit {
        color: #4CB0A9
    }
    .ui-page-theme-a .ui-flipswitch-active {
        background-color: #4D4D4D;
        border-color: #4D4D4D;
        color: #4CB0A9;
    }
    .ui-flipswitch {
        width: 5em;
    } 
    .ui-flipswitch .ui-flipswitch-off {
        text-indent: 0.75em;
    }   
    </style>
    <script language="javascript" type="text/javascript">
        function submitter(){
            $("#lang_form").submit();
        }
    </script>
</head>
<body>
	<div id="page" style="text-align: center; background-color: #4CB0A9;">
    	<div class="content-block">
            <p style="font-family: 'Roboto Condensed', sans-serif; font-weight: 300; font-size: 400%; margin-top: 1em; color: #FFFFFF">Welcome!</p>
            <p style="font-family: 'Roboto Condensed', sans-serif; font-weight: 300; font-size: 120%; margin-top: 2em; margin-bottom: 2em; color: #FFFFFF">
                Thank you very much<br />for taking the time to<br />give us a feedback<br />on the</p>
            <img src="images/Logo_sidefits_betademo_invert.png" style="max-width: 260px; height: auto" alt="Sidefits BETAdemo" />
            <p style="color: #FFFFFF; text-align: justify; margin-top: 3em; margin-bottom: 2em">
                The following pages should give you an impression of what Sidefits is going to be someday.
                There's not much 'true' interaction yet, but the basic idea can be experienced. If you feel left alone at some point,
                just click on 'give feedback' in the menu accessible through our icon and let us know.
            </p>
            <div style="float: left">
                <form id="lang_form" action="index.php" method="post" data-ajax="false">
                    <select id="lang_select" name="lang_select" data-role="flipswitch" data-corners="false">
                        <option value="EN" <?php if(isset($_GET['lang']) && $_GET['lang'] == "EN") echo "selected"; ?>>EN</option>
                        <option value="DE" <?php if(isset($_GET['lang']) && $_GET['lang'] == "DE") echo "selected"; ?>>DE</option>
                    </select>
                </form>
            </div>
            
            <a href="javascript:void(0)" onclick="submitter()"><div class="button" style="height: 25px; float: right; background-color: #FFFFFF">TO THE <span style="color: #4CB0A9;">BETAdemo</span></div></a>
	   </div>
    </div>
</body>
</html>