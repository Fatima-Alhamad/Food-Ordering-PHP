
  <?php include("partials-front/menu.php")?>
    <!-- Hero Search Section -->
    <section class="food-search text-center">
      <div class="container">
        <form action="<?php echo SITEURL."food-search.php"?>" method="POST">
          <input
            type="search"
            name="search"
            placeholder="Search for your favorite dish..."
            required
          />
          <button type="submit" class="btn btn-primary">Search</button>
        </form>
      </div>
    </section>

    <!-- Categories Section -->
    <section class="categories">
      <div class="container">
        <?php
        if(isset($_SESSION['order'])){
          echo $_SESSION['order'];
          unset($_SESSION['order']);
        }
        ?>
        <br>
        <h2>Popular Categories</h2>

        <div class="categories-grid">
          <?php
          //get featured categories
          $sql_category="SELECT * FROM tbl_category WHERE featured='yes' AND active='yes' ";
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
                  <h3 class="text-white"><?php echo $title;?></h3>
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

    <!-- Food Menu Section -->
    <section class="food-menu">
      <div class="container">
        <h2>Featured Menu</h2>

        <div class="food-menu-grid">
          <?php 
          //get featured foods
          $sql_food="SELECT * FROM tbl_food WHERE featured='yes' AND active='yes'";
          $res=mysqli_query($conn,$sql_food);
          if($res){
            $count=mysqli_num_rows($res);
            if($count>1){
              while($row=mysqli_fetch_assoc($res)){
                $food_id=$row['id'];
                $title=$row['title'];
                $image_name=$row['image_name'];
                $price=$row['price'];
                $description=$row['description'];
                ?>
                 <div class="food-menu-box">
                    <div class="food-menu-img">
                      <img
                        src="<?php echo SITEURL."images/food/".$image_name;?>"
                        alt="<?php echo $title;?>"
                        class="img-responsive img-curve"
                      />
                    </div>
                    <div class="food-menu-desc">
                      <h4><?php echo $title;?></h4>
                      <p class="food-price">$<?php echo $price;?></p>
                      <p class="food-detail">
                      <?php echo $description;?>
                      </p>
                      <a href="<?php echo SITEURL."order.php?id=".$food_id?>" class="btn btn-primary">Order Now</a>
                    </div>
                  </div>
                <?php
              }
            }
            else{
              //no food found
              echo "<h5 class='red'>No Featured Food</h5>";
            }
          }
          ?>
         
          
          

        <div class="text-center">
          <a href="<?php echo SITEURL."foods.php"?>" class="btn btn-primary">View Full Menu</a>
        </div>
      </div>
    </section>

    <!-- footer -->
    <?php include("partials-front/footer.php")?>