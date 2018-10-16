<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_top.php'; ?>

<div class="leftContent">
<?php if(isset($_SESSION ['admin_logged_in']) ) :?>
    <?php 
      $applicant_id = $_POST['niper_personnel_id'];
      $internal_applicants = $conn->query( "SELECT * FROM `internal_applicants` WHERE `id`='$applicant_id' ")->fetch_assoc();
      $facility_id = $internal_applicants['facility_id'];
      $facility = $conn->query( "SELECT * FROM `facilities` WHERE `id` = '$facility_id'" )->fetch_assoc();
      $instrument_id = $facility['instrument_id'];
      $instrument = $conn->query( "SELECT * FROM `instruments` WHERE `id` = '$instrument_id'" )->fetch_assoc();
    ?>

    
    <div class="px-5 px-add" style="border:2px solid #f2f2f2; width: 1000px; background: #f2f2f2">
        <h3 align="center" class="mb-4 mt-4">Applicant Number : <span style="color: red"><?= $internal_applicants['id']?></span></h3>
        <br>
            <table class="table table-bordered table-sm mb-4">
              <tr>
                <td><b>Applicantion Id</b></td>
                <td><?= $internal_applicants['id'] ?></td>
              </tr>
              <tr>
                <td><b>Applicant's Full Name</b></td>
                <td><?= $internal_applicants['name'] ?></td>
              </tr>
              <tr>
                <td><b>Applicant's ID Number</b></td>
                <td><?= $internal_applicants['id_number'] ?></td>
              </tr>
              <tr>
                <td><b>Email</b></td>
                <td><?= $internal_applicants['email'] ?></td>
              </tr>
              <tr>
                <td><b>Contact</b></td>
                <td><?= $internal_applicants['contact'] ?></td>
              </tr>
              <tr>
                <td><b>Instrument</b></td>
                <td><?= $instrument['instrument'] ?></td>
              </tr>
              <tr>
                <td><b>Facility</b></td>
                <td><?= $facility['facility'] ?></td>
              </tr>
              <tr>
                <td><b>Number of Samples</b></td>
                <td><?= $internal_applicants['nos'] ?></td>
              </tr>
              <tr>
                <td><b>Additional Message</b></td>
                <td><?= $internal_applicants['message'] ?></td>
              </tr>
              <tr>
                <td><b>Timestamp</b></td>
                <td><?= $internal_applicants['timestamp'] ?></td>
              </tr>
              <tr>
                <td><b>Application status</b></td>
                <td>
                  <?php if ($internal_applicants['status'] == 1) 
                          echo '<span class="badge badge-info p-2">New Applicant</span>'; 
                          else if ( $internal_applicants['status'] == 2)
                          echo '<span class="badge badge-danger p-2">Rejected</span>';
                          else if ( $internal_applicants['status'] == 3)
                          echo '<span class="badge badge-success p-2">Completed</span>';
                          else
                          echo '<span class="badge badge-warning p-2">Under Process</span>';
                        ?>
                </td>
              </tr>
            </table>

            <form action="../database/admin_data.php" method="POST">
              <input type="hidden" name="niper_personnel_id" value="<?= $internal_applicants['id'] ?>">
              <div class="row mb-4 justify-content-center">
                  <?php 
                    if ($internal_applicants['status'] == 1)
                      echo '<div class="col-md-6"><input type="submit" name="application_accept" class="btn btn-success w-100" value="Accept"></div>
                        <div class="col-md-6"><input type="submit" name="application_reject" class="btn btn-danger w-100"  value="Reject"></div>';
                    else if ($internal_applicants['status'] == 2)
                      echo '<div class="col-md-12"><input type="submit" name="application_delete" class="btn btn-danger w-100" value="Delete"></div>';
                    else if ($internal_applicants['status'] == 3)
                      echo '';
                    else
                      echo '<div class="col-md-12"><button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#send_report">Send Report and Complete</button</div>';
                  ?>
              </div>
            </form>

            <div class="modal" id="send_report">
              <div class="modal-dialog">
                
                <div id="send_mail_form" class="modal-content">
                
                  <div class="modal-header">
                    <h4 class="modal-title">Send Report in Mail</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  
                  <div class="modal-body">
                    <form action="../database/admin_data.php" method="POST" enctype="multipart/form-data" onsubmit="send_mail_loader_load()">

                      <input type="hidden" name="niper_personnel_id" value="<?= $internal_applicants['id'] ?>">
                      <div class="form-group mt-4 mb-4">
                        <label>Send Email Report to: </label>
                        <input type="text" class="form-control" name="email" value="<?= $internal_applicants['email'] ?>" placeholder="Recipient's Email">
                      </div>
                      <div class="form-group mb-4">
                        <textarea class="form-control" name="message-body" placeholder="Message Body" rows="3">Please find the report of your CIF Test at NIPER Ahmedabad for the Application Number <?= $internal_applicants['id'] ?> in the attachment below.
                        </textarea>
                      </div>
                      <div class="form-group mb-4">
                        <input type="file" name="file" class="form-control" style="height:auto">
                      </div>
                      <input type="submit" class="btn btn-primary w-100 mb-4" name="application_complete" value="Send Report">
                    </form>
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                  
                </div>
                <div id="send_mail_loader" class="modal-content" align="center" style="color:#102d53; min-height: 500px; display: none;">
                  
                  <div style="margin-top: 200px"><i class="fa fa-spinner fa-spin" style="font-size:48px"></i></div>
                  
                  <div class="mt-3 mb-2">S E N D I N G  &nbsp; M A I L ...</div>
                  <div>Please be patient. It may take a while.</div>
                </div>

              </div>
            </div>
    </div>
    

<?php else :?>
  <h1 style="width: 100%; height: 40vh">Access Denied</h1>
<?php endif; ?>
</div>

<?php include DIRNAME(__DIR__).'/layouts/master_layout_bottom.php'; ?>
