<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>R</b>SP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Sis</b>Rekomendasi</span>
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
              <!-- <img src="<?= base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
              <img src="<?= base_url();?>assets/images/avatar.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?= $_SESSION['nama'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?= base_url();?>assets/images/avatar.png" class="img-circle" alt="User Image">

                <p>
                  <?= $_SESSION['nama'];?>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?= base_url();?>logout" class="btn btn-default btn-flat">Sign out</a>
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
          <img src="<?= base_url();?>assets/images/avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $_SESSION['nama'];?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->

      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="<?= base_url();?>"><i class="fa fa-cogs"></i> <span>Main</span></a></li>
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
        Rekomendasi Formasi
        <small>Bentuk Formasi</small>
      </h1>
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
                <h3>Gambar</h3>
              </div>
              <div class="box-body">
                <style media="screen">
                  table {
                    border: 1px solid black;
                    width: 100%;
                  }
                  td {
                    font-size: 20px;
                    text-align: center;
                    padding: 38px;
                    border-bottom: 1px solid black;
                    background-color: green;
                    color: white;
                  }
                  tr.atas {
                    height: 256px;
                  }
                  tr.bawah {
                    height: 472px;
                  }
                  td.tengah-bawah {
                    vertical-align: bottom;
                  }
                  td.tengah-atas {
                    vertical-align: top;
                  }
                  small.pemain {
                    font-size: 18;
                  }
                </style>
                <div class="row">
                  <div class="col-lg-7">
                    <table>
                      <tr class="atas">
                        <td class="tengah-bawah">
                          Wing Spiker <br> <small  id="w1" class="pemain"></small>
                        </td>
                        <td>Middle Blocker
                          <br> <small id="m" class="pemain"></small>
                        </td>
                        <td class="tengah-bawah">Wing Spiker
                          <br> <small id="w2" class="pemain"></small>
                        </td>
                      </tr>
                      <tr class="bawah">
                        <td >Universaler
                          <br> <small id="u" class="pemain"></small>
                        </td>
                        <td class="tengah-atas">Libero
                          <br> <small id="l" class="pemain"></small>
                        </td>
                        <td >Setter
                          <br> <small id="s" class="pemain"></small>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-3">
                    <h1>Informasi Pemain</h1>
                    <hr>
                    <!-- <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4>Nama: anu</h4>
                      </div>
                      <div class="panel-body">
                        <p>tinggi badan : 89cm</p>
                        <p>berat badan : 100kg</p>
                      </div>
                    </div> -->
                    <style media="screen">
                      div.isi {
                        border:1px solid red;padding:8px;border-radius:3px;margin:10px;
                      }
                      p {
                        font-size: 18px;
                        padding: 0px;
                        margin: 0px;
                      }
                      h3 {
                        padding: 0px;
                        margin: 1px;
                      }
                    </style>
                    <!-- <div class="isi">
                      <h3>Nama : anu</h3>
                      <p>Tinggi Badan : 90cm</p>
                      <p>Berat Badan : 100kg</p>
                    </div> -->
                    <div id="pemains">

                    </div>
                  </div>
                </div>
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
      Made with CodeIgniter
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?= date('Y');?> <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<?php if (!empty($modal)): ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="modal_welcome">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Modal</h3>
        </div> -->
        <div class="modal-body">
          <h4>Selamat datang <b><?= $_SESSION['nama'];?></b> di web aplikasi <b>Rekomendasi Spesialisasi Pemain Bola Voli</b>.
            <br>Selamat menggunakan aplikasi ini. Kami harap Anda menikmatinya.
          </h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" name="button">Close</button>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
