<?php
   //check whether user is logged in or not (Authorization)
   if(!isset($_SESSION['user'])){
    //the user is not loggedIn
    //redirect to login page
    $_SESSION['not-loggedin-message']="<h5 class='red'>Please login to access admin panel</h5>";
    header("location:".SITEURL."admin/login.php");
   }
   ?>