<?php
include dirname(__FILE__, 3) . '/menu_barang/Barang_CRUD.php';
$Barang = new Barang_CRUD();

if (isset($_POST['id'])) {
    $res = $Barang->getBarangById($_POST['id']);
    
    $data = array();
    while($temp = $res->fetch_assoc()){
        $data[] = $temp;
    }
    die(json_encode($data));
}
