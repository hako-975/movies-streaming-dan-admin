<?php 
  require '../koneksi.php';
  checkLogin();
  $dataUser = dataUser();
  // Jika tombol ubah profile ditekan
  if (isset($_POST['btnUbahProfile'])) {
    if (ubahProfile($_POST) > 0) {
      setAlert("Berhasil diubah", "Profile berhasil diubah", "success");
      header("Location: profile.php");
    }
  }
  // jika tombol ubah password ditekan
  if (isset($_POST['btnUbahPassword'])) {
    if (ubahPassword($_POST) > 0) {
      setAlert("Berhasil diubah", "Password berhasil diubah", "success");
      header("Location: profile.php");
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../include_admin/css.php'; ?>
  <title>Profile - <?= $dataUser['username']; ?></title>
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
            <h1 class="m-0 text-dark">Profile - <?= $dataUser['username']; ?></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row my-2 justify-content-center">
          <div class="col-lg text-center">
            <a href="../assets/img/img_profiles/<?= $dataUser['photo_profile']; ?>" class="enlarge">
              <img src="../assets/img/img_profiles/<?= $dataUser['photo_profile']; ?>" class="img-profile rounded-pill" alt="<?= $dataUser['photo_profile']; ?>">
            </a>
          </div>
        </div>
        <div class="row my-2 justify-content-center">
          <div class="col-lg-6">
            <ul class="list-group">
              <li class="list-group-item">Username : <?= $dataUser['username']; ?></li>
              <li class="list-group-item">Nama Lengkap : <?= $dataUser['nama_lengkap']; ?></li>
              <li class="list-group-item">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ubahProfileModal"><i class="fas fa-fw fa-user-edit"></i> Ubah</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ubahPasswordModal"><i class="fas fa-fw fa-user-lock"></i> Ubah Password</button>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal -->
<div class="modal fade" id="ubahProfileModal" tabindex="-1" role="dialog" aria-labelledby="ubahProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" enctype="multipart/form-data">
      <input type="hidden" name="photo_lama" value="<?= $dataUser['photo_profile']; ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ubahProfileModalLabel"><i class="fas fa-fw fa-user-edit"></i> Ubah Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group text-center">
            <a href="../assets/img/img_profiles/<?= $dataUser['photo_profile']; ?>" class="enlarge" id="check_enlarge_photo">
              <img style="height: 200px; width: 200px;" src="../assets/img/img_profiles/<?= $dataUser['photo_profile']; ?>" class="img-profile rounded-circle" id="check_photo" alt="<?= $dataUser['photo_profile']; ?>">
            </a>
            <div class="form-group">
              <label for="photo">Photo Profile</label>
              <input type="file" name="photo_profile" id="photo" class="btn btn-sm btn-primary form-control form-control-file" accept="image/*">
            </div>
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="hidden" name="username" value="<?= $dataUser['username']; ?>">
            <input style="cursor: not-allowed;" type="text" id="username" disabled value="<?= $dataUser['username']; ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="nama_lengkap">nama_lengkap</label>
            <input required type="text" name="nama_lengkap" id="nama_lengkap" value="<?= $dataUser['nama_lengkap']; ?>" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
          <button type="submit" name="btnUbahProfile" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="ubahPasswordModal" tabindex="-1" role="dialog" aria-labelledby="ubahPasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ubahPasswordModalLabel"><i class="fas fa-fw fa-user-edit"></i> Ubah Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="password_lama">Password Lama</label>
            <input required type="password" name="password_lama" id="password_lama" class="form-control">
          </div>
          <div class="form-group">
            <label for="password_baru">Password Baru</label>
            <input required type="password" minlength="6" name="password_baru" id="password_baru" class="form-control">
          </div>
          <div class="form-group">
            <label for="verifikasi_password_baru">Verifikasi Password Baru</label>
            <input required type="password" minlength="6" name="verifikasi_password_baru" id="verifikasi_password_baru" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
          <button type="submit" name="btnUbahPassword" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

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
