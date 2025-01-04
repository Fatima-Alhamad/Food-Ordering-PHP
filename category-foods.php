<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Restaurant Website</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
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

      .text-center {
        text-align: center;
      }
      .text-right {
        text-align: right;
      }
      .img-responsive {
        width: 100%;
        height: auto;
      }
      .img-curve {
        border-radius: 15px;
      }
      .clearfix {
        clear: both;
      }

      /* Navbar */
      .navbar {
        background: var(--white);
        box-shadow: var(--shadow);
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
      }

      .navbar .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .logo img {
        height: 50px;
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

      /* Food Search */
      .food-search {
        background-image: linear-gradient(
            rgba(0, 0, 0, 0.6),
            rgba(0, 0, 0, 0.6)
          ),
          url("https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1920");
        background-size: cover;
        background-position: center;
        padding: 8rem 0;
        margin-top: 60px;
        text-align: center;
        color: var(--white);
      }

      .food-search h2 {
        color: var(--white);
        font-size: 2.5rem;
        margin-bottom: 2rem;
      }

      .text-white {
        color: var(--white);
      }

      /* Food Menu */
      .food-menu {
        padding: 5rem 0;
        background: var(--bg-light);
      }

      .food-menu h2 {
        color: var(--text-dark);
        font-size: 2.5rem;
        margin-bottom: 3rem;
      }

      .food-menu-box {
        background: var(--white);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--shadow);
        margin-bottom: 2rem;
        display: flex;
        transition: var(--transition);
      }

      .food-menu-box:hover {
        transform: translateY(-5px);
      }

      .food-menu-img {
        width: 30%;
        overflow: hidden;
      }

      .food-menu-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .food-menu-desc {
        width: 70%;
        padding: 1.5rem;
      }

      .food-menu-desc h4 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        color: var(--text-dark);
      }

      .food-price {
        color: var(--primary-color);
        font-size: 1.3rem;
        font-weight: bold;
        margin-bottom: 1rem;
      }

      .food-detail {
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 1.5rem;
      }

      .btn {
        padding: 0.8rem 1.5rem;
        border-radius: 5px;
        text-decoration: none;
        transition: var(--transition);
        display: inline-block;
      }

      .btn-primary {
        background: var(--primary-color);
        color: var(--white);
      }

      .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
      }

      /* Social */
      .social {
        padding: 3rem 0;
        background: var(--white);
      }

      .social ul {
        display: flex;
        justify-content: center;
        gap: 2rem;
        list-style: none;
      }

      .social ul li a {
        transition: var(--transition);
        display: block;
      }

      .social ul li a:hover {
        transform: translateY(-5px);
      }

      /* Footer */
      .footer {
        background: var(--secondary-color);
        color: var(--white);
        padding: 2rem 0;
      }

      .footer a {
        color: var(--primary-color);
        text-decoration: none;
      }

      @media (max-width: 768px) {
        .navbar .container {
          flex-direction: column;
          padding: 1rem;
        }

        .menu ul {
          flex-direction: column;
          text-align: center;
          gap: 0.5rem;
          margin-top: 1rem;
        }

        .food-menu-box {
          flex-direction: column;
        }

        .food-menu-img {
          width: 100%;
          height: 200px;
        }

        .food-menu-desc {
          width: 100%;
        }

        .food-search {
          margin-top: 120px;
        }
      }
    </style>
  </head>
  <body>
    <!-- menu -->
    <?php include("partials-front/menu.php")?>

    <!-- Food Search Section -->
    <section class="food-search text-center">
      <div class="container">
      <?php
        $id=$_GET['id'];
        //get category title
        $sql_get_cat="SELECT title FROM tbl_category WHERE id=$id";
        $res=mysqli_query($conn,$sql_get_cat);
        $row=mysqli_fetch_assoc($res);
        $cat_title=$row['title'];
        ?>
        <h2>Foods in <a href="#" class="text-white">"<?php echo $cat_title;?>"</a></h2>
      </div>
    </section>

    <!-- Food Menu Section -->
    <section class="food-menu">
      <div class="container">
        <h2 class="text-center">Food Menu</h2>
      <?php
        //create query 
        $sql="SELECT * FROM tbl_food WHERE category_id=$id";
        $res=mysqli_query($conn,$sql);
        if($res){
          $count =mysqli_num_rows($res);
          if($count>0){
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
                        src="<?php echo SITEURL."images/food/".$image_name?>"
                        alt="Pizza"
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
          }else{
            echo "<h1 class='red'>No food in this category</h1>";
          }
        }
      ?>
      </div>
    </section>

   <!-- footer -->
   <?php include("partials-front/footer.php")?>
  