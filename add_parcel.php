<?php
	session_start();
	include 'config.php';
  use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'vendor/phpmailer/phpmailer/src/Exception.php';
	require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
	require 'vendor/phpmailer/phpmailer/src/SMTP.php';
	error_reporting(0);

  if(empty($_SESSION['id'])){
    header("Location: index.php");
  }
  else{
  
    $user_ID = $_SESSION['id'];
    $pwd = $_SESSION['passwd'];
    $user_name = $_SESSION['name'];
    $salut = $_SESSION['sex'];
  
if(isset($_POST['addBtn'])){

    $user_ID = $_POST['userID'];
    $phone = $_POST['phone'];
    $tracking = $_POST['trackingNo'];


    $userType = substr($user_ID, 0, 1);

        if($userType == "B"){

            //check existing trackingNo
            // $sql = "SELECT * FROM customer_student WHERE trackingNo = '$tracking'";
            $sql = "SELECT * FROM parcel WHERE trackingNo = '$tracking'";
            $result = mysqli_query($conn,$sql);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0) {
                
                echo "<script>alert('Tracking number already existed'); window.location.href='manage_parcel.php';</script>";
                // header(string, replace, http_response_code);
            }
            else{
            	
                $sql = "INSERT INTO parcel (trackingNo,studentID) VALUES ('$tracking','$user_ID')";
                $result=mysqli_query($conn,$sql);

                if($resultCheck > 0){
                  echo "<script>alert('Process Unsuccessful.'); window.location.href='manage_parcel.php'</script>";
                }else{

                  $sql_stud = "SELECT * FROM customer_student WHERE customer_stud_ID = '$user_ID' LIMIT 1";
                  $result = $conn -> query($sql_stud);

                  $row = $result -> fetch_array(MYSQLI_ASSOC);
            

       $studentname =  $row["customerName"];
       $studentid = $row["customer_stud_ID"];


                  $mail = new PHPMailer(true);
  
                  try {
                    
                    $date = date("d/m/Y");
                                              
                    $mail->isSMTP();                                            
                      $mail->Host       = 'smtp.gmail.com';                    
                      $mail->SMTPAuth   = true;                             
                      $mail->Username   = 'parcelsystem99@gmail.com';                 
                      $mail->Password   = 'asxqsxvfrfxruoph';                      
                      $mail->SMTPSecure = 'tls';                              
                  $mail->Port = 587;// TCP port to connect to
                  $mail->SMTPOptions = array(
                      'ssl' => array(
                          'verify_peer' => false,
                          'verify_peer_name' => false,
                          'allow_self_signed' => true
                      )
                  );
                    
                      $mail->setFrom('test@gmail.com', 'Parcel Management System');           
                    $mail->addAddress($row["customerEmail"]);
                      //$mail->addAddress('receiver2@gfg.com', 'Name');
                         
                      $mail->isHTML(true);                                  
                      $mail->Subject = 'Parcel Management System - Parcel Arrived';
                      $mail->Body    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                      <html xmlns="http://www.w3.org/1999/xhtml">
                      <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <meta name="viewport" content="width=320, initial-scale=1" />
                        <title>Airmail Invoice</title>
                        <style type="text/css">
                      
                          /*Email */
                      
                          /* Force Outlook to provide a "view in browser" message */
                          #outlook a {
                            padding: 0;
                          }
                      
                          /* Force Hotmail to display emails at full width */
                          .ReadMsgBody {
                            width: 100%;
                          }
                      
                          .ExternalClass {
                            width: 100%;
                          }
                      
                          /* Force Hotmail to display normal line spacing */
                          .ExternalClass,
                          .ExternalClass p,
                          .ExternalClass span,
                          .ExternalClass font,
                          .ExternalClass td,
                          .ExternalClass div {
                            line-height: 100%;
                          }
                      
                      
                           /* Prevent WebKit and Windows mobile changing default text sizes */
                          body, table, td, p, a, li, blockquote {
                            -webkit-text-size-adjust: 100%;
                            -ms-text-size-adjust: 100%;
                          }
                      
                          /* Remove spacing between tables in Outlook 2007 and up */
                          table, td {
                            mso-table-lspace: 0pt;
                            mso-table-rspace: 0pt;
                          }
                      
                          /* Allow smoother rendering of resized image in Internet Explorer */
                          img {
                            -ms-interpolation-mode: bicubic;
                          }
                      
                           /* ----- Reset ----- */
                      
                          html,
                          body,
                          .body-wrap,
                          .body-wrap-cell {
                            margin: 0;
                            padding: 0;
                            background: #ffffff;
                            font-family: Arial, Helvetica, sans-serif;
                            font-size: 14px;
                            color: #464646;
                            text-align: left;
                          }
                      
                          img {
                            border: 0;
                            line-height: 100%;
                            outline: none;
                            text-decoration: none;
                          }
                      
                          table {
                            border-collapse: collapse !important;
                          }
                      
                          td, th {
                            text-align: left;
                            font-family: Arial, Helvetica, sans-serif;
                            font-size: 14px;
                            color: #464646;
                            line-height:1.5em;
                          }
                      
                          b a,
                          .footer a {
                            text-decoration: none;
                            color: #464646;
                          }
                      
                          a.blue-link {
                            color: blue;
                            text-decoration: underline;
                          }
                      
                          /* ----- General ----- */
                      
                          td.center {
                            text-align: center;
                          }
                      
                          .left {
                            text-align: left;
                          }
                      
                          .body-padding {
                            padding: 24px 40px 40px;
                          }
                      
                          .border-bottom {
                            border-bottom: 1px solid #D8D8D8;
                          }
                      
                          table.full-width-gmail-android {
                            width: 100% !important;
                          }
                      
                      
                          /* ----- Header ----- */
                          .header {
                            font-weight: bold;
                            font-size: 16px;
                            line-height: 16px;
                            height: 16px;
                            padding-top: 19px;
                            padding-bottom: 7px;
                          }
                      
                          .header a {
                            color: #464646;
                            text-decoration: none;
                          }
                      
                          /* ----- Footer ----- */
                      
                          .footer a {
                            font-size: 12px;
                          }
                        </style>
                      
                        <style type="text/css" media="only screen and (max-width: 650px)">
                          @media only screen and (max-width: 650px) {
                            * {
                              font-size: 16px !important;
                            }
                      
                            table[class*="w320"] {
                              width: 320px !important;
                            }
                      
                            td[class="mobile-center"],
                            div[class="mobile-center"] {
                              text-align: center !important;
                            }
                      
                            td[class*="body-padding"] {
                              padding: 20px !important;
                            }
                      
                            td[class="mobile"] {
                              text-align: right;
                              vertical-align: top;
                            }
                          }
                        </style>
                      
                      </head>
                      <body style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                       <td valign="top" align="left" width="100%" style="background:repeat-x url(https://www.filepicker.io/api/file/al80sTOMSEi5bKdmCgp2) #f9f8f8;">
                       <center>
                      
                         <table class="w320 full-width-gmail-android" bgcolor="#f9f8f8" background="https://www.filepicker.io/api/file/al80sTOMSEi5bKdmCgp2" style="background-color:transparent" cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                              <td width="100%" height="48" valign="top">
                                  <!--[if gte mso 9]>
                                  <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;height:49px;">
                                    <v:fill type="tile" src="https://www.filepicker.io/api/file/al80sTOMSEi5bKdmCgp2" color="#ffffff" />
                                    <v:textbox inset="0,0,0,0">
                                  <![endif]-->
                                    <table class="full-width-gmail-android" cellspacing="0" cellpadding="0" border="0" width="100%">
                                      <tr>
                                        <td class="header center" width="100%">
                                          <a href="#">
                                            PARCEL MANAGEMENT SYSTEM
                                          </a>
                                        </td>
                                      </tr>
                                    </table>
                                  <!--[if gte mso 9]>
                                    </v:textbox>
                                  </v:rect>
                                  <![endif]-->
                              </td>
                            </tr>
                          </table>
                      
                          <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff">
                            <tr>
                              <td align="center">
                                <center>
                                  <table class="w320" cellspacing="0" cellpadding="0" width="500">
                                    <tr>
                                      <td class="body-padding mobile-padding">
                      
                                      <table cellspacing="0" cellpadding="0" width="100%">
                                        <tr>
                                          <td class="left" style="padding-bottom:20px; text-align:left;">
                                            <b>Date:</b> '.$date.'
                                          </td>
                                        </tr>
                                        <br>
                                        <tr>
                                          <td class="left" style="padding-bottom:40px; text-align:left;">
                                          Hi <b>'.$studentname.'</b>,<br>
                                          Your parcel had arrived at the office, details as below:
                                          </td>
                                        </tr>
                                      </table>
                      
                                      <table cellspacing="0" cellpadding="0" width="100%">
                                        <tr>
                                          <td>
                                            <b>Student ID</b>
                                          </td>
                                          <td>
                                            <b>Tracking Number</b>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="border-bottom" height="5"></td>
                                          <td class="border-bottom" height="5"></td>
                                        </tr>
                                        <tr>
                                          <td style="padding-top:5px;">
                                            '.$studentid.'
                                          </td>
                                          <td style="padding-top:5px;">
                                          '.$tracking.'
                                          </td>
                                        </tr>
                                      </table>
                      
                                  <br><br>
                      
                                      <table cellspacing="0" cellpadding="0" width="100%; ">
                                        <tr>
                                          <td class="left" style="text-align:left;">
                                            Thank you.
                                          </td>
                                        </tr>
                                      </table>
                      
                                      </td>
                                    </tr>
                                  </table>
                                </center>
                              </td>
                            </tr>
                          </table>
                      
                          <table class="w320" bgcolor="#E5E5E5" cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                              <td style="border-top:1px solid #B3B3B3;" align="center">
                                <center>
                                  <table class="w320" cellspacing="0" cellpadding="0" width="500" bgcolor="#E5E5E5">
                                    <tr>
                                      <td>
                                        <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#E5E5E5">
                                          <tr>
                                            <td class="center" style="padding:25px; text-align:center;">
                                              <b><a href="#">PARCEL MANAGEMENT SYSTEM</a></b>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                </center>
                              </td>
                            </tr>
                            <tr>
                              <td style="border-top:1px solid #B3B3B3; border-bottom:1px solid #B3B3B3;" align="center">
                                <center>
                                  <table class="w320" cellspacing="0" cellpadding="0" width="500" bgcolor="#E5E5E5">
                                    <tr>
                                      <td align="center" style="padding:25px; text-align:center">
                                        <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#E5E5E5">
                                          <tr>
                                            <td class="center footer" style="font-size:12px;">
                                              <a href="#">This is auto generated email. Please do not reply!</a>
                                              </span>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                </center>
                              </td>
                            </tr>
                          </table>
                      
                        </center>
                        </td>
                      </tr>
                      </table>
                      </body>
                      </html>';
                      $mail->send();
                     
                  } catch (Exception $e) {
                      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                  }
                  echo "<script>alert('Process Succesful.'); 
                  window.location.href='add_parcel.php'</script>";
                          
                }
                $conn->close();
            }
            }
        else {

            //check existing user
            $sql = "SELECT * FROM parcel WHERE trackingNo = '$tracking'";
            $result = mysqli_query($conn,$sql);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0) {
            
                // header("Location: register.php");
                echo "<script>alert('Tracking number already existed.'); window.location.href='manage_parcel.php'</script>";
       
            }
            else{

            	 $sql = $sql = "INSERT INTO parcel (trackingNo,staffID) VALUES ('$tracking', '$user_ID')";
                $result=mysqli_query($conn,$sql);
                $resultCheck = mysqli_num_rows($result);

      		if($resultCheck > 0){
            echo "<script>alert('Process Unsuccessful.'); window.location.href='manage_parcel.php'</script>";
      		}else{
            //send email here
            $sql_stud = "SELECT * FROM customer_staff WHERE customer_staff_ID = '$user_ID' LIMIT 1";
            $result = $conn -> query($sql_stud);

            $row = $result -> fetch_array(MYSQLI_ASSOC);
      

 $studentname =  $row["customerName"];
 $studentid = $row["customer_staff_ID"];


            $mail = new PHPMailer(true);

            try {
              
              $date = date("d/m/Y");
                                        
              $mail->isSMTP();                                            
                $mail->Host       = 'smtp.gmail.com';                    
                $mail->SMTPAuth   = true;                             
                $mail->Username   = 'parcelsystem99@gmail.com';                 
                $mail->Password   = 'asxqsxvfrfxruoph';                      
                $mail->SMTPSecure = 'tls';                              
            $mail->Port = 587;// TCP port to connect to
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
              
                $mail->setFrom('test@gmail.com', 'Parcel Management System');           
              $mail->addAddress($row["customerEmail"]);
                //$mail->addAddress('receiver2@gfg.com', 'Name');
                   
                $mail->isHTML(true);                                  
                $mail->Subject = 'Parcel Management System - Parcel Arrived';
                $mail->Body    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                  <meta name="viewport" content="width=320, initial-scale=1" />
                  <title>Airmail Invoice</title>
                  <style type="text/css">
                
                    /* ----- Client Fixes ----- */
                
                    /* Force Outlook to provide a "view in browser" message */
                    #outlook a {
                      padding: 0;
                    }
                
                    /* Force Hotmail to display emails at full width */
                    .ReadMsgBody {
                      width: 100%;
                    }
                
                    .ExternalClass {
                      width: 100%;
                    }
                
                    /* Force Hotmail to display normal line spacing */
                    .ExternalClass,
                    .ExternalClass p,
                    .ExternalClass span,
                    .ExternalClass font,
                    .ExternalClass td,
                    .ExternalClass div {
                      line-height: 100%;
                    }
                
                
                     /* Prevent WebKit and Windows mobile changing default text sizes */
                    body, table, td, p, a, li, blockquote {
                      -webkit-text-size-adjust: 100%;
                      -ms-text-size-adjust: 100%;
                    }
                
                    /* Remove spacing between tables in Outlook 2007 and up */
                    table, td {
                      mso-table-lspace: 0pt;
                      mso-table-rspace: 0pt;
                    }
                
                    /* Allow smoother rendering of resized image in Internet Explorer */
                    img {
                      -ms-interpolation-mode: bicubic;
                    }
                
                     /* ----- Reset ----- */
                
                    html,
                    body,
                    .body-wrap,
                    .body-wrap-cell {
                      margin: 0;
                      padding: 0;
                      background: #ffffff;
                      font-family: Arial, Helvetica, sans-serif;
                      font-size: 14px;
                      color: #464646;
                      text-align: left;
                    }
                
                    img {
                      border: 0;
                      line-height: 100%;
                      outline: none;
                      text-decoration: none;
                    }
                
                    table {
                      border-collapse: collapse !important;
                    }
                
                    td, th {
                      text-align: left;
                      font-family: Arial, Helvetica, sans-serif;
                      font-size: 14px;
                      color: #464646;
                      line-height:1.5em;
                    }
                
                    b a,
                    .footer a {
                      text-decoration: none;
                      color: #464646;
                    }
                
                    a.blue-link {
                      color: blue;
                      text-decoration: underline;
                    }
                
                    /* ----- General ----- */
                
                    td.center {
                      text-align: center;
                    }
                
                    .left {
                      text-align: left;
                    }
                
                    .body-padding {
                      padding: 24px 40px 40px;
                    }
                
                    .border-bottom {
                      border-bottom: 1px solid #D8D8D8;
                    }
                
                    table.full-width-gmail-android {
                      width: 100% !important;
                    }
                
                
                    /* ----- Header ----- */
                    .header {
                      font-weight: bold;
                      font-size: 16px;
                      line-height: 16px;
                      height: 16px;
                      padding-top: 19px;
                      padding-bottom: 7px;
                    }
                
                    .header a {
                      color: #464646;
                      text-decoration: none;
                    }
                
                    /* ----- Footer ----- */
                
                    .footer a {
                      font-size: 12px;
                    }
                  </style>
                
                  <style type="text/css" media="only screen and (max-width: 650px)">
                    @media only screen and (max-width: 650px) {
                      * {
                        font-size: 16px !important;
                      }
                
                      table[class*="w320"] {
                        width: 320px !important;
                      }
                
                      td[class="mobile-center"],
                      div[class="mobile-center"] {
                        text-align: center !important;
                      }
                
                      td[class*="body-padding"] {
                        padding: 20px !important;
                      }
                
                      td[class="mobile"] {
                        text-align: right;
                        vertical-align: top;
                      }
                    }
                  </style>
                
                </head>
                <body style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                 <td valign="top" align="left" width="100%" style="background:repeat-x url(https://www.filepicker.io/api/file/al80sTOMSEi5bKdmCgp2) #f9f8f8;">
                 <center>
                
                   <table class="w320 full-width-gmail-android" bgcolor="#f9f8f8" background="https://www.filepicker.io/api/file/al80sTOMSEi5bKdmCgp2" style="background-color:transparent" cellpadding="0" cellspacing="0" border="0" width="100%">
                      <tr>
                        <td width="100%" height="48" valign="top">
                            <!--[if gte mso 9]>
                            <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;height:49px;">
                              <v:fill type="tile" src="https://www.filepicker.io/api/file/al80sTOMSEi5bKdmCgp2" color="#ffffff" />
                              <v:textbox inset="0,0,0,0">
                            <![endif]-->
                              <table class="full-width-gmail-android" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                  <td class="header center" width="100%">
                                    <a href="#">
                                      PARCEL MANAGEMENT SYSTEM
                                    </a>
                                  </td>
                                </tr>
                              </table>
                            <!--[if gte mso 9]>
                              </v:textbox>
                            </v:rect>
                            <![endif]-->
                        </td>
                      </tr>
                    </table>
                
                    <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff">
                      <tr>
                        <td align="center">
                          <center>
                            <table class="w320" cellspacing="0" cellpadding="0" width="500">
                              <tr>
                                <td class="body-padding mobile-padding">
                
                                <table cellspacing="0" cellpadding="0" width="100%">
                                  <tr>
                                    <td class="left" style="padding-bottom:20px; text-align:left;">
                                      <b>Date:</b> '.$date.'
                                    </td>
                                  </tr>
                                  <br>
                                  <tr>
                                    <td class="left" style="padding-bottom:40px; text-align:left;">
                                    Hi <b>'.$studentname.'</b>,<br>
                                    Your parcel had arrived at the office, details as below:
                                    </td>
                                  </tr>
                                </table>
                
                                <table cellspacing="0" cellpadding="0" width="100%">
                                  <tr>
                                    <td>
                                      <b>Student ID</b>
                                    </td>
                                    <td>
                                      <b>Tracking Number</b>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="border-bottom" height="5"></td>
                                    <td class="border-bottom" height="5"></td>
                                  </tr>
                                  <tr>
                                    <td style="padding-top:5px;">
                                      '.$studentid.'
                                    </td>
                                    <td style="padding-top:5px;">
                                    '.$tracking.'
                                    </td>
                                  </tr>
                                </table>
                
                            <br><br>
                
                                <table cellspacing="0" cellpadding="0" width="100%; ">
                                  <tr>
                                    <td class="left" style="text-align:left;">
                                      Thank you.
                                    </td>
                                  </tr>
                                </table>
                
                                </td>
                              </tr>
                            </table>
                          </center>
                        </td>
                      </tr>
                    </table>
                
                    <table class="w320" bgcolor="#E5E5E5" cellpadding="0" cellspacing="0" border="0" width="100%">
                      <tr>
                        <td style="border-top:1px solid #B3B3B3;" align="center">
                          <center>
                            <table class="w320" cellspacing="0" cellpadding="0" width="500" bgcolor="#E5E5E5">
                              <tr>
                                <td>
                                  <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#E5E5E5">
                                    <tr>
                                      <td class="center" style="padding:25px; text-align:center;">
                                        <b><a href="#">PARCEL MANAGEMENT SYSTEM</a></b>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </center>
                        </td>
                      </tr>
                      <tr>
                        <td style="border-top:1px solid #B3B3B3; border-bottom:1px solid #B3B3B3;" align="center">
                          <center>
                            <table class="w320" cellspacing="0" cellpadding="0" width="500" bgcolor="#E5E5E5">
                              <tr>
                                <td align="center" style="padding:25px; text-align:center">
                                  <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#E5E5E5">
                                    <tr>
                                      <td class="center footer" style="font-size:12px;">
                                        <a href="#">This is auto generated email. Please do not reply!</a>
                                        </span>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </center>
                        </td>
                      </tr>
                    </table>
                
                  </center>
                  </td>
                </tr>
                </table>
                </body>
                </html>';
                $mail->send();
               
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            echo "<script>alert('Process Successful!'); 
            window.location.href='add_parcel.php'</script>";
      		      		
      		}
                // header("Location: index.php");
                $conn->close();

            }
                    
        }

      }

    }

?>


<!DOCTYPE html>
<html>
<head>
	<title> Add New Parcel </title>
	<!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
	<!-- <link rel="stylesheet" href="style/sidebarstyle.css">  -->
  <!-- <link rel="stylesheet" href="style/extra.css">
  <link rel="stylesheet" href="style/displaytable.css"> -->
  <link rel="stylesheet" href="new_style.css">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="style/newparcelform.css"> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

  		 <!--Logo besides title-->
       <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

  <input type="checkbox" id="nav-toggle">
  <div class="sidebar">
        <div class="sidebar-brand">
        <h3><img class="logo-sidebar" src="image/logo.png" alt="parcel logo" width="70" height="60">
        <span>Parcel System</span></h3>
        </div>

    <div class="sidebar-menu">
 
      <ul>
        <li>
          <a href="dashboards.php"><span class='bx bxs-dashboard'></span><span>Dashboard</span></a>
        </li>
        <!-- <li>
          <a href="profile_admin.php"><span class='bx bx-user-circle'></span><span>User Profile</span></a>
        </li> -->
        <li>
          <a href="parcel_list.php"><span class='bx bxs-package'></span><span>Unclaimed Parcel</span></a>
        </li>
        <li>
          <a href="claim_record.php"><span class='bx bxs-hourglass-bottom'></span><span>Claim History</span></a>
        </li>
        <li>
          <a href="penalty_list.php"><span class='bx bx-money-withdraw'></span><span>Penalty Fee</span></a>
        </li>
        <li>
          <a class="active" href="add_parcel.php"><span class='bx bx-edit'></span><span>Add Parcel</span></a>
        </li>
        <li>
          <a href="logout.php"><span class='bx bx-log-out'></span><span>Logout</span></a>
        </li>
      </ul>
</div>
</div>

<div class="main-content">
  <header>
    <h2>
      <label for="nav-toggle">
        <span class="las la-bars"></span>
</label>
        Add New Parcel
</h2>
<div class="user-wrapper">
  <img src="image/bg.jpg" width="40px" height="40px" alt="">
  <div>
  <?php echo '<h4>'.$salut. " " .$user_name.'</h4>'; ?>
    <small>Admin</small>
</div>
</div>
</header>
<main>
<form id="addparcel" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

<div class="header">
    
    <p>Fill in the form to add parcel</p>
    
</div>

<div class="sep"></div>

<div class="inputs">

    <h4 style="color: red;font-size: 12px;margin-bottom:8px;">Enter "-" if customer does not include their ID number </h4>
    <input type="text" name="userID" id="userID" placeholder="User ID" autofocus required />
    <input type="text" name="phone" id="phone" placeholder="Phone Number" required autofocus />
    <input type="text" name="trackingNo" id="trackingNo" placeholder="Tracking Number" required autofocus />
    
    <button type="submit" name="addBtn" id="submit">Add Parcel</a>

</div>

</form>
</main>

</div>
</body>
<html>