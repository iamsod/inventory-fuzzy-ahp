<?php
session_start();
include dirname(__FILE__, 3) . '/menu_permintaan/Permintaan_CRUD.php';
$Permintaan = new Permintaan_CRUD();

if (isset($_POST['nama_salesman'])) {
    $Permintaan->id_salesman = $_POST['nama_salesman'];
    $Permintaan->tgl_penggunaan = $_POST['tanggal_penggunaan'];
    $Permintaan->nama_pembuat = $_POST['nama_pembuat'];
    $Permintaan->no_bppm = $Permintaan->getNoBppm();
    $res = $Permintaan->insertPermintaan();
    echo $res;
    if ($res != false) {
        $_SESSION['permintaan_id'] = $res;
        die($res);
    } else {
        die($res);
    }
}
