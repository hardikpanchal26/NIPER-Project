<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_top.php'; ?>

<div class="leftContent">
<?php if(isset($_SESSION ['admin_logged_in']) ) :?>	
		<div>
		    <div class="row justify-content-center" >
		      
		      <?php
		        if ( isset( $_SESSION['instrument_added'] ) && $_SESSION['instrument_added'] != FALSE ) 
		          echo '<div class="alert alert-success pr-5 pl-5" style="width: 1000px;">New Instrument <b>'. $_SESSION['instrument_added'] .'</b> Added</div>';
		        else if ( isset( $_SESSION['instrument_added'] ) && $_SESSION['instrument_added'] == FALSE ) 
		          echo '<div class="alert alert-danger pr-5 pl-5" style="width: 1000px;">Cannot add new Instrument. Instrument already added.</div>';
		        
		        unset($_SESSION['instrument_added']);

		        if ( isset( $_SESSION['facility_added'] ) && $_SESSION['facility_added'] != FALSE ) 
		          echo '<div class="alert alert-success pr-5 pl-5" style="width: 1000px;">New Facility <b>'. $_SESSION['facility_added'] .'</b> Added</div>';
		        else if ( isset( $_SESSION['facility_added'] ) && $_SESSION['facility_added'] == FALSE ) 
		          echo '<div class="alert alert-danger pr-5 pl-5" style="width: 1000px;">Server is down. Try Again Later.</div>';
		        
		        unset($_SESSION['facility_added']);

		        $instruments = $conn->query( "SELECT * FROM `instruments`" );
		        $supervisors = $conn->query( "SELECT * FROM `admins` ");
		      ?>

		    <div class="pr-5 pl-5" style="border:2px solid #f2f2f2; width: 1000px; background: #f2f2f2">
		      <form method="POST" action="../database/admin_data.php" id="add_instrument_form" onsubmit="return validate_add_instrument_form()">

		        <h3 align="center" class="mb-4 mt-4">Add New Instrument</h3>
		        <span>Add a new instrument.</span>


		        
		        
		        <div class="row mb-2">
		          <div class="col-md-6">
		            <div class="input-group mb-4">
		              <div class="input-group-prepend">
		                  <span class="input-group-text" ><i class="fa fa-wrench"></i></span>
		              </div>
		              <input type="text" class="form-control" placeholder="Instrument" name="instrument" id="instrument"> 
		            </div>
		          </div>

		          <div class="col-md-4">
		            <div class="input-group mb-4">
		              <div class="input-group-prepend">
		                  <span class="input-group-text" ><i class="fa fa-user"></i></span>
		              </div>
		              <select class="custom-select form-control" name="supervisor" id="supervisor">
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
		              <input type="submit" class="form-control btn btn-primary" name="add_instrument" id="add_instrument" value="Add">
		            </div>
		          </div>
		        </div>

		        <div class="row mb-2 justify-content-center px-3">
		          <div class="col-md-12 mb-4" align="center" style="background: #fff; border:1px solid #ced4da">
		            <table width="100%" class="table-bordered mt-4" cellpadding="5px" id="form_factors">
		              <tr> 
		                <td width="15%" align="center"><b>Sr No.</b></td>
		                <td width="45%" class="px-4" align="center"><b>Label</b></td>
		                <td align="center"><b>Type</b></td>
		              </tr>
		            </table>
		          </div>
		        </div>

		        <div class="row mb-2">
		        	<div class="col-md-6">
		          		<div class="input-group mb-4">
		          			<div class="input-group-prepend">
      							<span class="input-group-text">Blank</span>
    						</div>
			          		<input type="text" class="form-control" placeholder="Label" id="blank">
							<div class="input-group-append">
								<button class="btn btn-secondary" type="button" id="blank_btn"><i class="fa fa-plus"></i></button> 
							</div>
		          		</div>
		        	</div>

		        	<div class="col-md-6">
		          		<div class="input-group mb-4">
		          			<div class="input-group-prepend">
      							<span class="input-group-text">Choice</span>
    						</div>
			          		<input type="text" class="form-control" placeholder="Label: Comma separated values" id="choice">
							<div class="input-group-append">
								<button class="btn btn-secondary" type="button" id="choice_btn"><i class="fa fa-plus"></i></button> 
							</div>
		          		</div>
		        	</div>
		        </div>

		        	<input type="hidden" value="" id="instrument_form_factors" name="form_factors" >

		      </form>
		      </div>
		    </div>

	    	<br><br>
	    
		    <div class="row justify-content-center" >
		      <div class="pr-5 pl-5" style="border:2px solid #f2f2f2; width: 1000px; background: #f2f2f2">
		      <form method="POST" action="../database/admin_data.php" id="add_facility_form" onsubmit="return validate_add_facility_form()">
		       <h3 align="center" class="mb-4 mt-4">Add Instrument Facilities</h3>
		       <br>
		       <span>Select Instrument and Add Facility.</span>  
		       <div class="row mb-2">
		        <div class="col-md-6">
		          <div class="input-group mb-4">
		            <div class="input-group-prepend">
		                <span class="input-group-text" ><i class="fa fa-wrench"></i></span>
		            </div>
		            <select class="custom-select form-control" name="selected_instrument" id="selected_instrument">
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
		            <input type="text" class="form-control" placeholder="Facility" name="facility" id="facility"> 
		          </div>
		        </div>
		      </div>

		      

		      <div class="row mb-2">
		        <div class="col-md-6">
		          <div class="input-group mb-4">
		            <div class="input-group-prepend">
		              <span class="input-group-text" ><i class="fa fa-rupee"></i></span>
		             </div>
		            <input type="text" class="form-control" placeholder="Charge for Insdustry" name="charge_for_industry" id="charge_for_industry">
		          </div>
		        </div>
		        
		        <div class="col-md-6">
		          <div class="input-group mb-4">
		            <div class="input-group-prepend">
		              <span class="input-group-text" ><i class="fa fa-rupee"></i></span>
		            </div>
		            <input type="text" class="form-control" placeholder="Charge for Institutes (Govt. and Private)" name="charge_for_institute" id="charge_for_institute"> 
		           </div>
		        </div>
		      </div>

		      <div class="row mb-2">
		        <div class="col-md-6">
		          <div class="input-group mb-5">
		            <div class="input-group-prepend">
		              <span class="input-group-text" >Remarks</span>
		            </div>
		            <input type="text" class="form-control" name="remarks" id="remarks">
		          </div>
		        </div>

		        <div class="col-md-6">
		          <div class="input-group mb-5">
		              <input type="submit" class="form-control btn btn-primary" value="Add" name="add_facility" id="add_facility"> 
		          </div>
		        </div>
		      </div>

		      </form>
		      </div>
		    </div>
		</div>
	

<?php else :?>
	<h1 style="width: 100%; height: 40vh">Access Denied</h1>
<?php endif; ?>
</div>

<script type="text/javascript">
	var i =1;
	var form_data = new Array();
 
	$('#blank_btn').click( function() {

		var label = $('#blank').val();
		var type = 'Blank'; 
		$('#form_factors').append('<tr><td align="center">'+ i++ +'</td><td>'+label+'</td><td>'+type+'</td></tr>'
		);

		var insert_array = new Object();
		insert_array.type = "text";
		insert_array.label= label;
		form_data.push(insert_array);
		$('#instrument_form_factors').val(JSON.stringify(form_data));
		$('#blank').val('');
	});

	$('#choice_btn').click( function() {
		var data = $('#choice').val();
		var label = data.split(':')[0];
		var type = data.split(':')[1]; 
		$('#form_factors').append('<tr><td align="center">' + i++ + '</td><td>'+label+'</td><td>'+ 'Choices: ' + type+'</td></tr>'
		);


		var insert_array = new Object();
		insert_array.type = "select";
		insert_array.label= label;
		insert_array.choices= type.split(",");
		form_data.push(insert_array);
		$('#instrument_form_factors').val(JSON.stringify(form_data));
		$('#choice').val('');
	});
</script>

<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_bottom.php'; ?>