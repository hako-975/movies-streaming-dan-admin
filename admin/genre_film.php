<?php 
  require '../koneksi.php';
  checkLogin();
  $genre = mysqli_query($koneksi, "SELECT * FROM tb_genre");
  // jika tombol ubah genre ditekan
  if (isset($_POST['btnUbahGenre'])) {
    if (ubahGenre($_POST) > 0) {
      setAlert("Berhasil diubah", "Genre berhasil diubah", "success");
      header("Location: genre_film.php");
    }
  }
  // jika tombol tambah genre ditekan
  if (isset($_POST['btnTambahGenre'])) {
    if (tambahGenre($_POST) > 0) {
      $nama_genre = htmlspecialchars(addslashes(ucwords($_POST['nama_genre'])));
      setAlert("Berhasil ditambahkan", "Genre $nama_genre berhasil ditambahkan", "success");
      header("Location: genre_film.php");
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../include_admin/css.php'; ?>
  <title>Genre Film</title>
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
            <h1 class="m-0 text-dark">Genre Film</h1>
          </div><!-- /.col -->
          <div class="col-sm text-right">
            <button type="button" data-toggle="modal" data-target="#tambahGenreModal" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Genre</button>
            <!-- Modal -->
            <div class="modal fade text-left" id="tambahGenreModal" tabindex="-1" role="dialog" aria-labelledby="tambahGenreModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="post">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="tambahGenreModalLabel">Tambah Genre</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="nama_genre">Nama Genre</label>
                        <input type="text" name="nama_genre" required class="form-control" id="nama_genre">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                      <button type="submit" name="btnTambahGenre" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg">
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped" id="table_id">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Genre</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($genre as $dg): ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $dg['nama_genre']; ?></td>
                      <td>
                        <button class="btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#ubahGenreModal<?= $dg['id_genre']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah</button>
                        <!-- Modal -->
                        <div class="modal fade" id="ubahGenreModal<?= $dg['id_genre']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahGenreModalLabel<?= $dg['id_genre']; ?>" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <form method="post">
                              <input type="hidden" name="id_genre" value="<?= $dg['id_genre']; ?>">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="ubahGenreModalLabel<?= $dg['id_genre']; ?>">Ubah Genre</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label for="nama_genre<?= $dg['id_genre']; ?>">Nama Genre</label>
                                    <input type="text" name="nama_genre" id="nama_genre<?= $dg['id_genre']; ?>" class="form-control" value="<?= $dg['nama_genre']; ?>" required>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                                  <button type="submit" name="btnUbahGenre" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                        <a href="hapus_genre_film.php?id_genre=<?= $dg['id_genre']; ?>" data-nama="Genre Film: <?= $dg['nama_genre']; ?>" class="btn-hapus btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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
