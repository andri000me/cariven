<!-- Header -->
<?php $this->load->view('_partials/header'); ?>
<!-- End Header -->

<!-- Navbar -->
<?php $this->load->view('_partials/navbar'); ?>
<!-- End Navbar -->
<div class="popular_courses section_gap_top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main_title">
                    <h3 style="text-align: left; margin-bottom: 10px">Profil saya</h3>
                    <form action="<?= site_url('aksi-ubah-password') ?>" method="post">
                        <div class="row" style="margin-bottom:80px">
                            <div class="col-lg-4">
                                <div class="card" style="width: 18rem;">
                                    <img src="<?= base_url('assets/images/images-user/'.$user_image) ?>" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <small><a href="<?= site_url('ubah-profil') ?>" style="text-decoration:none; color: inherit;"><i class="fa fa-edit"></i>ubah profile</a></small> <br> <br>
                                        <p class="font-weight-bold" style="margin-bottom:0px">My Bio</p>
                                        <p class="card-text"><?= $user_bio ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link" style="color: inherit" href="<?= site_url('ubah-profil') ?>"> 
                                            <i class="fa fa-user-o"></i> Update Profil</a>
                                        <a class="nav-item nav-link active" style="color: inherit" href="#nav-password" id="nav-home-tab" 
                                            data-toggle="tab" role="tab" aria-controls="nav-home" aria-selected="true" style="color: inherit">
                                            <i class="fa fa-gear"></i> Ubah Password</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-password" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <table class="table table-striped">
                                            <tr>
                                                <td style="width:200px">Password Lama</td>
                                                <td style="width:30px">:</td>
                                                <td><input type="password" class="form-control" name="old_password" id="old_password" placeholder="Masukan password lama" value="<?= $old_password; ?>" required>
                                                    <?php if ($this->session->flashdata('old_password') <> '') { ?>
                                                        <small class="text-danger mx-1"><?= $this->session->flashdata('old_password') ?></small>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:200px">Password Baru</td>
                                                <td style="width:30px">:</td>
                                                <td><input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="Masukan password baru" value="<?= $password_baru; ?>" required/>
                                                <small><?= form_error('password_baru') ?></small></td>
                                            </tr>
                                            <tr>
                                                <td>Konfirmasi Password</td>
                                                <td>:</td>
                                                <td><input type="password" class="form-control" name="passconf" id="passconf" placeholder="Konfirmasi password" value="<?= $passconf; ?>" required/>
                                                <small><?= form_error('passconf') ?></small></td>
                                            </tr>                                     
                                            <tr>
                                                <td colspan="3">
                                                    <input type="checkbox" onclick="visiblePassword()"> Tampilkan Password <br>
                                                    <input type="hidden" name="user_id" value="<?= $user_id; ?>" />
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Simpan</button>
                                                    <a href="<?= site_url('profil-saya') ?>" class="btn btn-light">Kembali</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>     
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
	<?php $this->load->view('_partials/footer'); ?>
<!-- End Footer -->

<!-- JS -->
    <?php $this->load->view('_partials/js'); ?>
<!-- End JS -->

<script>
function visiblePassword()    {
    var x = document.getElementById("old_password");
    var y = document.getElementById("password_baru");
    var z = document.getElementById("passconf");
    if (x.type === "password" || y.type === "password" || z.type === "password") {
        x.type = "text";
        y.type = "text";
        z.type = "text";
    } else {
        x.type = "password";
        y.type = "password";
        z.type = "password";
    }
}
</script>

<!-- JS -->
    <?php $this->load->view('_partials/endfile'); ?>
<!-- End JS -->