<?php
session_start();
include dirname(__FILE__, 3) . '/menu_permintaan/Permintaan_CRUD.php';
$Permintaan = new Permintaan_CRUD();

if (isset($_POST['id_permintaan'])) {
    $Permintaan->id_barang = $_POST['id_barang'];
    $Permintaan->id_permintaan = $_POST['id_permintaan'];
    $Permintaan->brg_baru = $_POST['jml_baru'];
    $Permintaan->brg_bekas = $_POST['jml_bekas'];
    $res = $Permintaan->deletePermintaanBarang();
    var_dump($res);
}
