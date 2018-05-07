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
 
    if(isset($_POST['submit']))
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
          die ("Cannot connect to server " .$conn->connect_error);
           }

 
    else
     {
     
      // $obj_input = new safe_data;

       //$username = $obj_input->input($_POST['username']);
       //$password = $obj_input->input(md5($_POST['password']));       
 
       $username = $_POST['username'];
       $password = md5($_POST['password']);       
 

       $sql = "select username,password,cookies from login 
               where binary username='$username' and password='$password' 
               and verification_code='ok' and account='enabled'";
       $result=$conn->query($sql);
       //$row = $result->num_rows;


              if ($result->num_rows>0)
               {

            $_SESSION['login']=$username;

           while ($row=$result->fetch_assoc())
            {
             $_SESSION['cookies']=$row['cookies'];
               }

             header('Location: control_panel.php');


             }

          

               else
                 {
                   header('Location: index.php');
                   }



      } // end else of connect

   
     $conn->close();     
    

   } // end of isset submit


?>
