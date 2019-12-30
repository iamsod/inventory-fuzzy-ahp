<?php
include dirname(__FILE__, 4) . '/applications/admin/menu_karyawan/Karyawan_CRUD.php';
$Karyawan = new Karyawan_CRUD();
@$spv = $Karyawan->getAllSpv();
@$salesmans = $Karyawan->getAllSalesman();

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
					<h3 class="box-title">Tambah karyawan</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" id="form-tbh-karyawan">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nama_spv">Nama SPV</label>
									<select class="form-control" id="spv" name="spv">
										<?php if ($spv != false) : ?>
											<option value="null">-- Pilih SPV --</option>
											<?php foreach ($spv as $s) : ?>
												<option value="<?= $s['id_users'] ?>"><?= $s['nama'] ?></option>
											<?php endforeach; ?>
										<?php else : ?>
											<option value="">-- Pilih SPV --</option>
										<?php endif; ?>
									</select>
								</div>
								<div class="form-group">
									<label for="nama_salesman">Nama Salesman</label>
									<input type="text" class="form-control" name="nama_salesman" id="nama_salesman" placeholder="Masukan Nama Salesman">
								</div>
								<div class="form-group">
									<label for="nik">NIK</label>
									<input type="number" class="form-control" name="nik" id="nik" placeholder="Masukan NIK">
								</div>
							</div>

							<div class="col-md-6">

							</div>
						</div>
						<div class="form-group">
							<!-- <a href="#" class="btn btn-md btn-info">
	                			<i class="fa fa-search"></i> Search
	                		</a> -->
							<button class="btn btn-md btn-primary" type="submit">
								<i class="fa fa-plus"></i> Tambah Karyawan
							</button>
							<!-- <a href="?content=stok_gudang&action=permintaan" class="btn btn-md btn-success">
	                			<i class="fa fa-dollar"></i> Transaction
	                		</a> -->
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php if (isset($_POST['search'])) { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Data Salesman</h3>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead class="bg-primary">
							<tr>
								<th style="width: 10px">#</th>
								<th>Nama Salesman</th>
								<th>Nama SPV</th>
								<th>NIK</th>
								<th>Aksi</th>
							</tr>
						</thead>

						<tbody>
							<?php $i = 0;
							foreach ($salesmans as $salesman) : ?>
								<tr>
									<td><?= ++$i ?></td>
									<td><?= $salesman['nama_sales'] ?></td>
									<td><?= $salesman['nama_spv'] ?></td>
									<td><?= $salesman['nik'] ?></td>
									<td>
										<a href="?content=karyawan&action=edit_karyawan&id=<?= $salesman['id_sales'] ?>" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
										<button onclick="return confirm('hapus ?') ? hapus(<?= $salesman['id_sales'] ?>) : null" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php }?>
</section>
<script>
	$('#form-tbh-karyawan').on('submit', function(e) {
		e.preventDefault()
		$.ajax({
			url: './applications/admin/menu_karyawan/modul/insert.php',
			method: 'POST',
			processData: false,
			contentType: false,
			data: new FormData(this),
			success: function(val) {
				if (val == 1) {
					alert("Berhasil tertambah");
					window.location.reload();
				} else {
					alert("Error");
				}
			}
		})
	})

	function hapus(id) {
		$.ajax({
			url: './applications/admin/menu_karyawan/modul/delete.php',
			data: {
				id: id
			},
			method: 'POST',
			success: function(value) {
				if (value) {
					window.location.reload();
				} else {
					alert('error');
				}
			}
		});
	}
</script>