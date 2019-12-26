<?php
include dirname(__FILE__, 3) . '/menu_permintaan/Permintaan_CRUD.php';
$Permintaan = new Permintaan_CRUD();

if (isset($_POST['no_bppm'])) {
    $Permintaan->no_bppm = $_POST['no_bppm'];
    @$permintaan = $Permintaan->searchNoBppm(); 
    foreach ( $permintaan as $no) {
        $res[] = ['label' => $no['no_bppm']];
    }
    die(json_encode($res));
}
