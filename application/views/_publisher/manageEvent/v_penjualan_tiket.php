<!-- Header -->
<?php $this->load->view('_partials/header'); ?>
<!-- End Header -->

<!-- Navbar -->
<?php $this->load->view('_partials/navbar'); ?>
<!-- End Navbar -->

<div class="popular_courses"></div>

<main id="main">
	<section id="about">
		<div class="container">
			<div class="row justify-content-center" style="margin-bottom:100px">
				<div class="col-md-12">
					<div class="card shadow">
						<div class="card-body">
							<h4><?= $title ?></h4>
							<ul class="nav nav-tabs mb-3" id="tab" role="tablist">
								<?php $this->load->view('_partials/navbar_manage'); ?>
							</ul>
							<div class="tab-content" id="tabContent">
								<div class="tab-pane fade show active" id="selltiket" role="tabpanel" aria-labelledby="pills-selltiket-tab">
									<?= $this->session->flashdata('message') ?>
									<div class="row">
										<div class="col-lg-7 col-xs-12">
											<table class="table table-striped">
												<thead>
													<tr>
														<th>Tiket</th>
														<th>Terjual/Stok</th>
														<th>Harga</th>
														<th>Sub total</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($penjualanPerTiket as $row) {
														$stok = $row->Terjual + $row->quota;
														$subTotal = $row->Terjual * $row->price;
														?>
													<tr>
														<td><?= $row->ticket_name ?></td>
														<td><?= $row->Terjual . '/' . $stok ?></td>
														<td><?= '@ ' . 'Rp ' . number_format($row->price, '0', '', '.') ?></td>
														<td><?= 'Rp ' . number_format($subTotal, '0', '', '.') ?></td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
										<div class="col-lg-5 col-xs-12">
											<div class="card text-white bg-info mb-3">
												<div class="card-body">
													<?php if ($type == 1): ?>
													<button type="button" class="btn btn-dark btn-sm float-right" data-toggle="modal" data-target="#riwayat"><i class="fa fa-history"></i></button>
													<?php if ($countWithdraw < 1) { ?>
													<button type="button" class="btn btn-warning btn-sm float-right" data-toggle="modal" data-target="#withdraw">withdraw</button>
													<?php } else {
														if ($lastWithdraw->status == 'rejected') { ?>
															<button type="button" class="btn btn-warning btn-sm float-right" data-toggle="modal" data-target="#withdraw">withdraw</button>
														<?php } else { ?>
															<button type="button" class="btn btn-warning btn-sm float-right" disabled>withdraw</button>
														<?php }
													} ?>
													<?php endif ?>

													<h3 class="card-title text-white">Total Pendapatan</h3>
													<?php
													$total = 0;
													foreach ($penjualanPerTiket as $row) {
														$subTotal = $row->Terjual * $row->price;
														$total += $subTotal ?>
													<?php } ?>
													<h1 class="card-text text-white"><?= 'Rp '. number_format($total, '0', '', '.') ?></h1>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<h6>Catatan:</h6>
											<ul>
												<li>Jumlah stok akan berkurang ketika ada pemesanan masuk</span></li>
												<li>Status pemesanan yang <b style="color:inherit">dihitung</b> adalah Belum dibayar, Dibayar, Disetujui</span></li>
												<li>Status pemesanan yang <b style="color:inherit">tidak dihitung</b> adalah Ditolak, Kadaluwarsa</span></li>
												<li>Jumlah akan berubah-ubah tergantung situati pemesanan</span></li>
												<li>Waktu terbaik melihat total penjualan tiket adalah ketika event telah dimulai</span></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<!-- Modal -->
<div class="modal fade" id="withdraw" tabindex="-1" role="dialog" aria-labelledby="withdrawLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="withdrawLabel">Pengajuan Pencairan Dana</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>
					<strong>Total Pendapatan:</strong> <br>
					Total : <b style="color:inherit"><?= 'Rp ' . number_format($cashOut['total'],'0','','.') ?></b> Fee Admin <b style="color:inherit"><?= 'Rp ' . number_format($cashOut['fee'],'0','','.') ?></b> <br>
					Dana yang diterima <b style="color:inherit"><?php $danaDiterima = $cashOut['total'] - $cashOut['fee']; echo 'Rp ' . number_format($danaDiterima,'0','','.') ?></b>
				</p>

				<p>Untuk melakukan pencairan dana, harap mengirim link penyimpanan cloud (Google drive, Dropbox, One Drive, dll) dan sharing ke alamat email cariven di <strong>manajemen@cariven.id</strong>, dan copykan link pada form dibawah ini:</p>
				<form action="<?= site_url('manage/'.$id.'/withdraw') ?>" method="post">
					<div class="form-group">
						<label for="link drive">Link Drive</label>
						<input type="text" name="drive_link" class="form-control" placeholder="masukan link drive" required>
					</div>
					<div class="form-group">
						<label for="link drive">Pesan (Optional)</label>
						<input type="text" name="message" class="form-control" placeholder="tuliskan pesan">
					</div>
					<small class="text-danger">Pengajuan akan di proses 2x24 jam setelah pengajuan, berdasarkan jam kerja kantor.</small>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
				<button type="submit" class="btn btn-warning">Ajukan <i class="fa fa-arrow-right"></i></button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="riwayat" tabindex="-1" role="dialog" aria-labelledby="riwayatLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="riwayatLabel">Riwayat Pencarian Dana</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php if ($withdrawHistory): ?>
					<ul class="list-group">
						<?php foreach ($withdrawHistory as $wh) { ?>
						<li class="list-group-item d-flex justify-content-between align-items-center">
							<?= $wh['created_at']; ?> <br>
							<small><a href="<?= $wh['link'] ?>" target="_blank">Link drive</a></small>

							<?php
								if ($wh['status'] == 'rejected') {
									echo '<small>' . $wh['status_description'] . '</small>';
								}
								switch ($wh['status']) {
									case 'approved':
										echo '<span class="badge badge-success badge-pill">' . $wh['status'] . ' <i class="fa fa-check"></i></span>';
										break;

									case 'rejected':
										echo '<span class="badge badge-danger badge-pill">' . $wh['status'] . ' <i class="fa fa-times"></i></span>';
										break;

									default:
										echo '<span class="badge badge-warning badge-pill">' . $wh['status'] . ' <i class="fa fa-hourglass"></i></span>';
										break;
								}
								?>
						</li>
						<?php } ?>
					</ul>
				<?php else: ?>
				<p>Anda belum pernah melakukan pencairan dana</p>
				<?php endif ?>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
			</div>
		</div>
	</div>
</div>

<!-- Footer -->
<?php $this->load->view('_partials/footer'); ?>
<!-- End Footer -->

<!-- JS -->
<?php $this->load->view('_partials/js'); ?>
<!-- End JS -->
<script>
	$(function() {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>
<!-- Footer -->
<?php $this->load->view('_partials/endfile'); ?>
<!-- End Footer -->