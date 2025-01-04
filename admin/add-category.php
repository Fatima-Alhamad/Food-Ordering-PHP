<?php include("partials/menu.php")?>

<div class="main-content">
    <div class="wrapper">
       <h1>Add Category</h1> 
       <br><br>
       <?php
       if(isset($_SESSION['add-category'])){
        echo $_SESSION['add-category'];
        unset($_SESSION['add-category']);
       }
       ?>
       <?php
       if(isset($_SESSION['upload'])){
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
       }
       ?>
       <br>
       <!-- Form -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>
                    Title:
                    </td>
                    <td>
                    <input type="text" name="title" class="input-responsive-login" placeholder="title">
                    </td>
                </tr>
              
                <tr>
                    <td>
                        Select Image: 
                    </td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>
                <tr>
                    <td>
                    Featured: 
                    </td><br>
                    <td>
                    <input type="radio" name="featured"  value="yes" class="input-responsive-login">Yes 
                    <input type="radio" name="featured"  value="no" class="input-responsive-login">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="yes" id="" class="input-responsive-login">Yes
                        <input type="radio" name="active" value="no" id="" class="input-responsive-login">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Add Category" class="btn-secondary input-responsive-login" name="submit">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<!-- footer -->
<?php include("partials/footer.php")?>
<?php
if(isset($_POST['submit'])){
    //get data from form
    $title=$_POST['title'];
    //for radio type we need to check whether the button is selected or not
    if(isset($_POST['featured'])){
        $featured=$_POST['featured'];
    }else{
        $featured='no';  
    }
    if(isset($_POST['active'])){
        $active=$_POST['active'];
    }else{
        $active='no';
    }
    //check whether the image is selected and set value for image name 
    // print_r($_FILES['image']);
    if($_FILES['image']['name']!==""){
        //upload the image
        //we need name ,source path , destination file
        $image_name=$_FILES['image']['name'];
        //auto rename images
        //1.get extension of the image
        $extension=end(explode('.',$image_name));
        $image_name="food_category_".rand(000,999).'.'.$extension;


        $source_path=$_FILES['image']['tmp_name'];
        $destination_path="../images/category/".$image_name;
        //upload the image
        $upload=move_uploaded_file($source_path,$destination_path);
        //check whether the image is uploaded
        if(!$upload){
            $_SESSION['upload']="<h5 class='red'>Failed to upload image</h5>";
            header("location:".SITEURL."admin/add-category.php");
            die();//to not insert data in the db
        }
    }
    
    //sql query
    $sql_insert="INSERT INTO tbl_category SET
     title='$title',
     image_name='$image_name',
     featured='$featured',
     active='$active'
    ";
    //execute teh query
    $res=mysqli_query($conn,$sql_insert);
    if($res){
        $_SESSION['add-category']="<h5 class='green'>Category added Successfully</h5>";
        header("location:".SITEURL."admin/manage-category.php");
    }else{
        $_SESSION['add-category']="<h5 class='red'>Category add failed</h5>";
        header("location:".SITEURL."admin/add-category.php");
    }
}
?>