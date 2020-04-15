<!-- Header -->
<?php $this->load->view('_partials/header'); ?>
<!-- End Header -->

<?= $script_captcha; // javascript recaptcha ?>

<!-- Navbar -->
    <?php $this->load->view('_partials/navbar'); ?>
<!-- End Navbar -->

<div class="popular_courses"></div>

<div id="main">
    <div class="container">
        <div class="row justify-content-center wow fadeInUp">
            <div class="col-lg-8 col-md-8 col-xs-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <a href="<?= base_url() ?>"><img src="<?= base_url('ev-admin/assets/images/images-site/logo.png') ?>" alt="" 
                                    width="30%" class="img-fluid"></a>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <div class="roberto-contact-form">
                                    <form action="<?= site_url('auth/register_pub_action') ?>" method="post">
                                        <div class="form-row">
                                            <div class="col-6">
                                                <label for="pub_name">Nama</label>
                                                <input type="text" name="pub_name" class="form-control" placeholder="Nama" value="<?= $pub_name ?>" required>
                                            </div>
                                            <div class="col-6">
                                                <label for="pub_tel">Telepon</label>
                                                <input type="tel" name="pub_tel" class="form-control" placeholder="Telepon" value="<?= $pub_tel ?>" required>
                                                <small class="text-danger"><?= form_error('pub_tel') ?></small>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Email">Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Email" value="<?= $email ?>" required>
                                            <small class="text-danger"><?= form_error('email') ?></small>
                                        </div>
                                        <div class="form-row"> 
                                            <div class="col-6">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="<?= $password ?>" required>
                                                <small class="text-danger"><?= form_error('password') ?></small>
                                            </div>
                                            <div class="col-6">
                                                <label for="password">Konfirmasi Password</label>
                                                <input type="password" name="passconf" id="passconf" class="form-control" placeholder="Konfirmasi Password" required>
                                                <small class="text-danger"><?= form_error('passconf') ?></small>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="pub_address">Alamat Kantor</label>
                                            <textarea name="pub_address" class="form-control" cols="10" rows="3" required><?= $pub_address ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="pub_website">Website</label>
                                            <input type="text" name="pub_website" class="form-control" placeholder="Https://" value="<?= $pub_website ?>" required>
                                            <small class="text-danger"><?= form_error('pub_website') ?></small>
                                        </div>
                                        <input type="checkbox" onclick="visiblePassword()"> Tampilkan Password <br>
                                        <div class="form-group">
                                            <?= $captcha //tampilkan recaptcha ?> 
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block mt-3">Register Sebagai Publisher</button>
                                        <p>Sudah punya akun?
                                        <a href="<?= site_url('login') ?>">Saya mau login </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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