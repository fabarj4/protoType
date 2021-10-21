
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
            <h1>Kanal Card</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url()?>/panel/kanal">Kanal</a></li>
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
                <div class="col-1"><a href="<?= base_url()."/panel/kanal/delete/".$id?>"><button type="button" class="btn btn-block btn-danger"><i class="fas fa-trash"></i></button></a></div>
                <div class="col-1"><a href="<?= base_url()."/panel/kanal/card/0"?>"><button type="button" class="btn btn-block btn-primary"><i class="fas fa-plus"></i></button></a></div>
              </div>
              <div class="card-body">
                <form method="post" action="<?= base_url(); ?>/panel/kanal/save/<?= $id?>">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Kanal</label>
                      <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Kanal" value=<?= $data['nama']?>>
                    </div>
                    <div class="form-group">
                      <label>Keterangan</label>
                      <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan"><?= $data['keterangan']?></textarea>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" name="status" id="status" <?php if($data['status']){echo 'checked';}?> >
                        <label class="custom-control-label" for="status">Status Nonaktif/Aktif</label>
                      </div>
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
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="row" style="padding:5px;">
                <div class="col-11"></div>
                <div class="col-1"><a href="<?= base_url()."/panel/datakanal/card/0?id_kanal=".$id?>"><button type="button" class="btn btn-block btn-primary"><i class="fas fa-plus"></i></button></a></div>
              </div>
              <div class="card-header">
                <h3 class="card-title">Data Kanal</h3>
              </div>
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama File</th>
                      <th>Caption</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;foreach ($kanal_data as $key => $item) {?>
                    <tr>
                      <td><?= $i?></td>
                      <td><?= $item['judul']?></td>
                      <td><?= $item['caption']?></td>
                      <td>
                        <div class="btn-group">
                          <a href="<?= base_url()."/panel/datakanal/card/".$item['id']."?id_kanal=".$id?>">
                            <button type="button" class="btn btn-default">
                              <i class="fas fa-edit"></i>
                            </button>
                          </a>
                          <a href="<?= base_url()."/panel/datakanal/delete/".$item['id']?>?from=list&id_kanal=<?= $id?>">
                            <button type="button" class="btn btn-default">
                              <i class="fas fa-trash"></i>
                            </button>
                          </a>
                        </div>
                      </td>
                    </tr>
                    <?php $i++;}?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nama File</th>
                      <th>Caption</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
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
      "order": [[ 0, "desc" ]],
    });
  });
</script>
</body>
</html>
