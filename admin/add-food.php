<!-- menu -->

  <?php include('partials/menu.php')?>
  <?php 
  if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $category=$_POST['category'];
    if(isset($_POST['featured'])){
    $featured=$_POST['featured'];
    }
    else{
        $featured="no";  
    }
    if(isset($_POST['active'])){
    $active=$_POST['active'];
    }
    else{
        $active="no";
    }

    //image upload 
    if(isset($_FILES['image_name']['name'])){
        if($_FILES['image_name']['name']!==""){
           $image_name=$_FILES['image_name']['name'];
           $image_parts = explode('.', $image_name);
           $extension = end($image_parts);
           $image_name="food_name_".rand(000,999).'.'.$extension;
           $source_path=$_FILES['image_name']['tmp_name'];
           $destination_path="../images/food/".$image_name;
           $upload=move_uploaded_file($source_path,$destination_path);
           if(!$upload){
            $_SESSION['add-food']="<h5 class='red'>Fail to upload image</h5>";
            header("location:".SITEURL."admin/add-food.php");
            die();
           }
        }
    }
    else{
        $image_name=""; 
    }
    //make the query
    $sql_add="INSERT INTO tbl_food SET 
    title='$title',
    description='$description',
    price=$price,
    category_id=$category,
    featured='$featured',
    active='$active',
    image_name='$image_name'
    ";
    //execute the query
    $res2=mysqli_query($conn,$sql_add);
    if($res2){
        $_SESSION['add-food']="<h5 class='green'>Food added successfully</h5>";
        header("location:".SITEURL."admin/manage-food.php");
        die();
    }
  }
  ?>

  <div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php
        if(isset($_SESSION['add-food'])){
            echo $_SESSION['add-food'];
            unset($_SESSION['add-food']);
        }
        ?>
       <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" class="input-responsive-login" id="">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" class="input-responsive-login" id="" cols="25" rows="3"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" class="input-responsive-login" name="price" id="">
                    </td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td>
                        <input type="file" class="input-responsive-login" name="image_name" id="">
                    </td>
                </tr>
                <tr>
                <tr>
                    <td>Category:</td>

                    <td>
                        <select name="category"  class="input-responsive-login" id="">
                        <?php
                            //get categories from db
                            $sql_get_categories="SELECT * FROM tbl_category WHERE active='yes'";
                            $res=mysqli_query($conn,$sql_get_categories);
                            if($res){
                                $count=mysqli_num_rows($res);
                                if($count>0){
                                    while($row=mysqli_fetch_assoc($res)){
                                        $id=$row['id'];
                                        $title=$row['title'];
                                        ?>
                                             <option value="<?php echo $id;?>"><?php echo $title;?></option>
                                        <?php
                                        
                                    }
                                }
                                else{
                                    ?>
                                        <option value="0">No Category Found</option>
                                    <?php
                                }
                                
                            }
                        ?>
                            
                           
                           
                        </select>
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
                        <input type="submit" value="Add Food" class="btn-secondary input-responsive-login" name="submit">
                    </td>
                </tr>
            </table>
        </form>
    </div>
  </div>
 
<!-- footer -->

  <?php include('partials/footer.php')?>
