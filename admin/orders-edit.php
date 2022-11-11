<?php include("common/header.php")?>
<?php include("common/sidebar.php")?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <?php include("common/navbar.php")?>
<?php
if(isset($_GET['src'])){
  $src = $_GET['src'];
  $id = $_GET['id'];
}
$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT Orders.*, admin_info.* FROM orders INNER JOIN admin_info ON Orders.user_id=admin_info.id WHERE status='Pending'"));

if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $address = $_POST['address'];

  $pmn_method = $_POST['pmn_method'];
  $pmn_number = $_POST['pmn_number'];
  $trans_id = $_POST['trans_id'];
  $years = $_POST['years'];
  $status = $_POST['status'];
  $time = time();

  $user_update = mysqli_query($conn,"UPDATE admin_info SET name='$name', email='$email', address='$address',permision='$status', time='$time' WHERE id=$id");
  $order_update = mysqli_query($conn,"UPDATE orders SET pmn_method='$pmn_method', pmn_number='$pmn_number', trans_id='$trans_id', years='$years',  status='$status', time='$time' WHERE user_id=$id");

  if($user_update && $order_update){
    $msg = "Successfully Updated!";
    header("location:orders-edit.php?src=$src&&id=$id&&msg=$msg");
  }else{
    echo "something wrong!";
  }
}
$user_data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM admin_info WHERE id=$id"));
$order_data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM orders WHERE user_id=$id"));
?>
  <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3"><?php echo $order_data['status']?> Orders</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-4">

                <div class="order-view">
                  <div class="edit">
                      <form action="" method="POST">
                        <div class="profile">
                          <div>
                              <div>
                                <label for="name">Name</label>
                                <input name="name" type="text" value="<?php echo $user_data['name']?>">
                              </div>
                              <div>
                                <label for="email">Email</label>
                                <input name="email" type="text" value="<?php echo $user_data['email']?>">
                              </div>
                              <div>
                                <label for="address">Address</label>
                                <input name="address" type="text" value="<?php echo $user_data['address']?>">
                              </div>
                          </div>
                          <div>
                              <div>
                                <label for="pmn_method">Payment Method</label>
                                <input name="pmn_method" type="text" value="<?php echo $order_data['pmn_method']?>">
                              </div>
                              <div>
                                <label for="pmn_number">Payment Number</label>
                                <input name="pmn_number" type="text" value="<?php echo $order_data['pmn_number']?>">
                              </div>
                              <div>
                                <label for="trans_id">Transection ID</label>
                                <input name="trans_id" type="text" value="<?php echo $order_data['trans_id']?>">
                              </div>
                          </div>
                          <div>
                            <select name="years" id="">
                              <option style="visibility :hidden" selected value="<?php echo $order_data['years']?>"><?php echo $data['years']?> Years</option>
                              <option value="1">1 Years</option>
                              <option value="2">2 Years</option>
                              <option value="3">3 Years</option>
                              <option value="4">5 Years</option>
                              <option value="4">6 Years</option>
                              <option value="4">7 Years</option>
                              <option value="4">8 Years</option>
                              <option value="4">9 Years</option>
                              <option value="4">10 Years</option>
                              <option value="100">Lifetime</option>
                            </select>
                          </div>
                          <div>
                            <select name="status">
                              <?php
                                if($src=='pending-orders'){ ?>
                              <option selected value="Pending">Pending</option>
                              <option value="Success">Success</option>
                            <?php    }else{ ?>
                              <option value="Pending">Pending</option>
                              <option selected value="Success">Success</option>
                              <?php }?>
                            </select>
                          </div>
                          <div>                            
                            <input name="submit" class="submit_btn" type="submit" value="Save">
                          </div>
                        </div>
                      </form>
                      </div>
                      <div class="view">
                        <div class="view-content">
                          <h3><?php echo strtoupper($user_data['name']);?></h3>
                          <h6><?php echo $user_data['email']?></h6>
                          <h6><?php echo $user_data['address']?></h6>
                          <p>Time: <b><?php echo $order_data['years']?> years</b></p>
                          <p>Payment Method: <b><?php echo $order_data['pmn_method']?></b></p>
                          <p>Payment Number: <b><?php echo $order_data['pmn_number']?></b></p>
                          <p>Transection ID: <b><?php echo $order_data['trans_id']?></b></p>
                          <p>Amount: <b><?php echo $order_data['amount']?>৳</b></p>
                          <?php
                          if($order_data['status']=='Pending'){ ?>
                          <p>Status: <b style="color:red"><?php echo $order_data['status']?></b></p>
                        <?php }else{?>
                          <p>Status: <b style="color:green"><?php echo $order_data['status']?></b></p>
                          <?php }?>
                        </div>
                        <div class="view-img">
                          <img src="../upload/avatar.jpg">
                        </div>
                      </div>
                </div>


            </div>
          </div>
        </div>
      </div>
    </div>
  </main>  
  <?php include("common/setting.php")?>
  <?php include("common/footer.php")?>