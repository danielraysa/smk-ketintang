<?php
$namafolder="../admin/gambar_buku/"; //tempat menyimpan file

include "../conn.php";

$id = $_POST['id'];
$kode = $_POST['kode'];
$judul = $_POST['judul'];
$pengarang = $_POST['pengarang'];
$th_terbit = $_POST['th_terbit'];
$penerbit = $_POST['penerbit'];
//$isbn = $_POST['isbn'];
$kategori = $_POST['kategori'];
$kode_klas = $_POST['kode_klas'];
$jumlah_buku = $_POST['jumlah_buku'];
$lokasi = $_POST['lokasi'];
$asal = $_POST['asal'];
$jum_temp = $_POST['jum_temp'];
$tgl_input = $_POST['tgl_input'];
if (!empty($_FILES["nama_file"]["tmp_name"]))
{
	$jenis_gambar=$_FILES['nama_file']['type'];
	if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/png")
	{			
		$gambar = $namafolder . basename($_FILES['nama_file']['name']);		
		if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $gambar)) {
			$sql="UPDATE data_buku SET kode='$kode',judul='$judul', pengarang='$pengarang', th_terbit='$th_terbit', penerbit='$penerbit', kategori='$kategori', kode_klas='$kode_klas', jumlah_buku='$jumlah_buku', lokasi='$lokasi', asal='$asal', jum_temp='$jumlah_buku', tgl_input='$tgl_input', gambar='$gambar' WHERE id='$id'";
			$res=mysql_query($sql) or die (mysql_error());
			echo "Gambar berhasil dikirim ke direktori".$gambar;
            header('location:buku.php'); 
		} else {
		   echo "<p>Gambar gagal dikirim</p>";
		}
   } else {
		echo "Jenis gambar yang anda kirim salah. Harus .jpg .gif .png";
   }
} else {
	$sql="UPDATE data_buku SET kode='$kode',judul='$judul', pengarang='$pengarang', th_terbit='$th_terbit', penerbit='$penerbit', kategori='$kategori', kode_klas='$kode_klas', jumlah_buku='$jumlah_buku', lokasi='$lokasi', asal='$asal', jum_temp='$jumlah_buku', tgl_input='$tgl_input' WHERE id='$id'";
    $res=mysql_query($sql) or die (mysql_error());
    echo "Gambar berhasil dikirim ke direktori".$gambar;
    header('location:buku.php'); 
}

?>