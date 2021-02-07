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
                        <div class="col-xs-12">
                            <div class="panel">
                                <header class="panel-heading">
                                    <b>Input Peminjaman Buku</b>

                                </header>
                                <!-- <div class="box-header"> -->
                                    <!-- <h3 class="box-title">Responsive Hover Table</h3> -->
                        <?php
                        $hr             = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
                        $hari           = date("w");
                        //$hari1           = date("w")+1;
                        $hari_ini       = $hr[$hari];
                        //$next = $hr[$hari1];
                        $pinjam			= date("Y-m-d");
                        $maxpinjam		= mktime(0,0,0,date("n"),date("j")+6,date("Y"));
                        $maxpinjam1		= mktime(0,0,0,date("n"),date("j")+7,date("Y"));
                        $kembali		= date("Y-m-d", $maxpinjam);
                        $kembali1		= date("Y-m-d", $maxpinjam1);
                        ?>
                                <!-- </div> -->
                                <div class="panel-body">
                      <form class="form-horizontal style-form" style="margin-top: 20px;" action="insert-transaksi.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Judul Buku</label>
                              <div class="col-sm-4">
                                  <select class="form-control select2" name="buku" id="buku" required>
                                  <option value=""> -- Pilih Salah Satu --</option>
                                <?php
                                    $sql = mysql_query("SELECT * FROM data_buku ORDER BY id ASC");
                                    if(mysql_num_rows($sql) != 0){
                                    while($data = mysql_fetch_assoc($sql)){
                                    echo '<option value='.$data['id'].'-'.$data['judul'].'>'.$data['judul'].'</option>'; }
                                    ?>
                                  </select>
                              </div>
                          </div>
                          <?php }
                                ?>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">No. Induk</label>
                              <div class="col-sm-4">
                                  <select class="form-control select2" name="nama" id="nama" required>
                                  <option value=""> -- Pilih Salah Satu --</option>
                                <?php
                                    $sql = mysql_query("SELECT * FROM data_anggota ORDER BY id ASC");
                                    if(mysql_num_rows($sql) != 0){
                                    while($data = mysql_fetch_assoc($sql)){
                                    // echo '<option value='.$data['id'].'-'.$data['no_induk'].'>'.$data['no_induk'].' - '.$data['nama'].'</option>'; }
                                    echo '<option value='.$data['no_induk'].'>'.$data['no_induk'].' - '.$data['nama'].'</option>'; }
                                    }
                                ?>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tanggal Pinjam</label>
                              <div class="col-sm-2">
                               <input type="text" id="pinjam" name="pinjam" class="form-control" value="<?php echo $pinjam; ?>" readonly="readonly" >   
                              </div>
                          </div>
                          <div class="form-group"> 
                              <label class="col-sm-2 col-sm-2 control-label">Tanggal Kembali</label>
                              <div class="col-sm-3">
                                  <input type="date" id="kembali" name="kembali" class="form-control" value="<?php echo $kembali;//if($next == 'Minggu') {echo $kembali1;} else {echo $kembali;} ?>">
                                  <!--<span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>-->
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Keterangan</label>
                              <div class="col-sm-8">
                                  <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" >
                                  <!--<span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>-->
                              </div>
                          </div>
                          <div class="form-group" style="margin-bottom: 20px;">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-8">
                                  <input type="submit" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
	                              <a href="input-transaksi.php" class="btn btn-sm btn-danger">Batal </a>
                              </div>
                          </div>
                          <div style="margin-top: 20px;"></div>
                      </form>
                                </div>
                            </div><!-- /.box -->
                        </div>
                    </div>
              <!-- row end -->
                </section><!-- /.content -->
                <?php include "footer.php"; ?>
            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->


        <script src="../js/jQuery-2.1.4.min.js"></script>
        
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        
        <script src="../js/Director/app.js" type="text/javascript"></script>

        <script src="../js/select2/select2.full.min.js"></script>
        
        <script>
        $(function () {
            $(".select2").select2();
        });
        </script>

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
                    labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
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