<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_top.php'; ?>

<div class="leftContent">
<?php if(isset($_SESSION ['admin_logged_in']) ) :?>
		<div>
		    <div class="row justify-content-center" >

		    	<?php
		        $no_of_instruments = $conn->query( "SELECT COUNT(*) FROM `instruments`" )->fetch_row();
		        $no_of_facilities = $conn->query( "SELECT COUNT(*) FROM `facilities`" )->fetch_row();
		        $no_of_supervisors = $conn->query( "SELECT COUNT(*) FROM `admins` ")->fetch_row();
		        ?>

		        <div class="pr-5 pl-5" style="border:2px solid #f2f2f2; width: 1000px; background: #f2f2f2">
		        	<h3 align="center" class="mb-4 mt-4">Admin Dashboard</h3>
		        	<div class="row dashboard_data">
		        		<div class="col-md-4 p-2" align="center" >
		        			<div class="admin_data_values p-3" style="background: #102d5e; width: 100%">
		        				<h1 class="mt-4"><i class="fa fa-users" style="font-size: 42px;"></i></h1>
		        				<h4>Admins / Supervisors</h4>
		        				<h2><?= $no_of_supervisors[0]; ?></h2>
		        			</div>
		        		</div>

		        		<div class="col-md-4 p-2" align="center" >
		        			<div class="admin_data_values p-3" style="background: #102d5e; width: 100%">
		        				<h1 class="mt-4"><i class="fa fa-wrench" style="font-size: 42px;"></i></h1>
		        				<h4>Instruments</h4>
		        				<h2><?= $no_of_instruments[0]; ?></h2>
		        			</div>
		        		</div>

		        		<div class="col-md-4 p-2" align="center" >
		        			<div class="admin_data_values p-3" style="background: #102d5e; width: 100%">
		        				<h1 class="mt-4"><i class="fa fa-flask" style="font-size: 42px;"></i></h1>
		        				<h4>Facilities</h4>
		        				<h2><?= $no_of_facilities[0]; ?></h2>
		        			</div>
		        		</div>
		        	</div>
		        </div>
		    </div>
		</div>
	
<?php else :?>
  <h1 style="width: 100%; height: 40vh">Access Denied</h1>
<?php endif; ?>
</div>
<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_bottom.php'; ?>