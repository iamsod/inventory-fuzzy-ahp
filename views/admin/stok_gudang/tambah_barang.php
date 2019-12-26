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
					<h3 class="box-title">Tambah Barang</h3>
				</div>
				<form role="form" action="" method="POST" enctype="multipart/form-data" id="tbh">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="kode_item">Kode Item</label>
									<input type="text" class="form-control" name="kode_item" id="kode_item" placeholder="Masukan Kode Item">
								</div>
								<div class="form-group">
									<label for="brand">Brand</label>
									<input type="text" class="form-control" name="brand" id="brand" placeholder="Masukan Brand">
								</div>
								<div class="form-group">
									<label for="nama_item">Nama Item</label>
									<input type="text" class="form-control" name="nama_item" id="nama_item" placeholder="Masukan Nama Item">
								</div>
							</div>

							<div class="col-md-6">
								<!-- <div class="form-group">
									<label for="status_barang">Status Barang</label>
									<input type="text" class="form-control" name="status_barang" id="status_barang" placeholder="Masukan Status Barang">
								</div> -->
								<div class="form-group">
									<label for="gambar_barang">Gambar</label>
									<input type="file" class="form-control" name="gambar_barang" id="gambar_barang">
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="bekas">Jumlah barang bekas</label>
										<input type="number" class="form-control" name="jml_bekas" id="bekas">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="baru">Jumlah barang baru</label>
										<input type="number" class="form-control" name="jml_baru" id="baru">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="button" onclick="window.history.go(-2)" class="btn btn-md btn-danger">
								<i class="fa fa-arrow-circle-left"></i> Kembali
							</button>
							<button type="submit" class="btn btn-md btn-primary">
								<i class="fa fa-plus"></i> Tambah Barang
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<script>
	$('#tbh').on('submit', function(evt) {
		evt.preventDefault();
		$.ajax({
			url: './applications/admin/menu_barang/modul/insert.php',
			method: 'POST',
			processData: false,
			contentType: false,
			data: new FormData(this),
			success: function(val) {
				if (val == 1) {
					alert("Berhasil tertambah");
					window.location.href = 'index.php?content=stok_gudang&action=permintaan&extends=tambah_barang';
				} else {
					alert("Error");
				}
			}
		})
	})
</script>