<?php
include dirname(__FILE__, 3) . '/menu_karyawan/Karyawan_CRUD.php';
$Karyawan = new Karyawan_CRUD();

if ($_POST['spv'] != "") {
    $Karyawan->id_spv = $_POST['spv'];
    $Karyawan->nama = $_POST['nama_salesman'];
    $Karyawan->nik = $_POST['nik'];
    $res = $Karyawan->insertSalesman();
    die($res);
} else {
    die(false);
}
