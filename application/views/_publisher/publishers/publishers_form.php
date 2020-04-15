<!-- Header -->
<?php $this->load->view('_partials/header'); ?>
<!-- End Header -->

<!-- Navbar -->
<?php $this->load->view('_partials/navbar'); ?>
<!-- End Navbar -->

<div class="popular_courses"></div>

<main id="main">
    <section id="about">
        <div class="container">
            <h3>Profil saya</h3>
            <form action="<?= site_url('p/aksi-ubah-profil') ?>" method="post" enctype="multipart/form-data">
                <div class="row" style="margin-bottom:80px">
                    <div class="col-lg-4">
                        <div class="card" style="width: 18rem;">
                            <img src="<?= base_url('assets/images/images-publisher/'.$pub_image) ?>" class="card-img-top" id="showingImage" alt="image publisher" height="250px">
                            <div class="card-body text-center">
                                <input type="file" onchange="showImage(this);" accept="image/*" class="form-control-file my-2" name="pub_image_new" value="<?= $pub_image_new; ?>"/>
                                <small class="text-muted">*Ukuran Maksimal 500kb</small> <br>
                                <small class="text-muted">Format foto PNG</small> <br>
                                <small class="text-danger"><?= $error ?></small>
                                <input type="hidden" name="pub_image" value="<?= $pub_image; ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" style="color: inherit"
                                href="#nav-profile" role="tab" aria-controls="nav-home" aria-selected="true"> 
                                    <i class="fa fa-user-o"></i> Profil Saya</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-home-tab">
                                <table class="table table-striped">
                                    <tr>
                                        <td>Nama</td>
                                        <td style="width:30px">:</td>
                                        <td><input type="text" class="form-control" name="pub_name" id="pub_name" placeholder="Nama Publisher" value="<?= $pub_name; ?>" required/>
                                            <small><?= form_error('pub_name') ?></small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td><input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= $email; ?>" required/>
                                            <small><?= form_error('email') ?></small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No Hp</td>
                                        <td>:</td>
                                        <td><input type="tel" class="form-control" name="pub_tel" id="pub_tel" placeholder="No Telepon" value="<?= $pub_tel; ?>" required/>
                                            <small><?= form_error('pub_tel') ?></small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td><textarea class="form-control" rows="3" name="pub_address" id="pub_address" placeholder="Alamat" required><?= $pub_address; ?></textarea>
                                            <small><?= form_error('pub_address') ?></small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Deskripsi</td>
                                        <td>:</td>
                                        <td><textarea class="form-control" rows="3" name="pub_desciption" id="pub_desciption" placeholder="Deskripsi"><?= $pub_desciption; ?></textarea>
                                            <small><?= form_error('pub_desciption') ?></small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input type="hidden" name="pub_id" value="<?= $pub_id; ?>" />
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Simpan</button> 
                                            <a href="<?= site_url('profil-saya') ?>" class="btn btn-light">Batal</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>      
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>

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