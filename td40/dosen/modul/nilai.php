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
  if(!isset($_GET['id'])){ ?>
    <div class="card">
      <div class="card-body">
        <table id="tabeldata" class="table table-bordered table-striped">
          <thead>
            <tr class="text-center">
              <th>No. </th>
              <th>Kelas</th>
              <th>Kode</th>
              <th>Mata Kuliah</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $num=0;
          $data_nilai = coc_sql("SHOW", 
            "tb_absen AS a LEFT JOIN tb_mk AS b ON a.id_matkul = b.kode_mk
             LEFT JOIN tb_kelas AS c ON a.id_kelas = c.id", 
            "a.id AS id, a.id_matkul AS kode, b.nama_mk AS mk, c.kelas AS kelas", 
            "a.id_dosen='$_SESSION[s_id_dosen]'");
          while ($r = $data_nilai->fetch_array()) {  
            $num++;
          ?>
            <tr>
              <td class="text-center"><?=$num?></td>
              <td class="text-center"><?=$r['kelas']?></td>
              <td class="text-center"><?=$r['kode']?></td>
              <td><?=$r['mk']?></td>
              <!-- <td class="text-center"><a type="button" href="?act=skor&id=<?=$r['id']?>"  class="btn btn-block btn-outline-success btn-xs">Edit</a></td> -->
              <td class="text-center"><a type="button" href="?act=skor&id=<?=$r['id']?>"  class="btn btn-block btn-outline-success btn-xs"><i class="fas fa-eye"> View</a></td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>  
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
      ?>
      <div class="card-tools">
        <a class="btn btn-outline-success btn-sm" onclick="excel_d('<?=$kode?>')" ><i class="fas fa-download"></i> Excel</a>
        <a class="btn btn-outline-secondary btn-sm" href="?act=abs" ><i class="fas fa-undo"></i> Kembali</a>   
      </div>
    </div>
    <div class="card-body">
      <form method="POST" action="modul/p_nilai.php">
        <table id="" class="table table-bordered table-hover">
          <form method="POST" action="modul/p_nilai.php">
          <thead>
          <tr class="text-center" style="background-color: #808080;">
            <th>No</th>
            <th>Nim</th>
            <th>Nama</th>
            <th>Absen</th>
            <th>Tugas awal</th>
            <th>Praktikum</th>
            <th>Laporan</th>
            <th colspan="2">Final</th>
            <th>Total</th>
            <th>Huruf</th>
          </tr>
          </thead>
          <tbody>
          <input type="hidden" name="fid" class="form-control text-right" value="<?=$kode?>">
          <?php
          $nilai_data = coc_sql("SHOW",
            "tb_nilai_data AS a
            LEFT JOIN tb_mhs AS b ON a.id_mhs=b.nim",
            "a.id_mhs AS nim, b.nama AS nama, a.n1 AS n1, a.n2 AS n2, a.n3 AS n3, a.n4 AS n4, a.n5 AS n5",
            "a.id_absen='$kode'",
            "a.id_mhs ASC");
          $num;
          while($r0 = $nilai_data->fetch_array()){
            $num++;
            $absen = coc_sql("SHOW", "tb_absen_data", "absen", "id_absen='$kode' AND id_mhs='$r0[nim]'");
            $meet = $absen->num_rows;
            $ta = 0;
            while($r1 = $absen->fetch_array()){
              $n = 0;
              switch($r1['absen']){
                case NULL : $n = 0;break;
                case 'A'  : $n = 0;break;
                case 'I'  : $n = 0;break;
                case 'S'  : $n = 0;break;
                case 'H'  : $n = 1;break;
                default : $n = kehadiran($r1['absen'], $r['jam']) == true ? 1 : 0;
              }
              $ta += $n; 
            }
            $n1 = $ta == 0 ? 0 : (100*($ta/$meet));
            if($n1 >= 80){
              $warna = '#000000';
              $abs = 1;
            }else{
              $warna = '#ff0000';
              $abs = $n1/100;
            }


            $n2 = $r0['n2'] == NULL ? "0" : $r0['n2'];
            $n3 = $r0['n3'] == NULL ? "0" : $r0['n3'];
            $n4 = $r0['n4'] == NULL ? "0" : $r0['n4'];
            $n5 = $r0['n5'] == NULL ? "0" : $r0['n5'];
            $nj = (floatval($n1)*0.1)+(floatval($n2)*0.1)+(floatval($n3)*0.4)+(floatval($n4)*0.2)+(floatval($n5)*0.2*floatval($abs));
            $nh = huruf($nj);
            ?>

            <tr>
              <td class="text-center"><?=$num?></td>
              <td class="text-center"><?=$r0['nim']?><input type="hidden" name="nim[]" value="<?=$r0['nim']?>"></td>
              <td><?=strtoupper($r0['nama'])?></td>
              <td class="text-right" style="color:<?=$warna?>;"><input type="hidden" name="n1[]" value="<?=dec($n1)?>"><?=dec($n1)?></td>
              <td class="text-right"><input type="text" name="n2[]" class="form-control form-control-sm text-right" value="<?=$n2?>"></td>
              <td class="text-right"><input type="text" name="n3[]" class="form-control form-control-sm text-right" value="<?=$n3?>"></td>
              <td class="text-right"><input type="text" name="n4[]" class="form-control form-control-sm text-right" value="<?=$n4?>"></td>
              <td class="text-right"><input type="text" name="n5[]" class="form-control form-control-sm text-right" value="<?=$n5?>"></td>
              <td class="text-right"><?=dec(floatval($n5)*$abs)?></td>
              <td class="text-right"><?=dec($nj)?></td>
              <td class="text-center"><?=$nh?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      <br>
      <button type="submit" class="btn btn-block btn-outline-info btn-sm" ><i class="fas fa-save"></i> Simpan</button>
      <br>
      <a  onclick="document.location.reload(true)" class="btn btn-block btn-outline-danger btn-sm" ><i class="fas fa-window-close"></i> Cancel</a>
      </form>
    </div>
  </div>
<?php } ?>
  </div>
</section>

<script type="text/javascript">
  function excel_d(id){
    window.open('<?=pathprint?>nilai_f.php?id='+id, '_blank', 'toolbar=yes, scrollbars=yes, resizable=yes, top=500,left=500, width=400, height=400');
      }

</script>