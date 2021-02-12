<?php
    if(!function_exists('wptst_mail_addcontestant_view')){
        function wptst_mail_addcontestant_view($get_value_user){
            //print_r($get_value_user);
            $site_url = get_bloginfo('url');
            $username = $get_value_user['username'];
            $count = $get_value_user['counts'];
            $message = "";
            
            $message .='
                <html lang="en">
                 <head>
                  <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
                  <title>'. get_bloginfo('name').'</title>
                  <style type="text/css">
                  a:hover { text-decoration: none !important; }
                  .header h1 {color: #47c8db !important; font: bold 32px Helvetica, Arial, sans-serif; margin: 0; padding: 0; line-height: 40px;}
                  .header p {color: #c6c6c6; font: normal 12px Helvetica, Arial, sans-serif; margin: 0; padding: 0; line-height: 18px;}
              
                  .content h2 {color:#646464 !important; font-weight: bold; margin: 0; padding: 0; line-height: 26px; font-size: 18px; font-family: Helvetica, Arial, sans-serif;  }
                  .content p {color:#767676; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 12px;font-family: Helvetica, Arial, sans-serif;}
                  .content a {color: #0eb6ce; text-decoration: none;}
                  .footer p {font-size: 11px; color:#7d7a7a; margin: 0; padding: 0; font-family: Helvetica, Arial, sans-serif;}
                  .footer a {color: #0eb6ce; text-decoration: none;}
                  </style>
               </head>
               
              <body style="margin: 0; padding: 0; background: #4b4b4b;" bgcolor="#4b4b4b">
                   
                    <table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="padding: 35px 0; background: #4b4b4b;">
                      <tr>
                        <td align="center" style="margin: 0; padding: 0; background:#4b4b4b;" >
                            <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" style="font-family: Helvetica, Arial, sans-serif; background:#2a2a2a;" class="header">
                                <tr>
                                <td width="20"style="font-size: 0px;">&nbsp;</td>
                                <td width="580" align="left" style="padding: 18px 0 10px;">
                                    <h1 style="color: #47c8db; font: bold 32px Helvetica, Arial, sans-serif; margin: 0; padding: 0; line-height: 40px;">'.get_bloginfo('name').'</h1>
                                    <p style="color: #c6c6c6; font: normal 12px Helvetica, Arial, sans-serif; margin: 0; padding: 0; line-height: 18px;">'.get_bloginfo('description').'</p>
                                </td>
                              </tr>
                            </table><!-- header-->
                    
                            <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" style="font-family: Helvetica, Arial, sans-serif; background: #fff;" bgcolor="#fff">
                                
                                <tr>
                                <td width="600" valign="top" align="left" style="font-family: Helvetica, Arial, sans-serif; padding: 20px 0 0;" class="content">
                                    <table cellpadding="0" cellspacing="0" border="0"  style="color: #717171; font: normal 11px Helvetica, Arial, sans-serif; margin: 0; padding: 0;" width="600">';
            
      
                                    $message .='<tr>
                                        <td width="21" style="font-size: 1px; line-height: 1px;"><p>&nbsp;</p></td>
                                        <td style="padding: 15px 0 15px;"  valign="top">
                                            <p>&nbsp;</p>
                                            <p style="color:#767676; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 12px;font-family: Helvetica, Arial, sans-serif;"> User <b>'.$username.'</b> has tried to log in with an unsuitable password too many times to your site <a href="'.$site_url.'">'.$site_url.'</a></p><br>
                            
                                            <p style="color:#767676; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 12px;font-family: Helvetica, Arial, sans-serif;"> The system has identified <b>'.$count.'</b> unsuccessful login attempts</p><br>
        
                                        </td>
                                    </tr>
                                    </table>    
                                </td>

                              </tr>
                                <tr>
                                    <td width="600" align="left" style="padding: font-size: 0; line-height: 0; height: 3px;" height="3" colspan="2">&nbsp;</td>
                                  </tr> 
                            </table><!-- body -->
                            <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" style="font-family: Helvetica, Arial, sans-serif; line-height: 10px;" class="footer"> 
                            <tr>
                                <td align="center" style="padding: 5px 0 10px; font-size: 11px; color:#7d7a7a; margin: 0; line-height: 1.2;font-family: Helvetica, Arial, sans-serif;" valign="top">
                                    <br><p style="font-size: 11px; color:#7d7a7a; margin: 0; padding: 0; font-family: Helvetica, Arial, sans-serif;">This is an Automated Email</p>
                                    <p style="font-size: 11px; color:#7d7a7a; margin: 0; padding: 0; font-family: Helvetica, Arial, sans-serif;">Sent From <webversion style="color: #0eb6ce; text-decoration: none;"><a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a></webversion>. Please Do not respond </p>
                                </td>
                              </tr>
                            </table><!-- footer-->
                        </td>
                        </td>
                    </tr>
                </table>
              </body>
            </html>';
            
            return $message;
            
        }
    }else{
        die("<h2>".__('Failed to load Add password mail view','wptst-password')."</h2>");
    }
?>    