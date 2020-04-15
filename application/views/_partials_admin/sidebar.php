<?php 
$akun_user = $this->db->get_where('users', array('id' => $_SESSION['_id']))->row();
$jumlah_inbox = count($this->db->get_where('inboxes',['is_read' => 0])->result_array());
$jumlah_event = count($this->db->get_where('events',['status' => 'submitted'])->result_array());

$jumlah_user = $this->db->select('*')->from('users')->where_not_in('role',['adm','man'])->count_all_results();
$jumlah_publisher = count($this->db->get('publishers')->result_array());
$jumlah_admin = count($this->db->get_where('users',['role' => 'adm'])->result_array());

$jumlah_pembayaran = count($this->db->query("SELECT * FROM payments p JOIN bookings b ON p.booking_id =b.id WHERE b.status='paid'")->result_array());
$jumlah_pencairan = count($this->db->get_where('withdraws',['status' => 'submitted'])->result_array());

?>
<!-- SIDEBAR -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php if($akun_user->profile_picture == 'default.jpg'): ?>
          <img src="<?= base_url('assets/images/images-admin/'.$akun_user->profile_picture) ?>" class="img-circle" alt="User Image">
          <?php else: ?>
          <img src="https://ui-avatars.com/api/?name=<?= $akun_user->name ?>" class="img-circle" alt="User Image">
          <?php endif ?>
        </div>
        <div class="pull-left info">
          <p><?= $akun_user->name ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN MENU</li>
        <li class="<?php if($title == 'Dashboard') echo "active" ?>">
          <a href="<?= site_url('admin/dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="<?php if($title == 'Kotak Masuk') echo "active" ?>">
          <a href="<?= site_url('admin/pesan-masuk') ?>">
            <i class="fa fa-envelope-o"></i> <span>Kotak Masuk</span>
            <?php if ($jumlah_inbox > 0) { ?>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow"><?= $jumlah_inbox ?></small>
            </span>
            <?php } else { } ?>
          </a>
        </li>
        <li class="<?php if($title == 'Event') echo "active" ?>">
          <a href="<?= site_url('admin/event') ?>">
            <i class="fa fa-calendar-o"></i> <span>Event</span>
            <?php if ($jumlah_event > 0) { ?>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"><?= $jumlah_event .' new' ?></small>
            </span>
            <?php } else { } ?>
          </a>
        </li>
        <li class="<?php if($title == 'Pembayaran') echo "active" ?>">
          <a href="<?= site_url('admin/pembayaran') ?>">
            <i class="fa fa-money"></i> <span>Pembayaran</span>
            <?php if ($jumlah_pembayaran > 0) { ?>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"><?= $jumlah_pembayaran .' new' ?></small>
            </span>
            <?php } ?>
          </a>
        </li>
        <li class="<?php if($title == 'Pencairan') echo "active" ?>">
          <a href="<?= site_url('admin/pencairan-dana') ?>">
            <i class="fa fa-dollar"></i> <span>Pencairan Dana</span>
            <?php if ($jumlah_pencairan > 0) { ?>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"><?= $jumlah_pencairan ?></small>
            </span>
            <?php } ?>
          </a>
        </li>
        <?php $dataMaster = (($title == 'Bank') || ($title == 'Kota') || ($title == 'Kategori Event') || ($title == 'Kategori Artikel')) ? "active treeview" : "treeview"; ?>
        <li class="<?= $dataMaster ?>">
          <a href="#">
            <i class="fa fa-folder-open-o"></i>
            <span>Data Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($title == 'Bank') echo "active" ?>"><a href="<?= site_url('admin/bank') ?>"><i class="fa fa-circle-o"></i> Data Bank</a></li>
            <li class="<?php if($title == 'Kota') echo "active" ?>"><a href="<?= site_url('admin/kota') ?>"><i class="fa fa-circle-o"></i> Data Kota</a></li>
            <li class="<?php if($title == 'Kategori Event') echo "active" ?>"><a href="<?= site_url('admin/kategori-event') ?>"><i class="fa fa-circle-o"></i> Kategori Event</a></li>
            <li class="<?php if($title == 'Kategori Artikel') echo "active" ?>"><a href="<?= site_url('admin/kategori-artikel') ?>"><i class="fa fa-circle-o"></i> Kategori Artikel</a></li>
          </ul>
        </li>
        <?php if ($_SESSION['role'] == 'adm') { ?>
          <?php $dataArtikel = (($title == 'Berita') || ($title == 'Tambah Berita')) ? "active treeview" : "treeview"; ?>
          <li class="<?= $dataArtikel ?>">
            <a href="#">
              <i class="fa fa-newspaper-o"></i>
              <span>Artikel</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?php if($title == "Tambah Berita") echo "active" ?>"><a href="<?= site_url('admin/artikel/tambah') ?>"><i class="fa fa-circle-o"></i> Tambah Artikel</a></li>
              <li class="<?php if($title == "Berita") echo "active" ?>"><a href="<?= site_url('admin/artikel') ?>"><i class="fa fa-circle-o"></i> Lihat Semua Artikel</a>
              </li>
            </ul>
          </li>
        <?php } else { ?>
          <li class="<?php if($title == 'Berita') echo "active" ?>">
            <a href="<?= site_url('admin/artikel') ?>">
              <i class="fa fa-newspaper-o"></i> <span>Berita</span>
            </a>
          </li>
        <?php } ?>
        <?php $dataPengguna = ($title == 'Users') ? "active treeview" : "treeview"; ?>
        <li class="<?= $dataPengguna ?>">
          <a href="#">
            <i class="fa fa-group"></i>
            <span>Manajemen Pengguna</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($title == 'Users') echo "active" ?>"><a href="<?= site_url('admin/peserta') ?>"><i class="fa fa-circle-o"></i> User
              <span class="pull-right-container">
                <small class="label pull-right bg-green"><?= $jumlah_user ?></small>
              </span>
            </a></li>
          </ul>
        </li>
        <?php if ($this->session->userdata('role') == 'man') { ?>
        <li class="header">MANAJER</li>
        <li class="<?php if($title == 'Admin') echo "active" ?>">
          <a href="<?= site_url('admin/admin') ?>">
            <i class="fa fa-user-o"></i> <span>Manajemen Admin</span>
            <?php if ($jumlah_admin > 0) { ?>
            <span class="pull-right-container">
              <small class="label pull-right bg-red"><?= $jumlah_admin ?></small>
            </span>
            <?php } else { } ?>
          </a>
        </li>
        <li class="<?php if($title == 'Report') echo "active" ?>">
          <a href="<?= site_url('admin/statistik') ?>">
            <i class="fa fa-book"></i> <span>Laporan dan Statistik</span>
          </a>
        </li>
        <?php } else { } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>