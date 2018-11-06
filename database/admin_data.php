<?php
require 'processing-loader.php'; 
require 'config.php';

//---- Mail Configuration ------------------------------------//

    include 'PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'cif.niperahm@gmail.com';                 // SMTP username
    $mail->Password = 'Niper#project';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->setFrom('cif.niperahm@gmail.com', 'NIPER Ahmedabad');

//------------------------------------------------------------//


//---- Admin Login, Logout and Reset Password ---------------//

    if (isset($_POST['admin_login']) ) {

        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $auth    = $conn->query("SELECT * FROM `admins` WHERE `username`='$username'");
        $auth = $auth->fetch_assoc();
        $db_password = $auth['password'];

        if (password_verify($password, $db_password)) {
            $_SESSION['admin_logged_in'] = $username;
            echo "<script type='text/javascript'> document.location = '../admin/admin-dashboard.php'; </script>";
     
        } else { 
            $_SESSION['invalid'] = true; 
            echo "<script type='text/javascript'> document.location = '../admin/niper-admin.php'; </script>";

        } 

    }

    if (isset($_POST['admin_logout']) ) {
        session_destroy();
        echo "<script type='text/javascript'> document.location = '../admin/niper-admin.php'; </script>";
    }

    if (isset($_POST['reset_password']) ) {

        $username = $_SESSION['admin_logged_in'];
        $password = $_POST['current_password'];
        
        $auth    = $conn->query("SELECT * FROM `admins` WHERE `username`='$username'");
        $auth = $auth->fetch_assoc();
        $db_password = $auth['password'];

        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

        if (password_verify($password, $db_password)) {
            $sql = "UPDATE `admins` SET `password` = '$new_password' WHERE `admins`.`id` = 1 AND `admins`.`username` = '$username'";
            if ($conn->query($sql)) {
                $_SESSION['reset_password'] = 'success';
            } else { 
                $_SESSION['reset_password'] = 'failed';
            } 
        } else { 
            $_SESSION['reset_password'] = 'failed'; 
        } 

        echo "<script type='text/javascript'> document.location = '../admin/reset-password.php'; </script>";
    }

//-----------------------------------------------------------//


//---- Add Instrument and Facility -------------------------//

    if (isset($_POST['add_instrument']) ) {
        $instrument = $_POST['instrument'];
        $supervisor = $_POST['supervisor'];
        $form_factors = $_POST['form_factors'];

        $sql = "INSERT INTO `instruments`(`id`, `instrument`, `admin_id`, `form_factors`) VALUES (NULL,'$instrument','$supervisor', '$form_factors')";

        if ($conn->query($sql) ) {
            $_SESSION['instrument_added'] = $instrument;
        } else {
            $_SESSION['instrument_added'] = false;
        }

        echo "<script type='text/javascript'> document.location = '../admin/add-instrumentation-facility.php'; </script>";
    }


    if (isset($_POST['add_facility']) ) {
        
        $instrument_id     = $_POST['selected_instrument'];
        $facility          = $_POST['facility'];
        $industry_charge   = $_POST['charge_for_industry'];
        $institute_charge  = $_POST['charge_for_institute'];
        $remarks           = $_POST['remarks'];


        $sql = "INSERT INTO `facilities` (`id`, `instrument_id`, `facility`, `industry_charge`, `institute_charge`, `remark`) VALUES (NULL, '$instrument_id', '$facility', '$industry_charge', '$institute_charge', '$remarks');";

        if ($conn->query($sql) ) {
            $_SESSION['facility_added'] = $facility;
        } else {
            $_SESSION['facility_added'] = false;
        }

        echo "<script type='text/javascript'> document.location = '../admin/add-instrumentation-facility.php'; </script>";
    }

    if (isset($_POST['edit_facility']) ) {
        
        $facility_id = $_POST['facility_edit_id'];
        $industry_charge = $_POST['new_industry_charge'];
        $institute_charge = $_POST['new_institute_charge'];
        
        $sql = "UPDATE `facilities` SET `industry_charge` = '$industry_charge', `institute_charge` = '$institute_charge' WHERE `facilities`.`id` = '$facility_id';";
        $conn->query($sql);
        echo "<script type='text/javascript'> document.location = '../admin/instrument-list.php'; </script>";
    }

    if (isset($_POST['delete_facility']) ) {
        $facility_id = $_POST['delete_facility'];
        $sql = "DELETE FROM `facilities` WHERE `facilities`.`id` = '$facility_id';";
        $conn->query($sql);
        echo "<script type='text/javascript'> document.location = '../admin/instrument-list.php'; </script>";
    }

//----------------------------------------------------------//


//---- Internal Applicants ---------------------------------//

    if (isset($_POST['niper_personnel']) ) {
        

        $name          = $_POST['name'];
        $enroll_no     = $_POST['enroll_no'];
        $email         = $_POST['email'];
        $contact       = $_POST['contact'];
        $facility      = $_POST['facility']; 
        if(isset($_POST['this_form'])) {
            $this_form = serialize($_POST['this_form']);
        }
        else $this_form = "";
        $message       = $_POST['message'];
        $no_of_samples = $_POST['no_of_samples'];

        //echo $name.' '.$enroll_no.' '.$email.' '.$contact.' '.$selected_instrument.' '.$facility.' '.$message.' '.$no_of_samples;
        //die(); 
        
        $sql = "INSERT INTO `internal_applicants` (`id`, `name`, `id_number`, `email`, `contact`, `facility_id`, `form_values`, `message`, `nos`, `timestamp`, `status`) VALUES (NULL, '$name', '$enroll_no', '$email', '$contact', '$facility', '$this_form', '$message', '$no_of_samples', CURRENT_TIMESTAMP, '1')";

        if ($conn->query($sql) ) {
            $last_id = $conn->insert_id;

                //----------------------------------------------------------------------------------------------------//
            $mail->addAddress($email);

            $mail->isHTML(true);                  // Set email format to HTML

            $mail->Subject = "CIF NIPER Ahmedabad";
            $mail->Body    = '<p>Dear, '.$name.'</p><p>Your Application for using NIPER Ahmedabad Central Instrumentation Facility has been sucessfully received. Your Application ID is <b>'.$last_id.'</b>. You may check status of your application through NIPER CIF Portal using provided Application ID.</p><p>Regards,<br>Central Instrumentation Facility Department,<br>NIPER Ahmedabad<p>';
            
            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }
            //----------------------------------------------------------------------------------------------------//

            $_SESSION['niper_personnel_application'] = $last_id;

        } else {
            $_SESSION['niper_personnel_application'] = 'fail';
        }
        echo "<script type='text/javascript'> document.location = '../users/niper-applicants.php'; </script>";
    }

    if (isset($_POST['application_accept']) ) {
        $current_applicant_id = $_POST['niper_personnel_id'];
        $sql = "UPDATE `internal_applicants` SET `status` = '4' WHERE `internal_applicants`.`id` = '$current_applicant_id'";
        $conn->query($sql);

        echo "<script type='text/javascript'> document.location = '../admin/internal-applicants.php'; </script>";
    }

    if (isset($_POST['application_delete']) ) {
        $current_applicant_id = $_POST['niper_personnel_id'];
        $sql = "DELETE FROM `internal_applicants` WHERE `internal_applicants`.`id` = '$current_applicant_id'";
        $conn->query($sql);
        echo "<script type='text/javascript'> document.location = '../admin/internal-applicants.php'; </script>";
    }

    if (isset($_POST['application_complete']) ) {
        
        $current_applicant_id = $_POST['niper_personnel_id'];
        $applicant_name = $conn->query("SELECT `name` FROM `internal_applicants` WHERE `id` = '$current_applicant_id'")->fetch_object()->name;
        
        //----------------------------------------------------------------------------------------------------//
        $mail->addAddress($_POST['email']);

        $file_name = 'Reports/'.$_FILES["file"]["name"];
        move_uploaded_file($_FILES["file"]["tmp_name"], $file_name); 

        $mail->addAttachment($file_name);     // Optional name
        $mail->isHTML(true);                  // Set email format to HTML

        $mail->Subject = "CIF Report from NIPER Ahmedabad";
        $mail->Body    = '<p>Dear, '.$applicant_name.'</p><p>'.$_POST['message-body'].'</p><p>Regards,<br>Central Instrumentation Facility Department,<br>NIPER Ahmedabad<p>';
        
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
        //----------------------------------------------------------------------------------------------------//

        if( isset( $_POST['complete_report'] ) ) {
            $sql = "UPDATE `internal_applicants` SET `status` = '3' WHERE `internal_applicants`.`id` = '$current_applicant_id'";
            $conn->query($sql);
        }

        echo "<script type='text/javascript'> document.location = '../admin/internal-applicants.php'; </script>";
    }

    if (isset($_POST['application_reject']) ) {
        $current_applicant_id = $_POST['niper_personnel_id'];
        $applicant_name = $conn->query("SELECT `name` FROM `internal_applicants` WHERE `id` = '$current_applicant_id'")->fetch_object()->name;
        
        //----------------------------------------------------------------------------------------------------//
        $mail->addAddress($_POST['email']);

        $mail->isHTML(true);                  // Set email format to HTML

        $mail->Subject = "CIF Report from NIPER Ahmedabad";
        $mail->Body    = '<p>Dear, '.$applicant_name.'</p><p>'.$_POST['message-body'].'</p><p>Regards,<br>Central Instrumentation Facility Department,<br>NIPER Ahmedabad<p>';
        
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
        $sql = "UPDATE `internal_applicants` SET `status` = '2' WHERE `internal_applicants`.`id` = '$current_applicant_id'";
        $conn->query($sql);
        echo "<script type='text/javascript'> document.location = '../admin/internal-applicants.php'; </script>";
    }

    if (isset($_POST['check_status']) ) {
        $email = $_POST['email'];
        $application_id = $_POST['application_id'];

        if (strpos($application_id, 'EXT') !== false) {
            $application_id = substr($application_id, 3);
            $sql = "SELECT `email`,`status` FROM `external_applicants` WHERE `id` = '$application_id'";            
        }

        else {
            $sql = "SELECT `email`,`status` FROM `internal_applicants` WHERE `id` = '$application_id'";
        }

        if ($conn->query($sql)->num_rows != 0) {  
            $data = $conn->query($sql)->fetch_assoc(); 
            $email_fetched = $data['email'];
            if ($email == $email_fetched ) {
                $_SESSION["check_status"] = $data['status'];
            } else {
                $_SESSION["check_status"] = 'fail';    
            }
        } else {
            $_SESSION["check_status"] = 'fail';
        }

        echo "<script type='text/javascript'> document.location = '../users/check-status.php'; </script>";   
    }

//----------------------------------------------------------//

?>
