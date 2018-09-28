
<?php 
  session_start(); 
  include 'layouts/master_layout_top.php'; 
?>

    
  
      
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

        include 'database/config.php';
        $instruments = $conn->query( "SELECT * FROM `instruments`" );
      ?>

    
    <div class="row justify-content-center" >
      <div class="pr-5 pl-5" style="border:2px solid #f2f2f2; width: 1000px; background: #f2f2f2">
      <form method="POST" action="database/admin_data.php">
       <h3 align="center" class="mb-4 mt-4">Instrumentation Facility Form for NIPER Personnel</h3>
       <br>


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
                <span class="input-group-text" ><i class="fa fa-id-card"></i></span>
               </div>
              <input type="text" class="form-control" placeholder="ID Number" name="enroll_no">
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
            <select class="custom-select form-control" name="facility" id="facility">
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
          <div class="col-md-2">
            <label>No. of Samples</label>
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-hashtag"></i></span>
               </div>
              <input type="number" class="form-control" value="1" name="contact">
            </div>
          </div>
          
          <div class="col-md-3">
            <label>Total Amount</label>
              <input type="text" class="btn btn-info" name="total" value="Free" >
          </div>

          <div class="col-md-3">
            <label for="validationCustom03">Amount with GST 18%</label>
            <input type="text" class=" btn btn-danger" name="gtotal" value="NA" >
          </div>    
      </div>

      <div class="row mb-2 justify-content-center">
        <div class="col-md-8">
          <div class="input-group mb-5">
              <input type="submit" class="form-control btn btn-primary" value="Submit" name="payment"> 
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
  

<?php include 'layouts/master_layout_bottom.php'; ?>