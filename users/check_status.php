<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_top.php'; ?>

<div class="leftContent">
      <?php
      if ( isset( $_SESSION['check_status'] ) )
      { if($_SESSION['check_status'] == 'fail') {
          echo '<div align="center"><div class="alert alert-danger pr-5 pl-5" style="width: 400px;" align="center">No Entry Found for given Email and Application Id</div></div>';
        }
        else { $application_id = $_SESSION['check_status'];
        } 

        unset($_SESSION['check_status']);
      } 
           
    ?>

    <div class="row justify-content-center pb-3" >
      <div class="pr-5 pl-5" style="border:2px solid #f2f2f2; width: 400px; background: #f2f2f2">
        <?php if ( isset($application_id) ) :?>
          <h3 align="center" class="mb-4 mt-4">Your Application Status</h3>
          <div class="mb-4" align="center">
            <p>Your application is:</p>
            <?php if($application_id == 1)
                    echo '<p class="badge badge-info">Submitted and yet to be Accepted</p>';
                  else if($application_id == 2)
                    echo'<p class="badge badge-danger">Rejected</p>';
                  else if($application_id == 3)
                    echo'<p class="badge badge-success">Completed</p>';
                  else 
                    echo '<p class="badge badge-warning">Accepted and is Under Process</p>';
            ?>
          </div>
          <button type="button" class="btn btn-primary w-100 mb-4" onclick="location.reload()">OK</button>
        
        <?php else :?>
          <form method="POST" action = "../database/admin_data.php" id="check_internal_status_form" onsubmit="return validate_check_status()">
            <h3 align="center" class="mb-4 mt-4">Check Status</h3>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-envelope"></i></span>
              </div>
              <input type="text" class="form-control" placeholder="Enter your email" id="email" name="email">
            </div>

            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-list"></i></span>
              </div>
              <input type="text" class="form-control" placeholder="Application Id" id="application_id" name="application_id">
            </div> 

            <div class="input-group mb-4 pb-2">
              <input type="submit" name="check_status" class="form-control btn btn-primary" id="show_satus" value="Show Status" />
            </div>
          </form>
        <?php endif; ?>
      </div>
    </div>
</div>

<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_bottom.php'; ?>