<?php
  if ($this->session->userdata('email')) {
    $user = $this->db->get_where('users', array('id' => $_SESSION['_id']))->row();
    $userExplode = explode(" ",$user->name);
    $nama        = $userExplode[0];
    $tiketAktif  = count($this->db->query("SELECT b.id FROM bookings b 
                                      JOIN events e ON b.event = e.id 
                                      WHERE b.user = '".$_SESSION['_id']."' 
                                      AND e.start_time >= CURDATE()
                                      AND b.status IN ('approved','booking','paid');")
                                      ->result());
  }
?>
<!--================ Start Header Menu Area =================-->
<header class="header_area">
	<div class="main_menu">
		<nav class="navbar navbar-expand-lg navbar-light">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<a href="<?= base_url() ?>">
					<img src="<?= base_url('assets/images/images-site/logo.png') ?>" height="100" width="150px" class="img-fluid">
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="icon-bar"></span> <span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
					<ul class="nav navbar-nav menu_nav ml-auto">
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url() ?>">Beranda</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('artikel') ?>">Artikel</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('tentang-kami') ?>">Tentang Kami</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('hubungi-kami') ?>">Hubungi Kami</a>
						</li>
						<?php if ($this->session->userdata('email') == NULL): ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= site_url('login') ?>">Login</a>
              </li>
						<?php else:?>
              <li class="nav-item">
                <a class="nav-link" href="<?= site_url('manage') ?>"><i class="fa fa-plus"></i> Buat Event</a>
              </li>
              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Halo, <?= $nama ?></a>
                <ul class="dropdown-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('profil-saya') ?>"><i class="fa fa-user-o"></i> Profil Saya</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('tiket-saya') ?>"><i class="fa fa-ticket"></i> Tiket Saya
                      (<?= $tiketAktif ?>)</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('logout') ?>">Logout</a>
                  </li>
                </ul>
              </li>
						<?php endif ?>

					</ul>
				</div>
			</div>
		</nav>
	</div>
</header>
<!--================ End Header Menu Area =================-->