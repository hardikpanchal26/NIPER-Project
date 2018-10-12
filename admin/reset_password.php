<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_top.php'; ?>

<div class="leftContent">
<?php
  if(isset($_SESSION ['admin_logged_in']) ) :?>

    <?php
      if ( isset( $_SESSION['invalid'] ) ) 
        echo '<div align="center"><div class="alert alert-danger pr-5 pl-5" style="width: 400px;" align="center">Invalid Username or Password</div></div>'; 
      unset($_SESSION['invalid']);  
    ?>
      
    <div class="row justify-content-center pb-3" >

        <div class="pr-5 pl-5" style="border:2px solid #f2f2f2; width: 400px; background: #f2f2f2">
        <form method="POST" action = "../database/admin_data.php">

         <h3 align="center" class="mb-4 mt-4">Reset Password</h3>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" ><i class="fa fa-keyboard-o"></i></span>
          </div>
          <input type="password" class="form-control" placeholder="Current Password" name="current_password">
        </div>

        <div class="input-group mb-4">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-keyboard-o"></i></span>
          </div>
          <input type="password" class="form-control" placeholder="Enter New Password" name="new_password_1">
        </div>

        <div class="input-group mb-4">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-keyboard-o"></i></span>
          </div>
          <input type="password" class="form-control" placeholder="Confirm New Password" name="new_password_2">
        </div>

        <div class="input-group mb-3">
          <input type="submit" name="admin_login" class="form-control btn btn-primary" value="Login" />
        </div>
        </form>
        </div>
    </div>
    <br>

<?php else :?>
  <h1>Access Denied</h1>
<?php endif; ?>

    

<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_bottom.php'; ?>