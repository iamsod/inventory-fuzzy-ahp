<?php session_start();
require_once 'helper/util.php';
include dirname(__FILE__, 1) . '/applications/modul/Sesi.php';
$Sesi = new Sesi();
$Sesi->cek();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inventory App</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php include_once('views/partials/header.php'); ?>

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <a href="#" class="logo">

        <span class="logo-mini"><!--<img src="assets/dist/img/avatar5.png" width="30">--><b>I-</b>App</span> 
        <span class="logo-lg"><!--<img src="assets/dist/img/avatar5.png" width="40">--> <b>Inventory</b> App</span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <?php include_once('views/partials/user.php'); ?>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <aside class="main-sidebar">
      <?php include_once('views/partials/menu.php'); ?>
    </aside>

    <div class="content-wrapper">
      <?php include_once('views/partials/content.php'); ?>
    </div>
    <?php include_once('views/partials/footer_content.php'); ?>
  </div>

  <?php include_once('views/partials/footer.php'); ?>
</body>

</html>