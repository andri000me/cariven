<!-- Header -->
<?php 
	$this->load->view('_partials/header');
?>
<!-- End Header -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<!-- Navbar -->

<style>
    #portfolio {
        min-height: 90vh;
    }
</style>
<?php 
	$this->load->view('_partials/navbar');
?>
<!-- End Navbar -->

<div class="popular_courses"></div>

<main id="main">
    <!--==========================
      Search form Section
    ============================-->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form action="<?= site_url('Main/search_event') ?>" method="get">
                    <div class="card shadow-lg my-1" id="form-cari">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 col-md-7 col-lg-5">
                                    <label for="nama event">Nama event</label>
                                    <input type="text" name="keyword" id="keyword" class="form-control" value="<?=  $_GET['keyword'] ; ?>">
                                    </div>
                                    <div class="col-6 col-md-2 col-lg-2">
                                        <label for="kategori">Kategori</label>
                                        <select name="kategori" class="form-control" id="kategori">
                                            <option value="">Pilih kategori</option>
                                            <?php foreach ($kategori_data as $row) { ?>
                                                <option value="<?= $row->id ?>" <?= $selected = ($row->id == $_GET['kategori']) ? "selected" : ""?>>
                                                <?= $row->name ?></option>
                                            <?php } ?>
                                        </select>
                                </div>
                                <div class="col-6 col-md-2 col-lg-2">
                                    <label for="kota">Kota</label>
                                    <select name="kota" id="kota" class="selectpicker form-control" data-live-search="true" data-size="6">
                                        <option value="">Pilih kota</option>
                                        <?php foreach ($kota_data as $row) { ?>
                                            <option value="<?= $row->id ?>" <?= $selected = ($row->id == $_GET['kota']) ? "selected" : ""?>>
                                            <?= $row->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-6 col-md-6 col-lg-3">
                                    <button class="btn btn-primary btn-block" style="margin-top:30px">Cari sekarang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        
    <!--==========================
      Event Section
    ============================-->
    <section id="portfolio" style="margin-top: 2%">
      <div class="container">
        <div class="row wow fadeInUp">
            <?php 
            if ($event_data != NULL) {            
                foreach ($event_data as $row) { 
                    $startDate = date('Y-m-d',strtotime($row->start_time));
                    $startTime = date('H:i',strtotime($row->start_time));
                    $endTime   = date('H:i',strtotime($row->end_time));
                    ?>
                    <div class="col-md-4 col-xs-6 my-1">
                        <a href="<?= site_url('event/v/'.$row->slug) ?>" style="text-decoration: none; color: inherit">
                            <div class="card mb-3">
                                <img src="<?= base_url('assets/images/images-event/'.$row->event_image) ?>" class="card-img-top" alt="..." height="220px">
                                <div class="card-body">
                                    <h6><?= $row->title ?></h6>
                                    <span class="card-text">
                                    <div class="row">
                                        <div class="col-12" style="font-size:14px">
                                            <i class="fa fa-calendar-check-o"></i> Tanggal :  <?= date_indo($startDate) ?> <br>
                                            <i class="fa fa-clock-o"></i> Jam : <?= $startTime . ' - '. $endTime ?> <br>
                                            <i class="fa fa-map-marker"></i> Lokasi : <?= $row->city_name ?>
                                            <p class="mt-3">
                                            <img src="<?= base_url('assets/images/images-publisher/'.$row->image) ?>" style="height:30px !important" />
                                            <span class="d-inline-block ml-2"><?= $row->publisher_name ?></span>
                                            </p>
                                        </div>
                                    </div>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } 
            } else { ?>
            <div class="col-12">
                <h5 style="margin: 0px 0px 150px 0px">
                    Data event belum tersedia <img src="<?= base_url('assets/icons/icons/clock.svg') ?>" alt="" width="24" height="24">
                </h5>
            </div>
            <?php } ?>
        </div>
      </div>
    </section>
</main>

<div class="mb-5"></div>

<!-- Footer -->
<?php 
	$this->load->view('_partials/footer');
?>
<!-- End Footer -->

<!-- JS -->
<?php 
	$this->load->view('_partials/js');
?>
<!-- End JS -->

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script>
    $(function () {
        $('#event_city').selectpicker();
    });
</script>
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

<!-- End File -->
<?php 
	$this->load->view('_partials/endfile');
?>
<!-- End File -->