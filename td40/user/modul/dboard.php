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
             <a class="btn btn-outline-success btn-xl" href="?act=qr" ><i class="fas fa-qrcode"></i> Reader</a>
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
			<h4>History pencarian Anda hari ini <?=idfulltoday()?> <br> </h4>
                 <p>
				 <br>
          <table id="tabeldata" class="table table-bordered table-striped">
                  <thead>
                  <tr class="text-center">
                    <th>No. </th>
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
                      "a.id_ika AS bmn, c.nama AS nama, c.merk AS merk, c.type AS type", 
                      "a.id_mhs = '$user_nim' AND a.tgl_akses = '$tdy'");

                    while ($r = $history->fetch_array()) {  
                      $num++;
                    ?>
                    <tr>
                      <td class="text-center"><?=$num?></td>
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
        </p>
        </div>
      </div>
    </div>
  </div>
</div>
</section>