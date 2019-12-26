<?php
include dirname(__FILE__, 3) . '/menu_permintaan/Permintaan_CRUD.php';
$Permintaan = new Permintaan_CRUD();

if (isset($_POST['no_bppm'])) {
    $Permintaan->no_bppm = $_POST['no_bppm'];
    $res = $Permintaan->getBarangYgDimintaByNoBppm();
    if ($res->num_rows > 0) {
        $data = array();
        while($temp = $res->fetch_assoc()){
            $data[] = $temp;
        }
        die(json_encode($data));
    } else {
        die(json_encode(false));
    }
}
