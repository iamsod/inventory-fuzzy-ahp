<?php
include dirname(__FILE__, 3) . '/menu_users/Users_CRUD.php';
$Users = new Users_CRUD();

if (isset($_POST['id'])) {
    $res = $Users->deleteUsers($_POST['id']);
    die($res);
}
