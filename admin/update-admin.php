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
    <!-- menu -->
    <?php
    include("partials/menu.php");
    ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>
            <br>
            <br>
            <?php
            //get id
            $id=$_GET['id'];
            //create sql query to get admin
            $sql_getAdmins="SELECT * FROM tbl_admin WHERE id=$id";
            // execute the query 
            $res=mysqli_query($conn,$sql_getAdmins);
            if($res){
                $count=mysqli_num_rows($res);
                if($count==1){
                    while($rows=mysqli_fetch_assoc($res)){
                        $full_name=$rows['full_name'];
                        $username=$rows['username'];
                    }
                }
                else{
                    //redirect to manage page 
                    header("location:".SITEURL."admin/manage-admin.php");
                }
            }
            ?>
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name</td>
                        <td><input type="text" name="full_name" value="<?php echo $full_name;?>" class="input-responsive"></td>
                    </tr>
                    <tr>
                        <td>User Name</td>
                        <td><input type="text" name="username" value="<?php echo $username;?>" class="input-responsive"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="submit" value="Update Admin" class="btn-secondary input-responsive"></td>
                    </tr>
                </table>

            </form>
        </div>
        <?php
        if(isset($_POST['submit'])){
            //get values from form
            
            $new_full_name=$_POST['full_name'];
            $new_user_name=$_POST['username'];
            //create query
            $sql_update="UPDATE tbl_admin SET 
            full_name='$new_full_name',
            username='$new_user_name' WHERE id='$id'";

            //execute the query
            $res=mysqli_query($conn,$sql_update);
            if($res){
                $_SESSION['update']="<h5 class='green'>Admin Updated Successfully</h5>";
                header("location:".SITEURL."admin/manage-admin.php");
            }
            else{
                $_SESSION['update']="<h5 class='red'>Admin Updated Failed</h5>";
                header("location:".SITEURL."manage-admin.php");
            }

        }
        ?>
    </div>


 <!-- footer -->
 <?php
    include("partials/footer.php");
    ?>
</body>
</html>