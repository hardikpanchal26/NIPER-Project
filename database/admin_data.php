<?php 
session_start();
include 'config.php';

if( isset( $_POST['admin_login'] ) ) {

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$auth    = $conn->query("SELECT * FROM `admins` WHERE `username`='$username'");
	$auth = $auth->fetch_assoc();
	$db_password = $auth['password'];

	if (password_verify($password, $db_password)) {
		$_SESSION['admin_logged_in'] = $username;
		echo "<script type='text/javascript'> document.location = '../admin/admin_dashboard.php'; </script>";
 
	}
	
	else { 
		$_SESSION['invalid'] = true; 
		echo "<script type='text/javascript'> document.location = '../admin/niper-admin.php'; </script>";

	} 

}

if( isset( $_POST['admin_logout'] ) ) {
	session_destroy();
	echo "<script type='text/javascript'> document.location = '../admin/niper-admin.php'; </script>";
}

if ( isset( $_POST['add_instrument'] ) ) {
	$instrument = $_POST['instrument'];
	$supervisor = $_POST['supervisor'];
	$sql = "INSERT INTO `instruments`(`id`, `instrument`, `admin_id`) VALUES (NULL,'$instrument','$supervisor')";

	if ( $conn->query($sql) ) {
    	$_SESSION['instrument_added'] = $instrument;
	} else {
    	$_SESSION['instrument_added'] = FALSE;
	}

	echo "<script type='text/javascript'> document.location = '../admin/add_instrumentation_facility.php'; </script>";
}

if ( isset( $_POST['add_facility'] ) ) {
	
	$instrument_id     = $_POST['selected_instrument'];
	$facility          = $_POST['facility'];
	$industry_charge   = $_POST['charge_for_industry'];
	$institute_charge  = $_POST['charge_for_institute'];
	$remarks           = $_POST['remarks'];


	$sql = "INSERT INTO `facilities` (`id`, `instrument_id`, `facility`, `industry_charge`, `institute_charge`, `remark`) VALUES (NULL, '$instrument_id', '$facility', '$industry_charge', '$institute_charge', '$remarks');";

	if ( $conn->query($sql) ) {
    	$_SESSION['facility_added'] = $facility;
	} else {
    	$_SESSION['facility_added'] = FALSE;
	}

	echo "<script type='text/javascript'> document.location = '../admin/add_instrumentation_facility.php'; </script>";
}
