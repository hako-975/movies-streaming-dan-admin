<?php 
require 'koneksi.php';
$keyword = $_GET["keyword"];
$query = "SELECT * FROM tb_film
			WHERE
			nama_film LIKE '%$keyword%' OR
			tahun_film LIKE '%$keyword%' OR
			sutradara_film LIKE '%$keyword%'
      ORDER BY nama_film ASC";
$film = mysqli_query($koneksi, $query);

 ?>

<?php foreach ($film as $df): ?>
  <a href="detail_film.php?id_film=<?= $df['id_film']; ?>">
    <div class="row text-dark no-gutters">
      <div class="col-md-4">
        <img src="assets/img/img_films/<?= $df['cover_film']; ?>" class="card-img" alt="assets/img/img_films/<?= $df['cover_film']; ?>">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5><?= $df['nama_film']; ?></h5>
          <h6 class="text-muted"><?= $df['tahun_film']; ?></h6>
          <p class="card-text"><?= $df['sutradara_film']; ?></p>
          <p class="card-text"><small class="text-muted">Rating <span class="text-warning">&#9733;</span> <?= $df['rating_film']; ?></small></p>
        </div>
      </div>
    </div>
  </a>
<?php endforeach ?>
