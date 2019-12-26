<?php
include dirname(__FILE__, 3) . '/menu_users/Users_CRUD.php';
$Users = new Users_CRUD();

if (isset($_POST['username'])) {
    $Users->nama = $_POST['nama'];
    $Users->email = $_POST['email'];
    $Users->no_hp = $_POST['no_hp'];
    $Users->username = $_POST['username'];
    $Users->password = md5($_POST['password']);
    $Users->level = $_POST['level'];
    $res = $Users->insertUsers();
    die($res);
}
