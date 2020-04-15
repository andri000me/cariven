<!-- Header -->
    <?php $this->load->view('_partials/header'); ?>
<!-- End Header -->

<style>
    #portfolio {
        min-height: 90vh;
    }
</style>

<!-- Navbar -->
	<?php $this->load->view('_partials/navbar'); ?>
<!-- End Navbar -->

<div class="popular_courses"></div>

<main id="main">
    <!--==========================
      Event Section
    ============================-->
    <section id="portfolio" class="clearfix">
      <div class="container">
        <header class="section-header mt-5">
          <h3 class="section-title text-left">Event yang anda ikuti</h3>
        </header>

        <div class="row wow fadeInUp" style="margin-bottom: 100px">
            <?php if ($myEvent == NULL) { ?>
                <div class="col-12">
                    <h5>Anda belum mengikuti event, daftarkan dirimu ke event-event terbaik. <a href="<?= base_url() ?>">Klik disini</a></h5>
                </div>
            <?php } else {
                foreach ($myEvent as $row) { 
                $startDate = date('Y-m-d',strtotime($row->start_time));
                $startTime = date('H:i',strtotime($row->start_time));
                $endTime   = date('H:i',strtotime($row->end_time));
            ?>
            <div class="col-md-4 col-xs-6 my-1">
                <a href="<?= site_url('tiket-saya/'.$row->booking_id) ?>" style="color: inherit">
                    <div class="card">
                        <img src="<?= base_url('assets/images/images-event/'.$row->image) ?>" class="card-img-top" alt="..." height="220px">
                        <div class="card-body">
                            <span class="float-right"><?= $eventTipe = ($row->type == 0) ? "<label class='badge badge-primary'>FREE</label>" : "" ; ?></span>
                            <h6><?= $row->title ?></h6>
                            <span class="card-text">
                                <div class="row">
                                    <div class="col-12" style="font-size: 14px">
                                        <i class="fa fa-calendar-check-o"></i> Tanggal : <?= date_indo($startDate) . '<br>' ?>
                                        <i class="fa fa-clock-o"></i> Jam : <?= $startTime . ' - '. $endTime . '<br>' ?>
                                        <i class="fa fa-map-marker"></i> Lokasi : <?= $row->city_name . '<br>' ?>
                                        <?php 
                                        if ($startDate < date('Y-m-d')) { ?>
                                            <label class="badge badge-secondary"><strong>Event Selesai</strong></label>    
                                        <?php } else { 
                                            switch ($row->status) {
                                                case 'booking': ?>
                                                    <label class="badge badge-primary"><strong>Lanjutkan pembayaran</strong></label>
                                                <?php break;
                                                case 'paid': ?>
                                                    <label class="badge badge-warning"><strong>Menunggu verifikasi pembayaran</strong></label>
                                                <?php break;
                                                case 'approved': ?>
                                                    <label class="badge badge-success"><strong><?= $row->status; ?></strong></label>
                                                <?php break;
                                                case 'rejected': ?>
                                                    <label class="badge badge-danger"><strong><?= $row->status; ?></strong></label>
                                                <?php break;                                            
                                                default: ?>
                                                    <label class="badge badge-dark"><strong><?= $row->status; ?></strong></label>
                                                <?php break;
                                            } 
                                        }
                                        ?>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <?php } } ?>
        </div>
      </div>
    </section><!-- #event -->

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

<!-- Footer -->
    <?php $this->load->view('_partials/endfile'); ?>
<!-- End Footer -->