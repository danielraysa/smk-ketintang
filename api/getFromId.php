<?php

include "../conn.php";

if(isset($_POST['id'])){
	$query = "select * from data_anggota where no_induk='" . $_POST['id'] . "'";
	$msql = mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
	$row = mysqli_fetch_row($msql);
	
	$data['nama'] = $row[2];
	$data['kelas'] = $row[4];
	$data['jurusan'] = $row[5];
	echo json_encode($data);
}