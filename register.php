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



  if (isset($_POST['register']))
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



       $safe_data = new safe_data;

       $username          =   $safe_data->input($_POST['username']); 
       $email             =   $safe_data->input($_POST['email']);
       $password          =   $safe_data->input($_POST['password']); 
       $retype_password   =   $safe_data->input($_POST['retype_password']);
       
       $username          =   $conn->real_escape_string($_POST['username']); 
       $email             =   $conn->real_escape_string($_POST['email']);
       $password          =   $conn->real_escape_string($_POST['password']); 
       $retype_password   =   $conn->real_escape_string($_POST['retype_password']);

       


         $sql0 = "select username from login";
         $result0 = $conn->query($sql0);
 

         while ($row = $result0->fetch_assoc())
               {
              
                if ($row['username']  == $username)
                  {
           echo '<script type="text/javascript">alert("Register error. This username already exists");
           </script>';
           echo ("<script>location.href='index.php'</script>");
                    }
 

               
           else
            {


            if($password == $retype_password)
              {


              $pass = md5($password);

              $rand    = 24;
              $cookies = substr(str_shuffle("0123456789ABCDEF"),0, $rand);
  

              //$rand_qr = 1;
             // $qr      = substr(str_shuffle("0123456789"),0, $rand_qr);
             
             // $qr1 = $qr;
             // $qr2 = $qr;
             // $qr3 = $qr;
             // $qr4 = $qr;

             // $qrcode = $qr1.$qr2.$qr3.$qr4;
              
          
               $rand_qr = 4;
               $qrcode  = substr(str_shuffle("0123456789"),0, $rand_qr);
             



             $sql = "insert into login (username,password,email,cookies,verification_code,account) 
               values('$username','$pass','$email','$cookies','$qrcode','disabled')";
             $result = $conn->query($sql);


             if ($result == true)
               {

                 $sql2 = "insert into sms_available (administrator,sms_balance) 
                 values('$username','0')";
                 $result2 = $conn->query($sql2);


              session_start();


              $_SESSION['qrcode'] = $qrcode;

            

            echo '<script type="text/javascript">alert("Verify for your account enable");
           </script>';
           echo ("<script>location.href='verify.php'</script>");
 

                }



            } // end if password and retype password is same
 


         else if($password != $retype_password)
             {
           echo '<script type="text/javascript">alert("Password do note match. Please try again");
           </script>';
           echo ("<script>location.href='index.php'</script>");
               }




         } // end of else for username exists


 
        } // end of while for username exists 




      } // end of else connection




    } // end of isset


?>
