<?php
$namafolder="../admin/gambar_anggota/"; //tempat menyimpan file

include "../conn.php";

$id = $_POST['id'];
$no_induk = $_POST['no_induk'];
$nama = $_POST['nama'];
$jk = $_POST['jk'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];
$ttl = $_POST['ttl'];
$alamat = $_POST['alamat'];
$email=$_POST['email'];
$password=$_POST['password'];	
if (!empty($_FILES["nama_file"]["tmp_name"]))
{
   $jenis_gambar=$_FILES['nama_file']['type'];
		
	if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/png")
	{			
		$gambar = $namafolder . basename($_FILES['nama_file']['name']);		
		if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $gambar)) {
			$sql="UPDATE data_anggota SET no_induk='$no_induk', nama='$nama', jk='$jk', kelas='$kelas', jurusan='$jurusan', ttl='$ttl', alamat='$alamat', email='$email', password='$password', foto='$gambar' WHERE id='$id'";
			$res=mysql_query($sql) or die (mysql_error());
			echo "Data Anggota Berhasil Diupdate. Gambar berhasil dikirim ke direktori".$gambar;
            echo "<h3><a href='anggota.php'> Data Anggota</a></h3>";	   
		} else {
		   echo "<p>Gambar gagal dikirim</p>";
		}
   } else {
		echo "Jenis gambar yang anda kirim salah. Harus .jpg .gif .png";
   }
} else {
	$sql="UPDATE data_anggota SET no_induk='$no_induk', nama='$nama', jk='$jk', kelas='$kelas', jurusan='$jurusan', ttl='$ttl', alamat='$alamat', email='$email', password='$password' WHERE id='$id'";
   $res=mysql_query($sql) or die (mysql_error());
   echo "Data Anggota Berhasil Diupdate";
      echo "<h3><a href='anggota.php'> Data Anggota</a></h3>";	
}

?>