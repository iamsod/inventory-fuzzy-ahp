<?php
   // $color = "yellow";
   // echo "the color is {$color}";
?>
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
							<!-- <a id="tbh-permintaan" href="?content=stok_gudang&action=permintaan&extends=tambah_barang" class="btn btn-md btn-primary"> -->
							<button id="tbh-permintaan"  type="submit">
								Tambah Permintaan
							</button>
						</div>
					</div>
				</form>
<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script>
   $(function() {
		$('#tbh-permintaan').on('click', function(e) {
			let form = $('#form-permintaan').serialize();
			$.ajax({
				url: './applications/admin/menu_permintaan/modul/insert.php',
				method: 'POST',
				data : form,
				success: (res) => {
					console.log(res)
					if (res != false) {
						alert(res)
					} else {
						console.log(res)
					}
				}
			})
   		})
   })
</script>