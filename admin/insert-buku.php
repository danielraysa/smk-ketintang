<?php
$namafolder="../admin/gambar_buku/"; //tempat menyimpan file

include "../conn.php";

$id = $_POST['kode'];
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
//$jum_temp = $_POST['jum_temp'];
$tgl_input = $_POST['tgl_input'];
if (!empty($_FILES["nama_file"]["tmp_name"]))
{
	$jenis_gambar=$_FILES['nama_file']['type'];
		
	if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/png")
	{			
		$gambar = $namafolder . basename($_FILES['nama_file']['name']);		
		if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $gambar)) {
			$sql="INSERT INTO data_buku(id,kode,judul,pengarang,th_terbit,penerbit,kategori,kode_klas,jumlah_buku,lokasi,asal,jum_temp,tgl_input,gambar) VALUES
            (NULL,'$id','$judul','$pengarang','$th_terbit','$penerbit','$kategori','$kode_klas','$jumlah_buku','$lokasi','$asal','$jumlah_buku','$tgl_input','$gambar')";
			$res=mysql_query($sql) or die (mysql_error($koneksi));
			echo "Gambar berhasil dikirim ke direktori".$gambar;
            echo "<h3><a href='input-buku.php'> Input Lagi</a></h3>";
            echo "<h3><a href='buku.php'> Data Buku</a></h3>";	   
		} else {
		   echo "<p>Gambar gagal dikirim</p>";
		}
   } else {
		echo "Jenis gambar yang anda kirim salah. Harus .jpg .gif .png";
   }
} else {
    $gambar = '';
	$sql="INSERT INTO data_buku(id,kode,judul,pengarang,th_terbit,penerbit,kategori,kode_klas,jumlah_buku,lokasi,asal,jum_temp,tgl_input,gambar) VALUES
    (NULL,'$id','$judul','$pengarang','$th_terbit','$penerbit','$kategori','$kode_klas','$jumlah_buku','$lokasi','$asal','$jumlah_buku','$tgl_input','$gambar')";
    $res=mysql_query($sql) or die (mysql_error($koneksi));
    echo "Gambar berhasil dikirim ke direktori".$gambar;
    echo "<h3><a href='input-buku.php'> Input Lagi</a></h3>";
    echo "<h3><a href='buku.php'> Data Buku</a></h3>";
}

?>