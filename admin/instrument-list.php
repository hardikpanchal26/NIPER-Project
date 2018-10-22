<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_top.php'; ?>

<div class="leftContent">
<?php if(isset($_SESSION ['admin_logged_in']) ) :?>

  <?php
    $instruments = $conn->query( "SELECT * FROM `instruments`" );
  ?>
      <div class="table-responsive">
       <h3 class="mb-4" style="text-align: center;">List of Instruments in NIPER-A</h3>
      
        <table id="instrument_table" class="table table-striped">
          <thead class="thead-dark">
            <tr>
              <th style="vertical-align: middle;">#</th>
              <th style="vertical-align: middle;">Instrument</th>
              <th style="vertical-align: middle;">Facility</th>
              <th style="vertical-align: middle;">Charges for Industries</th>
              <th style="vertical-align: middle;">Charges for Institues</th>
              <th style="vertical-align: middle;">Remarks</th>
              <th style="vertical-align: middle;">Facility Availability</th>
              <th style="vertical-align: middle;">Action</th>
            </tr>
          </thead>
          
          <tbody>
            <?php
              $index = 1;
              if ($instruments->num_rows > 0) {
                while( $row = $instruments->fetch_assoc() ) { 
                  $table_instrument_id = $row['id'];
                  $facilities = $conn->query( "SELECT * FROM `facilities` WHERE `instrument_id` = '$table_instrument_id'" );

                  if ($facilities->num_rows > 0) {
                    while($row_inner = $facilities->fetch_assoc()) :?> 

                    <tr id="index_<?= $row_inner['id'] ?>">
                      <td><b><?= $row_inner['id'] ?></b></td>
                      <td><?= $row['instrument']; ?></td>
                      <td><ul><li><?= $row_inner['facility']; ?></li></ul></td>
                      <td><?= $row_inner['industry_charge']; ?><br></td>
                      <td><?= $row_inner['institute_charge']; ?><br></td>
                      <td><?= $row_inner['remark']; ?><br></td>
                      <td align="center">
                          <label class="switch">
                              <input type="hidden" name="facility_id" value="<?= $row_inner['id'] ?>">
                              <input type="checkbox" name="availability" id="availability_<?= $row_inner['id'] ?>" <?php if($row_inner['availability'] == 1) echo 'checked="checked"'; else echo "";?> onchange="submit_facility_avaibility_form(id)">
                            <span class="slider round"></span>
                          </label>
                      </td>
                      <td>
                        <form action="../database/admin_data.php" method="POST">
                          <input type="hidden" name="niper_personnel_id" value="<?= $internal_applicants['id'] ?>">
                              <?php 
                                  echo '<div style="width:70px; padding-top:2px"><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#edit_charges" style="display: inline-block; width:30px" onclick="set_edit_facility_id('.$row_inner['id'].')" title="Edit Charges"><i class="fa fa-edit"></i></button><span> </span><button type="button" class="btn btn-sm" style="display: inline-block; width:30px" onclick="set_delete_facility_id('.$row_inner['id'].')" title="Delete Facility"><i class="fa fa-trash"></i></button></div>';
                              ?>
                        </form>
                      </td>
                    </tr>
                    <?php endwhile; 
                  }
                }
              }
            ?>    
          </tbody>
        </table>
      </div>
      
      <div>
      <form action="../database/admin_data.php" method="POST" id="facility_delete_form">
        <input type="hidden" name="delete_facility" id="facility_delete_id" value="0">
      </form>
      </div>            

      <div class="modal" id="edit_charges">
              <div class="modal-dialog">
                
                <div id="send_mail_form_2" class="modal-content">
                
                  <div class="modal-header">
                    <h4 class="modal-title">Edit Charges</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  
                  <div class="modal-body" align="center" >
                    <form action="../database/admin_data.php" method="POST" style="width: 50%">

                      <input type="hidden" name="facility_edit_id" id="facility_edit_id" value="">
                      <div class="form-group mt-4 mb-4">
                        <label>New Charge for Industry</label>
                        <input type="text" class="form-control" name="new_industry_charge">
                      </div>
                      <div class="form-group mt-4 mb-4">
                        <label>New Charge for Institute</label>
                        <input type="text" class="form-control" name="new_institute_charge">
                      </div>
                      <input type="submit" class="btn btn-primary w-100 mb-4" name="edit_facility" value="Edit Charges">
                    </form>
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                  
                </div>
                <div id="send_mail_loader_2" class="modal-content" align="center" style="color:#102d53; min-height: 500px; display: none;">
                  
                  <div style="margin-top: 200px"><i class="fa fa-spinner fa-spin" style="font-size:48px"></i></div>
                  
                  <div class="mt-3 mb-2">S E N D I N G  &nbsp; M A I L ...</div>
                  <div>Please be patient. It may take a while.</div>
                </div>

              </div>
            </div>
    

    <script type="text/javascript">
      $(document).ready( function () {
        $('#instrument_table').DataTable( {
          dom: 'Blfrtip',
          buttons: [
          {
            extend: 'copyHtml5',
            title: 'Instrument Data'
          },
          {
            extend: 'excelHtml5',
            title: 'Instrument Data'
          },
          {
            extend: 'pdfHtml5',
            title: 'Instrument Data'
          },
          {
            extend: 'csvHtml5',
            title: 'Instrument Data'
          },
          {
            extend: 'print',
            title: 'Instrument Data'
          }
          ]
        });
        
        $('.dt-button').addClass('btn btn-info mr-2 mb-2');
        $('.dt-buttons').css({'position' : 'relative', 'float': 'right'});
        $('.dt-button').removeClass('dt-button');
        $('.dt-buttons').removeClass('dt-button');
        $('#instrument_table').addClass('pt-3');
        //$('.dataTables_filter').addClass('input-group');
        $('.dataTables_filter').css({'margin-right' : '150px' });
        $('.dataTables_filter input').addClass('form-control');
        $('.dataTables_length select').addClass('form-control');
        $('.dataTables_filter input').css({'display' : 'inherit', 'width': '75%'});
        $('.dataTables_length select').css({'display' : 'inherit', 'width': '40%'});



      });
    </script>

<?php else :?>
  <h1 style="width: 100%; height: 40vh">Access Denied</h1>
<?php endif; ?>
</div>

<?php include DIRNAME(__DIR__).'/layouts/master_layout_bottom.php'; ?>
