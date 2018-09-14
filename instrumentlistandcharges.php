<?php 

include 'database/config.php';
include 'layouts/master_layout_top.php'; 

$instruments = $conn->query( "SELECT * FROM `instruments`" );

?>
 <span style="color:#2158af; float: right">* Rates in ₹ (Excludes GST). | Contact: instruments@niperahm.ac.in</span>
<div class="table-responsive">
    <table class="table table-striped" style="text-align: left">
      <thead class="thead-dark" >
        <tr>
          <th colspan="8" style="text-align:center; vertical-align: middle;">List of Instruments in NIPER-A</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="width:5%"><b>#</b></td>
          <td style="width:10%"><b>Unit</b></td>
          <td><b>Instrument</b></td>
          <td style="width:25%"><b>Facility</b></td>
          <td style="width:18%"><b>Charges for Industries</b></td>
          <td style="width:18%"><b>Charges for Institues</b></td>
          <td><b>Remarks</b></td>
        </tr>
        
        <?php
          $index = 1;
          if ($instruments->num_rows > 0) {
            while($row = $instruments->fetch_assoc()) { 
              $table_instrument_id = $row['id'];
              $facilities = $conn->query( "SELECT * FROM `facilities` WHERE `Instrument_id` = '$table_instrument_id'" );

              if ($facilities->num_rows > 0) {
                while($row_inner = $facilities->fetch_assoc()) :?> 

                <tr>
                  <td style="width:5%"><b><?= $index++; ?></b>
                  </td>
                            
                  <td style="width:10%">
                    <div class="input-group input-group-sm mb-0">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <input type="checkbox">
                        </div>
                      </div>
                      <input type="text" class="form-control" value="1">
                    </div>
                  </td>

                  <td><?= $row['instrument']; ?></td>
                  <td style="width:25%;"><ul><li><?= $row_inner['facility']; ?></li></ul>
                  <td style="width:18%"><?= numberToCurrency($row_inner['industry_charge']); ?><br></td>
                  <td style="width:18%"><?= numberToCurrency($row_inner['institute_charge']); ?><br></td>
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

<?php include 'layouts/master_layout_bottom.php'; ?>