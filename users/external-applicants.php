<?php 
include DIRNAME( __DIR__ ).'/layouts/master_layout_top.php';
?>

  <div class="leftContent">

    <div class="row justify-content-center" >
  
      
    <?php
      $instruments = $conn->query( "SELECT DISTINCT f.`instrument_id`, i.`instrument` FROM `facilities` f INNER JOIN `instruments` i ON f.`instrument_id`=i.`id` WHERE f. `availability` = 1" );
    ?>

    
    <div class="px-5 px-add" style="border:2px solid #f2f2f2; width: 1000px; background: #f2f2f2">
      <form method="POST" action="../database/external-applicants-data.php" id="external_applicants_form" onsubmit="return validate_external_applicants()">
        <h3 align="center" class="mb-4 mt-4">Instrumentation Facility Form for External Applicants</h3>
        <br>

        <p class="mb-1">Please Select Organization Type:</p>
        <div class="row mb-2 justify-content-center">
          <div class="col-md-6" align="center" >

            <div class="input-group mb-4">
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="institute" name="type" class="custom-control-input" value="Institute">
                <label class="custom-control-label" for="institute" style="cursor:pointer" onclick="applicant_total()"><i class="fa fa-university px-2"> </i> Institutes (Govt. and Private)</label>
              </div>
            </div>
          </div>
          <div class="col-md-6" align="center">
            <div class="input-group mb-4">
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="industry" name="type" class="custom-control-input" value="Industry">
                <label class="custom-control-label" for="industry" style="cursor:pointer" onclick="applicant_total()"><i class="fa fa-industry px-2"> </i> Industries (All Industries)</label>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row mb-2 justify-content-center">
          <div class="col-md-12">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-building-o"></i></span>
              </div>
              <input type="text" class="form-control" placeholder="Name of Institute / Industry" id="organization" name="organization">
            </div>
          </div>
        </div>
            
        <div class="row mb-2 justify-content-center">
          <div class="col-md-12">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-map-marker"></i></span>
               </div>
              <textarea class="form-control" placeholder="Address" id="address" name="address"></textarea>
            </div>
          </div>
        </div>

        <div class="row mb-2 justify-content-center">
          <div class="col-md-12">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-user"></i></span>
               </div>
              <input type="text" class="form-control" placeholder="Your Name" id="name" name="name">
            </div>
          </div>
        </div>

        <div class="row mb-2 justify-content-center">
          <div class="col-md-12">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-id-badge"></i></span>
               </div>
              <input type="text" class="form-control" placeholder="Designation" id="designation" name="designation">
            </div>
          </div>
        </div>

        <div class="row mb-2 justify-content-center">
          <div class="col-md-12">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-envelope"></i></span>
               </div>
              <input type="text" class="form-control" placeholder="E-mail" id="email" name="email">
            </div>
          </div>
        </div>


        <div class="row mb-2 justify-content-center">
          <div class="col-md-12">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-phone"></i></span>
               </div>
              <input type="text" class="form-control" placeholder="Contact Number" id="contact" name="contact">
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
              <select class="custom-select form-control" name="facility" id="facility" onchange="applicant_total();">
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
              <textarea class="form-control" id="message" name="message" placeholder="Additional text message or information (optional)"></textarea>
            </div>
          </div>
        </div>

        <div class="row mb-2 justify-content-center">
          <div class="col-md-3" align="center">
            <label>No. of Samples</label>
            <div class="input-group mb-0">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-hashtag"></i></span>
               </div>
              <input type="number" id="nos" class="form-control" value="1" name="no_of_samples" oninput="applicant_total();" onchange="enter_nos();">
            </div>
          </div>

          <div class="col-sm-3" align="center">
            <h4 class="pt-4 mt-1" style="color:#000">X</h4>
          </div>

          <div class="col-sm-3" align="center">
            <label>Charge (₹)</label><br>
              <input readonly type="text" id="charge" class="btn btn-info" name="total" value="0" style="width:100%">
          </div>

          <div class="col-sm-3" align="center">
            <label>GST 18% (₹)</label><br>
            <input readonly type="text" id="gst" class=" btn btn-info" name="gtotal" value="0" style="width:100%">
          </div>         
        </div>
      
        <div class="row mb-4 justify-content-center" >
          <div class="col-sm-6" align="center">
            <h4 class="pt-2">Total Payable Amount (₹)</h4>
          </div>

          <div class="col-sm-6" align="center">
              <input readonly type="text" id="total" class=" btn btn-danger" name="gtotal" value="0" style="width:100%">
          </div>
        </div>

        <div class="row mb-2 justify-content-center">
          <div class="col-md-12">
            <div class="input-group mb-5">
                <input type="submit" class="form-control btn btn-primary" id="external_applicants" name="external_applicants" value="Proceed to Pay" name="payment"> 
            </div>
          </div>
        </div>

      </form>
      </div>
    </div>
  </div>  

<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_bottom.php'; ?>