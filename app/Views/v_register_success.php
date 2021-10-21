<?= view("v_head.php")?>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?= base_url()?>" class="h1"><b>Proto</b>Type</a>
    </div>
    <div class="card-body">
      <?php if (!empty(session()->getFlashdata('success'))) : ?>
       <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
        </div> -->
        <p class="login-box-msg">
          <?php echo session()->getFlashdata('success'); ?>
        </p>
      <?php endif; ?>
      <p class="login-box-msg">
        Selamat akun anda telah berhasil dibuat
      </p>
      <p class="login-box-msg">
        Silakan melakukan pembayaran agar anda dapat melakukan sign-in
      </p>
      <h5 class="login-box-msg">
        pembayaran dapat dilakukan dengan cara melakukan transfer sebesar <?= $setup['harga']?> ke rekening <?= $setup['rekening']?> a/n <?= $setup['atas_nama']?>
      </h5>

      <p class="login-box-msg">
        Upload bukti pembayaran
      </p>

      <form method="post" action="<?= base_url(); ?>/register/upload/<?= $wizard['id']?>" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="mb-3">
          <label for="berkas" class="form-label">Berkas</label>
          <input type="file" class="form-control" id="berkas" name="berkas">
        </div>
        <div class="mb-3">
          <input type="submit" class="btn btn-info" value="Upload" />
        </div>
      </form>

      <a href="<?= base_url(); ?>/login" class="text-center">Sign-in klik disini</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<?= view("v_footer.php")?>
</body>
</html>
