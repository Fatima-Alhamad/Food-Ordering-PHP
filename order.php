 <!-- menu -->
 <?php include("partials-front/menu.php")?>
    <?php
    if(isset($_GET['id'])){
      $food_id=$_GET['id'];
      $sql_get="SELECT * FROM tbl_food WHERE id=$food_id";
      $res=mysqli_query($conn,$sql_get);
      if($res){
        $count=mysqli_num_rows($res);
        if($count==1){
          $row=mysqli_fetch_assoc($res);
          $title=$row['title'];
          $price=$row['price'];
          $image_name=$row['image_name'];

        }else{
          header("location:".SITEURL);
        }
      }

    }else{//id not set
      header("location:".SITEURL);
    }
    
    ?>
    <?php
    if(isset($_POST['submit'])){
      $qty=$_POST['qty'];
      $food=$title;
      $price=$price;
      $total=$price*$qty;
      $order_date=date("Y-m-d h:i:sa");
      $status="ordered";//ordered /on delivery /canceled
      $customer_name=$_POST['full_name'];
      $customer_contact=$_POST['contact'];
      $customer_email=$_POST['email'];
      $customer_address=$_POST['address'];

      //make query and save in db
      $sql_insert="INSERT INTO tbl_order SET 
      qty='$qty',
      food='$food',
      price=$price,
      total=$total,
      order_date='$order_date',
      status='$status',
      customer_name='$customer_name',
      customer_contact='$customer_contact',
      customer_email='$customer_email',
      customer_address='$customer_address'
      ";
      $res2=mysqli_query($conn,$sql_insert);
      if($res2){
        //order inserted successfully
        $_SESSION['order']="<h1 class='green'>Order Placed Successfully</h1>";
        header("location:".SITEURL);
      }else{
        $_SESSION['order']="<h1 class='red'>Order Placed Failed</h1>";
        header("location:".SITEURL);
      }
    }
    ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order Confirmation - Restaurant Website</title>
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
        max-width: 800px;
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
        max-width: 1200px;
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

      .food-search {
        background-image: linear-gradient(
            rgba(0, 0, 0, 0.7),
            rgba(0, 0, 0, 0.7)
          ),
          url("https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=1920");
        background-size: cover;
        background-position: center;
        padding: 8rem 0 4rem;
        margin-top: 60px;
        min-height: 100vh;
      }

      .text-center {
        text-align: center;
      }

      .text-white {
        color: var(--white);
      }

      h2 {
        font-size: 2rem;
        margin-bottom: 2rem;
      }

      .order {
        background: var(--white);
        padding: 2rem;
        border-radius: 15px;
        box-shadow: var(--shadow);
      }

      fieldset {
        border: 1px solid #ddd;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border-radius: 8px;
      }

      legend {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--primary-color);
        padding: 0 1rem;
      }

      .food-menu-img {
        width:150px;
        height: 150px;
        border-radius: 8px;
        
        margin: 0 auto 1rem;
      }

      .food-menu-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .food-menu-desc {
        text-align: center;
        margin-bottom: 1rem;
      }

      .food-menu-desc h3 {
        color: var(--text-dark);
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
      }

      .food-price {
        color: var(--primary-color);
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 1rem;
      }

      .order-label {
        font-weight: 500;
        color: var(--text-dark);
        margin: 1rem 0 0.5rem;
      }

      .input-responsive {
        width: 100%;
        padding: 1rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        margin-bottom: 0.5rem;
        transition: var(--transition);
      }

      .input-responsive:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(255, 107, 129, 0.1);
      }

      textarea.input-responsive {
        resize: vertical;
        min-height: 100px;
      }

      .btn {
        padding: 1rem 2rem;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        width: 100%;
        margin-top: 1rem;
      }

      .btn-primary {
        background: var(--primary-color);
        color: var(--white);
      }

      .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
      }

      .social {
        padding: 3rem 0;
        background: var(--bg-light);
      }

      .social ul {
        display: flex;
        justify-content: center;
        gap: 2rem;
        list-style: none;
      }

      .social ul li a {
        display: block;
        transition: var(--transition);
      }

      .social ul li a:hover {
        transform: translateY(-5px);
      }

      .footer {
        background: var(--secondary-color);
        color: var(--white);
        padding: 2rem 0;
        text-align: center;
      }

      .footer a {
        color: var(--primary-color);
        text-decoration: none;
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

        .food-search {
          margin-top: 120px;
          padding: 4rem 0;
        }

        .food-menu-img {
          width: 120px;
          height: 120px;
        }

        fieldset {
          padding: 1rem;
        }
      }
    </style>
  </head>
  <body>
   

   

    <section class="food-search">
      <div class="container">
        <h2 class="text-center text-white">Complete Your Order</h2>

        <form action="" method="POST" class="order">
          <fieldset>
            <legend>Selected Food</legend>
            <div class="food-menu-img">
              <img
                src="<?php echo SITEURL."images/food/".$image_name;?>"
                alt="Pizza"
              />
            </div>
            <div class="food-menu-desc">
              <h3><?php echo $title;?></h3>
              <p class="food-price">$<?php echo $price;?></p>
              <div class="order-label">Quantity</div>
              <input
                type="number"
                name="qty"
                class="input-responsive"
                value="1"
                min="1"
                required
              />
            </div>
          </fieldset>

          <fieldset>
            <legend>Delivery Details</legend>
            <div class="order-label">Full Name</div>
            <input
              type="text"
              name="full_name"
              placeholder="Enter your full name"
              class="input-responsive"
              required
            />

            <div class="order-label">Phone Number</div>
            <input
              type="tel"
              name="contact"
              placeholder="Enter your phone number"
              class="input-responsive"
              required
            />

            <div class="order-label">Email</div>
            <input
              type="email"
              name="email"
              placeholder="Enter your email"
              class="input-responsive"
              required
            />

            <div class="order-label">Delivery Address</div>
            <textarea
              name="address"
              placeholder="Enter your full delivery address"
              class="input-responsive"
              required
            ></textarea>

            <button type="submit"  name ="submit" class="btn btn-primary">Confirm Order</button>
          </fieldset>
        </form>
      </div>
    </section>
    <!-- footer -->
    <?php include("partials-front/footer.php")?>
    