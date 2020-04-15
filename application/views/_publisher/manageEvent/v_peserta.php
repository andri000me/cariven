<!-- Header -->
<?php $this->load->view('_partials/header'); ?>
<!-- End Header -->

<!-- Datatable Start -->
<link rel="stylesheet" href="<?= base_url('assets/css/dataTables.bootstrap4.min.css') ?>">

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
								<div class="tab-pane fade show active" id="peserta" role="tabpanel" aria-labelledby="pills-peserta-tab">
									<div class="row">
										<div class="col-lg-2 col-md-4 col-6">
											<div class="card text-white bg-info mb-3">
												<div class="card-header">Pendaftar</div>
												<div class="card-body">
													<h5 class="card-title text-white"><?= $totalPendaftar ?></h5>
												</div>
											</div>
										</div>
										<div class="col-lg-2 col-md-4 col-6">
											<div class="card text-white bg-primary mb-3">
												<div class="card-header">Dipesan</div>
												<div class="card-body">
													<h5 class="card-title text-white"><?= $totalDipesan ?></h5>
												</div>
											</div>
										</div>
										<div class="col-lg-2 col-md-4 col-6">
											<div class="card text-white bg-warning mb-3">
												<div class="card-header text-white">Dibayar</div>
												<div class="card-body">
													<h5 class="card-title text-white"><?= $totalDibayar ?></h5>
												</div>
											</div>
										</div>
										<div class="col-lg-2 col-md-4 col-6">
											<div class="card text-white bg-success mb-3">
												<div class="card-header text-white">Disetujui</div>
												<div class="card-body">
													<h5 class="card-title text-white"><?= $totalDisetujui ?></h5>
												</div>
											</div>
										</div>
										<div class="col-lg-2 col-md-4 col-6">
											<div class="card text-white bg-danger mb-3">
												<div class="card-header text-white">Ditolak</div>
												<div class="card-body">
													<h5 class="card-title text-white"><?= $totalDitolak ?></h5>
												</div>
											</div>
										</div>
										<div class="col-lg-2 col-md-4 col-6">
											<div class="card text-white bg-dark mb-3">
												<div class="card-header text-white">Kadaluwarsa</div>
												<div class="card-body">
													<h5 class="card-title text-white"><?= $totalKadaluarsa ?></h5>
												</div>
											</div>
										</div>
									</div>
									<a href="" class="btn btn-outline-dark float-right" style="margin:0px">
										<i class="fa fa-refresh"></i></a>
									<nav>
										<div class="nav nav-tabs" id="nav-tab" role="tablist">
											<a class="nav-item nav-link active" id="nav-pendaftar-tab" data-toggle="tab" href="#nav-pendaftar" role="tab" style="color: inherit" aria-controls="nav-pendaftar" aria-selected="false"><i class="fa fa-users"></i> Data Pendaftar Event (<?= $jumlah_pendaftar ?>)
											</a>
											<a class="nav-item nav-link" id="nav-peserta-tab" data-toggle="tab" href="#nav-peserta" role="tab" style="color: inherit" aria-controls="nav-peserta" aria-selected="true"><i class="fa fa-money"></i> Data Peserta event (<?= $jumlah_konfirmasi ?>)
											</a>
										</div>
									</nav>
									<div class="tab-content" id="nav-tabContent">
										<div class="tab-pane fade show active" id="nav-pendaftar" role="tabpanel" aria-labelledby="nav-pendaftar-tab">
											<!-- Pendaftar Event -->
											<div class="alert alert-primary alert-dismissible fade show my-3" role="alert">
												Data dibawah ini adalah <b style="color:inherit">semua</b> pendaftar event
											</div>
											<table id="tabel-pendaftar" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr>
														<th>No</th>
														<th>Kode</th>
														<th>Nama Peserta</th>
														<th>Tanggal Daftar</th>
														<th>Status</th>
														<th>Pembayaran</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$start = 0;
													foreach ($pendaftar as $row) { ?>
														<tr>
															<td><?= ++$start ?></td>
															<td><?= $row->id ?></td>
															<td><?= $row->name ?></td>
															<td><?= date('d M Y, H:i:s', strtotime($row->created_at)) ?></td>
															<td><?= $row->status ?></td>
															<?php 
															if ($row->type == 1) {
																switch ($row->status) {
																	case 'paid': ?>
																		<td>
																			<a href="#" class="badge badge-primary" data-toggle="modal" data-target="#buktipembayaran<?= $row->id ?>"><i class="fa fa-eye"></i> Bukti Pembayaran</a>
																		</td>
																	<?php break;
																	default: ?>
																		<td>
																			<a href="#" class="badge badge-primary" data-toggle="modal" data-target="#buktipembayaran<?= $row->id ?>"><i class="fa fa-eye"></i> Bukti Pembayaran</a>
																		</td>
																	<?php break;
																} 
															} else { ?>
																<td>-</td>
															<?php } ?>
														</tr>
													<?php } ?>
												</tbody>
												<tfoot>
													<tr>
														<th>No</th>
														<th>Kode</th>
														<th>Nama Peserta</th>
														<th>Tanggal/Waktu Daftar</th>
														<th>Status</th>
													</tr>
												</tfoot>
											</table>
										</div>
										<div class="tab-pane fade" id="nav-peserta" role="tabpanel" aria-labelledby="nav-peserta-tab">
											<!-- Konfirmasi pembayaran -->
											<div class="alert alert-success alert-dismissible fade show my-3" role="alert">
												Data dibawah ini adalah peserta event yang <b style="color:inherit">sudah fix</b>
											</div>
											<table id="tabel-konfirmasi-bayar" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr>
														<th>No</th>
														<th>Kode</th>
														<th>Nama Peserta</th>
														<th>Tanggal Daftar</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$start = 0;
													foreach ($peserta as $row) { ?>
														<tr>
															<td style="width:50px"><?= ++$start ?></td>
															<td><?= $row->id ?></td>
															<td><?= $row->name ?></td>
															<td><?= date('d M Y, H:i:s', strtotime($row->created_at)) ?></td>
															<td style="width:150px"><?= $row->status;
																if ($type == 1) { ?>
																	<a href="#" class="badge badge-success" data-toggle="modal" data-target="#buktipembayaran<?= $row->id ?>">
																		<i class="fa fa-eye"></i> Lihat</a>
																<?php } ?>
															</td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
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

<!-- Modal lihat pembayaran Start -->
<?php
if ($type == 1 && $pembayaran != null) {
	foreach ($pembayaran as $row) {
		?>
		<div class="modal fade" id="buktipembayaran<?= $row->booking_id ?>" tabindex="-1" role="dialog" aria-labelledby="buktipembayaran<?= $row->booking_id ?>" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="buktipembayaran<?= $row->booking_id ?>">Pembayaran (<?= $row->booking_id ?>)</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-6">
								<img src="<?= base_url('assets/images/images-buktitf/' . $row->image) ?>" class="w-100 h-100" alt="<?= $row->image ?>">
							</div>
							<div class="col-6">
								<h6 style="margin-bottom: 0px;"><b>Kode Pesanan</b></h6>
								<span><?= $row->booking_id ?></span> <br> <br>
								<h6 style="margin-bottom: 0px;"><b>Bank Tujuan</b></h6>
								<span><?= $row->bank_name . ' a/n ' . $row->account_name ?></span> <br>
								<span><?= $row->account_number ?></span><br> <br>
								<h6 style="margin-bottom: 0px;"><b>Nama Pembayar</b></h6>
								<span><?= $row->payment_nameacc ?></span> <br> <br>
								<h6 style="margin-bottom: 0px;"><b>Catatan</b></h6>
								<span><?= $catatan = ($row->message == NULL) ? '-' : $row->message; ?></span> <br>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-info" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
	<?php }
} ?>
<!-- Modal lihat pembayaran End -->

<!-- Footer -->
<?php $this->load->view('_partials/footer'); ?>
<!-- End Footer -->

<!-- JS -->
<?php $this->load->view('_partials/js'); ?>
<!-- End JS -->

<!-- Datatable Start -->
<script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.bootstrap4.min.js') ?>"></script>
<script>
	$(document).ready(function() {
		$('#tabel-pendaftar').DataTable({
			initComplete: function() {
				this.api().columns().every(function() {
					var column = this;
					var select = $('<select><option value=""></option></select>')
						.appendTo($(column.footer()).empty())
						.on('change', function() {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);

							column
								.search(val ? '^' + val + '$' : '', true, false)
								.draw();
						});

					column.data().unique().sort().each(function(d, j) {
						select.append('<option value="' + d + '">' + d + '</option>')
					});
				});
			}
		});
		$('#tabel-peserta').DataTable();
		$('#tabel-konfirmasi-bayar').DataTable();
	});
</script>
<!-- Datatable End -->

<!-- Footer -->
<?php $this->load->view('_partials/endfile'); ?>
<!-- End Footer -->