<?php
include dirname(__FILE__, 4) . '/applications/admin/menu_permintaan/Permintaan_CRUD.php';
$Permintaan = new Permintaan_CRUD();
$res = $Permintaan->getAllPermintaanAndPengambilan();
if ($res->num_rows == 0) {
	$permintaan = null;
} else {
	$permintaan = $res;
}

if (isset($_POST['search'])) {
	$Permintaan->nama_sales = $_POST['nama_salesman'];
	$Permintaan->nama_pembuat = $_POST['nama_pembuat'];
	$Permintaan->no_bppm = $_POST['no_bppm'];
	$Permintaan->tgl_pembuatan = $_POST['tanggal'];
	@$permintaan = $Permintaan->search();
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
					<h3 class="box-title">Pengambilan</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" action="?content=pengambilan" method="post">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nama_salesman">Nama Salesman</label>
									<input type="text" class="form-control" name="nama_salesman" id="nama_salesman" placeholder="Masukan Nama Salesman">
								</div>
								<div class="form-group">
									<label for="nama_pembuat">Nama Pembuat</label>
									<input type="text" class="form-control" name="nama_pembuat" id="nama_pembuat" placeholder="Masukan Nama Pembuat">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="no_bppm">No. BPPM</label>
									<input type="text" class="form-control" name="no_bppm" id="no_bppm" placeholder="Masukan No. BPPM">
								</div>
								<div class="form-group">
									<label for="tanggal">Tanggal</label>
									<input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Masukan Nama Pembuat">
								</div>
							</div>
						</div>
						<div class="form-group">
							<button id="btnSearch" name="search" class="btn btn-md btn-info" type="submit">
								<i class="fa fa-search"></i> Search
							</button>
				</form>
				<button type="button" id="btn-trans" class="btn btn-md btn-success">
					<i class="fa fa-dollar"></i> Transaction
				</button>
				<button type="button" id="btn-print" class="btn btn-md btn-primary">
					<i class="fa fa-print"></i> Print
				</button>
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
					<h3 class="box-title">Data Permintaan</h3>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead class="bg-primary">
							<tr>
								<th style="width: 10px">#</th>
								<th>Select All</th>
								<th>No. BPPM</th>
								<th>Nama Salesman</th>
								<th>Tanggal Pembuatan</th>
								<th>Nama pembuat</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
							<tr>
								<th></th>
								<th><span style="margin-left: 46px"><input id="selectall" type="checkbox" name="selectall"></span></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</thead>

						<tbody>
							<?php if ($permintaan != null) : ?>
								<?php $i = 0;
									foreach ($permintaan as $p) : ?>
									<tr>
										<td><?= ++$i ?></td>
										<td align="center">
											<input id="print" data-status="<?= $p['status'] ?>" type="checkbox" name="print[]" value="<?= $p['id_permintaan'] ?>">
										</td>
										<td><?= $p['no_bppm'] ?></td>
										<td><?= $p['nama'] ?></td>
										<td><?= $p['tgl_pembuatan'] ?></td>
										<td><?= $p['nama_pembuat'] ?></td>
										<td><?= $p['status'] ?></td>
										<td align="center">
											<button data-target='#modal-default' data-toggle="modal" onclick="lihat(<?= $p['id_permintaan'] ?>)" class="btn btn-sm btn-info"><i class="fa fa-search" id="detail"></i> Lihat Detail</button>
										</td>
									</tr>
								<?php endforeach; ?>
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
					<h5 class="modal-title">Detail permintaan</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col">
							<h4 class="text-center">Barang yang diminta</h4>
						</div>
					</div>
					<div class="row" style="padding: 10px">
						<div id="barang">
							<!-- /.modal-content -->
						</div>
					</div>
				</div>
			</div>
			<!-- /.modal-dialog -->
		</div>
	</div>
</section>
<script>
	$('#selectall').click(function() {
		$("input[type='checkbox']").prop('checked', $(this).prop('checked'))
	})

	$('#btn-print').click(function(e) {
		e.preventDefault();
		let status = $("input[name='print[]']").filter(':checked').data('status');
		if (status == 'Diambil') {
			let v = []
			$("input[name='print[]']:checked").each(function(i) {
				v[i] = $(this).val()
			})
			$.ajax({
				url: './applications/admin/menu_pengambilan/modul/print.php',
				method: 'post',
				data: {
					id: v
				},
				success: (res) => {
					if (res == 1) {
						window.location.href = 'permintaan/print2.php'
					} else {
						alert(res);
					}
				}
			})
		} else {
			alert('Silahkan melakukan transaksi terlebih dahulu');
		}
	})

	$('#btn-trans').click(function(e) {
		e.preventDefault();
		let checked = $("input[name='print[]']").filter(':checked').length;
		if (checked > 1 || checked == 0) {
			alert('pilih salah satu');
		} else {
			let id = $("input[name='print[]']:checked").val()
			$.ajax({
				url: './applications/admin/menu_pengambilan/modul/insert.php',
				method: 'post',
				data: {
					id_permintaan: id
				},
				dataType: 'json',
				success: (res) => {
					if (res == true) {
						alert('tersimpan')
						location.reload();
					} else {
						alert('error');
						location.reload();
					}
				}
			})
		}
	})

	function lihat(id) {
		$.ajax({
			url: './applications/admin/menu_permintaan/modul/lihatdetail.php',
			method: 'post',
			data: {
				id: id
			},
			success: (res) => {
				if (res != 'false') {
					let data = JSON.parse(res);
					$('#barang').html("");
					data.forEach(function(value, i) {
						$('#barang').append(`
							<div class="col-md-3">
								<div class="box box-primary">
									<div class="box-header">
										<h3 class="box-title">${value.nama}</h3>
									</div>
									<div class="box-body">
										<ul class="list-unstyled">
											<li>Jumlah barang baru : ${value.brg_baru}
											</li>
											<li>Jumlah barang bekas : ${value.brg_bekas}
											</li>
										</ul>
									</div>
								</div>
							</div>
							`);
					})
				}
			}
		})
	}
</script>