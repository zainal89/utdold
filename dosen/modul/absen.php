 <style>
        .select2-results__option[aria-selected="true"] {
            background-color: #90EE90 !important; 
            color: black; 
        }
        .select2-selection__choice {
            background-color: #90EE90 !important; 
            color: black !important; 
        }
</style>
    
<!-- Content Header (Page header) --> 
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Akademik</h1>
      </div>

    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <?php
        if(!isset($_GET['id'])){
        $ta = (!isset($_GET['ta']) ? periode_aktif() : $_GET['ta']);
        ?>
          <!-- <div class="row"> -->
          <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-3">
                <!--<div class="form-group">-->
                  <select class="form-control select2" id="ftaktif" style="width: 100%;">
                      <?php
                        $sem = coc_sql("SHOW", "tb_periode", "id, tahun, semester", "1=1", "id DESC");
                        while ($r = $sem->fetch_array()) {  
                            $sel = ($r['id'] == $ta ? "selected='selected'" : "");
                            echo "<option ". $sel." value='".$r['id']."'>".$r['tahun']." (".semester($r['semester']).")</option>";
                        }
                      ?>
                  </select>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <button class="btn btn-outline-primary btn-sm" onCLick="filter()"><i class="fas fa-search"></i> Filter </button>
                    <a class="btn btn-outline-success btn-sm" href="?act=abs"><i class="fas fa-download"></i> Periode Aktif</a>
                </div>
              </div>
            </div>

                
            </div>
          <!--</div>-->
            
              <div class="card-body">
                <table id="tabeldata" class="table table-bordered table-striped">
                  <thead>
                  <tr class="text-center">
                    <th>No. </th>
                    <th>Kelas</th>
                    <th>Kode</th>
                    <th>Mata Kuliah</th>
                    <th>Kelompok</th>
                    <th>Peserta</th>
                    <th>Pertemuan</th>
                    <th>QR Code</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $num=0;
                    $data_tanya = coc_sql("SHOW", 
                      "tb_absen AS a LEFT JOIN tb_mk AS b ON a.id_matkul = b.kode_mk
                       LEFT JOIN tb_kelas AS c ON a.id_kelas = c.id", 
                      "a.id AS id, a.id_matkul AS kode, b.nama_mk AS mk, a.ask AS ask, a.pertemuan AS pertemuan, a.kelompok AS kelompok, c.kelas AS kelas", 
                      "a.id_dosen='$_SESSION[s_id_dosen]' AND a.id_periode='".$ta."'");
                    while ($r = $data_tanya->fetch_array()) {  
                      $num++;
                    ?>
                    <tr>
                      <td class="text-center"><?=$num?></td>
                      <td class="text-center"><?=$r['kelas']?></td>
                      <td class="text-center"><?=$r['kode']?></td>
                      <td><?=$r['mk']?></td>
                      <td class="text-center"><?=$r['kelompok']?></td>
                      <td class="text-center"><?=coc_count("tb_absen_data", "id_absen=$r[id] GROUP BY id_mhs")?></td>
                       <td class="text-center"><?=$r['pertemuan']?></td>
                      <td>
                        <a type="button" onclick="pdfprint('<?=$r['kode']?>')" class="btn btn-block btn-outline-danger btn-xs" ><i class="fas fa-download"></i> Download</a>
                      </td>
                      <td class="text-center">
                        <a type="button" href="?act=abs&id=<?=$r['id']?>" class="btn btn-block btn-outline-warning btn-xs"><i class="fas fa-check-double"></i> Absen</a>
                        <a type="button" href="?act=skor&id=<?=$r['id']?>" class="btn btn-block btn-outline-success btn-xs"><i class="fas fa-list-ol"></i> Nilai</a>
                      </td>

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
          $absen = coc_sql("SHOW", "tb_absen", "*", "id=$kode");
          $r = $absen->fetch_array();
          $num = 0;
        ?>
        <div class="card">
          <div class="card-header">
            <?php
            $matkul = coc_sql("SHOW", "
              tb_absen AS a 
              LEFT JOIN tb_kelas AS b ON a.id_kelas = b.id 
              LEFT JOIN tb_mk AS c ON a.id_matkul = c.kode_mk 
              ",
              "b.kelas AS kelas, c.nama_mk AS matkul",
              "a.id=$kode");
            $m = $matkul->fetch_array();
            echo "<strong>(".$m['kelas'].") ".$m['matkul']."</strong>";
            $_kelas = $m['kelas'];
            ?>
            <div class="card-tools">
              <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#tambah-absen"><i class="fas fa-edit"></i> Edit</button>
              <a class="btn btn-outline-success btn-sm" onclick="excel_d('<?=$kode?>')" ><i class="fas fa-download"></i> Excel</a>
              <a class="btn btn-outline-secondary btn-sm" href="?act=abs" ><i class="fas fa-undo"></i> Kembali</a>
                
            </div>
          </div>
          <div class="card-body">
            <!--<table id="tabelabsen" class="table table-bordered table-hover"> -->
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
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                for($tc=1;$tc<=$r['kelompok'];$tc++){
                  $num++;
                  ?>
                  <tr style="background-color: #D3D3D3;">
                    <th class="text-center"><?=$num?></th>
                    <th class="text-center">Kel <?=$tc?></th>
                    <th class="text-center"><?=$r['jam']?></th>
                    <?php
                      $tgl = coc_sql("SHOW", "tb_absen_tgl", "*", "id_absen='$kode' AND kel='$tc'");
                      while($r3 = $tgl->fetch_array()){
                        echo "<th class='text-center'>".tglabsen($r3['tanggal'])."</th>";
                      }
                    ?>
                    <th class="text-center"></th>
                  </tr>
                  <?php
                  $absen_mhs = coc_sql("SHOW", 
                        "tb_absen_data AS a LEFT JOIN tb_mhs AS b ON a.id_mhs = b.nim", 
                        "a.id_mhs AS nim, b.nama AS nama", 
                        "a.id_absen='$kode' AND a.kel='$tc'", 
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
                        <td class="text-center">
                          <a class="btn btn-outline-info btn-sm" href="?act=aedit&id=<?=$kode?>&nim=<?=$r4['nim']?>" ><i class="fas fa-edit"></i></a>
                          <a class="btn btn-outline-danger btn-sm" href="modul/p_absen_hapus.php?id=<?=$kode?>&nim=<?=$r4['nim']?>&kel=<?=$tc?>" ><i class="fas fa-trash"></i></a>
                        </td>
                      </tr>
                      <?php
                     }
                }
                ?>
              </tbody>
            </table>
        </div>
      </div>

      <?php } ?>
</div>
</section>
     
      <div class="modal fade" id="tambah-absen">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Absen</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" action="modul/p_absen_tambah.php" method="POST">
                <input type="hidden" value="<?=$kode?>" name="fid">
                <div class="form-group">
                    <label for="fkelompok">Kelompok</label>
                      <!-- <div class="col-sm-6"> -->
                        <select class="form-control" name="fkelompok">
                          <?php
                            $kelompok = $r['kelompok'];
                              for($c=1; $c<=$kelompok; $c++){
                              echo "<option value='$c'>".$c."</option>";
                            }
                          ?>
                        </select>
                      <!-- </div> -->
                  </div>
                
                  <div class="form-group">
                    <label for="fmahasiswa">Mahasiswa</label>
                      <!-- <div class="col-sm-6"> -->
                        <select class="select2" name="mhs[]" id="mhsku" multiple="multiple" data-placeholder="Mahasiswa" data-dropdown-css-class="select2-black">
                            <?php
                                $kelas = explode(" ", $_kelas);
                                $latest = coc_value("tb_mhs", "periode", "1=1");
                                $hattori = $latest;
                                switch($kelas[0]){
                                    case '1' : $hattori = $latest;break;
                                    case '2' : $hattori = $latest - 2;break;
                                    case '3' : $hattori = $latest - 4;break;
                                    
                                }
                                $dsel = coc_sql("SHOW", "tb_mhs", "*", "prodi IN(7) AND kelas = '$kelas[1]' AND periode=$hattori");
                                while ($rows = $dsel->fetch_array()) {
                                    echo "<option value='{$rows['nim']}' selected>{$rows['nim']}-".strtoupper($rows['nama'])."</option>";
                                }
                                $data = coc_sql("SHOW", "tb_mhs", "*", "periode NOT IN (7, 9, 11) AND prodi IN(7)");
                                while ($row = $data->fetch_array()) {
                                    echo "<option value='{$row['nim']}' >{$row['nim']}-".strtoupper($row['nama'])."</option>";
                                }
                            ?>
                            
                        </select>
                        <div class="modal-footer">
                            <button class="btn btn-outline-primary btn-sm" onclick="clearAllSelects()">Clear</button>
                        </div>
                      <!-- </div> -->
                  </div>

                  <!-- time Picker -->
                <!-- <div class="bootstrap-timepicker"> -->
                  <div class="form-group">
                    <label>Jam</label>

                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                      <input type="text" name="fjam" class="form-control datetimepicker-input" data-target="#timepicker"/>
                      <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                      </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                <!-- </div> -->

                  <?php 
                  for($x=1;$x<=$r['pertemuan'];$x++){
                  ?>
                  <div class="form-group">
                    <label class="fpertemuan">Pertemuan <?=$x?></label>
                      <div class="input-group date" id="p<?=$x?>" data-target-input="nearest"> 
                          <input type="text" name="p[]" class="form-control datetimepicker-input" data-target="#p<?=$x?>" />
                          <div class="input-group-append" data-target="#p<?=$x?>" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                  </div>
                  <?php
                  }
                  ?>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<script type="text/javascript">
  function pdfprint(id){
    window.open('<?=pathprint?>qrcode.php?id='+id, '_blank', 'toolbar=yes, scrollbars=yes, resizable=yes, top=500,left=500, width=400, height=400');
      }

  function excel_d(id){
    window.open('<?=pathprint?>absen_f.php?id='+id, '_blank', 'toolbar=yes, scrollbars=yes, resizable=yes, top=500,left=500, width=400, height=400');
      }
      
function filter() {
    var ta = document.getElementById("ftaktif").value ;
    window.location = '?act=abs&ta='+ta;
    // window.open('?act=abs&ta='+ta);
}


$(document).ready(function() {
            // Inisialisasi select2
            $('.select2').select2();
        });

        function clearAllSelects() {
            $('.select2').val(null).trigger('change'); // Menghapus semua pilihan di select2
        }

</script>