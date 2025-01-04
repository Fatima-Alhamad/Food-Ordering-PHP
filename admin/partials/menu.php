  <!-- menu section starts -->
  
  <?php
  //include he connection here to be applied in all pages
  include('../config/constants.php');
  include("login-check.php");
  ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
      <!-- Google Fonts -->
      <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../css/admin.css" />
  <title>Document</title>
 </head>
 <body>
 <div class="menu text-center">
        <div class="wrapper">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="manage-admin.php">Admin</a></li>
            <li><a href="manage-category.php">Category</a></li>
            <li><a href="manage-food.php">Food</a></li>
            <li><a href="manage-order.php">Order</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        </div>
        
     </div>
 </body>
 </html>
    <!-- menu section ends -->