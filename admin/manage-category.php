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
        <h1>Manage Category</h1>
        <br>
        <?php
       if(isset($_SESSION['add-category'])){
        echo $_SESSION['add-category'];
        unset($_SESSION['add-category']);
       }
       ?>
        <?php
       if(isset($_SESSION['delete-category'])){
        echo $_SESSION['delete-category'];
        unset($_SESSION['delete-category']);
       }
       ?>
        <?php
       if(isset($_SESSION['update-category'])){
        echo $_SESSION['update-category'];
        unset($_SESSION['update-category']);
       }
       ?>
       <br>
       <br>
         
         <a class="btn-primary" href="<?php echo SITEURL."admin/add-category.php" ?>">Add Category</a>
         <br>
         <br>
        <table class="tbl-full" >
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>Image name</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql_select="SELECT * FROM tbl_category";
            $res=mysqli_query($conn,$sql_select);
            if($res){
                $count=mysqli_num_rows($res);
                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        $featured=$row['featured'];
                        $active=$row['active'];

                        ?>
                         <tr>
                            <td><?php echo $id;?></td>
                            <td><?php echo $title;?></td>
                            <td><?php 
                            if(!$image_name==""){
                                ?>
                                <img width="95px" src="<?php echo SITEURL."images/category/".$image_name?>" alt="" srcset="">
                                <?php
                            }
                            else{
                                echo "No image";
                            }
                            ?></td>
                            <td><?php echo $featured;?></td>
                            <td><?php echo $active;?></td>
                            <td>
                            <a class="btn-secondary" href="<?php echo SITEURL."admin/update-category.php?id=".$id;?>">Update Category</a> 
                            <a class="btn-danger" href="<?php echo SITEURL."admin/delete-category.php?id=".$id."&image_name=".$image_name;?>">Delete Category</a> 
                            </td>
            </tr>
                        <?php
                    }
                }
                else{
                    ?>
                    <tr>
                        <td>
                            <div class="red">NO Category Added</div>
                        </td>
                    </tr>
                    <?php
            
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