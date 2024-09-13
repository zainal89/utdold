
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Absensi</h1>
      </div>

    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <?php
        
          $absen = coc_sql("SHOW", "tb_absen", "*", "id=$kode");
          $r = $absen->fetch_array();
          $num = 0;
        ?>
        <div class="card">
          <div class="card-header">
            <div class="card-tools">
              <a class="btn btn-outline-secondary btn-sm" href="?act=rek&id=<?=$kode?>" ><i class="fas fa-undo"></i> Kembali</a>
                
            </div>
          </div>
          <div class="card-body">
            <table id="tabelabsen" class="table table-bordered table-hover">
              <thead>
                <tr class="text-center" style="background-color: #808080;">
                  <th>No</th>
                  <th>Nim</th>
                  <th>Nama</th>
                  <?php
                  for($c=1;$c<=$r['pertemuan'];$c++){
                    echo "<th>P".$c."</th>";
                  }
                  ?>

                </tr>
              </thead>
              <tbody>
                <?php
                for($tc=1;$tc<=$r['kelompok'];$tc++){
                  $num++;
                  ?>
                  <tr style="background-color: #D3D3D3;">
                    <th class="text-center"><?=$num?></th>
                    <th class="text-center">Kelompok <?=$tc?></th>
                    <th class="text-center"><?=$r['jam']?></th>
                    <?php
                      $tgl = coc_sql("SHOW", "tb_absen_tgl", "*", "id_absen='$kode' AND kel='$tc'");
                      while($r3 = $tgl->fetch_array()){
                        echo "<th class='text-center'>".tglabsen($r3['tanggal'])."</th>";
                      }
                    ?>
                    <!-- <th class="text-center"></th> -->
                  </tr>
                  <?php
                  $absen_mhs = coc_sql("SHOW", 
                        "tb_absen_data AS a LEFT JOIN tb_mhs AS b ON a.id_mhs = b.nim", 
                        "a.id_mhs AS nim, b.nama AS nama", 
                        "a.id_absen='$kode' AND a.id_mhs='$user_nim'", 
                        "a.id_mhs", 
                        "a.id_mhs ASC");
                     while($r4 = $absen_mhs->fetch_array()){
                      $num++;
                      ?>
                      <tr>
                        <td class='text-center'><?=$num?></td>
                        <td class='text-center'><?=$r4['nim']?></td>
                        <td><?=strtoupper($r4['nama'])?></td>
                        <?php
                          $absen_cek = coc_sql("SHOW", "tb_absen_data", "absen", "id_absen='$kode' AND id_mhs='$r4[nim]'", "pertemuan ASC");

                          while($r5 = $absen_cek->fetch_array()){
                            $arr = array(null, "S", "I", "A", "H");
                            if(!in_array( $r5['absen'], $arr)){
                              $warna = kehadiran($r5['absen'], $r['jam']) == true ? '#000000' : '#ff0000';
                            }else{
                              $warna = "#000000";
                            }
                            echo "<td class='text-center' style='color: ".$warna."'>".$r5['absen']."</td>";
                          }

                        ?>

                      </tr>
                      <?php
                     }
                }
                ?>
              </tbody>
            </table>
        </div>
      </div>
</div>
</section>
