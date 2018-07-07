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
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a><b>waLkEr</b> APARTMENT</a>
            </div><!-- /.login-logo -->

            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="<?php echo URL; ?>login/logInTenant" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="email" id="username" placeholder="Username">
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

        <script src="<?php echo URL; ?>public/jquery.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="<?php echo URL; ?>public/bootstrap/js/bootstrap.min.js"></script>
        <!-- <script src="<?php echo URL; ?>public/plugins/jQueryUI/jquery-ui.min.js"></script> -->
    </body>
</html>
