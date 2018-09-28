<?php 
//session_start();
if ( isset($_SESSION['admin_logged_in']) ) : ?>
  <div class="sideBar">
    <div id="ContentPlaceHolder1_UserLeftMiddleMenu1_LeftMenu" class="rightMenu" style="background: #212529">
      <h2>Admin Dashboard</h2>
      <ul id='menuLeft' class='pageLink'>
        <li>
          <a href='instrumentlistandcharges.php' target='_self' title='Instrument List and Charges' style="color: #aeaeae"><i class="fa fa-flask pr-2"></i> Applicants / Job Orderes</a>
        </li>
        <li>
          <a href='#' target='_self' title='Instrument List and Charges' style="color: #aeaeae"><i class="fa fa-flask pr-2"></i> Instrument List and Charges</a>
        </li>

        <li>
          <a href='#' target='_self' title='Instrument List and Charges' style="color: #aeaeae"><i class="fa fa-flask pr-2"></i> Add Instrumentation Facility</a>
        </li>

        <li>
          <a href='#' target='_self' title='Instrument List and Charges' style="color: #aeaeae"><i class="fa fa-flask pr-2"></i> Admins / Supervisors </a>
        </li>

        <li>
          <a href='#' target='_self' title='Instrument List and Charges' style="color: #aeaeae"><i class="fa fa-flask pr-2"></i> Reset Password</a>
        </li>
      </ul> 
      <br style='clear: left' />
    </div>
  </div>

<?php else : ?>
  <div class="sideBar">
    <div id="ContentPlaceHolder1_UserLeftMiddleMenu1_LeftMenu" class="rightMenu">
      <span class='heading'>Instrument Facility</span>
      <ul id='menuLeft' class='pageLink'>
        <li>
          <a href='instrumentlistandcharges.php' target='_self' title='Instrument List and Charges' ><i class="fa fa-flask pr-2"></i> Instrument List and Charges</a>
        </li>
        <li>
          <a href='niper_personnel.php' target='_self' title='Instrument List and Charges' ><i class="fa fa-graduation-cap pr-2"></i> NIPER Personnel</a>
        </li>
        <li>
          <a href='institutes_govt_and_private.php' target='_self' title='Instrument List and Charges' ><i class="fa fa-university pr-2"></i> Institutes (Govt. and Private)</a>
        </li>
        <li>
          <a href='industries.php' target='_self' title='Instrument List and Charges' ><i class="fa fa-industry pr-2"></i> Industries</a>
        </li>
        <li>
          <a href='niper-admin.php' target='_self' title='Niper Admin' ><i class="fa fa-lock pr-2"></i> NIPER Admin</a>
        </li>
      </ul> 
      <br style='clear: left' />
    </div>
  </div>

<?php endif; ?>
