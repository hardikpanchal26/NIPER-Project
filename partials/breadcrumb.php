<?php
  $url_beardcrumb_name = basename($_SERVER['REQUEST_URI']);
  $beardcrumb_name = ucwords(str_replace("-"," ",explode(".", $url_beardcrumb_name)[0]));

?>
<div class="breadcrumb">
  <div class="container">
    <span id="ContentPlaceHolder1_BreadCrumbControl1_SiteMapPath1">
      <span>
        <a class="homeBLink breadLink" href="<?= site_url(); ?>" title="Home">
          <span class="bgleft">
            <span class="bg">Home</span>
          </span>
        </a>
      </span>
      <span></span>
      <span>
        <a href="<?= site_url(); ?>">
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

            <span id="ContentPlaceHolder1_BreadCrumbControl1_SiteMapPath1_txtlabel_2" class="currentPage"> <?= $beardcrumb_name; ?> </span>
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
