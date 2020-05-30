<?php 
  require '../koneksi.php';
  checkLogin();
  $film = mysqli_query($koneksi, "SELECT * FROM tb_film INNER JOIN tb_genre ON tb_film.id_genre = tb_genre.id_genre INNER JOIN tb_user ON tb_film.id_user = tb_user.id_user ORDER BY tb_film.nama_film ASC");
  $genre = mysqli_query($koneksi, "SELECT * FROM tb_genre ORDER BY nama_genre ASC");
  // jika tombol ubah film ditekan
  if (isset($_POST['btnUbahFilm'])) {
    if (ubahFilm($_POST) > 0) {
      setAlert("Berhasil diubah", "Film berhasil diubah", "success");
      header("Location: film.php");
    }
  }
  // jika tombol tambah film ditekan
  if (isset($_POST['btnTambahFilm'])) {
    if (tambahFilm($_POST) > 0) {
      $nama_film = htmlspecialchars(addslashes(ucwords($_POST['nama_film'])));
      setAlert("Berhasil ditambahkan", "Film $nama_film berhasil ditambahkan", "success");
      header("Location: film.php");
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../include_admin/css.php'; ?>
  <title>Daftar Film</title>
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
            <h1 class="m-0 text-dark">Daftar Film</h1>
          </div><!-- /.col -->
          <div class="col-sm text-right">
            <button type="button" data-toggle="modal" data-target="#tambahFilmModal" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Film</button>
            <!-- Modal -->
            <div class="modal fade text-left" id="tambahFilmModal" tabindex="-1" role="dialog" aria-labelledby="tambahFilmModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="post" enctype="multipart/form-data">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="tambahFilmModalLabel">Tambah Film</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group text-center">
                        <a href="../assets/img/img_films/default.png" class="enlarge" id="check_enlarge_photo">
                          <img src="../assets/img/img_films/default.png" class="img-profile rounded" id="check_photo" alt="cover film">
                        </a>
                        <div class="form-group">
                          <label for="photo">Cover Film</label>
                          <input type="file" name="cover_film" id="photo" class="btn btn-sm btn-primary form-control form-control-file" accept="image/*">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="nama_film">Nama Film</label>
                        <input type="text" name="nama_film" required class="form-control" id="nama_film">
                      </div>
                      <div class="form-group">
                        <label for="tahun_film">Tahun Film</label>
                        <input type="number" name="tahun_film" required class="form-control" id="tahun_film">
                      </div>
                      <div class="form-group">
                        <label for="sutradara_film">Sutradara Film</label>
                        <input type="text" name="sutradara_film" required class="form-control" id="sutradara_film">
                      </div>
                      <div class="form-group">
                        <label for="rating_film">Rating Film</label>
                        <input type="number" step="0.01" name="rating_film" required class="form-control" id="rating_film">
                      </div>
                      <div class="form-group">
                        <label for="id_genre">Nama Genre</label>
                        <select name="id_genre" id="id_genre" class="form-control">
                          <?php foreach ($genre as $dg): ?>
                            <option value="<?= $dg['id_genre']; ?>"><?= ucwords($dg['nama_genre']); ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                      <button type="submit" name="btnTambahFilm" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
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
                    <th>Cover Film</th>
                    <th>Nama Film</th>
                    <th>Tahun Film</th>
                    <th>Sutradara Film</th>
                    <th>Rating Film</th>
                    <th>Genre</th>
                    <th>Tanggal Diposting</th>
                    <th>Pemosting</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($film as $df): ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td>
                        <a href="../assets/img/img_films/<?= $df['cover_film']; ?>" class="enlarge">
                          <img class="img-list-cover" src="../assets/img/img_films/<?= $df['cover_film']; ?>" alt="<?= $df['cover_film']; ?>">
                        </a>
                      </td>
                      <td><?= $df['nama_film']; ?></td>
                      <td><?= $df['tahun_film']; ?></td>
                      <td><?= $df['sutradara_film']; ?></td>
                      <td><?= ucwords($df['rating_film']); ?></td>
                      <td><?= ucwords($df['nama_genre']); ?></td>
                      <td><?= date('d-m-Y, H:i:s', $df['tanggal_diposting']); ?></td>
                      <td><?= $df['username']; ?></td>
                      <td>
                        <button class="btn btn-sm m-1 text-center mx-auto btn-success" type="button" data-toggle="modal" data-target="#ubahFilmModal<?= $df['id_film']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah</button>
                        <!-- Modal -->
                        <div class="modal fade" id="ubahFilmModal<?= $df['id_film']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahFilmModalLabel<?= $df['id_film']; ?>" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <form method="post" enctype="multipart/form-data">
                              <input type="hidden" name="id_film" value="<?= $df['id_film']; ?>">
                              <input type="hidden" name="cover_film_lama" value="<?= $df['cover_film']; ?>">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="tambahFilmModalLabel">Ubah Film</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group text-center">
                                    <a href="../assets/img/img_films/<?= $df['cover_film']; ?>" class="enlarge check_enlarge_photo">
                                      <img src="../assets/img/img_films/<?= $df['cover_film']; ?>" class="img-profile rounded check_photo" alt="cover film">
                                    </a>
                                    <div class="form-group">
                                      <label for="cover_film<?= $df['id_film']; ?>">Cover Film</label>
                                      <input type="file" name="cover_film" id="cover_film<?= $df['id_film']; ?>" class="photo btn btn-sm btn-primary form-control form-control-file" accept="image/*">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="nama_film<?= $df['id_film']; ?>">Nama Film</label>
                                    <input type="text" name="nama_film" value="<?= $df['nama_film']; ?>" required class="form-control" id="nama_film<?= $df['id_film']; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="tahun_film<?= $df['id_film']; ?>">Tahun Film</label>
                                    <input type="number" name="tahun_film" value="<?= $df['tahun_film']; ?>" required class="form-control" id="tahun_film<?= $df['id_film']; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="sutradara_film<?= $df['id_film']; ?>">Sutradara Film</label>
                                    <input type="text" name="sutradara_film" value="<?= $df['sutradara_film']; ?>" required class="form-control" id="sutradara_film<?= $df['id_film']; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="rating_film<?= $df['id_film']; ?>">Rating Film</label>
                                    <input type="number" step="0.01" name="rating_film" value="<?= $df['rating_film']; ?>" required class="form-control" id="rating_film<?= $df['id_film']; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="id_genre<?= $df['id_film']; ?>">Nama Genre</label>
                                    <select name="id_genre" id="id_genre<?= $df['id_film']; ?>" class="form-control">
                                      <option value="<?= $df['id_genre']; ?>"><?= $df['nama_genre']; ?></option>
                                      <option disabled>---------</option>
                                      <?php foreach ($genre as $dg): ?>
                                        <option value="<?= $dg['id_genre']; ?>"><?= ucwords($dg['nama_genre']); ?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                                  <button type="submit" name="btnUbahFilm" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                        <a href="hapus_film.php?id_film=<?= $df['id_film']; ?>" data-nama="film Film: <?= $df['nama_film']; ?>" class="btn-hapus btn btn-sm m-1 text-center mx-auto btn-danger"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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
