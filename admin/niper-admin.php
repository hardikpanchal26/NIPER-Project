<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_top.php'; ?>

<div class="leftContent">
<?php
  if(!isset($_SESSION ['admin_logged_in']) ) :?>

    <?php
      if ( isset( $_SESSION['invalid'] ) ) 
        echo '<div align="center"><div class="alert alert-danger pr-5 pl-5" style="width: 400px;" align="center">Invalid Username or Password</div></div>'; 
      unset($_SESSION['invalid']);  
    ?>
      
    <div class="row justify-content-center pb-3" >

        <div class="pr-5 pl-5" style="border:2px solid #f2f2f2; width: 400px; background: #f2f2f2">
        <form method="POST" action = "../database/admin_data.php">

         <h3 align="center" class="mb-4 mt-4">NIPER Admin Login</h3>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" ><i class="fa fa-user"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="Username" name="username">
        </div>

        <div class="input-group mb-4">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-keyboard-o"></i></span>
          </div>
          <input type="password" class="form-control" placeholder="Password" name="password">
        </div>

        <div class="input-group mb-4 pb-2">
          <input type="submit" name="admin_login" class="form-control btn btn-primary" value="Login" />
        </div>
        </form>
        </div>
    </div>
<?php endif; ?>
</div>

    

<?php
  
  if( isset($_SESSION ['admin_logged_in']) ) {
    echo "<script type='text/javascript'> document.location = 'admin_dashboard.php'; </script>";
  }
?>  


<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_bottom.php'; ?>