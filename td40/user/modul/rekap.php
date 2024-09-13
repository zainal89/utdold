<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
 <!--        <h1>Daftar Instruksi Kerja</h1> -->
      </div>

    </div>
  </div>
</section>

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <?php
        if(!isset($_GET['id'])){ ?>
          <!-- <div class="row"> -->
          <div class="card  card-primary">
              <!-- /.card-header -->
			  <div class="card-header">
                <h3 class="card-title">Instruksi Kerja (IK)</h3>
              </div>
              <div class="card-body">
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
                    $data_nilai = coc_sql("SHOW", 
                      "tb_ika
                       ", 
                      "*", 
                      "1=1");
                    while ($r = $data_nilai->fetch_array()) {  
                      $num++;
                    ?>
                    <tr>
                      <td class="text-center"><?=$num?></td>
                      <td class="text-center"><?=$r['bmn']?></td>
                      <td><?=ucwords($r['nama'])?></td>
                      <td><?=ucwords($r['merk'])?></td>
                      <td><?=ucwords($r['type'])?></td>
                      <td class="text-center"><a type="button" href="?act=rek&id=<?=$r['id']?>"  class="btn btn-outline-success btn-xs"><i class="fas fa-eye"> View</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
          </div>
        <!-- </div> -->
        <?php
        }else{
            
        $absen = coc_sql("SHOW", "tb_ika", "*", "id='$kode' OR bmn='$kode'");
		$tdy  = date("Y/m/d");
          $r = $absen->fetch_array();
          $num = 0;
		  $cek_today = coc_sql("SHOW", "tb_td_mhs_absen", "*", "id_ika = '$r[bmn]' AND id_mhs='$user_nim' AND tgl_akses='$tdy'");
		  $found_today = $cek_today->num_rows;
		  if($found_today == 0){			  
			 coc_sql("ADD", "tb_td_mhs_absen", "id_ika='$r[bmn]', id_mhs='$user_nim', tgl_akses='$tdy'");
		  }
        ?>
        <div class="card">
          <div class="card-header">

                <h3 class="card-title">Instruksi Kerja (IK) <?=$r['nama']?></h3>
   
            <div class="card-tools">
              <a class="btn btn-outline-secondary btn-sm" href="?act=rek" ><i class="fas fa-undo"></i> Kembali</a>
                
            </div>
          </div>
          <div class="card-body">

                <dl class="row">
                  <dt class="col-sm-4">Nomor BMN</dt>
                  <dd class="col-sm-8"><?=$r['bmn']?></dd>
                  <dt class="col-sm-4">Nama</dt>
                  <dd class="col-sm-8"><?=$r['nama']?></dd>
                  <dt class="col-sm-4">Merk</dt>
                  <dd class="col-sm-8"><?=$r['merk']?></dd>
                  <dt class="col-sm-4">Type</dt>
                  <dd class="col-sm-8"><?=$r['type']?></dd>
                  <dt class="col-sm-4">Instruksi Kerja</dt>
                  <dd class="col-sm-8"><?=$r['instruksi']?></dd>
				  <dt class="col-sm-4">Video</dt>
                  <dd class="col-sm-8"><?=$r['ytube']?></dd>
                </dl>
        </div>
      </div>
      <?php } ?>
</div>
</section>

