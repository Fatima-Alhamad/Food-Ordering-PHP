<?php
include('../config/constants.php');
//1.get the id of the admin to be deleted
$id=$_GET['id'];

//2. create query to delete the admin
$sql_delete="DELETE FROM tbl_admin WHERE id=$id";
//execute the query 
$res=mysqli_query($conn,$sql_delete); 
if($res){
    //query executed successfully
    //create session to display message
    $_SESSION['delete']="<h5 class='green'>Admin deleted successfully</h5>";
    header("location:".SITEURL."admin/manage-admin.php");


}else{
  //create session to display message
  $_SESSION['delete']="<h5 class='red'>Admin deleted Failed</h5>";
  header("location:".SITEURL."admin/manage-admin.php");
}
//3.redirect to manage page with success or error message 

?>