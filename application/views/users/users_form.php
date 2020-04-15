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
                    <form action="<?= site_url('aksi-ubah-profil') ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card" style="width: 18rem;">
                                    <img src="<?= base_url('assets/images/images-user/'.$user_image) ?>" class="card-img-top" id="showingImage">
                                    <input type="file" class="form-control-files my-2 text-center" name="user_image_new" onchange="showImage(this);" accept="image/*" value="<?= $user_image_new; ?>"/>
                                    <small>*Ukuran Maksimal 500kb</small>
                                    <small class="text-danger"><?= $error ?></small> <br>
                                    <input type="hidden" name="user_image" value="<?= $user_image; ?>"/>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" style="color: inherit"
                                            href="#nav-profile" role="tab" aria-controls="nav-home" aria-selected="true"> 
                                            <i class="fa fa-user-o"></i> Update Profil</a>
                                        <a class="nav-item nav-link" style="color: inherit" href="<?= site_url('ubah-password') ?>">
                                            <i class="fa fa-gear"></i> Ubah Password</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <table class="table table-striped">
                                            <tr>
                                                <td>Nama</td>
                                                <td style="width:30px">:</td>
                                                <td><input type="text" class="form-control" name="user_name" id="user_name" placeholder="Your Name" value="<?= $user_name; ?>" required>
                                                <small><?= form_error('user_name') ?></small></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td><input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= $email; ?>" required/>
                                                <small><?= form_error('email') ?></small></td>
                                            </tr>
                                            <tr>
                                                <td>No Hp</td>
                                                <td>:</td>
                                                <td><input type="tel" class="form-control" name="user_tel" id="user_tel" placeholder="Your Phone Number" value="<?= $user_tel; ?>" required/>
                                                <small><?= form_error('user_tel') ?></small></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>:</td>
                                                <td><textarea class="form-control" rows="3" name="user_address" id="user_address" placeholder="Your Address"><?= $user_address; ?></textarea>
                                                <small><?= form_error('user_address') ?></small></td>
                                            </tr>
                                            <tr>
                                                <td>Bio</td>
                                                <td>:</td>
                                                <td><textarea class="form-control" rows="3" name="user_bio" id="user_bio" placeholder="Your Bio"><?= $user_bio; ?></textarea>
                                                <small><?= form_error('user_bio') ?></small></td>
                                            </tr>                                      
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>
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
    function showImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#showingImage')
                    .attr('src', e.target.result)
                    .width('100%')
                    .height(250);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<!-- JS -->
    <?php $this->load->view('_partials/endfile'); ?>
<!-- End JS -->