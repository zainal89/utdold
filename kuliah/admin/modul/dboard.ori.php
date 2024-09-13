<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Profil</h1>
      </div>

    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php
        if($user_pwd == $dosen_pwd_default)echo "<div class='alert alert-warning alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h5><i class='icon fas fa-exclamation-triangle'></i> Warning !</h5>

                Perbaharui profil Anda, silahkan ganti <i><b>password default</b></i> Anda.

        </div>";
        ?>
        

        <div class="row">
          <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username"><?=$user_nama?></h3>
                <h5 class="widget-user-desc"><?=$user_nip?></h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="<?=pathfotodosen?><?=$user_foto?>" alt="<?=$user_nip?>">
              </div>
              <div class="card-footer">
                <!-- <div class="row"> -->
                  <div class="border-right">
                    <div class="description-block">
                      <h5 class="description-header text-left">No. Handphone : </h5>
                      <p class="text-left"><?=$user_hp?></p>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <div class="border-right">
                    <div class="description-block">
                      <h5 class="description-header text-left">E-Mail : </h5>
                      <p class="text-left"><?=$user_em?></p>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                <!-- </div> -->
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          <!-- /.col -->

          
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-body">
                Absen hari ini <strong><?=idfulltoday()?></strong>
              <table id="tabeldata" class="table table-bordered table-hover">
              <thead>
                <tr class="text-center" style="background-color: #808080;">
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Mata Kuliah</th>
                  <th>Jam</th>
                </tr>
              </thead>

              <tbody>
              </tbody>
            </table>

            </div>
          </div>
          </div>
</div>
</section>