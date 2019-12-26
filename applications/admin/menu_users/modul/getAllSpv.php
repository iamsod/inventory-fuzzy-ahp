<?php
include dirname(__FILE__, 3) . '/menu_users/Users_CRUD.php';
$Users = new Users_CRUD();
$res = $Users->getAllSpv();
if ($res->num_rows>0) {
    $data = array();
    while($temp = $res->fetch_assoc()){
        $data[] = $temp;
    }
    die(json_encode($data));
}
die(json_encode(false));
