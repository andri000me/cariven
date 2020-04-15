<!-- Header -->
<?php $this->load->view('_partials_admin/header'); ?>
<!-- End Header -->

<!-- Navbar -->
<?php $this->load->view('_partials_admin/navbar'); ?>
<!-- End Navbar -->

<!-- Sidebar -->
<?php $this->load->view('_partials_admin/sidebar'); ?>
<!-- End Sidebar -->

<div class="content-wrapper">
    <section class="content-header">
    <!-- Breadcrumb -->
    <?php $this->load->view('_partials_admin/breadcrumb'); ?>
    <!-- End Breadcrumb -->
    </section>
    <section class="content">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 style="margin-top:0px"><i class="fa fa-user"></i> <?= $button ?></h3>
            </div>    
            <div class="box-body">

            <form action="<?= $action; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="varchar">Nama <?= form_error('admin_name') ?></label>
                    <input type="text" class="form-control" name="admin_name" id="admin_name" placeholder="Nama" value="<?= $admin_name; ?>" required/>
                </div>
                <div class="form-group">
                    <label for="varchar">Telepon <?= form_error('admin_tel') ?></label>
                    <input type="text" class="form-control" name="admin_tel" id="admin_tel" placeholder="Telepon" value="<?= $admin_tel; ?>" required/>
                </div>
                <div class="form-group">
                    <label for="varchar">Email <?= form_error('email') ?></label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= $email; ?>" required/>
                </div>
                <?php if ($button == 'Tambah') { ?>
                <div class="form-group">
                    <label for="varchar">Foto Profil <?= form_error('admin_image') ?></label>
                    <input type="file" class="form-control" name="admin_image" value="<?= $admin_image; ?>" required/>
                    <small class="text-red">*Ukuran maksimal 500kb</small>
                    <small><?= $error ?></small>
                </div>
                <?php } elseif ($button == 'Edit') { ?>
                <div class="form-group">
                    <label for="varchar">Foto Profil <?= form_error('admin_image_new') ?></label>
                    <input type="file" class="form-control" name="admin_image_new" value="<?= $admin_image_new; ?>"/>
                    <small class="text-red">*Ukuran maksimal 500kb</small>
                    <small><?= $error ?></small> <br>
                    <small>Gambar Sekarang</small> <br>
                    <img src="<?= base_url('assets/images/images-user/'.$admin_image) ?>" width="150" height="100">
                    <input type="hidden" name="admin_image" value="<?= $admin_image; ?>" />
                </div>
                <?php } ?>
                <input type="hidden" name="admin_id" value="<?= $admin_id; ?>" /> 
                <input type="hidden" name="password" value="<?= $password; ?>" />
                <button type="submit" class="btn btn-primary"><?= $button ?></button> 
                <a href="<?= site_url('admin/admin') ?>" class="btn btn-default">Batal</a>
            </form>

            </div>
        </div>
    </section>
</div>
<!-- JS -->
<?php $this->load->view('_partials_admin/js'); ?>
<!-- End JS -->

<!-- Footer -->
<?php $this->load->view('_partials_admin/footer'); ?>
<!-- End Footer -->