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
         <a href="control_panel.php" id="back"> &nbsp;  &nbsp;  &nbsp;  &nbsp; Cancel and back </a>
     </div>








</body>
</html>








<?php

session_start();

  if(!isset($_SESSION['login']))
    {
     header('Location:index.php');
     }


  else
    {


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['check_submit']))
      {
    $idarr = $_POST['checked_id'];


    require 'classes.php';
  
   $obj_con =  new security;

  $host = $obj_con->connect[0];
  $user = $obj_con->connect[1];
  $pass = $obj_con->connect[2];
  $db   = $obj_con->connect[3]; 


    $conn = new mysqli($host,$user,$pass,$db);

      if($conn->connect_error)
         {
          die ("Cannto connect to server " .$conn->connect_error);
           }



   else
    {

 
    $finger = $_SESSION['finger'];
    $user_login = $_SESSION['login'];
 
 
    foreach($idarr as $id)
      {

        $sql="insert into send (administrator,lastname,firstname,phone_number,provider,finger)
               select customers.administrator, customers.lastname, customers.firstname, customers.phone_number, customers.provider,'$finger'
               from customers
               where customers.id='$id'";
        $result=$conn->query($sql);
 
           header('Location: send.php'); // an mpei mesa kai epileskei

        } // end fo foreach

             header('Location: send.php'); // an deiksei null


      } // end of else data
 

     $conn->close();


    } // end fo isset submit

   



  } // end else of isset login


?>
