<?php
session_start();
 $name = $_SESSION["name"];
unset($_SESSION["name"]); 

include('include/function.php');

   $jk=mysqli_query($conn,"select * from portal_user where USER_NAME = '$name' ");
              while ($d=mysqli_fetch_array($jk)){
                 $user_id=$d['user_id'];
                  
              }
            


	 header("location:login.php");

?>