<?php
session_start();
include dirname(__FILE__, 3) . '/menu_permintaan/Permintaan_CRUD.php';
$Permintaan = new Permintaan_CRUD();

if (isset($_POST['id_barang'])) {
    $Permintaan->id_permintaan = $_SESSION['permintaan_id'];
    $Permintaan->id_barang = $_POST['id_barang'];
    $Permintaan->brg_baru = $_POST['brg_baru'];
    $Permintaan->brg_bekas = $_POST['brg_bekas'];
    $ress = $Permintaan->getAlreadyBarang();
    $Permintaan->updateStockAfterAddBarang($_POST);
    if ($ress->num_rows) {
        die('false');
    } else {
        $res = $Permintaan->addBarang($_POST['nama_item']);
        if (is_array($res)) {
            die(json_encode($res));
        } else {
            die('false');
        }
    }
}