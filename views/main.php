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
              <span class="hidden-xs"><?= $_SESSION['nama'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?= base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

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
          <img src="<?= base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
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
        <li class="active"><a href="javascript:;"><i class="fa fa-cogs"></i> <span>Main</span></a></li>
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
        Main Menu
        <small>Perhitungan rekomendasi</small>
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
                <h3>Tabel nilai standar</h3>
              </div>
              <div class="box-body">
                <form id="target_form" action="<?= base_url();?>main/target_update" method="post">
                  <div class="table-responsive">
                    <table class="table table-hover table-stripped">
                      <thead>
                        <?php foreach ($target[0] as $key => $value): ?>
                          <?php if ($key=='id' || $key=='flag_untuk'): ?>
                            <?php continue; ?>
                          <?php endif; ?>
                          <th><?= $key;?></th>
                        <?php endforeach; ?>
                      </thead>
                      <tbody>
                        <?php for ($i=0; $i < sizeof($target); $i++) { ?>
                          <tr>
                            <?php $id=null; foreach ($target[$i] as $key => $value): ?>
                              <?php if ($key=='id'): ?>
                                <?php $id=$value; ?>
                              <?php endif; ?>
                              <?php if ($key=='id' || $key=='flag_untuk'): ?>
                                <?php continue; ?>
                              <?php endif; ?>
                              <?php if ($_SESSION['level']==1): ?>
                                <td> <input required <?= $key=='nama_spesialis' ? 'readonly' : '';?> class="form-control <?= $key=='nama_spesialis' ? '' : 'target';?>" style="height: 27px;width:<?= $key=='nama_spesialis' ? '120px' : '35px';?>;" type="text" name="target[<?=$i;?>][<?=$key;?>]" value="<?= $value;?>"> </td>
                              <?php else: ?>
                                <td><?= $value;?></td>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="row">
                    <div class="col-md-3 col-md-offset-5">
                      <button type="button" onclick="window.location.reload()" class="btn  btn-danger" name="reset">Batal</button>
                      <button type="submit" class="btn  btn-success" name="button">Update</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="box box-info">
              <div class="box-header with-border">
                <h3>Nilai hanya 0 sampai 5</h3>
              </div>
              <form class="form" role="form" action="<?= base_url('main/create_nilai');?>" name="form_nilai" method="post">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="col-xs-8">
                          <h4>Teknik Dasar</h4>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-8">
                          <label class="control-label">Nama</label>
                          <input required type="text" name="nama" class="form-control" value="">
                        </div>
                      </div>
                      <h3></h3>
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
                          <h4 class="control-label">Komponen Fisik</h4>
                        </div>
                      </div>
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
                <h3>Tabel Utama</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <form id="penilaian_form" action="<?= base_url();?>main/penilaian_update" method="post">
                      <div id="isi_table_p" class="table-responsive">

                      </div>
                      <div class="row">
                        <div class="col-md-3 col-md-offset-5">
                          <button type="button" onclick="window.location.reload()" class="btn  btn-danger" name="reset">Batal</button>
                          <button type="submit" class="btn  btn-success" name="button">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-xs-4">
                    <label class="control-label">Spesialisasi</label>
                    <select required class="form-control" name="flag_untuk">
                      <?php foreach ($pengukuran as $v): ?>
                        <option value="<?= $v->id;?>"><?= $v->nama_spesialis;?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div id="isi_table" class="table-responsive">

                    </div>
                  </div>
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
