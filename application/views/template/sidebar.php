<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li>
        <a href="<?= base_url('index.php') ?>">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-folder"></i> <span>Data Master</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?= base_url('Barang') ?>"><i class="fa fa-circle-o"></i> Data Barang</a></li>
          <li><a href="<?= base_url('Jenis') ?>"><i class="fa fa-circle-o"></i> Data Jenis</a></li>
          <li><a href="<?= base_url('Satuan') ?>"><i class="fa fa-circle-o"></i> Data Satuan</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-file"></i> <span>Laporan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?= base_url('Stok_barang') ?>"><i class="fa fa-circle-o"></i> Stok Barang</a></li>
          <li><a href="<?= base_url('Surat_keluar') ?>"><i class="fa fa-circle-o"></i> Surat Keluar</a></li>
          <li><a href="<?= base_url('Surat_masuk') ?>"><i class="fa fa-circle-o"></i> Surat Masuk</a></li>
        </ul>
      </li>
      <li>
        <a href="<?= base_url('user') ?>">
          <i class="fa fa-user-circle"></i> <span>Manajemen User</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
