<?php 
include DIRNAME( __DIR__ ).'/layouts/master_layout_top.php'; 

$admins = $conn->query( "SELECT * FROM `admins`" );

?>

<div class="leftContent">

<div class="table-responsive">
   <h3 class="mb-4" style="text-align: center;">Admins and Supervisors</h3>
  
    <table id="admin_table" class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th style="vertical-align: middle;">#</th>
          <th style="vertical-align: middle;">Username</th>
          <th style="vertical-align: middle;">Name</th>
          <th style="vertical-align: middle;">Email</th>
          <th style="vertical-align: middle;">Role</th>
        </tr>
      </thead>
      
      <tbody>
      <?php 
        if ( $admins->num_rows > 0) {
          while( $admin = $admins->fetch_assoc() ) :?>
            <tr id="index_<?= $row_inner['id'] ?>">
              <td><b><?= $admin['id']; ?></b></td>
              <td><?= $admin['username']; ?></td>
              <td><?= $admin['name']; ?></td>
              <td><?= $admin['email']; ?></td>
              <td><?= $admin['role']; ?></td>
            </tr>
          <?php endwhile; }
      ?> 
            
      </tbody>
    

    </table>
  
  </div>
</div>


<script type="text/javascript">
  $(document).ready( function () {
    $('#admin_table').DataTable( {
      dom: 'Blfrtip',
      buttons: [
      {
        extend: 'copyHtml5',
        title: 'Admin Data'
      },
      {
        extend: 'excelHtml5',
        title: 'Admin Data'
      },
      {
        extend: 'pdfHtml5',
        title: 'Admin Data'
      },
      {
        extend: 'csvHtml5',
        title: 'Admin Data'
      },
      {
        extend: 'print',
        title: 'Admin Data'
      }
      ]
    });
    
    $('.dt-button').addClass('btn btn-info mr-2 mb-2');
    $('.dt-buttons').css({'position' : 'relative', 'float': 'right'});
    $('.dt-button').removeClass('dt-button');
    $('.dt-buttons').removeClass('dt-button');
    $('#admin_table').addClass('pt-3');
    //$('.dataTables_filter').addClass('input-group');
    $('.dataTables_filter').css({'margin-right' : '150px' });
    $('.dataTables_filter input').addClass('form-control');
    $('.dataTables_length select').addClass('form-control');
    $('.dataTables_filter input').css({'display' : 'inherit', 'width': '75%'});
    $('.dataTables_length select').css({'display' : 'inherit', 'width': '40%'});



  });
</script>
<?php include DIRNAME(__DIR__).'/layouts/master_layout_bottom.php'; ?>
