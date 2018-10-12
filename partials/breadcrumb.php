<?php
<<<<<<< HEAD
=======
  $url_beardcrumb_name = basename($_SERVER['REQUEST_URI']);
  $name_string = explode(".", $url_beardcrumb_name);
  $beardcrumb_name = ucfirst($name_string[0]);
  if($beardcrumb_name == "Instrumentlistandcharges"){
    $beardcrumb_name = "Instrument List and Charges";
  } elseif($beardcrumb_name == "Niper_personnel") {
    $beardcrumb_name = "Niper Personnel";
  } elseif($beardcrumb_name == "Institutes_govt_and_private"){
    $beardcrumb_name = "Institutes (Govt. and Private)";
  } elseif($beardcrumb_name == "Check_status"){
    $beardcrumb_name = "Check Status";
  } elseif($beardcrumb_name == "Niper-admin"){
    $beardcrumb_name = "Niper Admin";
  }
>>>>>>> fe9c503c72f0c035e3d343ac76c70002e62dd643
?>
<div class="breadcrumb">
  <div class="container">
    <span id="ContentPlaceHolder1_BreadCrumbControl1_SiteMapPath1">
      <span>
        <a class="homeBLink breadLink" href="index.html" title="Home">
          <span class="bgleft">
            <span class="bg">Home</span>
          </span>
        </a>
      </span>
      <span></span>
      <span>
        <a href="http://nipergn.ac.in/error.htm" id="ContentPlaceHolder1_BreadCrumbControl1_SiteMapPath1_aParent_1" class="breadLink">
          <span class="bgleft">
            <span class="bg">Instrument Facility</span>
              </span>
        </a>
      </span>
      <span></span>
      <span>
        <span class="breadLink">
          <span class="bgleft">
            <span class="bg"></span>
          </span>
        </span>
        <span class="breadCurrent">
          <span class="bg">
<<<<<<< HEAD
            <span id="ContentPlaceHolder1_BreadCrumbControl1_SiteMapPath1_txtlabel_2" class="currentPage">Instrument List and Charges</span>
=======
            <span id="ContentPlaceHolder1_BreadCrumbControl1_SiteMapPath1_txtlabel_2" class="currentPage"> <?php echo $beardcrumb_name; ?> </span>
>>>>>>> fe9c503c72f0c035e3d343ac76c70002e62dd643
          </span>
        </span>
      </span>
    </span>
    <?php
      if(isset($_SESSION ['admin_logged_in']) ) :?>
        <form method="POST" action="../database/admin_data.php" style="float:right">
          <button type="submit" name="admin_logout" class="btn btn-danger" style="width:150px"><i class="fa fa-power-off pr-2"></i>Logout</button>   
        </form>
    <?php endif; ?>
  </div>
</div>
