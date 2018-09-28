
<?php 
  session_start(); 
  include 'layouts/master_layout_top.php'; 
?>
<?php
  if(!isset($_SESSION ['admin_logged_in']) ) :?>

    <?php
      if ( isset( $_SESSION['invalid'] ) ) 
        echo '<div align="center"><div class="alert alert-danger pr-5 pl-5" style="width: 400px;" align="center">Invalid Username or Password</div></div>'; 
      unset($_SESSION['invalid']);  
    ?>
      
    <div class="row justify-content-center pb-3" >

        <div class="pr-5 pl-5" style="border:2px solid #f2f2f2; width: 400px; background: #f2f2f2">
        <form method="POST" action = "database/admin_data.php">

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

        <div class="input-group mb-3">
          <input type="submit" name="admin_login" class="form-control btn btn-primary" value="Login" />
        </div>
        </form>
        </div>
    </div>
    <br>
<?php endif; ?>

    

<?php
  
  if( isset($_SESSION ['admin_logged_in']) ) :?>
    
    <div class="row justify-content-center" >
      
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
        $supervisors = $conn->query( "SELECT * FROM `admins` ");
      ?>

      <div class="pr-5 pl-5" style="border:2px solid #f2f2f2; width: 1000px; background: #f2f2f2">
        <form method="POST" action="database/admin_data.php">

        <h3 align="center" class="mb-4 mt-4">Add New Instrument</h3>
        <span>Add a new instrument.</span>
        
        <div class="row mb-2">
          <div class="col-md-6">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                  <span class="input-group-text" ><i class="fa fa-wrench"></i></span>
              </div>
              <input type="text" class="form-control" placeholder="Instrument" name="instrument"> 
            </div>
          </div>

          <div class="col-md-4">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                  <span class="input-group-text" ><i class="fa fa-user"></i></span>
              </div>
              <select class="custom-select form-control" name="supervisor">
                <option selected>-- Select Supervisor --</option>
                <?php
                  if ($supervisors->num_rows > 0) {
                    while($row = $supervisors->fetch_assoc()) {
                      echo '<option value="'.$row['id'].'">'. $row['name'] .'</option>';
                    }
                  }
                ?>
              </select>
            </div>
          </div>
        

          <div class="col-md-2">
            <div class="input-group mb-4">
              <input type="submit" class="form-control btn btn-primary" name="add_instrument" value="Add">
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>

    <br><br>
    
    <div class="row justify-content-center" >
      <div class="pr-5 pl-5" style="border:2px solid #f2f2f2; width: 1000px; background: #f2f2f2">
      <form method="POST" action="database/admin_data.php">
       <h3 align="center" class="mb-4 mt-4">Add Instrument Facilities</h3>
       <br>
       <span>Select Instrument and Add Facility.</span>  
       <div class="row mb-2">
        <div class="col-md-6">
          <div class="input-group mb-4">
            <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fa fa-wrench"></i></span>
            </div>
            <select class="custom-select form-control" name="selected_instrument">
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

        <div class="col-md-6">
          <div class="input-group mb-4">
            <div class="input-group-prepend">
              <span class="input-group-text" ><i class="fa fa-flask"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Facility" name="facility"> 
          </div>
        </div>
      </div>

      

      <div class="row mb-2">
        <div class="col-md-6">
          <div class="input-group mb-4">
            <div class="input-group-prepend">
              <span class="input-group-text" ><i class="fa fa-rupee"></i></span>
             </div>
            <input type="text" class="form-control" placeholder="Charge for Insdustry" name="charge_for_industry">
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="input-group mb-4">
            <div class="input-group-prepend">
              <span class="input-group-text" ><i class="fa fa-rupee"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Charge for Institutes (Govt. and Private)" name="charge_for_institute"> 
           </div>
        </div>
      </div>


      <div class="row mb-2">
        <div class="col-md-6">
          <div class="input-group mb-5">
            <div class="input-group-prepend">
              <span class="input-group-text" >Remarks</span>
            </div>
            <input type="text" class="form-control" name="remarks">
          </div>
        </div>

        <div class="col-md-6">
          <div class="input-group mb-5">
              <input type="submit" class="form-control btn btn-primary" value="Add" name="add_facility"> 
          </div>
        </div>
      </div>




      </form>
      </div>
    </div>


  <?php endif; ?>
  

<?php include 'layouts/master_layout_bottom.php'; ?>