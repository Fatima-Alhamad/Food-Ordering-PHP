<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Food Menu - Restaurant Website</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
      }

      :root {
        --primary-color: #ff6b81;
        --primary-dark: #ff4757;
        --secondary-color: #2f3542;
        --bg-light: #f8f9fa;
        --text-dark: #2d3436;
        --text-light: #636e72;
        --white: #ffffff;
        --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
      }

      .container {
        width: 90%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 1rem;
      }

      .navbar {
        background: var(--white);
        box-shadow: var(--shadow);
        position: fixed;
        width: 100%;
        z-index: 1000;
        top: 0;
      }

      .navbar .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .logo {
        width: 120px;
      }

      .menu ul {
        display: flex;
        gap: 2rem;
        list-style: none;
      }

      .menu ul li a {
        color: var(--text-dark);
        text-decoration: none;
        font-weight: 500;
        transition: var(--transition);
        padding: 0.5rem 1rem;
        border-radius: 4px;
      }

      .menu ul li a:hover {
        color: var(--primary-color);
        background: rgba(255, 107, 129, 0.1);
      }

      .food-search-foods {
        background-image: linear-gradient(
            rgba(0, 0, 0, 0.6),
            rgba(0, 0, 0, 0.6)
          ),
          url("https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1920");
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding: 8rem 0;
        margin-top: 60px;
      }

      .food-search-foods form {
        display: flex;
        justify-content: center;
        gap: 1rem;
        max-width: 600px;
        margin: 0 auto;
      }

      .food-search-foods input[type="search"] {
        width: 70%;
        padding: 1rem;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        box-shadow: var(--shadow);
      }

      .btn {
        padding: 1rem 2rem;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
      }

      .btn-primary {
        background: var(--primary-color);
        color: var(--white);
      }

      .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
      }

      .food-menu {
        padding: 5rem 0;
        background: var(--bg-light);
      }

      .text-center {
        text-align: center;
      }

      h2 {
        color: var(--text-dark);
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 2rem;
      }

      .food-menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
      }

      .food-menu-box {
        background: var(--white);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
      }

      .food-menu-box:hover {
        transform: translateY(-5px);
      }

      .food-menu-img {
        width: 100%;
        height: 200px;
        overflow: hidden;
      }

      .food-menu-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
      }

      .food-menu-box:hover .food-menu-img img {
        transform: scale(1.1);
      }

      .food-menu-desc {
        padding: 1.5rem;
      }

      .food-menu-desc h4 {
        font-size: 1.2rem;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
      }

      .food-price {
        color: var(--primary-color);
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
      }

      .food-detail {
        color: var(--text-light);
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 1rem;
      }

      @media only screen and (max-width: 768px) {
        .navbar .container {
          flex-direction: column;
          padding: 1rem;
        }

        .menu ul {
          flex-direction: column;
          text-align: center;
          gap: 0.5rem;
        }

        .food-search-foods {
          margin-top: 120px;
          padding: 4rem 0;
        }

        .food-search-foods form {
          flex-direction: column;
          padding: 0 1rem;
        }

        .food-search-foods input[type="search"] {
          width: 100%;
        }

        .btn {
          width: 100%;
        }
      }
    </style>
  </head>
  <body>
   <!-- menu -->
   <?php include("partials-front/menu.php")?>

    <section class="food-search-foods ">
      <div class="container">
        <form action="<?php echo SITEURL."food-search.php"?>" method="POST">
          <input
            type="search"
            name="search"
            placeholder="Search for Food..."
            required
          />
          <button type="submit" class="btn btn-primary">Search</button>
        </form>
      </div>
    </section>

    <section class="food-menu">
      <div class="container">
        <h2 class="text-center">Our Menu</h2>
        <div class="food-menu-grid">
        <?php 
          //get featured foods
          $sql_food="SELECT * FROM tbl_food WHERE active='yes'";
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
         

        </div>
      </div>
    </section>
    <!-- footer -->
    <?php include("partials-front/footer.php")?>
  </body>
</html>
