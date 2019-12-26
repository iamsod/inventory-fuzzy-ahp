<?php
session_start();
// include dirname(__FILE__, 3) . '/menu_permintaan/Permintaan_CRUD.php';
// $Permintaan = new Permintaan_CRUD();
if ($_POST != null) {
    if (sizeof($_POST['id']) == 1) {
        $_SESSION['print_permintaan'] = $_POST['id'];
        die(true);
    }
}
die('Pilih salah satu');
