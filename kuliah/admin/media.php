<?php 
$data_dosen = coc_sql("SHOW", "tb_mimin", "*", "id = '$_SESSION[s_id_dosen]'");
$r = $data_dosen->fetch_array();
$user_foto = $r['foto'];
$user_nama = $r['nama'];
$user_nip  = $r['email'];
$user_hp   = $r['hp'];
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
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../<?=pathplugins?>fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../<?=pathdist?>css/adminlte.min.css">

  <link rel="stylesheet" href="../<?=pathplugins?>datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../<?=pathplugins?>datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<../?=pathplugins?>datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Select2 -->
  <link rel="stylesheet" href="../<?=pathplugins?>select2/css/select2.min.css">
  <link rel="stylesheet" href="../<?=pathplugins?>select2-bootstrap4-theme/select2-bootstrap4.min.css">

   <!-- daterange picker -->
  <link rel="stylesheet" href="../<?=pathplugins?>tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
 

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
      <img src="../<?=pathimgapp?>atim.png" alt="Absen Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">OSP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../<?=pathfotodosen?><?=$user_foto?>" class="img-circle elevation-2" alt="<?=$user_nama?>">
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
<script src="../<?=pathplugins?>jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../<?=pathplugins?>bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../<?=pathdist?>js/adminlte.min.js"></script>
<!-- AdminLTE../ for demo purposes -->
<script src="../<?=pathdist?>js/demo.js"></script>

<script src="../<?=pathplugins?>datatables/jquery.dataTables.min.js"></script>

<script src="../<?=pathplugins?>datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="../<?=pathplugins?>datatables-responsive/js/dataTables.responsive.min.js"></script>

<script src="../<?=pathplugins?>datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="../<?=pathplugins?>datatables-buttons/js/dataTables.buttons.min.js"></script>

<script src="../<?=pathplugins?>datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script src="../<?=pathplugins?>jszip/jszip.min.js"></script>

<script src="../<?=pathplugins?>pdfmake/pdfmake.min.js"></script>

<script src="../<?=pathplugins?>pdfmake/vfs_fonts.js"></script>

<script src="../<?=pathplugins?>datatables-buttons/js/buttons.html5.min.js"></script>

<script src="../<?=pathplugins?>datatables-buttons/js/buttons.print.min.js"></script>

<script src="../<?=pathplugins?>datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Select2 -->
<script src="../<?=pathplugins?>select2/js/select2.full.min.js"></script>

<script src="../<?=pathplugins?>inputmask/jquery.inputmask.min.js"></script>
<script src="../<?=pathplugins?>tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>


<script>


  $('.select2').select2()
   //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'HH:mm',
      showToday: true
    })

  $(function (){
    $("#tabeldata").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "pageLength": 50,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });

  $(function (){
    $("#tabelabsen").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "pageLength": 50,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });

   $(function (){
    $("#tabelnilai").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "pageLength": 50,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });


</script>

<script type="text/javascript">
      for(let y=1;y<=24;y++){
        $('#p'+y).datetimepicker({
          format: 'DD/MM/YYYY'
      });
      }  


</script>


</body>
</html>
