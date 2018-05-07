<?php

/*
 * Copyright (c) 2017-2018 Barchampas Gerasimos <makindosx@gmail.com>
 * QR-sms is a sms getaway with qrcode for verification (etc).
 *
 * QR-sms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 *
 * QR-sms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

 session_start();


?>


<html>
<head>


<title> Computer World SMS </title>

 <link rel="shortcut icon" href="/photos/sms_icon.png" /> 

 <link rel="stylesheet" type="text/css" href="send.css"> 


</head>


<body>


        <div id="header" align="center">
            Send <strong> massively </strong> sms to your customers!
             <br><br>
            <form action="" method="post">
         <input type="submit" name="sub_back" id="back" value="&nbsp; &nbsp; &nbsp; &nbsp; Cancel and back">
           </form>
     </div>



    
    <div align="center">
      <iframe src="selected.php" width="100%" height="600"
       style="opacity:1; box-shadow:none;" frameBorder="0"  scrolling="yes">
      </iframe>
       </div>



    <div align="center">
  <form action="" method="POST">
      <br><br>
   <input type="text"  id="mes" name="message" maxlength="125" autofocus="autofocus"  required>
    <br><br>
  <input type="submit" name="submit" value="Send sms to customers" id="sub">
  </form>
  </div>


</body>
</html>








<?php


  if(!isset($_SESSION['login']))
    {
     header('Location:index.php');
     }


  else
    {


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require 'classes.php';
  
   $obj_con =  new security;

  $host = $obj_con->connect[0];
  $user = $obj_con->connect[1];
  $pass = $obj_con->connect[2];
  $db   = $obj_con->connect[3]; 


    $conn = new mysqli($host,$user,$pass,$db);

      if($conn->connect_error)
         {
          die ("Cannot connect to server " .$conn->connect_error);
           }



   else
    {





       $finger = $_SESSION['finger'];
       $user_login = $_SESSION['login'];


       if(isset($_POST['sub_back']))
           {
            
            $sql="delete from send where administrator='$user_login'";
            $result=$conn->query($sql);

             header('Location: control_panel.php');
             }





             if(isset($_POST['submit']))
               {


          require_once 'terracom-sms-helper2.php';

	  $sms = new SMSHelper();


          $message = stripslashes($_POST['message']);
          $message =  $conn->real_escape_string($_POST['message']);
        


           $sql2="select phone_number from send where administrator='$user_login'";
           $result2=$conn->query($sql2);
         

            while ($row2=$result2->fetch_assoc())
                 {
	


	// SMS data array collection - msg_id => message id, provided by your system.
	$sms_data = array(
		array(
			'destination' => $row2['phone_number'],
			'message' =>  $message
		)

	);


        $api_token = "01966e46d7601d01c72bd12983bd4a75f142b8a01805342b7ec8bd2ddccbf2a7";		
	$sender_name = "i-cube.gr";		// Max 11 characters
	
	$res = $sms->sendSMSMulti($sms_data, $api_token, $sender_name, 0);
	


       // echo '<div style="color: #047C02"><b>Input:</b></div>' .  "<pre>" . print_r($sms_data, true) . '</pre><hr>';
echo "<div id='result_operation'> 
      <div align='center'> <font color='red'> <b> Result of operation:</b> </font> </div> 
       <pre> '".print_r($res, TRUE)."' </pre> 
          </div>";



                if ($res==true)
                  {
 
           $sql3="update send set send_to='yes' , message='$message' where administrator='$user_login'";
           $result3=$conn->query($sql3);


           $sql4="insert into backup_send select * from send where administrator='$user_login'";
           $result4=$conn->query($sql4);


           $sql5="UPDATE sms_available SET sms_balance = (
                  SELECT COUNT(send_to) FROM backup_send 
                  WHERE backup_send.administrator = sms_available.administrator) + sms_balance;";
           $result5=$conn->query($sql5);


           $sql7="delete from send where administrator='$user_login'";
           $result7=$conn->query($sql7);


                 }


             }
	


 
        
         }// end of isset submit for send sms



      } // end of else data
 

     $conn->close();


 

  } // end else of isset login


?>
