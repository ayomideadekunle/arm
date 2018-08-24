<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title><?php echo $this->title; ?></title>
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo URL; ?>public/bootstrap/css/bootstrap.min.css">
        <!-- Font-awesome-->
        <link rel="stylesheet" href="<?php echo URL; ?>public/dist/css/fontawesome/styles.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo URL; ?>public/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo URL; ?>public/dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="<?php echo URL; ?>public/dist/css/dataTables.bootstrap.css">
        <link rel="stylesheet" href="<?php echo URL; ?>public/plugins/iCheck/flat/blue.css">
        <link rel="stylesheet" href="<?php echo URL; ?>public/plugins/select2/select2.min.css">
        <link rel="stylesheet" href="<?php echo URL; ?>public/plugins/datepicker/datepicker3.css">
        <script src="<?php echo URL; ?>public/jquery.js"></script>

        <script>
            function logout() {
                location = "http://localhost/apartment-rental-mgt/login/logout";
            }

            function showProfile() {
                location = "http://localhost/apartment-rental-mgt/tenant/tenantProfile";
            }
        </script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php
            @session_start();
            ?>
            <header class="main-header">
                <!-- Logo -->
                <a class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>W</b>A</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>waLkEr</b> Apartment</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>
                                        <?php
                                        if ($_SESSION['role'] == 'tenant') {
                                            echo $_SESSION['fullname'];
                                        } elseif ($_SESSION['role'] == 'admin') {
                                            echo $_SESSION['username'];
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header" style="height: auto !important;">
                                        <p>
                                            <?php
                                            if ($_SESSION['role'] == 'tenant') {
                                                echo $_SESSION['fullname'];
                                            } elseif ($_SESSION['role'] == 'admin') {
                                                echo $_SESSION['username'];
                                            }
                                            ?>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                        <?php
                                            if($_SESSION["role"] == "tenant"){ ?>
                                            <button class="btn btn-default btn-flat" onclick="showProfile();">Profile</button>
                                            <?php } ?>
                                        </div>
                                        <div class="pull-right">
                                            <button onclick="logout();" class="btn btn-danger btn-flat" id="logout_link">Sign out</button>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <ul class="sidebar-menu">
                        <?php
                        if ($_SESSION['role'] == 'admin') {
                            ?>
                            <li><a href="<?php echo URL; ?>landlord"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                            <li><a href="<?php echo URL; ?>landlord/buildings"><i class="fa fa-building-o"></i> <span>Buildings</span></a></li>
                            <li><a href="<?php echo URL; ?>landlord/apartments"><i class="fa fa-building-o"></i> <span>Apartments</span></a></li>
                            <li><a href="<?php echo URL; ?>landlord/leaseContracts"><i class="fa fa-list"></i> <span>Lease Contracts</span></a></li>
                            <li><a href="<?php echo URL; ?>landlord/tenants"><i class="fa fa-users"></i> <span>Tenants</span></a></li>
                            <li><a href="<?php echo URL; ?>landlord/maintenancerequests"><i class="fa fa-list"></i> <span>Maintenance Requests</span></a></li>
                            <li><a href="<?php echo URL; ?>landlord/apartment_change_requests"><i class="fa fa-list"></i> <span>Change Apartment Request</span></a></li>
                            <li><a href="<?php echo URL; ?>landlord/sendMessage"><i class="fa fa-inbox"></i> <span>Send Message</span></a></li>
                            <!--<li><a href="<?php echo URL; ?>landlord/"><i class="fa fa-money"></i> <span>Payment</span></a></li>-->
                            <li><a href="<?php echo URL; ?>landlord/terminatedContracts"><i class="fa fa-times"></i> <span>Terminated Contracts</span></a></li>
                            <li><a href="<?php echo URL; ?>landlord/securityRefunds"><i class="fa fa-money"></i> <span>Security Refunds</span></a></li>
                            <li><a href="<?php echo URL; ?>landlord/maintenanceCategories"><i class="fa fa-list"></i> <span>Maintenance Categories</span></a></li>
                        <?php } elseif ($_SESSION['role'] == 'tenant') {
                            ?>
                            <li><a href="<?php echo URL; ?>tenant"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                            <li><a href="<?php echo URL; ?>tenant/request"><i class = "fa fa-plus"></i> <span>Send Request</span></a></li>
                            <li><a href="<?php echo URL; ?>tenant/notifications"><i class = "fa fa-bell"></i> <span>Notifications</span></a></li>
                        <?php }
                        ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <div class="content-wrapper">
