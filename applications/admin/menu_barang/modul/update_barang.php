<?php
include dirname(__FILE__, 3) . '/menu_barang/Barang_CRUD.php';
$Barang = new Barang_CRUD();

echo json_encode($Barang->checkStock());
