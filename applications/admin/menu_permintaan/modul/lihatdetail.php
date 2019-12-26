<?php
include dirname(__FILE__, 3) . '/menu_permintaan/Permintaan_CRUD.php';
$Permintaan = new Permintaan_CRUD();
if (isset($_POST['id'])) {
    $Permintaan->id_permintaan = $_POST['id'];
    $res = $Permintaan->getDetilPermintaan();
    if ($res != false) {
        $data = array();
        while($temp = $res->fetch_assoc()){
            $data[] = $temp;
        }
        die(json_encode($data));
    } else {
        die(json_encode(false));
    }
}
