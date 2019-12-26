<a href="#" class="dropdown-toggle" data-toggle="dropdown">
  <img src="assets/foto/avatar.png" class="user-image" alt="User Image">
  <span class="hidden-xs"><?= $_SESSION['user']['nama'] ?></span>
</a>
<ul class="dropdown-menu">
  <!-- User image -->
  <li class="user-header">
    <img src="assets/foto/avatar.png" class="img-circle" alt="User Image">

    <p>
      <?= $_SESSION['user']['nama'] ?>
    </p>
  </li>
  <!-- Menu Body -->
  <li class="user-body">
    <div class="row">
    </div>
    <!-- /.row -->
  </li>
  <!-- Menu Footer-->
  <li class="user-footer">
    <div class="pull-right">
      <button id="logout" class="btn btn-default btn-flat">Sign out</button>
    </div>
  </li>
</ul>