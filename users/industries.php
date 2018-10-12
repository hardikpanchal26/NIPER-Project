<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_top.php'; ?>

  <div class="leftContent">
      <?php
        if ( isset( $_SESSION['instrument_added'] ) && $_SESSION['instrument_added'] != FALSE ) 
          echo '<div class="alert alert-success pr-5 pl-5" style="width: 1000px;">New Instrument <b>'. $_SESSION['instrument_added'] .'</b> Added</div>';
        else if ( isset( $_SESSION['instrument_added'] ) && $_SESSION['instrument_added'] == FALSE ) 
          echo '<div class="alert alert-danger pr-5 pl-5" style="width: 1000px;">Server is down. Try Again Later.</div>';
        
        unset($_SESSION['instrument_added']);

        if ( isset( $_SESSION['facility_added'] ) && $_SESSION['facility_added'] != FALSE ) 
          echo '<div class="alert alert-success pr-5 pl-5" style="width: 1000px;">New Facility <b>'. $_SESSION['facility_added'] .'</b> Added</div>';
        else if ( isset( $_SESSION['facility_added'] ) && $_SESSION['facility_added'] == FALSE ) 
          echo '<div class="alert alert-danger pr-5 pl-5" style="width: 1000px;">Server is down. Try Again Later.</div>';
        
        unset($_SESSION['facility_added']);

        $instruments = $conn->query( "SELECT * FROM `instruments`" );
      ?>

    
    <div class="row justify-content-center" >
      <div class="pr-5 pl-5" style="border:2px solid #f2f2f2; width: 1000px; background: #f2f2f2">
      <form method="POST" action="database/admin_data.php">
       <h3 align="center" class="mb-4 mt-4">Instrumentation Facility Form for Industries</h3>
       <br>


      <div class="row mb-2 justify-content-center">
          <div class="col-md-8">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-industry"></i></span>
               </div>
              <input type="text" class="form-control" placeholder="Name of industry" name="industry">
            </div>
          </div>
      </div>

      <div class="row mb-2 justify-content-center">
          <div class="col-md-8">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-map-marker"></i></span>
               </div>
              <textarea class="form-control" placeholder="Industry Address" name="address"></textarea>
            </div>
          </div>
      </div> 

      <div class="row mb-2 justify-content-center">
          <div class="col-md-8">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-user"></i></span>
               </div>
              <input type="text" class="form-control" placeholder="Authorized Person Name" name="name">
            </div>
          </div>
      </div>


      <div class="row mb-2 justify-content-center">
          <div class="col-md-8">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-id-badge"></i></span>
               </div>
              <input type="text" class="form-control" placeholder="Designation" name="name">
            </div>
          </div>
      </div>

      <div class="row mb-2 justify-content-center">
          <div class="col-md-8">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-envelope"></i></span>
               </div>
              <input type="text" class="form-control" placeholder="E-mail" name="email">
            </div>
          </div>
      </div>


      <div class="row mb-2 justify-content-center">
          <div class="col-md-8">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-phone"></i></span>
               </div>
              <input type="text" class="form-control" placeholder="Contact Number" name="contact">
            </div>
          </div>
      </div>

      <div class="row mb-2 justify-content-center">
        <div class="col-md-4">
          <div class="input-group mb-4">
            <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-wrench"></i></span>
            </div>
            <select class="custom-select form-control" name="selected_instrument" id="selected_instrument" onchange="get_facility();">
              <option selected>-- Select Instrument --</option>
              <?php
                if ($instruments->num_rows > 0) {
                  while($row = $instruments->fetch_assoc()) {
                    echo '<option value="'.$row['id'].'">'. $row['instrument'] .'</option>';
                  }
                }
              ?>
            </select>
          </div>
        </div>

        <div class="col-md-4">
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


      <div class="row mb-2 justify-content-center">
          <div class="col-md-8">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-envelope-open"></i></span>
               </div>
              <textarea class="form-control" placeholder="Additional text message or information (optional)"></textarea>
            </div>
          </div>
      </div>

      <div class="row mb-2 justify-content-center">
          <div class="col-md-2" align="center">
            <label>No. of Samples</label>
            <div class="input-group mb-0">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-hashtag"></i></span>
               </div>
              <input type="number" id="nos" class="form-control" value="1" name="nos" oninput="applicant_total();" onchange="enter_nos();">
            </div>
          </div>

          <div class="col-sm-2" align="center">
            <h4 class="pt-4 mt-1" style="color:#000">X</h4>
          </div>

          <div class="col-sm-2" align="center">
            <label>Charge (₹)</label><br>
              <input type="text" id="charge" class="btn btn-info" name="total" value="0" style="width:100%">
          </div>

          <div class="col-sm-2" align="center">
            <label>GST 18% (₹)</label><br>
            <input type="text" id="gst" class=" btn btn-info" name="gtotal" value="0" style="width:100%">
          </div>         
      </div>
      
      <div class="row mb-4 justify-content-center" >
        <div class="col-sm-4" align="center">
          <h4 class="pt-2">Total Payable Amount (₹)</h4>
        </div>

        <div class="col-sm-4" align="center">
            <input type="text" id="total" class=" btn btn-danger" name="gtotal" value="0" style="width:100%">
        </div>
      </div>

      <div class="row mb-2 justify-content-center">
        <div class="col-md-8">
          <div class="input-group mb-5">
              <input type="submit" class="form-control btn btn-primary" value="Proceed to Pay" name="payment"> 
          </div>
        </div>
      </div>

<!--
      <div class="col-md-2">
          <div class="input-group mb-4">
            <div class="input-group-prepend">
              <span class="input-group-text" ><i class="fa fa-hashtag"></i></span>
            </div>
            <input type="text" class="form-control" name="units" placeholder="NOS">
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="input-group mb-5">
            <div class="input-group-prepend">
              <span class="input-group-text" >Remarks</span>
            </div>
            <input type="text" class="form-control" name="remarks">
          </div>
        </div>

-->



      </form>
      </div>
    </div>
  </div>
  
<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_bottom.php'; ?>