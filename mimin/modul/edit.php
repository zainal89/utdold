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
                <!-- <h5 class="widget-user-desc"><?=$user_nip?></h5> -->
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
              <!-- form start -->
              <form GET="POST" action="modul/p_edit.php">
                <div class="card-body">
              <!--   <div class="card-body">
                <div id="actions" class="row">
                  <div class="col-lg-4">
                    <div class="btn-group w-100">
                      <span class="btn btn-success col fileinput-button">
                        <i class="fas fa-plus"></i>
                        <span>Add</span>
                      </span>
                      <!-- <button type="submit" class="btn btn-primary col start">
                        <i class="fas fa-upload"></i>
                        <span>Upload</span>
                      </button>
                      <button type="reset" class="btn btn-warning col cancel">
                        <i class="fas fa-times-circle"></i>
                        <span>Cancel</span>
                      </button> --
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center">
                    <div class="fileupload-process w-100">
                      <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                        <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                      </div>
                    </div>
                  </div>
                </div> -
                <div class="table table-striped files" id="previews">
                  <div id="template" class="row mt-2">
                    <div class="col-auto">
                        <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                    </div>
                    <div class="col d-flex align-items-center">
                        <p class="mb-0">
                          <span class="lead" data-dz-name></span>
                          (<span data-dz-size></span>)
                        </p>
                        <strong class="error text-danger" data-dz-errormessage></strong>
                    </div>
                    <div class="col-4 d-flex align-items-center">
                        <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                        </div>
                    </div>
                    <div class="col-auto d-flex align-items-center">
                      <div class="btn-group">
                        <button class="btn btn-primary start">
                          <i class="fas fa-upload"></i>
                          <span>Start</span>
                        </button>
                        <button data-dz-remove class="btn btn-warning cancel">
                          <i class="fas fa-times-circle"></i>
                          <span>Cancel</span>
                        </button>
                        <button data-dz-remove class="btn btn-danger delete">
                          <i class="fas fa-trash"></i>
                          <span>Delete</span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
                  

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