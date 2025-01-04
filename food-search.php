<?php include("config/constants.php");?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Food Search Results</title>
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

      .food-search {
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
        text-align: center;
        color: var(--white);
      }

      .food-search h2 {
        color: var(--white);
        font-size: 2.5rem;
        margin-bottom: 2rem;
      }

      .food-search form {
        display: flex;
        justify-content: center;
        gap: 1rem;
        max-width: 600px;
        margin: 0 auto;
      }

      .food-search input[type="search"] {
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

      .food-search .search-results {
        margin-top: 3rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        padding: 0 1rem;
      }

      .food-item {
        background: var(--white);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
      }

      .food-item:hover {
        transform: translateY(-5px);
      }

      .food-img {
        width: 100%;
        height: 200px;
        overflow: hidden;
      }

      .food-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .food-content {
        padding: 1.5rem;
      }

      .food-content h3 {
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        font-size: 1.4rem;
      }

      .food-price {
        color: var(--primary-color);
        font-weight: 600;
        font-size: 1.2rem;
        margin-bottom: 1rem;
      }

      @media only screen and (max-width: 768px) {
        .food-search {
          margin-top: 120px;
          padding: 4rem 0;
        }

        .food-search form {
          flex-direction: column;
          padding: 0 1rem;
        }

        .food-search input[type="search"] {
          width: 100%;
        }

        .btn {
          width: 100%;
        }

        .food-search h2 {
          font-size: 1.8rem;
        }
      }
    </style>
  </head>
  <body>
    <section class="food-search">
      <div class="container">
        <h2>Search Results for "<span><?php echo $_POST['search'];?></span>"</h2>

        <div class="search-results">
        <?php
        $search=$_POST['search'];
        mysqli_real_escape_string($conn,$search);//to prevent sql injection
        //sql query to get food based on search keyword
        $sql="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";//find food %% match anywhere in the title or description
        $res=mysqli_query($conn,$sql);
        if($res){
          $count=mysqli_num_rows($res);
          if($count>=1){
            while($row=mysqli_fetch_assoc($res)){
                $food_id=$row['id'];
                $title=$row['title'];
                $price=$row['price'];
                $description=$row['description'];
                $image_name=$row['image_name'];
                ?>
                 <div class="food-item">
            <div class="food-img">
              <img
                src="<?php echo SITEURL."images/food/".$image_name?>"
                alt="Steamed Momos"
              />
            </div>
            <div class="food-content">
              <h3><?php echo $title;?></h3>
              <p class="food-price">$<?php echo $price;?></p>
              <p style="color:black;">
              <?php echo $description;?>
              </p><br>
              <a href="<?php echo SITEURL."order.php?id=".$food_id?>" class="btn btn-primary">Order Now</a>
            </div>
          </div>
                <?php
            }
          }
          else{
            echo "<h1 class='red'>Food not found</h1>";
          }
        
        }
        ?>
        </div>
      </div>
    </section>
  </body>
</html>
