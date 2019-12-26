<?php

if (isset($_SESSION['permintaan_id'])) {
	echo "<script>
		window.location.href = '?content=stok_gudang&action=permintaan&extends=tambah_barang'
	</script>";
}

include dirname(__FILE__, 4) . '/applications/admin/menu_barang/Barang_CRUD.php';
$Barang = new Barang_CRUD();
@$barang = $Barang->getAll();

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
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Permintaan</h3>
				</div>
				<form role="form" id='form-permintaan'>
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nama_salesman">Nama Salesman</label>
									<select name="nama_salesman" id="nama_salesman" class="form-control">
									</select>
								</div>
								<div class="form-group">
									<label for="tanggal_penggunaan">Tanggal Penggunaan</label>
									<input type="date" class="form-control" name="tanggal_penggunaan" id="tanggal_penggunaan">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="nama_pembuat">Nama Pembuat</label>
									<input type="text" class="form-control" name="nama_pembuat" id="nama_pembuat" value="<?= $_SESSION['user']['nama']; ?>" placeholder="Masukan Nama Pembuat">
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="button" onclick="window.history.go(-1)" class="btn btn-md btn-danger">
								<i class="fa fa-arrow-circle-left"></i> Kembali
							</button>
							<a id="tbh-permintaan" href="?content=stok_gudang&action=permintaan&extends=tambah_barang" class="btn btn-md btn-primary">
							<!-- <a id="tbh-permintaan"  class="btn btn-md btn-primary"> -->
								<i class="fa fa-plus"></i> Tambah Permintaan
							</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<script>
	$('#tbh-permintaan').on('click', function(e) {
		let form = $('#form-permintaan').serialize();
		$.ajax({
			url: './applications/admin/menu_permintaan/modul/insert.php',
			method: 'POST',
			data: form,
			success: (res) => {
				if (res != false) {
					alert('Permintaan tercatat, silahkan tambah barang')
					window.location.href = '?content=stok_gudang&action=permintaan&extends=tambah_barang'
				} else {
					alert('error')
				}
			}
		})
	})

	$(function() {
		$.ajax({
			url: './applications/admin/menu_karyawan/modul/getAllSalesman.php',
			method: 'GET',
			success: (res) => {
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
	})
</script>