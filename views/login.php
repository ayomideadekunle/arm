<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>waLkEr Apartment | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/bootstrap/css/bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/plugins/iCheck/square/blue.css">
  <script src="<?php echo URL; ?>public/jquery.js"></script>
  <script src="<?php echo URL; ?>public/jquery-ui.min.js"></script>
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a><b>waLkEr</b> APARTMENT</a>
    </div><!-- /.login-logo -->

    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <div id="errorMessage" class="alert alert-danger hidden" role="alert">
      </div>
      <form>
        <div class="form-group has-feedback">
          <input type="email" class="form-control" name="email" id="username" placeholder="Username">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <!-- <input type="checkbox"> Remember Me -->
              </label>
            </div>
          </div><!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat" id="login_button">
              Sign In
            </button>
          </div><!-- /.col -->
        </div>
      </form>
      <!-- <a href="#" data-target="#forgot_pwd" data-toggle="modal">Forgot password?</a> -->
    </div><!-- /.login-box-body -->
  </div><!-- /.login-box -->

  <div id="forgot_pwd" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Forgot password ?</h4>
        </div>
        <div class="modal-body">
          <form role="form" method="post" class="process">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control email" name="email" id="email" placeholder="Enter your registered email">
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </form>
        </div>
      </div>

      <script type="text/javascript">
      // function checkEmailExists(email){
      //   // var email = $(".email").val();
      //   $.get("http://localhost/apartment-rental-mgt/tenant/checkEmail", function(result){
      //     console.log(result);
      //   })
      // }
      $(document).ready(function () {
        $(".process").submit(function(){
          var email = $(".email").val();
          $.get("http://localhost/apartment-rental-mgt/tenant/checkEmail/" + email, function(response){
            console.log(response);
          })
        });
        $("#login_button").click(function (e) {
          e.preventDefault();
          var username = $("#username").val();
          var password = $("#password").val();

          // alert(username);

          if ($.trim(username).length > 0 && $.trim(password).length > 0) {
            $.ajax({
              url: "http://localhost/apartment-rental-mgt/login/loginUser/",
              method: "POST",
              data: {email: username, password: password},
              // cache: false,
              success: function (data) {
                location = "http://localhost/apartment-rental-mgt";
              }
            });
          } else {
            alert("Please enter your username and password");
          }
        });
      });
      </script>

      <!-- Bootstrap 3.3.5 -->
      <script src="<?php echo URL; ?>public/bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>
