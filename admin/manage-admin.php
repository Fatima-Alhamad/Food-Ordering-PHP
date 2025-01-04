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
    <title>food Order Website - admin Page</title>
    
</head>
<body>
 
       <!-- menu -->
       <?php include('partials/menu.php')?>
       <!-- here i will display all admins that were added to the database -->
    <!-- main section starts -->
    <div class="main-content">
        <div class="wrapper ">
        <h1 >Manage Admin</h1>
        <!-- add admin -->
         <br>
        
         <?php
         if(isset($_SESSION['add'])){
            echo '<h5 class="green">'.$_SESSION['add'].'</h5>';
            unset($_SESSION['add']);//remove session message
         };
         ?>
           <?php
         if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);//remove session message
         };
         ?>
         <?php
         if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
         }
         ?>
         <?php
         if(isset($_SESSION['user-not-found'])){
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
         }
         ?>
         <?php
         if(isset($_SESSION['pass-not-match'])){
            echo $_SESSION['pass-not-match'];
            unset($_SESSION['pass-not-match']);
         }
         ?>
         <?php
         if(isset($_SESSION['password-update'])){
            echo $_SESSION['password-update'];
            unset($_SESSION['password-update']);
         }
         ?>
           <br>
           <br>
         
         <a class="btn-primary" href="add-admin.php">Add Admin</a>
         <br>
         <br>
        <table class="tbl-full" >
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
           <?php
            $sql_select="SELECT * FROM tbl_admin";
            //execute the query
            $res=mysqli_query($conn,$sql_select);
            if($res){
                //count rows wether we have data in database or no
                $count=mysqli_num_rows($res);
                if($count>0){//we have data
                    while($rows=mysqli_fetch_assoc($res)){
                        //using while loop to get the data from database 
                        //will excute as long as we have data in the database
                        $id=$rows['id'];
                        $full_name=$rows['full_name'];
                        $username=$rows['username'];
                        ?>
                           <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL."admin/update-password.php?id=".$id?>" class="yellow">Change Password</a>
                                    <a class="btn-secondary" href="<?php echo SITEURL."admin/update-admin.php?id=".$id?>">Update Admin</a> 
                                    <a class="btn-danger" href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>">Delete Admin</a> 
                                    
                                </td>
                            </tr>
                        <?php
                        //display the values
                    }
                }
                else{

                }
            }
           ?>
            
        </table>

     
      </div>
     </div>
    <!-- main section ends -->

<!-- footer -->
 <?php
 include('partials/footer.php');
 ?>
   
</body>
</html>