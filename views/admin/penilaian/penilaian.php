<?php
include dirname(__FILE__, 4) . '/applications/admin/menu_penilaian/Penilaian_CRUD.php';
$Penilaian = new Penilaian_CRUD();
$res = $Penilaian->getAllPenilaian();
if ($res->num_rows == 0) {
	$penilaian = null;
} else {
	@$penilaian = $res;
}
if (isset($_POST['search'])) {
	$Penilaian->id_sales = $_POST['nama_salesman'];
	$Penilaian->id_spv = $_POST['nama_spv'];
	@$penilaian = $Penilaian->searchPenilaianBySpvAndSales();
}

?>
<section class="content-header">
	<h1>
		Dashboard
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<!-- left column -->
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Penilaian</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" action="?content=penilaian" method="post">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nama_spv">Nama SPV</label>
									<select name="nama_spv" id="nama_spv" class="form-control">

									</select>
								</div>
								<div class="form-group">
									<label for="nama_salesman">Nama Salesman</label>
									<select name="nama_salesman" id="nama_salesman" class="form-control">

									</select>
								</div>
							</div>

							<div class="col-md-6">

							</div>
						</div>
						<div class="form-group">
							<button id="btnSearch" name="search" class="btn btn-md btn-info ">
								<i class="fa fa-search"></i> Search
							</button>
							<!-- <a href="?content=stok_gudang&action=tambah_barang" class="btn btn-md btn-primary">
	                			<i class="fa fa-print"></i> Print
	                		</a>-->
							<button id="btnNilai" class="btn btn-md btn-success">
								<i class="fa fa-user"></i> Generate penilaian bulan ini
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Data Penilaian</h3>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead class="bg-primary">
							<tr>
								<th style="width: 10px">#</th>
								<th>Tanggal penilaian</th>
								<th>Nama Salesman</th>
								<th>Nama SPV</th>
								<th>Kehadiran</th>
								<th>Pemasangan Materi</th>
								<th>Keterangan</th>
							</tr>
						</thead>

						<tbody>
							<?php if ($penilaian != null) : ?>
								<?php $i = 0;
									foreach ($penilaian as $penilaian) : ?>
									<tr>
										<td><?= ++$i; ?></td>
										<td><?= $penilaian['tgl_penilaian'] ?></td>
										<td><?= $penilaian['nama_sales'] ?></td>
										<td><?= $penilaian['nama_spv'] ?></td>
										<td><?= $penilaian['nilai_hadir'] ?></td>
										<td><?= $penilaian['nilai_materi'] ?></td>
										<td><?= $penilaian['keterangan'] ?></td>
									</tr>
									<?php endforeach; ?>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

</section>
<script>
	$(function() {
		$.ajax({
			url: './applications/admin/menu_karyawan/modul/getAllSalesman.php',
			method: 'GET',
			success: (res) => {
				let data_parse = JSON.parse(res)
				if (res != 'false') {
					let data = JSON.parse(res)
					data.forEach(el => {
						$('#nama_salesman').append(new Option(el.nama_sales, el.id_sales))
					})
				} else {
					$('#nama_salesman').append(new Option(el.nama_sales, el.id_sales))
				}
			}
		})
		$.ajax({
			url: './applications/admin/menu_users/modul/getAllSpv.php',
			method: 'GET',
			success: (res) => {
				if (res != 'false') {
					let data = JSON.parse(res)
					data.forEach(el => {
						$('#nama_spv').append(new Option(el.nama, el.id_users))
					})
				} else {
					$('#nama_spv').append(new Option(el.nama, el.id_users))
				}
			}
		})

		$('#btnNilai').click(function(e) {
			e.preventDefault();
			$.ajax({
				url: './applications/admin/menu_penilaian/modul/generateNilai.php',
				method: 'GET',
				success: (res) => {
					if (res == true) {
						alert('Operasi berhasil');
						location.reload();
					} else {
						alert('gagal');
						location.reload();
					}
				}
			})
		})
	})
</script>