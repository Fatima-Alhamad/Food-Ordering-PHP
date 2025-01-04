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
    <title>Document</title>
</head>
<body>
    <!-- menu -->
<?php include('partials/menu.php')?>
  
    <!-- main section starts -->
    <div class="main-content">
        <div class="wrapper ">
        <h1>Manage Food</h1>
        <br>
        <?php
        if(isset($_SESSION['add-food'])){
            echo $_SESSION['add-food'];
            unset($_SESSION['add-food']);
        }
        ?>
        <?php
        if(isset($_SESSION['delete-food'])){
            echo $_SESSION['delete-food'];
            unset($_SESSION['delete-food']);
        }
        ?>
         <?php
      if(isset($_SESSION['update-food'])){
          echo $_SESSION['update-food'];
          unset($_SESSION['update-food']);
      }
      ?>
        <br>
         <br>
         <a class="btn-primary" href="<?php echo SITEURL."admin/add-food.php"?>">Add Food</a>
         <br>
         <br>
        <table class="tbl-full" >
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>ِAction</th>
            </tr>
            <?php
            //create sql query
            $sql="SELECT * FROM tbl_food";
            $res=mysqli_query($conn,$sql);
            if($res){
               $count=mysqli_num_rows($res);
               if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $image_name=$row['image_name'];
                        $featured=$row['featured'];
                        $active=$row['active'];
                        ?>
                         <tr>
                            <td><?php echo $id;?></td>
                            <td><?php echo $title;?></td>
                            <td><?php echo $price;?></td>
                            <td><?php 
                            if(!$image_name==""){
                                ?>
                                <img width="95px" src="<?php echo SITEURL."images/food/".$image_name?>" alt="" srcset="">
                                <?php
                            }
                            else{
                                echo "No image";
                            }
                            ?></td>
                            <td><?php echo $featured;?></td>
                            <td><?php echo $active;?></td>
                            <td>
                            <a class="btn-secondary" href="<?php echo SITEURL."admin/update-food.php?id=".$id;?>">Update Food</a> 
                            <a class="btn-danger" href="<?php echo SITEURL."admin/delete-food.php?id=".$id."&image_name=".$image_name;?>">Delete Food</a> 
                            </td>
            </tr>
                        <?php
                    }
               }else{
                echo "<tr><td><h5 class='red'>Food Not Added</h5></td></tr>";
               }
            }
            ?>
        </table>

     
      </div>
     </div>
    <!-- main section ends -->

<!-- footer -->
<?php include('partials/footer.php')?>
</body>
</html>