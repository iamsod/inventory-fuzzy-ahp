<?php
session_start();
require_once dirname(__FILE__, 3) . '/menu_pengembalian/Pengembalian_CRUD.php';
$Pengembalian = new Pengembalian_CRUD();

$Pengembalian->no_bppm = $_POST['no_bppm'];
$res = $Pengembalian->checkPengembalianByNoBppm();
if ($_POST != null) {
    if ($res->num_rows == 0) {
        die('Tidak ada data pengembalian di no bppm ini');
    } else {
        $_SESSION['print_pengembalian'] = $_POST['no_bppm'];
        die(true);
    }
}
die('Pilih salah satu');
