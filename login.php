<?php
session_start();
include dirname(__FILE__, 1) . '/applications/modul/Sesi.php';
include dirname(__FILE__, 1) . '/applications/admin/menu_users/Users_CRUD.php';

if (isset($_POST['masuk'])) {
  $Users = new Users_CRUD();
  $res = $Users->getUsersByUsername($_POST['username']);
  if ($res->num_rows < 0) {
    header('Location: ?message=Username tidak ditemukan');
    die;
  }
  $res = $res->fetch_assoc(); //fetching variable to array

  $password = md5(@$_POST['password']);
  if ($res['password'] == $password) {
    $_SESSION['user'] = [
      'level' => $res['level'],
      'nama' => $res['nama'],
      'id_users' => $res['id_users']
    ];
    header('Location: index.php');
  } else {
    header('Location: ?message=Password salah');
    die;
  }
}else {
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inventory | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php include_once('views/partials/header.php'); ?>
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="index.php"><b>Inventory</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <?php $message = @$_GET['message'];
      if (isset($message)) : ?>
        <div class="alert alert-danger"><?= $message ?></div>
      <?php endif; ?>
      <form action="" method="post">
        <div class="form-group has-feedback">
          <input name="username" type="text" class="form-control" placeholder="Username">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input name="password" type="password" class="form-control" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <button name="masuk" type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <br>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
  <?php include_once('views/partials/footer.php'); ?>
  <script src="plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>
</body>

</html>