<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Daftar Instruksi Kerja</h1>
      </div>

    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <?php
        $ika = coc_sql("SHOW", "tb_ika", "*", "id='$kode'");
        $r = $ika->fetch_array();
        $bmn = $r['bmn'];
        $nama = $r['nama'];
        $merk = $r['merk'];
        $type = $r['type'];
        $ika = $r['instruksi']
        ?>
          <form class="form-horizontal" method="POST" action="modul/p_edit_device.php">
              <div class="form-group row">
                <label for="f_bmn" class="col-sm-2 col-form-label">BMN</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" value="<?=$bmn?>" disabled="">
                  <input type="hidden" id="f_bmn" name="f_bmn" value="<?=$bmn?>">
                </div>
              </div>

              <div class="form-group row">
                <label for="f_nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="f_nama" name="f_nama" placeholder="Nama Peralatan" value="<?=$nama?>" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="f_merk" class="col-sm-2 col-form-label">Merk</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="f_merk" name="f_merk" placeholder="Merk Peralatan" value="<?=$merk?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="f_type" class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="f_type" name="f_type" placeholder="Type Peralatan" value="<?=$type?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="f_type" class="col-sm-2 col-form-label">Instruksi Kerja</label>
                <div class="col-sm-10">
                  <textarea id="summernote" name="f_ika" required><?=$ika?></textarea>
                </div>
              </div>
            <!--   <div class="form-group row">
                <label for="f_ytube" class="col-sm-2 col-form-label">Youtube</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="f_ytube" placeholder="Youtube">
                </div>
              </div>
              <div class="form-group row">
                <label for="f_file" class="col-sm-2 col-form-label">Berkas</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="f_file" placeholder="File Peralatan">
                </div>
              </div> -->

            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-outline-primary btn-mg float-right"><i class="fas fa-plus"> </i> Tambahkan</button>
              <a type="button" href="?act=device"  class="btn btn-outline-success btn-mg "><i class="fas fa-undo"></i> Batal</a>
            </div>
            <!-- /.card-footer -->
          </form>
      </div>
    </div>
  </div>          
</section>


 