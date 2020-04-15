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
                <h3 style="margin-top:0px"><i class="fa fa-newspaper-o"></i> <?= $button ?></h3>
            </div>    
            <div class="box-body">

            <form action="<?= $action ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="varchar">Judul <?= form_error('news_title') ?></label>
                    <input type="text" class="form-control" name="news_title" id="news_title" placeholder="Judul" value="<?= $news_title; ?>" required/>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <label for="news_content">Isi Berita <?= form_error('news_content') ?></label>
                        <textarea name="news_content" id="content-message" rows="10" cols="80" required>
                            <?= $news_content; ?>
                        </textarea>
                    </div>
                    <div class="col-md-3">
                        <label for="varchar">Kategori Artikel <?= form_error('news_category') ?></label> <br>
                        <?php foreach ($kategori_berita as $row) { 
                            $nc = ($row->id == $news_category) ? "checked" : "" ;
                        ?>
                            <input type="radio" name="news_category" id="news_category" value="<?= $row->id ?>" <?= $nc ?> required> <?= $row->name ?><br>
                        <?php } ?>
                    </div>
                </div>
                <?php if ($button == 'Tambah') { ?>
                <div class="form-group">
                    <label for="varchar">Gambar<?= form_error('news_image') ?></label>
                    <input type="file" class="form-control" name="news_image" id="news_image" placeholder="News Image" onchange="showImage(this);" accept="image/*" value="<?= $news_image; ?>" required/> <br>
                    <img id="showingImage" src="<?= base_url('assets/images/images-berita/default.png') ?>" width="150" height="100"/> <br>
                    <small class="text-red">*Ukuran Maksimal 1Mb</small>
                    <small><?= $error ?></small>
                </div>
                <?php } elseif($button == 'Edit') { ?>
                <div class="form-group">
                    <label for="varchar">Gambar<?= form_error('news_image') ?></label>
                    <input type="file" class="form-control" name="news_image_new" id="news_image_new" onchange="showImage(this);" accept="image/*" value="<?= $news_image_new; ?>"/>
                    <small class="text-red">*Ukuran Maksimal 1Mb</small>
                    <small><?= $error ?></small> <br>
                    <small>Gambar sekarang</small><br>
                    <img id="showingImage" src="<?= base_url('assets/images/images-berita/'.$news_image) ?>" width="150" height="100">
                    <input type="hidden" name="news_image" value="<?= $news_image; ?>"/>
                </div>
                <?php } ?>
                <input type="hidden" name="news_id" value="<?= $news_id; ?>" /> 
                <button type="submit" class="btn btn-primary"><?= $button ?></button> 
                <a href="<?= site_url('admin/artikel') ?>" class="btn btn-default">Batal</a>
            </form>
            </div>
        </div>
    </section>
</div>

<!-- JS -->
<?php $this->load->view('_partials_admin/js'); ?>
<!-- End JS -->
<!-- CK Editor -->
<script src="<?= base_url() ?>assets/AdminLTE/bower_components/ckeditor/ckeditor.js"></script>

<script>
  $(function () {
    CKEDITOR.replace('content-message');
  })

  function showImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#showingImage')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<!-- Footer -->
<?php $this->load->view('_partials_admin/footer'); ?>
<!-- End Footer -->