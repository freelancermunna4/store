<!-- Header -->
<?php include("common/header.php");?>
<!-- Header -->
<?php
if(isset($_GET['msg'])){
  $msg = $_GET['msg'];
}

if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $pass = md5($_POST['pass']);
  $new_pass = md5($_POST['new_pass']);
  $confirm_pass = md5($_POST['confirm_pass']);

  $file_name = $_FILES['file']['name'];
  $file_tmp = $_FILES['file']['tmp_name'];
  move_uploaded_file($file_tmp,"upload/$file_name");


  if($new_pass===$confirm_pass){
  $sql = "UPDATE admin_info SET name='$name',email='$email',pass='$new_pass',file='$file_name' WHERE id='1'"; 
  $query = mysqli_query($conn,$sql);
  if($query){
    $msg = "Successfully Updated";
    header("location:admin-setting.php?msg=$msg");
  }else{
    $msg = "Somethings error! Please try again.";  
  }
}else{
  $msg = "Somethings error! Please try again.";
}
}
$admin_info = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM admin_info WHERE id=1"));
?>
    <!-- Main Content -->
    <main class="main_content">
<!-- Side Navbar Links -->
<?php include("common/sidebar.php");?>
<!-- Side Navbar Links -->

      <!-- Page Content -->
      <section class="content_wrapper">
        <!-- Page Details Title -->
        <div class="page_details">
          <div>
            <a href="index.php" class="go_home"><small>Home</small></a>
            <small>/</small>
            <small>Admin</small>
          </div>
        </div>

        <!-- Page Main Content -->
        <div class="add_page_main_content">
          <h1 class="add_page_title">ADMIN INFORMATIONS
              <?php if(isset($msg)){ ?><div class="alert_success"><?php echo $msg; ?></div><?php }?></h1>
          <form id="setting_form" action="" method="POST" enctype="multipart/form-data">
          <div>
              <label>Name</label>
              <input type="text" name="name" class="input" value="<?php echo $admin_info['name']; ?>" />
            </div>
          <div>
              <label>Email</label>
              <input type="text" name="email" class="input" value="<?php echo $admin_info['email']; ?>" />
            </div>
            <div>
              <label>Old Password</label>
              <input type="password" name="pass" class="input" />
            </div>
            <div>
              <label>New Password</label>
              <input type="password" name="new_pass" class="input" />
            </div>
            <div>
              <label>Confirm Password</label>
              <input type="password" name="confirm_pass" class="input"/>
            </div>
            <div>
              <label>Image</label>
              <input type="file" name="file" class="input"/>
            </div>
            <input name="submit" class="btn submit_btn" type="submit" value="Update" />
          </form>
        </div>
      </section>
      <!-- Page Content -->
    </main>
<!-- Side Navbar Links -->
<?php include("common/footer.php");?>
<!-- Side Navbar Links -->