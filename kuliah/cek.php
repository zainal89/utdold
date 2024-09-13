<!DOCTYPE html>
<?php
if(isset($_GET['t'])){
    include "../config/func_koneksi.php";
    include "../config/func_sql.php";
    $tiket = $_GET['t'];
    $ket = " <p style='color: red;font-size: .75em;'>(\nSimpan nomor tiket ini untuk melihat progres permohonan) </p>";
    $qry = coc_sql("SHOW", "tb_aktif", "*", "ticket='$tiket'");
    $r = $qry->fetch_array();
    $tiket = $tiket."\n".$ket;
    $nim = $r['nim'];
    $nama = $r['nama'];
    $prodi = $r['prodi'];
    $email = $r['email'];
    $smt = $r['smt'];
    $wa = $r['wa'];
    $pa = $r['pa'];
    $status = $r['status'];
}else{
    $tiket = "-";
    $nim = "-";
    $nama = "-";
    $prodi = "-";
    $email = "-";
    $smt = "-";
    $wa = "-";
    $pa = "-";
    $status = "-";
}
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Surat Aktif Kuliah</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="#" class="navbar-brand">
        <img src="../../dist/img/atim.png" alt="ATIM" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Politeknik ATI Makassar</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm" method="GET" action="?">
            <input class="form-control form-control-navbar" type="search" name="t" id="t" placeholder="Ticket" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Permohonan Surat Keterangan Aktif Kuliah</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <!--<ol class="breadcrumb float-sm-right">-->
            <!--  <li class="breadcrumb-item"><a href="#">Home</a></li>-->
            <!--  <li class="breadcrumb-item"><a href="#">Layout</a></li>-->
            <!--  <li class="breadcrumb-item active">Top Navigation</li>-->
            <!--</ol>-->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
  
          <!-- /.col-md-6 -->
          <div class="col-lg-12">

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="card-title m-0">Data Pemohon</h5>
              </div>
              <div class="card-body">
                    <form class="form-horizontal" id="myform">
                    <div class="card-body">
                        
                      <div class="form-group row">
                        <label for="fNim" class="col-sm-3 col-form-label">Tiket</label>
                        <div class="col-sm-9 input-group input-group-sm">
                        <label for="fNim" class="col-sm-9 col-form-label"><?=$tiket?></label>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="fNim" class="col-sm-3 col-form-label">NIM</label>
                        <div class="col-sm-9 input-group input-group-sm">
                        <label for="fNim" class="col-sm-9 col-form-label"><?=$nim?></label>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="fNama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                          <label for="fNama" class="col-sm-9 col-form-label"><?=$nama?></label>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="fProdi" class="col-sm-3 col-form-label">Program Studi</label>
                        <div class="col-sm-9">
                          <label for="fProdi" class="col-sm-9 col-form-label"><?=$prodi?></label>
                        </div>
                      </div>
                    
                    <div class="form-group row">
                        <label for="fEmail" class="col-sm-3 col-form-label">Semester</label>
                        <div class="col-sm-9">
                          <label for="fEmail" class="col-sm-9 col-form-label"><?=$smt?></label>
                        </div>
                      </div>
                      
                        <div class="form-group row">
                        <label for="fEmail" class="col-sm-3 col-form-label">E-Mail</label>
                        <div class="col-sm-9">
                          <label for="fEmail" class="col-sm-9 col-form-label"><?=$email?></label>
                        </div>
                      </div>
                        
                        <div class="form-group row">
                        <label for="fPa" class="col-sm-3 col-form-label search-box">Pembimbing Akademik</label>
                        <div class="col-sm-9">
                          <label for="fPa" class="col-sm-9 col-form-label search-box"><?=$pa?></label>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="fPa" class="col-sm-3 col-form-label search-box">Status</label>
                        <div class="col-sm-9">
                          <label for="fPa" class="col-sm-9 col-form-label search-box"><?=$status?></label>
                        </div>
                      </div>
                      
                      
                      
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <a href="../kuliah" class="btn btn-info float-right">Kembali</a>
                    </div>
                    <!-- /.card-footer -->
                  </form>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2024 <a href="https://www.atim.ac.id">Jiraiya</a>.</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script>
    function fetchData() {
    var nim = document.getElementById('fNim').value;
    var prodiku = "Tidak Ditemukan";
    fetch('get_mahasiswa.php?nim=' + nim)
    .then(response => response.json())
    .then(data => {
        if (data) {
            document.getElementById('fNama').value = data.nama;
            document.getElementById('fdNama').value = data.nama;
            if(data.prodi == "7"){prodiku = "Otomasi Sistem Permesinan";}
            document.getElementById('fdProdi').value = prodiku;
            document.getElementById('fProdi').value = prodiku;
            document.getElementById('fEmail').value = data.email;
            document.getElementById('fdEmail').value = data.email;
        } else {
            alert('Data tidak ditemukan');
            let form = document.getElementById('myform');
            form.reset();
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#fPa').on('input', function(){
            var query = $(this).val();
            if(query !== '') {
                $.ajax({
                    url: 'get_dosen.php',
                    method: 'POST',
                    data: {query: query},
                    success: function(data) {
                        $('.result').html(data);
                        $('.result').css('display', 'block');
                    }
                });
            } else {
                $('.result').css('display', 'none');
            }
        });

        $(document).on('click', 'p', function(){
            $('#fPa').val($(this).text());
            $('.result').css('display', 'none');
        });
    });
</script>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
