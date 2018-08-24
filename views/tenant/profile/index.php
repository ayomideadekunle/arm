<?php
$profile_data = $this->tenant_info;
$lease_data = $this->lease_info;
$tmodel = new Tenant_Model();
// $apt_info = $lmodel->apartmentInfo();
?>

<section class="content">
    <div class="row">
        <!-- <div class="col-md">
</div> -->

<div class="col-md-12">
    <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#about" data-toggle="tab" aria-expanded="true">About</a></li>
        <li><a href="#settings" data-toggle="tab" aria-expanded="true">Settings</a></li>
    </ul>
    <div class="tab-content">

      <div class="tab-pane active" id="about">
        <div class="box box-primary">
            <div class="box-body box-profile">
            <?php
                foreach ($profile_data as $value) {
                    ?>
                <!-- <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture"> -->
            <h3 class="profile-username"><?php echo $_SESSION["fullname"]; ?></h3>
                    <p class="text-muted"><?php echo $value["email"]; ?></p>
                  <?php } ?>
            <ul class="list-group list-group-unbordered">
              <?php
              foreach ($lease_data as $lease) {
                ?>
                <?php
                $building_infos = $tmodel->buildingInfo($lease["building_id"]);
                ?>
                <li class="list-group-item">
                    <b>Building</b> <a class="pull-right">
                      <?php foreach ($building_infos as $building) {
                        echo $building["buildingName"];
                      } ?>
                    </a>
                </li>
                <?php
                $apt_infos = $tmodel->apartmentInfo($lease["apartment_id"]);
                ?>
                <li class="list-group-item">
                    <b>Apartment Number</b> <a class="pull-right">
                      <?php foreach ($apt_infos as $apt) {
                        echo $apt["apartmentNumber"];
                      } ?>
                    </a>
                </li>
                <?php
                $apt_infos = $tmodel->apartmentInfo($lease["apartment_id"]);
                ?>
                <li class="list-group-item">
                    <b>Apartment Type</b> <a class="pull-right">
                      <?php foreach ($apt_infos as $apt) {
                        echo $apt["apartmentType"];
                      } ?>
                    </a>
                </li>
                <!-- <li class="list-group-item">
                    <b>Friends</b> <a class="pull-right">13,287</a>
                </li> -->
              <?php } ?>
            </ul>
                <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
            </div><!-- /.box-body -->
        </div>
      </div>

        <div class="tab-pane" id="settings">
          <div class="box-header">
              <h3 class="box-title">Change Password</h3>
          </div>
        <form class="form-horizontal" method="post">
          <div class="alert alert-danger alert-dismissable" style="display: none">
            <button type="button" class="btn-xs close" data-dismiss="alert">×</button>
                <h6 class="errmsg"><i class="icon fa fa-ban"></i></h6></div>
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Existing Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control prvpassword" name="oldpassword" onchange="checkPasswordExists();">
            </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">New Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control newpassword" name="password">
            </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success process">Submit</button>
                </div>
                </div>
        </form>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div>


    <!-- </div> -->
</div>
</section>

<script>

  function checkPasswordExists(){
    var password = $(".prvpassword").val();
    $.get("http://localhost/apartment-rental-mgt/tenant/passwordExists/" + password, function(result){
      // console.log(result);
      if(result === "Incorrect"){
        $('.alert').show();
        $('.errmsg').html("Incorrect Password");
      }
    });
  }
    $(document).ready(function () {

        $(".process").click(function () {
          // alert("Clicked")
            var postData = {
                oldpassword: $(".prvpassword").val(),
                password: $(".newpassword").val()
            }

            $.ajax({
                type: 'POST',
                url: "http://localhost/apartment-rental-mgt/tenant/change_pwd",
                data: postData,
                success: function (result) {
                  alert("Password changed successfully")
                location = "http://localhost/apartment-rental-mgt/tenant/tenantProfile";
                }
        });
    });
  });
</script>
