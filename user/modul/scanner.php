
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>QR Reader</h1>
      </div>

    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        

        <div class="row">
          <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username"><?=strtoupper($user_nama)?></h3>
                <h5 class="widget-user-desc"><?=$user_nim?></h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="<?=pathfotomhs?><?=$user_foto?>" alt="<?=$user_nim?>">
              </div>
              <div class="card-body">
                <!-- <div class="row"> -->
                <br>
                <!-- <div cla/ ss="border-right"> -->
                    <div class="description-block">
                      <form method="POST" action="modul/p_absen.php">
                      <input type="hidden" name="fid" id="single2"> 
                      <input type="hidden" name="fnim" id="fnim" type="text" value="<?=$user_nim?>"> 

 					<?php
 					if(isset($_GET['err'])){
 						switch($_GET['err']){
 						case 1 : 
 						echo "<div class='alert alert-warning alert-dismissible'>Klik <a href='?act=rek'>DISINI</a> untuk memeriksa absen Anda !!!</div>";
                  break;
            case 2: 
 						echo "<div class='alert alert-warning alert-dismissible'>Klik <a href='?act=rek'>DISINI</a> untuk memeriksa absen Anda !!!</div>";
                  break;
						case 3: 
 						echo "<div class='alert alert-warning alert-dismissible'>Klik <a href='?act=rek'>DISINI</a> untuk memeriksa absen Anda !!!</div>";
            			break;
 						}
 					}
 					
        			?>   

                      <p id="mk"><strong>Silahkan Scan QR Code</strong></p>
                      <div class="card-body">
                      	<button type="button" class="qrcode-reader btn btn-outline-success" id="openreader-single2" data-qrr-target="#single2" data-qrr-audio-feedback="true"><i class="fas fa-qrcode"> Reader</i></button>
  						         <!-- <button type="submit" class="btn btn-success"><i class="fas fa-clipboard-check" > Absen</i></button> -->
                    </div>
                    <!-- /.description-block -->
                    </form>
                  </div>
  
              	<!-- </div> -->
            </div>
            <!-- /.widget-user -->
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
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="../../plugins/jsqr/js/qrcode-reader.min.js?v=20190604"></script>

<script>
  $(function(){
    // overriding path of JS script and audio 
    $.qrCodeReader.jsQRpath = "../../plugins/jsqr/js/jsQR/jsQR.min.js";
    $.qrCodeReader.beepPath = "../../plugins/jsqr/audio/beep.mp3";

    // bind all elements of a given class
    $(".qrcode-reader").qrCodeReader();

    $("#openreader-single2").qrCodeReader({callback: function(code) {
      if (code) {
		var nim = document.getElementById("fnim").value ;  
        window.location.href = "modul/p_absen.php?fid="+code+"&fnim="+nim;
      }  
    }}).off("click.qrCodeReader").on("click", function(){
      var qrcode = $("#single2").val().trim();
      if (qrcode) {
        //window.location.href = qrcode;
		$.qrCodeReader.instance.open.call(this);
      } else {
        $.qrCodeReader.instance.open.call(this);
      }
    });


  });

</script>

<script type="text/javascript">
$(document).ready(function(){   
  $("#single2").change(function(){ 
    $.ajax({
      type: "POST", // Method pengiriman data bisa dengan GET atau POST
      url: "data/get_matkul.php", // Isi dengan url/path file php yang dituju
      data: {fid : $("#single2").val(), fnim : $("#fnim").val()}, // data yang akan dikirim ke file yang dituju
      dataType: "json",
      beforeSend: function(e) {
        if(e && e.overrideMimeType) {
          e.overrideMimeType("application/json;charset=UTF-8");
        }
      },
      success: function(response){ // Ketika proses pengiriman berhasil
        //$("#loading").hide(); // Sembunyikan loadingnya
        $("#mk").html(response.data_absen).show();
      },
      error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
        alert(thrownError); // Munculkan alert error
      }
    });
    });
});

</script>


