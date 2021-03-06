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
                  <a href="<?= base_url();?>logout" class="btn btn-default btn-flat">Log out</a>
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
        <li class="active"><a href="javascript:;"><i class="fa fa-cogs"></i> <span>Main</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
      <h1>
        Main Menu
        <small>Perhitungan rekomendasi</small>
      </h1>
    </section> -->

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li id="c_target" class="active"> <a href="#target" data-toggle="tab">Nilai Standar</a> </li>
            <li id="c_form"> <a href="#form" data-toggle="tab">Form Pemain</a> </li>
            <li id="c_table"> <a href="#table" id="klik" data-toggle="tab">Tabel Hasil</a> </li>
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="target">
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
                        <?php if ($_SESSION['level']==1): ?>
                          <div class="row">
                            <div class="col-md-3 col-md-offset-5">
                              <button type="button" onclick="window.location.reload()" class="btn  btn-danger" name="reset">Batal</button>
                              <button type="submit" class="btn  btn-success" name="button">Update</button>
                            </div>
                          </div>
                        <?php endif; ?>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="form">
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
                                <label class="control-label">Nama</label>
                                <input required type="text" name="nama" class="form-control" value="">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-xs-8">
                                <label class="control-label">Tinggi Badan</label>
                                <input required type="number" name="tinggi_bdn" class="form-control" value="">
                                <small class="help-block">*Dalam centimeter</small>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <div class="col-xs-8">
                                <label class="control-label">Tanggal Lahir</label>
                                <input required type="date" name="lahir" class="form-control" value="">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-xs-8">
                                <label class="control-label">Berat Badan</label>
                                <input required type="number" name="berat_bdn" class="form-control" value="">
                                <small class="help-block">*Dalam kilogram</small>
                              </div>
                            </div>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <div class="col-xs-8">
                                <h4>Teknik Dasar</h4>
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
                            <button type="submit" class="btn btn-success" name="button">Simpan</button>
                            <button type="reset" class="btn btn-sm btn-danger" name="reset">Reset</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="table">
              <!-- disini untuk table -->
              <div class="row">
                <div class="col-lg-12">
                  <div class="box box-info">
                    <div class="box-header with-border">
                      <!-- <h3>Tabel Utama</h3> -->
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
                        <div class="col-xs-2">
                          <label class="control-label">Lihat Rekomendasi Formasi</label>
                          <a target="_blank" href="<?= base_url();?>formasi" type="button" class="btn btn-default" name="button">Lihat >>>>>></a>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modal_detail_pemain">
  <div class="modal-dialog " style="width:400px">
    <form class="" action="<?= base_url()?>main/update_info/" data-id="" id="form_update_info" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Detail Pemain</h3>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input required type="text" id="update_nama" class="form-control" name="nama" value="">
              </div>
              <div class="form-group">
                <label for="lahir">Tanggal Lahir</label>
                <input required type="date" name="lahir" id="update_lahir" class="form-control" value="">
              </div>
              <div class="form-group">
                <label for="umur">Umur</label>
                <input readonly type="number" id="update_umur" class="form-control" name="" value="">
              </div>
              <div class="form-group">
                <label for="tinggi_bdn">Tinggi Badan</label>
                <input required type="number" id="update_tinggi_bdn" class="form-control" name="tinggi_bdn" value="">
              </div>
              <div class="form-group">
                <label for="berat_bdn">Berat Badan</label>
                <input required type="number" id="update_berat_bdn" class="form-control" name="berat_bdn" value="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="button">Simpan</button>
          <button type="reset" class="btn btn-danger" data-dismiss="modal" name="reset_form_update">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal_detail_pemain_2">
  <div class="modal-dialog " style="width:400px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Detail Pemain</h3>
      </div>
      <div class="modal-body">
        <p id="text_detail_pemain"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" name="button">Close</button>
      </div>
    </div>
  </div>
</div>
