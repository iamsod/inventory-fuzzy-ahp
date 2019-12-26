<?php
session_start();
include dirname(__FILE__, 3) . '/menu_permintaan/Permintaan_CRUD.php';
$Permintaan = new Permintaan_CRUD();

// if (isset($_POST['id_barang'])) {
    $Permintaan->id_permintaan = $_SESSION['permintaan_id'];
    $Permintaan->insertAfterPermintaan();
    unset($_SESSION['permintaan_id']);
    // return $_SESSION['permintaan_id'];
// }
