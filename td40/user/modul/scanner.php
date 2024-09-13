
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
 						echo "<div class='alert alert-danger alert-dismissible'>Kode Mata Kuliah tidak ditemukan</div>";
            			break;
            			case 2: 
 						echo "<div class='alert alert-warning alert-dismissible'>Anda tidak ada Jadwal pada kelas ini</div>";
            			break;
						case 3: 
 						echo "<div class='alert alert-warning alert-dismissible'>Anda sudah absen hari ini</div>";
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
	  <div class="card-header">
                <h3 class="card-title">History Pencarian</h3>
              </div>
        <div class="card-body">
          <table id="tabeldata" class="table table-bordered table-striped">
                  <thead>
                  <tr class="text-center">
                    <th>No. </th>
					<th>Tanggal</th>
                    <th>BMN</th>
                    <th>Nama Alat </th>
                    <th>Merk</th>
                    <th>Type</th>
                    <th>Instruksi Kerja</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $num=0;
					$tdy = date('Y-m-d');
                    $history = coc_sql("SHOW", 
                      "tb_td_mhs_absen AS a 
					  LEFT JOIN tb_mhs AS b ON a.id_mhs = b.nim 
					  LEFT JOIN tb_ika AS c ON a.id_ika = c.bmn", 
                      "a.id_ika AS bmn, a.tgl_akses AS tgl, c.nama AS nama, c.merk AS merk, c.type AS type", 
                      "a.id_mhs = '$user_nim'", "a.id desc");

                    while ($r = $history->fetch_array()) {  
                      $num++;
					  $tgl = date_format(date_create($r['tgl']), 'd-m-Y');
                    ?>
                    <tr>
                      <td class="text-center"><?=$num?></td>
					  <td><?=$tgl?></td>
                      <td><?=$r['bmn']?></td>
                      <td><?=ucwords($r['nama'])?></td>
                      <td><?=ucwords($r['merk'])?></td>
                      <td><?=ucwords($r['type'])?></td>
                      <td class="text-center"><a type="button" href="?act=rek&id=<?=$r['bmn']?>"  class="btn btn-outline-success btn-xs"><i class="fas fa-eye"> View</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
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
        window.location.href = "index.php?act=rek&id="+code+"&fnim="+nim;
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


