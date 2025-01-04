<?php 
include("../config/constants.php");

//destroy the session
session_destroy();//unset the user session variable
//redirect to login page
header("location:".SITEURL."admin/login.php")
?>