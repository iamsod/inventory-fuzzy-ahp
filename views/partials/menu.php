<section class="sidebar">
  <div class="user-panel">
    <div class="pull-left image">
      <img src="assets/foto/avatar.png" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p><?= $_SESSION['user']['nama'] ?></p>
    </div>
  </div>

  <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li class="treeview">
      <a href="?content=home"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>
    <!-- <li class="treeview">
      <a href="#"><i class="fa fa-files-o"></i> <span>Layout Options</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
      </a>
      <ul class="treeview-menu">
        <li><a href=""><i class="fa fa-circle-o"></i> Top Navigation</a></li>
        <li><a href=""><i class="fa fa-circle-o"></i> Boxed</a></li>
        <li><a href=""><i class="fa fa-circle-o"></i> Fixed</a></li>
        <li><a href=""><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
      </ul>
    </li> -->
    <li class="treeview">
      <a href="?content=stok_gudang"><i class="fa fa-database"></i> <span>Stok Gudang</span></span></a>
    </li>
    <?php if (@$_SESSION['user']['level'] == 'admin') : ?>
      <li class="treeview">
        <a href="?content=pengambilan"><i class="fa fa-shopping-cart"></i> <span>Pengambilan</span></span></a>
      </li>
    <?php endif; ?>
    <?php if (@$_SESSION['user']['level'] == 'admin') : ?>
      <li class="treeview">
        <a href="?content=pengembalian"><i class="fa fa-random"></i> <span>Pengembalian</span></span></a>
      </li>
    <?php endif; ?>
    <li class="treeview">
      <a href="?content=penilaian"><i class="fa fa-book"></i> <span>Penilaian</span></span></a>
    </li>
    <?php if (@$_SESSION['user']['level'] == 'admin') : ?>
      <li class="treeview">
        <a href="?content=karyawan"><i class="fa fa-user"></i> <span>Karyawan</span></span></a>
      </li>
    <?php endif; ?>
    <?php if (@$_SESSION['user']['level'] == 'admin') : ?>
      <li class="treeview">
        <a href="?content=m_users"><i class="fa fa-users"></i> <span>Manajemen users</span></span></a>
      </li>
    <?php endif; ?>
  </ul>
</section>