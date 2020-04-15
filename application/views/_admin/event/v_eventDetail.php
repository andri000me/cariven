<!-- Header -->
<?php $this->load->view('_partials_admin/header'); ?>
<!-- End Header -->

<!-- Navbar -->
<?php $this->load->view('_partials_admin/navbar'); ?>
<!-- End Navbar -->

<!-- Sidebar -->
<?php $this->load->view('_partials_admin/sidebar'); ?>
<!-- End Sidebar -->

<div class="content-wrapper">
    <section class="content-header">
    <!-- Breadcrumb -->
    <?php $this->load->view('_partials_admin/breadcrumb'); ?>
    <!-- End Breadcrumb -->
    </section>
	<section class="content">
		<div class="box box-solid">
			<div class="box-header with-border">
				<a href="<?= site_url('admin/event') ?>" class="btn btn-default pull-right"><i class="fa fa-reply"></i> Kembali</a>
				<h3 style="margin-top:0px"><i class="fa fa-calendar-o"></i> Event</h3>
				<p><?= $this->session->userdata('message'); ?></p>
			</div>    
			<div class="box-body">
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<img src="<?= base_url('assets/images/images-event/'.$event->image) ?>" width="100%" height="400">
				</div>
				<div class="col-md-6 col-xs-12">
					<table class="table table-striped table-hover">
						<?php
						$startDate = date_indo(date("Y-m-d", strtotime($event->start_time)));
						$endDate   = date_indo(date("Y-m-d", strtotime($event->end_time)));
						$startTime = date("H:i", strtotime($event->start_time));
						$endTime   = date("H:i", strtotime($event->end_time));
						$createAt  = date("d M Y, H:i:s", strtotime($event->created_at));
						?>
						<tr>
							<td style="width: 100px">Nama Event</td>
							<td style="width: 1em">:</td>
							<td><?= $event->title; ?></td>
						</tr>
						<tr>
							<td>Publisher</td>
							<td style="width: 1em">:</td>
							<td><a href="<?= site_url('admin/peserta/'.$event->publisher) ?>" target="_blank" class="text-muted"><u><?= ucfirst($event->publisher_name); ?></u></a></td>
						</tr>
						<tr>
							<td>Kategori</td>
							<td style="width: 1em">:</td>
							<td><?= $event->category_name; ?></td>
						</tr>
						<tr>
							<td>Tanggal</td>
							<td style="width: 1em">:</td>
							<td><?= $tanggal_event = ($startDate == $endDate) ? $startDate : $startDate .' - '. $endDate; ; ?></td>
						</tr>
						<tr>
							<td>Jam</td>
							<td style="width: 1em">:</td>
							<td><?= $startTime .' - '. $endTime; ?></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td style="width: 1em">:</td>
							<td><?= $event->location .' - '. $event->city_name; ?></td>
						</tr>
						<tr>
							<td>Tipe Event</td>
							<td style="width: 1em">:</td>
							<td><?= $tipe = ($event->type == 0) ? "Gratis" : "Berbayar" ;?></td>
						</tr>
						<tr>
							<td>Status</td>
							<td style="width: 1em">:</td>
							<td>
							<?php if ($event->status == "submitted") { ?>
								<label class="label label-warning"><?= $event->status; ?></label>
							<?php } elseif($event->status == "approved") { ?>
								<label class="label label-success"><?= $event->status; ?></label>
							<?php } elseif($event->status == "rejected") { ?>
								<label class="label label-danger"><?= $event->status; ?></label>
							<?php } ?>
							<?= ($event->status_description != null) ? '('.$event->status_description.')' : '' ?>
							</td>
						</tr>
						<tr>
							<td>Dibuat</td>
							<td style="width: 1em">:</td>
							<td><?= $createAt; ?></td>
						</tr>
						<tr><td colspan="3">
						<?php if ($_SESSION['role'] == 'adm') { 
							if ($event->status == 'submitted') { ?>
								<a href="<?= site_url('admin/event/'.$event->id.'/terima') ?>" class="btn btn-success"
									onclick="return confirm('Apakah anda ingin menyetujui event ini ?')">Setujui</a>
								<a href="#" data-toggle="modal" data-target="#reject" class="btn btn-danger">Tolak</a>
							<?php } else { ?>
								<span>Divalidasi oleh : <?= $event->validated_by . ' ('.$event->validated_time.')' ?></span>
						<?php } 
						} ?>
						</td></tr>
					</table>
				</div>
			</div>
			</div>
		</div>

		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 style="margin-top:0px">Deskripsi dan Tiket Event</h3>
			</div>    
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#deskripsi" data-toggle="tab">Deskripsi Event</a></li>
							<li><a href="#tiket" data-toggle="tab">Tiket(<?= $totalTiket ?>)</a></li>
							<li><a href="#peserta" data-toggle="tab">Peserta (<?= $totalPeserta ?>)</a></li>
							<li><a href="#penjualanTiket" data-toggle="tab">Penjualan Tiket</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="deskripsi">
								<?= $event->description ?>
							</div>
							<div class="tab-pane" id="tiket">
								<p>Total Kuota : <b><?= $totalQuota ?></b></p>
								<?php 
								foreach ($tiket as $row) { ?>
									<div class="box box-warning box-solid">
										<div class="box-header with-border">
										<h3 class="box-title"><?= $row->name ?></h3>

										<div class="box-tools pull-right">
											<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
											</button>
										</div>
										</div>
										<div class="box-body">
										<span class="pull-right"><b>Rp. <?= number_format($row->price,0,',','.') ?></b></span>
										<?= $row->description .' <br> Kuota <b>('. $row->quota.' orang)</b>' ?>
										</div>
									</div>
								<?php } ?>
							</div>
							<div class="tab-pane" id="peserta">
								<table class="table table-bordered table-hover table-striped" id="tabel-peserta">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Peserta</th>
											<th>Jenis Tiket</th>
											<th>Tanggal Mendaftar</th>
											<?php if ($event->type == 1) { ?>
												<th>Pembayaran</th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
									<?php 
									$start = 0;
									foreach ($peserta as $result) { 
										$bookCreated = date("d M Y H:i:s", strtotime($result->created_at));
										?>
										<tr>
											<td><?= ++$start ?></td>
											<td><?= $result->user_name ?></td>
											<td><?= $result->ticket_name ?></td>
											<td><?= $bookCreated ?></td>
											<?php if ($event->type == 1) { ?>
												<td><a href="#" class="btn-xs btn-primary" data-toggle="modal" data-target="#payment<?= $result->id ?>">Lihat pembayaran</a></td>
											<?php } ?>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="tab-pane" id="penjualanTiket">
								<?= "Data Penjualan Tiket" ?>
								<div class="row">
									<div class="col-md-7">
										<table class="table table-bordered table-hover table-striped">
											<thead>
												<tr>
													<th>Nama Tiket</th>
													<th>Terjual/Stok Tiket</th>
													<th>Harga</th>
													<th>Sub Total</th>
												</tr>
											</thead>
											<tbody>
												<tr>
												<?php foreach ($sellPerTiket as $row) { 
													$stok = $row->Terjual + $row->quota;
													$subTotal = $row->Terjual * $row->price;
													?>
												<tr>
													<td><?= $row->ticket_name ?></td>
													<td><?= $row->Terjual.'/'. $stok ?></td>
													<td><?= '@ '.'Rp '. number_format($row->price,'0','','.') ?></td>
													<td><?= 'Rp '. number_format($subTotal,'0','','.') ?></td>
												</tr>
												<?php } ?>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="col-md-5">
									<!-- small box -->
									<div class="small-box bg-green">
										<div class="inner">
										<?php 
											$total = 0;
											foreach ($sellPerTiket as $row) { 
												$subTotal = $row->Terjual * $row->price;
												$total += $subTotal ?>
										<?php } ?>
											<h3><?= 'Rp ' . number_format($total,'0','','.') ?></h3>
											<p>Total Penjualan Tiket</p>
										</div>
										<div class="icon">
											<i class="fa fa-money"></i>
										</div>
									</div>
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
</div>

<div class="modal fade" id="reject">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Reject Event</h4>
			</div>
            <form action="<?= site_url('admin/event/'.$event->id.'/tolak') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="radio">
                            <label>
                            <input type="radio" name="status_description" value="Data tidak lengkap" checked>
                                Data Tidak lengkap
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                            <input type="radio" name="status_description" value="Data tidak valid">
                                Data Tidak Valid
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                            <input type="radio" name="status_description" value="Berkas kurang">
                                Berkas Kurang
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </form>
		</div>
	</div>
</div>

<!-- Modal -->
	<?php 
		foreach ($payment as $row) {
			$paymentID 	    = $row->id;
			$paymentBooking = $row->booking_id;
			$paymentNameacc = $row->account_name;
			$paymentMessage = $row->message;
			$paymentImage 	= $row->image;
			$paymentCreate 	= $row->created_at;
	?>
	<div class="modal fade" id="payment<?= $paymentBooking ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Pembayaran (<?= $paymentBooking ?>)</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<img src="<?= base_url('assets/images/images-buktitf/'.$paymentImage) ?>" width="100%" height="300" alt="<?= $paymentImage ?>">
						</div>
						<div class="col-md-6">
							<h5 class="text-bold">Kode Pesanan</h5>
							<span><?= $paymentBooking ?></span> <br><br>
							<h6 style="margin-bottom: 0px"><b>Bank Tujuan</b></h6>
							<span><?= $row->bank_name .' a/n '. $row->account_name ?></span> <br>
							<span><?= $row->account_number ?></span><br> <br>
							<h5 class="text-bold">Nama Pembayar</h5>
							<span><?= $paymentNameacc ?></span> <br> <br>
							<h5 class="text-bold">Catatan</h5>
							<span><?= $catatan = ($paymentMessage != NULL) ? '-' : $paymentMessage; ?></span> <br>
						</div>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<?php } ?>
<!-- End Modal -->

<!-- JS -->
<?php $this->load->view('_partials_admin/js'); ?>
<!-- End JS -->

<script>
$(function () {
    $('#tabel-peserta').DataTable()
  })
</script>

<!-- Footer -->
<?php $this->load->view('_partials_admin/footer'); ?>
<!-- End Footer -->