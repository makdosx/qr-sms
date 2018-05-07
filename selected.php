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


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  
     $finger = $_SESSION['finger'];
     $user_login = $_SESSION['login'];


    $sql2="select lastname,firstname,phone_number,provider 
            from send where administrator='$user_login'";    
    $result2=$conn->query($sql2);


       
        
          echo "<div align=center>
                     <table id='table'>


                 <tr bgcolor='lightblue'>
                    <td> <b> Lastname </b> </td>
                    <td> <b> Fisrtname </b> </td>
                    <td> <b> Phone number </b>  </td>
                    <td> <b> Provider </b> </td>
                </tr>


             <tr>
              <td> <img src='/photos/user2.png' height='60' width='65'> </td>
              <td> <img src='/photos/user.png' height='55' width='60'> </td>
              <td> <img src='/photos/phone.png' height='55' width='60'> </td>
              <td> <img src='/photos/provider.png' height='55' width='60'> </td>
             </tr>";




         for($i=1; $i<=4; $i++)
                   {
              echo  '<td> <hr id="line"> </td>';
                    }



      while($row2 = $result2->fetch_assoc())
          {
            echo "
                <tr>
                    <td>  <b> {$row2['lastname']} </b>  </td>
                    <td>  <b> {$row2['firstname']} </b>  </td>
                    <td>  <b> {$row2['phone_number']} </b>  </td>
                    <td>  <b> {$row2['provider']} </b>  </td>
                </tr>";
              }
             


         echo '</table></div>';


      } // end else data


   $conn->close();



   } // end of else login
 



?>
