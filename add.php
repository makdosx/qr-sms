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

   if(!isset($_SESSION['login']))
    {
     header('Location:index.php');
     }


  else
    {

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


         if (isset($_POST['submit_add']))
           {

       $safe_data = new safe_data;

       $lastname      =  $safe_data->input($_POST['lastname']); 
       $firstname     =  $safe_data->input($_POST['firstname']);
       $phone_number  =  $safe_data->input($_POST['phone_number']); 
       $provider      =  $safe_data->input($_POST['provider']);
       
       $lastname      =  $conn->real_escape_string($_POST['lastname']); 
       $firstname     =  $conn->real_escape_string($_POST['firstname']);
       $phone_number  =  $conn->real_escape_string($_POST['phone_number']); 
       $provider      =  $conn->real_escape_string($_POST['provider']);


         $sql="insert into customers (administrator,lastname,firstname,phone_number,provider) 
               values('{$_SESSION['login']}','$lastname','$firstname','$phone_number','$provider')";
         $result = $conn->query($sql);


             if ($result == true)
               {
            echo '<script type="text/javascript">alert("Adding a customer successfully.");
           </script>';
           echo ("<script>location.href='control_panel.php'</script>");
                }

 
           else
             {
           echo '<script type="text/javascript">alert("Failed to add customer.");
           </script>';
           echo ("<script>location.href='control_panel.php'</script>");
               }



        } // end of isset submit     


     } // end of else connect



   } // end of else session

  ?>
