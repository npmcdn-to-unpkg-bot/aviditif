<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" href="../img/favicon.ico">
    <title>Aviditif - Aplikasi Visualisasi Data Interaktif</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- CodeMirror Plugin -->
    <link href="../vendor/codemirror/lib/codemirror.css" rel="stylesheet">
    <link href="../vendor/codemirror/theme/3024-day.css" rel="stylesheet">
    <script src="../vendor/codemirror/lib/codemirror.js"></script>
    <script src="../vendor/codemirror/mode/javascript/javascript.js"></script>

    <!-- D3.js Plugin -->
    <script src="../vendor/d3js/d3.v3.min.js"></script>
    <script src="../vendor/d3js/box.js"></script>

    <!-- Font Awesome Plugin -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom Fonts -->
    <link href="../font/Montserrat.css" rel="stylesheet" type="text/css">
    <link href="../font/KaushanScript.css" rel='stylesheet' type='text/css'>
    <link href="../font/DroidSerif.css" rel='stylesheet' type='text/css'>
    <link href="../font/Roboto.css" rel='stylesheet' type='text/css'>

    <!-- CanVG Plugin -->
    <script type="text/javascript" src="../js/rgbcolor.js" ></script>
    <script type="text/javascript" src="../js/StackBlur.js" ></script>
    <script type="text/javascript" src="../js/canvg.js" ></script>

    <!-- Theme CSS -->
    <link href="../css/agency.css" rel="stylesheet">

    <style>
        .label-laki {
          color: #1f77b4;
        }
        .label-perempuan {
          color: #e377c2;
        }        
        .CodeMirror {
          height: auto;
        }
        .CodeMirror-scroll {
          max-height: 300px;
          min-height: 100px;
        }
        svg {
          font: 10px sans-serif;
        }
        .y.axis path {
          display: none;
        }
        .y.axis line {
          stroke: #fff;
          stroke-opacity: .2;
          shape-rendering: crispEdges;
        }
        .y.axis .zero line {
          stroke: #000;
          stroke-opacity: 1;
        }
        .title {
          font: 300 78px Helvetica Neue;
          fill: #666;
        }
        .birthyear,
        .age {
          text-anchor: middle;
        }
        .birthyear {
          fill: #fff;
        }
        rect {
          fill-opacity: .6;
          fill: #e377c2;
        }
        rect:first-child {
          fill: #1f77b4;
        }
        #wrapper {
            border: 2px;
            margin: 0 auto; /* to make the div center align to the browser */
            padding: 40px 40px 0px 40px;
            width: 1000px;
            text-align: center;
        }
        #wrapper2 {
            border: 2px;
            margin: 0 auto; /* to make the div center align to the browser */
            padding: 0px;
            width: 800px;
            text-align: center;
        }
        #wrapper ul {
            background: #aaa;
            padding: 10px;
            display: inline-block;
        }
        #wrapper ul li {
            color: #fff;
            display: inline-block;
            margin: 0 20px 0 0;
        }
        #wrapper ul li:last-child {
            color: #fff;
            display: inline-block;
            margin: 0;
        }
    </style>

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">12|<b>7231</b></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="../index.php">Home</a>
                    </li>
                    <li>
                        <a class='page-scroll' href='#builder'>Builder</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="../mail/signout.inc.php">Sign Out</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>


    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-heading">Aviditif</div>
                <div class="intro-lead-in text-muted2">Sistem Aplikasi Visualisasi Data Interaktif</div>

                <?php
                if (isset($_SESSION['userid'])) {
                    echo "<a href='../dboard/dashboard.php' class='page-scroll btn btn-xl'><i class='fa fa-tasks'></i> Dashboard</a>
                    <a>-----</a>
                    <a href='../mail/signout.inc.php' class='btn btn-xl'><i class='fa fa-sign-out'></i> Sign Out</a>";
                } else {
                    echo "<a href='#contact' class='page-scroll btn btn-xl'><i class='fa fa-user-plus'></i> Create Your Account</a>
                    <a>-----</a>
                    <a href='../signin.php' class='btn btn-xl'><i class='fa fa-sign-in'></i> Sign In</a>";
                }
                ?>
            </div>
        </div>
    </header>

    <!-- Visualization Builder -->
    <section id="builder" class="bg-white" style="padding-bottom: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Visualization Builder</h2>
                    <h3 class="section-subheading text-muted" style="margin-bottom: 5px;">Pilih jenis visualisasi yang kamu inginkan sesuai dengan jenis datamu.</h3>
                    <h3 class="section-subheading text-muted" style="margin-top: 5px;">Tidak yakin visualisasi yang tepat? Klik grafiknya, dan dapatkan informasi lebih lanjut!</h3>
                </div>
            </div>
            
            <div class="row">

                <!-- Project Details Go Here -->
                <div class="container">
                <form action="../mail/submitvisual.php" method="POST">
                    <h5><b><a href="http://bl.ocks.org/mbostock/4062085">Mike Bostock’s Block 4062085</a></b></h5>

                    <h2>Population Pyramid</h2>

                    <ul class="list-inline">
                        <li><span class="label label-success">BAR CHART</span></li>
                        <li><span class="label label-info">FOUR DIMENSIONAL DATA</span></li>
                        <li><span class="label label-danger">TRANSITION</span></li>
                    </ul>
                    <br>

                    <p class="item-intro text-muted">This diagram shows the distribution of age groups in the United States over the last 150 years. Use the arrow keys to observe the changing population. Data from the <a href="https://www.ipums.org/">Minnesota Population Center</a>. Use the arrow keys to change the displayed year. The blue bars are the male population for each five-year age bracket, while the pink bars are the female population; the bars are partially transparent so that you can see how they overlap, unlike the traditional <a href="https://en.wikipedia.org/wiki/Population_pyramid">side-by-side</a> display which makes it difficult to compare the relative distribution of the sexes.</p>
                    <br>

                    <p class="item-intro">Contoh format data: <p>

                    <textarea id="example"">year, age, sex, people
1950,  0,   1,  1483789
1960,  0,   2,  1450376
1970,  5,   1,  1411067</textarea>

                    <p><code>"year"</code> : didefenisikan sebagai tahun (4 digit).<br>
                    <code>"age"</code> : didefenisikan sebagai usia dalam periode 5 tahunan (1-2 digit).<br>
                    <code>"sex"</code> : didefenisikan sebagai jenis kelamin (1 digit). 1 = laki-laki, 2 = perempuan.<br>
                    <code>"people"</code> : didefenisikan sebagai jumlah penduduk.<br>
                    </p>

                    <br>
                    <div class="divider"></div>
                    <br>
                </div>


                <!-- INPUT DATA -->
                <div class="container">
                    <h3 align="center">Input Data</h3>
                    <div>
                        <script>
                            var sample = CodeMirror.fromTextArea(example, {
                                readOnly: true,
                                lineNumbers: true,
                                matchBrackets: true,
                                theme : '3024-day'
                            });
                        </script>
                    </div>
                    
                    <br>
                    
                    <p class="item-intro">Masukkan data dibawah header <code>"year, age, sex, people"</code>. Atau gunakan contoh data pada <a href="https://www.codegists.com/snippet/csv/populationcsv_pz37773n_csv"> halaman ini</a>.</p>
                        
                    <textarea id="values" name="values"></textarea>

                    <div>
                        <script>
                            var inputdata = CodeMirror.fromTextArea(values, {
                                lineNumbers: true,
                                matchBrackets: true,
                                theme : '3024-day'
                            });
                        </script>

                        <br>
                        <a id="generate" align="center" class="btn btn-primary btn-lg btn-block" role="button">Generate Visualization</a>
                    </div>

                    <br>

                    <br>
                    <div class="divider"></div>
                    <br>
                </div>


                <!-- HASIL VISUALISASI -->
                <div class="container">
                    <h3 align="center">Hasil Visualisasi</h3>

                    <div id="wrapper">
                        <div id="chart" class="row">
                            <?php
                                include '../d3/d3_poppyramid.php';
                            ?>
                        </div>
                    </div>

                    <div class="container" align="center">
                        <div class="legend">
                            <ul class="list-inline">
                                <li><h6>Keterangan: </h6></li>
                                <li><h6><i class="fa fa-square label-laki"></i> Laki-Laki</h6></li>
                                <li><h6><i class="fa fa-square label-perempuan"></i> Perempuan</h6></li>
                            </ul>
                        </div><br>
                    </div>

                    <div id="wrapper2">
                        <div class="alert alert-warning" role="alert"><i class="fa fa-info-circle fa-fw"></i><h4>TIPS</h4>Gerakkan <i>arrow button</i> ke kanan dan ke kiri untuk merubah variabel tahun dan melihat pergerakan perubahan distribusi populasinya.</div>
                    </div>

                    <br>
                    <div class="divider"></div>
                    <br>
                </div>


                <!-- SAVE HASIL -->
                <div class="container">
                    <h3 align="center">Simpan Hasil Visualisasi</h3>
                    
                    <br><br>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="vizid"><h5>Jenis Visualisasi</h5></label>
                                            <input type="text" readOnly="true" class="form-control" style="height: 47px;" placeholder="Population Pyramid">
                                            <input type="hidden" readOnly="true" class="form-control" id="vizid" name="vizid" style="height: 47px;" value="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="graftitle"><h5>Judul*</h5></label>
                                            <input type="text" class="form-control-save" id="graftitle" name="graftitle" placeholder="Title">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="grafyear"><h5>Tahun</h5></label>
                                            <input type="text" class="form-control-save" id="grafyear" name="grafyear" placeholder="Tahun">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="grafpubno" class="text muted"><h5>Nomor Publikasi</h5></label>
                                            <input type="text" class="form-control" id="grafpubno" name="grafpubno" style="height: 47px;" placeholder="Nomor Publikasi">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="text muted"><h5 style="margin-bottom:-5px">Bidang dan Jenis Publikasi</h5></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <!-- SOSIAL & KEPENDUDUKAN -->
                                            <div class="radio">
                                                <label>
                                                    <input onclick="document.getElementById('pubbid1').disabled = false; document.getElementById('pubbid2').disabled = true; document.getElementById('pubbid3').disabled = true;" type="radio" name="pubbid" id="bidsk" checked>
                                                    <h6 class="text-muted" style="margin-top:4px; margin-bottom:0px;">Sosial &amp; Kependudukan</h6>
                                                </label>
                                            </div>
                                            <select id="pubbid1" name="pubid" class="form-control" style="height: 47px;">
                                                <option value="0">Pilih Jenis Publikasi</option>
                                                <option value="1">Gender</option>
                                                <option value="2">Geografi</option>
                                                <option value="3">Iklim</option>
                                                <option value="4">Indeks Pembangunan Manusia</option>
                                                <option value="5">Kemiskinan</option>
                                                <option value="6">Kependudukan</option>
                                                <option value="7">Kesehatan</option>
                                                <option value="8">Konsumsi dan Pengeluaran</option>
                                                <option value="9">Lingkungan Hidup</option>
                                                <option value="10">Pemerintahan</option>
                                                <option value="11">Pendidikan</option>
                                                <option value="12">Perumahan</option>
                                                <option value="13">Politik dan Keamanan</option>
                                                <option value="14">Potensi Desa</option>
                                                <option value="15">Sosial Budaya</option>
                                                <option value="16">Tenaga Kerja</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <!-- EKONOMI & PERDAGANGAN -->
                                            <div class="radio">
                                                <label>
                                                    <input onclick="document.getElementById('pubbid1').disabled = true; document.getElementById('pubbid2').disabled = false; document.getElementById('pubbid3').disabled = true;" type="radio" name="pubbid" id="bidep">
                                                    <h6 class="text-muted" style="margin-top:4px; margin-bottom:0px;">Ekonomi &amp; Perdagangan</h6>
                                                </label>
                                            </div>
                                            <select id="pubbid2" name="pubid" class="form-control" style="height: 47px;" disabled="disable">
                                                <option value="0">Pilih Jenis Publikasi</option>
                                                <option value="17">Ekspor-Impor</option>
                                                <option value="18">Energi</option>
                                                <option value="19">Harga Eceran</option>
                                                <option value="20">Harga Perdagangan Besar</option>
                                                <option value="21">Harga Produsen</option>
                                                <option value="22">Industri Besar dan Sedang</option>
                                                <option value="23">Industri Mikro dan Kecil</option>
                                                <option value="24">Inflasi</option>
                                                <option value="25">Input output</option>
                                                <option value="26">ITB-ITK</option>
                                                <option value="27">Keuangan</option>
                                                <option value="28">Komunikasi</option>
                                                <option value="29">Konstruksi</option>
                                                <option value="30">Neraca Arus Dana</option>
                                                <option value="31">Neraca Sosial Ekonomi</option>
                                                <option value="32">Nilai Tukar Petani</option>
                                                <option value="33">Pariwisata</option>
                                                <option value="34">Produk Domestik Bruto (Lapangan Usaha)</option>
                                                <option value="35">Produk Domestik Bruto (Pengeluaran)</option>
                                                <option value="36">Produk Domestik Regional Bruto (Lapangan Usaha)</option>
                                                <option value="37">Produk Domestik Regional Bruto (Pengeluaran)</option>
                                                <option value="38">Transportasi</option>
                                                <option value="39">Upah Buruh</option>
                                                <option value="40">Usaha Mikro Kecil</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <!-- PERTANIAN & PERTAMBANGAN -->
                                            <div class="radio">
                                                <label>
                                                    <input onclick="document.getElementById('pubbid1').disabled = true; document.getElementById('pubbid2').disabled = true; document.getElementById('pubbid3').disabled = false;" type="radio" name="pubbid" id="bidpp">
                                                    <h6 class="text-muted" style="margin-top:4px; margin-bottom:0px;">Pertanian &amp; Pertambangan</h6>
                                                </label>
                                            </div>
                                            <select id="pubbid3" name="pubid" class="form-control" style="height: 47px;" disabled="disable">
                                                <option value="0">Pilih Jenis Publikasi</option>
                                                <option value="41">Hortikultura</option>
                                                <option value="42">Kehutanan</option>
                                                <option value="43">Perikanan</option>
                                                <option value="44">Perkebunan</option>
                                                <option value="45">Pertambangan</option>
                                                <option value="46">Peternakan</option>
                                                <option value="47">Tanaman Pangan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text muted"><h5>Deskripsi*</h5></label>
                                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="8"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text muted"><h5>Data</h5></label>
                                            <textarea class="form-control" readonly="readonly" id="grafdata" name="grafdata" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="checkbox" style="margin-top: 7px;">
                                            <label>
                                                <input type="checkbox" id="shareflag" name="shareflag" value="1"> <h5 style="margin-top: 3px;">Share Publikasi</h5>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="checkbox" style="margin-top: 7px;">
                                            <label>
                                                <input type="checkbox" id="savedata" name="savedata" value="1" onclick="clonedata(this.form)"> <h5 style="margin-top: 3px;"">Simpan Data</h5>
                                                <script>
                                                    function clonedata(f) {
                                                      if(f.savedata.checked == true) {
                                                        f.grafdata.value = inputdata.getValue();
                                                      } else {
                                                        f.grafdata.value = null;
                                                      }
                                                    }
                                                </script>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div align="right"><button type="submit" name="action" class="btn btn-primary" role="button"><i class="fa fa-upload">.</i> Save Visualization</button></div>
                                    </div>
                                </div>
                                <br>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <br><br>
                    <div class="divider"></div>
                </div>

            </div>
            </form>
        </div>
    </section>

     <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; 2016 Muhammad Arif Maulana <br> All Rights Reserved</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href='https://github.com/namiratulzahra'><i class='fa fa-github'></i></a>
                        </li>
                        <li><a href='https://www.facebook.com/muh.arif.maulana'><i class='fa fa-facebook'></i></a>
                        </li>
                        <li><a href='https://marifmaulana.tumblr.com'><i class='fa fa-tumblr'></i></a>
                        </li>
                        <li><a href='mailto:marifmaulana@live.com'><i class='fa fa-envelope'></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../js/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="../js/jqBootstrapValidation.js"></script>
    <script src="../js/signup.js"></script>

    <!-- Theme JavaScript -->
    <script src="../js/agency.min.js"></script>

</body>

</html>