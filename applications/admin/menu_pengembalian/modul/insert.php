<?php
include dirname(__FILE__, 3) . '/menu_pengembalian/Pengembalian_CRUD.php';
$Pengembalian = new Pengembalian_CRUD();

if (isset($_POST['id_permintaan'])) {
    $barang = explode('|', $_POST['barang']);
    $Pengembalian->no_bppm = $_POST['no_bppm'];
    $Pengembalian->konsumsi = $_POST['konsumsi'];
    $Pengembalian->brg_rusak = $_POST['brg_rusak'];
    $Pengembalian->jml_jual = $_POST['jml_jual'];
    $Pengembalian->kode_barang = $barang[0];
    $Pengembalian->id_barang = $barang[1];
    $Pengembalian->tgl_pengembalian = date('Y-m-d');
    $sebelum = $Pengembalian->getJumlahBarangSebelumByNoBppm();
    $sebelum = $sebelum->fetch_assoc();
    $Pengembalian->brg_sbelum_baru = $sebelum['brg_baru'];
    $Pengembalian->brg_sbelum_bekas = $sebelum['brg_bekas'];
    $Pengembalian->brg_baru_kembali = $_POST['brg_baru_kembali'];
    $Pengembalian->brg_bekas_kembali = $_POST['brg_bekas_kembali'];
    $res = $Pengembalian->insertPengembalian();
    die($res);
}
