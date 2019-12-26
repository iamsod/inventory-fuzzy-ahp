<?php

function formatTanggal($tgl)
{
    $tglp = str_replace('-', '', $tgl);
    $thp = substr($tglp, 0, 4);
    $blp = substr($tglp, 4, 2);
    $tgp = substr($tglp, 6, 2);

    return  $tgp . '-' . $blp . '-' . $thp;
}
