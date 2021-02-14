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
<?php include "header.php";
include "../session_check.php";

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
                        
                        
                        <div class="col-xs-6">
                            <div class="panel">
                                <header class="panel-heading">
                                    <b>Cetak Kartu Anggota</b>

                                </header>
                                <!-- <div class="box-header"> -->
                                    <!-- <h3 class="box-title">Responsive Hover Table</h3> -->
                    <?php
                    $query = mysql_query("SELECT * FROM data_anggota WHERE id='$_GET[kd]'");
                    $data  = mysql_fetch_array($query);
                    ?>
                                <!-- </div> -->
                                <div class="panel-body">
                      <table id="example" class="table-bordered">
                      <tr>
                      <td><center><img src="../img/logo2.png" height="60" width="60" alt="User Image" /></center>
                        </td>
                      <td colspan="2"><center><h6 style="font-size: small;"><b>KARTU TANDA ANGGOTA PERPUSTAKAAN</b></h6></center></td>
                      </tr>
                    <tr>
                    <td width="100" >ID Anggota</td>
                    <td><?php echo $data['id']; ?></td>
                    <td rowspan="5"><div>
                            <center><img src="<?php echo $data['foto']; ?>" height="120" width="80" alt="User Image" style="border: 1px solid #333333;" /></center>
                        </div></td>
                    </tr>
                    <tr>
                    <td >No Induk</td>
                    <td ><?php echo $data['no_induk']; ?></td>
                    </tr>
                    <tr>
                    <td>Nama</td>
                    <td><?php echo $data['nama']; ?></td>
                    </tr>
                    <tr>
                    <td>Jenis Kelamin</td>
                    <td><?php 
                    if ($data['jk']=='L'){echo "Laki-Laki";}
                    else if ($data['jk']=='L'){echo "Perempuan";}
                     ?></td>
                    </tr>
                    <tr>
                    <td>Kelas</td>
                    <td><?php echo $data['kelas']; ?></td>
                    </tr>
                    <tr>
                    <td>Tanggal Lahir</td>
                    <td colspan="2"><?php echo $data['ttl']; ?></td>
                    </tr>
                    <tr>
                    <td>Alamat</td>
                    <td colspan="2"><?php echo $data['alamat']; ?></td>
                    </tr>
                    <tr>
                    <td colspan="3"><center><img style="margin-top: 5px;" alt="<?php $data['no_induk'];?>" src="<?php echo "barcode.php?size=40&text=$_GET[kode]&print=true"; ?>" />
                    </center></td>
                    </tr>
                   </table>
                  
                  
                                </div>
                            </div><!-- /.box -->
                            <div class="text-right">
                <button class="btn btn-sm btn-primary" onclick="window.print();"><span class="glyphicon glyphicon-print"></span> Cetak</button>

                </div>
                        </div>
                    </div>
              <!-- row end -->
                </section><!-- /.content -->
                <?php include "footer.php"; ?>
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