<?php 
session_start();
if (empty($_SESSION['username'])){
	header('location:../index.php');	
} else {
	include "../conn.php";
?>
<!DOCTYPE html>
<html>
<?php include "head.php"; ?>
      <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
<?php include "header.php"; ?>
                <?php
$timeout = 10; // Set timeout minutes
$logout_redirect_url = "../login.html"; // Set logout URL

$timeout = $timeout * 60; // Converts minutes to seconds
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script>alert('Session Anda Telah Habis!'); window.location = '$logout_redirect_url'</script>";
    }
}
$_SESSION['start_time'] = time();
?>
<?php } ?>
                <div class="wrapper row-offcanvas row-offcanvas-left">
                    <!-- Left side column. contains the logo and sidebar -->
                    <aside class="left-side sidebar-offcanvas">
                        <!-- sidebar: style can be found in sidebar.less -->
                        <section class="sidebar">
                            <!-- Sidebar user panel -->
                            <div class="user-panel">
                                <div>
                                    <center><img src="<?php echo $_SESSION['gambar']; ?>" height="80" width="80" class="img-circle" alt="User Image" style="border: 3px solid white;" /></center>
                                </div>
                                <div class="info">
                                    <center><p><?php echo $_SESSION['fullname']; ?></p></center>

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
                                    <b>Data Transaksi Peminjaman</b>

                                </header>
                                <!-- <div class="box-header"> -->
                                    <!-- <h3 class="box-title">Responsive Hover Table</h3> -->

                                <!-- </div> -->
                                <div class="panel-body table-responsive">
                                    <div class="box-tools m-b-15">
                                    <form action="transaksi.php" method="POST">
                                        <div class="input-group">
                                        <input type='text' class="form-control input-sm pull-right" style="width: 150px;"  name='qcari' placeholder='Cari Judul & Peminjam' required /> 
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default" type="submit"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>    
                                    </div>
                                    
                                    <?php
                    $query1="select data_buku.*, trans_pinjam.*, trans_pinjam.id AS no_pinjam, data_anggota.* from data_buku, trans_pinjam, data_anggota WHERE data_buku.id=trans_pinjam.id_peminjam AND trans_pinjam.nama_peminjam=data_anggota.no_induk AND trans_pinjam.status='pinjam' ORDER BY trans_pinjam.id";
                    
                    if(isset($_POST['qcari'])){
	               $qcari=$_POST['qcari'];
	               $query1="SELECT data_buku.*, trans_pinjam.*, data_anggota.* from data_buku, trans_pinjam, data_anggota WHERE data_buku.id=trans_pinjam.id_peminjam AND trans_pinjam.nama_peminjam=data_anggota.no_induk
	               and trans_pinjam.tgl_pinjam like '%$qcari%'
	               or trans_pinjam.tgl_kembali like '%$qcari%'  ";
                    }
                    $tampil=mysqli_query($koneksi,$query1) or die(mysqli_error($koneksi));
                    ?>
                                    <table id="example" class="table table-hover table-bordered">
                  <thead>
                      <tr>
                        <th><center>No</center></th>
                        <th><center>Judul Buku </center></th>
                        <th><center>Peminjam </center></th>
                        <th><center>Tgl Pinjam </center></th>
                        <th><center>Tgl Kembali </center></th>
                        <th><center>Status </center></th>
                        <!--<th><center>Terlambat</center></th>-->
                        <th><center>Aksi</center></th>
                      </tr>
                  </thead>
                  <?php
                  $no=0;
                      while($data=mysqli_fetch_array($tampil))
                    { $no++; ?>
                    <tbody>
                    <tr>
                    <td><?php echo $no;?></td>
                    <td><a href="detail-buku.php?hal=edit&kd=<?php echo $data['id_peminjam'];?>"><span class="fa fa-book"></span> <?php echo $data['judul'];?></a></td>
                    <td><?php echo $data['nama'];?></td>
                    <td><?php echo $data['tgl_pinjam'];?></td>
                    <td><?php echo $data['tgl_kembali'];?></td>
                    <td><?php echo $data['status'];?></td>
                    <!--<td><?php 
                      $tgl_dateline=$data['tgl_kembali'];
		              $tgl_kembali=date('Y-m-d');
		              $lambat=terlambat($tgl_dateline, $tgl_kembali);
                      $denda1=1000;
                      $denda=$lambat*$denda1;
		              if ($lambat>0) {
                      echo "<center><b><font color='red'>$lambat hari &nbsp</font></b></center>";
		              }
		              else {
               	    echo "<center><b><font color='blue'> $lambat hari &nbsp | &nbsp Baru Meminjam</font></b></center>";
		              }
                    ?></td>-->
                    <td><center><div id="thanks">
                    <a class="btn btn-sm btn-primary" data-placement="bottom" data-toggle="tooltip" title="Kembali" href="kembali.php?hal=edit&id_trans=<?php echo $data['no_pinjam'];?>&judul=<?php echo $data['id_peminjam'];?>"><span class="glyphicon glyphicon-tags"></span></a>
                    <a class="btn btn-sm btn-success" data-placement="bottom" data-toggle="tooltip" title="Perpanjang" href="perpanjang.php?hal=id_trans=<?php echo $data['no_pinjam'];?>&judul=<?php echo $data['id_peminjam'];?>&kembali=<?php echo $data['tgl_kembali'];?>&lambat=<?php $lambat; ?>"><span class="fa fa-refresh fa-spin"></span></a>
                    </td></tr></div>
                    <?php   
              } 
              ?>
                   </tbody>
                   </table>
                   
                  <?php $tampil=mysqli_query($koneksi,"select * from trans_pinjam where status='pinjam' order by id");
                        $pinjam=mysqli_num_rows($tampil);
                    ?>
                  <center><h4>Jumlah Peminjam Buku : <?php echo "$pinjam"; ?> Orang </h4> </center>
                  
                <div class="text-right" style="margin-top: 10px;">
                 <a href="transaksi.php" class="btn btn-sm btn-info">Refresh <i class="fa fa-refresh"></i></a> </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
              <!-- row end -->
                </section><!-- /.content -->
               <?php include "footer.php"; ?>
            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
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
            $('input').on('ifChecked', function(event) {
                // var element = $(this).parent().find('input:checkbox:first');
                // element.parent().parent().parent().addClass('highlight');
                $(this).parents('li').addClass("task-done");
                console.log('ok');
            });
            $('input').on('ifUnchecked', function(event) {
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
<script type="text/javascript">
    $(function() {
                "use strict";
                //BAR CHART
                var data = {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [
                        {
                            label: "My First dataset",
                            fillColor: "rgba(220,220,220,0.2)",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: [65, 59, 80, 81, 56, 55, 40]
                        },
                        {
                            label: "My Second dataset",
                            fillColor: "rgba(151,187,205,0.2)",
                            strokeColor: "rgba(151,187,205,1)",
                            pointColor: "rgba(151,187,205,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(151,187,205,1)",
                            data: [28, 48, 40, 19, 86, 27, 90]
                        }
                    ]
                };
            new Chart(document.getElementById("linechart").getContext("2d")).Line(data,{
                responsive : true,
                maintainAspectRatio: false,
            });

            });
            // Chart.defaults.global.responsive = true;
</script>
</body>
</html>