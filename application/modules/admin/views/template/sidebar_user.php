<?php
$tab = isset($tab) ? $tab : "";
$page = isset($page) ? $page : "";

$dashboard=$education = "";
$user_management = $users = $invigilator = "";
$company_management = $company = $up_company = $pre_company = "";
if ($tab == "dashboard") {
    $dashboard = "active";
}else if ($tab == "educations") {
    $education = "active";
}else if($tab=='user management')
{
    $user_management = "active";
    if ($page == "users") {
        $users = "active";
    } else if ($page == "invigilator") {
        $invigilator = "active";
    }
}else if($tab=="company_management")
{
    $company_management="active";
    if($page=="company")
    {
        $company="active";
    }
    else if ($page=="previous_company")
    {
        $pre_company="active";
    }
    else
    {
        $up_company="active";
    }
}
?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= ADMIN_ASSESTS ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?=$this->session->userdata("active_admin_data")['name']?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?= $dashboard ?>">
                <a href="<?= ADMIN_URL . "dashboard/index" ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview <?= $user_management ?>">
                <a href="#">
                    <i class="fa fa-user-circle-o"></i> <span>User Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= $users ?>"><a href="<?= ADMIN_URL . 'users/index' ?>"><i class="fa fa-circle-o"></i> Student Details</a></li>
                    <li class="<?= $invigilator ?>"><a href="<?= ADMIN_URL . 'users/invigilator' ?>"><i class="fa fa-circle-o"></i> Invigilator Details</a></li>
                </ul>
            </li>

            <li class="<?=$education?>">
                <a href="<?= ADMIN_URL . "education/index" ?>">
                    <i class="fa fa-user-o"></i> <span>Education</span>
                </a>
            </li>
            <li class="treeview <?= $company_management ?>">
                <a href="#">
                    <i class="fa fa-user-circle-o"></i> <span>Company Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= $company ?>"><a href="<?= ADMIN_URL . 'company/index' ?>"><i class="fa fa-circle-o"></i> Company Details</a></li>
                    <li class="<?= $pre_company ?>"><a href="<?= ADMIN_URL . 'company/previous' ?>"><i class="fa fa-circle-o"></i>Previously Company</a></li>
                    <li class="<?= $up_company ?>"><a href="<?= ADMIN_URL . 'company/upcoming' ?>"><i class="fa fa-circle-o"></i>Upcoming Company</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
