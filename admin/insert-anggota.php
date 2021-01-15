<?php
$namafolder="../admin/gambar_anggota/"; //tempat menyimpan file

include "../conn.php";

$id = $_POST['id'];
$no_induk = $_POST['no_induk'];
$nama= $_POST['nama'];
$jk=$_POST['jk'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];
$ttl = $_POST['ttl'];
$alamat=$_POST['alamat'];
$email=$_POST['email'];
$password=$_POST['password'];
$gambar = '';
$cek_induk = mysqli_query($koneksi,"SELECT * FROM data_anggota WHERE no_induk = '$no_induk'");
if(mysqli_num_rows($cek_induk) == 0){
if (!empty($_FILES["nama_file"]["tmp_name"]))
{
	$jenis_gambar=$_FILES['nama_file']['type'];
	
	if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/png")
	{			
		$gambar = $namafolder . basename($_FILES['nama_file']['name']);		
		if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $gambar)) {
			$sql="INSERT INTO data_anggota(id,no_induk,nama,jk,kelas,jurusan,ttl,alamat,email,password,foto) VALUES
            (NULL,'$no_induk','$nama','$jk','$kelas','$jurusan','$ttl','$alamat','$email','$password','$gambar')";
			$res=mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));
			echo "Gambar berhasil dikirim ke direktori".$gambar;
            echo "<h3><a href='input-anggota.php'> Input Lagi</a></h3>";
            echo "<h3><a href='anggota.php'> Data Anggota</a></h3>";	   
		} else {
			echo "Error on uploading file";
		}
   } else {
		echo "Jenis gambar yang anda kirim salah. Harus .jpg .gif .png";
   }

} else {
	$sql="INSERT INTO data_anggota(id,no_induk,nama,jk,kelas,jurusan,ttl,alamat,email,password,foto) VALUES
	 (NULL,'$no_induk','$nama','$jk','$kelas','$jurusan','$ttl','$alamat','$email','$password','$gambar')";
	 $res=mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));
	 echo "<h3><a href='input-anggota.php'> Input Lagi</a></h3>";
	 echo "<h3><a href='anggota.php'> Data Anggota</a></h3>";
	// echo "Anda belum memilih gambar";
}
}else{
	echo "Nomor Induk sudah ada!";
}

?>