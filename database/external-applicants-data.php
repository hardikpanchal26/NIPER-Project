<?php

require 'processing-loader.php'; 
require 'config.php';

function amount_to_be_paid($type, $facility, $gst, $conn) {
    $facilities  = $conn->query("SELECT `industry_charge`,`institute_charge` FROM `facilities` WHERE `id` = '$facility'")->fetch_assoc();

    if($type == "Industry")        $charge = $facilities['industry_charge'];
    else if ($type == "Institute") $charge = $facilities['institute_charge'];

    if($gst == "NO") $charge += ($charge * 0.18);
    return $charge;
}

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


//---- External Applicants ---------------------------------//

    if (isset($_POST['external_applicants']) ) {
        

        $type          = $_POST['type'];  
        $organization  = $_POST['organization'];
        $address       = $_POST['address'];
        $name          = $_POST['name'];
        $designation   = $_POST['designation'];
        $email         = $_POST['email'];
        $contact       = $_POST['contact'];
        $facility      = $_POST['facility']; 
        if(isset($_POST['this_form'])) {
            $this_form = serialize($_POST['this_form']);
        }
        else $this_form = "";
        $message       = $_POST['message'];
        $no_of_samples = $_POST['no_of_samples'];
        $gst_exemption = 'NO';

        $amount_paid   = amount_to_be_paid($type, $facility, $gst_exemption, $conn);
        
        
        $sql = "INSERT INTO `external_applicants` (`id`, `type`, `organization`, `address`, `name`, `designation`, `email`, `contact`, `facility_id`, `form_values`, `message`, `nos`, `amount_paid`, `gst_exemption`, `timestamp`, `status`) VALUES (NULL, '$type', '$organization', '$address', '$name', '$designation', '$email', '$contact', '$facility', '$this_form', '$message', '$no_of_samples', '$amount_paid', '$gst_exemption', CURRENT_TIMESTAMP, '1')";

        if ($conn->query($sql) ) {
            $last_id = $conn->insert_id;

                //----------------------------------------------------------------------------------------------------//
            
            $mail->addAddress($email);

            $mail->isHTML(true);                  // Set email format to HTML

            $mail->Subject = "CIF NIPER Ahmedabad";
            $mail->Body    = '<p>Dear, '.$name.'</p><p>Your Application for using NIPER Ahmedabad Central Instrumentation Facility has been sucessfully received. Your Application ID is <b>EXT'.$last_id.'</b>. You may check status of your application through NIPER CIF Portal using provided Application ID.</p><p>Regards,<br>Central Instrumentation Facility Department,<br>NIPER Ahmedabad<p>';
            
            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }
            //----------------------------------------------------------------------------------------------------//
        
            $_SESSION['external_applicant_application'] = $last_id;

        } else {
            $_SESSION['external_applicant_application'] = 'fail';
        }
        echo "<script type='text/javascript'> document.location = '../users/external-applicants.php'; </script>";
    }


    if (isset($_POST['application_accept']) ) {
        $current_applicant_id = $_POST['external_applicant_id'];
        $sql = "UPDATE `external_applicants` SET `status` = '4' WHERE `external_applicants`.`id` = '$current_applicant_id'";
        $conn->query($sql);

        echo "<script type='text/javascript'> document.location = '../admin/external-applicants.php'; </script>";
    }

    if (isset($_POST['application_delete']) ) {
        $current_applicant_id = $_POST['external_applicant_id'];
        $sql = "DELETE FROM `external_applicants` WHERE `external_applicants`.`id` = '$current_applicant_id'";
        $conn->query($sql);
        echo "<script type='text/javascript'> document.location = '../admin/external-applicants.php'; </script>";
    }

    if (isset($_POST['application_complete']) ) {
        
        $current_applicant_id = $_POST['external_applicant_id'];
        $applicant_name = $conn->query("SELECT `name` FROM `external_applicants` WHERE `id` = '$current_applicant_id'")->fetch_object()->name;
        
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
            $sql = "UPDATE `external_applicants` SET `status` = '3' WHERE `external_applicants`.`id` = '$current_applicant_id'";
            $conn->query($sql);
        }

        echo "<script type='text/javascript'> document.location = '../admin/external-applicants.php'; </script>";
    }

    if (isset($_POST['application_reject']) ) {
        $current_applicant_id = $_POST['external_applicant_id'];
        $applicant_name = $conn->query("SELECT `name` FROM `external_applicants` WHERE `id` = '$current_applicant_id'")->fetch_object()->name;
        
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
        $sql = "UPDATE `external_applicants` SET `status` = '2' WHERE `external_applicants`.`id` = '$current_applicant_id'";
        $conn->query($sql);
        echo "<script type='text/javascript'> document.location = '../admin/external-applicants.php'; </script>";
    }

//----------------------------------------------------------//

?>
