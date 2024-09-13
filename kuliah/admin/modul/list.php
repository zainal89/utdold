 <style>
        .select2-results__option[aria-selected="true"] {
            background-color: #90EE90 !important; 
            color: black; 
        }
        .select2-selection__choice {
            background-color: #90EE90 !important; 
            color: black !important; 
        }
</style>
    
<!-- Content Header (Page header) --> 
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1>Permohonan Surat Keterangan Aktif Kuliah</h1>
      </div>

    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php
        $status = (!isset($_GET['s']) ? "1=1" : "status=".$_GET['s']);
        ?>
          <!-- <div class="row"> -->
          <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-3">
                <!--<div class="form-group">-->
                  <select class="form-control select2" id="ftaktif" style="width: 100%;">
                      <option>Semua</option>
                      <option>Diajukan</option>
                      <option>Diproses</option>
                      <option>Ditolak</option>
                      <option>Selesai</option>
                  </select>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <button class="btn btn-outline-primary btn-sm" onCLick="filter()"><i class="fas fa-search"></i> Filter </button>
 
                </div>
              </div>
            </div>

                
            </div>
          <!--</div>-->
            
              <div class="card-body">
                <table id="tabeldata" class="table table-bordered table-striped">
                  <thead>
                  <tr class="text-center">
                    <th>No. </th>
                    <th>Tiket</th>
                    <th>Nim</th>
                    <th>Nama</th>
                    <th>Semester</th>
                    <th>PA</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $num=0;
                    $data_tanya = coc_sql("SHOW", "tb_aktif",
                      "*", 
                      "$status");
                    while ($r = $data_tanya->fetch_array()) {  
                      $num++;
                    ?>
                    <tr>
                      <td class="text-center"><?=$num?></td>
                      <td class="text-center"><?=$r['ticket']?></td>
                      <td class="text-center"><?=$r['nim']?></td>
                      <td><?=$r['nama']?></td>
                      <td class="text-center"><?=$r['smt']?></td>
                      <td ><?=$r['pa']?></td>
                      <td ><?=$r['status']?></td>
                      <td class="text-center">
                          <?php 
                            $tik = $r['ticket'];
                          ?>
                        <a type="button" href="?act=list" onclick="ticketing('<?=$tik?>')" data-toggle="modal" data-target="#tambah-absen" class="btn btn-block btn-outline-warning btn-xs"><i class="fas fa-check-double"></i> Proses</a>
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

</div>
</section>
     
     <script>
        function ticketing(s){
            var tt = document.getElementById("fdTiket");
            var ts = document.getElementById("fTiket");
            tt.value = s;
            ts.value = s;
            var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?act=list&&tiket=' + s;
            window.history.pushState({path:newUrl}, '', newUrl);
        }    
     </script>
     
      <div class="modal fade" id="tambah-absen">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Validasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" action="modul/p_tambah.php" method="POST">
                  
                  <div class="form-group row">
                        <label for="ftiket" class="col-sm-3 col-form-label">Tiket</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="fdTiket" name="fdTiket" placeholder="Nama" disabled required>
                          <input type="hidden" id="fTiket" name="fTiket" value="">
                        </div>
                     </div>
                  <?php
                  echo $tc = $_GET['tiket'];
                  $cek = coc_sql("SHOW", "tb_aktif", "*", "ticket='$tc'");
                  $r = $cek->fetch_array();
                  echo $r['nama'];
                  ?>


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

  function excel_d(id){
    window.open('<?=pathprint?>absen_f.php?id='+id, '_blank', 'toolbar=yes, scrollbars=yes, resizable=yes, top=500,left=500, width=400, height=400');
      }
      
function filter() {
    var s = document.getElementById("ftaktif").value ;
    window.location = '?act=list&s='+s;
    // window.open('?act=abs&ta='+ta);
}


$(document).ready(function() {
            // Inisialisasi select2
            $('.select2').select2();
        });

        function clearAllSelects() {
            $('.select2').val(null).trigger('change'); // Menghapus semua pilihan di select2
        }

</script>