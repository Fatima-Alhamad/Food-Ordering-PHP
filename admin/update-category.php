<?php
include("partials/menu.php");
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <?php
        //get id 
        $id=$_GET['id'];
        //make query
        $sql_get_data="SELECT * FROM tbl_category WHERE id=$id";
        $res=mysqli_query($conn,$sql_get_data);
        if($res){
            $count=mysqli_num_rows($res);
            if($count==1){
                $row=mysqli_fetch_assoc($res);
                $title=$row['title'];
                $image_name=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];
            }
            else{
                $_SESSION['update-category']="<h5 class='red'>category not found</h5>";
                header("location:".SITEURL."admin/manage-category.php");
            }
        }
        ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>
                    Title:
                </td>
                <td>
                    <input type="text" name="title" class="input-responsive-login" id="" value="<?php echo $title;?>">
                </td>
            </tr>
            <tr>
                <td>
                    Image:
                </td>
                <td>
                   <?php
                   if($image_name!=""){
                    ?>
                    <img width="95px" src="<?php echo SITEURL."images/category/".$image_name?>" alt="" srcset="">
                    <?php
                   }
                   else{
                    echo "<h5 class='red'>Image was not added</h5>";
                   }
                   ?>
                </td>
            </tr>
            <tr>
                <td>
                    New Image:
                </td>
                <td>
                    <input type="file" name="new_image" id="">
                </td>
            </tr>
            <tr>
                <td>
                    Featured:
                </td>
                <td>
                    <input type="radio" <?php if($featured=="yes"){echo "checked";}?> name="featured" id="" value="yes">Yes
                    <input type="radio" <?php if($featured=="no"){echo "checked";}?> name="featured" id="" value="no">NO
                </td>
            </tr>
            <tr>
                <td>
                    Active:
                </td>
                <td>
                    <input type="radio" <?php if($active=="yes"){echo "checked";}?> name="active" id="" value="yes">Yes
                    <input type="radio" <?php if($active=="no"){echo "checked";}?> name="active" id="" value="no">NO
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Update Category" name="submit" class="btn-secondary input-responsive-login">
                </td>
            </tr>

        </table>
    </form>
    </div>
</div>
<?php
if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $old_image_name=$image_name;
    $featured=$_POST['featured'];
    $active=$_POST['active'];

    //upload the new image if it exist
    if($_FILES['new_image']['name']!=""){
        //remove current image
        if($old_image_name!=""){
        $path="../images/category/".$old_image_name;
        $remove= unlink($path);
        }
        $new_image_name=$_FILES['new_image']['name'];
        $extension=end(explode('.',$new_image_name));
        $new_image_name="food_category_".rand(000,999).'.'.$extension;
        $source_path=$_FILES['new_image']['tmp_name'];
        $destination_path="../images/category/".$new_image_name;
        $upload=move_uploaded_file($source_path,$destination_path);
        if(!$upload){
            $_SESSION['update-category']="<h5 class='red'>Fail to upload image </h5>";
            header("location:".SITEURL."admin/update-category.php");
            die();
        }
    }
    else{
        $new_image_name=$old_image_name;
    }
    //make the query
         $sql_update="UPDATE tbl_category SET 
         title='$title',
         image_name='$new_image_name',
         featured='$featured',
         active='$active'
         WHERE id=$id
         ";  
    //execute the query
    $res2=mysqli_query($conn,$sql_update);
    if($res2){
        $_SESSION['update-category']="<h5 class='green'> Category Updated</h5>";
        header("location:".SITEURL."admin/manage-category.php");
    }
    else{
        $_SESSION['update-category']="<h5 class='red'> Category Updated Failed</h5>";
        header("location:".SITEURL."admin/manage-category.php");
    }
}
?>
<!-- footer -->
<?php
include("partials/footer.php");
?>