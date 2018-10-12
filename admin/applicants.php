<?php 
include DIRNAME( __DIR__ ).'/layouts/master_layout_top.php'; 

$internal_applicants = $conn->query( "SELECT * FROM `internal_applicants`" );

?>

<div class="leftContent">

<div class="table-responsive">
<!--
   <h3 class="mb-4" style="text-align: center;">Internal Applicants</h3>

   <h3 class="mb-4" style="text-align: center;">External Applicants</h3>
  -->
    <table id="internal_applicants_table" class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th style="vertical-align: middle;">#</th>
          <th style="vertical-align: middle;">ID</th>
          <th style="vertical-align: middle;">Name</th>
          <th style="vertical-align: middle;">Instrument</th>
          <th style="vertical-align: middle;">Facility</th>
          <th style="vertical-align: middle;">Samples</th>
          <th style="vertical-align: middle;">Email</th>
          <th style="vertical-align: middle;">Contact</th>
          <th style="vertical-align: middle;">Message</th>
          <th style="vertical-align: middle;">Date - Time</th>
          <th style="vertical-align: middle;">Status</th>
        </tr>
      </thead>
      
      <tbody>
        
        <?php
          if ($internal_applicants->num_rows > 0) {
            while( $internal_applicant = $internal_applicants->fetch_assoc() ) :?> 
              
              <?php 
              $facility_id = $internal_applicant['facility_id'];
              $facility = $conn->query( "SELECT * FROM `facilities` WHERE `id` = '$facility_id'" )->fetch_assoc();
              $instrument_id = $facility['instrument_id'];
              $instrument = $conn->query( "SELECT * FROM `instruments` WHERE `id` = '$instrument_id'" )->fetch_assoc();
              ?>
            
              <tr>
                <td><?= $internal_applicant['id']; ?></td>
                <td><?= $internal_applicant['id_number']; ?></td>
                <td><?= $internal_applicant['name']; ?></td>
                <td><?= $instrument['instrument']; ?></td>
                <td><?= $facility['facility']; ?></td>
                <td><?= $internal_applicant['nos']; ?></td>
                <td><?= $internal_applicant['email']; ?></td>
                <td><?= $internal_applicant['contact']; ?></td>
                <td><?= $internal_applicant['message']; ?></td>
                <td><?= $internal_applicant['timestamp']; ?></td>
                <td><?php if ($internal_applicant['status'] == 1) 
                      echo '<button class="btn btn-sm btn-info p-2" style="width:50%"><i class="fa fa-check"></i></button><button class="btn btn-sm btn-secondary p-2" style="width:50%"><i class="fa fa-close"></i></button>'; 
                      else if ( $internal_applicant['status'] == 2)
                      echo '<button class="btn btn-danger btn-sm" style="width:100%">Rejected</button>';
                      else if ( $internal_applicant['status'] == 3)
                      echo '<button class="btn btn-success btn-sm" style="width:100%">Completed</button>';
                      else
                      echo '<button class="btn btn-warning btn-sm" style="width:100%">Under Process</button>';
                      

                    ?>
                      
                </td>
              </tr>

              <?php endwhile; } ?>  
             
      </tbody>
    

    </table>
  
</div>
</div>


<script type="text/javascript">
  $(document).ready( function () {
    $('#internal_applicants_table').DataTable( {
      dom: 'Blfrtip',
      buttons: [
      {
        extend: 'copyHtml5',
        title: 'Internal Applicants Data'
      },
      {
        extend: 'excelHtml5',
        title: 'Internal Applicants Data'
      },
      {
        extend: 'pdfHtml5',
        title: 'Internal Applicants Data'
      },
      {
        extend: 'csvHtml5',
        title: 'Internal Applicants Data'
      },
      {
        extend: 'print',
        title: 'Internal Applicants Data'
      }
      ]
    });

    $('.dt-button').addClass('btn btn-info mr-2 mb-2');
    $('.dt-buttons').css({'position' : 'relative', 'float': 'right'});
    $('.dt-button').removeClass('dt-button');
    $('.dt-buttons').removeClass('dt-button');
    $('#internal_applicants_table').addClass('pt-3');
    //$('.dataTables_filter').addClass('input-group');
    $('.dataTables_filter').css({'margin-right' : '150px' });
    $('.dataTables_filter input').addClass('form-control');
    $('.dataTables_length select').addClass('form-control');
    $('.dataTables_filter input').css({'display' : 'inherit', 'width': '75%'});
    $('.dataTables_length select').css({'display' : 'inherit', 'width': '40%'});


  });
</script>
<?php include DIRNAME(__DIR__).'/layouts/master_layout_bottom.php'; ?>
