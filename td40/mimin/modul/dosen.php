<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Dosen</h1>
      </div>

    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="container-fluid"> 
    <?php
    if(!isset($_GET['id'])){ 
    ?>
    <!-- <div class="row"> -->
    <div class="card">
        <!-- /.card-header -->
        <div class="card-header">
          <div class="card-tools">
            <button class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target="#input-absen"><i class="fas fa-plus"></i> Tambah</a>
          </div>
        </div>

        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr class="text-center">
              <th>No</th>
              <th>NIP</th>
              <th>Nama</th>
              <th>Password</th>
            </tr>
            </thead>
            <tbody>
              <?php
              $no=0;
              $mhs = coc_sql("SHOW", "tb_dosen", "*", "1=1");
              while ($r = $mhs->fetch_array()) {  
                $no++;
              ?>
              <tr>
                <td class="text-center"><?=$no?></td>
                <td class="text-center"><?=$r['nip']?></td>
                <td ><?=strtoupper($r['nama'])?></td>
                <td class="text-center"><a type="button" href="modul/p_reset_pass.php?id=<?=$r['nip']?>" class="btn btn-block btn-outline-info btn-xs">Reset</a></td>
              </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
    </div>
    <?php
    }
    ?>
  </div>
</section>