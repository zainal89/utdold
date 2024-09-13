<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Daftar Pertanyaan</h1>
      </div>

    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <?php
        if(!isset($_GET['id'])){ ?>
          <!-- <div class="row"> -->
          <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr class="text-center">
                    <th>No. </th>
                    <th>Kode</th>
                    <th>Mata Kuliah</th>
                    <th>Soal</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $num=0;
                    $data_tanya = coc_sql("SHOW", 
                      "tb_absen AS a LEFT JOIN tb_mk AS b ON a.id_matkul = b.kode_mk
                       LEFT JOIN tb_kelas AS c ON a.id_kelas = c.id", 
                      "a.id AS id, a.id_matkul AS kode, b.nama_mk AS mk, a.ask AS ask, c.kelas AS kelas", 
                      "a.id_dosen='$_SESSION[s_id_dosen]'");
                    while ($r = $data_tanya->fetch_array()) {  
                      $num++;
                    ?>
                    <tr>
                      <td class="text-center"><?=$num?></td>
                      <td class="text-center"><?=$r['kelas']?></td>
                      <td><?=$r['mk']?></td>
                      <td class="text-center"><?=$r['ask']?></td>
                      <td class="text-center"><a type="button" href="?act=ask&id=<?=$r['id']?>" class="btn btn-block btn-outline-success btn-xs">Edit</a></td>
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
        <div class="row">

          <div class="col-md-4">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
          <div class="card card-primary">
              <!-- form start -->
              <form GET="POST" action="modul/p_edit.php">
                <div class="card-body">
                  <div class="form-group">
                    <label for="ftanya">Pertanyaan</label>
                    <textarea class="form-control" name="ftanya" placeholder="Masukkan Pertanyaan" value="" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="fa">Pilihan A</label>
                    <input type="text" class="form-control" name="fa" placeholder="Masukkan Pilihan A" value="" required>
                  </div>
                  <div class="form-group">
                    <label for="fb">Pilihan B</label>
                    <input type="text" class="form-control" name="fb" placeholder="Masukkan Pilihan B" value="" required>
                  </div>
                  <div class="form-group">
                    <label for="fc">Pilihan C</label>
                    <input type="text" class="form-control" name="fc" placeholder="Masukkan Pilihan C" value="" required>
                  </div>
                  <div class="form-group">
                    <label for="fd">Pilihan D</label>
                    <input type="text" class="form-control" name="fd" placeholder="Masukkan Pilihan D" value="" required>
                  </div>

                  <div class="form-group">
                    <label for="fjawab">Jawaban</label>
                    <select class="form-control" name="fjawab" required>
                      <option value="A">Pilihan A</option>
                      <option value="B">Pilihan B</option>
                      <option value="C">Pilihan C</option>
                      <option value="D">Pilihan D</option>
                    </select>
                  </div>

                  

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
              </form>
            </div>
          </div>
          </div>

          <div class="col-md-8">
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
        </div>
      <?php } ?>
</div>
</section>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
       "lengthChange": false, 
       "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "responsive": true,
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
</script>