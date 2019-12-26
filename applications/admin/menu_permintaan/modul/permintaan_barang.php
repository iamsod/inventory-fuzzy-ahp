<?php
session_start();
include dirname(__FILE__, 3) . '/menu_permintaan/Permintaan_CRUD.php';
$Permintaan = new Permintaan_CRUD();
$res = $Permintaan->getAllPermintaanBarang($_SESSION['permintaan_id']);
if ($res == []) {
    die('false');
} else {
    if (is_array($res)) {
        die(json_encode($res));
    }
}
