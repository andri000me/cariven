<!-- Header -->
<?php $this->load->view('_partials/header'); ?>
<!-- End Header -->

<!-- Navbar -->
<?php $this->load->view('_partials/navbar'); ?>
<!-- End Navbar -->


<?php 
    $startDate   = date('Y-m-d', strtotime($myTicket->start_time));
    $endDate     = date('Y-m-d', strtotime($myTicket->end_time));
    $startTime   = date('H:i', strtotime($myTicket->start_time));
    $endTime     = date('H:i', strtotime($myTicket->end_time));
    $bookingDate = date('Y-m-d', strtotime($myTicket->created_at));
    $bookingTime = date('H:i:s', strtotime($myTicket->created_at));

if ($myTicket->type == 0) {} 
    else {
    if ($myTicket->status == "booking" || $myTicket->status == "expired") { }
        else {
            $payDate = date('Y-m-d', strtotime($myPayment->created_at));
            $payTime = date('H:i:s', strtotime($myPayment->created_at)); 
        }
    }
?>

<div class="popular_courses mb-4"></div>

<main id="main" style="min-height: 90vh">
	<!-- tiket area start -->
	<section id="about">
		<div class="container">
			<div class="row">
				<h3>
					<strong>Tiket Event : <?= $myTicket->title ?></strong>
				</h3>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<?php if ($this->session->flashdata('payment-success') <> '') { ?>
					<div class="alert alert-success alert-dismissible fade show" id="success_payment" role="alert">
						<?= $this->session->flashdata('payment-success') ?>
					</div>
					<?php } ?>
				</div>
			</div>
			<div class="row mb-5">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="<?= base_url('assets/images/images-event/'.$myTicket->image)?>"
                                    class="card-img h-100" alt="...">
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <h6 style="margin-bottom:0px"><strong>Tanggal dan waktu :</strong></h6>
                                    <span><i class="fa fa-calendar-check-o"></i>
                                        <?= $tanggal_event = ($startDate == $endDate) ? date_indo($startDate) : date_indo($startDate) .' - '.date_indo($endDate); ?></span><br>
                                    <span><i class="fa fa-clock-o"></i> <?= $startTime .' - '.$endTime ?></span>
                                    <h6 style="margin:10px 0px 0px 0px"><strong> Tempat penyelenggaraan :</strong></h6>
                                    <p><i class="fa fa-map-marker"></i>
                                        <?= $myTicket->location .', '.$myTicket->city_name ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <h6 style="margin-bottom:0px"><strong>Nama Pemesan : </strong></h6>
                                    <p><?= $myTicket->user_name ?></p>
                                    <h6 style="margin-bottom:0px"><strong>Tanggal pesan :</strong></h6>
                                    <p><?= date_indo($bookingDate) .', '. $bookingTime ?></p>
                                    <?php if ($myTicket->status == 'approved') { ?>
                                    <a href="#">
                                        <button class="btn btn-success w-100" data-toggle="modal" data-target="#tiket">Lihat
                                            QR Code</button>
                                    </a>
                                    <?php } elseif ($myTicket->status == 'paid') { ?>
                                    <a href="#">
                                        <button class="btn btn-warning w-100" disabled>Menunggu verifikasi
                                            pembayaran</button>
                                    </a>
                                    <?php } elseif ($myTicket->status == 'rejected') { ?>
                                    <a href="#">
                                        <button class="btn btn-danger w-100" disabled>Pemesanan Ditolak</button>
                                    </a>
                                    <?php } elseif ($myTicket->status == 'expired') { ?>
                                    <a href="#">
                                        <button class="btn btn-secondary w-100" disabled>Kadaluwarsa</button>
                                    </a>
                                    <?php } else { ?>
                                    <a href="<?= site_url('pembayaran/'.$myTicket->id) ?>">
                                        <button class="btn btn-primary w-100">Lanjutkan Pembayaran</button>
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</section>
	<!-- tiket area end -->

	<!-- Payment Area Start -->
	<section class="about">
		<div class="container">
			<div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal bayar</th>
                                <th>Jam bayar</th>
                                <th>Bukti Transfer</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if ($myTicket->type == 0 || $myTicket->status == "booking" || $myTicket->status == "expired") { ?>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td>1</td>
                                    <td><?= date_indo($payDate) ?></td>
                                    <td><?= $payTime ?></td>
                                    <td><a href="#" data-toggle="modal" data-target="#payment"><span
                                                class="badge badge-primary">Lihat bukti transfer</span></a></td>
                                    <td><?= $myPayment->status ?></td>
                                    <td><?= $myPayment->status_description ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
			</div>
		</div>
	</section>
</main>

<!-- Modal QR Code -->
<div class="modal fade" id="tiket" tabindex="-1" role="dialog" aria-labelledby="tiket" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tiket">Tiket QR Code (<?= $myTicket->id ?>)</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<img src="<?= base_url('assets/images/qrcode/'.$myTicket->qrcode) ?>" class="img-fluid">
                <p><?= $myTicket->id ?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<!-- end modal QR Code -->

<!-- Modal lihat pembayaran -->
<div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="payment" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="payment">Bukti Transfer</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<img src="<?= base_url('assets/images/images-buktitf/'.$myPayment->image) ?>" class="w-100 h-100">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<!-- end modal lihat pembayaran -->

<!-- JS -->
<?php $this->load->view('_partials/footer'); ?>
<!-- End JS -->

<!-- Footer -->
<?php $this->load->view('_partials/js'); ?>
<!-- End Footer -->
<script>
	$("#success_payment").fadeTo(2000, 500).slideUp(500, function () {
		$("#success_payment").slideUp(1000);
	});
</script>
<!-- Footer -->
<?php $this->load->view('_partials/endfile'); ?>
<!-- End Footer -->