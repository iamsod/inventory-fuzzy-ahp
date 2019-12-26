<?php
include dirname(__FILE__, 3) . '/menu_pengambilan/Pengambilan_CRUD.php';
$Pengambilan = new Pengambilan_CRUD();

if (isset($_POST['id_permintaan'])) {
    $Pengambilan->id_permintaan = $_POST['id_permintaan'];
    $Pengambilan->status = 'Diambil';
    $Pengambilan->tgl_pengambilan = date('Y-m-d');
    $res = $Pengambilan->updatePengambilan();
    if ($res == true) {
        $res = $Pengambilan->updateStock($_POST['id_permintaan']);
        die(json_encode($res));
    }
    die(json_encode($res));
}
