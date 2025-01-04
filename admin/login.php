<?php
include("../config/constants.php");
?>
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
    <title>Login | Food Order</title>
</head>
<body>
   <div class="login main-content">
    <h1 class="text-center">Login</h1><br>
    <!-- login form -->
     <form action="" method="POST">
      UserName: 
      <input type="text" name="username" placeholder="enter user" class="input-responsive-login"><br>
      Password :
      <input type="password" name="password" id="" placeholder="enter pass" class="input-responsive-login"><br><br>
      <input type="submit" value="login" class="btn-danger input-responsive-login btn-login" name="submit">
      <?php
      if(isset($_SESSION['login'])){
        echo $_SESSION['login'];
        unset($_SESSION['login']);
      }
      ?>
      <?php
      if(isset($_SESSION['not-loggedin-message'])){
        echo $_SESSION['not-loggedin-message'];
        unset($_SESSION['not-loggedin-message']);
      }
      ?>
     </form>
     <!-- form end -->
    <p  class="text-center">Designed By - <a href="#" class="designer-name">Fatima</a></p>
   </div> 
</body>
</html>
<?php
if(isset($_POST['submit'])){
  //get data from form
  $username=$_POST['username'];
  mysqli_real_escape_string($conn,$username);//to prevent sql injection
  $password=md5($_POST['password']);
  mysqli_real_escape_string($conn,$password);//to prevent sql injection
  //check if such user exist
  $sql_get_Admin="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
  $res=mysqli_query($conn,$sql_get_Admin);
  if($res){
    $count=mysqli_num_rows($res);
    if($count==1){
      
    $_SESSION['login']="<h5 class='green'> login successfully</h5>";
    $_SESSION['user']=$username;//access control authorization
      header("location:".SITEURL."admin/");
    }else{
      $_SESSION['login']="<h5 class='red'> wrong email or password</h5>";
      header("location:".SITEURL."admin/login.php");
    }
  }
}
?>