<?php
$namafolder="../admin/gambar_anggota/"; //tempat menyimpan file

include "../conn.php";

if (!empty($_FILES["nama_file"]["tmp_name"]))
{
	$jenis_gambar=$_FILES['nama_file']['type'];
        $id = $_POST['id'];
        $no_induk = $_POST['no_induk'];
		$nama= $_POST['nama'];
		$jk=$_POST['jk'];
        $kelas = $_POST['kelas'];
        $ttl = $_POST['ttl'];
        $alamat=$_POST['alamat'];
        $email=$_POST['email'];
        $password=$_POST['password'];
		
	if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png")
	{			
		$gambar = $namafolder . basename($_FILES['nama_file']['name']);		
		if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $gambar)) {
			$sql="INSERT INTO data_anggota(id,no_induk,nama,jk,kelas,ttl,alamat,email,password,foto) VALUES
            ('$id','$no_induk','$nama','$jk','$kelas','$ttl','$alamat','$email','$password','$gambar')";
			$res=mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));
			echo "Gambar berhasil dikirim ke direktori".$gambar;
            echo "<h3><a href='../login-anggota.php'> Login</a></h3>";	   
		} else {
		   echo "<p>Gambar gagal dikirim</p>";
		}
   } else {
		echo "Jenis gambar yang anda kirim salah. Harus .jpg .gif .png";
   }
} else {
	echo "Anda belum memilih gambar";
}

?>