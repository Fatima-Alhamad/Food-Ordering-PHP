<?php
//start session
session_start();
// site url
define('SITEURL','http://localhost/fatimaalhamad_P2/');
//connection to the db
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_NAME','food_order');

$conn=mysqli_connect(LOCALHOST,DB_USERNAME,)or die(mysqli_error());
$db_select=mysqli_select_db($conn,DB_NAME)or die(mysqli_error());

?>