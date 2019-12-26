<?php
if (!isset($_SESSION['permintaan_id'])) {
    echo "<script>
        window.location.href = '?content=stok_gudang'
    </script>";
}

include dirname(__FILE__, 4) . '/applications/admin/menu_barang/Barang_CRUD.php';
$Barang = new Barang_CRUD();
@$barang = $Barang->getAll();
@$brands = $Barang->getBrand();

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
        <div class="col-md-12">
            <div class="box box-info" id="box-barang">
                <div class="box-header with-border">
                    <h3 class="box-title">Barang yang diminta</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" type="button" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" type="button" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <form id="form-brg-yg-diminta">
                            <div id="brg-yg-diminta">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-success" id="submit-permintaan"><i class="fa fa-plus"></i> Buat permintaan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                <form role="form" action="?content=stok_gudang&action=permintaan&extends=tambah_barang" method="POST">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kode_item">Kode Item</label>
                                    <input type="text" class="form-control" name="kode_item" id="kode_item" placeholder="Masukan Kode Item">
                                </div>
                                <div class="form-group">
                                    <label for="nama_item">Nama Item</label>
                                    <input type="text" class="form-control" name="nama_item" id="nama_item" placeholder="Masukan Nama Item">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="brand">Brand</label>
                                    <select class="form-control" id="brand" name="brand">
                                        <?php if ($brands != false) : ?>
                                            <option value="">-- Pilih Brand --</option>
                                            <?php foreach ($brands as $brand) : ?>
                                                <option value="<?= $brand['brand'] ?>"><?= $brand['brand'] ?></option>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <option value="">-- Pilih Brand --</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button id="btnSearch" name="search" class="btn btn-md btn-info">
                                <i class="fa fa-search"></i> Search
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
                    <h3 class="box-title">Data Barang</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="bg-primary">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Image</th>
                                <th>Item Code</th>
                                <th>Brand</th>
                                <th>Nama Item</th>
                                <th colspan="2">Jumlah Stok</th>
                                <th>Status Barang</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Baru</th>
                                <th>Bekas</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 0;
                            foreach ($barang as $b) : ?>
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
                                    <td align="center">
                                        <?php if ($b['status'] == 'Tersedia') : ?>
                                            <button data-toggle="modal" data-stok_baru="<?= $b['jml_baru']; ?>" data-stok_bekas="<?= $b['jml_bekas'] ?>" data-target="#modal-default" onclick="tbh_barang(<?= $b['id_barang'] ?>)" href="#" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Tambah barang</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title mb-4">Nama item</h5>
                    <h4 class="modal-title" id="nm_item"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h4 class="text-center">Jumlah barang</h4>
                        </div>
                    </div>
                    <div class="row">
                        <form action="" class="mt-5" id="add-brg">
                            <input type="hidden" name="nama_item" id="nama">
                            <input type="hidden" name="id_barang" id="id_barang">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="baru">Baru</label>
                                    <input class="form-control" type="number" name="brg_baru" id="baru" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bekas">Bekas</label>
                                    <input class="form-control" type="number" name="brg_bekas" id="bekas" required>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


</section>
<script>
    $('#form-brg-yg-diminta').on('submit', function(e) {
        e.preventDefault()
        let data = $(this).serialize();
        $.ajax({
            url: './applications/admin/menu_permintaan/modul/permintaan.php',
            method: 'POST',
            data: data,
            success: (res) => {
                alert('Permintaan berhasil dibuat')
                window.location.href = '?content=stok_gudang'
            }
        })
    })

    $('#modal-default').on('show.bs.modal', function(e) {
        let data = e.relatedTarget;
        let stok_baru = $(data).data('stok_baru');
        let stok_bekas = $(data).data('stok_bekas');

        $("#add-brg [name='brg_baru']").attr('max', stok_baru);
        $("#add-brg [name='brg_bekas']").attr('max', stok_bekas);
    })

    function tbh_barang(id) {
        $.ajax({
            url: './applications/admin/menu_permintaan/modul/getbarang.php',
            method: 'POST',
            data: {
                id: id
            },
            success: (res) => {
                let barang = JSON.parse(res)
                console.log(barang[0].id_barang)
                $('#id_barang').val(barang[0].id_barang)
                $('#nm_item').text(barang[0].nama)
                $('#nama').val(barang[0].nama)
            }
        })
    }

    $('#add-brg').on('submit', function(e) {
        e.preventDefault()
        $.ajax({
            url: './applications/admin/menu_permintaan/modul/addbarang.php',
            method: 'POST',
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: (res) => {
                if (res == 'false') {
                    alert('Barang sudah ada');
                    window.location.reload();
                } else {
                    alert('Berhasil ditambahkan');
                    window.location.reload();
                }
            }
        })
    })

    function del(id, brg_baru, brg_bekas) {
        let id_permintaan = <?= $_SESSION['permintaan_id']; ?>;
        $.ajax({
            url: './applications/admin/menu_permintaan/modul/delete_barang.php',
            method: 'POST',
            data: {
                id_barang: id,
                id_permintaan: id_permintaan,
                jml_baru: brg_baru,
                jml_bekas: brg_bekas
            },
            success: (res) => {
                if (!res) {
                    alert('error')
                } else {
                    window.location.reload()
                }
            }
        })
    }

    $(function() {
        $.ajax({
            url: './applications/admin/menu_permintaan/modul/permintaan_barang.php',
            method: 'GET',
            success: (res) => {
                if (res != 'false') {
                    let data = JSON.parse(res);
                    $('#submit-permintaan').attr('disabled', false)
                    data.forEach(e => {
                        $('#brg-yg-diminta').append(`
                            <div class="col-md-3">
                                <div class="box">
                                    <div class="box-tools pull-right">
                                        <button onclick="(confirm('Yakin ?')) ? del(${e.id_barang},${e.brg_baru},${e.brg_bekas}) : '' " class="btn btn-box-tool" type="button"><i class="fa fa-times"></i></button>
                                    </div>
                                    <div class="box-body">
                                        <input value='${e.id_barang}' type="hidden" name='id_barang[]'>
                                        <label for="">Nama item</label>
                                        <input value='${e.nama_item}' type="text" class="form-control" disabled>
                                        <label for="">Jumlah barang baru</label>
                                        <input value='${e.brg_baru}' type="text" class="form-control" name='brg_baru[]' disabled>
                                        <label for="">Jumlah barang bekas</label>
                                        <input value='${e.brg_bekas}' type="text" class="form-control disabled" name='brg_bekas[]' disabled>
                                    </div>
                                </div>
                            </div>
                    `);
                    })
                } else {
                    $('#submit-permintaan').attr('disabled', true)
                }
            }
        })
    })
</script>