<?php
include "../conn.php"; //memanggil file conn.php untuk koneksi ke database
$maks_pinjam		= 2; //maksimal peminjaman buku dua kali perpanjangan
$maks_hari_pinjam	= 7; //maksimal hari peminjaman

$id_trans	= isset($_GET['id_trans']) ? $_GET['id_trans'] : "";
$judul		= isset($_GET['judul']) ? $_GET['judul'] : "";

if ($id_trans==""||$judul=="") {
	echo "<script>alert('Anda Belum Memilih Buku!'); window.location = 'transaksi.php'</script>";
} else {
	$us=mysql_query("UPDATE trans_pinjam SET status='kembali' WHERE id='$id_trans'") or die ("Gagal update ".mysql_error());
	$uj=mysql_query("UPDATE data_buku SET jum_temp=(jum_temp+1) WHERE id='$judul'") or die ("Gagal update ".mysql_error());
	$data = mysql_query("SELECT * from trans_pinjam WHERE id='$id_trans'");
	$row = mysql_fetch_assoc($data);
	$check = mysql_query("SELECT * from review where id_user = '".$row['nama_peminjam']."' AND id_koleksi = '".$row['id_peminjam']."'");
	if(mysql_num_rows($check) == 0){
		$tambah=mysql_query("INSERT INTO review (id_user, id_koleksi, rate) SELECT nama_peminjam, id_peminjam, 1 from trans_pinjam WHERE id='$id_trans'") or die ("Gagal update ".mysql_error());
	}else{
		$rows = mysql_fetch_assoc($check);
		if($rows['rate'] != '5'){
			$tambah=mysql_query("UPDATE review SET rate = rate + 1 WHERE id_review ='".$rows['id']."'") or die ("Gagal update ".mysql_error());
		}
	}
	// $tambah=mysql_query("SELECT * FROM review (id_user, id_koleksi, review) SELECT nama_peminjam, id_peminjam, 1 from trans_pinjam WHERE id='$id_trans'") or die ("Gagal update ".mysql_error());

	if ($us || $uj) {
		echo "<script>alert('Buku telah dikembalikan'); window.location = 'transaksi.php'</script>";
	} else {
		echo "<script>alert('Oops, Buku gagal dikembalikan!'); window.location = 'transaksi.php'</script>";
		echo "<meta http-equiv='refresh' content='0; url=?page=transaksi'>";
	}
}
?>
