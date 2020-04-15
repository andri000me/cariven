<!-- Header -->
    <?php $this->load->view('_partials/header'); ?>
<!-- End Header -->

<!-- Navbar -->
    <?php $this->load->view('_partials/navbar'); ?>
<!-- End Navbar -->

<?php 
    $startDate = date('Y-m-d', strtotime($event->start_time));
    $endDate   = date('Y-m-d', strtotime($event->end_time));
    $startTime = date('H:i', strtotime($event->start_time));
    $endTime   = date('H:i', strtotime($event->end_time));
?>

<div class="popular_courses"></div>

<main id="main">
    <section id="about">
        <div class="container">
            <div class="card shadow my-3 wow fadeInUp">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4><strong>Konfirmasi Booking</strong></h4><hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5><strong>Informasi Event</strong></h5>
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <td style="width:200px">Nama Event</td>
                                        <td  style="width:20px">:</td>
                                        <td><?= $event->title ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width:200px">Tanggal Event</td>
                                        <td  style="width:20px">:</td>
                                        <td><?= $tanggalEvent = ($startDate == $endDate) ? date_indo($startDate) : date_indo($startDate) .' - '. date_indo($endDate); ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width:200px">Waktu Event</td>
                                        <td  style="width:20px">:</td>
                                        <td><?= $startTime .' - '. $endTime ?></td>
                                    </tr>
                                </table>
                            <h5 class="mt-3"><strong>Informasi Tiket</strong></h5>
                                <table class="table table-striped">
                                    <tr>
                                        <td style="width:200px">Nama Tiket</td>
                                        <td  style="width:20px">:</td>
                                        <td><?= $tiket->name ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width:200px">Harga</td>
                                        <td  style="width:20px">:</td>
                                        <td><?= 'Rp ' . number_format($tiket->price,0,'','.') ?></td>
                                    </tr>
                                </table>
                            <h5 class="mt-3"><strong>Informasi Pengguna</strong></h5>
                                <table class="table table-striped">
                                    <tr>
                                        <td style="width:200px">Nama Pemesan</td>
                                        <td  style="width:20px">:</td>
                                        <td><?= $user->name ?></td>
                                    </tr>
                                </table>
                        </div>
                        <div class="col-md-6 mt-30">
                            <img src="<?= base_url('assets/images/images-event/'.$event->image) ?>"
                            width="500" height="250">
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-12">
                            <a href="<?= site_url('booking/'.$event->id.'/'.$tiket->ticket_id) ?>" class="btn btn-success" onclick="return confirm('Apakah anda ingin memesan tiket event ini ?')">Pesan</a>
                            <a href="<?= site_url('event/v/'.$event->slug) ?>" class="btn btn-danger" onclick="return confirm('Apakah anda ingin membatalkan pesanan ini ?')">Batalkan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Footer -->
    <?php $this->load->view('_partials/footer'); ?>
<!-- End Footer -->

<!-- JS -->
    <?php $this->load->view('_partials/js'); ?>
<!-- End JS -->

<!-- endfile -->
<?php $this->load->view('_partials/endfile'); ?>
<!-- endfile -->