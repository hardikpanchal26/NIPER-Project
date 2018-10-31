<?php
include DIRNAME( __DIR__ ).'/layouts/master_layout_top.php';
?>

<div class="leftContent">
  
  <div class="row justify-content-center" >
    <?php
    if ( isset( $_SESSION['niper_personnel_application'] ) ) {
      if($_SESSION['niper_personnel_application'] != 'fail')
        echo '<div class="alert alert-success pr-5 pl-5" style="width: 1000px;">Application Successfully Submitted. Application ID is <b>'.$_SESSION['niper_personnel_application'].'</b></div>';
      else 
        echo '<div class="alert alert-danger pr-5 pl-5" style="width: 1000px;">Server is down. Try Again Later.</div>';
      unset( $_SESSION['niper_personnel_application'] );
    }
    
    $instruments = $conn->query( "SELECT DISTINCT f.`instrument_id`, i.`instrument` FROM `facilities` f INNER JOIN `instruments` i ON f.`instrument_id`=i.`id` WHERE f. `availability` = 1" );
    ?>
    <div class="px-5 px-add" style="border:2px solid #f2f2f2; width: 1000px; background: #f2f2f2">
      <form method="POST" action="../database/admin_data.php" id="niper_personnel_form" onsubmit="return validate_niper_personnel()">
        <h3 align="center" class="mb-4 mt-4">Instrumentation Facility Form for NIPER Personnel</h3>
        <br>

        <div class="row mb-2 justify-content-center">
          <div class="col-md-12">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control" placeholder="Applicant's Full Name" name="name" id="name">
            </div>
          </div>
        </div>

        <div class="row mb-2 justify-content-center">
          <div class="col-md-12">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-id-card"></i></span>
              </div>
              <input type="text" class="form-control" placeholder="ID Number" name="enroll_no" id="enroll_no">
            </div>
          </div>
        </div>

        <div class="row mb-2 justify-content-center">
          <div class="col-md-12">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-envelope"></i></span>
              </div>
              <input type="text" class="form-control" placeholder="E-mail" name="email" id="email">
            </div>
          </div>
        </div>

        <div class="row mb-2 justify-content-center">
          <div class="col-md-12">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-phone"></i></span>
              </div>
              <input type="text" class="form-control" placeholder="Contact Number" name="contact" id="contact">
            </div>
          </div>
        </div>

        <div class="row mb-2 justify-content-center">
          <div class="col-md-6">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-wrench"></i></span>
              </div>
              <select class="custom-select form-control" name="selected_instrument" id="selected_instrument" onchange="get_facility(), get_form_factors();">
                <option selected>-- Select Instrument --</option>
                <?php
                  if ($instruments->num_rows > 0) {
                    while($row = $instruments->fetch_assoc()) {
                      echo '<option value="'.$row['instrument_id'].'">'. $row['instrument'] .'</option>';
                    }
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-flask"></i></span>
              </div>
              <select class="custom-select form-control" name="facility" id="facility">
                <option selected>-- Select Facility --</option>
              </select>
            </div>
          </div>
        </div>
        
        <div class="row mb-2 justify-content-center px-3" id="form_factor_data"> 
          
        </div>

        <div class="row mb-2 justify-content-center">
          <div class="col-md-12">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-envelope-open"></i></span>
              </div>
              <textarea class="form-control" placeholder="Additional text message or information (optional)" name="message" id="message"></textarea>
            </div>
          </div>
        </div>

        <div class="row mb-2 justify-content-center">
          <div class="col-md-4">
            <label>No. of Samples</label>
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-hashtag"></i></span>
              </div>
              <input type="number" class="form-control" value="1" name="no_of_samples" id="no_of_samples">
            </div>
          </div>

          <div class="col-md-8">
            <label>Charges (₹)</label><br>
            <button type="button" class="btn btn-info" name="charge"  style="width: 100%">NA for Niper Personnel</button>
          </div>
        </div>

        <div class="row mb-2 justify-content-center">
          <div class="col-md-12">
            <div class="input-group mb-5">
                <input type="submit" class="form-control btn btn-primary" value="Submit" name="niper_personnel" id="niper_personnel"> 
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
  
<script type="text/javascript">
  $(document).ready( function () {
      
});
</script>
<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_bottom.php'; ?> 