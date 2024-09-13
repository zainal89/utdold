
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
            
        </div>
      </div>
</div>
</section>
