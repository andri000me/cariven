<?php $this->load->view('_partials/header'); ?>
<?php $this->load->view('_partials/navbar'); ?>

<?php 
    $startDate = date('d M Y', strtotime($event->start_time));
    $endDate   = date('d M Y', strtotime($event->end_time));
    $startTime = date('H:i', strtotime($event->start_time));
    $endTime   = date('H:i', strtotime($event->end_time));
?>

<!--================ Start Course Details Area =================-->
<section class="course_details_area section_gap">
	<div class="container">
		<div class="row text-center">
			<div class="col-lg-12">
				<h1 class="mb-3"><?= $event->title; ?></h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 course_details_left">
				<div class="main_image">
					<img src="<?= base_url('assets/images/images-event/'.$event->image) ?>" class="img-fluid"
						style="height: 360px; width: 730px">
				</div>
				<div class="content_wrapper">
					<h4 class="title">Deskripsi</h4>
					<div class="content">
						<?= $event->description ?>
					</div>
				</div>
			</div>


			<div class="col-lg-4 right-contents">
				<ul>
					<li>
						<a class="justify-content-between d-flex" href="#">
							<p>Publisher</p>
							<span class="or"><?= $event->publisher_name ?></span>
						</a>
					</li>
					<li>
						<a class="justify-content-between d-flex" href="#">
							<p>Tanggal </p>
							<span><span><?= $tanggal = ($startDate == $endDate) ? $startDate : $startDate .' - '.$endDate; ?></span></span>
						</a>
					</li>
					<li>
						<a class="justify-content-between d-flex" href="#">
							<p>Jam </p>
							<span><?= $startTime .' - '.$endTime ?></span>
						</a>
					</li>
					<li>
						<a class="justify-content-between d-flex" href="#">
							<p>
								Lokasi <br>
								<?= $event->location .', '.$event->city_name ?>
							</p>

						</a>
					</li>
				</ul>
				<?php if ($isPublisher): ?>
				<a href="#" class="primary-btn text-uppercase enroll rounded-0" data-toggle="modal"
					data-target="#tiket">Lihat Tiket</a>
				<?php else: 
                if ($isRegister == TRUE): ?>
				<a href="<?= site_url('tiket-saya') ?>">
					<button class="btn btn-warning text-uppercase enroll rounded-0 text-white">
						Anda sudah terdaftar
					</button>
				</a>
				<?php elseif (date('Y-m-d',strtotime($event->start_time)) < date('Y-m-d') ): ?>
				<a>
					<button class="btn btn-danger text-uppercase enroll rounded-0">
						Event sudah selesai
					</button>
				</a>
				<?php else: ?>
				<a href="#" class="primary-btn text-uppercase enroll rounded-0 text-white" data-toggle="modal"
					data-target="#tiket">Saya mau daftar</a>
				<?php endif ?>
				<?php endif ?>

				<h4 class="title">Kontak</h4>
				<div class="content">
					<a class="btn btn-light btn-block text-left"><i class="fa fa-phone"></i>
						<?= $publisher->business_number ?></a>
					<a class="btn btn-light btn-block text-left"><i class="fa fa-envelope"></i>
						<?= $publisher->business_email ?></a>
				</div>

			</div>
		</div>
	</div>
</section>
<!--================ End Course Details Area =================-->

<!-- Modal beli tiket -->
<div class="modal fade" id="tiket" tabindex="-1" role="dialog" aria-labelledby="tiket" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tiket">Tiket Event</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="list-group">
					<?php foreach ($tikets as $tiket): ?>
					<span class="list-group-item list-group-item-action list-group-item-warning">
						<div class="d-flex w-100 justify-content-between">
							<h5 class="mb-1"><?= $tiket->name  ?></h5>
							<small><b
									style="color: inherit"><?= 'Rp. '.number_format($tiket->price,'0','','.') ?></b></small>
						</div>
						<div class="float-right">
							<?php if ($isPublisher): else:
                                    if ($tiket->quota > 0): ?>
                                <a href="<?= site_url('konfirmasi-booking/'.$event->id.'/'.$tiket->id) ?>"
                                    class="badge badge-success">Beli Tiket</a>
                                <?php else: ?>
                                <a href="#" class="badge badge-secondary">Tiket Habis</a>
                                <?php endif ?>
							<?php endif ?>
						</div>
						<p class="mb-1"><?= $tiket->description ?></p>
						<small><?= 'kuota tersisa ' . $tiket->quota .' lagi' ?></small>
					</span>
					<?php endforeach ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<!-- end modal beli tiket -->

<!-- Footer -->
<?php $this->load->view('_partials/footer'); ?>
<!-- End Footer -->

<!-- JS -->
<?php $this->load->view('_partials/js'); ?>
<!-- End JS -->

<!-- Footer -->
<?php $this->load->view('_partials/endfile'); ?>
<!-- End Footer -->