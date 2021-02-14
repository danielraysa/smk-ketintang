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

$jml_buku = mysql_query("SELECT * FROM data_buku");
$count_buku = mysql_num_rows($jml_buku);
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
                                    <b>Input Buku</b>

                                </header>
                                <!-- <div class="box-header"> -->
                                    <!-- <h3 class="box-title">Responsive Hover Table</h3> -->

                                <!-- </div> -->
                                <div class="panel-body">
                      <form class="form-horizontal style-form" style="margin-top: 20px;" action="insert-buku.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Kode Buku</label>
                              <div class="col-sm-8">
                                  <input name="kode" type="text" id="id" class="form-control" placeholder="Harus Di Isi" autofocus="on" required="" readonly/>
								  <!-- <label> Harus diisi, Contoh : 001.002. Contoh tersebut 3 digit awal 001 adalah nomor kategori buku agama, kemudian 3 digit 002 adalah urutan buku</label> -->
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">No. DDC</label>
                              <div class="col-sm-8">
                                  <input name="no_ddc" type="text" id="no_ddc" class="form-control" autocomplete="off" placeholder="No. DDC" required="" onchange="generateId()"/>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Judul</label>
                              <div class="col-sm-8">
                                  <input name="judul" type="text" id="judul" class="form-control" autocomplete="off" placeholder="Judul Buku" required="" onchange="generateId()"/>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Pengarang</label>
                              <div class="col-sm-8">
                                  <input name="pengarang" type="text" id="pengarang" class="form-control" autocomplete="off" placeholder="Pengarang" required="" onchange="generateId()"/>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tahun Terbit</label>
                              <div class="col-sm-8">
                                  <input name="th_terbit" type="text" id="th_terbit" class="form-control" autocomplete="off" placeholder="Tahun Terbit" required="" />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Penerbit</label>
                              <div class="col-sm-8">
                                  <input name="penerbit" type="text" id="penerbit" class="form-control" autocomplete="off" placeholder="Penerbit" required="" />
                              </div>
                          </div>
                         <!-- <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">ISBN</label>
                              <div class="col-sm-8">
                                  <input name="isbn" type="text" id="isbn" class="form-control" autocomplete="off" placeholder="ISBN" required="" />
                              </div>
                          </div>-->
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Kategori</label>
                              <div class="col-sm-8">
                                  <input name="kategori" type="text" id="Kategori" class="form-control" autocomplete="off" placeholder="Kategori" required="" />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Kode Kelas</label>
                              <div class="col-sm-4">
                                  <select class="form-control" name="kode_klas" id="kode_klas" >
                                  <option value=""> -- Pilih Salah Satu --</option>
                                  <option value="X"> X</option>
                                  <option value="XI"> XI</option>
                                  <option value="XII"> XII</option>
								  <option value="UMUM"> UMUM</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Jumlah Buku</label>
                              <div class="col-sm-8">
                                  <input name="jumlah_buku" type="text" id="jumlah_buku" class="form-control" autocomplete="off" placeholder="Jumlah Buku" required />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Lokasi Rak</label>
                              <div class="col-sm-4">
                                    <select name="lokasi" id="lokasi" class="form-control" autocomplete="off" placeholder="Lokasi Buku" required onchange="generateId()">
                                    <option value=""> -- Pilih Salah Satu --</option>
                                        <option value="Rak H1" data-id="H1">Rak H1</option>
                                        <option value="Rak A3" data-id="A3">Rak A3</option>
                                        <option value="Rak A2" data-id="A2">Rak A2</option>
                                        <option value="Rak A1" data-id="A1">Rak A1</option>
                                    </select>
                                  <!-- <input name="lokasi" type="text" id="lokasi" class="form-control" autocomplete="off" placeholder="Lokasi Buku" required /> -->
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Asal</label>
                              <div class="col-sm-4">
                                  <select class="form-control" name="asal" id="asal" required >
                                  <option value=""> -- Pilih Salah Satu --</option>
                                  <option value="Pembelian"> Pembelian</option>
                                  <option value="Sumbangan"> Sumbangan</option>
                                  <option value="Denda"> Denda</option>
                                  </select>
                              </div>
                          </div>
                          <!-- <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Jumlah Per Rak</label>
                              <div class="col-sm-8">
                                  <input name="jum_temp" type="text" id="jum_temp" class="form-control" autocomplete="off" placeholder="Jumlah Per Rak" required />
                              </div>
                          </div>-->
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tanggal Input</label>
                              <div class="col-sm-8">
                                  <input name="tgl_input" type="text" id="tgl_input" class="form-control" autocomplete="off" value="<?php echo "".date("Y/m/d").""; ?>" readonly="readonly" />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Foto</label>
                              <div class="col-sm-8">
                                  <input name="nama_file" id="nama_file" type="file" />
                              </div>
                          </div>
                          <div class="form-group" style="margin-bottom: 20px;">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-8">
                                  <input type="submit" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
	                              <a href="input-anggota.php" class="btn btn-sm btn-danger">Batal </a>
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

            function generateId(){
                var jml_buku = <?php echo json_encode($count_buku); ?>;
                var ddc = $('#no_ddc').val();
                var judul = $('#judul').val();
                var pengarang = $('#pengarang').val();
                var lokasi = $('#lokasi').find(":selected").attr('data-id');
                if(!lokasi){
                    lokasi = "";
                }
                var hasil = ddc+pengarang.substr(0,3)+judul.substr(0,1)+lokasi;
                $('#id').val(hasil);
                // alert(hasil);
                // return hasil;
            }
        </script>

</body>
</html>