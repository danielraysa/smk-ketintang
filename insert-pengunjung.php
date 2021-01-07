<?php
include "conn.php";
// var_dump($_POST);
// die();
$no_induk    = $_POST['id'];
$nama        = $_POST['nama'];
$jurusan 	 = $_POST['jurusan'];
$kelas 	     = $_POST['kelas'];
$perlu1 	 = $_POST['perlu1'];
//$cari 	 = $_POST['cari'];
$saran	     = $_POST['saran'];
$tgl_kunjung = date("Y/m/d");
$jam_kunjung = date('H:i:s');

//if( empty($nama) || empty($jk) || empty($kelas) || empty($perlu) || empty($cari) || empty($saran) ){
    //echo "<b>Data Harus Di isi.!!!</b>";
//}else{

try{
	$query = mysqli_query($koneksi,"INSERT INTO pengunjung (no_induk, nama, jurusan, kelas, perlu1, saran, tgl_kunjung, jam_kunjung) VALUES ('$no_induk', '$nama', '$jurusan', '$kelas', '$perlu1', '$saran', '$tgl_kunjung', '$jam_kunjung')");
} catch(Exception $e){
	echo "<script>alert('Message:" . $e . "');</script>";
}

if ($query){
	echo "<script>alert('Data Berhasil dimasukan!'); window.location = 'index.php'</script>";	
} else {
	echo "<script>alert('Data Gagal dimasukan!'); window.location = 'index.php'</script>";	
}
//}
?>