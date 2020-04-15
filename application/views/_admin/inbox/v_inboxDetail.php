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
                <a href="<?= site_url('admin/pesan-masuk') ?>" class="btn btn-default pull-right"><i class="fa fa-reply"></i> Kembali</a>
                <h4 style="margin-top:0px"><i class="fa fa-envelope-o"></i> <?= $inbox->name . " (".$inbox->email.")" ?> <small><i><?= $inbox->created_at ?></i></small></h4>
            </div>    
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <label class='badge bg-orange'><i class='fa fa-envelope-o'></i> Pesan</label>
                        <p style="margin-bottom: 1em"><?= $inbox->content ?></p>

                        <?php if ($inbox->reply_message != NULL) { ?>
                            <label class='badge bg-blue'><i class='fa fa-check-circle'></i> Balasan</label>
                            <p><?= $inbox->reply_message ?></p>
                            <i><small>dibalas oleh : <?= $inbox->admin_name ?> jam : <?= date("d M Y H:i:s",strtotime($inbox->replied_at)) ?></small></i>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        
        <?php 
        if ($_SESSION['role'] == 'adm') {
        if ($inbox->reply_message == NULL) { ?>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h4 style="margin-top:0px"><i class="fa fa-reply"></i> Balas</h4>
            </div>    
            <div class="box-body">
                <form action="<?= site_url('admin/pesan-masuk/'.$inbox->id.'/balas') ?>" method="post">
                    <div class="form-group">
                    <input type="email" name="email" class="form-control" value="<?= $inbox->email ?>" placeholder="Email Tujuan" readonly>
                    </div>
                    <div class="form-group">
                        <textarea name="message" id="content-message" rows="10" cols="80" required>
                            Pertanyaan: <br>
                            <?= $inbox->content ?> <br> <br>
                            Jawaban:
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" value="Kirim" onclick="return confirm('Apakah anda ingin mengirim pesan ini ?')">
                        Kirim <i class="fa fa-send-o"></i></button>
                </form>
            </div>
        </div>
        <?php } } ?>
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
</script>
<!-- Footer -->
<?php $this->load->view('_partials_admin/footer'); ?>
<!-- End Footer -->