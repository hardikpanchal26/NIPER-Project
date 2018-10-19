<html>  
	<head>
	    <title> Central Instrumentation Facility - NIPER Ahmedabad </title>
	</head>
	<style>
	    .loader-bg {
	        width: 100%;
	        height: 100vh;
	        z-index: 99;
	        position: fixed;
	        top:0;
	        left: 0;
	        background-color: rgba(0,0,0,0.8);
	    }

	    .loader {
	        position: absolute;
	        top: 46%;
	        left: 50%;
	        transform: translate(-50%, -50%);
	        margin: 0;
	        padding: 0;
	        display: flex;
	    }

	    .loader li {
	    	font-family: 'Open Sans', sans-serif;
	        color: #ffffff !important;
	        font-size: 1em;
	        padding: 5px;
	        text-align: center;
	        width: 20px;
	        height: 20px;
	        background: #102D5E;
	        border-radius: 50%;
	        margin: 0.4rem;
	        animation: animate 1.4s linear infinite;
	        box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
	    }

	    @keyframes animate {
	        0% {
	            transform: translateY(0);
	        }

	        20% {
	            transform: translateY(10px);
	        }

	        40% {
	            transform: translateY(20px);
	        }

	        60% {
	            transform: translateY(20px);
	        }

	        80% {
	            transform: translateY(10px);
	        }

	        100% {
	            transform: translateY(0)
	        }
	    }

	    .loader-bg ul {
	        list-style-type: none;
	        margin: 0;
	        padding: 0;
	    }

	    .loader li:nth-child(1) {
	        animation-delay: 0s;
	    }

	    .loader li:nth-child(2) {
	        animation-delay: -1.2s;
	    }

	    .loader li:nth-child(3) {
	        animation-delay: -1s;
	    }

	    .loader li:nth-child(4) {
	        animation-delay: -.8s;
	    }

	    .loader li:nth-child(5) {
	        animation-delay: -6s;
	    }
	</style>

	<body>
	    <div class="loader-bg" style="display: block;">
	        <ul class="loader">
	            <li>N</li><li>I</li><li>P</li><li>E</li><li>R</li>
	        </ul>
	    </div>
	</body>

</html>


<?php 
session_start();
require 'config.php';
include 'PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;

    //$mail->SMPTDebug = 4;

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'cif.niperahm@gmail.com';                 // SMTP username
    $mail->Password = 'Niper#project';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->setFrom('cif.niperahm@gmail.com', 'NIPER Ahmedabad');
    


if (isset($_POST['admin_login']) ) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $auth    = $conn->query("SELECT * FROM `admins` WHERE `username`='$username'");
    $auth = $auth->fetch_assoc();
    $db_password = $auth['password'];

    if (password_verify($password, $db_password)) {
        $_SESSION['admin_logged_in'] = $username;
        echo "<script type='text/javascript'> document.location = '../admin/admin_dashboard.php'; </script>";
 
    } else { 
        $_SESSION['invalid'] = true; 
        echo "<script type='text/javascript'> document.location = '../admin/niper-admin.php'; </script>";

    } 

}

if (isset($_POST['admin_logout']) ) {
    session_destroy();
    echo "<script type='text/javascript'> document.location = '../admin/niper-admin.php'; </script>";
}

if (isset($_POST['add_instrument']) ) {
    $instrument = $_POST['instrument'];
    $supervisor = $_POST['supervisor'];
    $sql = "INSERT INTO `instruments`(`id`, `instrument`, `admin_id`) VALUES (NULL,'$instrument','$supervisor')";

    if ($conn->query($sql) ) {
        $_SESSION['instrument_added'] = $instrument;
    } else {
        $_SESSION['instrument_added'] = false;
    }

    echo "<script type='text/javascript'> document.location = '../admin/add_instrumentation_facility.php'; </script>";
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

    echo "<script type='text/javascript'> document.location = '../admin/reset_password.php'; </script>";
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

    echo "<script type='text/javascript'> document.location = '../admin/add_instrumentation_facility.php'; </script>";
}

if (isset($_POST['niper_personnel']) ) {
    

    $name          = $_POST['name'];
    $enroll_no     = $_POST['enroll_no'];
    $email         = $_POST['email'];
    $contact       = $_POST['contact'];
    $facility      = $_POST['facility']; 
    $message       = $_POST['message'];
    $no_of_samples = $_POST['no_of_samples'];

    //echo $name.' '.$enroll_no.' '.$email.' '.$contact.' '.$selected_instrument.' '.$facility.' '.$message.' '.$no_of_samples;
    //die(); 
    
    $sql = "INSERT INTO `internal_applicants` (`id`, `name`, `id_number`, `email`, `contact`, `facility_id`, `message`, `nos`, `timestamp`, `status`) VALUES (NULL, '$name', '$enroll_no', '$email', '$contact', '$facility', '$message', '$no_of_samples', CURRENT_TIMESTAMP, '1')";

    if ($conn->query($sql) ) {
        $last_id = $conn->insert_id;

            //----------------------------------------------------------------------------------------------------//
        $mail->addAddress($email);

        $mail->isHTML(true);                  // Set email format to HTML

        $mail->Subject = "CIF NIPER Ahmedabad";
        $mail->Body    = '<p>Dear, '.$applicant_name.'</p><p>Your Application for using NIPER Ahmedabad Central Instrumentation Facility has been sucessfully received. Your Application ID is <b>'.$last_id.'</b>. You may check status of your application through NIPER CIF Portal using provided Application ID.</p><p>Regards,<br>Central Instrumentation Facility Department,<br>NIPER Ahmedabad<p>';
        
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
    echo "<script type='text/javascript'> document.location = '../users/niper_personnel.php'; </script>";
}


if (isset($_POST['application_accept']) ) {
    $current_applicant_id = $_POST['niper_personnel_id'];
    $sql = "UPDATE `internal_applicants` SET `status` = '4' WHERE `internal_applicants`.`id` = '$current_applicant_id'";
    $conn->query($sql);

    echo "<script type='text/javascript'> document.location = '../admin/applicants.php'; </script>";
}




if (isset($_POST['application_delete']) ) {
    $current_applicant_id = $_POST['niper_personnel_id'];
    $sql = "DELETE FROM `internal_applicants` WHERE `internal_applicants`.`id` = '$current_applicant_id'";
    $conn->query($sql);
    echo "<script type='text/javascript'> document.location = '../admin/applicants.php'; </script>";
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

    $sql = "UPDATE `internal_applicants` SET `status` = '3' WHERE `internal_applicants`.`id` = '$current_applicant_id'";
    $conn->query($sql);

    echo "<script type='text/javascript'> document.location = '../admin/applicants.php'; </script>";
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
    echo "<script type='text/javascript'> document.location = '../admin/applicants.php'; </script>";
}

if (isset($_POST['check_status']) ) {
    $email = $_POST['email'];
    $application_id = $_POST['application_id'];

    $sql = "SELECT * FROM `internal_applicants` WHERE `id` = '$application_id'";
    
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

    echo "<script type='text/javascript'> document.location = '../users/check_status.php'; </script>";
    
}

?>
