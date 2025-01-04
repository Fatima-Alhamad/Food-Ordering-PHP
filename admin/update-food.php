<!-- menu -->

<?php include('partials/menu.php')?>

<div class="main-content">
  <div class="wrapper">
      <h1>Add Food</h1>
      <br><br>
      <?php
      if(isset($_SESSION['update-food'])){
          echo $_SESSION['update-food'];
          unset($_SESSION['update-food']);
      }
      ?>
     <br>
     <?php
        //get the id
        $food_id=$_GET['id'];
        //get the food
        $sql_get="SELECT * FROM tbl_food WHERE id=$food_id";
        $res=mysqli_query($conn,$sql_get);
        $count=mysqli_num_rows($res);
        if($count==1){
            $row=mysqli_fetch_assoc($res);
            $title=$row['title'];
            $description=$row['description'];
            $price=$row['price'];
            $category_id=$row['category_id'];
            $current_image_name=$row['image_name'];
            $featured=$row['featured'];
            $active=$row['active'];
        }
        else{
            $_SESSION['update-food']="<h5 class='red'>the food is not found</h5>";
            header("location:".SITEURL."admin/manage-food.php");
        }
     ?>
     <?php 
if(isset($_POST['submit'])){
  $title=$_POST['title'];
  $description=$_POST['description'];
  $price=$_POST['price'];
  $category=$_POST['category'];
  $featured=$_POST['featured'];  
  $active=$_POST['active'];
  $image_name=$current_image_name;
  

  //image upload 
  if(isset($_FILES['new_image_name']['name'])){
      if($_FILES['new_image_name']['name']!==""){
        if($current_image_name!==""){//remove the old image from folder
            $path="../images/food/".$current_image_name;
            $remove=unlink($path);
            if(!$remove){
                $_SESSION['update-food']="<h5 class='red'>failed to delete image</h5>";
                header("location:".SITEURL."admin/manage-food.php"); 
                die();   
            }
        }
         $image_name=$_FILES['new_image_name']['name'];
         $image_parts = explode('.', $image_name);
         $extension = end($image_parts);
         $image_name="food_name_".rand(000,999).'.'.$extension;
         $source_path=$_FILES['new_image_name']['tmp_name'];
         $destination_path="../images/food/".$image_name;
         $upload=move_uploaded_file($source_path,$destination_path);
         if(!$upload){
          $_SESSION['add-food']="<h5 class='red'>Fail to upload image</h5>";
          header("location:".SITEURL."admin/add-food.php");
          die();
         }
      }
  }
  //make the query
  $sql_update="UPDATE tbl_food SET 
  title='$title',
  description='$description',
  price=$price,
  category_id=$category,
  featured='$featured',
  active='$active',
  image_name='$image_name'
  WHERE id=$food_id
  ";
  //execute the query
  $res2=mysqli_query($conn,$sql_update);
  if($res){
      $_SESSION['add-food']="<h5 class='green'>Food updated successfully</h5>";
      header("location:".SITEURL."admin/manage-food.php");
      die();
  }
}
?>
      <form action="" method="POST" enctype="multipart/form-data">
          <table class="tbl-30">
              <tr>
                  <td>Title:</td>
                  <td>
                      <input type="text" name="title" class="input-responsive-login" id="" value="<?php echo $title;?>">
                  </td>
              </tr>
              <tr>
                  <td>Description:</td>
                  <td>
                      <textarea name="description" class="input-responsive-login" id="" cols="25" rows="3" value="" ><?php echo $description;?></textarea>
                  </td>
              </tr>
              <tr>
                  <td>Price:</td>
                  <td>
                      <input type="number" class="input-responsive-login" name="price" id="" value="<?php echo $price;?>">
                  </td>
              </tr>
              <tr>
                  <td>Current Image:</td>
                  <td>
                  <?php
                    if($current_image_name!==""){
                        ?>
                        <img width="95px" src="<?php echo "../images/food/".$current_image_name;?>" alt="">
                    <?php
                    }else{
                        echo "<h5 class='red'>Image was not added</h5>";
                    }
                    ?>
                    
                  </td>
              </tr>
              <tr>
              <tr>
                  <td>New Image:</td>
                  <td>
                      <input type="file" class="input-responsive-login" name="new_image_name" id="">
                  </td>
              </tr>
              <tr>
              <tr>
                  <td>Category:</td>

                  <td>
                      <select name="category" class="input-responsive-login" id="">
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
                                           <option value="<?php echo $id;?>" <?php if($id==$category_id){echo "selected";}?> ><?php echo $title;?></option>
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
                  <input type="radio"<?php if($featured=="yes"){echo "checked";}?> name="featured"  value="yes" class="input-responsive-login">Yes 
                  <input type="radio" <?php if($featured=="no"){echo "checked";}?> name="featured"  value="no" class="input-responsive-login">No
                  </td>
              </tr>
              <tr>
                  <td>Active:</td>
                  <td>
                      <input type="radio" <?php if($active=="yes"){echo "checked";}?> name="active" value="yes" id="" class="input-responsive-login">Yes
                      <input type="radio" <?php if($active=="no"){echo "checked";}?> name="active" value="no" id="" class="input-responsive-login">No
                  </td>
              </tr>
              <tr>
                  <td colspan="2">
                      <input type="submit" value="Update Food" class="btn-secondary input-responsive-login" name="submit">
                  </td>
              </tr>
          </table>
      </form>
  </div>
</div>


<!-- footer -->

<?php include('partials/footer.php')?>