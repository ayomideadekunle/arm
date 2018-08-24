<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Unauthorized Page</title>
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/bootstrap/css/bootstrap.min.css">
  <!-- Font-awesome-->
  <link rel="stylesheet" href="<?php echo URL; ?>public/dist/css/fontawesome/styles.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/dist/css/AdminLTE.min.css">
</head>
<body class="hold-transition">
  <div class="container-fluid" style="display: flex; margin-top: 5em;">
    <div class="content-wrapper">
      <section class="content-header">
        <h1 class="title">
          404 Page
        </h1>
      </section>

      <section class="content">
        <div class="error-page">
          <h2 class="headline text-yellow"> 404</h2>
          <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Page Not Found.</h3>
            <p>
              We could not find the page you were looking for.
              Meanwhile, you may <a href="<?php echo URL;?>">return to dashboard</a>
            </p>
          </div><!-- /.error-content -->
        </div><!-- /.error-page -->
      </section>
    </div>
  </div>
</body>
</html>
