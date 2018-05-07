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
          die ("Cannot connect to server " .$conn->connect_error);
           }


 

    else
     { 

    
  if(isset($_GET['id']))
    {

     $id = intval($_GET['id']);


     if($id <= 0) 
       {
        die('The ID is invalid!');
       }


    else
       {

       
   $sql="DELETE FROM customers where id='$id' and administrator='".$_SESSION['login']."'";
   $result=$conn->query($sql);

   if ($result)
     {
      echo '<script type="text/javascript">alert("Delete customer sucessfuly");
         </script>';
          header('Location: control_panel.php');
      }

  else
   {
   echo '<script type="text/javascript">alert("Error! Can not delete customer");
         </script>';
       header('Location: control_panel.php');
      }


         }
  

      }



      }// end of else connect




   } // end of else session

  
?>



