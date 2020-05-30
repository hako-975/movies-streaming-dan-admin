<?php
	include 'include_admin/js.php';
	include 'include/js.php';
	session_start();
	date_default_timezone_set('Asia/Jakarta');

	$server 	= "localhost";
	$user		= "root";
	$password	= "";
	$database	= "resensi_film_andri";
	
	$koneksi = mysqli_connect($server,$user,$password) or die("Koneksi Server Gagal!");
	$db = mysqli_select_db($koneksi, $database) or die("Gagal Pilih Database!");

// ====================== FUNCTION ======================
function setAlert($title='', $text='', $type='', $buttons='') {
	$_SESSION["alert"]["title"]		= $title;
	$_SESSION["alert"]["text"] 		= $text;
	$_SESSION["alert"]["type"] 		= $type;
	$_SESSION["alert"]["buttons"]	= $buttons; 
}

if (isset($_SESSION['alert'])) {
	$title 		= $_SESSION["alert"]["title"];
	$text 		= $_SESSION["alert"]["text"];
	$type 		= $_SESSION["alert"]["type"];
	$buttons	= $_SESSION["alert"]["buttons"];

	echo"
		<div id='msg' data-title='".$title."' data-type='".$type."' data-text='".$text."' data-buttons='".$buttons."'></div>
		<script>
			let title 		= $('#msg').data('title');
			let type 		= $('#msg').data('type');
			let text 		= $('#msg').data('text');
			let buttons		= $('#msg').data('buttons');

			if(text != '' && type != '' && title != '') {
				Swal.fire({
					title: title,
					text: text,
					icon: type,
				});
			}
		</script>
	";
	unset($_SESSION["alert"]);
}

function checkLogin() {
	if (!isset($_SESSION['id_user'])) {
		setAlert("Akses ditolak!", "Login terlebih dahulu!", "error");
		header('Location: login.php');
	} 
}

function checkLoginAtLogin() {
	if (isset($_SESSION['id_user'])) {
		setAlert("Anda sudah login!", "Selamat Datang!", "success");
		header('Location: index.php');
	}
}
// DATA USER
function dataUser() {
	global $koneksi;
	if (isset($_SESSION['id_user'])) {
		$id_user = $_SESSION['id_user'];
		return mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user = '$id_user'"));
	} else {
		echo "
		  <script>
		    document.location.href='logout.php'
		  </script>
		";
	}
}
// DATA USER

function ubahProfile($data) {
	global $koneksi;
	$id_user = $_SESSION['id_user'];
	$username = htmlspecialchars($data['username']);
	$nama_lengkap = htmlspecialchars(addslashes($data['nama_lengkap']));
	$photo_lama = htmlspecialchars($data['photo_lama']);
	if ($_FILES['photo_profile']['error'] === 4) {
		$photo_profile = $photo_lama;
	}else{
		$photo_profile = upload();
	}
	mysqli_query($koneksi, "UPDATE tb_user SET username = '$username', nama_lengkap = '$nama_lengkap', photo_profile = '$photo_profile' WHERE id_user = '$id_user'");
	riwayat($id_user, "Berhasil mengubah profile");
	return mysqli_affected_rows($koneksi);
}

function upload() {
	$nama_photo 	= $_FILES['photo_profile']['name'];
	$ukuran_photo 	= $_FILES['photo_profile']['size'];
	$error			= $_FILES['photo_profile']['error'];
	$tmp_name		= $_FILES['photo_profile']['tmp_name'];

	// cek aoakah mengupload photo
	if ($error === 4) {
		setAlert('Gagal mengubah photo', 'Pilih photo terlebih dahulu!', 'error');
		return false;
	}

	// cek ekstensi photo
	$ekstensi_photo_valid 	= ['jpg', 'jpeg', 'png', 'gif'];
	$ekstensi_photo 	  	=  explode('.', $nama_photo);
	$ekstensi_photo 	  	=  strtolower(end($ekstensi_photo));
	if (!in_array($ekstensi_photo, $ekstensi_photo_valid)) {
		setAlert('Gagal mengubah photo', 'Pilih photo yang berekstensi gambar!', 'error');
		return false;
	}

	// cek ukuran photo
	if ($ukuran_photo > 1000000) {
		setAlert('Gagal mengubah photo', 'Ukuran photo terlalu besar!', 'error');
		return false;
	}

	// generate random nama
	$nama_photo_baru = uniqid();
	$nama_photo_baru .= '.';
	$nama_photo_baru .= $ekstensi_photo;

	move_uploaded_file($tmp_name, '../assets/img/img_profiles/' . $nama_photo_baru);
	return $nama_photo_baru;
}

function ubahPassword($data) {
	global $koneksi;
	$id_user = $_SESSION['id_user'];
	$password_lama = htmlspecialchars($data['password_lama']); 
	$password_baru = htmlspecialchars($data['password_baru']); 
	$verifikasi_password_baru = htmlspecialchars($data['verifikasi_password_baru']); 
	// cek password lama sesuai dengan password pada database
	$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user = '$id_user'"));
	if (password_verify($password_lama, $data['password'])) {
		// cek password baru dengan verifikasi password baru
		if ($password_baru == $verifikasi_password_baru) {
			$password_baru = password_hash($password_baru, PASSWORD_DEFAULT);
			mysqli_query($koneksi, "UPDATE tb_user SET password = '$password_baru' WHERE id_user = '$id_user'");
			riwayat($id_user, "Berhasil mengubah password");
			return mysqli_affected_rows($koneksi);
		} else {
			setAlert('Gagal mengubah password', 'Password baru tidak sesuai dengan verifikasi password baru!', 'error');
			header('Location: profile.php');
		}
	} else {
		setAlert('Gagal mengubah password', 'Password lama tidak sesuai!', 'error');
		header('Location: profile.php');
	}
}

function riwayat($id_user, $tindakan) {
	global $koneksi;
	$tanggal = time();
	mysqli_query($koneksi, "INSERT INTO tb_riwayat VALUES ('', '$id_user', '$tindakan', '$tanggal')");
	return mysqli_affected_rows($koneksi);
}

function ubahGenre($data) {
	global $koneksi;
	$id_genre = htmlspecialchars($data['id_genre']);
	$nama_genre = htmlspecialchars(addslashes(ucwords($data['nama_genre'])));
	mysqli_query($koneksi, "UPDATE tb_genre SET nama_genre = '$nama_genre' WHERE id_genre = '$id_genre'");
	riwayat($_SESSION['id_user'], "Berhasil mengubah genre film $nama_genre");
	return mysqli_affected_rows($koneksi);
}

function tambahGenre($data) {
	global $koneksi;
	$nama_genre = htmlspecialchars(addslashes(ucwords($data['nama_genre'])));
	mysqli_query($koneksi, "INSERT INTO tb_genre VALUES('', '$nama_genre')");
	riwayat($_SESSION['id_user'], "Berhasil menambahkan genre film $nama_genre");
	return mysqli_affected_rows($koneksi);
}

function hapusGenre($id) {
	global $koneksi;
	$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_genre WHERE id_genre = '$id'"));
	$nama_genre = ucwords($data['nama_genre']);
	mysqli_query($koneksi, "DELETE FROM tb_genre WHERE id_genre = '$id'");
	riwayat($_SESSION['id_user'], "Berhasil menghapus genre film $nama_genre");
	return mysqli_affected_rows($koneksi);
}

function tambahFilm($data) {
	global $koneksi;
	$nama_film = htmlspecialchars(addslashes($data['nama_film']));
	$tahun_film = htmlspecialchars($data['tahun_film']);
	$sutradara_film = htmlspecialchars(addslashes(ucwords($data['sutradara_film'])));
	$cover_film = uploadFilm();
	$rating_film = htmlspecialchars($data['rating_film']);
	$tanggal_diposting = time();
	$id_genre = htmlspecialchars($data['id_genre']);
	$id_user = $_SESSION['id_user'];
	if (!$cover_film) {
		return false;
	}
	mysqli_query($koneksi, "INSERT INTO tb_film VALUES ('', '$nama_film', '$tahun_film', '$sutradara_film', '$cover_film', '$rating_film', '$tanggal_diposting', '$id_genre', '$id_user')");
	riwayat($id_user, "Berhasil menambahkan film $nama_film");
	return mysqli_affected_rows($koneksi);
}

function uploadFilm() {
	$nama_cover 	= $_FILES['cover_film']['name'];
	$ukuran_cover 	= $_FILES['cover_film']['size'];
	$error			= $_FILES['cover_film']['error'];
	$tmp_name		= $_FILES['cover_film']['tmp_name'];

	// cek aoakah mengupload cover
	if ($error === 4) {
		setAlert('Gagal mengubah cover', 'Pilih cover terlebih dahulu!', 'error');
		return false;
	}

	// cek ekstensi cover
	$ekstensi_cover_valid 	= ['jpg', 'jpeg', 'png', 'gif'];
	$ekstensi_cover 	  	=  explode('.', $nama_cover);
	$ekstensi_cover 	  	=  strtolower(end($ekstensi_cover));
	if (!in_array($ekstensi_cover, $ekstensi_cover_valid)) {
		setAlert('Gagal mengubah cover', 'Pilih cover yang berekstensi gambar!', 'error');
		return false;
	}

	// cek ukuran cover
	if ($ukuran_cover > 1000000) {
		setAlert('Gagal mengubah cover', 'Ukuran cover terlalu besar!', 'error');
		return false;
	}

	// generate random nama
	$nama_cover_baru = uniqid();
	$nama_cover_baru .= '.';
	$nama_cover_baru .= $ekstensi_cover;

	move_uploaded_file($tmp_name, '../assets/img/img_films/' . $nama_cover_baru);
	return $nama_cover_baru;
}

function hapusFilm($id) {
	global $koneksi;
	$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_film WHERE id_film = '$id'"));
	$nama_film = ucwords($data['nama_film']);
	mysqli_query($koneksi, "DELETE FROM tb_film WHERE id_film = '$id'");
	riwayat($_SESSION['id_user'], "Berhasil menghapus film $nama_genre");
	return mysqli_affected_rows($koneksi);
}

function ubahFilm($data) {
	global $koneksi;
	$id_film = htmlspecialchars($data['id_film']);
	$nama_film = htmlspecialchars(addslashes($data['nama_film']));
	$tahun_film = htmlspecialchars($data['tahun_film']);
	$sutradara_film = htmlspecialchars(addslashes(ucwords($data['sutradara_film'])));
	$rating_film = htmlspecialchars($data['rating_film']);
	$tanggal_diposting = time();
	$id_genre = htmlspecialchars($data['id_genre']);
	$id_user = $_SESSION['id_user'];
	$cover_film_lama = htmlspecialchars($data['cover_film_lama']);
	if ($_FILES['cover_film']['error'] === 4) {
		$cover_film = $cover_film_lama;
	} else {
		$cover_film = uploadFilm();
	}
	mysqli_query($koneksi, "UPDATE tb_film SET nama_film = '$nama_film', tahun_film = '$tahun_film', sutradara_film = '$sutradara_film', cover_film = '$cover_film', rating_film = '$rating_film', tanggal_diposting = '$tanggal_diposting', id_genre = '$id_genre', id_user = '$id_user' WHERE id_film = '$id_film'");
	riwayat($id_user, "Berhasil mengubah film $nama_film");
	return mysqli_affected_rows($koneksi);
}

function hapusKomentar($id) {
	global $koneksi;
	$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_komentar WHERE id_komentar = '$id'"));
	$nama_komentar = ucwords($data['nama_komentar']);
	$isi_komentar = ucwords($data['isi_komentar']);
	mysqli_query($koneksi, "DELETE FROM tb_komentar WHERE id_komentar = '$id'");
	riwayat($_SESSION['id_user'], "Berhasil menghapus komentar $nama_komentar | $isi_komentar");
	return mysqli_affected_rows($koneksi);
}

function tambahKomentar($data) {
	global $koneksi;
	$nama_komentar = htmlspecialchars(addslashes($data['nama_komentar']));
	$isi_komentar = htmlspecialchars(addslashes($data['isi_komentar']));
	$tanggal_komentar = time();
	$id_film = $data['id_film'];
	mysqli_query($koneksi, "INSERT INTO tb_komentar VALUES ('', '$nama_komentar', '$isi_komentar', '$tanggal_komentar', '$id_film')");
	return mysqli_affected_rows($koneksi);

}
