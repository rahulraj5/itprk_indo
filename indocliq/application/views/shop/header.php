<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo getWebOptionValue('site_title');?>| Dashboard</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="<?php echo base_url();?>backend_assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url();?>backend_assets/bower_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.css">
<!-- Ionicons -->
<link rel="stylesheet" href="<?php echo base_url();?>backend_assets/bower_components/Ionicons/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url();?>backend_assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url();?>backend_assets/dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins  
       folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="<?php echo base_url();?>backend_assets/dist/css/skins/_all-skins.min.css">
<!-- Morris chart -->
<link rel="stylesheet" href="<?php echo base_url();?>backend_assets/bower_components/morris.js/morris.css">
<!-- jvectormap -->
<link rel="stylesheet" href="<?php echo base_url();?>backend_assets/bower_components/jvectormap/jquery-jvectormap.css">
<!-- Date Picker -->
<link rel="stylesheet" href="<?php echo base_url();?>backend_assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?php echo base_url();?>backend_assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?php echo base_url();?>backend_assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- jQuery 3 -->
<script src="<?php echo base_url();?>backend_assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url();?>backend_assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>backend_assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- bootstrap-notify -->
<script src="<?php echo base_url();?>backend_assets/dist/js/bootstrap-notify.js"></script>
<script src="<?php echo base_url();?>backend_assets/dist/js/nicEdit-latest.js"></script>
<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";
</script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<!-- Google Font -->
<style type="text/css">
    .skin-blue .main-header .navbar {
      background-color: #840512 !important;
    }
    .skin-blue .main-header .logo {
      background-color: #840512 !important;
    }
    .skin-blue .main-header .navbar .sidebar-toggle:hover {
          background: rgba(0,0,0,0.1);
    }
    .skin-blue .sidebar-menu>li.active>a {
      border-left-color: #840512 !important;
    }
    .p10{
      padding : 10px;
    }
</style>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<?php  $session_userdata = $this->session->userdata(SHOP_SESSION); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<header class="main-header">
  <!-- Logo -->
  <a href="<?php echo base_url();?>admin" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>ES</b></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><img src="<?php echo base_url().'uploads/'. getWebOptionValue('backlogo');?>" alt="<?php echo  getWebOptionValue('site_title');?>"></span> </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> <span class="sr-only">Toggle navigation</span> </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="<?php echo base_url();?>backend_assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> <span class="hidden-xs"><?php echo (isset($session_userdata) && !empty($session_userdata) ?$session_userdata['owner_name'] .'('. $session_userdata['shop_reg_id'] .')': '');?></span> </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li> <a href="<?php echo base_url();?>shop/profile" class="btn btn-default btn-flat" style="width:100%;"><i class="fa fa-user"></i> My Profile</a> </li>
            <li> <a href="<?php echo base_url();?>shop/changePassword" class="btn btn-default btn-flat" style="width:100%;"><i class="fa fa-key"></i> change Password</a> </li>
            <li> <a href="<?php echo base_url();?>shop/logout" class="btn btn-default btn-flat" style="width:100%;"><i class="fa fa-sign-out"></i> Sign out</a> </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <style type="text/css">
   @media (max-width: 767px){
    .skin-blue .main-header .navbar .dropdown-menu li a{
        color: #000 !important;
    }
  }
  @media (max-width: 991px){
        .navbar-custom-menu>.navbar-nav>li>.dropdown-menu {
        background: #eee !important;
    }
  }
  .skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a, .skin-blue .sidebar-menu>li.menu-open>a {
      color: #fff;
      background: #005551 !important ;
  }
  </style>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header" style="color: #fff"><?php echo (isset($session_userdata) && !empty($session_userdata) ?$session_userdata['owner_name'] . ' ('. $session_userdata['shop_reg_id'] .')': '');?></li>
      <li class="<?php echo (checkTabActive(array("index"))) ? "active" : ""; ?>"> <a href="<?php echo base_url();?>shop"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a> </li>
      <li class="<?php echo (checkTabActive(array("profile"))) ? "active" : ""; ?>"> <a href="<?php echo base_url();?>shop/profile"><i class="fa fa-user"></i> <span>Edit Profile</span></a> </li>
      <li class="<?php echo (checkTabActive(array("shopdetail"))) ? "active" : ""; ?>"> <a href="<?php echo base_url();?>shop/shopdetail"><i class="fa fa-user"></i> <span>Vendor Details</span></a> </li>
      
      <li class="<?php echo (checkTabActive(array("productlist","addproduct"))) ? "active" : ""; ?>"> <a href="<?php echo base_url();?>shop/productlist"><i class="fa fa-cart-arrow-down"></i> <span>Products</span></a> </li>
      <li class="<?php echo (checkTabActive(array("neworders"))) ? "active" : ""; ?>"> <a href="<?php echo base_url();?>shop/neworders"><i class="fa fa-cart-arrow-down"></i> <span>New Orders</span></a> </li>
      <li class="<?php echo (checkTabActive(array("orderhistory"))) ? "active" : ""; ?>"> <a href="<?php echo base_url();?>shop/orderhistory"><i class="fa fa-cart-arrow-down"></i> <span>Order History</span></a> </li>
      <li class="<?php echo (checkTabActive(array("chat"))) ? "active" : ""; ?>"> <a href="<?php echo base_url();?>shop/support_ticket"><i class="fa fa-comment"></i> <span>Support Chat</span></a> </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
