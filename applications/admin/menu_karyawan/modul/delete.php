<?php
include dirname(__FILE__, 3) . '/menu_karyawan/Karyawan_CRUD.php';
$Karyawan = new Karyawan_CRUD();

if (isset($_POST['id'])) {
    $res = $Karyawan->deleteSales($_POST['id']);
    die($res);
}
