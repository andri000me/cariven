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
				<h2>Sign Up</h2>
				<small>Daftar untuk lebih dekat dengan kami</small>
				<form action="" method="post">
					<label for="name" style="margin-top: 20px;">Name</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><img src="<?= base_url('assets/icons/icons/person.svg') ?>" alt="" width="24" height="24"></span>
                        </div>
                        <input type="name" name="name" class="form-control" value="<?= $name ?>" placeholder="name" required> <br>
                        <small class="text-danger"><?= form_error('name') ?></small>
                    </div>
					
                    <label for="email" style="margin-top: 20px;">Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><img src="<?= base_url('assets/icons/icons/at.svg') ?>" alt="" width="24" height="24"></span>
                        </div>
                        <input type="email" name="email" class="form-control" value="<?= $email ?>" placeholder="email address" required>
                    </div>
                    <small class="text-danger"><?= form_error('email') ?></small>
                    
                    <label for="phone number" style="margin-top: 20px;">Phone Number</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <img src="<?= base_url('assets/icons/icons/phone.svg') ?>" alt="" width="24" height="24"></span>
                        </div>
                        <input type="tel" name="phone_number" class="form-control" value="<?= $phone_number ?>" placeholder="active phone number" required> <br>
                    </div>
                    <small class="text-danger"><?= form_error('phone_number') ?></small>
                    
                    <label for="password" style="margin-top: 20px;">Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <img src="<?= base_url('assets/icons/icons/lock.svg') ?>" alt="" width="24" height="24"></span>
                        </div>
                        <input type="password" name="password" id="password" class="form-control" placeholder="password" required> <br>
                        <small class="text-danger"><?= form_error('password') ?></small>
                    </div>
                    
                    <label for="password" style="margin-top: 20px;">Retype Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <img src="<?= base_url('assets/icons/icons/lock-fill.svg') ?>" alt="" width="24" height="24"></span>
                        </div>
                        <input type="password" name="passconf" id="passconf" class="form-control" placeholder="retype password" required> <br>
                        <small class="text-danger"><?= form_error('passconf') ?></small>
                    </div>

                    <input type="checkbox" class="fonr-control mt-3" onclick="visiblePassword()"> Show Password <br>

					<button class="btn primary-btn btn-block" style="margin: 20px 0 10px 0;">Register</button>
					Belum punya akun? <a href="<?= site_url('login') ?>">Saya mau login</a>
				</form>
			</div>
        <div class="col-8">
        <center>
            <img src="<?= base_url('assets/images/images-site/register_image.svg') ?>" class="mt-5" width="100%">
        </center>
        </div>
		</div>
	</div>
</div>

<!-- JS -->
<?php $this->load->view('_partials/js'); ?>
<!-- End JS -->

<script>
function visiblePassword()    {
    var x = document.getElementById("password");
    var y = document.getElementById("passconf");
    if (x.type === "password" || y.type === "password") {
        x.type = "text";
        y.type = "text";
    } else {
        x.type = "password";
        y.type = "password";
    }
}
</script>

<!-- Footer -->
<?php $this->load->view('_partials/endfile'); ?>
<!-- End Footer -->