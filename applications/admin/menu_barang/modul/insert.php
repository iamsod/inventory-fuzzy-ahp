<?php
include dirname(__FILE__, 3) . '/menu_barang/Barang_CRUD.php';
$Barang = new Barang_CRUD();
$foto = $Barang->uploadFoto();

if (isset($_POST['kode_item'])) {
    if (isset($foto['error'])) {
        die($foto['error']);
    } else {
        $Barang->gambar = $foto;
    }
    $Barang->nama = $_POST['nama_item'];
    $Barang->kode = $_POST['kode_item'];
    $Barang->jml_baru = $_POST['jml_baru'];
    $Barang->jml_bekas = $_POST['jml_bekas'];
    $Barang->status = 'Tersedia';
    $Barang->brand = $_POST['brand'];
    $res = $Barang->insertBarang();
    die($res);
}
