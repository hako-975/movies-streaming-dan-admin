<?php 
  require 'koneksi.php';
  $id_film = $_GET['id_film'];
  $genre = mysqli_query($koneksi, "SELECT * FROM tb_genre ORDER BY nama_genre ASC LIMIT 0, 5");
  $film = mysqli_query($koneksi, "SELECT * FROM tb_film INNER JOIN tb_genre ON tb_film.id_genre = tb_genre.id_genre WHERE tb_film.id_film = '$id_film'");
  $komentar = mysqli_query($koneksi, "SELECT * FROM tb_komentar INNER JOIN tb_film ON tb_komentar.id_film = tb_film.id_film WHERE tb_komentar.id_film = '$id_film' ORDER BY tanggal_komentar DESC");
  $detail_film = mysqli_fetch_assoc($film);

  if (isset($_POST['btnTambahKomentar'])) {
    if (tambahKomentar($_POST) > 0) {
      setAlert("Berhasil dikirim", "Komentar berhasil dikirim", "success");
      header("Location: detail_film.php?id_film=$id_film");
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <?php include 'include/css.php'; ?>
  <title>Detail Film: <?= $detail_film['nama_film']; ?></title>
</head>
<body style="background-image: url(assets/img/img_properties/bg-landing.jpg); background-size: cover; background-attachment: fixed;">
  <?php include 'include/navbar.php'; ?>

  <div class="container px-4 rounded-bottom bg-dark">
    <div class="row mb-3 justify-content-center">
      <div class="col-lg">
        <h3>Watching: <?= $detail_film['nama_film']; ?></h3>
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/7iZ3TjJxVp4?rel=0" allowfullscreen></iframe>
        </div>
      </div>
    </div>
    <div class="row my-2">
      <div class="col-lg">
        <div class="row my-2">
          <div class="col-lg">
            <h3>Title: <?= $detail_film['nama_film']; ?></h3>
          </div>
          <div class="col-lg-5">
            <h4 class="text-right">
              Share: 
              <a href="" class="mx-2"><i class="fas fa-fw fa-share"></i></a>
              <a href="" class="mx-2"><i class="fab fa-fw fa-facebook"></i></a>
              <a href="" class="mx-2"><i class="fab fa-fw fa-instagram"></i></a>
              <a href="" class="mx-2"><i class="fab fa-fw fa-twitter"></i></a>
              <a href="" class="mx-2"><i class="fab fa-fw fa-linkedin"></i></a>
              <a href="" class="mx-2"><i class="fas fa-fw fa-envelope"></i></a>
              <a href="" class="mx-2"><i class="fab fa-fw fa-snapchat"></i></a>
            </h4>
          </div>
        </div>
        <h4>Synopsis</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae eum veniam nesciunt modi dolores vero expedita libero eligendi nam illum, temporibus nostrum maxime sapiente, impedit, praesentium sunt fugit iusto enim.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, provident, doloremque? Id iure nesciunt eos earum, iusto quibusdam temporibus magni inventore omnis esse necessitatibus tempore voluptatibus quod, quae, culpa maiores voluptatem quia, soluta accusantium odio consequuntur eaque corporis. Reiciendis expedita, odio atque aperiam cum sunt, maiores culpa voluptatum praesentium dicta.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, similique dignissimos. Beatae corrupti eligendi, provident eveniet quia accusamus ducimus iusto adipisci saepe perferendis reiciendis! Deleniti itaque et temporibus, qui amet! Vel quam perferendis quidem, iusto hic excepturi nulla commodi vitae ea quibusdam rem!</p>
      </div>
    </div>
    <div class="row my-2">
      <div class="col-lg-6 my-2">
        <h3>Comments</h3>
        <form method="post">
          <input type="hidden" name="id_film" value="<?= $id_film; ?>">
          <div class="form-group">
            <label for="nama_komentar">Nama Komentar</label>
            <input type="text" name="nama_komentar" class="form-control" id="nama_komentar" required placeholder="Anonymous">
          </div>
          <div class="form-group">
            <label for="isi_komentar">Isi Komentar</label>
            <textarea name="isi_komentar" id="isi_komentar" class="form-control" name="isi_komentar" required placeholder="Something great"></textarea>
          </div>
          <div class="form-group">
            <button type="submit" name="btnTambahKomentar" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Send</button>
          </div>
        </form>
      </div>
      <div style="max-height: 275px; overflow-y: auto;" class="col-lg-6 my-2 text-dark">
        <?php foreach ($komentar as $dk): ?>
          <?php if ($komentar == NULL): ?>
            <h3 class="text-white">There are no comments yet</h3>
          <?php endif ?>
          <div class="card">
            <div class="card-body">
              <h5><?= $dk['nama_komentar']; ?></h5>
              <p class="card-text"><?= $dk['isi_komentar']; ?></p>
              <small class="text-muted float-right"><?= date("d-m-Y, H:i:s", $dk['tanggal_komentar']); ?></small>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </div>

  <div class="container-fluid bg-white p-3">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg p-2 my-2">
          <h3>Social Media</h3>
          <a href="" class="mx-2"><i class="fab fa-2x fa-facebook"></i></a>
          <a href="" class="mx-2"><i class="fab fa-2x fa-instagram"></i></a>
          <a href="" class="mx-2"><i class="fab fa-2x fa-twitter"></i></a>
          <a href="" class="mx-2"><i class="fab fa-2x fa-linkedin"></i></a>
          <a href="" class="mx-2"><i class="fas fa-2x fa-envelope"></i></a>
          <a href="" class="mx-2"><i class="fab fa-2x fa-snapchat"></i></a>
        </div>
        <div class="col-lg p-2 my-2">
          <h3>Newsletter</h3>
          <h6>Subscribe to us so that only you know the latest information</h6>
          <h6 class="text-muted">What are you waiting for!</h6>
          <form method="post">
            <div class="input-group mb-3">
              <input type="email" name="email" class="form-control" placeholder="Your Email" aria-label="Your Email" aria-describedby="email-button">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="email-button"><i class="fas fa-fw fa-paper-plane"></i> Send</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg p-2 my-2">
          <h3>Our cool things</h3>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><a href="admin/login.php">Admin Room's</a></li>
            <li class="list-group-item"><a href="#">Terms and Conditions</a></li>
            <li class="list-group-item"><a href="#">Privacy Policy</a></li>
          </ul>
        </div>
      </div>
      <div class="row my-2">
        <div class="col-lg my-2 text-center">
          <p>&copy; Copyright 2020 by Andri</p>
        </div>
      </div>
    </div>
  </div>
<?php include 'include/js.php'; ?>
</body>
</html>
