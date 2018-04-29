<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ciha Skripsi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="<?= base_url();?>assets/dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="skin-blue sidebar-mini sidebar-collapse" style="height: auto; min-height: 100%;">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?= base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?= base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
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

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="javascript:;"><i class="fa fa-link"></i> <span>Main</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Page Header
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div class="row">
          <div class="col-lg-12">
            <div class="box box-info">
              <div class="box-header with-border">
                <h1>Nilai tidak boleh lebih dari atau kurang dari 5</h1>
              </div>
              <form class="form" role="form" action="<?= base_url('main/create_nilai');?>" name="form_nilai" method="post">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="col-xs-8">
                          <label class="control-label">Pengukuran</label>
                          <select required class="form-control" name="flag_untuk">
                            <?php foreach ($pengukuran as $v): ?>
                              <option value="<?= $v->id;?>"><?= $v->nama_flag;?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-8">
                          <label class="control-label">Nama</label>
                          <input required type="text" name="nama" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-8">
                          <label class="control-label">Posisi Awal</label>
                          <input required type="text" name="posisi_awal" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-8">
                          <label class="control-label">Passing</label>
                          <input required type="number" name="passing" class="form-control nilai" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-8">
                          <label class="control-label">Servis</label>
                          <input required type="number" name="servis" class="form-control nilai" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-8">
                          <label class="control-label">Block</label>
                          <input required type="number" name="block" class="form-control nilai" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-8">
                          <label class="control-label">Smash</label>
                          <input required type="number" name="smash" class="form-control nilai" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-8">
                          <label class="control-label">Receive</label>
                          <input required type="number" name="receive" class="form-control nilai" value="">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="col-xs-8">
                          <label class="control-label">Kekuatan</label>
                          <input required type="number" name="kekuatan" class="form-control nilai" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-8">
                          <label class="control-label">Kelincahan</label>
                          <input required type="number" name="kelincahan" class="form-control nilai" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-8">
                          <label class="control-label">Daya Lentur</label>
                          <input required type="number" name="daya_lentur" class="form-control nilai" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-8">
                          <label class="control-label">Daya Ledak Otot</label>
                          <input required type="number" name="daya_ledak_otot" class="form-control nilai" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-8">
                          <label class="control-label">Daya Tahan</label>
                          <input required type="number" name="daya_tahan" class="form-control nilai" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-8">
                          <label class="control-label">Kecepatan</label>
                          <input required type="number" name="kecepatan" class="form-control nilai" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-8">
                          <label class="control-label">Servis</label>
                          <input required type="number" name="servis" class="form-control nilai" value="">
                        </div>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-lg-8 col-lg-offset-4">
                      <button type="reset" class="btn btn-sm btn-danger" name="reset">Reset</button>
                      <button type="submit" class="btn btn-success" name="button">Simpan</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- disini untuk table -->
        <div class="row">
          <div class="col-lg-12">
            <div class="box box-info">
              <div class="box-header with-border">
                <h2 class="box-title">Tabel Utama</h2>
              </div>
              <div class="box-body">
                <br>
                <div id="isi_table" class="table_responsive">

                </div>
              </div>
              <div class="box-footer">

              </div>
            </div>
          </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?= base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url();?>assets/dist/js/adminlte.min.js"></script>
<script src="<?= base_url();?>javascript/main.js"></script>
<script src="<?= base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>
