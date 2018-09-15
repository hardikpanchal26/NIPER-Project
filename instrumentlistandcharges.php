<?php 

include 'database/config.php';
include 'layouts/master_layout_top.php'; 

$instruments = $conn->query( "SELECT * FROM `instruments`" );

?>
<div class="table-responsive">
    <table class="table table-striped" style="text-align: left">
      <thead class="thead-dark" >
        <tr>
          <th colspan="3" style="text-align:center; vertical-align: middle;">Instrumentation Facility Charge Calculator</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="width: 40%"><b>#</b></td>
          <td style="width: 30%"><b>Charges For Industries</b></td>
          <td style="width: 30%"><b>Charges For Institutes (Govt. and Private)</b></td>
        </tr>

        <tr>
          <td><b>Instrument Charges</b></td>
          <td id="industry_basic" data-value="0">₹ 0</td>
          <td id="institute_basic" data-value="0">₹ 0</td>
        </tr>

        <tr>
          <td><b>Goods and Service Tax (18%)</b></td>
          <td id="industry_gst" data-value="0">₹ 0</td>
          <td id="institute_gst" data-value="0">₹ 0</td>
        </tr>

        <tr>
          <td><b>Total Charges</b></td>
          <td id="industry_total" data-value="0"><b style="color: red">₹ 0</b></td>
          <td id="institute_total" data-value="0"><b style="color: red">₹ 0</b></td>
        </tr>


        <tr>
          <td align="right" colspan="3">
            <button class="btn btn-success" style="width: 150px"><i class="fa fa-calculator pr-2"></i>View Charges</button>
            <button class="btn btn-danger" id="reset" style="width: 150px"><i class="fa fa-refresh pr-2"></i>Reset</button>
          </td>
        </tr>

      </tbody>
    </table>
  </div>

<br>
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

                <tr id="index_<?= $index; ?>">
                  <td style="width:5%"><b><?= $index++; ?></b>
                  </td>
                            
                  <td style="width:10%">
                    <div class="input-group input-group-sm mb-0">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <input type="checkbox" class="the_checkbox" style="cursor: pointer;">
                        </div>
                      </div>
                      <input type="text" data-value="0" class="the_unit form-control" value="1">
                    </div>
                  </td>

                  <td><?= $row['instrument']; ?></td>
                  <td style="width:25%;"><ul><li><?= $row_inner['facility']; ?></li></ul>
                  <td style="width:18%" class="industry_charge" data-charge="<?=$row_inner['industry_charge']?>"><?= numberToCurrency($row_inner['industry_charge']); ?><br></td>
                  <td style="width:18%" class="institute_charge" data-charge="<?=$row_inner['institute_charge']?>"><?= numberToCurrency($row_inner['institute_charge']); ?><br></td>
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
