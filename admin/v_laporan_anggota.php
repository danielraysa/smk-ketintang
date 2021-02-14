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
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <b>Filter Data</b>
                                </div>
                                <div class="panel-body">
                                    <form action="" method="get">
                                        <label for="class">Kelas</label>
                                        <div class="input-group col-sm-6">
                                            <select name="class" id="class" class="form-control">
                                                <option value="">--- Pilih Kelas ---</option>
                                                <option value="X"> X</option>
												<option value="XI"> XI</option>
												<option value="XII"> XII</option>
                                            </select>
                                        </div>
                                        <label for="jurusan">Jurusan</label>
                                        <div class="input-group col-sm-6">
                                            <select name="jurusan" id="jurusan" class="form-control">
                                                <option value="">--- Pilih Jurusan ---</option>
                                                <option value="AKL1"> AKL 1</option>
												<option value="AKL2"> AKL 2</option>
												<option value="AKL3"> AKL 3</option>
												<option value="AKL4"> AKL 4</option>
												<option value="OTKP1"> OTKP 1</option>
												<option value="OTKP2"> OTKP 2</option>
												<option value="OTKP3"> OTKP 3</option>
												<option value="OTKP4"> OTKP 4</option>
												<option value="OTKP5"> OTKP 5</option>
												<option value="BDP1"> BDP 1</option>
												<option value="BDP2"> BDP 2</option>
												<option value="TKJ1"> TKJ 1</option>
												<option value="TKJ2"> TKJ 2</option>
												<option value="MM1"> MM 1</option>
												<option value="MM2"> MM 2</option>
                                            </select>
                                        </div>
                                        <br>
                                        <input type="submit" value="Filter" name="submit" class="btn btn-primary">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel">
                                <header class="panel-heading">
                                    <b>Data Anggota</b>
                                    <form action="laporan-anggota.php" method="get" class="pull-right">
                                        <?php if(isset($_GET['class'])): ?>
                                            <input type="hidden" name="class" value="<?= $_GET['class'] ?>">
                                        <?php endif ?>
                                        <?php if(isset($_GET['jurusan'])): ?>
                                            <input type="hidden" name="jurusan" value="<?= $_GET['jurusan'] ?>">
                                        <?php endif ?>
                                        <input type="submit" value="Export to Pdf" name="submit" class="btn btn-sm btn-primary">
                                    </form>
                                </header>
                                <!-- <div class="box-header"> -->
                                    <!-- <h3 class="box-title">Responsive Hover Table</h3> -->

                                <!-- </div> -->
                                <div class="panel-body table-responsive">
                                    <?php

                                    $query1="select * from data_anggota ";
                                    
                                    if (isset($_GET['submit'])) {
                                        $class = $_GET['class'];
                                        $jurusan = $_GET['jurusan'];

                                        if ($class != null || $jurusan != null) {
                                            $query1 .= 'where ';
                                        }

                                        if ($class != null && $jurusan != null) {
                                            $query1 .= "kelas='$class' and jurusan='$jurusan'";
                                        } else if ($class) {
                                            $query1 .= "kelas='$class'";
                                        } else if ($jurusan){
                                            $query1 .= "jurusan='$jurusan'";
                                        }
                                    }
                    $tampil=mysql_query($query1) or die(mysql_error());
                    ?>
                                    <table id="example" class="table table-hover table-bordered">
                  <thead>
                      <tr>
                        <th><center>Nomor Induk </center></th>
                        <th><center>Nama </center></th>
                        <th><center>Gender </center></th>
                        <th><center>Kelas </center></th>
                        <th><center>Jurusan </center></th>
                        <th><center>Tempat Lahir </center></th>
                        <th><center>Alamat </center></th>
                      </tr>
                  </thead>
                     <?php while($data=mysql_fetch_array($tampil))
                    { ?>
                    <tbody>
                    <tr>
                    <td><?php echo $data['no_induk']; ?></td>
                    <td><a href="detail-anggota.php?hal=edit&kd=<?php echo $data['id'];?>"><span class="fa fa-user"></span> <?php echo $data['nama']; ?></a></td>
                    <td><?php echo $data['jk'];?></td>
                    <td><?php echo $data['kelas'];?></td>
                    <td><?php echo $data['jurusan'];?></td>
                    <td><?php echo $data['ttl'];?></td>
                    <td><?php echo $data['alamat'];?></td>
                 <?php   
              } 
              ?>
                   </tbody>
                   </table>
                   
                  <?php $tampil=mysql_query($query1);
                        $user=mysql_num_rows($tampil);
                    ?>
                  <center><h4>Jumlah Anggota : <?php echo "$user"; ?> Orang </h4> </center>
                  
                <div class="text-right" style="margin-top: 10px;">
                 <a href="v_laporan_anggota.php" class="btn btn-sm btn-info">Refresh Anggota <i class="fa fa-refresh"></i></a>
                </div>
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