
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
        if(!isset($_GET['id'])){
            $ta = (!isset($_GET['ta']) ? periode_aktif() : $_GET['ta']);
          if(isset($_GET['e']) == 1)echo "<div class='alert alert-warning alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h5><i class='icon fas fa-exclamation-triangle'></i> Warning !</h5>

                Data absen sudah ada !!!

        </div>";
        ?>
          <!-- <div class="row"> -->
          <div class="card">
              <!-- /.card-header -->
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
              <div class="col-md-3">
                  <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#input-absen"><i class="fas fa-plus"></i> Tambah</a>
                </div>
            </div>
                  
                <!--<div class="card-tools">-->
                <!--  <button class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target="#input-absen"><i class="fas fa-plus"></i> Tambah</a>-->
                <!--</div>-->
              </div>

              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr class="text-center">
                    <th>No. </th>
                    <th>Tahun Ajaran</th>
                    <th>Semester</th>
                    <th>Kelas</th>
                    <th>Kode</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Jam</th>
                    <th>Kelompok</th>
                    <th>Pertemuan</th>
                   
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $num=0;
                    $data_tanya = coc_sql("SHOW", "tb_absen AS a 
                      LEFT JOIN tb_periode AS f ON a.id_periode = f.id     
                      LEFT JOIN tb_mk AS b ON a.id_matkul = b.kode_mk 
                      LEFT JOIN tb_kelas AS c ON a.id_kelas = c.id 
                      LEFT JOIN tb_dosen AS d ON a.id_dosen = d.id_dosen
                      LEFT JOIN z_prodi AS e ON a.id_prodi = e.kode_prodi", 
                      "a.id AS id, a.jam AS jam, a.id_matkul AS kode, b.nama_mk AS mk, a.ask AS ask, c.kelas AS kelas, d.nama AS dosen, a.pertemuan AS meet,
                      a.kelompok AS kelompok, e.kode_nama AS prodi, f.tahun AS tahun, f.semester AS sms", 
                      "a.id_periode='".$ta."' ORDER BY a.id DESC");
                    while ($r = $data_tanya->fetch_array()) {  
                      $num++;
                    ?>
                    <tr>
                      <td class="text-center"><?=$num?></td>
                      <td class="text-center"><?=$r['tahun']?></td>
                      <td><?=semester($r['sms'])?></td>
                      <td class="text-center"><?=$r['kelas']?></td>
                      <td class="text-center"><?=$r['kode']?></td>
                      <td><?=$r['mk']?></td>
                      <td><?=$r['dosen']?></td>
                      <td><?=$r['jam']?></td>
                      <td class="text-center"><?=$r['kelompok']?></td>
                      <td class="text-center"><?=$r['meet']?></td>
                      
                      <td>
                        <a type="button" onclick="pdfprint('<?=$r['kode']?>')" class="btn btn-block btn-outline-primary btn-xs"><i class="fas fa-qrcode"></i></a>
                        <a type="button" href="#" class="btn btn-block btn-outline-info btn-xs"><i class="far fa-edit"></i></a>
                        <a type="button" href="modul/p_hapus_absen.php?id=<?=$r['id']?>" class="btn btn-block btn-outline-danger btn-xs"><i class="far fa-trash-alt"></i></a>
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
        ?>
        <div class="card">
          <div class="card-body">
            <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link active" id="tab-0" data-toggle="tab" href="#all" role="tab" aria-controls="desc-<?=$x?>" aria-selected="true">Semua</a>
                <?php
                for($x=1;$x<6;$x++){
                ?>
                  <a class="nav-item nav-link" id="tab-<?=$x?>" data-toggle="tab" href="#kel<?=$x?>" role="tab" aria-controls="desc-<?=$x?>" aria-selected="false">Kelompok <?=$x?></a>
                <?php
                  }
                ?>
              </div>
            </nav>
            </div>

            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="desc-tab-0"> Lorem ipsum dolor sit amet
              </div>
              <?php
                for($c=1;$c<6;$c++){
              ?>
              <div class="tab-pane fade" id="kel<?=$c?>" role="tabpanel" aria-labelledby="desc-tab-<?=$c?>">
                <div class="card-body">
                  <form class="form-horizontal" methode="POST" action="modul/p_absen_user.php"> 
                  <input type="hidden" name="id" value="<?=$kode?>">   
                  <input type="hidden" name="fkel" value="<?=$c?>">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Mahasiswa</label>
                      <div class="col-sm-6">
                        <select class="select2" name="mhs[]" multiple="multiple" data-placeholder="Mahasiswa" data-dropdown-css-class="select2-purple">
                          <?php
                            $data = coc_sql("SHOW", "tb_mhs", "*", "1=1");
                            while ($r = $data->fetch_array()) {
                              echo "<option value='$r[nim]'>".$r['nim']."-".$r['nama']."</option>";
                            }
                          ?>
                        </select>
                      </div>
                  </div>

                  <?php 
                  for($x=1;$x<17;$x++){
                  ?>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Pertemuan <?=$x?></label>
                      <div class="input-group date col-sm-6" id="p<?=$c?>-<?=$x?>" data-target-input="nearest"> 
                          <input type="text" name="p[]" value="test" class="form-control datetimepicker-input" data-target="#p<?=$c?>-<?=$x?>" />
                          <div class="input-group-append" data-target="#p<?=$c?>-<?=$x?>" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                  </div>
                  <?php
                  }
                  ?>
  
                    <!-- </div> -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                  </div>
 
              </div>
              <?php
                }
              ?>
              
          </div>
        </div>
      </div>
    </div>
      <?php } ?>
</div>
</section>

      <div class="modal fade" id="input-absen">
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
                  <div class="form-group">
                    <label for="fperiode">Periode</label>
                      <!-- <div class="col-sm-6"> -->
                        <select class="form-control" name="fperiode"  data-placeholder="Mahasiswa">
                          <?php
                            $data = coc_sql("SHOW", "tb_periode", "*", "1=1", "id DESC");
                            while ($r = $data->fetch_array()) {
                              $semester = $r['semester'] == 0 ? "Ganjil" : "Genap";
                              echo "<option value='$r[id]'>".$r['tahun']." - ".$semester."</option>";
                            }
                          ?>
                        </select>
                      <!-- </div> -->
                  </div>

                  <div class="form-group">
                    <label for="fprodi">Program Studi</label>
                      <!-- <div class="col-sm-6"> -->
                        <select class="form-control" name="fprodi">
                          <?php
                            $data = coc_sql("SHOW", "z_prodi", "*", "1=1", "id_prodi ASC");
                            while ($r = $data->fetch_array()) {
                
                              echo "<option value='$r[kode_prodi]'>".$r['nama']."</option>";
                            }
                          ?>
                        </select>
                      <!-- </div> -->
                  </div>

                  <div class="form-group">
                    <label for="fmatkul">Mata Kuliah</label>
                      <!-- <div class="col-sm-6"> -->
                        <select class="form-control" name="fmatkul">
                          <?php
                            $data = coc_sql("SHOW", "tb_mk", "*", "1=1", "nama_mk ASC");
                            while ($r = $data->fetch_array()) {
                
                              echo "<option value='$r[kode_mk]'>".$r['nama_mk']."</option>";
                            }
                          ?>
                        </select>
                      <!-- </div> -->
                  </div>

                  <div class="form-group">
                    <label for="fdosen">Dosen Koordinator</label>
                      <!-- <div class="col-sm-6"> -->
                        <select class="form-control" name="fdosen">
                          <?php
                            $data = coc_sql("SHOW", "tb_dosen", "*", "id_dosen IN (121, 203, 243, 248, 49)", "nama DESC");
                            while ($r = $data->fetch_array()) {
                
                              echo "<option value='$r[id_dosen]'>".$r['nama']."</option>";
                            }
                          ?>
                        </select>
                      <!-- </div> -->
                  </div>


                  <div class="form-group">
                    <label for="fkelas">Kelas</label>
                      <!-- <div class="col-sm-6"> -->
                        <select class="form-control" name="fkelas">
                          <?php
                            $data = coc_sql("SHOW", "tb_kelas", "*", "1=1", "kelas ASC");
                            while ($r = $data->fetch_array()) {
                
                              echo "<option value='$r[id]'>".$r['kelas']."</option>";
                            }
                          ?>
                        </select>
                      <!-- </div> -->
                  </div>

                  <div class="form-group">
                    <label for="fkelompok">Jumlah Kelompok</label>
                      <!-- <div class="col-sm-6"> -->
                        <select class="form-control" name="fkelompok">

                          <?php
                            for($c=1;$c<=5;$c++){
                              echo "<option value='$c'>".$c."</option>";
                            }
                          ?>
                        </select>
                      <!-- </div> -->
                  </div>

                  <div class="form-group">
                    <label for="fpertemuan">Jumlah Pertemuan</label>
                      <!-- <div class="col-sm-6"> -->
                        <select class="form-control" name="fpertemuan">
                          <?php
                            $pertemuan = array(16, 8, 24);
                            foreach($pertemuan as $key => $meet)
                            
                              echo "<option value='$meet'>".$meet."</option>";
                            
                          ?>
                        </select>
                      <!-- </div> -->
                  </div>

              
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
      
      function filter() {
    var ta = document.getElementById("ftaktif").value ;
    window.location = '?act=abs&ta='+ta;
    // window.open('?act=abs&ta='+ta);
}

</script>