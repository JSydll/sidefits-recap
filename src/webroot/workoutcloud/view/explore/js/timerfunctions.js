// TIMER on test page
/* ------------------------------------------------------------------ */
$(document).ready(function(){
    // JS for timer 1
    $("#timer1").TimeCircles({
        start: false,
        corcle_bg_color: "#808080",
        fg_width: 0.03,
        bg_width: 0.4,
        count_past_zero : false,
        time: {
            Days: { show: false},
            Hours: { show: false},
            Minutes: { show: false},
            Seconds: { text: "Sekunden", color: "#4CB0A9"}
        }
    });
    var timer1_running = false;
        
    $("#timer1").click(function(){
        if(!timer1_running){
            $("#timer1").TimeCircles().start();
            timer1_running = true;
        } else {
            $("#timer1").TimeCircles().stop();
            timer1_running = false;
        }
    });        
    $("#timer1-restart").click(function(){ $("#timer1").TimeCircles().restart(); });
    
    // JS for timer 2
    $("#timer2").TimeCircles({
        start: false,
        corcle_bg_color: "#808080",
        fg_width: 0.03,
        bg_width: 0.4,
        time: {
            Days: { show: false},
            Hours: { show: false},
            Minutes: { text: "Minuten", color: "#DE4D71"},
            Seconds: { text: "Sekunden", color: "#4CB0A9"}
        }
    });
    var timer2_running = false;

    $("#timer2").click(function(){
        if(!timer2_running){
            $("#timer2").TimeCircles().start();
            timer2_running = true;
        } else {
            $("#timer2").TimeCircles().stop();
            timer2_running = false;
        }
    });
    $("#timer2-restart").click(function(){ $("#timer2").TimeCircles().restart(); }); 
    
     // JS for timer 3
    $("#timer3").TimeCircles({
        start: false,
        corcle_bg_color: "#808080",
        fg_width: 0.03,
        bg_width: 0.4,
        time: {
            Days: { show: false},
            Hours: { show: false},
            Minutes: { text: "Minuten", color: "#DE4D71"},
            Seconds: { text: "Sekunden", color: "#4CB0A9"}
        }
    });
    var timer3_running = false;

    $("#timer3").click(function(){
        if(!timer3_running){
            $("#timer3").TimeCircles().start();
            timer3_running = true;
        } else {
            $("#timer3").TimeCircles().stop();
            timer3_running = false;
        }
    });
    $("#timer3-restart").click(function(){ $("#timer3").TimeCircles().restart(); });
    
    // JS for timer 4
    $("#timer4").TimeCircles({
        start: false,
        corcle_bg_color: "#808080",
        fg_width: 0.03,
        bg_width: 0.4,
        count_past_zero : false,
        time: {
            Days: { show: false},
            Hours: { show: false},
            Minutes: { show: false},
            Seconds: { text: "Sekunden", color: "#4CB0A9"}
        }
    });
    var timer4_running = false;

    $("#timer4").click(function(){
        if(!timer4_running){
            $("#timer4").TimeCircles().start();
            timer4_running = true;
        } else {
            $("#timer4").TimeCircles().stop();
            timer4_running = false;
        }
    });
    $("#timer4-restart").click(function(){ $("#timer4").TimeCircles().restart(); });
    
    // JS for timer 5
    $("#timer5").TimeCircles({
        start: false,
        corcle_bg_color: "#808080",
        fg_width: 0.03,
        bg_width: 0.4,
        time: {
            Days: { show: false},
            Hours: { show: false},
            Minutes: { text: "Minuten", color: "#DE4D71"},
            Seconds: { text: "Sekunden", color: "#4CB0A9"}
        }
    });
    var timer5_running = false;

    $("#timer5").click(function(){
        if(!timer5_running){
            $("#timer5").TimeCircles().start();
            timer5_running = true;
        } else {
            $("#timer5").TimeCircles().stop();
            timer5_running = false;
        }
    });
    $("#timer5-restart").click(function(){ $("#timer5").TimeCircles().restart(); });
});