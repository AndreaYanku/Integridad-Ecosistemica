<?php

    $dsnAuth = "mysql:localhost;port=3306;dbname=yankuser_integridad";
    $DBUserAuth = "yankuser_ie";
    $DBPasswordAuth = "wfPyv_FJ.s86";


    function sendEmail($email, $title, $text, $linkText, $link)
	{
		$to = $email; 
		$from = "Integridad Ecosistémica <contacto@integridadecosistemica.info>"; 
		$subject = $title;
		
		// Carriage return type (we use a PHP end of line constant)
		$eol = PHP_EOL;

		// Main header
		$headers  = "From: ".$from.$eol;
		$headers .= "Content-type: text/html\r\n"; 
		$headers.= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers.= 'Content-Transfer-Encoding: 8bit';

		$body .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body paddingwidth="0" paddingheight="0"   style="padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;" offset="0" toppadding="0" leftpadding="0">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableContent bgBody" align="center"  style="font-family:Helvetica, Arial,serif;">


      <tr><td height="35"></td></tr>
      <tr>
        <td>
          <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="bgItem">
            <tr>
              <td width="40"></td>
              <td width="520">
                <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">

                  <tr><td height="75"></td></tr>

                  <tr>
                    <td class="movableContentContainer" valign="top">

                      <div lass="movableContent">
                        <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr>
                            <td valign="top" align="center">
                              <div class="contentEditableContainer contentTextEditable">
                                <div class="contentEditable">
                                  <p style="text-align:center;margin:0;font-family:Arial;font-size:26px;color:#222222;"><span style="color:#5fa900;"></span></p>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </table>
                      </div>

                      <div lass="movableContent">
                        <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr>
                            <td valign="top" align="center">
                              <div class="contentEditableContainer contentImageEditable">
                                <div class="contentEditable">
                                  	<img src="http://integridadecosistemica.info/img/logo-color.png" height="100" alt="" data-default="placeholder" data-max-width="560">
                                </div>
                              </div>
                            </td>
                          </tr>
                        </table>
                      </div>

                      <div class="movableContent">
                        <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr><td height="55"></td></tr>
                          <tr>
                            <td align="left">
                              <div class="contentEditableContainer contentTextEditable">
                                <div class="contentEditable" align="center">
                                  <h2>'. $title .'</h2>
                                </div>
                              </div>
                            </td>
                          </tr>

                          <tr><td height="15"> </td></tr>

                          <tr>
                            <td align="left">
                              <div class="contentEditableContainer contentTextEditable">
                                <div class="contentEditable" align="center">
                                  <p  style="text-align:left;color:#999999;font-size:14px;font-weight:normal;line-height:19px;">
                                    '. $text .'
                                  </p>
                                </div>
                              </div>
                            </td>
                          </tr>

                          <tr><td height="55"></td></tr>

                          <tr>
                            <td align="center">
                              <table>
                                <tr>
                                  <td align="center" bgcolor="#5fa900" style="background:#5fa900; padding:15px 18px;-webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;">
                                    <div class="contentEditableContainer contentTextEditable">
                                      <div class="contentEditable" align="center">
                                        <a target="_blank" href="http://integridadecosistemica.info/'. $link .'" class="link2" style="color:#ffffff;">'. $linkText .'</a>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr><td height="20"></td></tr>
                        </table>
                      </div>

                      <div lass="movableContent">
                        <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr><td height="65"></td></tr>
                          <tr><td  style="border-bottom:1px solid #DDDDDD;"></td></tr>

                          <tr><td height="25"></td></tr>

                          <tr>
                            <td>
                              <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                                <tr>
                                  <td valign="top" align="left" width="370">
                                    <div class="contentEditableContainer contentTextEditable">
                                      <div class="contentEditable" align="center">
                                        <p  style="text-align:left;color:#CCCCCC;font-size:12px;font-weight:normal;line-height:20px;">
                                          <span style="font-weight:bold;">Integridad Ecosistémica</span>
                                          <br>
                                          2016
                                          <br>

                                        </p>
                                      </div>
                                    </div>
                                  </td>

                                  <td width="30"></td>

                                  <td valign="top" width="52">
                                    <div class="contentEditableContainer contentFacebookEditable">
                                      <div class="contentEditable">

                                      </div>
                                    </div>
                                  </td>

                                  <td width="16"></td>

                                  <td valign="top" width="52">
                                    <div class="contentEditableContainer contentTwitterEditable">
                                      <div class="contentEditable">

                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </div>

                    </td>
                  </tr>

                </table>
              </td>
              <td width="40"></td>
            </tr>
          </table>
        </td>
      </tr>

      <tr><td height="88"></td></tr>
    </table>
    
</body>
</html>'.$eol;

		// Send message
		mail($to, $subject, $body, $headers);
    }
?>