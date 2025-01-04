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
        <h1>Manage Order</h1>
         <br>
         <br>
         <?php 
         if(isset($_SESSION['update-order'])){
            echo $_SESSION['update-order'].'<br>';
            unset($_SESSION['update-order']);
         }
         ?>
        <table class="tbl-full" >
            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Customer Contact</th>
                <th>Customer Email</th>
                <th>Customer Address</th>
                <th>Actions</th>
            </tr>
                <?php
                $sql_get="SELECT * FROM tbl_order ORDER BY id DESC";//display latest order first
                $res=mysqli_query($conn,$sql_get);
                if($res){
                    $count=mysqli_num_rows($res);
                    if($count>0){
                        while($row=mysqli_fetch_assoc($res)){
                            $id=$row['id'];
                            $qty=$row['qty'];
                            $food=$row['food'];
                            $price=$row['price'];
                            $total=$row['total'];
                            $order_date=$row['order_date'];
                            $status=$row['status'];//ordered /on delivery /canceled
                            $customer_name=$row['customer_name'];
                            $customer_contact=$row['customer_contact'];
                            $customer_email=$row['customer_email'];
                            $customer_address=$row['customer_address'];
                            ?>
                             <tr>
                                <td><?php echo $id;?></td>
                                <td><?php echo $food;?></td>
                                <td><?php echo $price;?></td>
                                <td><?php echo $qty;?></td>
                                <td><?php echo $total;?></td>
                                <td><?php echo $order_date;?></td>
                                <td><?php 
                                if($status=="ordered"){
                                    echo "<label style='color:blue'>$status</label>";
                                }else{
                                    if($status=="on delivery"){
                                        echo "<label  style='color:orange'>$status</label>";
                                    }else{
                                        if($status=="delivered"){
                                            echo "<label class='green'>$status</label>";
                                        }
                                        else{
                                            if($status=="cancelled"){
                                                echo "<label class='red'>$status</label>";
                                            }
                                        
                                        }
                                    }
                                }
                                ?></td>
                                <td><?php echo $customer_name;?></td>
                                <td><?php echo $customer_contact;?></td>
                                <td><?php echo $customer_email;?></td>
                                <td><?php echo $customer_address;?></td>
                                <td>
                                    <a class="btn-secondary" href="<?php echo SITEURL."admin/update-order.php?id=".$id;?>">Update</a> 
                                </td>
                            </tr>
                            <?php
                        }
                    }else{
                        echo "<tr><td><h5 class='red'>No orders available</h5></td></tr>";
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