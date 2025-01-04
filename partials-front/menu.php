<?php include("config/constants.php")?>
<!DOCTYPE php>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gourmet Delights | Restaurant</title>

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
      rel="stylesheet"
    />

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css" />
  </head>

  <body>
    <!-- Navbar Section -->
    <section class="navbar">
      <div class="container">
        <div class="logo">
          <a href="<?php echo SITEURL;?>" title="Logo">
            <img
              src="images/logo.png"
              alt="Restaurant Logo"
              class="img-responsive"
            />
          </a>
        </div>

        <div class="menu">
          <ul>
            <li><a href="<?php echo SITEURL;?>">Home</a></li>
            <li><a href="<?php echo SITEURL.'categories.php';?>">Categories</a></li>
            <li><a href="<?php echo SITEURL.'foods.php';?>">Foods</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div>
      </div>
    </section>