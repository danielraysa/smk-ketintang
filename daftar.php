<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="PerPusWeb (Perpustakaan Berbasis Web)">
    <meta name="author" content="Hakko Bio Richard">
    <link rel="icon" href="../../favicon.ico">

    <title>Perpustakaan Berbasis Web www.smkketintang.sch.id</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body background="img/page-background.png">

    <div class="container">

      <section class="content">
<center><h2 class="form-signin-heading"><!-- <img src="img/logo2.png" height="40" width="40" style="margin-bottom: 4px;" />--> Form Daftar Anggota </h2></center>
        
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel">
                                <header class="panel-heading">
                                    <b>Form Pendaftaran Anggota</b>

                                </header>
                                <!-- <div class="box-header"> -->
                                    <!-- <h3 class="box-title">Responsive Hover Table</h3> -->

                                <!-- </div> -->
                                <div class="panel-body">
                      <form class="form-horizontal style-form" style="margin-top: 20px;" action="anggota/insert-anggota.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                          <!--<div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">ID Anggota</label>
                              <div class="col-sm-8">
                                  <input name="id" type="text" id="id" class="form-control" placeholder="Tidak perlu di isi" autofocus="on" readonly="readonly" />
                              </div>
                          </div>-->
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">No Induk</label>
                              <div class="col-sm-8">
                                  <input name="no_induk" type="text" id="no_induk" class="form-control" placeholder="Ex : 00123" required />
                                  <!--<span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>-->
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nama</label>
                              <div class="col-sm-8">
                                  <input name="nama" type="text" id="nama" class="form-control" placeholder="Nama" required />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Jenis Kelamin</label>
                              <div class="col-sm-3">
                                  <select class="form-control" name="jk" id="jk">
                                  <option> -- Pilih Salah Satu --</option>
                                  <option value="L"> Laki - Laki</option>
                                  <option value="P"> Perempuan</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Kelas</label>
                              <div class="col-sm-3">
                                  <select class="form-control" name="kelas" id="kelas">
                                  <option value=""> -- Pilih Salah Satu --</option>
                                  <option value="X"> X</option>
                                  <option value="XI"> XI</option>
                                  <option value="XII"> XII</option>
                                  </select>
                              </div>
                          </div>
						   <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"> Jurusan </label>
                              <div class="col-sm-3">
                                  <select class="form-control" name="jurusan" id="jurusan">
                                  <option value="">  -- Pilih Salah Satu --</option>
                                  <option value="AKL 1"> AKL 1</option>
                                  <option value="AKL 2"> AKL 2</option>
                                  <option value="AKL 3"> AKL 3</option>
                                  <option value="AKL 4"> AKL 4</option>
                                  <option value="OTKP 1"> OTKP 1</option>
                                  <option value="OTKP 2"> OTKP 2</option>
                                  <option value="OTKP 3"> OTKP 3</option>
                                  <option value="OTKP 4"> OTKP 4</option>
                                  <option value="OTKP 5"> OTKP 5</option>
                                  <option value="BDP 1"> BDP 1</option>
                                  <option value="BDP 2"> BDP 2</option>
                                  <option value="TKJ 1"> TKJ 1</option>
                                  <option value="TKJ 2"> TKJ 2</option>
                                  <option value="MM 1"> MM 1</option>
                                  <option value="MM 2"> MM 2</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tempat Tanggal Lahir</label>
                              <div class="col-sm-8">
                                  <input name="ttl" class="form-control" id="ttl" type="text" placeholder="Tempat Tanggal Lahir" required />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Alamat</label>
                              <div class="col-sm-8">
                                  <input name="alamat" class="form-control" id="alamat" type="text" placeholder="Alamat" required />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Email</label>
                              <div class="col-sm-8">
                                  <input name="email" class="form-control" id="email" type="text" placeholder="Email" required="email" />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Password</label>
                              <div class="col-sm-8">
                                  <input name="password" class="form-control" id="password" type="password" placeholder="Password" required />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Foto</label>
                              <div class="col-sm-8">
                                  <input name="nama_file" id="nama_file" type="file" class="form-control" required />
                              </div>
                          </div>
                          <div class="form-group" style="margin-bottom: 20px;">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-8">
                                  <input type="submit" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
	                              <a href="index.php" class="btn btn-sm btn-danger">Batal </a>
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

    </div> <!-- /container -->
    
    <center><h5 class="form-signin">Copyright &copy; <a href="#" data-toggle="modal" data-target="#contact">www.smkketintang.sch.id</a></h5></center> 
    
     <!-- Modal Dialog Contact -->
<!-- <div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Contact Us</h4>
      </div>
      <div class="modal-body">
      PerPusWeb adalah aplikasi perpustakaan bebasis website yang responsif, PerPusWeb dibuat oleh
       Hakko Bio Richard yang dapat dihubungi di :
      <table>
      <tr>
      <td>No Telepon</td> <td>:</td> <td>0856 949 848 03</td>
      </tr>
      <br />
      <tr>
      <td>E-mail</td><td>:</td> <td><a href="mailto:hakkobiorichard@gmail.com">hakkobiorichard@gmail.com</a> | <a href="mailto:hakko_bio_richard@yahoo.co.id">hakko_bio_richard@yahoo.co.id</a></td>
      </tr> 
      <br />
      <tr>
      <td>Blog</td>       <td>:</td> <td><a href="http://www.hakkoblogs.com" target="_blank">www.hakkoblogs.com</a></td>
      </tr>
      <br />
      <tr>
      <td>Website</td>    <td>:</td> <td><a href="http://www.niqoweb.com" target="_blank">www.niqoweb.com</a></td>
      </tr>
       </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> -->
<!-- end dialog modal -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
