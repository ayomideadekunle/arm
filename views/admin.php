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
                        <input type="email" class="form-control" name="username" id="username" placeholder="Username">
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

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <script type="text/javascript">
            $(document).ready(function () {

                $("#login_button").click(function (e) {
                    e.preventDefault();
                    var username = $("#username").val();
                    var password = $("#password").val();

                    // alert(username);

                    if ($.trim(username).length > 0 && $.trim(password).length > 0) {
                        $.ajax({
                            url: "http://arm/login/adminLogin/",
                            method: "POST",
                            data: {username: username, password: password},
                            cache: false,
                            success: function (data) {
                                window.location = "http://arm";
                            },
                            error: function () {}
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
