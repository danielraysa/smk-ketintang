<?php

include "../conn.php";

if(isset($_POST['id'])){
	$query = "select * from data_anggota where no_induk='" . $_POST['id'] . "'";
	$msql = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_row($msql);
	
	$data['nama'] = $row[2];
	$data['kelas'] = $row[4];
	$data['jurusan'] = $row[5];
	echo json_encode($data);
}