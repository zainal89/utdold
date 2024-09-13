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
  <?php
  if(!isset($_GET['id'])){ 
      if(isset($_GET['e']) == 1){ 
    ?>

     <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                  Data telah tercatat sebelumnya, silahkan pilih EDIT untuk merubah data atau memilih tambahakan baru dengan nomor barang milik negara (BMN) yang berebda.
      </div>
      <?php
    }
      ?>
                
    <div class="card">
      <!-- /.card-header -->
      <div class="card-header">
        <div class="card-tools">
          <a type="button" href="?act=add" class="btn btn-success btn-block btn-sm" ><i class="fas fa-plus"></i> Tambah</a>


        </div>
      </div>

        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr class="text-center">
              <th>No</th>
              <th>BMN</th>
              <th>Nama</th>
              <th>Merk</th>
              <th>Type</th>
              <th>QR Code</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
              <?php
              $no=0;
              $mhs = coc_sql("SHOW", "tb_ika", "*", "1=1");
              while ($r = $mhs->fetch_array()) {  
                $no++;
              ?>
              <tr>
                <td class="text-center"><?=$no?></td>
                <td class="text-center"><?=$r['bmn']?></td>
                <td ><?=strtoupper($r['nama'])?></td>
                <td ><?=strtoupper($r['merk'])?></td>
                <td ><?=strtoupper($r['type'])?></td>
                <td class="text-center">
                  <a type="button" onclick="pdfprint('<?=$r['id']?>')" class="btn btn-outline-danger btn-xs" ><i class="fas fa-download"></i> Download</a>
                </td>
                <td class="text-center">
                  <a type="button" href="?act=device&id=<?=$r['id']?>"  class="btn btn-outline-success btn-xs"><i class="fas fa-eye"> </i> View</a>
                  <a type="button" href="?act=edd&id=<?=$r['id']?>"  class="btn btn-outline-warning btn-xs"><i class="fas fa-pen"> </i> Edit</a>
                </td>
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
      
      $absen = coc_sql("SHOW", "tb_ika", "*", "id=$kode");
          $r = $absen->fetch_array();
          $num = 0;
        ?>
        <div class="card">
          <div class="card-header">
            <div class="card-tools">

              <a class="btn btn-outline-secondary btn-sm" href="?act=device" ><i class="fas fa-undo"></i> Kembali</a>
              <a type="button" href="?act=edd&id=<?=$r['id']?>"  class="btn btn-outline-warning btn-sm"><i class="fas fa-pen"> </i> Edit</a>
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
      <?php
    }
    ?>

         </div>   
         
</section>

<script type="text/javascript">
  function pdfprint(id){
    window.open('<?=pathprint?>qrcode.php?id='+id, '_blank', 'toolbar=yes, scrollbars=yes, resizable=yes, top=500,left=500, width=400, height=400');
      }

</script>