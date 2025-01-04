<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css" />
      <!-- Google Fonts -->
      <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
      rel="stylesheet"
    />
    <title>food Order Website - Home Page</title>
    
</head>
<body>
  
    <!-- menu -->
     <?php include('partials/menu.php')?>
    <!-- main section starts -->
    <div class="main-content">
        <div class="wrapper ">
        <h1>Dashboard</h1>
      <div class="flex">
      <div class="col-4 text-center">
         <?php
         //query
         $sql_categories="SELECT * FROM tbl_category";
         $res=mysqli_query($conn,$sql_categories);
         $count_cat=mysqli_num_rows($res);
         ?>
           <h1><?php echo $count_cat;?></h1>
           Categories 
        </div>
        <div class="col-4 text-center">
        <?php
         //query
         $sql_food="SELECT * FROM tbl_food";
         $res2=mysqli_query($conn,$sql_food);
         $count_food=mysqli_num_rows($res2);
         ?>
           <h1><?php echo $count_food;?></h1>
           Foods 
        </div>
        <div class="col-4 text-center">
        <?php
         //query
         $sql_order="SELECT * FROM tbl_order";
         $res3=mysqli_query($conn,$sql_order);
         $count_order=mysqli_num_rows($res3);
         ?>
           <h1><?php echo $count_order;?></h1>
           Total Orders 
        </div>
        <div class="col-4 text-center">
         <?php
            $sql="SELECT SUM(total) AS total FROM tbl_order WHERE status='delivered'";
            $res4=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($res4);
            $total=$row['total'];
         ?>
           <h1>$<?php if(!$total) echo 0;echo $total;?></h1>
           Revenue Generated
        </div>
        </div>
      </div>
     </div>
    <!-- main section ends -->

<!-- footer -->
<?php
 include('partials/footer.php');
 ?>
</body>
</html>