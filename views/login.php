<div style="margin-top:10%">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-lg-offset-4">
        <div class="panel panel-primary">
          <!-- <div class="panel-heading">
            <h3 class="panel-title">Login</h3>
          </div> -->
          <div class="panel-body">
            <form class="form-signing" action="<?=base_url();?>main/login_process" method="post">
              <h2 class="form-signing-heading" style="text-align:center">Log In Panel</h2>
              <hr>
              <div class="form-group">
                <label for="username" class="sr-only">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username" required autofocus value="">
              </div>
              <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required autofocus value="">
              </div>
              <div class="form-action">
                <button type="submit" class="btn btn-block btn-primary" name="button">Masuk</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
