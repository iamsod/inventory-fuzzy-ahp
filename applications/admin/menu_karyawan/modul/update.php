<?php
include dirname(__FILE__, 3) . '/menu_karyawan/Karyawan_CRUD.php';
$Karyawan = new Karyawan_CRUD();

if (isset($_POST['id_sales'])) {
    $Karyawan->id_sales = $_POST['id_sales'];
    $Karyawan->id_spv = $_POST['spv'];
    $Karyawan->nama = $_POST['nama_salesman'];
    $Karyawan->nik = $_POST['nik'];
    $res = $Karyawan->updateSales();
    var_dump($res);
}
