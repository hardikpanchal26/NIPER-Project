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
          if ($instruments->num_rows > 0) {
            while($row = $instruments->fetch_assoc()) { 
              $facilities = $conn->query( "SELECT * FROM `facilities`" );

              if ($facilities->num_rows > 0) {
            while($row_inner = $facilities->fetch_assoc()) :?> 

              <tr>
                <td style="width:5%"><b>1</b>
                </td>
                          
                <td style="width:10%">
                  <div class="input-group input-group-sm mb-0">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <input type="checkbox" aria-label="Checkbox for following text input">
                      </div>
                    </div>
                    <input type="text" class="form-control" aria-label="Text input with checkbox">
                  </div>
                </td>

                <td>LC-MS-QTOF</td>
                <td style="width:25%;"><ul><li>MS+VE</li></ul>
                <td style="width:18%"><?=numberToCurrency(4500);?><br></td>
                <td style="width:18%"><?=numberToCurrency(2250);?><br></td>
                <td>per mode<br></td>
              </tr>

            <?php end while; ?>
                        
          
      </tbody>
    </table>
  </div>

<?php include 'layouts/master_layout_bottom.php'; ?>