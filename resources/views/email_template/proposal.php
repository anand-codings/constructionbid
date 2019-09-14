<!DOCTYPE html>
<html>
     <head>
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
          <title>Visit Account</title>
          <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900&display=swap" rel="stylesheet">
          <!--font-family: 'Lato', sans-serif;-->

     </head>
     <body>
          <table style="width:700px;height: 100%;background-color: #F5F6F8;margin:0 auto;padding:20px;">
               <tr>
                    <td align="center" valign="top">
                         <table border="0" cellpadding="20" style="width:100%;padding-bottom: 0px;background-color: #fff;">
                              <tr>
                                   <td align="center" valign="top" style="">
                                        <table border="0" cellpadding="20" cellspacing="0"  style="width:100%;padding-bottom:0px;">
                                             <tr>
                                                  <td style="padding: 0 0 10px 0;border-bottom: 1px solid #cecece;">
                                                       <a href="#"><img src="http://codingpixeldemo.com/email-images/logo-construct.png" alt="logo" border="0" ></a>
                                                  </td>
                                                  <td style="padding: 0 0 10px 0;text-align: right;border-bottom: 1px solid #cecece;color:#7F8FA4;font-size: 11px;font-family: 'Lato', sans-serif;font-weight: 400;">
                                                       Proposal
                                                  </td>
                                             </tr>   
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td align="center" valign="top" style="">
                                        <table border="0" cellpadding="20" cellspacing="0"  style="width:100%;padding-bottom:0px;">
                                             <tr>
                                                  <td style="padding: 0 0 20px 0;font-family: 'Lato', sans-serif;font-size: 20px;text-align:center;color:#334150;font-weight: 800;">Proposal</td>
                                             </tr>
                                                  <tr>
                                                  <td style="padding: 0 0 20px 0;font-family: 'Lato', sans-serif;font-size: 20px;text-align:left;color:#000;font-weight: 800;">Hi <?=$home_name?> :
                                                  </td>
                                             </tr>
                                                                           <tr>
                                                  <td style="padding: 0 0 20px 0;font-family: 'Lato', sans-serif;font-size: 20px;text-align:left;color:#000;font-weight: 800;">By : <?=$company_name?> 
                                                  </td>

                                             </tr>
                                             <tr>
                                                  <td style="padding: 0 0 20px 0;font-family: 'Lato', sans-serif;font-size: 20px;text-align:left;color:#000;font-weight: 800;">Subject : <?= isset($subject) ? $subject : ''?>.
                                                  </td>
                                             </tr>
                                           
                                             <tr>
                                                  <td style="padding: 0 0 20px 0;font-family: 'Lato', sans-serif;font-size: 20px;text-align:left;color:#000;font-weight: 800;">Message :<?= isset($messagee) ? $messagee : ''?>.
                                                  </td>
                                             </tr>
<!--                                             <tr>
                                                  <td style="padding: 0 0 20px 0;font-family: 'Lato', sans-serif;font-size: 20px;text-align:left;color:#7F8FA4;font-weight: 400;font-size: 18px;line-height: 1.6;">
                                                  </td>
                                             </tr>-->
<!--                                             <tr>
                                                  <td style="padding: 20px 0 20px 0;text-align: center;">
                                                       <a href="<? $acceept?>" style="background-color: #1ec51e;color:#fff;text-decoration:none;padding:10px 50px;font-size: 13px;font-family: 'Lato', sans-serif;font-weight:400;width: 120px;display: inlinek;margin:0 auto;border-radius:5px;text-align: center;">Accept</a>
                                                       <a href="<? $reject?>" style="background-color: red;text-decoration:none;text-decoration:none;color:#fff;padding:10px 50px;font-size: 13px;font-family: 'Lato', sans-serif;font-weight:400;width: 120px;display: inlinek;margin:0 auto;border-radius:5px;text-align: center;">Reject</a>
                                                  </td>
                                             </tr>-->
                                             <tr>
                                                  <td style="padding: 20px 0 20px 0;text-align:center;color:#7F8FA4;font-family: 'Lato', sans-serif;font-size: 16px;font-weight:400;"></td>
                                             </tr>
                                             <tr>
                                                 <td style="padding: 0 0 20px 0;font-family: 'Lato', sans-serif;font-size: 20px;text-align:center;color:#334150;font-weight: 800;"><a href="<?= $view_job ?>">Click here to View Job</a>
                                                  </td>
                                             </tr>
                                             <tr>
                                                  <td style="padding: 0 0 20px 0;font-family: 'Lato', sans-serif;font-size: 20px;text-align:center;color:#334150;font-weight: 800;">Need Help?
                                                  </td>
                                             </tr>
                                             <tr>
                                                  <td style="padding: 20px 0 5px 0;text-align:center;color:#7F8FA4;font-family: 'Lato', sans-serif;font-size: 16px;font-weight:400;">Please send any feedback or bug reports <br/>
                                                       to <a href="mailto:hello@construction.com" style="color:#249AF3;">hello@construction.com</a>
                                                  </td>
                                             </tr>
                                          
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td style="padding: 0 0 20px 0;text-align:center;color:#7F8FA4;font-family: 'Lato', sans-serif;font-size: 16px;font-weight:400;">
                                        ⓒ ConstructBid Inc. - 702 Rath Parks, New-York, USA
                                   </td>
                                   
                              </tr>
                              <tr>
                                   <td style="padding: 0 0 20px 0;text-align:center;color:#7F8FA4;font-family: 'Lato', sans-serif;font-size: 16px;font-weight:400;">
                                        <img src="http://codingpixeldemo.com/email-images/twitter1.png"/>
                                        <img src="http://codingpixeldemo.com/email-images/Instagram.png"/>
                                        <img src="http://codingpixeldemo.com/email-images/facebook.png"/>
                                   </td>
                              </tr>
                         </table>
                    </td>
               </tr>
          </table>
     </body>
</html>