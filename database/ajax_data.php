<?php

require 'config.php';

if (isset($_POST['instrument_id']) ) {
    $instrument_id = $_POST['instrument_id'];
    $facilities  = $conn->query("SELECT * FROM `facilities` WHERE `instrument_id` = '$instrument_id' AND `availability` = 1");

    echo '<option selected>-- Select Facility --</option>';

    if ($facilities->num_rows > 0 ) {
        while ( $facility = $facilities->fetch_assoc() ) {
            echo '<option value="' . $facility['id'] . '">' . $facility['facility'] . '</option>';
        }
    }
}

if (isset($_POST['facility_id']) ) {
    $facility_id = $_POST['facility_id'];
    $facilities  = $conn->query("SELECT * FROM `facilities` WHERE `id` = '$facility_id'");

    $facility = $facilities->fetch_assoc();
    echo json_encode($facility);
}

if (isset($_POST['facility_status_change_id']) ) {
    $facility_id = $_POST['facility_status_change_id'];
    $status = $_POST['status'];
    $conn->query("UPDATE `facilities` SET `availability` = '$status' WHERE `facilities`.`id` = '$facility_id'");
}


