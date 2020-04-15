<?php $this->load->view('_partials/header'); ?>

<style>
a.custom-card,
a.custom-card:hover {
  color: inherit;
  text-decoration: none;
}
</style>
<!-- Navbar -->
    <?php $this->load->view('_partials/navbar'); ?>
<!-- End Navbar -->

<div class="popular_courses"></div>

<main id="main">
    <section id="about" style="min-height:70vh">
        <div class="container">

        <?php if ($isPublisher === false): ?>
            <div class="row justify-content-center my-5">
                <div class="col-4 text-center my-5">

                    Anda harus jadi publisher untuk membuat event, silahkan upgrade akun dahulu. <br>
                    <a href="<?= site_url('manage/jadi-publisher') ?>" class="btn primary-btn" style="margin: 20px 0 10px 0;">Jadi Publisher</a>
                </div>
            </div>
        <?php elseif($publisher_status == 'submitted'): ?>
            <div class="row justify-content-center my-5">
                <div class="col-4 text-center my-5">
                    Akun anda sedang kami tinjau, jika sudah selesai anda dapat membuat event. Tunggu yaa. <br>
                </div>
            </div>
        <?php elseif($publisher_status == 'rejected'): ?>
            <div class="row justify-content-center my-5">
                <div class="col-4 text-center my-5">
                    Pengajuan anda ditolak karena: <br>
                    <?= $publisher_status_description ?><br>
                    <i>Silahkan untuk mengajukan akun agar lagi jadi Publisher dan pastikan data terisi dengan benar.</i> <br>
                    <a href="<?= site_url('manage/jadi-publisher') ?>" class="btn primary-btn" style="margin: 20px 0 10px 0;">Jadi Publisher</a>
                </div>
            </div>
        <?php else: ?>
            <div class="row my-5">
                <div class="col-8">
                    <h3>Daftar event anda</h3>
                    <small>Selamat datang di halaman kelola event. Have a nice day :)</small>
                </div>
                <div class="col-4">
                    <div class="float-right">
                        <a href="<?= site_url('manage/buat-event') ?>"  class="btn primary-btn" style="margin: 10px 0 10px 0;">
                        <i class="fa fa-plus"></i> Buat Event</a>
                    </div>
                </div>
            </div>
            <div class="row my-5">
                <?php if ($event_data == NULL): ?>
                    <h5 class="col-12 mb-100">Anda belum membuat event.</h5>
                <?php else: ?>
                <?php foreach ($event_data as $event): 
                $startDate = date('Y-m-d',strtotime($event->start_time));
                $startTime = date('H:i',strtotime($event->start_time));
                $endTime   = date('H:i',strtotime($event->end_time));
                ?>
                <div class="col-md-4 col-xs-6 my-3">
                    <a href="<?= site_url('manage/'.$event->id) ?>" class="custom-card">
                        <div class="card">
                            <img src="<?= base_url('assets/images/images-event/'.$event->image) ?>" class="card-img-top" height="200px" alt="image event">
                            <div class="card-body" style="min-height:190px">
                                <span class="float-right"><?= $eventTipe = ($event->type == 0) ? "<label class='badge badge-primary'>FREE</label>" : "" ; ?></span>
                                <h5 class="card-title"><?= $event->title ?></h5>
                                <p class="card-text">
                                    <?= date_indo($startDate) .', '. $startTime . ' - '. $endTime ?> <br>
                                    <small><i><?= $event->category_name ?></i></small> <br>
                                </p>
                                <span class="float-right">
                                    <?php
                                    switch ($event->status) {
                                        case 'submitted': ?>
                                            <label class="badge badge-warning"><?= $event->status ?></label>    
                                        <?php break;
                                        case 'approved': ?>
                                            <label class="badge badge-success"><?= $event->status ?></label>
                                        <?php break;
                                        case 'rejected': ?>
                                            <label class="badge badge-danger"><?= $event->status ?></label>
                                        <?php break;
                                        default: ?>
                                            <label class="badge badge-secondary"><?= $event->status ?></label>
                                        <?php break;
                                    }
                                    ?>
                                </span>
                                <div class="btn-group" role="group">
                                    <a href="<?= site_url('manage/'.$event->id.'/edit') ?>"
                                    class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                    <?php if ($event->status != 'approved'): ?>
                                        <a href="<?= site_url('manage/'.$event->id.'/hapus') ?>"
                                        class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda ingin menghapus event ini ?')"><i class="fa fa-trash"></i></a>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach ?>
                <?php endif ?>
            </div>
        <?php endif ?>
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
$(document).ready(function() { 
  $( ".card" ).hover(
    function() {
        $(this).addClass('shadow').css('cursor', 'pointer'); 
    }, function() {
            $(this).removeClass('shadow');
        }
    );
});
</script>

<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

<!-- Footer -->
<?php $this->load->view('_partials/endfile'); ?>
<!-- End Footer -->