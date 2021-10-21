
<?= view('panel/v_head.php')?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?= view('panel/v_menu.php')?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registerwizard Card</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url()?>/panel/registerwizard">Registerwizard</a></li>
              <li class="breadcrumb-item active">Card</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="row" style="padding:5px;">
                <div class="col-10"></div>
                <div class="col-1"><a href="<?= base_url()."/panel/registerwizard/delete/".$id?>"><button type="button" class="btn btn-block btn-danger"><i class="fas fa-trash"></i></button></a></div>
                <div class="col-1"><a href="<?= base_url()."/panel/registerwizard/card/0"?>"><button type="button" class="btn btn-block btn-primary"><i class="fas fa-plus"></i></button></a></div>
              </div>
              <div class="card-body">
                <form method="post" action="<?= base_url(); ?>/panel/registerwizard/save/<?= $id?>" enctype="multipart/form-data">
                    <img id="blah" src="<?php if($data['bukti_pembayaran'] == ""){ echo "https://www.tutsmake.com/wp-content/uploads/2019/01/no-image-tut.png"; }else { echo base_url()."/uploads/bukti_pembayaran/".$data['bukti_pembayaran']; } ?>" class="" width="200" height="150"/>
                    <div class="form-group">
                      <label for="exampleInputEmail1">ID Member</label>
                      <input readonly type="text" class="form-control" name="id_member" id="id_member" placeholder="ID Member" value=<?= $data['id_member']?>>
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectBorder">Status</label>
                      <select class="custom-select form-control-border" id="status" name="status">
                        <option value="Menunggu Pembayaran" <?php if($data['status'] == "Menunggu Pembayaran"){ echo "selected"; } else { echo "";}?>>Menunggu Pembayaran</option>
                        <option value="Proses" <?php if($data['status'] == "Proses"){ echo "selected"; } else { echo "";}?>>Proses</option>
                        <option value="OK" <?php if($data['status'] == "OK"){ echo "selected"; } else { echo "";}?>>OK</option>
                      </select>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer" style="background:white">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?= view('panel/v_footer.php')?>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": false, "lengthChange": true, "autoWidth": true,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
</script>
</body>
</html>
