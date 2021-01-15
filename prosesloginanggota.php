<?php
include ("conn.php");
date_default_timezone_set('Asia/Jakarta');

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

if (empty($username) && empty($password)) {
	header('location:login-anggota.html?error1');
	break;
} else if (empty($username)) {
	header('location:login-anggota.html?error=2');
	break;
} else if (empty($password)) {
	header('location:login-anggota.html?error=3');
	break;
}

$q = mysql_query("select * from data_anggota where email='$username' and password='$password'");
$row = mysql_fetch_array ($q);

if (mysql_num_rows($q) == 1) {
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