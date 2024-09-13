<?php 
$data_mhs = coc_sql("SHOW", "tb_mhs", "*", "id_mhs = '$_SESSION[s_id_mhs]'");
$r = $data_mhs->fetch_array();
$user_foto = $r['foto'];
$user_kartu= $r['id_kartu'];
$user_nama = $r['nama'];
$user_nim  = $r['nim'];
$user_ktp  = $r['ktp'];
$user_hp   = $r['hp'];
$user_prd  = $r['prodi'];
$user_prodi= coc_value("z_prodi", "nama", "kode_prodi='$user_prd'");
$user_em   = $r['email'];
$user_pwd  = $r['pwd'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OSP Absen</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=pathplugins?>fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=pathdist?>css/adminlte.min.css">
  <!-- dropzonejs -->
  <!-- <link rel="stylesheet" href="<?=pathplugins?>dropzone/min/dropzone.min.css"> -->
  <link rel="stylesheet" href="<?=pathplugins?>jsqr/css/qrcode-reader.css">

  <link rel="stylesheet" href="<?=pathplugins?>datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=pathplugins?>datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=pathplugins?>datatables-buttons/css/buttons.bootstrap4.min.css">

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?=pathimgapp?>atim.png" alt="Absen Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Absen OSP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=pathfotomhs?><?=$user_foto?>" class="img-circle elevation-2" alt="<?=$user_nama?>">
        </div>
        <div class="info">
          <a href="?act=edit" class="d-block"><?=$user_nama?></a>
        </div>
      </div>
      <?php include "menu.php";?>
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <?php include "content.php";?>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>&copy; 2021 <a href="#">COC Design</a></strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?=pathplugins?>jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="<?=pathplugins?>bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=pathdist?>js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=pathdist?>js/demo.js"></script>

<!-- <script src="<?=pathplugins?>dropzone/min/dropzone.min.js"></script> -->

<script src="<?=pathplugins?>jsqr/js/qrcode-reader.min.js?v=20190604"></script>

<script src="<?=pathplugins?>datatables/jquery.dataTables.min.js"></script>

<script src="<?=pathplugins?>datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="<?=pathplugins?>datatables-responsive/js/dataTables.responsive.min.js"></script>

<script src="<?=pathplugins?>datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="<?=pathplugins?>datatables-buttons/js/dataTables.buttons.min.js"></script>

<script src="<?=pathplugins?>datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script src="<?=pathplugins?>jszip/jszip.min.js"></script>

<script src="<?=pathplugins?>pdfmake/pdfmake.min.js"></script>

<script src="<?=pathplugins?>pdfmake/vfs_fonts.js"></script>

<script src="<?=pathplugins?>datatables-buttons/js/buttons.html5.min.js"></script>

<script src="<?=pathplugins?>datatables-buttons/js/buttons.print.min.js"></script>

<script src="<?=pathplugins?>datatables-buttons/js/buttons.colVis.min.js"></script>

<script type="text/javascript">
  $(function (){
    $("#tabeldata").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });

  $(function (){
    $("#tabelabsen").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>


</body>
</html>
