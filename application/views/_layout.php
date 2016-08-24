<?php $role = $this->session->userdata("role"); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?> - Stock Management Information System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/ionicons/css/ionicons.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/adminlte/css/AdminLTE.min.css'); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/adminlte/css/skins/_all-skins.min.css'); ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datepicker/datepicker3.css'); ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/plugins/adminlte/js/app.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/tinymce/tinymce.min.js'); ?>"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="../../index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>SMIS</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Stock</b> MIS</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo base_url('assets/images/user.png'); ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $this->session->userdata("name"); ?></span>
              </a>
              <ul class="dropdown-menu">
                <li>
                    <a href="#">Profile</a>
                </li>
                <li>
                    <a href="<?php echo base_url('account/logout'); ?>">Sign out</a>
                </li>
              </ul>
            </li>
            <li>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">MAIN NAVIGATION</li>
          <li class="treeview">
            <a href="<?php echo base_url("dashboard"); ?>">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          <?php if( $role == "Admin" || $role == "Matkes"){ ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-cube"></i>
              <span>Stock</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url("stock/add"); ?>"><i class="fa fa-circle-o"></i> Add Stock</a></li>
              <li><a href="<?php echo base_url("stock/track"); ?>"><i class="fa fa-circle-o"></i> Track Stock</a></li>
              <li><a href="<?php echo base_url("stock"); ?>"><i class="fa fa-circle-o"></i> Stock List</a></li>
            </ul>
          </li>
          <?php } ?>
          <?php if( $role == "Admin" || $role == "Unit"){ ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-shopping-cart"></i>
              <span>Order</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Add Order</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Track Order</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Order List</a></li>
            </ul>
          </li>
          <?php } ?>
          <?php if( $role == "Admin"){ ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-flag"></i>
              <span>Report</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Order Report</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Stock Report</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-database"></i> <span>Master</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="#"><i class="fa fa-circle-o"></i> Item
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="<?php echo base_url("item/add"); ?>"><i class="fa fa-circle-o"></i> Add Item</a></li>
                  <li><a href="<?php echo base_url("item"); ?>"><i class="fa fa-circle-o"></i> Item List</a></li>
                </ul>
              </li>
              <li>
                <a href="#"><i class="fa fa-circle-o"></i> Unit
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="<?php echo base_url("unit/add"); ?>"><i class="fa fa-circle-o"></i> Add Unit</a></li>
                  <li><a href="<?php echo base_url("unit"); ?>"><i class="fa fa-circle-o"></i> Unit List</a></li>
                </ul>
              </li>
              <!--<li>
                <a href="#"><i class="fa fa-circle-o"></i> Supplier
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="#"><i class="fa fa-circle-o"></i> Add Supplier</a></li>
                  <li><a href="#"><i class="fa fa-circle-o"></i> Supplier List</a></li>
                </ul>
              </li>-->
              <li>
                <a href="#"><i class="fa fa-circle-o"></i> User
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="<?php echo base_url('user/add'); ?>"><i class="fa fa-circle-o"></i> Add User</a></li>
                  <li><a href="<?php echo base_url('user'); ?>"><i class="fa fa-circle-o"></i> User List</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <?php } ?>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <?php $this->load->view($view, $data); ?>
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
      </div>
      <strong>Copyright &copy; 2016 RS Bhayangkara Moestadjab Nganjuk.</strong> All rights
      reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- alert box -->
<div style="display:block;position:fixed;top:15px;right:15px;z-index:1000002;">
    <?php echo validation_errors('<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>', '</div>'); ?>
    <?php
        if(isset($message)){
            if($message != ""){
                ?>
                <div class="alert alert-<?php echo $messageType; ?> alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $message; ?>
                </div>
                <?php
            }
        }
        if($this->session->flashdata('message') != ""){
          ?>
          <div class="alert alert-<?php echo $this->session->flashdata('messageType'); ?> alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <?php echo $this->session->flashdata('message'); ?>
          </div>
          <?php
        }
    ?>
</div>
<script>
  $(function(){
      tinymce.init({
          selector: 'textarea',
          selector: 'textarea',
          plugins: [
              'advlist autolink lists link image charmap print preview anchor',
              'searchreplace visualblocks code fullscreen',
              'insertdatetime media table contextmenu paste code'
          ],
          //toolbar: false,
          menubar: 'tools'
      });
  });
</script>
</body>
</html>