<?php
include dirname(__FILE__, 4) . '/applications/admin/menu_karyawan/Karyawan_CRUD.php';
$Sales = new Karyawan_CRUD();
if (!isset($_GET['id'])) {
    die("Error");
}
$sales = $Sales->getSalesById($_GET['id'])->fetch_assoc();
@$spv = $Sales->getAllSpv();
?>
<section class="content-header">
    <h1>
        Edit Sales
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit sales</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Sales</h3>
                </div>
                <form role="form" action="" method="post" id="edt">
                    <input type="hidden" name="id_sales" value="<?= $sales['id_sales'] ?>">
                    <div class="box-body">
                        <?php if (@$_SESSION['alert']) : ?>

                        <?php endif;
                    unset($_SESSION['alert']) ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="spv">Nama spv</label>
                                    <select name="spv" id="spv" class="form-control">
                                        <?php foreach ($spv as $s) : ?>
                                            <option value="<?= $s['id_users'] ?>" <?= ($sales['id_spv'] == $s['id_users']) ? 'selected' : ''  ?>><?= $s['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama_salesman">Nama salesman</label>
                                    <input value="<?= $sales['nama'] ?>" type="text" class="form-control" name="nama_salesman" id="nama_salesman" placeholder="Masukan Nama">
                                </div>
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input value="<?= $sales['nik'] ?>" type="number" class="form-control" name="nik" id="nik" placeholder="Masukan Nik">
                                </div>
                                <div class="form-group">
                                    <button type="button" onclick="window.history.go(-1)" class="btn btn-md btn-danger">
                                        <i class="fa fa-arrow-circle-left"></i> Kembali
                                    </button>
                                    <button id="edit" type="submit" class="btn btn-md btn-primary" name="edit">
                                        <i class="fa fa-plus"></i> Edit Sales
                                    </button>

                                </div>
                            </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    $('#edt').on('submit', function(evt) {
        evt.preventDefault();
        $.ajax({
            url: './applications/admin/menu_karyawan/modul/update.php',
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: (response) => {
                if (response) {
                    alert("Berhasil ter edit");
                    window.location.reload();
                } else {
                    alert("Error");
                }
            }
        })
    })
</script>