<?php
include dirname(__FILE__, 3) . '/menu_karyawan/Karyawan_CRUD.php';
$Karyawan = new Karyawan_CRUD();
$res = $Karyawan->getAllSalesman();
if ($res->num_rows>0) {
    $data = array();
    while($temp = $res->fetch_assoc()){
        $data[] = $temp;
    }
    die(json_encode($data));
}
die(json_encode(false));
