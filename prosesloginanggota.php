<?php
include ("conn.php");
error_reporting(E_ALL);

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$username = mysqli_real_escape_string($koneksi,$username);
$password = mysqli_real_escape_string($koneksi,$password);

if (empty($username) && empty($password)) {
	header('location:login-anggota.php?error1');
	// break;
} else if (empty($username)) {
	header('location:login-anggota.php?error=2');
	// break;
} else if (empty($password)) {
	header('location:login-anggota.php?error=3');
	// break;
}

$q = mysqli_query($koneksi,"select * from data_anggota where email='$username' and password='$password'");
$row = mysqli_fetch_array($q);

if (mysqli_num_rows($q) == 1) {
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['no_induk'] = $row['no_induk'];
	$_SESSION['username'] = $username;
	$_SESSION['fullname'] = $row['nama'];
    $_SESSION['gambar'] = $row['foto'];	

	header('location:anggota/index.php');
} else {
	header('location:login-anggota.php?error=4');
}
?>