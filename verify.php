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


    if (!isset($_SESSION['qrcode']))
    {
    header('Location:index.php');
     }


?>


<html>
<head>

 <link rel="stylesheet" type="text/css" href="verify.css">


<script src="https://code.angularjs.org/1.4.8/angular.js"></script>

</head>

 <body>


 <div class="centre">


  <iframe src="verify_qrcode.php" height="300" width="400" style="border:none;"></iframe>




     <!--

    <script>angular.module('demo', []);</script>

<div ng-app="demo">
    <div>

    <table>
      <tr>
       <td> <button ng-click="i = 1" ng-init="button1 = '1'" id="but" name="but">{{ button1 }}</button> </td>
       <td> <button ng-click="i = 2" ng-init="button2 = '2'" id="but" name="but">{{ button2 }}</button> </td>
       <td> <button ng-click="i = 3" ng-init="button3 = '3'" id="but" name="but">{{ button3 }}</button> </td>
      </tr>

      <tr>
       <td> <button ng-click="i = 4" ng-init="button4 = '4'" id="but" name="but">{{ button4 }}</button> </td>
       <td> <button ng-click="i = 5" ng-init="button5 = '5'" id="but" name="but">{{ button5 }}</button> </td>
       <td> <button ng-click="i = 6" ng-init="button6 = '6'" id="but" name="but">{{ button6 }}</button> </td>
      </tr>


      <tr>
       <td> <button ng-click="i = 7" ng-init="button7 = '7'" id="but" name="but">{{ button7 }}</button> </td>
       <td> <button ng-click="i = 8" ng-init="button8 = '8'" id="but" name="but">{{ button8 }}</button> </td>
       <td> <button ng-click="i = 9" ng-init="button9 = '9'" id="but" name="but">{{ button9 }}</button> </td>
      </tr>


      <tr>
        <td></td>
       <td> <button ng-click="i = 0" ng-init="button0 = '0'" id="but" name="but0">{{ button0 }}</button> </td>
      </tr>


    </table>
  


      </div>


     -->

   &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; 
   <img src="/photos/code1.png" height="128" width="150">

      <br><br>



   <form action="" method="post">

  <input type="text" name="qr1" id="qr" pattern="[0-9]{1}" required>   
  <input type="text" name="qr2" id="qr" pattern="[0-9]{1}" required> 
  <input type="text" name="qr3" id="qr" pattern="[0-9]{1}" required> 
  <input type="text" name="qr4" id="qr" pattern="[0-9]{1}" required> 

    <br><br>

     <button type="submit" name="submit" class="form-btn">Verify</button>

   </form>



</div>
 </div>


</body>
</html>




<?php


 if (isset($_POST['submit']))
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


     $qrv1 = $_POST['qr1'];
     $qrv2 = $_POST['qr2'];
     $qrv3 = $_POST['qr3'];
     $qrv4 = $_POST['qr4'];
    
     $qrcode_v = $qrv1.$qrv2.$qrv3.$qrv4;


      
         $sql = "select verification_code from login where verification_code='".$_SESSION['qrcode']."'";
         $result = $conn->query($sql);
 

         while ($row = $result->fetch_assoc())
               {
              
                
            if ($row['verification_code'] == $qrcode_v)
                  {

                 $sql2 = "update login set account='enabled' ,verification_code='ok' 
                          where verification_code='$qrcode_v'";
                 $result2 = $conn->query($sql2);

                   session_destroy();             
 
           echo '<script type="text/javascript">alert("Your registration has been successfully completed");
           </script>';
           echo ("<script>location.href='index.php'</script>");
 

                   } // end for verication code is same



               else if ($row['verification_code'] != $qrcode_v)
                  {

                echo '<script type="text/javascript">alert("Your registration failed: Please re-enter the verification code");
                 </script>';
                echo ("<script>location.href='verify.php'</script>");

                   } 


                 } // end fo while



      } // end of else connect



   } // end of isset
 

?>
