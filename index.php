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

   <link rel="shortcut icon" href="/photos/sms_icon.png" /> 


  <link rel="stylesheet" type="text/css" href="index.css">
   


<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>





    <div align="center" id="form">


         <!--
      <div align="center"> <img src="/photos/sms.png" height="200" width="300"> </div>
         <br><br>
        -->


 <div class="login-area">
        <div class="bg-image">
            <div class="login-signup">
                <div class="container">
                    <div class="login-header">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="login-logo">
                                    <img src="photos/sms1.png" alt="merkury_logo" class="img-responsive">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="login-details">
                                    <ul class="nav nav-tabs navbar-right">
                                        <li><a data-toggle="tab" href="#register">Register</a></li>
                                        <li class="active"><a data-toggle="tab" href="#login">Login</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="tab-content">
                        <div id="register" class="tab-pane">
                           <div class="login-inner">
                                <div class="title">
                                    <h1> QR <span>sms getaway!</span></h1>
                                </div>
                                <div class="login-form">
                                    <form action="register.php" method="post">
                                        <div class="form-details">
                                            <label class="user">
                                           <input type="text" name="username" placeholder="Username" id="username" required>
                                            </label>
                                            <label class="mail">
                                          <input type="email" name="email" placeholder="Email Address" id="mail" required>
                                            </label>
                                            <label class="pass">
                                              <input type="password" name="password" placeholder="Password" id="password" required>
                                            </label>
                                            <label class="pass">
                                 <input type="password" name="retype_password" placeholder="Confirm Password" id="password" required>
                                            </label>
                                        </div>
                                        <button type="submit" name="register" class="form-btn2" onsubmit="">Register</button>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div id="login" class="tab-pane fade in active">
                            <div class="login-inner">
                                <div class="title">
                                    <h1>QR <span>sms getaway!</span></h1>
                                </div>
                                <div class="login-form">
                                    <form action="login.php" method="post">
                                        <div class="form-details">
                                            <label class="user">
                                                <input type="text" name="username" placeholder="Username" id="username" required>
                                            </label>
                                            <label class="pass">
                                                <input type="password" name="password" placeholder="Password" id="password" required>
                                            </label>
                                        </div>
                                        <button type="submit" name="submit" class="form-btn">Sign in</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    



</div>











</body>
</html>
