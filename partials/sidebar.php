<?php
$url_beardcrumb_name = basename($_SERVER['REQUEST_URI']);
$name_string = explode(".", $url_beardcrumb_name);
$beardcrumb_name = ucfirst($name_string[0]);
if($beardcrumb_name == "Instrumentlistandcharges"){
  echo "<style> #Instrumentlistandcharges{ background: #212529; border-radius: 10px; } #Instrumentlistandcharges a{ color: #ffffff; } </style>";
} elseif($beardcrumb_name == "Niper_personnel") {
  echo "<style> #Niper_personnel{ background: #212529; border-radius: 10px; } #Niper_personnel a{ color: #ffffff; } </style>";
} elseif($beardcrumb_name == "Institutes_govt_and_private"){
  echo "<style> #Institutes_govt_and_private{ background: #212529; border-radius: 10px; } #Institutes_govt_and_private a{ color: #ffffff; } </style>";
} elseif($beardcrumb_name == "Industries"){
  echo "<style> #Industries{ background: #212529; border-radius: 10px; } #Industries a{ color: #ffffff; } </style>";
} elseif($beardcrumb_name == "Check_status"){
  echo "<style> #Check_status{ background: #212529; border-radius: 10px; } #Check_status a{ color: #ffffff; } </style>";
} elseif($beardcrumb_name == "Niper-admin"){
  echo "<style> #Niper-admin{ background: #212529; border-radius: 10px; } #Niper-admin a{ color: #ffffff; } </style>";
}
if ( isset($_SESSION['admin_logged_in']) ) : ?>
  <div class="sideBar">
    <div id="ContentPlaceHolder1_UserLeftMiddleMenu1_LeftMenu" class="rightMenu" style="background: #212529">
      <h2>Admin Dashboard</h2>
      <ul id='menuLeft' class='pageLink'>
        <li>
          <a href="<?php echo site_url().'/admin/niper-admin.php'; ?>" target='_self' title='Dashboard' style="color: #aeaeae"><i class="fa fa-dashboard pr-2"></i> Dashboard</a>
        </li>
        <li>
          <a href="<?php echo site_url().'/admin/applicants.php'; ?>" target='_self' title='Applicants / Job Orderes' style="color: #aeaeae"><i class="fa fa-users pr-2"></i> Applicants / Job Orderes</a>
        </li>
        <li>
          <a href="<?php echo site_url().'/admin/instrument_list.php'; ?>" target='_self' title='Instrument List' style="color: #aeaeae"><i class="fa fa-list pr-2"></i> Instrumentation Facility List</a>
        </li>
        <li>
          <a href="<?php echo site_url().'/admin/add_instrumentation_facility.php'; ?>" target='_self' title='Add Instrumentation Facility' style="color: #aeaeae"><i class="fa fa-flask pr-2"></i> Add Instrumentation Facility</a>
        </li>
        <li>
          <a href="<?php echo site_url().'/admin/admins_supervisors.php'; ?>" target='_self' title='Admins / Supervisors' style="color: #aeaeae"><i class="fa fa-user-circle-o pr-2"></i> Admins / Supervisors </a>
        </li>
        <li>
          <a href= "<?php echo site_url().'/admin/reset_password.php'; ?>" target='_self' title='Reset Password' style="color: #aeaeae"><i class="fa fa-refresh pr-2"></i> Reset Password</a>
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
          <a href=<?php echo site_url().'/users/instrumentlistandcharges.php'; ?> target='_self' title='Instrument List and Charges' ><i class="fa fa-flask pr-2"></i> Instrument List and Charges</a>
        </li>
        <li>
          <a href=<?php echo site_url().'/users/niper_personnel.php'?> target='_self' title='Instrument List and Charges' ><i class="fa fa-graduation-cap pr-2"></i> NIPER Personnel</a>
        </li>
        <li>
          <a href=<?php echo site_url().'/users/institutes_govt_and_private.php'?> target='_self' title='Instrument List and Charges' ><i class="fa fa-university pr-2"></i> Institutes (Govt. and Private)</a>
        </li>
        <li>
          <a href=<?php echo site_url().'/users/industries.php'?> target='_self' title='Instrument List and Charges' ><i class="fa fa-industry pr-2"></i> Industries</a>
        </li>
        <li>
          <a href=<?php echo site_url().'/users/check_status.php'?> target='_self' title='Niper Admin' ><i class="fa fa-tasks pr-2"></i> Check Status</a>
        </li>
        <li>
          <a href=<?php echo site_url().'/admin/niper-admin.php'?> target='_self' title='Niper Admin' ><i class="fa fa-lock pr-2"></i> NIPER Admin</a>
        </li>
      </ul> 
      <br style='clear: left' />
    </div>
  </div>
<?php endif; ?>
