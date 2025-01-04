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
        <?php include('partials/menu.php')?>

        <!-- main content -->
         <div class="main-content">
            <div class="wrapper">
                <h1>Change Password</h1>
                <br><br>
                <?php
                $id=$_GET['id'];
                ?>
                <form action="" method="POST">
                    <table class="tbl-30">
                        <tr>
                            <td>
                                Current Password: 
                            </td>
                            <td>
                                <input type="password" name="current_password" class="input-responsive" placeholder="type pass here" >
                            </td>
                        </tr>
                        <tr>
                            <td>
                                New Password: 
                            </td>
                            <td>
                                <input type="password" name="new_password" class="input-responsive" placeholder="type pass here" >
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Confirm Password: 
                            </td>
                            <td>
                                <input type="password" name="confirm_password" class="input-responsive" placeholder="type pass here" >
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="submit" value="Change Password" class="btn-secondary input-responsive">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
         </div>
         <!-- footer -->
            <?php
                include("partials/footer.php");
                ?>
        <?php
        if(isset($_POST['submit'])){
            echo "Form Submited";
            //get data from form
            $current_password=md5($_POST['current_password']);
            $new_password=md5($_POST['new_password']);
            $confirm_password=md5($_POST['confirm_password']);

            //check id the admin with id and pass exist 
            $sql_select="SELECT * FROM tbl_admin WHERE password='$current_password' AND id=$id";
            $res=mysqli_query($conn,$sql_select);
            if($res){
                $count=mysqli_num_rows($res);
                if($count==1){
                    //check whether new and confirm match
                    if($new_password==$confirm_password){
                        $sql_update_pass="UPDATE tbl_admin SET password='$new_password' WHERE id=$id ";
                        $res_update=mysqli_query($conn,$sql_update_pass);
                        if($res){
                            $_SESSION['password-update']="<h5 class='green'>password Updated</h5>";
                            header("location:".SITEURL."admin/manage-admin.php"); 
                        }
                    }else{
                        $_SESSION['pass-not-match']="<h5 class='red'>password not match</h5>";
                        header("location:".SITEURL."admin/manage-admin.php"); 
                    }

                }
                else{//user does not exist  
                    $_SESSION['user-not-found']="<h5 class='red'>user not found</h5>";
                    header("location:".SITEURL."admin/manage-admin.php");
                }
            }
           
        }
        ?>

</body>
</html>