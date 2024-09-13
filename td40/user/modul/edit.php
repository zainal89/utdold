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
        if($user_kartu == 1)echo "<div class='alert alert-danger alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h5><i class='icon fas fa-ban'></i> Alert !</h5>

                Silahkan hubungi admin untuk mendaftarkan <b>eKTP</b> sebagai kartu absen Anda.

        </div>";
        if($user_pwd == $user_pwd_default)echo "<div class='alert alert-warning alert-dismissible'>
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
                <h3 class="widget-user-username"><?=strtoupper($user_nama)?></h3>
                <h5 class="widget-user-desc"><?=$user_nim?></h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="<?=pathfotomhs?><?=$user_foto?>" alt="<?=$user_nim?>">
              </div>
              <div class="card-footer">
                <!-- <div class="row"> -->
                  <div class="border-right">
                    <div class="description-block">
                      <h5 class="description-header text-left">Progra Studi : </h5>
                      <p class="text-left"><?=$user_prodi?></p>
                    </div>
                    <!-- /.description-block -->
                  </div>
<!--                   <div class="border-right">
                    <div class="description-block">
                      <h5 class="description-header text-left">KTP : </h5>
                      <p class="text-left"><?=$user_ktp?></p>
                    </div>
             
                  </div> -->
                         <!-- /.description-block -->
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
              <!-- form start -->
              <form GET="POST" action="modul/p_edit.php">
                <div class="card-body">
                  <div class="form-group">
                    <label for="fhp">HP</label>
                    <input type="text" class="form-control col-md-6" id="fhp" name="fhp" placeholder="Enter HP" value="<?=$user_hp?>" required>
                  </div>

                  <div class="form-group">
                    <label for="femail">Email</label>
                    <input type="email" class="form-control col-md-6" id="femail" name="femail" placeholder="Enter Email" value="<?=$user_em?>" required>
                  </div>

                  <div class="form-group">
                    <label for="fpwd">Password</label>
                    <input type="password" class="form-control col-md-6" id="fpwd" name="fpwd" placeholder="Kosongkan bila tidak ingin di rubah">
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
</div>
</section>