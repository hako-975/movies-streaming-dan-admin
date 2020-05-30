<?php 
	require '../koneksi.php';
	$id_komentar = $_GET['id_komentar'];
	$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_komentar WHERE id_komentar = '$id_komentar'"));
	$nama_komentar = ucwords($data['nama_komentar']);
	if (isset($id_komentar)) {
		if (hapusKomentar($id_komentar) > 0) {
			setAlert("Berhasil dihapus", "Komentar $nama_komentar berhasil dihapus", "success");
      		header("Location: komentar.php");
		}
	}