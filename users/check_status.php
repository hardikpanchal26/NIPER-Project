<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_top.php'; ?>

<div class="leftContent">
      
    <div class="row justify-content-center pb-3" >

        <div class="pr-5 pl-5" style="border:2px solid #f2f2f2; width: 400px; background: #f2f2f2">
        <form method="POST" action = "../database/admin_data.php">

         <h3 align="center" class="mb-4 mt-4">Check Status</h3>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" ><i class="fa fa-envelope"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="Enter your email" name="email">
        </div>

        <div class="input-group mb-4">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-list"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="Application Id" name="application_id">
        </div>

        <div class="input-group mb-4 pb-2">
          <input type="submit" name="" class="form-control btn btn-primary" value="Show Status" />
        </div>
        </form>
        </div>
    </div>
</div>

<?php include DIRNAME( __DIR__ ).'/layouts/master_layout_bottom.php'; ?>