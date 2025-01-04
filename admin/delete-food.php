<?php
include("../config/constants.php");
//check if id is set
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    //check if food exist
    $sql_get="SELECT * FROM tbl_food WHERE id=$id";
    $res=mysqli_query($conn,$sql_get);
    $count=mysqli_num_rows($res);
    if($count==1){
        if($image_name!==""){
        $path="../images/food/".$image_name;
        $remove=unlink($path);
        if(!$remove){
            $_SESSION['delete-food']="<h5 class='red'>failed to delete image</h5>";
            header("location:".SITEURL."admin/manage-food.php"); 
            die();
             
        }
        //make query to delete the food
        $sql_delete="DELETE FROM tbl_food WHERE id=$id";
        $res=mysqli_query($conn,$sql_delete);
        if($res){
            $_SESSION['delete-food']="<h5 class='green'>the food deleted successfully</h5>";
            header("location:".SITEURL."admin/manage-food.php");   
        }else{
            $_SESSION['delete-food']="<h5 class='red'>Failed to delete food</h5>";
            header("location:".SITEURL."admin/manage-food.php"); 
        }

        }
    }else{
       $_SESSION['delete-food']="<h5 class='red'>the food not found</h5>";
       header("location:".SITEURL."admin/manage-food.php"); 
    }


}else{
    header("location:".SITEURL."admin/manage-food.php");
}
?>