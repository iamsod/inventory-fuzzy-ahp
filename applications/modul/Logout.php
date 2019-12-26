<?php
include 'Sesi.php';

if (isset($_POST['logout'])) {
    $Sesi = new Sesi();
    die($Sesi->Logout());
}
