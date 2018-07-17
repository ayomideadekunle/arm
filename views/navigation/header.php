<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo URL; ?>public/bootstrap/css/bootstrap.min.css">
        <!-- Font-awesome-->
        <link rel="stylesheet" href="<?php echo URL; ?>public/dist/css/fontawesome/styles.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo URL; ?>public/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo URL; ?>public/dist/css/skins/_all-skins.min.css">
        <script src="<?php echo URL; ?>public/jquery.js"></script>

        <script>
            function logout() {
                location = "http://localhost/apartment-rental-mgt/login/logout";
            }

            function showProfile() {
                location = "http://localhost/apartment-rental-mgt/landlord/tenantProfile";
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
                                    <!--<img src="<?php echo URL; ?>public/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
                                    <span>
                                        <?php
                                        echo $_SESSION['fullname'];
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header" style="height: auto !important;">
                                        <p>
                                            <?php
                                            echo $_SESSION['fullname'];
                                            ?>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <button class="btn btn-default btn-flat" onclick="showProfile();">Profile</button>
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
                        <li class="header">NAVIGATION MENU</li>
                        <li>
                            <a href="">
                                <i class="fa fa-home"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li><a href="<?php echo URL; ?>landlord/buildings"><i class="fa fa-building-o"></i> <span>Buildings</span></a></li>
                        <li><a href="<?php echo URL; ?>landlord/apartments"><i class="fa fa-building-o"></i> <span>Apartments</span></a></li>
                        <li><a href="<?php echo URL; ?>landlord/tenants"><i class="fa fa-users"></i> <span>Tenants</span></a></li>
                        <li><a href="<?php echo URL; ?>landlord/maintenanceRequests"><i class="fa fa-list"></i> <span>Maintenance Requests</span></a></li>
                        <li><a href="<?php echo URL; ?>landlord/changedApartments"><i class="fa fa-list"></i> <span>Changed Apartments</span></a></li>
                        <li><a href="<?php echo URL; ?>landlord/leaseContracts"><i class="fa fa-list"></i> <span>Lease Contracts</span></a></li>
                        <li><a href="<?php echo URL; ?>landlord/renewedContracts"><i class="fa fa-list"></i> <span>Renewals</span></a></li>
                        <!--<li><a href="<?php echo URL; ?>landlord/"><i class="fa fa-money"></i> <span>Payment</span></a></li>-->
                        <li><a href="<?php echo URL; ?>landlord/terminatedContracts"><i class="fa fa-list"></i> <span>Terminated Contracts</span></a></li>
                        <li><a href="<?php echo URL; ?>landlord/securityRefunds"><i class="fa fa-list"></i> <span>Security Refunds</span></a></li>
                        <li><a href="<?php echo URL; ?>landlord/maintenanceCategories"><i class="fa fa-list"></i> <span>Maintenance Categories</span></a></li>
                        <!--<li><a href=""><i class="fa fa-sign-out"></i> <span>Log out</span></a></li>-->
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <div class="content-wrapper">
