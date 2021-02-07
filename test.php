<?php
include "conn.php";
include "adj_similiarity.php";

$array_1 = [];
$array_2 = [];
$query1="SELECT id_peminjam as id_buku from trans_pinjam tp group by id_peminjam";
// $query1="SELECT id as id_buku from data_buku";
$tampil=mysql_query($query1) or die(mysql_error());
while($row = mysql_fetch_assoc($tampil)){
    array_push($array_1, $row['id_buku']);
}
$query2="SELECT nama_peminjam as id_peminjam from trans_pinjam tp group by nama_peminjam";
// $query2="SELECT no_induk as id_peminjam from data_anggota group by no_induk";
$tampil2=mysql_query($query2) or die(mysql_error());
while($row = mysql_fetch_assoc($tampil2)){
    array_push($array_2, $row['id_peminjam']);
}
// var_dump($array_1);
// var_dump($array_2);
$array2d = [];
for($x = 0; $x < count($array_1); $x++){
    for($y = 0; $y < count($array_2); $y++){
        $query_row="SELECT COUNT(*) as total from trans_pinjam tp WHERE id_peminjam = ".$array_1[$x]." AND nama_peminjam = ".$array_2[$y]."";
        $tampil_row=mysql_query($query_row) or die(mysql_error());
        $rows = mysql_fetch_assoc($tampil_row);
        $array2d[$x][$y] = $rows['total'];
    }
}

// var_dump($array2d);
$rata = [];
?>
<table border="1" style="">
<tr>
    <td></td>
<?php for($x = 0; $x < count($array_1); $x++){
    echo "<td>buku ".$array_1[$x]."</td>";
}
?>
<td>Rata2</td>
</tr>
<?php
for($x = 0; $x < count($array_1); $x++){
    $temp_rata = 0;
    $temp_divider = 0;
    echo "<tr>";
    echo "<td>usr ".$array_2[$x]."</td>";
    for($y = 0; $y < count($array_2); $y++){
        if($array2d[$x][$y] != 0){
            $temp_rata += $array2d[$x][$y];
            $temp_divider += 1;
        }
        echo "<td>".$array2d[$x][$y]."</td>";
    }
    $rata[$x] = $temp_rata/$temp_divider;
    echo "<td>".($temp_rata/$temp_divider)."</td>";
    echo "</tr>";
}
?>
</table>

<?php
// var_dump($array2d[0]);
// var_dump($array2d[1]);
$new_arr = arr_transpose($array2d);
?>
<?php 

$arr_w = [];
for($s = 0; $s < count($new_arr); $s++){
    $arr_w[$s][$s] = null;
    for($d = $s+1; $d < count($new_arr); $d++){
        $sim_ = cos_sim($new_arr[$s],$new_arr[$d], $rata);
        $arr_w[$s][$d] = $sim_;
        $arr_w[$d][$s] = $sim_;
        echo "sim(b".($s+1).", b".($d+1).") = ".$sim_."<br>";
    }
}
//contoh user ke-4
// w(user 4, buku 1) =  x
// var_dump($arr_w);
?>
<table border="1" style="">
<?php
for($z=0;$z< count($arr_w); $z++){
    echo"<tr>";
    for($l = 0; $l<count($arr_w); $l++){
        echo "<td>".$arr_w[$z][$l]."</td>";
    }
    echo"</tr>";
}
?>
</table>
<?php 

echo "w(user 3, buku 1) =  ".weighted_sum($new_arr, $arr_w, 2, 0)."<br>";
echo "w(user 3, buku 2) =  ".weighted_sum($new_arr, $arr_w, 2, 1)."<br>";
echo "w(user 3, buku 3) =  ".weighted_sum($new_arr, $arr_w, 2, 2)."<br>";
echo "w(user 3, buku 4) =  ".weighted_sum($new_arr, $arr_w, 2, 3)."<br>";
?>