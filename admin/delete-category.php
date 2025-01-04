<?php
include("../config/constants.php");
//get id
$id=$_GET['id'];
$image_name=$_GET['image_name'];
//remove image 
if($image_name){
    $path="../images/category/".$image_name;
    $remove=unlink($path);
    if(!$remove){
        $_SESSION['delete-category']="<h5 class='red'> Failed to remove category image</h5>";
        header("location:".SITEURL."admin/manage-category.php");
        die();
    }
}
//make query
$sql_delete="DELETE FROM tbl_category WHERE id=$id ";
$res=mysqli_query($conn,$sql_delete);
if($res){
    $_SESSION['delete-category']="<h5 class='green'>Category Deleted Successfully</h5>";
    header("location:".SITEURL."admin/manage-category.php");

}else{
    $_SESSION['delete-category']="<h5 class='red'>Category Delete Failed</h5>";
    header("location:".SITEURL."admin/manage-category.php");
}
?>