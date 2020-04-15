<?php
$jumlah_inbox = count($this->db->get_where('inboxes',['is_read' => 0])->result_array());
$dataInbox = $this->db->get_where('inboxes',['is_read' => 0],5)->result();

$jumlah_event = count($this->db->get_where('events',['status' => 'submitted'])->result_array());
$dataEvent = $this->db->query("SELECT e.*,p.id as pub_id, p.name, p.image  FROM events e JOIN publishers p ON e.publisher = p.id WHERE e.status = 'submitted' LIMIT 5")->result();

$jumlah_publisher = count($this->db->get_where('publishers',['status' => 'submitted'])->result_array());
$dataPublisher = $this->db->get_where('publishers',['status' => 'submitted'],5)->result();

$akun_user = $this->db->get_where('users', array('id' => $_SESSION['_id']))->row();

function limit_words($string, $word_limit){
  $words = explode(" ",$string);
  return implode(" ",array_splice($words,0,$word_limit));
}
?>
  </head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

<header class="main-header">
    <!-- Logo -->
    <a href="<?= site_url('dashboard') ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>AD</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CARIVEN ADMIN</b></span>
    </a>

    <!-- NAVBAR -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-users"></i>
                <?php if ($jumlah_publisher > 0) { ?>
                <span class="label label-warning"><?= $jumlah_publisher ?></span>
                <?php } ?>
              </a>
              <ul class="dropdown-menu">
                <li class="header">Anda memiliki <?= $jumlah_publisher ?> pengajuan baru</li>
                <li>
                  <ul class="menu">
                  <?php foreach ($dataPublisher as $row) { ?>
                    <li>
                      <a href="<?= site_url('admin/peserta/'.$row->id) ?>">
                        <div class="pull-left">
                          <img src="<?= base_url('assets/images/images-publisher/'.$row->image) ?>" class="img-circle">
                        </div>
                        <h4> <?= $row->name ?> </h4>
                        <small class="text-muted"><i class="fa fa-clock-o"></i> <?= $row->created_at ?></small>
                      </a>
                    </li>
                    <?php } ?>
                  </ul>
                </li>
                <li class="footer"><a href="<?= site_url('admin/publisher') ?>">Lihat Pengajuan (<?= $jumlah_publisher ?>)</a></li>
              </ul>
            </li>

            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-envelope-o"></i>
                <?php if ($jumlah_inbox > 0) { ?>
                <span class="label label-warning"><?= $jumlah_inbox ?></span>
                <?php } ?>
              </a>
              <ul class="dropdown-menu">
                <li class="header">Anda memiliki <?= $jumlah_inbox ?> pesan baru</li>
                <li>
                  <ul class="menu">
                  <?php foreach ($dataInbox as $row) { ?>
                    <li>
                      <a href="<?= site_url('admin/pesan-masuk/'.$row->id) ?>">
                        <div class="pull-left">
                          <img src="<?= base_url() ?>assets/AdminLTE/dist/img/message.png" class="img">
                        </div>
                        <h4>
                          <?php 
                          $nameEx  = explode(" ",$row->name);
                          $inboxNm = $nameEx[0];
                          ?>
                          <?= $inboxNm ?>
                          <small><i class="fa fa-clock-o"></i> <?= $row->created_at ?></small>
                        </h4>
                        <p><?= limit_words($row->content,5).'...' ?></p>
                      </a>
                    </li>
                    <?php } ?>
                  </ul>
                </li>
                <li class="footer"><a href="<?= site_url('admin/pesan-masuk') ?>">Lihat Semua Pesan (<?= $jumlah_inbox ?>)</a></li>
              </ul>
            </li>

            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-calendar-o"></i>
                <?php if ($jumlah_event > 0) { ?>
                <span class="label label-success"><?= $jumlah_event ?></span>
                <?php } else {} ?>
              </a>
              <ul class="dropdown-menu">
                <li class="header">Anda memiliki <?= $jumlah_event ?> event baru</li>
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                  <?php foreach ($dataEvent as $row) { ?>
                    
                    <li><!-- start message -->
                      <a href="<?= site_url('admin/event/'.$row->id) ?>">
                        <div class="pull-left">
                          <?php if ($row->image == null) { ?>
                            <img src="<?= base_url() ?>assets/AdminLTE/dist/img/publisher-default.jpg" class="img-circle">
                          <?php } else { ?>
                            <img src="<?= base_url('assets/images/images-publisher/'.$row->image) ?>" class="img-circle" alt="User Image">
                          <?php } ?>
                        </div>
                        <h4>
                          <?php 
                          $pubEx  = explode(" ",$row->name);
                          $pubNm  = $pubEx[0];
                          ?>
                          <?= $row->name ?>
                          <small><i class="fa fa-clock-o"></i> <?= date('H:i, d M',strtotime($row->created_at)) ?></small>
                        </h4>
                        <p><?= limit_words($row->title,5) ?></p>
                      </a>
                    </li>
                    <!-- end message -->
                  <?php } ?>
                  </ul>
                </li>
                <li class="footer"><a href="<?= site_url('admin/event') ?>">Lihat Semua Event (<?= $jumlah_event ?>)</a></li>
              </ul>
            </li>

            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php if($akun_user->profile_picture == 'default.jpg'): ?>
                <img src="<?= base_url('assets/images/images-admin/'.$akun_user->profile_picture) ?>" class="img-circle" alt="User Image">
                <?php else: ?>
                <img src="https://ui-avatars.com/api/?name=<?= $akun_user->name ?>" class="img-circle" width="20">
                <?php endif ?>
                <span class="hidden-xs"><?= $akun_user->name ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <?php if($akun_user->profile_picture == 'default.jpg'): ?>
                  <img src="<?= base_url('assets/images/images-admin/'.$akun_user->profile_picture) ?>" class="img-circle" alt="User Image">
                  <?php else: ?>
                  <img src="https://ui-avatars.com/api/?name=<?= $akun_user->name ?>" class="img-circle" alt="User Image">
                  <?php endif ?>

                  <p>
                    <?= $akun_user->name ?>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="<?= site_url('logout') ?>" class="btn btn-default btn-flat tombol-logout">Keluar</a>
                  </div>
                </li>
              </ul>
            </li>

          <li class="dropdown user user-menu">
           <a href="<?= base_url() ?>" target="_blank"> <i class="fa fa-globe"></i></a>
          </li>
        </ul>
      </div>
    </nav>
</header>