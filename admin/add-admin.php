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
            <h1>Add Admin</h1>
            <br>
            <?php
         if(isset($_SESSION['add'])){
            echo '<h5 class="red">'.$_SESSION['add'].'</h5>';
            unset($_SESSION['add']);//remove session message
         };
         ?>
         <br>
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name: </td>
                        <td><input class="input-responsive" type="text" name="full_name"placeholder="enter you full name" ></td>
                    </tr>
                    <tr>
                        <td>User Name: </td>
                        <td><input class="input-responsive" type="text"name="username" placeholder="enter you user name"></td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td><input  class="input-responsive"type="password" name="password" placeholder="enter you password"></td>
                    </tr>
                    <tr><td colspan="2"><input type="submit" name="submit" value="Add Admin" class="btn-secondary input-responsive" > </td></tr>
                </table>

            </form>
        </div>
      </div>

     <!-- footer -->
 <?php
 include('partials/footer.php');
 ?>
   
   <?php
//    process the value from the form and add to the db
// check wether the submit btn is clicked or no
if(isset($_POST['submit'])){
    //btn clicked
    //get the data from the form
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);//password encrypted with md5

    //sql to insert data into the database
    $sql_insert="INSERT INTO tbl_admin SET 
    full_name='$full_name',
    username='$username',
    password='$password' ";

    //execute the query
    $res=mysqli_query($conn,$sql_insert)or die(mysqli_error());
    //check whether the query is executed or not
    if($res){
        //create session var to display message
        $_SESSION['add']="Admin Added Successfully";
        // redirect the page 
        header("location:".SITEURL.'admin/manage-admin.php');
    }else{
          //create session var to display message
          $_SESSION['add']="Add Admin fail";
        // redirect the page  to add admin
        header("location:".SITEURL.'admin/add-admin.php');
    }


    


};


   ?>
</body>
</html>