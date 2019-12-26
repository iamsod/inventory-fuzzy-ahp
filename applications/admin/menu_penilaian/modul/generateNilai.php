<?php

include dirname(__FILE__, 3) . '/menu_penilaian/Penilaian_CRUD.php';
$Penilaian = new Penilaian_CRUD();
$permintaan = $Penilaian->checkAlternative();
if ($permintaan->num_rows==0) {
    die(json_encode('Data permintaan tidak lengkap'));
}
$bln = date('m');
$thn = date('Y');
$total_hari = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);
@$jml_hadir = $Penilaian->getJumlahHadir($bln, $thn, (string) $total_hari);
// foreach ($jml_hadir as $key => $value) {
//     $sales[$key]['nilai_hadir'] = round(50 / $total_hari * sizeof($jml_hadir[$key]), 2);
//     echo $sales[$key]['nilai_hadir']. " ";
//     echo sizeof($jml_hadir[$key])." ";
// }
foreach ($jml_hadir as $key => $value) {
    $sales[$key]['nilai_hadir'] = round(50 / $total_hari * sizeof($jml_hadir[$key]), 2);
    if (sizeof($jml_hadir[$key]) == 0) {
        $sales[$key]['nilai_materi'] = 0;
    } else {
        $sales[$key]['nilai_materi'] = $Penilaian->getPemasanganMateri($jml_hadir[$key]);
    }
    if ($sales[$key]['nilai_hadir'] == 0  && $sales[$key]['nilai_materi'] == 0) {
        $sales[$key]['keterangan'] = 'buruk';
    } elseif ($sales[$key]['nilai_hadir'] <= 50  && $sales[$key]['nilai_materi'] <= 30) {
        $sales[$key]['keterangan'] = 'buruk';
    } elseif ($sales[$key]['nilai_hadir'] <= 50  && $sales[$key]['nilai_materi'] <= 50) {
        $sales[$key]['keterangan'] = 'kurang';
    } elseif ($sales[$key]['nilai_hadir'] <= 50  && $sales[$key]['nilai_materi'] <= 70) {
        $sales[$key]['keterangan'] = 'baik';
    } elseif ($sales[$key]['nilai_hadir'] <= 50  && $sales[$key]['nilai_materi'] <= 100) {
        $sales[$key]['keterangan'] = 'kurang';
    } elseif ($sales[$key]['nilai_hadir'] <= 100  && $sales[$key]['nilai_materi'] <= 30) {
        $sales[$key]['keterangan'] = 'buruk';
    } elseif ($sales[$key]['nilai_hadir'] <= 100  && $sales[$key]['nilai_materi'] <= 50) {
        $sales[$key]['keterangan'] = 'baik';
    } elseif ($sales[$key]['nilai_hadir'] <= 100  && $sales[$key]['nilai_materi'] <= 70) {
        $sales[$key]['keterangan'] = 'luar biasa';
    } elseif ($sales[$key]['nilai_hadir'] <= 100  && $sales[$key]['nilai_materi'] <= 100) {
        $sales[$key]['keterangan'] = 'excellent';
    }
}

$res = $Penilaian->insertPenilaian($sales);

die($res);

// die(json_encode(true));
