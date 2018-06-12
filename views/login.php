<div style="margin-top:7%">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-lg-offset-4">
        <div class="panel panel-primary">
          <!-- <div class="panel-heading">
            <h3 class="panel-title">Login</h3>
          </div> -->
          <div class="panel-body">
            <form class="form-signing" action="<?=base_url();?>main/login_process" method="post">
              <img src="<?= base_url();?>assets/images/avatar.png" style="display: block;margin: 0 auto;width:100px;height:auto" alt="">
              <!-- <h2 class="form-signing-heading" style="text-align:center">Log In Panel</h2> -->
              <h4 class="form-signing-heading" style="text-align:center">Sistem Rekomendasi Spesialisasi Pemain Bola Voli</h4>
              <hr>
              <?php if (!empty($gagal)): ?>
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <?= $gagal;?>
                </div>
              <?php endif; ?>
              <div class="form-group">
                <label for="username" class="sr-only">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username" required autofocus value="">
              </div>
              <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required autofocus value="">
              </div>
              <div class="form-action">
                <button type="submit" class="btn btn-block btn-primary" name="button">Log In</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
