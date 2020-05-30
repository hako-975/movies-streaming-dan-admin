<?php 
	require '../koneksi.php';
	$id_film = $_GET['id_film'];
	$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_film WHERE id_film = '$id_film'"));
	$nama_film = ucwords($data['nama_film']);
	if (isset($id_film)) {
		if (hapusFilm($id_film) > 0) {
			setAlert("Berhasil dihapus", "Film $nama_film berhasil dihapus", "success");
      		header("Location: film.php");
		}
	}