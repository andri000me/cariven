<!-- Header -->
<?php $this->load->view('_partials/header'); ?>
<!-- End Header -->

<!-- Navbar -->
<?php $this->load->view('_partials/navbar'); ?>
<!-- End Navbar -->
<div class="popular_courses section_gap_top">
	<div class="container">
		<div class="row">
			<div class="col-4">
				<h2>Sign In</h2>
				<small>Masuk untuk memesan event</small>
				<?= $this->session->flashdata('login_notify') ?>
				<form action="" method="post">
					<label for="email" style="margin-top: 20px;">Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><img src="<?= base_url('assets/icons/icons/at.svg') ?>" alt="" width="24" height="24"></span>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="email address" required>
                    </div>
                    
                    <label for="password" style="margin-top: 20px;">Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <img src="<?= base_url('assets/icons/icons/lock.svg') ?>" alt="" width="24" height="24"></span>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="password" required>
                    </div>

					<button class="btn primary-btn btn-block" style="margin: 20px 0 10px 0;">Login</button>
					Belum punya akun? <a href="<?= site_url('register') ?>">Saya mau daftar</a>
				</form>
			</div>
        <div class="col-8">
        <center>
            <img src="<?= base_url('assets/images/images-site/login_image.svg') ?>" width="74%">
        </center>
        </div>
		</div>
	</div>
</div>

<!-- JS -->
<?php $this->load->view('_partials/js'); ?>
<!-- End JS -->

<!-- Footer -->
<?php $this->load->view('_partials/endfile'); ?>
<!-- End Footer -->