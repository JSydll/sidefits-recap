<?php // Make sure, the needed get parameters are given in the URI, and store them into php variables.
// The variables are:
//// - Initiator name ["in"]
//// - Initiator email ["ie"]
if(isset($_GET["in"])&&isset($_GET["ie"])){
    $initiator = urldecode($_GET['in']);
    $initiatorMail = urldecode($_GET['ie']);
} else {
    exit;
}

?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
	<head>
		<!-- NAME: 1 COLUMN -->
		<!--[if gte mso 15]>
		<xml>
			<o:OfficeDocumentSettings>
			<o:AllowPNG/>
			<o:PixelsPerInch>96</o:PixelsPerInch>
			</o:OfficeDocumentSettings>
		</xml>
		<![endif]-->
		<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Du wurdest zur WorkoutCloud eingeladen!</title>
        
    <style type="text/css">p{margin:10px 0; padding:0}
table{border-collapse:collapse}
h1, h2, h3, h4, h5, h6{display:block; margin:0; padding:0}
img, a img{border:0; height:auto; outline:none; text-decoration:none}
body, #bodyTable, #bodyCell{height:100%; margin:0; padding:0; width:100%}
#outlook a{padding:0}
img{-ms-interpolation-mode:bicubic}
table{mso-table-lspace:0pt; mso-table-rspace:0pt}
.ReadMsgBody{width:100%}
.ExternalClass{width:100%}
p, a, li, td, blockquote{mso-line-height-rule:exactly}
a[href^=tel], a[href^=sms]{color:inherit; cursor:default; text-decoration:none}
p, a, li, td, body, table, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%}
.ExternalClass, .ExternalClass p, .ExternalClass td, .ExternalClass div, .ExternalClass span, .ExternalClass font{line-height:100%}
a[x-apple-data-detectors]{color:inherit !important; text-decoration:none !important; font-size:inherit !important; font-family:inherit !important; font-weight:inherit !important; line-height:inherit !important}
#bodyCell{padding:10px}
.templateContainer{max-width:600px !important}
a.mcnButton{display:block}
.mcnImage{vertical-align:bottom}
.mcnTextContent{word-break:break-word}
.mcnTextContent img{height:auto !important}
.mcnDividerBlock{table-layout:fixed !important}

body, #bodyTable{background-color:#FAFAFA}

#bodyCell{border-top:0}

.templateContainer{border:0}

h1{color:#202020; font-family:Helvetica; font-size:26px; font-style:normal; font-weight:bold; line-height:125%; letter-spacing:normal; text-align:left}

h2{color:#202020; font-family:Helvetica; font-size:22px; font-style:normal; font-weight:bold; line-height:125%; letter-spacing:normal; text-align:left}

h3{color:#202020; font-family:Helvetica; font-size:20px; font-style:normal; font-weight:bold; line-height:125%; letter-spacing:normal; text-align:left}

h4{color:#202020; font-family:Helvetica; font-size:18px; font-style:normal; font-weight:bold; line-height:125%; letter-spacing:normal; text-align:left}

#templatePreheader{background-color:#FAFAFA; border-top:0; border-bottom:0; padding-top:9px; padding-bottom:9px}

#templatePreheader .mcnTextContent, #templatePreheader .mcnTextContent p{color:#656565; font-family:Helvetica; font-size:12px; line-height:150%; text-align:left}

#templatePreheader .mcnTextContent a, #templatePreheader .mcnTextContent p a{color:#656565; font-weight:normal; text-decoration:underline}

#templateHeader{background-color:#FFF; border-top:0; border-bottom:0; padding-top:9px; padding-bottom:0}

#templateHeader .mcnTextContent, #templateHeader .mcnTextContent p{color:#202020; font-family:Helvetica; font-size:16px; line-height:150%; text-align:left}

#templateHeader .mcnTextContent a, #templateHeader .mcnTextContent p a{color:#2BAADF; font-weight:normal; text-decoration:underline}

#templateBody{background-color:#FFF; border-top:0; border-bottom:2px solid #EAEAEA; padding-top:0; padding-bottom:9px}

#templateBody .mcnTextContent, #templateBody .mcnTextContent p{color:#202020; font-family:Helvetica; font-size:16px; line-height:150%; text-align:left}

#templateBody .mcnTextContent a, #templateBody .mcnTextContent p a{color:#2BAADF; font-weight:normal; text-decoration:underline}

#templateFooter{background-color:#FAFAFA; border-top:0; border-bottom:0; padding-top:9px; padding-bottom:9px}

#templateFooter .mcnTextContent, #templateFooter .mcnTextContent p{color:#656565; font-family:Helvetica; font-size:12px; line-height:150%; text-align:center}

#templateFooter .mcnTextContent a, #templateFooter .mcnTextContent p a{color:#656565; font-weight:normal; text-decoration:underline}
@media only screen and (min-width:768px){.templateContainer{width:600px !important}

}
@media only screen and (max-width:480px){body,table,td,p,a,li,blockquote{-webkit-text-size-adjust:none !important}

}
@media only screen and (max-width:480px){body{width:100% !important; min-width:100% !important}

}
@media only screen and (max-width:480px){#bodyCell{padding-top:10px !important}

}
@media only screen and (max-width:480px){.mcnImage{width:100% !important}

}
@media only screen and (max-width:480px){.mcnCaptionTopContent,.mcnCaptionBottomContent,.mcnTextContentContainer,.mcnBoxedTextContentContainer,.mcnImageGroupContentContainer,.mcnCaptionLeftTextContentContainer,.mcnCaptionRightTextContentContainer,.mcnCaptionLeftImageContentContainer,.mcnCaptionRightImageContentContainer,.mcnImageCardLeftTextContentContainer,.mcnImageCardRightTextContentContainer{max-width:100% !important; width:100% !important}

}
@media only screen and (max-width:480px){.mcnBoxedTextContentContainer{min-width:100% !important}

}
@media only screen and (max-width:480px){.mcnImageGroupContent{padding:9px !important}

}
@media only screen and (max-width:480px){.mcnCaptionLeftContentOuter .mcnTextContent,.mcnCaptionRightContentOuter .mcnTextContent{padding-top:9px !important}

}
@media only screen and (max-width:480px){.mcnImageCardTopImageContent,.mcnCaptionBlockInner .mcnCaptionTopContent:last-child .mcnTextContent{padding-top:18px !important}

}
@media only screen and (max-width:480px){.mcnImageCardBottomImageContent{padding-bottom:9px !important}

}
@media only screen and (max-width:480px){.mcnImageGroupBlockInner{padding-top:0 !important; padding-bottom:0 !important}

}
@media only screen and (max-width:480px){.mcnImageGroupBlockOuter{padding-top:9px !important; padding-bottom:9px !important}

}
@media only screen and (max-width:480px){.mcnTextContent,.mcnBoxedTextContentColumn{padding-right:18px !important; padding-left:18px !important}

}
@media only screen and (max-width:480px){.mcnImageCardLeftImageContent,.mcnImageCardRightImageContent{padding-right:18px !important; padding-bottom:0 !important; padding-left:18px !important}

}
@media only screen and (max-width:480px){.mcpreview-image-uploader{display:none !important; width:100% !important}

}
@media only screen and (max-width:480px){h1{font-size:22px !important; line-height:125% !important}

}
@media only screen and (max-width:480px){h2{font-size:20px !important; line-height:125% !important}

}
@media only screen and (max-width:480px){h3{font-size:18px !important; line-height:125% !important}

}
@media only screen and (max-width:480px){h4{font-size:16px !important; line-height:150% !important}

}
@media only screen and (max-width:480px){.mcnBoxedTextContentContainer .mcnTextContent,.mcnBoxedTextContentContainer .mcnTextContent p{font-size:14px !important; line-height:150% !important}

}
@media only screen and (max-width:480px){#templatePreheader{display:block !important}

}
@media only screen and (max-width:480px){#templatePreheader .mcnTextContent,#templatePreheader .mcnTextContent p{font-size:14px !important; line-height:150% !important}

}
@media only screen and (max-width:480px){#templateHeader .mcnTextContent,#templateHeader .mcnTextContent p{font-size:16px !important; line-height:150% !important}

}
@media only screen and (max-width:480px){#templateBody .mcnTextContent,#templateBody .mcnTextContent p{font-size:16px !important; line-height:150% !important}

}
@media only screen and (max-width:480px){#templateFooter .mcnTextContent,#templateFooter .mcnTextContent p{font-size:14px !important; line-height:150% !important}

}
</style></head>
    <body>
        <center>
            <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
                <tr>
                    <td align="center" valign="top" id="bodyCell">
                        <!-- BEGIN TEMPLATE // -->
						<!--[if gte mso 9]>
						<table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
						<tr>
						<td align="center" valign="top" width="600" style="width:600px;">
						<![endif]-->
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer">
                            <tr>
                                <td valign="top" id="templatePreheader"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner">
                
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="366" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top:9px; padding-left:18px; padding-bottom:9px; padding-right:0;">
                        
                            <?php echo $initiator; ?> hat Dich zur WorkoutCloud eingeladen!
                        </td>
                    </tr>
                </tbody></table>
                
            </td>
        </tr>
    </tbody>
</table></td>
                            </tr>
                            <tr>
                                <td valign="top" id="templateHeader"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:9px" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 9px; padding-left: 9px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                
                                    
                                        <img align="center" alt="" src="https://workoutcloud.net/images/email/cloudBenefits_DE.png" width="564" style="max-width:911px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table></td>
                            </tr>
                            <tr>
                                <td valign="top" id="templateBody"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner">
                
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top:9px; padding-right: 18px; padding-bottom: 9px; padding-left: 18px;">
                        
                            <h1 style="text-align: center;"><font color="#4d4d4d"><span style="line-height:41.6px">Woohoo! Du wurdest zur WorkoutCloud eingeladen!</span></font></h1>

                        </td>
                    </tr>
                </tbody></table>
                
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner">
                
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top:9px; padding-right: 18px; padding-bottom: 9px; padding-left: 18px;">
                        
                            <div style="text-align: center;"><span style="color:#696969"><strong><span style="line-height:20.8px">Erhalte den&nbsp;30 Days Abs Workout Plan als Willkommensgeschenk nach der Anmeldung!</span></strong></span></div>

                        </td>
                    </tr>
                </tbody></table>
                
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:9px" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 9px; padding-left: 9px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                
                                    
                                        <img align="center" alt="" src="https://workoutcloud.net/images/email/absPlanShowreel.png" width="564" style="max-width:1000px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="min-width:100%;">
    <tbody class="mcnButtonBlockOuter">
        <tr>
            <td style="padding-top:0; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top" align="center" class="mcnButtonBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" class="mcnButtonContentContainer" style="border-collapse: separate !important;border-radius: 3px;background-color: #FD7E00;">
                    <tbody>
                        <tr>
                            <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Arial; font-size: 16px; padding: 15px;">
                                <a class="mcnButton " title="Registrieren und Plan erhalten" href="https://workoutcloud.net/view/index.php#/login" target="_blank" style="font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;">Registrieren und Plan erhalten</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="min-width:100%;">
    <tbody class="mcnButtonBlockOuter">
        <tr>
            <td style="padding-top:0; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top" align="center" class="mcnButtonBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" class="mcnButtonContentContainer" style="border-collapse: separate !important;border-radius: 3px;background-color: #4CB0A9;">
                    <tbody>
                        <tr>
                            <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Arial; font-size: 16px; padding: 15px;">
                                <a class="mcnButton " title="Workouts erkunden" href="http://www.workoutcloud.net" target="_blank" style="font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;">Workouts erkunden</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width:100%;">
    <tbody class="mcnDividerBlockOuter">
        <tr>
            <td class="mcnDividerBlockInner" style="min-width:100%; padding:18px;">
                <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top-width: 2px;border-top-style: solid;border-top-color: #EAEAEA;">
                    <tbody><tr>
                        <td>
                            <span></span>
                        </td>
                    </tr>
                </tbody></table>
<!--            
                <td class="mcnDividerBlockInner" style="padding: 18px;">
                <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner">
                
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top:9px; padding-right: 18px; padding-bottom: 9px; padding-left: 18px;">
                        
                            <h1 style="line-height: 20.8px; text-align: center;"><span style="color:#696969"><span style="font-size:12px; line-height:20.8px; text-align:left">Die</span><span style="font-size:12px; line-height:20.8px; text-align:left">&nbsp;WorkoutC</span><span style="font-size:12px; line-height:20.8px; text-align:left">loud bietet Dir die abwechslungsreichsten&nbsp;Bodyweight Workouts!<br>
Lies, was das besondere daran ist!</span></span></h1>

<div style="text-align: left;"><span style="color: #4CB0A9;line-height: 20.8px;"><em style="font-size:12px; line-height:20.8px"><strong>Finde die abwechslungsreichsten Workouts</strong></em></span><br style="line-height: 20.8px;">
<span style="font-size:12px; line-height:20.8px">Freue dich auf personalisierte Workout Vorschl&auml;ge! Sobald du anf&auml;ngst Workouts zu liken, lernt die WorkoutCloud deine Pr&auml;ferenzen kennen und verbessert die Vorschl&auml;ge!</span><br>
<br style="line-height: 20.8px;">
<span style="font-size:12px; line-height:20.8px"><span style="color: #4CB0A9;"><em><strong>Erstelle Workouts</strong></em></span><br>
Die Zahl der Workouts in der WorkoutCloud steigt t&auml;glich! Probiere unseren Workout Creator aus und erstelle&nbsp;ein eigenes Workout!<br>
Die Erstellung ist spielend einfach. Nach Erstellung wird das Workout mit einer Vielzahl an Sportlern geteilt, die dieses bei Gefallen durchführen! Eine große Anzahl an sportwissenschaftlich getesteter Übungen mit Erkl&auml;rungen und Bildern warten darauf, von dir in ein Workout integriert zu werden!</span></div>

                        </td>
                    </tr>
                </tbody></table>
                
            </td>
        </tr>
    </tbody>
</table></td>
                            </tr>
                            <tr>
                                <td valign="top" id="templateFooter"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:9px" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 9px; padding-left: 9px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                
                                    
                                        <img align="center" alt="" src="https://workoutcloud.net/images/email/customer_care_email_footer_josch.png" width="564" style="max-width:1000px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage">
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowBlock" style="min-width:100%;">
    <tbody class="mcnFollowBlockOuter">
        <tr>
            <td align="center" valign="top" style="padding:9px" class="mcnFollowBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentContainer" style="min-width:100%;">
    <tbody><tr>
        <td align="center" style="padding-left:9px;padding-right:9px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnFollowContent">
                <tbody><tr>
                    <td align="center" valign="top" style="padding-top:9px; padding-right:9px; padding-left:9px;">
                        <table align="center" border="0" cellpadding="0" cellspacing="0">
                            <tbody><tr>
                                <td align="center" valign="top">
                                    <!--[if mso]>
                                    <table align="center" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                    <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->
                                        
                                        
                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;">
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right:10px; padding-bottom:9px;" class="mcnFollowContentItemContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem">
                                                            <tbody><tr>
                                                                <td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                        <tbody><tr>
                                                                            
                                                                                <td align="center" valign="middle" width="24" class="mcnFollowIconContent">
                                                                                    <a href="http://www.facebook.com/sidefits" target="_blank"><img src="https://workoutcloud.net/images/email/fb_btn_color.png" style="display:block;" height="24" width="24" class=""></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->
                                        
                                        
                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;">
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right:10px; padding-bottom:9px;" class="mcnFollowContentItemContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem">
                                                            <tbody><tr>
                                                                <td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                        <tbody><tr>
                                                                            
                                                                                <td align="center" valign="middle" width="24" class="mcnFollowIconContent">
                                                                                    <a href="https://workoutcloud.net/view/index.php#/login" target="_blank"><img src="https://workoutcloud.net/images/email/link_btn_color.png" style="display:block;" height="24" width="24" class=""></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->
                                        
                                        
                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;">
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right:0; padding-bottom:9px;" class="mcnFollowContentItemContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem">
                                                            <tbody><tr>
                                                                <td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                        <tbody><tr>
                                                                            
                                                                                <td align="center" valign="middle" width="24" class="mcnFollowIconContent">
                                                                                    <a href="mailto:welcome@workoutcloud.net" target="_blank"><img src="https://workoutcloud.net/images/email/email_btn_primary.png" style="display:block;" height="24" width="24" class=""></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                    <!--[if mso]>
                                    </tr>
                                    </table>
                                    <![endif]-->
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>

            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width:100%;">
    <tbody class="mcnDividerBlockOuter">
        <tr>
            <td class="mcnDividerBlockInner" style="min-width: 100%; padding: 10px 18px 25px;">
                <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top-width: 2px;border-top-style: solid;border-top-color: #EEEEEE;">
                    <tbody><tr>
                        <td>
                            <span></span>
                        </td>
                    </tr>
                </tbody></table>
<!--            
                <td class="mcnDividerBlockInner" style="padding: 18px;">
                <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
-->
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner">
                
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top:9px; padding-right: 18px; padding-bottom: 9px; padding-left: 18px;">
                        
                            <em>Copyright &copy; 2016, All rights reserved.</em><br>
<br>
Diese Email wurde automatisch mit Hilfe des Sidefits WorkoutCloud Services durch einen Nutzer erstellt. Solltest Du keine weiteren Emails dieser Art erhalten wollen,
kontaktiere bitte <a href='mailto:<?php echo $initiatorMail; ?>'><?php echo $initiator; ?></a>.<br /><br />
<strong>Unsere Anschrift ist:</strong><br>
Sidefits<br>
Joschka Sondhof &amp; Philipp M&auml;gel GbR<br>
Osterbrook 22<br>
20537 Hamburg<br>
                        </td>
                    </tr>
                </tbody></table>
                
            </td>
        </tr>
    </tbody>
</table></td>
                            </tr>
                        </table>
						<!--[if gte mso 9]>
						</td>
						</tr>
						</table>
						<![endif]-->
                        <!-- // END TEMPLATE -->
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>