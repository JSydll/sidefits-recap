// TIMERS ON TEST PAGE
$(document).ready(function(){
    timerInit($("#cntdwn1"), 98);    
});


// TIMER FUNCTIONS
// Require jQuery and bootstrap installed. 
function timerInit(element, starttime, sec_only ){
    // Built timer in the element
    // Minutes div, Seconds Div, Controls
    sec_only = typeof sec_only !== "undefined" ? sec_only : false;
    var timerHTML = "";
    if(sec_only == false) {
        timerHTML = "<div class=\"timer container\"><span class=\"timer min\"></span> : <span class=\"timer sec\"></span><br /><br />";  
    } else {
        timerHTML = "<div class=\"timer container\"><span class=\"timer sec\"></span><br /><br />";    
    }
    
    timerHTML = timerHTML + "<button class=\"btn btn-default btn-sm timer toggle\">Start/Pause</button><button class=\"btn btn-default btn-sm timer reset\">Reset</button></div>"; 
    
    $(element).html(timerHTML);

    // Calculate initial time per dimension
    var min = Math.floor(starttime / 60);
    var sec = starttime - min * 60;
    $(element).children().children(".timer.min").html(min);
    $(element).children().children(".timer.sec").html(sec);
    
    var timerStatus = "stop"; 
    $(element).children().children(".timer.toggle").click(function(){
        if( timerStatus == "stop" ){
            timerStatus = "run";
            timerRun( element, timerStatus );    
        } else {
            timerStatus = "stop";
            timerRun( element, timerStatus );    
        }
    });
}

function timerRun( element, mode ){
    var status = setInterval(function(){
        if(mode == "run"){
            // Now create counting variables and start counting down.
            var sec_cnt = $(element).children().children(".timer.sec").html();
            var min_cnt = $(element).children().children(".timer.min").html();
    
            //Count down the seconds
            while(sec_cnt >= 0){
                setTimeout(function(){
                    sec_cnt--;
                    $(element).children().children(".timer.sec").html(sec_cnt);
                }, 1000);
            }
    
            // Refresh minutes field once
            min_cnt--;
            $(element).children().children(".timer.min").html(min_cnt);
    
            // Now start counting down minutes
            while(min_cnt >= 0){
                sec_cnt = 60;
                for(i = 60; i >= 0; i--){
                    setTimeout(function(){
                        sec_cnt--;
                        $(element).children().children(".timer.sec").html(sec_cnt);
                    }, 1000);
                }
                min_cnt--;
                $(element).children().children(".timer.min").html(min_cnt);
            }
    
     } else {
            status = clearInterval();
        }    
    }, 500);
    
/*     //Enable onclick functions for controls
    $(element).children().children(".timer.toggle").click(function(){
        if(timerStatus = "stopped"){
            timerStatus = "started";
        } else {
            timerStatus = "stopped";
        }
    });

    $(element).children().children(".timer.reset").click(function(){
        timerStatus = "reset";
    });
 */
    

    /* if(timerStatus == "reset"){
        // Stop timer
        timerStatus = "stopped";
        // Reset initial values
        $(element).children().children(".timer.min").html(min);
        $(element).children().children(".timer.sec").html(sec);

        var sec_cnt = sec;
        var min_cnt = min;
    }
 */
}