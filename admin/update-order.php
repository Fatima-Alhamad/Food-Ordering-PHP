   <!-- menu -->
   <?php include('partials/menu.php')?>

   <div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br>
        <br>
        <?php 
        $id=$_GET['id'];
        //get data 
        $sql_get="SELECT food,qty,price,status,customer_name FROM tbl_order WHERE id=$id";
        $res=mysqli_query($conn,$sql_get);
        if($res){
            $count=mysqli_num_rows($res);
            if($count==1){
            $row=mysqli_fetch_assoc($res);
            $food=$row['food'];
            $qty=$row['qty'];
            $status=$row['status'];
            $customer_name=$row['customer_name'];
            $price=$row['price'];
            }else{
                $_SESSION['update-order']="<h5 class='red'>the order not found</h5>";
            }
        }
        ?>
        <?php
            if(isset($_POST['submit'])){
                $qty=$_POST['qty'];
                $total=$price*$qty;
                $status=$_POST['status'];
                //create query
                $sql_update="UPDATE tbl_order SET qty=$qty, total=$total,status='$status' WHERE id=$id";
                $res2=mysqli_query($conn,$sql_update);
                if($res2){
                    $_SESSION['update-order']="<h5 class='green'>Order updated Successfully</h5>";
                    header("location:".SITEURL."admin/manage-order.php");
                }

                }
            
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name: </td>
                    <td><h4><?php echo $food;?></h4></td>
                </tr>
                <tr>
                <tr>
                    <td>Customer Name: </td>
                    <td><h4><?php echo $customer_name;?></h4></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td><input type="number" name="qty"  value="<?php echo $qty;?>"id="" class="input-responsive-login"></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><select name="status"  value="<??>" id="" class="input-responsive-login">
                        <option <?php if($status=="ordered")echo "selected";?> value="ordered">ordered</option>
                        <option <?php if($status=="on delivery")echo "selected";?> value="on delivery">on delivery</option>
                        <option <?php if($status=="delivered")echo "selected";?>  value="delivered">delivered</option>
                        <option <?php if($status=="cancelled")echo "selected";?> value="cancelled">cancelled</option>
                    </select></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="update order" class="btn-secondary input-responsive-login" name="submit">
                    </td>
                </tr>
            </table>
        </form>
    </div>
   </div>

      <!-- footer -->
      <?php include('partials/footer.php')?>