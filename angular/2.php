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



<form action="" method="POST">
    <input type="submit" value="0" name="mybutton1">
    <input type="submit" value="1" name="mybutton2">
    <input type="submit" value="2" name="mybutton3">

    <input type="submit" value="view" name="view">

</form>



<?php 


  
     $btn1 = $_POST["mybutton1"];
      $a=$btn1;
     $btn2 = $_POST["mybutton2"];
      $b=$btn2;
     $btn3 = $_POST["mybutton3"];
      $c=$btn3;


    if (isset($_POST['view']))
     {
      echo $a.$b.$c;
      }




?>
