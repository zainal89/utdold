<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2"></div>
  </div>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
	
	
			
			<?php
			if(!isset($_GET['id'])){
			?>
			<div class="card card-primary">
			<div class="card-body">
			<div class="card-header">

                <h3 class="card-title">History Pencarian</h3>
  
			</div>
		   <br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr class="text-center">
						<th>No. </th>
						<th>Tanggal</th>
						<th>NIM</th>
						<th>Nama</th>
						<th>Jurusan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
							<?php
							$num=0;
							$tdy = date('Y-m-d');
							$history = coc_sql("SHOW", 
							  " tb_td_mhs_absen AS a 
							  LEFT JOIN tb_mhs AS b ON a.id_mhs = b.nim 
							  LEFT JOIN tb_ika AS c ON a.id_ika = c.bmn
							  LEFT JOIN z_prodi AS d ON b.prodi = d.kode_prodi
							  ", 
							  "a.tgl_akses AS tgl, a.id_ika AS bmn, a.id_mhs AS nim, b.nama AS mhs, c.nama AS nama, c.merk AS merk, c.type AS type, d.nama AS prodi", 
							  "1=1", "a.id DESC", "b.nim");

							while ($r = $history->fetch_array()) {  
							  $num++;
							  $tglq = date_format(date_create($r['tgl']), 'd-m-Y');
							?>
							<tr>
							  <td class="text-center"><?=$num?></td>
							  <td><?=$tglq?></td>
							  <td class="text-center"><?=$r['nim']?></td>
							  <td><?=ucwords(strtolower($r['mhs']))?></td>
							  <td><?=$r['prodi']?></td>
							  <td class="text-center"><a type="button" href="?act=his&id=<?=$r['nim']?>"  class="btn btn-outline-success btn-xs"><i class="fas fa-eye"> Detail</a></td>
							
						   </tr>
							<?php
							}
							?>
						  </tbody>
						</table>
			<?php
			}else{
				$userq = coc_value("tb_mhs", "nama", "nim='$kode'");
			?>
			<div class="card">
			<div class="card-header">

                <h3 class="card-title">Detail Penggunaan <?=ucwords(strtolower($userq))?></h3>
   
            <div class="card-tools">
              <a class="btn btn-outline-secondary btn-sm" href="?act=his" ><i class="fas fa-undo"></i> Kembali</a>
                
            </div>
          </div>
		<div class="card-body">
			<table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr class="text-center">
                    <th>No. </th>
                    <th>BMN</th>
                    <th>Nama Alat </th>
                    <th>Merk</th>
                    <th>Type</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $num=0;
					$tdy = date('Y-m-d');
                    $history = coc_sql("SHOW", 
                      "tb_td_mhs_absen AS a 
					  LEFT JOIN tb_mhs AS b ON a.id_mhs = b.nim 
					  LEFT JOIN tb_ika AS c ON a.id_ika = c.bmn", 
                      "a.id_ika AS bmn, c.nama AS nama, c.merk AS merk, c.type AS type", 
                      "a.id_mhs = '$kode'");

                    while ($r = $history->fetch_array()) {  
                      $num++;
                    ?>
                    <tr>
                      <td class="text-center"><?=$num?></td>
                      <td><?=$r['bmn']?></td>
                      <td><?=ucwords($r['nama'])?></td>
                      <td><?=ucwords($r['merk'])?></td>
                      <td><?=ucwords($r['type'])?></td>
                    <!--  <td class="text-center"><a type="button" href="?act=rek&id=<?=$r['bmn']?>"  class="btn btn-outline-success btn-xs"><i class="fas fa-eye"> View</a></td> -->
                    </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
			
			
			<?php
			}
			?>
		</div>
	</div>
</section>
<!-- /.content -->