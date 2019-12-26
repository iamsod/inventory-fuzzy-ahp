<?php

class Sesi
{
    private $level;

    public function cek()
    {
        $this->level = @$_SESSION['user']['level'];
        if (!isset($this->level)) {
            header('Location: login.php');
        }
    }

    public function Logout()
    {
        session_start();
        if (isset($_SESSION['permintaan_id'])) {
            return "Selesaikan permintaan barang anda !";
        } else {
            unset($_SESSION['user']);
            return true;
        }
    }
}
