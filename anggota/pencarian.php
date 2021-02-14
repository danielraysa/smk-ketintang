<?php 
session_start();
if (empty($_SESSION['username'])){
    header('location:../index.php');	
    exit;
} else {
	include "../conn.php";
    include "../session_check.php";
    include "../adj_similiarity.php";
}
$rekom_disp = 2;
$no_induk = $_SESSION['no_induk'];
$cek_histori = mysql_query("SELECT nama_peminjam as id_peminjam from trans_pinjam tp WHERE nama_peminjam = '$no_induk'");
if(mysql_num_rows($cek_histori) != 0){
    $array_1 = [];
    $array_2 = [];
    $query1="SELECT id_peminjam as id_buku from trans_pinjam tp group by id_peminjam";
    $tampil=mysql_query($query1) or die(mysql_error());
    while($row = mysql_fetch_assoc($tampil)){
        array_push($array_1, $row['id_buku']);
    }
    $query2="SELECT nama_peminjam as id_peminjam from trans_pinjam tp group by nama_peminjam";
    $tampil2=mysql_query($query2) or die(mysql_error());
    while($row = mysql_fetch_assoc($tampil2)){
        array_push($array_2, $row['id_peminjam']);
    }

    $array2d = [];
    for($x = 0; $x < count($array_2); $x++){
        for($y = 0; $y < count($array_1); $y++){
            $query_row="SELECT COUNT(*) as total from trans_pinjam tp WHERE id_peminjam = ".$array_1[$y]." AND nama_peminjam = ".$array_2[$x]."";
            $tampil_row=mysql_query($query_row) or die(mysql_error());
            $rows = mysql_fetch_assoc($tampil_row);
            $array2d[$x][$y] = $rows['total'];
        }
    }

    $posisi_user = array_search($_SESSION['no_induk'], $array_2);
    // var_dump($array2d[$posisi_user]);
    foreach($array2d[$posisi_user] as $jml_pinjam){
        if($jml_pinjam == 0){
            $rekom_disp = 1;
            break;
        }
    }
    $new_arr = arr_transpose($array2d);
    $rata = array_mean($array_1, $array_2, $array2d);
    // var_dump($rekom_disp);
    $arr_w = array_sim($new_arr,$rata);
    $hitungan = [];
    // $id_buku = "";
    foreach($array2d[$posisi_user] as $b => $val){
        $hitungan[$b] = weighted_sum($new_arr, $arr_w, $posisi_user, $b);
        /* if($val == 0){
            // array_push($temp, $b);
            $hitungan[$b] = weighted_sum($new_arr, $arr_w, $posisi_user, $b);
        } */
        /* else{
            $hitungan[$b] = "-";
        } */
    }
    
    $buku_0 = zero_book($array2d, $posisi_user);
    $hitungan_temp = $hitungan;
    rsort($hitungan_temp);
    // var_dump($hitungan);
    // var_dump($id_temp);
    if(count($buku_0) != 1){
        $id_buku = array_search(max($hitungan), $hitungan);
        $id_temp1 = array_search($hitungan_temp[0], $hitungan);
        $id_temp2 = array_search($hitungan_temp[1], $hitungan);
        $buku2 = $array_1[$id_temp2];
    }else{
        $id_buku = $buku_0[0];
    }
    $buku = $array_1[$id_buku];
}
$cari = "";
if(isset($_GET['cari'])){
    $rekom_disp = 0;
    $cari = $_GET['cari'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Perpustakaan Berbasis Web www.smkketintang.sch.id</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Perpustakaan SMK Ketintang Surabaya">
    <meta name="keywords" content="Perpus, Website, Aplikasi, Perpustakaan, Online">
    <!-- bootstrap 3.0.2 -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="../css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="../css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="../css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- fullCalendar -->
    <!-- <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" /> -->
    <!-- Daterange picker -->
    <link href="../css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="../css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <!-- <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" /> -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- Theme style -->
    <link href="../css/style.css" rel="stylesheet" type="text/css" />

    <style type="text/css">

    </style>
</head>

<body class="skin-black">
    <!-- header logo: style can be found in header.less -->
    <header class="header">
        <a href="index.php" class="logo">
            <!-- <img src="../img/logo2.png" height="40" width="40" style="margin-bottom: 4px;" /> --> Perpustakaan
            Online
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-right">
                <ul class="nav navbar-nav">

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                            <span><?php echo $_SESSION['fullname']; ?> <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                            <li class="dropdown-header text-center">Account</li>

                            <li>
                                <a href="detail-anggota.php?hal=edit&kd=<?php echo $_SESSION['user_id'];?>">
                                    <i class="fa fa-user fa-fw pull-right"></i>
                                    Profile
                                </a>
                            </li>

                            <li class="divider"></li>

                            <li>
                                <a href="../logout-anggota.php"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div>
                        <center><img src="<?php echo $_SESSION['gambar']; ?>" height="80" width="80" class="img-circle"
                                alt="User Image" style="border: 3px solid white;" /></center>
                    </div>
                    <div class="info">
                        <center>
                            <p><?php echo $_SESSION['fullname']; ?></p>
                        </center>

                    </div>
                </div>
                <!-- search form -->
                <!--<form action="#" method="get" class="sidebar-form">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control" placeholder="Search..."/>
                                    <span class="input-group-btn">
                                        <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form> -->
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <?php include "menu.php"; ?>
            </section>
            <!-- /.sidebar -->
        </aside>

        <aside class="right-side">

            <!-- Main content -->
            <section class="content">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel">
                            <header class="panel-heading">
                                <b>Data Buku <?php //echo "rekomendasi buku : ".$buku; ?></b>

                            </header>
                            <!-- <div class="box-header"> -->
                            <!-- <h3 class="box-title">Responsive Hover Table</h3> -->

                            <!-- </div> -->
                            <div class="panel-body">
                                <div class="box-tools m-b-15">
                                    <form action="" method="GET">
                                        <div class="input-group">
                                            <input type='text' class="form-control input-sm" style="" name="cari"
                                                placeholder='Cari berdasarkan Judul / Pengarang / Penerbit' required />
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default" type="submit"><i
                                                        class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <?php
                                    if(isset($buku)){
                                    $data_rekomendasi = mysql_query("SELECT * FROM data_buku WHERE id = '$buku'");
                                    $get_rekom = mysql_fetch_assoc($data_rekomendasi);
                                    if($rekom_disp==1){
                                    if($get_rekom['jum_temp'] != 0){
                                        $data_rekom = mysql_query("SELECT * FROM data_buku WHERE id = '$buku'");
                                    }else{
                                        $data_rekom = mysql_query("SELECT * FROM data_buku WHERE id = '$buku2'");
                                    }
                                    ?>
                                Rekomendasi Buku :
                                <div style="display:flex">
                                    <?php while($fet = mysql_fetch_assoc($data_rekom)){ ?>
                                    <div class="box" style="border: 1px solid black; width:200px; height: 234px">
                                        <div class="box-body">
                                            <img src="<?php echo $fet['gambar'] != "" ? $fet['gambar'] : '../admin/gambar_buku/default.png'; ?>"
                                                style="width:100%; height:130px" />
                                        </div>
                                        <div class="box-footer">
                                            <?php echo $fet['judul']; ?>
                                        </div>
                                    </div>
                                    <?php }
                                        }
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->

                <?php 
                // var_dump($cari);
                if($cari != ""){
                    $data = mysql_query("SELECT * FROM data_buku WHERE LOWER(judul) LIKE '%$cari%' OR UPPER(judul) LIKE '%$cari%' OR LOWER(pengarang) LIKE '%$cari%' OR UPPER(pengarang) LIKE '%$cari%' OR LOWER(penerbit) LIKE '%$cari%' OR UPPER(penerbit) LIKE '%$cari%'");
                ?>
                <!-- <div class="row"> -->
                    <div class="col-xs-12">
                        <div class="panel">
                            <div class="panel-header">
                                <h4 style="margin: 1rem">Hasil Pencarian</h4>
                            </div>
                            <div class="panel-body table-responsive">
                                <div class="row">
                                    <?php
                                    $no = 1;
                                    while($row = mysql_fetch_array($data)) { ?>
                                    <div class="col-lg-2">
                                        <a href="detail-buku.php?kd=<?php echo $row['id']; ?>">
                                            <div class="box" style="border: 1px solid black; height: 234px">
                                                <div class="box-body">
                                                    <img src="<?php echo $row['gambar'] != "" ? $row['gambar'] : '../admin/gambar_buku/default.png'; ?>"
                                                        style="width:100%; height:130px" />
                                                </div>
                                                <div class="box-footer">
                                                    <?php echo $row['judul']; ?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <?php 
                                    if($no % 6 == 0){ 
                                    ?>
                                </div>
                                <div class="row">
                                    <?php }
                                $no++;
                                } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <!-- row end -->
            </section>

        </aside><!-- /.right-side -->

    </div><!-- ./wrapper -->


    <!-- jQuery 2.0.2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="../js/jquery.min.js" type="text/javascript"></script>

    <!-- jQuery UI 1.10.3 -->
    <script src="../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

    <script src="../js/plugins/chart.js" type="text/javascript"></script>

    <!-- datepicker
        <script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>-->
    <!-- Bootstrap WYSIHTML5
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>-->
    <!-- iCheck -->
    <script src="../js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- calendar -->
    <script src="../js/plugins/fullcalendar/fullcalendar.js" type="text/javascript"></script>

    <!-- Director App -->
    <script src="../js/Director/app.js" type="text/javascript"></script>

    <!-- Director dashboard demo (This is only for demo purposes) -->
    <script src="../js/Director/dashboard.js" type="text/javascript"></script>

    <!-- Director for demo purposes -->
    <script type="text/javascript">
        $('input').on('ifChecked', function (event) {
            // var element = $(this).parent().find('input:checkbox:first');
            // element.parent().parent().parent().addClass('highlight');
            $(this).parents('li').addClass("task-done");
            console.log('ok');
        });
        $('input').on('ifUnchecked', function (event) {
            // var element = $(this).parent().find('input:checkbox:first');
            // element.parent().parent().parent().removeClass('highlight');
            $(this).parents('li').removeClass("task-done");
            console.log('not');
        });
    </script>
    <script>
        $('#noti-box').slimScroll({
            height: '400px',
            size: '5px',
            BorderRadius: '5px'
        });

        $('input[type="checkbox"].flat-grey, input[type="radio"].flat-grey').iCheck({
            checkboxClass: 'icheckbox_flat-grey',
            radioClass: 'iradio_flat-grey'
        });
    </script>

</body>

</html>