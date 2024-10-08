<?= view("v_head.php")?>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?= base_url()?>" class="h1"><b>Proto</b>Type</a>
    </div>
    <div class="card-body">
        <?php if (!empty(session()->getFlashdata('error'))) : ?>
            <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
            </div> -->
            <p class="login-box-msg">
                <?php echo session()->getFlashdata('error'); ?>
            </p>
        <?php endif; ?>

      <form method="post" action="<?= base_url(); ?>/login/process">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Ingat saya
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="<?= base_url()?>/lupapassword">Lupa password</a>
      </p>
      <p class="mb-0">
        <a href="<?= base_url()?>/register" class="text-center">Registrasi</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
<?= view("v_footer.php")?>
</body>
</html>
