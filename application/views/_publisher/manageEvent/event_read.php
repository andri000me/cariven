<?php $this->load->view('_partials/header'); ?>
<?php $this->load->view('_partials/navbar'); ?>

<div class="popular_courses"></div>

<main id="main">
	<section id="about">
	<div class="container">
		<div class="row justify-content-center" style="margin-bottom: 100px">
			<div class="col-md-12">
				<div class="card shadow">
					<div class="card-body">
						<ul class="nav nav-tabs mb-3" id="tab" role="tablist">
							<?php $this->load->view('_partials/navbar_manage'); ?>
						</ul>
						<div class="tab-content" id="tabContent">
							<div class="tab-pane fade show active" id="deskripsi" role="tabpanel" aria-labelledby="pills-deskripsi-tab">
								<div class="card">
									<!-- cek jumlah tiket -->
									<?php if (count($tiket) < 1) { ?>
										<div class="alert alert-warning" role="alert">
											Event ini <strong>belum</strong> mempunyai tiket. Pilih menu <i>Tiket</i> untuk membuatnya ~
										</div>
									<?php } ?>
									
									<!-- pesan berhasil diajukan -->
									<?php if ($this->session->flashdata('diajukan') != NULL) { ?>
										<?= $this->session->flashdata('diajukan'); ?>
									<?php } ?>
									<div class="row no-gutters">
										<div class="col-md-7">
											<img src="<?= base_url('assets/images/images-event/'.$event->image) ?>" class="card-img" height="400px" alt="image poster">
										</div>
										<div class="col-md-5">
											<div class="card-body">
												<?php
													$startDate = date('Y-m-d',strtotime($event->start_time));
													$endDate   = date('Y-m-d',strtotime($event->end_time));
													$startTime = date('H:i',strtotime($event->start_time));
													$endTime   = date('H:i',strtotime($event->end_time));
												?>
												<h3><?= $event->title ?></h3>
												<h6 class="mt-30" style="margin-bottom:0px"><strong>Tanggal dan waktu :</strong></h6>
												<span><?= $tanggalEvent = ($startDate == $endDate) ? date_indo($startDate) : date_indo($startDate) .' - '. date_indo($endDate); ?></span><br>
												<span><?= $startTime .' - '. $endTime ?></span>
												<h6 class="mt-30" style="margin:10px 0px 0px 0px"><strong>Tempat penyelenggaraan :</strong></h6>
												<p><?= $event->location .', '. $event->city_name ?></p>
												<p><?= 'Status : ' . $event->status .' / Tipe : '. $eventType = ($event->type == 0) ? "Gratis" : "Berbayar" ; ?> <br>
												<?php if($event->status == 'rejected'): ?>
												<div class="alert alert-danger" role="alert">
													<strong>Event ditolak</strong> <br> 
													<?= $event->status_description ?>
												</div>
												<?php endif ?>
												</p>
												
												<a href="<?= site_url('manage/'.$event->id.'/edit') ?>"
													class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Update event
												</a>

												<?php if (count($tiket) > 0 && $event->status == 'draft') { ?>
													<a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#ajukan_event<?= $event->id ?>">Ajukan Event <i class="fa fa-send"></i></a>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
								<h4 style="margin-top:10px"># Deskripsi</h4>
								<?= $event->description ?>
							</div>
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>
	</section>
</main>

<!-- Modal konfirmasi mengajukan Start -->
	<div class="modal fade" id="ajukan_event<?= $event->id ?>" tabindex="-1" role="dialog" aria-labelledby="ajukan_event" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ajukan_event"><strong>Konfirmasi pengajuan event</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<p><strong>Nama Event : <?= $event->title ?></strong></p>
					<ul>
						<li>Setelah diajukan anda tidak bisa menambah, mengubah, dan menghapus tiket</li>
						<li>Setelah diajukan perubahan data pada event akan dibatasi</li>
					</ul>
					<br>
					<p>Klik tombol <strong>Ajukan</strong>, jika anda yakin ingin mengajukan event sekarang</p>
                </div>
                <div class="modal-footer">
					<a href="<?= site_url('manage/'.$event->id.'/ajukan') ?>" class="btn btn-primary">Ajukan <i class="fa fa-send"></i></a>
					<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<!-- Modal konfirmasi mengajukan End -->

<!-- Footer -->
<?php $this->load->view('_partials/footer'); ?>
<!-- End Footer -->

<!-- JS -->
<?php $this->load->view('_partials/js'); ?>
<!-- End JS -->
<script>
$("#message").fadeTo(2000, 500).slideUp(500, function(){
    $("#message").slideUp(300);
});
</script>
<!-- Footer -->
<?php $this->load->view('_partials/endfile'); ?>
<!-- End Footer -->