<?php
require("header.php");
require("navbar.php");
?>

    <div id="sfwb_content" class="container-fluid" ui-view="content">    
        <div class="row">
            <div class="col-xs-5"></div>
            <div class="col-xs-2 center-block">
                <img src="images/app/loading-spinner.png" srcset="images/app/loading-spinner.GIF" alt="" width="150px"/>
            </div>
            <div class="col-xs-5"></div>
        </div>
        <div class="bigspace"></div>
        <div class="bigspace"></div>
    </div>
<?php  
require("footer.php");
?>