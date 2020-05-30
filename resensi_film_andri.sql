-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Bulan Mei 2020 pada 18.45
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resensi_film_andri`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_film`
--

CREATE TABLE `tb_film` (
  `id_film` int(10) NOT NULL,
  `nama_film` varchar(100) NOT NULL,
  `tahun_film` int(4) NOT NULL,
  `sutradara_film` varchar(100) NOT NULL,
  `cover_film` text NOT NULL,
  `rating_film` float NOT NULL,
  `tanggal_diposting` int(11) NOT NULL,
  `id_genre` int(10) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_film`
--

INSERT INTO `tb_film` (`id_film`, `nama_film`, `tahun_film`, `sutradara_film`, `cover_film`, `rating_film`, `tanggal_diposting`, `id_genre`, `id_user`) VALUES
(1, 'Avenger', 2019, 'Anthony Russo dan Joe Russo', '08042020104652.png', 8.4, 1590495796, 1, 1),
(2, 'Mr. Beans Holiday', 2007, 'Steve Bendelack', '08042020154003.png', 6.4, 1590495796, 3, 1),
(3, 'Bean', 1997, 'Mel Smith', '08042020154348.png', 6.5, 1590495796, 2, 1),
(4, 'Spiderman: Far From Home', 2019, 'Jon Watts', '08042020154655.png', 7.5, 1590495796, 1, 1),
(5, 'Insidious', 2010, 'James Wan', '08042020155915.png', 6.8, 1590495796, 4, 1),
(6, 'Inspector Gadget', 1999, 'David Kellogg', '08042020160106.png', 4.1, 1590495796, 3, 1),
(7, 'The Conjuring', 2013, 'James Wan', '08042020160311.png', 7.5, 1590495796, 4, 1),
(8, 'Furious 7', 2015, 'James Wan', '08042020160519.png', 7.2, 1590495796, 1, 1),
(9, 'Batman v Superman: Dawn of Justice', 2016, 'Zack Snyder', '08042020160832.png', 6.5, 1590495796, 1, 1),
(10, 'Spies in Disguise', 2019, 'Nick Bruno dan Troy Quane', '08042020161132.png', 6.8, 1590495796, 5, 1),
(11, 'Cars', 2006, 'John Lasseter', '08042020161335.png', 7.1, 1590495796, 5, 1),
(12, 'Miracle in Cell No. 7', 2013, 'Hwan-kyung Lee', '08042020162415.png', 8.2, 1590495796, 6, 1),
(13, 'Titanic', 1997, 'James Cameron', '08042020163414.png', 7.8, 1590495796, 6, 1),
(14, 'Sonic the Hedgehog', 2020, 'Jeff Fowler', '08042020173537.png', 6.6, 1590495796, 5, 1),
(15, 'Frozen II', 2019, 'Chris Buck dan Jennifer Lee', '08042020173743.png', 7, 1590495796, 5, 1),
(16, 'Sherlock Holmes: A Game of Shadows', 2011, 'Guy Ritchie', '08042020174222.png', 7.5, 1590495796, 1, 1),
(17, 'Jumanji: Welcome to the Jungle', 2017, 'Jake Kasdan', '08042020210238.png', 6.9, 1590495796, 7, 1),
(18, 'Annihilation', 2018, 'Alex Garland', '08042020210744.png', 6.9, 1590495796, 7, 1),
(19, 'Harry Potter and the Prisoner of Azkaban', 2004, 'Alfonso Cuaron', '08042020211039.png', 7.9, 1590495796, 7, 1),
(20, 'Indiana Jones and the Last Crusade', 1989, 'Steven Spielberg', '08042020211241.png', 8.2, 1590495796, 7, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_genre`
--

CREATE TABLE `tb_genre` (
  `id_genre` int(10) NOT NULL,
  `nama_genre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_genre`
--

INSERT INTO `tb_genre` (`id_genre`, `nama_genre`) VALUES
(1, 'Aksi'),
(2, 'Komedi'),
(3, 'Horor'),
(4, 'Animasi'),
(5, 'Drama'),
(6, 'Petualangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_komentar`
--

CREATE TABLE `tb_komentar` (
  `id_komentar` int(10) NOT NULL,
  `nama_komentar` varchar(50) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_komentar` int(11) NOT NULL,
  `id_film` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_komentar`
--

INSERT INTO `tb_komentar` (`id_komentar`, `nama_komentar`, `isi_komentar`, `tanggal_komentar`, `id_film`) VALUES
(76, 'Alfred', 'Just one word! AMAZING', 1590495797, 6),
(77, 'Jack', 'Masi belom move on dari #AvengersEndgame, kagum ngebayangin skripnya, bisa buat film superhero rasa film festival dengan nilai-nilai humanis dan kekeluargaan yg kuat jadi pas momen dihadirkan realita yg getir atau pait pecahlah itu kantong mata. Scoringnya jg gila bgt sih!', 1590495796, 6),
(78, 'Fath Fathan', 'Yeaah, already watching Avengers Endgame this morning is cool and all... but, do you know there is something way cooler than that? Not spoiling any of its material to Internet. Enjoy your watch guys!', 1590495796, 6),
(79, 'Dwinda', 'Russo bersaudara, baru rampung menonton Avengers: Endgame, kalian membuat ini amat amat bagus, saya tak bisa menahan diri selain menangis', 1590495796, 6),
(80, 'Radile', 'sepertinya harus menjauhi media sosial beberapa hari sampai tiba waktu dimana diri ini nonton #AvengersEndgame', 1590495796, 6),
(81, 'Cahya Septyanto', 'Doaku pagi ini: Ya allah, tolong lancarkan dan mudahkan lah saya dan teman2 saya yang nanti malam akan menunaikan Avengers: Endgame. Tolong jauhkan lah kami dari Spoiler terkutuk dan orang2 reseh yg berisik ketika nonton. Dan tolong lindungilah Iron man serta Team Avenger nya,', 1590495796, 6),
(82, 'Brandon Davis', 'Avengers: Endgame adalah film yang menakjubkan dan film yang luar biasa. Saya belum pernah melihat yang seperti ini. Film ini semua yang saya mau dan LEBIH banyak lagi. Luar biasa', 1590495796, 6),
(83, 'Catey Sullivan', 'The best part of Far From Home is Samuel L. Jackson, whose Nick Fury single-handedly elevates the movie from a C to a B+.', 1590495796, 9),
(84, 'Bob Mondelo', 'The stakes this time turn out to be considerably lower, and your friendly neighborhood Spider-Teen is arguably just the guy to bring things down to Earth and reestablish a human scale.', 1590495796, 9),
(85, 'Chris Hewitt', '\r\n\r\n I like that \"Far From Home\" is trying something new and that its humor feels more real than the ironic cracks in most superhero movies. I just wish its good pieces all came together more satisfyingly. ', 1590495796, 9),
(86, 'Crishtoper', 'Not as good as the first film but well acted by Tom Holland and company. It is almost essential you have seen the last Avengers film to fully understand this film. THe villain is kinda ho hum but I enjoyed the film.\r\n', 1590495796, 9),
(87, 'Dann', 'Spider-Man hits the road in Spider-Man: Far From Home. Peter Parker European school trip is interrupted when a superhero named Mysterio, who from an alternate Earth, shows up and asked for his help to defeat an Elemental. Unfortunately, as the first post-Endgame Marvel film, Far From Home has the extra burden of resetting the Marvel Universe; which comes off as kind of awkward in this story about a high school trip. And while it does some good things with Parker dealing with the loss of his mentor (Tony Stark), theres too much Iron Man in this Spider-Man movie. A mess from start to finish (though still entertaining), Spider-Man: Far From Home is disappointing both as a MCU film and a Spider-Man film. ', 1590495796, 9),
(88, 'Paul Grimes', 'Fun, lively, high school spirit as Tom Holland is the best Spider-Man to date. No Marvel fatigue with this one. ', 1590495796, 9),
(89, 'Putri Laksmiwati', 'Filmnya seru bikin pengen nonton dua kali. Awesome pokoknya, gak sia sia mesen tiket dari jauh hari dan penantian panjang terbalas dengan film ketje ini', 1590495796, 13),
(90, 'Pangestu Simbolon', 'Overall bagus sih, tapi rasanya enak film film sebelumnya', 1590495796, 13),
(91, 'Pangestu Simbolon', 'GGWP', 1590495796, 13),
(92, 'Jhon', 'Pahlawan kok berantem :v', 1590495796, 14),
(93, 'Cena', 'Filmnya bagus gilsss. nunggu download-annya rilis. mau nonton ulang di rumah, aksinya lebih menantang ketimbang lawan vilain lain', 1590495796, 14),
(94, 'The', 'Yakali gak kuy, fans DC harus liat film ini. semoga masih kebagian tiket nonton di awal tanggal tayang. Rela nebok celengan buat beli tikenya :(', 1590495796, 14),
(95, 'Rock', 'Halah pahlawan diadu kayak gak ada drama lain aja. Penjahat stoknya abis? film kayak gini aja ditunggu. Tapi kayaknya seru, kapan lagi liat pahlawan berantem, aksinya juga kebayang bisa lebih rame. WAJIB BANGET buat nonton. Besok mesen tiketnya ah :v', 1590495796, 14),
(96, 'Rey', 'Skut', 1590495796, 14),
(97, 'Mister', 'Lagi trend banget ya pahlawan melawan pahlawan, gak DC gak Marvel', 1590495796, 14),
(98, 'Rio', 'Dim dim pak dim dim oy dim dim pak dim dim', 1590495796, 14),
(104, 'Mr', 'Kocag :v', 1590495796, 7),
(105, 'Bean', 'Gak ketebak alur ceritanya, komedinya walau absurd tapi keren. bikin keseruan sendiri wkwkw', 1590495796, 7),
(106, 'Tuan', 'Cocok nonton bareng keluarga. Family times\r\n', 1590495796, 7),
(107, 'Buncis', 'Nunggu bajakan awokokoko', 1590495796, 7),
(108, 'Mr', 'Cup 1 kata, kocag :v', 1590495796, 8),
(109, 'Bean', 'Idem sama yg bilang kocag', 1590495796, 8),
(110, 'Tuan', 'Idem', 1590495796, 8),
(111, 'Buncis', 'Idem', 1590495796, 8),
(114, 'Anonim', 'Filmnya Bagus', 1590769117, 3),
(115, 'anonimos', 'iya bener bagus', 1590769173, 3),
(116, 'Spider loverss', 'kerennnn bgttt', 1590769268, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_riwayat`
--

CREATE TABLE `tb_riwayat` (
  `id_riwayat` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `tindakan` text NOT NULL,
  `tanggal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_riwayat`
--

INSERT INTO `tb_riwayat` (`id_riwayat`, `id_user`, `tindakan`, `tanggal`) VALUES
(1, 1, 'Berhasil mengubah password', 1590495796),
(2, 1, 'Berhasil mengubah genre film horor', 1590496558),
(3, 1, 'Berhasil mengubah genre film Komedi', 1590496587),
(4, 1, 'Berhasil menambahkan genre film Horor', 1590496998),
(5, 1, 'Berhasil menambahkan genre film Sci-fi', 1590497050),
(6, 1, 'Berhasil menghapus genre film Sci-fi', 1590497339),
(7, 1, 'Berhasil menambahkan genre film Asd', 1590497344),
(8, 1, 'Berhasil menghapus genre film Asd', 1590497345),
(9, 1, 'Berhasil menambahkan genre film Asd', 1590497375),
(10, 1, 'Berhasil menghapus genre film Asd', 1590497376),
(11, 1, 'Berhasil menambahkan genre film Asd', 1590497394),
(12, 1, 'Berhasil menghapus genre film Asd', 1590497395),
(13, 1, 'Berhasil menambahkan genre film Asd', 1590497425),
(14, 1, 'Berhasil menghapus genre film Asd', 1590497430),
(15, 1, 'Berhasil menambahkan genre film Asd', 1590497448),
(16, 1, 'Berhasil menghapus genre film Asd', 1590497453),
(17, 1, 'Berhasil menambahkan film Avengers', 1590499150),
(18, 1, 'Berhasil menambahkan film Mr. Bean', 1590499228),
(19, 1, 'Berhasil menghapus film ', 1590499330),
(20, 1, 'Berhasil mengubah film Mr. Bean2', 1590500493),
(21, 1, 'Berhasil mengubah film Mr. Bean2', 1590500504),
(22, 1, 'Berhasil mengubah film Mr. Bean2', 1590500566),
(23, 1, 'Berhasil mengubah film Mr. Bean2', 1590500659),
(24, 1, 'Berhasil mengubah film Mr. Bean2', 1590500749),
(25, 1, 'Berhasil menambahkan film Mr. Bean\'s Holiday', 1590500981),
(26, 1, 'Berhasil mengubah film Mr. Bean\'s Holiday', 1590500996),
(27, 1, 'Berhasil mengubah film Mr. Bean\'s', 1590501009),
(28, 1, 'Berhasil mengubah film Mr. Bean', 1590501031),
(29, 1, 'Berhasil mengubah password', 1590501741),
(30, 1, 'Berhasil menghapus komentar Dettline | Film Ini Bagus', 1590636744),
(31, 1, 'Berhasil menambahkan film asd', 1590769217),
(32, 1, 'Berhasil menghapus film ', 1590769222);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `photo_profile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama_lengkap`, `photo_profile`) VALUES
(1, 'andri123', '$2y$10$Vi80wvdPtIx1W4MWV.wtpOxaCR67S/XzRQkxOJbMknJNaFIfaJGuW', 'Andri Firman Saputra', '5eccfb7172310.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_film`
--
ALTER TABLE `tb_film`
  ADD PRIMARY KEY (`id_film`),
  ADD KEY `relasi_genre` (`id_genre`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_genre`
--
ALTER TABLE `tb_genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Indeks untuk tabel `tb_komentar`
--
ALTER TABLE `tb_komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `relasi_komentar` (`id_film`);

--
-- Indeks untuk tabel `tb_riwayat`
--
ALTER TABLE `tb_riwayat`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_film`
--
ALTER TABLE `tb_film`
  MODIFY `id_film` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_genre`
--
ALTER TABLE `tb_genre`
  MODIFY `id_genre` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_komentar`
--
ALTER TABLE `tb_komentar`
  MODIFY `id_komentar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT untuk tabel `tb_riwayat`
--
ALTER TABLE `tb_riwayat`
  MODIFY `id_riwayat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_film`
--
ALTER TABLE `tb_film`
  ADD CONSTRAINT `relasi_genre` FOREIGN KEY (`id_genre`) REFERENCES `tb_genre` (`id_genre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_komentar`
--
ALTER TABLE `tb_komentar`
  ADD CONSTRAINT `relasi_komentar` FOREIGN KEY (`id_film`) REFERENCES `tb_film` (`id_film`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_riwayat`
--
ALTER TABLE `tb_riwayat`
  ADD CONSTRAINT `tb_riwayat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
