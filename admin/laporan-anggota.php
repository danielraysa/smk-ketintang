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
$query1="select * from data_anggota ";

if (isset($_GET['submit'])) {
    $class = isset($_GET['class'])?$_GET['class']:'';
    $jurusan = isset($_GET['jurusan'])?$_GET['jurusan']:'';

    if ($class != null || $jurusan != null) {
        $query1 .= 'where ';
    }
    
    if ($class != null && $jurusan != null) {
        $query1 .= "kelas='$class' and jurusan='$jurusan' ";
    } else if ($class) {
        $query1 .= "kelas='$class' ";
    } else if ($jurusan) {
        $query1 .= "jurusan='$jurusan' ";
    }
}
$query1 .= "ORDER BY id ASC";

$result=mysqli_query($koneksi,$query1) or die(mysqli_error($koneksi));
// $result=mysqli_query($koneksi,"SELECT * FROM data_anggota ORDER BY id ASC") or die(mysqli_error($koneksi));

//Inisiasi untuk membuat header kolom
//$column_id = "";
$column_noinduk = "";
$column_nama = "";
$column_jrsn = "";
$column_kelas = "";
$column_ttl = "";
$column_alamat = "";


//For each row, add the field to the corresponding column
while($row = mysqli_fetch_array($result))
{
	//$id = $row["id"];
    $noinduk = $row["no_induk"];
    $nama = $row["nama"];
    $jrsn = $row["jurusan"];
    $kelas = $row["kelas"];
	$ttl = $row["ttl"];
    $alamat = $row["alamat"];
 
    

	//$column_id = $column_id.$id."\n";
    $column_noinduk = $column_noinduk.$noinduk."\n";
    $column_nama = $column_nama.$nama."\n";
    $column_jrsn = $column_jrsn.$jrsn."\n";
    $column_kelas = $column_kelas.$kelas."\n";
    $column_ttl = $column_ttl.$ttl."\n";
    $column_alamat = $column_alamat.$alamat."\n";
    

//Create a new PDF file
$pdf = new FPDF('P','mm',array(220,297)); //L For Landscape / P For Portrait
$pdf->AddPage();

//Menambahkan Gambar
$pdf->Image('../img/logo2.png',2,2,-1000);

$pdf->SetFont('Arial','B',13);
$pdf->Cell(80);
$pdf->Cell(30,10,'LAPORAN ANGGOTA',0,0,'C');
$pdf->Ln();
$pdf->Cell(80);
$pdf->Cell(30,10,'Perpustakaan SMK Ketintang Surabaya',0,0,'C');
$pdf->Ln();

}
//Fields Name position
$Y_Fields_Name_position = 30;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(110,180,230);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(20,8,'No Induk',1,0,'C',1);
$pdf->SetX(25);
$pdf->Cell(55,8,'Nama',1,0,'C',1);
$pdf->SetX(80);
$pdf->Cell(15,8,'Jurusan',1,0,'C',1);
$pdf->SetX(95);
$pdf->Cell(15,8,'Kelas',1,0,'C',1);
$pdf->SetX(110);
$pdf->Cell(50,8,'Tempat Tanggal Lahir',1,0,'C',1);
$pdf->SetX(160);
$pdf->Cell(55,8,'Alamat',1,0,'C',1);
$pdf->Ln();

//Table position, under Fields Name
$Y_Table_Position = 38;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(20,6,$column_noinduk,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(25);
$pdf->MultiCell(55,6,$column_nama,1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(80);
$pdf->MultiCell(15,6,$column_jrsn,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(95);
$pdf->MultiCell(15,6,$column_kelas,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(110);
$pdf->MultiCell(50,6,$column_ttl,1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(160);
$pdf->MultiCell(55,6,$column_alamat,1,'C');

$pdf->Output();
?>
