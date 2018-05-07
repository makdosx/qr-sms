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


<!DOCTYPE html>
<html>
<head>


<title> Computer World SMS </title>

 <link rel="shortcut icon" href="/photos/sms_icon.png" /> 

 <link rel="stylesheet" type="text/css" href="control_panel.css"> 

  
<script type="text/javascript">

function check()
    {
	var result = confirm("Are you sure you want to continue?");
	if(result){
		return true;
	}else{
		return false;
	}
    }

$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
	
	$('.checkbox').on('click',function(){
		if($('.checkbox:checked').length == $('.checkbox').length){
			$('#select_all').prop('checked',true);
		}else{
			$('#select_all').prop('checked',false);
		}
	});
});
</script>







  <script type="text/javascript">
   function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) 
         {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
          }
        }
   </script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



   <script>
 jQuery(function($) {
    $('tbody :checkbox').change(function() {
        $(this).closest('tr').toggleClass('selected', this.checked);
    });
    $('thead :checkbox').change(function() {
        $('tbody :checkbox').prop('checked', this.checked).trigger('change');
    });
});
  </script>





</head>



<body>




      <div id="header" align="center">
             <br>
         <a href="logout.php" id="logout"> Log out </a>
           <br><br>
 
<input type="image" src="/photos/add.png" id="img_point" alt="Submit" width="50" height="50" onclick="document.getElementById('id01').style.display='block'">


<div id="id01" class="modal">

    <!--
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">
    <img src="photos/close.png" height="20" width="20"> 
  </span>
    -->  


   <form class="modal-content animate" action="add.php" method="post">
    <div class="container">
      <label><b>Lastname</b></label>
      <input type="text" placeholder="Enter lastname" name="lastname" required>

      <label><b>Firstname</b></label>
      <input type="text" placeholder="Enter firstname" name="firstname" required>

      <label><b>Phone number</b></label>
      <input type="text" placeholder="Enter Phone number" name="phone_number" pattern="[0-9]{10}" required>
     

      <label><b>Provider</b></label>
      <input type="text" placeholder="Enter Provider" name="provider" required>
     


      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" name="submit_add" class="signupbtn">Add customer</button>
      </div>
    </div>
  </form>
</div>



     </div>


  


<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>






<script type="text/javascript">

function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}

</script>



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
          die ("Cannto connect to server " .$conn->connect_error);
           }

 
    else
     {

      $sql="select id,created,lastname,firstname,phone_number,provider
            from customers where administrator='".$_SESSION['login']."' order by lastname";
      $result=$conn->query($sql);




        $rand = 16;
        $finger= substr(str_shuffle("0123456789ABCDEF"),0, $rand);   
      
       $_SESSION['finger']=$finger;


              echo "<div align=center>
                     <table id='table' class='gridview'>

      <form action='check.php?=$finger' method='post' onSubmit='check();'/>

                 <tr bgcolor='lightblue'>
                    <td> <b> Lastname </b> </td>
                    <td> <b> Fisrtname </b> </td>
                    <td> <b> Phone number </b>  </td>
                    <td> <b> Provider </b> </td>
         <td> 
         <b> Send </b> <br>
          <input type='checkbox' onclick='toggle(this);'>
       </td>      
  
          <td> <b> Delete </b> </td>

                </tr>



            <tr>
              <td> <img src='/photos/user2.png' height='60' width='65'> </td>
              <td> <img src='/photos/user.png' height='55' width='60'> </td>
              <td> <img src='/photos/phone.png' height='55' width='60'> </td>
              <td> <img src='/photos/provider.png' height='55' width='60'> </td>
              <td> <img src='/photos/check.png' height='45' width='40'> </td>
              <td>                
          <a href='delete_all.php'
           onclick='return confirm(\"You are sure you want to delete all customers?\")'> 
                      <img src=/photos/delete.png height=45 width=50 id=img_del2 alt=delte all customers> 
                      </a>
              </td>
             </tr>";

             
                 
                 for($i=1; $i<=6; $i++)
                   {
              echo  "<td> <hr> </td>";
                    }
 
                    echo "<tr> <td></td> </tr>";
             

      while($row = $result->fetch_assoc())
          {

            $delete_mes = "Are you sure delete this customer?";

            echo "
                <tr id=sel>
                    <td> <font size=4> {$row['lastname']}  </font> </td>
                    <td> <font size=4> {$row['firstname']}  </font> </td>
                    <td> <font size=4> <b> {$row['phone_number']} </b>  </font> </td>
                    <td> <font size=4>{$row['provider']} </font>  </td>
                    <td> <input type='checkbox' name='checked_id[]' value='{$row['id']}'> </td>
                    <td> 
         <a href='delete.php?id={$row['id']}'
           onclick='return confirm(\"You are sure you want to delete the ({$row['lastname']} {$row['firstname']}) customer?\")'> 
                      <img src=/photos/delete.png height=24 width=24 id=img_del> 
                      </a>
                   </td>

                </tr>";
              }
             

         for($i=1; $i<=6; $i++)
                   {
              echo  '<td> <hr id="line"> </td>';
                    }


          echo '<tr>
                <td colspan="6">
           <input type="submit" title="check customers" name="check_submit" id="check" value="send to customers checked"/>
                </td>
                 </tr>';


          echo '<tr>
                <td colspan="6">
                </td>
                 </tr>';

         echo '</table></div>';


    

echo $finger;




     } // end of else data


      $conn->close();   
 

  }// end of else isset session login


?>

