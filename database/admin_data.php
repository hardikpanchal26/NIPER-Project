<?php 
session_start();
include 'config.php';

if ( isset( $_POST['add_instrument'] ) ) {
	$instrument = $_POST['instrument'];
	$sql = "INSERT INTO `instruments`(`id`, `instrument`, `admin_id`) VALUES (NULL,'$instrument','1')";

	if ( $conn->query($sql) ) {
    	$_SESSION['instrument_added'] = $instrument;
	} else {
    	$_SESSION['instrument_added'] = FALSE;
	}
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
}

header( 'location: ../niper-admin.php' );