<?php 
include DIRNAME( __DIR__ ).'/layouts/master_layout_top.php'; 

$instruments = $conn->query( "SELECT * FROM `instruments`" );

?>

<div class="leftContent">

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
                </tr>

                <?php endwhile; 
              }
            }
          }
        ?>    
      </tbody>
    

    </table>
  
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
<?php include DIRNAME(__DIR__).'/layouts/master_layout_bottom.php'; ?>
