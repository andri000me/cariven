<!-- Header -->
<?php 
	$this->load->view('_partials/header');
?>
<!-- End Header -->

<!-- Navbar -->
<?php 
	$this->load->view('_partials/navbar');
?>
<!-- End Navbar -->

<div class="popular_courses"></div>

<main id="main">
	<section id="about">
		<div class="container">
			<div class="row mt-30">
				<div class="col-lg-8">
					<div class="card mt-30 shadow wow fadeInUp">
						<div class="card-body">
							<div class="section-heading">
								<h3 class="text-center">Pembayaran tiket event</h3>
								<hr>
								<h5 class="mt-30"><b style="color:inherit"><?= $event_data->title ?></b></h5>
								<p>Silahkan lalukan pembayaran melalui rekening bank berikut ini: </P>
								<p>
									<?php 
                                        foreach ($bank_data as $row) {
                                            echo $row->bank_name .' a/n '. $row->account_name .' ('.$row->account_number.') <br>';
                                        } 
                                    ?>
								</p>
								<p>
									Setelah melakukan pembayaran, mohon melakukan konfirmasi pembayaran Anda
									melalui form di bawah ini dengan detail pembayaran yang benar. <b
										style="color:inherit">Maksimal
										upload bukti pembayaran / konfirmasi pembayaran adalah 1 jam setelah pemesanan
										tiket dilakukan.</b>
								</p>
								<p>
									<strong>
										Anda wajib menyertakan bukti pembayaran berupa lampiran / attachment:
										Bukti Pembayaran dari ATM, Internet Banking, SMS Banking atau BANK.
									</strong>
								</p>
								<div class="text-center mt-10 mb-30">***</div>
								<hr>
								<form action="<?= site_url('User/Payment/create_action') ?>" method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label for="varchar">Bank Tujuan</label>
										<select name="payment_destination" class="form-control">
											<option value="">Pilih bank tujuan</option>
											<?php foreach ($bank_data as $row) { ?>
											<option value="<?= $row->id ?>">
												<?= $row->bank_name .' a/n '. $row->account_name .' ('. $row->account_number .')' ?>
											</option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group">
										<label for="varchar">Nama Pengirim</label>
										<input type="text" class="form-control" name="payment_nameacc"
											placeholder="misal: Dani Kristianto" value="<?= $payment_nameacc; ?>"
											required />
										<small>*Nama pada rekening bank</small>
									</div>
									<div class="form-group">
										<label for="varchar">Bukti Transfer</label>
										<input type="file" class="form-control-file" name="payment_image" value="<?= $payment_image; ?>" accept="image/*" required />
										<small>*Maksimal 1Mb, file didukung: jpeg, jpg, png</small> <br>
										<small><?= $error ?></small>
									</div>
									<div class="form-group">
										<label for="payment_message">Catatan (Optional)</label>
										<textarea class="form-control" rows="3" name="payment_message"
											placeholder="catatan"><?= $payment_message; ?></textarea>
									</div>
									<input type="hidden" name="payment_booking" value="<?= $booking_id; ?>" />
									<button type="submit" style="width:300px" class="btn btn-success">Kirim</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="card mt-30 shadow wow fadeInUp">
						<div class="card-body">
							<div class="section-heading">
								<h3 class="text-center">Ringkasan Order</h3>
								<hr>
								<h6 style="margin-bottom:0px"><strong>Pemesanan Tiket</strong></h6>
								<span>Tiket - <?= $event_data->title?></span><br><br>
								<h6 style="margin-bottom:0px"><strong>Jenis Tiket</strong></h6>
								<span><?= $tiket_data->name ?></span><br> <br>
								<h6 style="margin-bottom:0px"><strong>Harga</strong></h6>
								<span><?= 'Rp ' . number_format($tiket_data->price,'0','','.') ?></span> <br>
								<br>
								<h6 style="margin-bottom:0px"><strong>Batas Waktu Pembayaran</strong></h6>
								<?php $tanggalBooking = date("Y-m-d", strtotime($tiket_data->created_at)) ?>
								<span><?= date_indo($tanggalBooking) .', '.date("H:i:s", strtotime($tiket_data->created_at) + 60*60) ?></span>
								<br> <br>
								<a href="<?= site_url('tiket-saya/'.$booking_id) ?>"
									class="btn btn-outline-secondary btn-block">
									<i class="fa fa-arrow-left"></i> Kembali
								</a>
							</div>
						</div>
					</div>
				</div>
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

<!-- Footer -->
<?php 
	$this->load->view('_partials/endfile');
?>
<!-- End Footer -->