<?php
include dirname(__FILE__, 4) . '/applications/admin/menu_pengembalian/Pengembalian_CRUD.php';
$Pengembalian = new Pengembalian_CRUD();
$res = $Pengembalian->getAllBarangYgKembali();
if ($res->num_rows == 0) {
	$Pengembalian = null;
} else {
	$Pengembalian = $res;
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
					<h3 class="box-title">Pengembalian</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<!-- <div class="form-group">
									<label for="nama_salesman">Nama Salesman</label>
									<input type="text" class="form-control" name="nama_salesman" id="nama_salesman" placeholder="Masukan Nama Salesman">
								</div> -->
								<div class="form-group">
									<label for="no_bppm">No. BPPM</label>
									<input type="number" class="form-control" name="no_bppm" id="no_bppm" placeholder="Masukan No bppm">
								</div>
							</div>

							<!-- <div class="col-md-6">
								<div class="form-group">
									<label for="tanggal_pemakaian">Tanggal Pemakaian</label>
									<input type="date" class="form-control" name="tanggal_pemakaian" id="tanggal_pemakaian">
								</div>
							</div> -->
						</div>
						<div class="form-group">
							<!-- <button data-target='#modal-default' data-toggle="modal" class="btn btn-md btn-info btn-pengembalian">
								<i class="fa fa-search"></i> Cari
							</button> -->
							<button data-target='#modal-default' data-toggle="modal" class="btn btn-md btn-info btn-pengembalian">
								<i class="fa fa-refresh"></i> Pengembalian
							</button>
							<button type="button" id="btn-print" class="btn btn-md btn-primary">
								<i class="fa fa-print"></i> Print
							</button>
							<!-- <a href="?content=stok_gudang&action=tambah_barang" class="btn btn-md btn-primary">
	                			<i class="fa fa-print"></i> Print
	                		</a>
	                		<a href="?content=stok_gudang&action=permintaan" class="btn btn-md btn-success">
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
					<h3 class="box-title">Data Barang</h3>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-striped table-bordered table-hover" style="border: 1px black solid;">
						<thead class="bg-primary">
							<tr>
								<th style="width: 10px">#</th>
								<th>Kode Item</th>
								<th>Nama Barang</th>
								<th colspan="2">Jumlah Barang</th>
								<th>Konsumsi</th>
								<th colspan="2">Kembali</th>
							</tr>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th>Baru</th>
								<th>Bekas</th>
								<th></th>
								<th>Baru</th>
								<th>Bekas</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($Pengembalian != null) : ?>
								<?php $i = 0;
									while($pengembali = $Pengembalian->fetch_assoc() ){ ?>
									<tr>
										<td><?= ++$i; ?></td>
										<td><?= $pengembali['kode'] ?></td>
										<td><?= $pengembali['nama'] ?></td>
										<td><?= $pengembali['brg_sblum_baru'] ?></td>
										<td><?= $pengembali['brg_sblum_bekas'] ?></td>
										<td><?= $pengembali['konsumsi'] ?></td>
										<td><?= $pengembali['brg_baru_kembali'] ?></td>
										<td><?= $pengembali['brg_bekas_kembali'] ?></td>
									</tr>
									<?php } ?>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>

	<div class="modal fade" id="modal-default">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title">Pengembalian barang</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col">
							<h4 class="text-center">Barang yang mau dikembalikan</h4>
						</div>
					</div>
					<div id="info-no-bppm"></div>
					<div class="row" style="padding: 10px">
						<div class="col p-3">
							<form id="form-pengembalian">
								<div class="form-group">
									<label for="barang">Nama barang</label>
									<select name="barang" id="barang" class="form-control">
									</select>
								</div>
								<div class="form-group">
									<label for="">Jumlah Konsumsi</label>
									<input class="form-control" type="number" name="konsumsi">
								</div>
								<div class="form-group">
									<label for="">Jumlah Rusak</label>
									<input class="form-control" type="number" name="brg_rusak">
								</div>
								<div class="form-group">
									<label for="">Jumlah Jual</label>
									<input class="form-control" type="number" name="jml_jual">
								</div>
								<div class="form-group">
									<label for="">Jumlah barang baru yang kembali</label>
									<input class="form-control" type="number" name="brg_baru_kembali">
								</div>
								<div class="form-group">
									<label for="">Jumlah barang bekas yang kembali</label>
									<input class="form-control" type="number" name="brg_bekas_kembali">
								</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group">
						<button type="submit" class="btn btn-success">Simpan</button>
					</div>
				</div>
				</form>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
	</div>

</section>

<script>
	$(function() {
		$('#btn-print').click(function(e) {
			e.preventDefault();
			let no_bppm = $("input[name='no_bppm']").val();
			if (no_bppm != '') {
				$.ajax({
					url: './applications/admin/menu_pengembalian/modul/print.php',
					method: 'post',
					data: {
						no_bppm: no_bppm
					},
					success: (res) => {
						if (res == true) {
							window.location.href = 'permintaan/print3.php'
						} else {
							alert(res);
						}
					}
				})
			} else {
				alert('Silahkan masukkan no bppm');
			}
		})

		$('#no_bppm').autocomplete({
			source: (request, response) => {
				$.ajax({
					url: './applications/admin/menu_pengembalian/modul/getnobppm.php',
					method: 'POST',
					dataType: 'json',
					data: {
						no_bppm: $('#no_bppm').val()
					},
					success: (res) => {
						console.log(res);
						response(res)
					}
				})
			},
			select: (event, ui) => {
				$('#no_bppm').val(ui.item.label)
			}
		})
		var data;
		$('.btn-pengembalian').click(function(e) {
			e.preventDefault()
			let no = $('#no_bppm').val()
			if (no != '') {
				$.ajax({
					url: './applications/admin/menu_pengembalian/modul/getbarang.php',
					method: 'post',
					data: {
						no_bppm: no
					},
					dataType: 'json',
					success: (res) => {
						console.log(res);
						data = res;
						$('#form-pengembalian').trigger('reset');
						if (res == 0) {
							$('#barang').html("")
							$('#info-no-bppm').append(`<div class="alert alert-danger">No bppm tidak ditemukan</div>`)
						} else {
							$('#barang').html("");
							$('#info-no-bppm').remove();
							let permintaan = "";
							let konsumsi = "";
							res.forEach(function(value, i) {
								permintaan = value.id_permintaan;
								$('#barang').append(`
									<option value='${value.kode}|${value.id_barang}' id='nama_barang'>${value.nama}</option>
							`);
							})
							$("#form-pengembalian [name='brg_baru_kembali']").attr('max', res[0].brg_baru);
							$("#form-pengembalian [name='brg_bekas_kembali']").attr('max', res[0].brg_bekas);
							$('#form-pengembalian').append(`
							<input type="hidden" name="id_permintaan" value="${permintaan}"></input>
							<input type="hidden" name="no_bppm" value="${no}"></input>
						`);
							// $("#form-pengembalian [name='brg_baru_kembali']").attr('max',)
							// $('#barang').on('change', function(e) {
							// 	let nama = $('option:selected', this).html();
							// 	console.log(result);
							// let a = res.filter((barang) => barang.nama === nama);
							// console.log(res);
							// $("#form-pengembalian [name='brg_baru_kembali']").attr('max', a[0].brg_baru);
							// $("#form-pengembalian [name='brg_bekas_kembali']").attr('max', a[0].brg_bekas);
							// });
						}
					}
				})
			} else {
				e.stopPropagation();
				alert('Masukkan no bppm');
			}
		})

		$('#barang').on('change', function(e) {
			let nama = $('option:selected', this).html();
			let a = data.filter((barang) => barang.nama === nama);
			$("#form-pengembalian [name='brg_baru_kembali']").attr('max', a[0].brg_baru);
			$("#form-pengembalian [name='brg_bekas_kembali']").attr('max', a[0].brg_bekas);
		});

		$('#form-pengembalian').submit(function(e) {
			e.preventDefault()
			$.ajax({
				url: './applications/admin/menu_pengembalian/modul/insert.php',
				method: 'POST',
				data: new FormData(this),
				processData: false,
				contentType: false,
				dataType: 'json',
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