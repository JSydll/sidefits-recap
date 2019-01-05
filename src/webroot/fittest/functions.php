<?php 
/* --------------------------------------- */
/* SESSION HANDLING AND DATA STORAGE       */
/* --------------------------------------- */

// Store form inputs in SESSION variables
if(isset($_POST["step1-submit"])){
    $_SESSION["name"] = $_POST['step1-name'];
    $_SESSION["age"] = $_POST['step1-age'];
    $_SESSION["sex"] = $_POST['step1-sex'];
    $_SESSION["height"] = $_POST['step1-height'];
    $_SESSION["weight"] = $_POST['step1-weight'];    
}

if(isset($_POST["step2-submit"])){
    $_SESSION["sitreach"] = $_POST['step2-sitreach'];
    $_SESSION["rotation"] = $_POST['step2-rotation'];
}

if(isset($_POST["step3-submit"])){
    $_SESSION["broadj-size"] = $_POST['step3-broadj-size'];
    $_SESSION["broadj-steps"] = $_POST['step3-broadj-steps'];
    $_SESSION["plank-min"] = $_POST['step3-plank-min'];
    $_SESSION["plank-sec"] = $_POST['step3-plank-sec'];
    $_SESSION["pull"] = $_POST['step3-pull'];
    $_SESSION["flexhang"] = $_POST['step3-flexhang'];
    $_SESSION["PU"] = $_POST['step3-PU'];
    $_SESSION["PUmod"] = $_POST['step3-PUmod'];
}

if(isset($_POST["step4-submit"])){
    $_SESSION["cooper"] = $_POST['step4-cooper'];
    $_SESSION["recovrate"] = $_POST['step4-recovrate'];
}

/* ------------------------------------- */
/* PAYMENT PROCESSES                     */
/* ------------------------------------- */

// Store the users seletion to pay manually
if(isset($_POST["manpay-confirmed"])){
    $_SESSION['paystatus'] = "Manual Payment Selected"; 
}

// Store the users seletion to get the free evaluation
if(isset($_POST["free-eval-confirmed"])){
    $_SESSION['paystatus'] = "Free Evaluation Selected";
}


?>