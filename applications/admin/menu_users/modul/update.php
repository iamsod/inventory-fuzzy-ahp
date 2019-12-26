<?php
include dirname(__FILE__, 3) . '/menu_users/Users_CRUD.php';
$Users = new Users_CRUD();

if (isset($_POST['id_users'])) {
    $Users->id_users = $_POST['id_users'];
    $Users->nama = $_POST['nama'];
    $Users->email = $_POST['email'];
    $Users->no_hp = $_POST['no_hp'];
    $Users->username = $_POST['username'];
    $Users->level = "SPV";
    if ($_POST['password'] == "") {
        $Users->password = $_POST['enc_password'];
    } else {
        $Users->password = md5($_POST['password']);
    };
    $res = $Users->updateUsers($Users->id_users);
    die($res);
}
