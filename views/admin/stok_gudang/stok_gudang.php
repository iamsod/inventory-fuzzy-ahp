<?php
include dirname(__FILE__, 4) . '/applications/admin/menu_barang/Barang_CRUD.php';
$Barang = new Barang_CRUD();
$barang = $Barang->getAll();
$brands = $Barang->getBrand();

if (isset($_POST['search'])) {
	$Barang->kode = $_POST['kode_item'];
	$Barang->nama = $_POST['nama_item'];
	$Barang->brand = $_POST['brand'];
	$barang = $Barang->search();
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
					<h3 class="box-title">Stok Gudang</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" action="?content=stok_gudang" method="post">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="kode_item">Kode Item</label>
									<input onkeyup="cekKode(this)" type="text" class="form-control" name="kode_item" id="kode_item" placeholder="Masukan Kode Item">
								</div>
								<div class="form-group">
									<label for="nama_item">Nama Item</label>
									<input onkeyup="cekNama(this)" type="text" class="form-control" name="nama_item" id="nama_item" placeholder="Masukan Nama Item">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="brand">Brand</label>
									<select class="form-control" id="brand" name="brand">
										<?php if ($brands != false) : ?>
											<option value="">-- Pilih Brand --</option>
											<?php while ($brand = $brands->fetch_assoc()) {?>
												<option value="<?= $brand['brand'] ?>"><?= $brand['brand'] ?></option>
											<?php } ?>
										<?php else : ?>
											<option value="">-- Pilih Brand --</option>
										<?php endif; ?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button id="btnSearch" name="search" class="btn btn-md btn-info disabled" disabled>
								<i class="fa fa-search"></i> Search
							</button>
							<?php if ($_SESSION['user']['level'] == 'admin') : ?>
								<a href="?content=stok_gudang&action=tambah_barang" class="btn btn-md btn-primary">
									<i class="fa fa-plus"></i> Tambah Barang
								</a>
							<?php endif; ?>
							<a href="?content=stok_gudang&action=permintaan" class="btn btn-md btn-success">
								<i class="fa fa-refresh"></i> Permintaan
							</a>
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
					<h3 class="box-title">Data Barang</h3>
				</div>
				<div class="box-body table-responsive">
					<table  class="table table-striped table-bordered table-hover">
						<thead class="bg-primary">
							<tr>
								<th style="width: 10px">#</th>
								<th>Image</th>
								<th>Item Code</th>
								<th>Brand</th>
								<th>Nama Item</th>
								<th colspan="2">Jumlah Stok</th>
								<th>Status Barang</th>
								<!-- <th>Action</th> -->
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>Baru</td>
								<td>Bekas</td>
								<td></td>
								<!-- <td></td> -->
							</tr>
						</thead>

						<tbody>
							<?php $i = 0;
							while ($b = $barang->fetch_assoc()){ ?>
								<tr>
									<td><?= ++$i ?></td>
									<td>
										<img src="<?= 'assets/foto/' . $b['gambar'] ?>" alt="" width="100px" height="100px">
									</td>
									<td><?= $b['kode'] ?></td>
									<td><?= $b['brand'] ?></td>
									<td><?= $b['nama'] ?></td>
									<td><?= $b['jml_baru'] ?></td>
									<td><?= $b['jml_bekas'] ?></td>
									<td><?= $b['status'] ?></td>
									<!-- <td align="center">
										<a href="#" class="btn btn-sm btn-info"><i class="fa fa-search"></i> Lihat Detail</a>
									</td> -->
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>

</section>
<script>
	function cekKode(txt) {
		if (txt.value != '') {
			if ($('#nama_item').val() !== 'undefined') {
				$('#btnSearch').removeClass('disabled');
				$('#btnSearch').removeAttr('disabled');

			}
		} else {
			$('#btnSearch').addClass('disabled');
			$('#btnSearch').attr('disabled', 'disabled');
		}
	}

	function cekNama(txt) {
		if (txt.value != '') {
			if ($('#kode_item').val() !== 'undefined') {
				$('#btnSearch').removeClass('disabled');
				$('#btnSearch').removeAttr('disabled');
			}
		} else {
			$('#btnSearch').addClass('disabled');
			$('#btnSearch').attr('disabled', 'disabled');
		}
	}
</script>