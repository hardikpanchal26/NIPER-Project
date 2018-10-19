<?php

$url_beardcrumb_name = basename($_SERVER['REQUEST_URI']);
$name_string = ucwords(str_replace("-"," ",$url_beardcrumb_name));


if (isset($_SESSION['admin_logged_in']) ) : ?>
  <div class="sideBar">
    <div id="ContentPlaceHolder1_UserLeftMiddleMenu1_LeftMenu" class="rightMenu" style="background: #212529">
      <h2>Admin Dashboard</h2>
      <ul id='menuLeft' class='pageLink'>
        <li>
          <a href="<?php echo site_url().'/admin/niper-admin.php'; ?>" target='_self' title='Dashboard' style="color: #aeaeae"><i class="fa fa-dashboard pr-2"></i> Dashboard</a>
        </li>
        <li>
          <a href="<?php echo site_url().'/admin/internal-applicants.php'; ?>" target='_self' title='Applicants / Job Orderes' style="color: #aeaeae"><i class="fa fa-users pr-2"></i> Applicants / Job Orderes</a>
        </li>
        <li>
          <a href="<?php echo site_url().'/admin/instrument-list.php'; ?>" target='_self' title='Instrument List' style="color: #aeaeae"><i class="fa fa-list pr-2"></i> Instrumentation Facility List</a>
        </li>
        <li>
          <a href="<?php echo site_url().'/admin/add-instrumentation-facility.php'; ?>" target='_self' title='Add Instrumentation Facility' style="color: #aeaeae"><i class="fa fa-flask pr-2"></i> Add Instrumentation Facility</a>
        </li>
        <li>
          <a href="<?php echo site_url().'/admin/admins-and-supervisors.php'; ?>" target='_self' title='Admins / Supervisors' style="color: #aeaeae"><i class="fa fa-user-circle-o pr-2"></i> Admins / Supervisors </a>
        </li>
        <li>
          <a href= "<?php echo site_url().'/admin/reset-password.php'; ?>" target='_self' title='Reset Password' style="color: #aeaeae"><i class="fa fa-refresh pr-2"></i> Reset Password</a>
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
          <a href=<?php echo site_url().'/users/instrument-list-and-charges.php'; ?> target='_self' title='Instrument List and Charges' ><i class="fa fa-flask pr-2"></i> Instrument List and Charges</a>
        </li>
        <li>
          <a href=<?php echo site_url().'/users/niper-personnel.php'?> target='_self' title='NIPER Personnel' ><i class="fa fa-graduation-cap pr-2"></i> NIPER Personnel</a>
        </li>
        <li>
          <a href=<?php echo site_url().'/users/institutes-govt-and-private.php'?> target='_self' title='Institutes Govt and Private' ><i class="fa fa-university pr-2"></i> Institutes (Govt. and Private)</a>
        </li>
        <li>
          <a href=<?php echo site_url().'/users/industries.php'?> target='_self' title='Industries' ><i class="fa fa-industry pr-2"></i> Industries</a>
        </li>
        <li>
          <a href=<?php echo site_url().'/users/check-status.php'?> target='_self' title='Check Status' ><i class="fa fa-tasks pr-2"></i> Check Status</a>
        </li>
        <li>
          <a href=<?php echo site_url().'/admin/niper-admin.php'?> target='_self' title='Niper Admin' ><i class="fa fa-lock pr-2"></i> NIPER Admin</a>
        </li>
      </ul> 
      <br style='clear: left' />
    </div>
  </div>
<?php endif; ?>
