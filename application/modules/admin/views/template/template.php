<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?=$page_title?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?= ADMIN_ASSESTS ?>bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= ADMIN_ASSESTS ?>font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?= ADMIN_ASSESTS ?>Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= ADMIN_ASSESTS ?>dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?= ADMIN_ASSESTS ?>dist/css/skins/_all-skins.min.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="<?= ADMIN_ASSESTS ?>morris.js/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="<?= ADMIN_ASSESTS ?>jvectormap/jquery-jvectormap.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="<?= ADMIN_ASSESTS ?>bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?= ADMIN_ASSESTS ?>bootstrap-daterangepicker/daterangepicker.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="<?= ADMIN_ASSESTS ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

        <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="<?= ADMIN_ASSESTS ?>js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf8" src="<?= ADMIN_ASSESTS ?>js/dataTables.buttons.min.js"></script>
<!--        <script type="text/javascript" charset="utf8" src="<?= ADMIN_ASSESTS ?>js/buttons.flash.min.js"></script>
        <script type="text/javascript" charset="utf8" src="<?= ADMIN_ASSESTS ?>js/jszip.min.js"></script>
        <script type="text/javascript" charset="utf8" src="<?= ADMIN_ASSESTS ?>js/pdfmake.min.js"></script>
        <script type="text/javascript" charset="utf8" src="<?= ADMIN_ASSESTS ?>js/vfs_fonts.js"></script>
        <script type="text/javascript" charset="utf8" src="<?= ADMIN_ASSESTS ?>js/buttons.html5.min.js"></script>
        <script type="text/javascript" charset="utf8" src="<?= ADMIN_ASSESTS ?>js/buttons.print.min.js"></script>-->

        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="index2.html" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b><?=PROJECT_NICK_NAME?></b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b><?=PROJECT_NAME?></b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?= ADMIN_ASSESTS ?>dist/img/user2-160x160.jpg" class="user-image"
                                         alt="User Image">
                                    <span class="hidden-xs"><?= $this->session->userdata("active_admin_data")['name'] ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?= ADMIN_ASSESTS ?>dist/img/user2-160x160.jpg" class="img-circle"
                                             alt="User Image">

                                        <p>
                                            <?= $this->session->userdata("active_admin_data")['name'] ?>
                                            <small>Member since Nov. 2012</small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?= ADMIN_URL . "login/logout" ?>"
                                               class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <?php $this->load->view("sidebar_user");
            ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?php
                echo $page_data;
                ?>
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.4.0
                </div>
                <strong>Copyright &copy; 2014-2016 <a href="#"><?=PROJECT_NAME?></a>.</strong> All rights
                reserved.
            </footer>
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?= ADMIN_ASSESTS ?>jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?= ADMIN_ASSESTS ?>bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Morris.js charts -->
        <script src="<?= ADMIN_ASSESTS ?>raphael/raphael.min.js"></script>
        <script src="<?= ADMIN_ASSESTS ?>morris.js/morris.min.js"></script>
        <!-- Sparkline -->
        <script src="<?= ADMIN_ASSESTS ?>jquery-sparkline/dist/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="<?= ADMIN_ASSESTS ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?= ADMIN_ASSESTS ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?= ADMIN_ASSESTS ?>jquery-knob/dist/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="<?= ADMIN_ASSESTS ?>moment/min/moment.min.js"></script>
        <script src="<?= ADMIN_ASSESTS ?>bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="<?= ADMIN_ASSESTS ?>bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?= ADMIN_ASSESTS ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="<?= ADMIN_ASSESTS ?>jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="<?= ADMIN_ASSESTS ?>fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= ADMIN_ASSESTS ?>dist/js/adminlte.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <!--<script src="--><?//= ADMIN_ASSESTS ?><!--dist/js/pages/dashboard.js"></script>-->
        <!-- AdminLTE for demo purposes -->
        <script src="<?= ADMIN_ASSESTS ?>dist/js/demo.js"></script>

        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <?php
        echo $javascript;
        ?>
    </body>
</html>
