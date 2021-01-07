<?php
include "../conn.php";
require('../fpdf17/fpdf.php');
/**
 Judul  : Laporan PDF (portait):
 Level  : Menengah
 Author : Hakko Bio Richard
 Blog   : www.hakkoblogs.com
 Web    : www.niqoweb.com
 Email  : hakkobiorichard@gmail.com
 
 Untuk tutorial yang lainnya silahkan berkunjung ke www.hakkoblogs.com
 
 Butuh jasa pembuatan website, aplikasi, pembuatan program TA dan Skripsi.? Hubungi NiqoWeb ==>> 085694984803
 
 **/
//Menampilkan data dari tabel di database

$result=mysqli_query($koneksi,"SELECT * FROM pengunjung order by id desc") or die(mysqli_error($koneksi));

//Inisiasi untuk membuat header kolom
//$column_id = "";
$column_nama = "";
$column_kelas = "";
$column_jurusan = "";
$column_tgl = "";
$column_jam = "";
$column_perlu = "";


//For each row, add the field to the corresponding column
while($row = mysqli_fetch_array($result))
{
	//$id = $row["id"];
    $nama = $row["nama"];
    $kelas = $row["kelas"];
    $jurusan = $row["jurusan"];
    $tgl = $row["tgl_kunjung"];
	$jam = $row["jam_kunjung"];
    $perlu = $row["perlu1"];
 
    

	//$column_id = $column_id.$id."\n";
    $column_nama = $column_nama.$nama."\n";
    $column_kelas = $column_kelas.$kelas."\n";
    $column_jurusan = $column_jurusan.$jurusan."\n";
    $column_tgl = $column_tgl.$tgl."\n";
    $column_jam = $column_jam.$jam."\n";
    $column_perlu = $column_perlu.$perlu."\n";
    

//Create a new PDF file
$pdf = new FPDF('P','mm',array(220,297)); //L For Landscape / P For Portrait
$pdf->AddPage();

//Menambahkan Gambar
$pdf->Image('../img/logo2.png',10,10,-1000);

$pdf->SetFont('Arial','B',13);
$pdf->Cell(80);
$pdf->Cell(30,10,'LAPORAN PENGUNJUNG',0,0,'C');
$pdf->Ln();
$pdf->Cell(80);
$pdf->Cell(30,10,'Perpustakaan SMK Ketintang Surabaya',0,0,'C');
$pdf->Ln();

}
//Fields Name position
$Y_Fields_Name_position = 40;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(110,180,230);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(55,8,'Nama',1,0,'C',1);
$pdf->SetX(60);
$pdf->Cell(30,8,'Kelas',1,0,'C',1);
$pdf->SetX(90);
$pdf->Cell(25,8,'Jurusan',1,0,'C',1);
$pdf->SetX(115);
$pdf->Cell(35,8,'Tanggal Kunjung',1,0,'C',1);
$pdf->SetX(150);
$pdf->Cell(25,8,'Jam Kunjung',1,0,'C',1);
$pdf->SetX(175);
$pdf->Cell(40,8,'Keperluan',1,0,'C',1);
$pdf->Ln();

//Table position, under Fields Name
$Y_Table_Position = 48;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(55,6,$column_nama,1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(60);
$pdf->MultiCell(30,6,$column_kelas,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(90);
$pdf->MultiCell(25,6,$column_jurusan,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(115);
$pdf->MultiCell(35,6,$column_tgl,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(150);
$pdf->MultiCell(25,6,$column_jam,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(175);
$pdf->MultiCell(40,6,$column_perlu,1,'C');

$pdf->Output();
?>
