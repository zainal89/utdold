<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">

</head>
<body class="hold-transition login-page" onload="logerror()">
<div class="login-box">
  <div class="login-logo">
    <a href="https://www.atim.ac.id" target="_blank"><b>Politeknik ATI Makassar</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Otomasi Sistem Permesinan</p>

      <form action="login_auth.php" method="POST">
        <div class="input-group mb-3">
          <input type="text" name="fuser" class="form-control" placeholder="NIDN / Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="fpwd" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
      	<div class="text-right">
        	<button type="submit" class="btn btn-primary btn-block">Masuk</button>
      	</div>
      </form>


      <br>
      <p class="mb-1">
        <a href="#" data-toggle="modal" data-target="#modal-primary">Lupa password ?</a>
        <!-- <button type="button" class="btn btn-danger toastrDefaultError">
                  Launch Error Toast
        </button> -->
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<div class="modal fade" id="modal-primary">
<div class="modal-dialog">
  <div class="modal-content bg-primary">
    <div class="modal-header">
      <h4 class="modal-title">Lupa password</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <p>Silahkan hubungi Admin &hellip;</p>
    </div>
    <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Keluar</button>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../plugins/toastr/toastr.min.js"></script>


<script type="text/javascript">
	window.onload = 
$(function() {
	var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 2000
    });

	$('.toastrDefaultError').click(function() {
      toastr.error('User atau Password Anda Salah !!!')
    });

})
</script>

</body>
</html>

