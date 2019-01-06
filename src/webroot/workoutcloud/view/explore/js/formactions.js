/* --------------------------------------- */
/* TEST LANDINGPAGE                        */
/* --------------------------------------- */

// Display all MORE INFO elements on click
$(document).ready(function(){
    // Display all MORE INFO elements on click
    $(".moreinfo").click(function(){
        moreInfo($(this));
    });
    
    // Go to #dotest when clicking on the package select
     $(".package-select").click(function(){
        window.location = "#gototest";
        $("#sel_package").val($(this).val());
    });
});

// Function to show/ hide MORE INFO elements
function moreInfo( element ){
    var infobox = $("#"+$(element).attr("class").split(" ")[1]);
    if(infobox.css("display") == "none"){
        $(infobox).slideDown();
        $(element).html("Verbergen <i class=\"arrow_carrot-up_alt2\">");
    } else {
        $(infobox).slideUp();
        $(element).html("Mehr Informationen <i class=\"arrow_carrot-down_alt2\">");
    }   
}

/* --------------------------------------- */
/*                  DO TEST SUBMIT         */
/* --------------------------------------- */
$(document).ready(function(){
    $("#start-test").submit(function(e){
        e.preventDefault();
        var email = $("#test-email").val();
        var dataString = 'check_mail=true&emailput=' + email;
    
        function isValidEmail(emailAddress) {
            var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
            return pattern.test(emailAddress);
        };
        if (isValidEmail(email)) {
            $.ajax({
                type: "POST",
                url: "functions.php",
                data: dataString,
                success: function(data){
                    if(data == "Email Not In DB"){
                        // Continue to Test Page as the email is not in the DB yet.
                        var wholeformdata = $("form[id='start-test']").serialize();
                        window.location = "test-de.php?test-submit=true&" + wholeformdata;
                    } else {
                        // Show error that the email is already in DB.
                        $('#start-test .db-error').fadeIn(1000);
                        $('#start-test .input-error').fadeOut(500);
                    }
                      
                }
            });
        } else {
            $('#start-test .input-error').fadeIn(1000);
            $('#start-test .db-error').fadeOut(500);
        }
    
        return false;   
    });    
});

/* --------------------------------------- */
/* TEST INPUT PAGE EXPLANATIONS & VIDEOS      */
/* --------------------------------------- */

// Display all TESTEXPLAIN elements on click
$(document).ready(function(){
    $(".testexplain").click(function(){
        testexplain($(this));
    });
});

// Function to show/ hide MORE INFO elements
function testexplain( element ){
    var infobox = $("#"+$(element).attr("class").split(" ")[1]);
    if(infobox.css("display") == "none"){
        $(infobox).slideDown();
        $(element).html("Verbergen <i class=\"arrow_carrot-up_alt2\">");
    } else {
        $(infobox).slideUp();
        $(element).html("Erkl&auml;rungen und Bilder <i class=\"arrow_carrot-down_alt2\">");
    }
}

/* --------------------------------------- */
/* TEST INPUT PAGE TABS DATA HANDLING      */
/* --------------------------------------- */
$(document).ready(function(){
    // At page load, Tab 1 should be active
    setTimeout(function() {
        $("#tab-step1").trigger("click");
           
    },1000);    

    // AJAX Storage for each Tab
    $("#step1-submit").click(function(){
        $("#tab-step2").trigger("click");
        window.location = "#";
           
    });

    $("#step2-submit").click(function(){ 
        $("#tab-step3").trigger("click");
        window.location = "#";
           
    });
    
    $("#step3-submit").click(function(){
        $("#tab-step4").trigger("click");
        window.location = "#";
           
    });
    
    $("#step4-submit").click(function(){
        var step4inputs = $(".step4-inputs").serialize()+"&step4-submit=true";
        $.ajax({
            type: "POST", url: "functions.php", data: step4inputs
        }).done(function(){
                if(checkcompleteness()){
                    window.location = "checkout-de.php";        
                } else {
                    $("#test-not-complete").fadeIn();
                    setTimeout(function(){
                        $("#test-not-complete").fadeOut();        
                    }, 5000);    
                }            
            }
        );
    });
    
    //Function to check if all necessary form fields are filled out.
    function checkcompleteness(){
        var inputs = [ $("#step1-height").val(), $("#step1-weight").val(), $("#step2-sitreach").val(), $("#step2-rotation").val(), 
                        $("#step3-broadj-size").val(), $("#step3-broadj-steps").val(), $("#step4-cooper").val(), $("#step4-recovrate").val() ];
        var completed = true;
        $.each(inputs, function(index, value){
            if(value == 0){
                completed = false;
                return false;
            }    
        });
        
        if(completed){
            return true;    
        } else {
            return false;
        }
        
    } 
    
    
    // As all methods are navigating through the tab bar, the inputs should be saved everytime.
    $("#tab-step1, #tab-step2, #tab-step3, #tab-step4").click(function(){
        var stepNo = $(this).attr("id").slice(-1) - 1;
        // All other tabs than the one clicked on need to be serialized
        // So built an array with all steps and remove the step clicked on.
        var stepstotal = [1,2,3,4];
        stepstotal.splice(stepNo, 1);
        for	(index = 0; index < stepstotal.length; index++) {
            storeinputs(stepstotal[index]);
        } 
           
    });
    
    // A general function to send the form data to the PHP script enhances loading speed
    function storeinputs( stepNumber ){
        var stepXinputs = $(".step" + stepNumber + "-inputs").serialize() + "&step" + stepNumber + "-submit=true";
        $.ajax({
            type: "POST", url: "functions.php", data: stepXinputs
        });
    }
    
    // Each tab has a back button that triggers the tab before
    $("#step2-back").click(function(){ $("#tab-step1").trigger("click"); window.location = "#";    });
    $("#step3-back").click(function(){ $("#tab-step2").trigger("click"); window.location = "#";    });
    $("#step4-back").click(function(){ $("#tab-step3").trigger("click"); window.location = "#";    });

   
});

/* --------------------------------------- */
/* TEST INPUT PAGE DYNAMIC TEST BLOCKS DEPENDING ON SEX     */
/* --------------------------------------- */
$(document).ready(function(){
    $("#tab-step3").click(function(){
        alter_exercises();
           
    });
    
    function alter_exercises(){
        // Men won't get the mod. PU and Flexedhang exercises displayed.
        var sex = $("#step1-sex").val();
        if( sex == 1){
            $("#test-pull").show();
            $("#test-PU").show();
            $("#test-flexedhang").hide();
            $("#test-PUmod").hide();
        } else {
            // On the other hand, women won't get the pullups and normal PU displayed.
            $("#test-flexedhang").show();
            $("#test-PUmod").show();
            $("#test-pull").hide();
            $("#test-PU").hide();
        }
    }    

   
});

/* --------------------------------------- */
/* CHECKOUT PAGE                           */
/* --------------------------------------- */
$(document).ready(function(){   
    // Function to show the individual included features per payment option.
    $(".featlist-expand").click(function(){
         var thelist = $(this).parent().children(".featlist");
         if($(thelist).css("display") == "none"){
             thelist.slideDown();
             $(this).html("Inhalte verbergen <i class=\"arrow_carrot-up_alt2\">");
         } else {
            $(this).html("Inhalte anzeigen <i class=\"arrow_carrot-down_alt2\">");
             thelist.slideUp();
         }
           
    });
    
    // Handling of package selection
    $(".package-select").click(function(){
        if($(this).val() == 1){
            ChangePayOption(this);
            $("#payment-options").slideUp();
            $("#free-eval").fadeIn();             
        } 
        if($(this).val() == 2){
            ChangePayOption(this);
            if($("#free-eval").css("display") != "none"){
                $("#free-eval").fadeOut();    
            }   
            $("#paypal-package2").addClass("selected");
            $("#paypal-package3").removeClass("selected");
            $("#payment-options").slideDown();
            $("#sel_package_price").val("7,90");
            $("#manpay-price").html("7,90&euro;");     
        } 
        if($(this).val() == 3){
            ChangePayOption(this);
            if($("#free-eval").css("display") != "none"){
                $("#free-eval").fadeOut();
            }
            $("#paypal-package2").removeClass("selected");
            $("#paypal-package3").addClass("selected");
            $("#payment-options").slideDown();
            $("#sel_package_price").val("14,90");
            $("#manpay-price").html("14,90&euro;");   
        }
           
    });
    
    //Function to append selected styles to the chosen option and remove styles of all others.
    function ChangePayOption( chosenelement ){
        // First, the active/selected classes of all other elements except of the chosen one need to be removed and set to not-selected.
        if($(".calltoaction button").not(chosenelement).hasClass("active")){
            $(".calltoaction button").not(chosenelement).removeClass("active");   
        }
        if($(".package-small-tile").not(chosenelement).hasClass("selected")){
            $(".package-small-tile").not(chosenelement).removeClass("selected");    
        }   
        
        if($(".calltoaction").not(chosenelement).hasClass("selected")){
            $(".calltoaction").not(chosenelement).removeClass("selected");
            $(".calltoaction").not(chosenelement).children("button").html("Ausw&auml;hlen!");            
        }
        
        // Add not-selected classes
        $(".calltoaction").not(chosenelement).addClass("not-selected");
        $(".package-small-tile").not(chosenelement).addClass("not-selected");
        
        // Now the now-selected class of the chosen element needs to be removed.          
        if($(chosenelement).parent(".calltoaction").hasClass("not-selected")){
            $(chosenelement).parent(".calltoaction").removeClass("not-selected");
        }
        if($(chosenelement).parent().parent(".package-small-tile").hasClass("not-selected")){
            $(chosenelement).parent().parent(".package-small-tile").removeClass("not-selected");
        }
        
        // Now the selected/ active classes can be appended to the chosen element.
        $(chosenelement).html("Ausgew&auml;hlt");
        $(chosenelement).addClass("active");
        $(chosenelement).parent(".calltoaction").addClass("selected");
        $(chosenelement).parent().parent(".package-small-tile").addClass("selected");          
    }



    $("#manualpay-select").click(function(){
        if($("#manualpay").css("display") == "none"){
            $("#manualpay").slideDown();
            $("#manualpay-select").html("Per &Uuml;berweisung zahlen <i class=\"arrow_carrot-up_alt2\">");
        } else {
            $("#manualpay").slideUp();
            $("#manualpay-select").html("Per &Uuml;berweisung zahlen <i class=\"arrow_carrot-down_alt2\">");
        }

    });

    // Saving the selection of manual paymant in the DB via AJAX call and referring to Landingpage
    $("#manpay-confirm-submit").click(function(){
        $.ajax({
            type: "POST", url: "functions.php",
            data: "manpay-confirmed=true&manpay-package-price="+$("#sel_package_price")
        }).success(function(){
            $("#manpay-confirm").fadeIn();
            window.location = "#manpay-confirm";
            setTimeout(function(){
                window.location = "landing-de.php";
            }, 8000);

        }).fail(function(){
            $("#manpay-error").fadeIn();
            window.location = "#manpay-error";

        });
    });
    
    // Saving the selection of manual paymant in the DB via AJAX call and referring to Landingpage
    $("#free-eval-submit").click(function(){
        $.ajax({
            type: "POST", url: "functions.php",
            data: "free-eval-confirmed=true"
        }).success(function(){
            $("#free-eval-confirm").fadeIn();
            setTimeout(function(){
                window.location = "landing-de.php";
            }, 4000);

        }).fail(function(){
            $("#free-eval-error").fadeIn();
            window.location = "#free-eval-error";

        });
    });
   
}); 