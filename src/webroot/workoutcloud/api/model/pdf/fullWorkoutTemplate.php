<?php  /* Template for full workout PDF creation */
if(isset($_POST["createPDF"])){
    // App base path
    $appBase = "https://sidefits.com/view/";
    
    // Initiation of Variables
    $lang = $_POST["lang"];
    $wname = $_POST["wname"];
    $wPicPath = $_POST["wPicPath"];
    $wTags = $_POST["wTags"];
    $creatorName = $_POST["creatorName"];
    $creatorShortBio = $_POST["creatorShortBio"];
    $creatorPicPath = $_POST["creatorPicPath"];
    $creatorContact = $_POST["creatorContact"];
    $creatorVisible = $_POST["creatorVisible"];
    $wDimensions = $_POST["wDimensions"];
    $wDuration = $_POST["wDuration"];
    $wDifficulty = $_POST["wDifficulty"];
    $wRoundCount = $_POST["wRoundCount"];
    $wExCount = $_POST["wExCount"];
    $wAnnotations = $_POST["wAnnotations"];
    $wExerciseMap = $_POST["wExerciseMap"];
    $wExerciseDescriptions = $_POST["wExerciseDescriptions"];
  
    // Translation
    if($lang == "de_DE"){
        $translate = json_decode(file_get_contents("translations/de_DE.txt"), true);
    } else {
        $translate = json_decode(file_get_contents("translations/en_EN.txt"), true);    
    }

} else {
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $wname; ?></title>

    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <meta name="description" content="Mit der Sidefits WorkoutBox kannst du dein perfektes Workout finden oder mit deinen Freunden teilen."/>
    <meta name="author" content="Sidefits"/>
    <meta name="keywords" content="sidefits, workout, fitness, generator, baukasten"/>

    <!-- Bootstrap Style Sheets -->
    <link rel="stylesheet" href="scripts/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="scripts/theme.min.css" type="text/css" />
    <script src="scripts/bootstrap.min.js"></script>
    
    <!-- General site styling -->
    <link href="scripts/styles.css" type="text/css" rel="stylesheet" media="all" />
    <!-- WEB FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:100,300,100italic,400,300italic' rel='stylesheet' type='text/css'/>

</head>

<body>
<div class="navbar">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a class="navbar-brand"><img id="navbar-brand-img" src="images/app/Icon.png" alt="Sidefits" /></a>
                <span class="navbar-text" style="width: 400px;">
                    <span>Sidefits WorkoutCloud</span>
                </span>
            </div>
        </div>  
    </div>
</div>
<div class="container" style="margin: 60px 15px 5px 15px;">
<!-- Header pane -->
    <div class="row header-pane">
        <div class="header-pane-img"><img src="<?php echo $appBase."images/workouts/".$wPicPath; ?>" /></div>
        <div class="header-pane-title"><?php echo $wname; ?></div>
        <div class="header-pane-creator"><img src="<?php echo $appBase."images/user/profile/".$creatorPicPath; ?>" class="img-circle"/> <i class="glyphicon"></i></div>
        <div class="header-pane-love active"><i class="glyphicon glyphicon-heart"> </i></div>
    </div>
    <!-- Creator info pane -->
    <div class="row creator-info">
        <div class="col-xs-12">
            <h5><span><?php echo $translate["CREATED_BY"]; ?></span> <i><?php echo $creatorName; ?></i></h5>
            <blockquote style="margin: 0px; width: 100%" class="pull-left">
                <span class="text-muted">
                    <h5><i><?php echo $creatorShortBio; ?></i></h5>
                    <?php ?>
                </span>
            </blockquote>
            <div class="clearfix"></div>
            <?php if($creatorVisible): ?><h5><?php echo $translate["CONTACT"].": ".$creatorContact; ?></h5><?php endif; ?>
        </div>
    </div>
    <!-- Workout stats -->
    <div class="row workout-stats panel panel-default">
        <div class="row">
            <div class="col-xs-12">
                <div class="status-pane-estimates">
                    <span id="est-time" class="col-xs-2">
                        <span class="time-val"><?php echo floor($wDuration / 60); ?> <span class="time-capt"><?php echo $translate["MINUTES"]; ?></span></span>
                        <br />
                        <span class="time-val"><?php echo ($wDuration - floor($wDuration / 60) * 60); ?> <span class="time-capt"><?php echo $translate["SECONDS"]; ?></span></span>
                    </span>
                    <span class="col-xs-2">
                        <span class="avg-difficulty pull-left">
                            <span class="count-val"><span class="count-capt"><?php echo $translate["DIFFICULTY"]; ?></span> <br /><?php echo $wDifficulty; ?></span>
                        </span>
                    </span>
                    <span id="dimensions" class="col-xs-6">
                        <span style="display: inline-block;">
                            <div class="dimension-wrap pull-left">
                                <span class="dimension-icon">
                                    <img src="<?php if($wDimensions[0] != 0 ) {echo "images/app/Flex_full.png"; } else {echo "images/app/Flex_empty.png"; } ?>" />
                                </span>
                                <span class="dimension-count <?php  if($wDimensions[0] != 0 ) {echo "active"; }?>"><?php echo floor($wDimensions[0] * 100); ?>%</span>
                            </div>
                            <div class="dimension-wrap pull-left">
                                <span class="dimension-icon">
                                    <img src="<?php if($wDimensions[1] != 0 ) {echo "images/app/Mstrength_full.png"; } else {echo "images/app/Mstrength_empty.png"; } ?>" />
                                </span>
                                <span class="dimension-count <?php  if($wDimensions[1] != 0 ) {echo "active"; }?>"><?php echo floor($wDimensions[1] * 100); ?>%</span>
                            </div>
                            <div class="dimension-wrap pull-left">
                                <span class="dimension-icon">
                                    <img src="<?php if($wDimensions[2] != 0 ) {echo "images/app/Mendurance_full.png"; } else {echo "images/app/Mendurance_empty.png"; } ?>" />
                                </span>
                                <span class="dimension-count <?php  if($wDimensions[2] != 0 ) {echo "active"; }?>"><?php echo floor($wDimensions[2] * 100); ?>%</span>
                            </div>
                            <div class="dimension-wrap pull-left">
                                <span class="dimension-icon">
                                    <img src="<?php if($wDimensions[3] != 0 ) {echo "images/app/Cardio_full.png"; } else {echo "images/app/Cardio_empty.png"; } ?>" />
                                </span>
                                <span class="dimension-count <?php  if($wDimensions[3] != 0 ) {echo "active"; }?>"><?php echo floor($wDimensions[3] * 100); ?>%</span>
                            </div>
                            <span class="clearfix"></span>
                        </span>
                    </span>
                    <span id="exercise-count" class="col-xs-2">
                        <span class="count-val"><?php echo $wExCount; ?> <br /><span class="count-capt"><?php echo $translate["EXERCISES"]; ?></span></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="divider"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="prev-tags">
                    &nbsp;&nbsp;&nbsp;Tags: 
                    <?php for($i = 0; $i < count($wTags); $i++){
                            echo "<span class=\"prev-exercise\"><i class=\"glyphicon glyphicon-tag\"></i> ".$wTags[$i]."</span>";
                    } ?>
                </div>
                <div style="width: 100%; height: 10px"></div>
            </div>
        </div>
    </div>
    <!-- Main data area -->
    <div class="row workout-data panel panel-default">
        <div id="plan-data" class="pull-left" style="padding-right: 20px;">
            <ul class="plan-data-map">
                <?php for($i = 0; $i < count($wExerciseMap); $i++){
                    echo "<li class=\"plan-data-round\">
                            <div>
                                <div class=\"round-title\">".$wExerciseMap[$i]["count"]." x ".$wExerciseMap[$i]["title"]." ".($i + 1)."</div>
                            </div>
                            <ul class=\"plan-data-map\">";
                    for($j = 0; $j < count($wExerciseMap[$i]["exercises"]); $j++){
                        echo "<li class=\"plan-data-exercise\">
                                <div class=\"row\">";
                               echo "<div class=\"col-xs-8 exercise-title\" style=\"padding: 20px 5px;\">".$wExerciseMap[$i]["exercises"][$j]["title"]."</div>
                                    <div class=\"col-xs-4\" style=\"padding: 20px 5px;\">";
                        if($wExerciseMap[$i]["exercises"][$j]["modus"] == "reps"){
                            echo "<span class=\"exercise-modus\"><span class=\"count-val\">".$wExerciseMap[$i]["exercises"][$j]["count"]."<span class=\"count-capt\">".$translate["REP"]."</span></span></span>";
                        } elseif ($wExerciseMap[$i]["exercises"][$j]["modus"] == "time"){
                            if(floor($wExerciseMap[$i]["exercises"][$j]["count"] / 60) != 0){
                                echo "<span class=\"exercise-modus\"><span class=\"count-val\">".floor($wExerciseMap[$i]["exercises"][$j]["count"] / 60)."<span class=\"count-capt\">".$translate["MINUTES"]."</span></span>";
                            }
                            echo "<span class=\"exercise-modus\"><span class=\"count-val\">".($wExerciseMap[$i]["exercises"][$j]["count"] - floor($wExerciseMap[$i]["exercises"][$j]["count"] / 60) * 60)."<span class=\"count-capt\">".$translate["SECONDS"]."</span></span></span>";
                        } else {
                            if(floor($wExerciseMap[$i]["exercises"][$j]["count"] / 1000) != 0){
                                echo "<span class=\"exercise-modus\"><span class=\"count-val\">".floor($wExerciseMap[$i]["exercises"][$j]["count"] / 1000)."<span class=\"count-capt\">".$translate["KMETERS"]."</span></span>";
                            }
                            echo "<span class=\"exercise-modus\"><span class=\"count-val\">".($wExerciseMap[$i]["exercises"][$j]["count"] - floor($wExerciseMap[$i]["exercises"][$j]["count"] / 1000) * 1000)."<span class=\"count-capt\">".$translate["METERS"]."</span></span></span>";
                        }
                        echo "</div>
                            </div>
                            </li>";
                    }
                    echo "
                </ul>
                </li>";
                }  ?>
            </ul>
            <div id="workout-annotations" class="well">
                <h3><?php  echo $translate["DESCRIPTION_HEADLINE"]; ?></h3>
                <span class="text-muted"><?php echo $wAnnotations; ?></span>
            </div>
        </div>
   
        <div id="exercise-explanations" class="pull-right">
            <h3 style="margin-top: 0px;"><?php echo $translate["EXERCISE_DESCR_HEADER"]; ?></h3>
            <ul class="exercise-explain-map">
            <?php for($i = 0; $i < count($wExerciseDescriptions); $i++){
                echo "<li>
                        <div class=\"row\">
                            <div class=\"col-xs-12\">
                                <div class=\"edescr-img-wrap pull-left\">";
                for($j = 0; $j < count($wExerciseDescriptions[$i]["picPath"]); $j++){
                    echo "<span>
                            <a href=\"".$appBase."images/exercises/".$wExerciseDescriptions[$i]["picPath"][$j]."-lg.jpg\">
                                <img class=\"edescr-img img-rounded\" style=\"max-width: 350px\"src=\"".$appBase."images/exercises/".$wExerciseDescriptions[$i]["picPath"][$j]."-m.jpg\" />
                            </a>
                        </span>";
                }
                echo "</div>
                    </div>
                <div class=\"row\">
                    <div class=\"col-xs-12 edescr-content\">
                        <div class=\"edescr-headline\"><span>".$wExerciseDescriptions[$i]["name"]."</span></div>
                        <div class=\"edescr-text\"><span>".$wExerciseDescriptions[$i]["fullDescr"]."</span></div>
                    </div>
                </div>
                   <!--  <div class=\"col-xs-2 edescr-info\">
                        <span class=\"edescr-difficulty\">".$wExerciseDescriptions[$i]["difficulty"]."</span><br />
                        <span class=\"edescr-equipment\">".$wExerciseDescriptions[$i]["equipment"]."</span>
                    </div> -->
                </div>";
                echo "</li>";
            }  ?>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div id="disclaimer">
            <span class="text-muted"><?php echo $translate["WORKOUT_DISCLAIMER"]; ?></span>
        </div>
        <div class="bigspace"></div>
</div>
<div class="bigspace"></div>
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-2"></div>
            <div class="col-xs-8">
                <p class="text-muted white-text">Made by Sidefits with <i class="glyphicon glyphicon-heart icon-l"></i> in Hamburg/ Copenhagen</p>
            </div>
            <div class="col-xs-2"></div>
    </div>
    </div>    
</div>    
    
</body>
</html>