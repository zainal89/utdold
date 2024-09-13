<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Dashboard</h1>

      </div>

    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4">
      <div class="card card-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-info">
          <h3 class="widget-user-username"><?=strtoupper($user_nama)?></h3>
          <h5 class="widget-user-desc"><?=$user_nim?></h5>
        </div>
        <div class="widget-user-image">
          <img class="img-circle elevation-2" src="<?=pathfotomhs?><?=$user_foto?>" alt="<?=$user_nim?>">
        </div>
        <div class="card-footer">
          <div class="description-block">
             <a class="btn btn-outline-success btn-xl" href="?act=qr" ><i class="fas fa-qrcode"></i> Scanner</a>
          </div>
          <div class="description-block">
            <h5 class="description-header text-left">Program Studi : </h5>
            <p class="text-left"><?=$user_prodi?></p>
          </div>
<!--           <div class="description-block">
            <h5 class="description-header text-left">KTP : </h5>
            <p class="text-left"><?=$user_ktp?></p>
          </div> -->
          <div class="description-block">
            <h5 class="description-header text-left">No. Handphone : </h5>
            <p class="text-left"><?=$user_hp?></p>
          </div>
          <div class="description-block">
            <h5 class="description-header text-left">E-Mail : </h5>
            <p class="text-left"><?=$user_em?></p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-md-8">
      <div class="card card-primary">
        <div class="card-body">
          <h3>Selamat Datang <?=ucwords($user_nama)?>,</h3>
                 <p>
          Ini merupakan aplikasi versi <i>beta</i> monitoring  <strong>Absensi</strong> dan <strong>Nilai</strong> menggunakan QR Code.<br>
          Silahkan gunakan menu <strong>SCANNER</strong> sebagai scaner/pemindai QR Code<br><br>
          Perhitugan nilai kehadiran secara otomatis akan termuat dalam daftar nilai.<br>
          Jika mata kuliah tidak ada pada data rekap, maka segera laporkan  ke <strong>ADMIN</strong><br>
          Jika data yang masuk <strong>TIDAK SESUAI</strong> dengan keadaan kelas, maka absen mengikuti keadaan kelas.<br>
          Untuk <strong>NILAI UJIAN</strong>, jika kehadiran <strong>kurang dari 80%</strong>, maka nilai ujian akan dikalikan persentase nilai kehadiran. 
        </p>
        </div>
      </div>
    </div>
  </div>
</div>
</section>