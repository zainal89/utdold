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

<?php
$data = coc_sql("SHOW", 
  "tb_absen_data AS a LEFT JOIN tb_mhs AS b ON a.id_mhs = b.nim
   LEFT JOIN tb_absen AS c ON a.id_absen = c.id
   LEFT JOIN tb_mk AS d ON c.id_matkul = d.kode_mk
   ",
  "a.id_mhs AS nim, b.nama AS mhs, c.id_matkul AS kdmk, d.nama_mk AS matkul",
  "a.id_absen='$kode' AND a.id_mhs='$_GET[nim]'",
  "a.id_mhs");
$r = $data->fetch_array();
?>
<section class="content">
  <div class="container-fluid">
    <div class="card col-sm-4">
      

      <form class="form-horizontal" method="POST" action="modul/p_absen_edit.php">

      
        <div class="card-body">
        <div class="form-group row">
          <label for="fnim" class="col-sm-4 col-form-label">NIM</label>
          <div class="col-sm-8">
            <label for="fnim" class="col-form-label"><?=$r['nim']?></label>

          </div>
        </div>
      

        <div class="form-group row">
          <label for="fnama" class="col-sm-4 col-form-label">Nama</label>
          <div class="col-sm-8">
            <label for="fnama" class="col-form-label"><?=$r['mhs']?></label>
          </div>
        </div>

        <div class="form-group row">
          <label for="" class="col-sm-4 col-form-label">Mata Kuliah</label>
          <div class="col-sm-8">
            <label for="" class="col-form-label"><?=$r['matkul']?></label>
          </div>
        </div>

        <input type="hidden" name="fid" value="<?=$kode?>">
        <input type="hidden" name="fnim" value="<?=$r['nim']?>">
        <input type="hidden" name="fmk" value="<?=$r['kdmk']?>">
        <?php
        $absen = coc_sql("SHOW", "tb_absen_data", "*", "id_absen='$kode' AND id_mhs='$_GET[nim]'");
        $meet = 0;
        $val = array("H", "S", "I", "A");
        $cho = array("Hadir", "Sakit", "Izin", "Alpa");
        while($r0 = $absen->fetch_array()){
        $meet++;
        ?>
        <div class="form-group row">
          <label for="fp<?=$meet?>" class="col-sm-4 col-form-label">Pertemuan <?=$meet?></label>
          <div class="col-sm-8">
            <select class="form-control" name="fp[]">
              <option value="<?=$r0['absen']?>">
                <?php
                $flag = true;
                for($cc=0;$cc<count($val);$cc++){
                  if($r0['absen'] == $val[$cc]){
                    echo $cho[$cc];
                    $flag = false;
                  }
                }
                if($flag==true)echo $r0['absen']; 
                
                ?>
                
              </option>
              <?php
              for($c=0;$c<count($val);$c++)echo "<option value='".$val[$c]."'>".$cho[$c]."</option>";
              ?>
            </select>
          </div>
          </div>
        <?php
        }
        ?>
      </div>
        <div class="card-footer">
            <a href="?act=abs&id=<?=$kode?>" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-outline-info float-right">Update</button>
        </div>
      </form>
    </div>
  </div>
</section>