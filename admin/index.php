<?php 
  require '../koneksi.php';
  checkLogin();
  $jumlah_film = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT count(id_film) as jumlah_film FROM tb_film"));
  $jumlah_film = $jumlah_film['jumlah_film'];

  $jumlah_genre = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT count(id_genre) as jumlah_genre FROM tb_genre"));
  $jumlah_genre = $jumlah_genre['jumlah_genre'];

  $jumlah_komentar = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT count(id_komentar) as jumlah_komentar FROM tb_komentar"));
  $jumlah_komentar = $jumlah_komentar['jumlah_komentar'];
?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../include_admin/css.php'; ?>
  <title>Dashboard</title>
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
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row my-2">
          <div class="col-lg-3">
            <div class="card">
              <div class="card-body">
                <h5><i class="fas fa-fw fa-theater-masks"></i> Genre Film</h5>
                <h6 class="mb-2 text-muted">Jumlah Genre: <?= $jumlah_genre; ?></h6>
                <a href="genre_film.php" class="card-link btn btn-primary"><i class="fas fa-fw fa-align-justify"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card">
              <div class="card-body">
                <h5><i class="fas fa-fw fa-film"></i> Film</h5>
                <h6 class="mb-2 text-muted">Jumlah Film: <?= $jumlah_film; ?></h6>
                <a href="film.php" class="card-link btn btn-primary"><i class="fas fa-fw fa-align-justify"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card">
              <div class="card-body">
                <h5><i class="fas fa-fw fa-comment"></i> Komentar</h5>
                <h6 class="mb-2 text-muted">Jumlah Komentar: <?= $jumlah_komentar; ?></h6>
                <a href="komentar.php" class="card-link btn btn-primary"><i class="fas fa-fw fa-align-justify"></i></a>
              </div>
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
