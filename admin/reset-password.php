<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_top.php'; ?>

<div class="leftContent">
<?php
  if(isset($_SESSION ['admin_logged_in']) ) :?>

    <?php
      if ( isset( $_SESSION['reset_password'] ) )
      { if($_SESSION['reset_password'] == 'success') {
          echo '<div align="center"><div class="alert alert-success pr-5 pl-5" style="width: 400px;" align="center">Password successfully reset.</div></div>';
        }
        else {
          echo '<div align="center"><div class="alert alert-danger pr-5 pl-5" style="width: 400px;" align="center">Incorrect Password. Try again.</div></div>';
        } 

        unset($_SESSION['reset_password']);
      } 
           
    ?>
      
    <div class="row justify-content-center pb-3" >

        <div class="pr-5 pl-5" style="border:2px solid #f2f2f2; width: 400px; background: #f2f2f2">
        <form method="POST" action = "../database/admin_data.php" onsubmit="return passwords_not_match();">

         <h3 align="center" class="mb-4 mt-4">Reset Password</h3>
        <div class="input-group mb-4">
          <div class="input-group-prepend">
            <span class="input-group-text" ><i class="fa fa-keyboard-o"></i></span>
          </div>
          <input type="password" class="form-control" placeholder="Current Password" name="current_password">
        </div>

        <div class="input-group mb-4">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-keyboard-o"></i></span>
          </div>
          <input type="password" class="form-control" placeholder="Enter New Password" name="new_password" id="new_password_1" oninput="passwords_match()">
        </div>

        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-keyboard-o"></i></span>
          </div>
          <input type="password" class="form-control" placeholder="Confirm New Password" name="new_password_2" id="new_password_2" oninput="passwords_match()">
        </div>
        <div align="center" id="passwords_confirmed" style="display: none">
          <span style="color:#029904;" >Passwords Matches</span>
        </div>
        <div class="input-group mt-3 mb-3">
          <input type="submit" name="reset_password" class="form-control btn btn-primary" value="Reset Password" />
        </div>
        </form>
        </div>
    </div>
    <br>

<?php else :?>
  <h1 style="width: 100%; height: 40vh">Access Denied</h1>
<?php endif; ?>
</div>

    

<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_bottom.php'; ?>