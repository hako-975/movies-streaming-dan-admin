<?php 
  require '../koneksi.php';
  checkLogin();
  $komentar = mysqli_query($koneksi, "SELECT * FROM tb_komentar INNER JOIN tb_film ON tb_komentar.id_film = tb_film.id_film ORDER BY tanggal_komentar DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../include_admin/css.php'; ?>
  <title>Komentar</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  
  <?php include '../include_admin/navbar.php'; ?>

  <?php include '../include_admin/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm">
            <h1 class="m-0 text-dark">Komentar</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row my-2">
          <div class="col-lg">
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped" id="table_id">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Komentar</th>
                    <th>Isi Komentar</th>
                    <th>Tanggal Komentar</th>
                    <th>Nama Film</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($komentar as $dk): ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $dk['nama_komentar']; ?></td>
                      <td><?= $dk['isi_komentar']; ?></td>
                      <td><?= date('d-m-Y, H:i:s', $dk['tanggal_komentar']); ?></td>
                      <td><?= $dk['nama_film']; ?></td>
                      <td>
                        <a href="hapus_komentar.php?id_komentar=<?= $dk['id_komentar']; ?>" class="btn btn-danger btn-sm btn-hapus" data-nama="Komentar: <?= $dk['nama_komentar']; ?> | <?= $dk['isi_komentar']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 By Andri Firman Saputra.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

</div>
<!-- ./wrapper -->
</body>
</html>
