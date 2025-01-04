
    <!-- menu-->
   <?php include("partials-front/menu.php")?>

    <!-- Categories Section -->
    <section class="categories categories-page">
      <div class="container">
        <h2>Explore Our Menu Categories</h2>

        <div class="categories-grid">
        <?php
          //get all categories
          $sql_category="SELECT * FROM tbl_category WHERE active='yes' ";
          $res=mysqli_query($conn,$sql_category);
          $count=mysqli_num_rows($res);
          if($count>0){
            //categories available
            while($row=mysqli_fetch_assoc($res)){
              $id=$row['id'];
              $title=$row['title'];
              $image_name=$row['image_name'];
            
            ?>
            <a href="<?php echo SITEURL."category-foods.php?id=".$id?>" class="box-3">
            <img
              src="<?php echo SITEURL."images/category/".$image_name;?>"
              alt="<?php echo $title;?>"
              class="img-responsive img-curve"
            />
            <div class="float-text">
              <h3><?php echo $title;?></h3>
              <p>12 varieties</p>
            </div>
          </a>
              <?php
            }
          }
          else{
            //no categories
            echo "<h5 class='red'>Categories not found </h5>";

          }
          ?>
          

        </div>
      </div>
    </section>

    <!-- footer -->
    <?php include("partials-front/footer.php")?>