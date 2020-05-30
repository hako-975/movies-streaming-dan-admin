<?php 
	require '../koneksi.php';
	$id_genre = $_GET['id_genre'];
	$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_genre WHERE id_genre = '$id_genre'"));
	$nama_genre = ucwords($data['nama_genre']);
	if (isset($id_genre)) {
		if (hapusGenre($id_genre) > 0) {
			setAlert("Berhasil dihapus", "Genre $nama_genre berhasil dihapus", "success");
      		header("Location: genre_film.php");
		}
	}