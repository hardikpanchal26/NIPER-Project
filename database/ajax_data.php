<?php

require 'config.php';

if (isset($_POST['instrument_id']) ) {
    $instrument_id = $_POST['instrument_id'];
    $facilities  = $conn->query("SELECT `id`,`facility` FROM `facilities` WHERE `instrument_id` = '$instrument_id' AND `availability` = 1");

    echo '<option selected>-- Select Facility --</option>';

    if ($facilities->num_rows > 0 ) {
        while ( $facility = $facilities->fetch_assoc() ) {
            echo '<option value="' . $facility['id'] . '">' . $facility['facility'] . '</option>';
        }
    }
}

if (isset($_POST['instrument_id2']) ) {
    $instrument_id = $_POST['instrument_id2'];
    $json_data  = $conn->query("SELECT `form_factors` FROM `instruments` WHERE `id` = '$instrument_id'");
    $json_data = $json_data->fetch_assoc()['form_factors'];
    if($json_data != '') {
        $data = json_decode($json_data);
        echo '<div class="col-md-12 mb-4" align="center" style="background: #fff; border:1px solid #ced4da">
                <table width="100%" class="table-bordered mt-3" cellpadding="5px"';
                  $i=1;
                  foreach ($data as $form_data) {
                      echo '<tr> 
                        <td width="15%" align="center">'.$i++.'</td>
                        <td width="45%" class="px-4"><b>'.$form_data->label.'</b></td>';
                        if($form_data->type == 'text') {
                          echo '<td ><input type="text" class="form-control px-4" name="this_form[]" placeholder="Enter Data"></td>';
                        }
                        else {
                         echo ' <td>
                            <select class="form-control px-4" name="this_form[]">';
                              foreach ($form_data->choices as $choice) {
                                echo '<option>'.$choice.'</option>';
                              }
                            echo '  
                            </select>
                          </td>';
                        }
                      echo '</tr>';
                  }
        echo '  </table>
              </div>';
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


