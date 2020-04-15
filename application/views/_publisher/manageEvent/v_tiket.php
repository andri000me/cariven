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
							<div class="tab-pane fade show active" id="tiket" role="tabpanel" aria-labelledby="pills-tiket-tab">
								<?php if (count($tiket) > 0) { ?>
									<?php if ($status == 'draft') { ?>
									<a href="#">
										<button class="btn btn-sm btn-success mb-2" data-toggle="modal" data-target="#tiketform">
										<i class="fa fa-plus"></i> Tambah tiket</button>
									</a>
									<?php } ?>
									<div class="list-group">
										<?php foreach ($tiket as $row) { ?>
											<span class="list-group-item list-group-item-action list-group-item-warning">
												<div class="d-flex w-100 justify-content-between">
													<h5 class="mb-1"><?= $row->name  ?></h5>
													<small><b style="color:inherit"><?= 'Rp. '.number_format($row->price,'0','','.') ?></b></small>
												</div>
												<div class="float-right">
												<?php if ($status != 'draft') {} else { ?>
													<a href="#" data-toggle="modal" data-target="#tiketformupdate<?= $row->id ?>" class="badge badge-warning">edit</a>
													<a href="<?= site_url('manage/'.$id.'/hapus-tiket/'.$row->id) ?>" class="badge badge-danger" 
													onclick="return confirm('Apakah anda yakin ingin menghapus tiket ini?')">hapus</a>
												<?php } ?>
												</div>
												<p class="mb-1"><?= $row->description ?></p>
												<small><?= 'kuota tersisa ' . $row->quota .' lagi' ?></small>
											</span>
										<?php } ?>
									</div> 
								<?php } else { ?> 
								<div class="alert alert-warning" role="alert">
									Klik tombol <strong>tambah tiket</strong> untuk membuat tiket!
								</div>
								<?php if ($status != 'approved'){ ?>
								<a href="#">
									<button class="btn btn-sm btn-outline-success mb-2" data-toggle="modal" data-target="#tiketform">
									<i class="fa fa-plus"></i> Tambah tiket</button>
								</a>
								<?php } } ?>
                            </div>
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>
	</section>
</main>

<!-- Modal Tiket Create Start -->
	<div class="modal fade" id="tiketform" tabindex="-1" role="dialog" aria-labelledby="tiketform" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tiketform">Tambah Tiket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<form action="<?= site_url('manage/'.$id.'/tambah-tiket') ?>" method="post">
						<div class="form-group">
							<label for="varchar">Nama Tiket</label>
							<input type="text" class="form-control" name="name" id="name" placeholder="Nama Tiket" required/>
						</div>
						<div class="form-group">
							<label for="description">Deskripsi Tiket</label>
							<textarea class="form-control" rows="3" name="description" id="description" placeholder="Deskripsi Tiket" required></textarea>
						</div>
						<div class="form-group">
							<label for="int">Kuota Tiket</label>
							<input type="text" class="form-control" name="quota" id="quota" placeholder="Kuota Tiket" required/>
						</div>
						<div class="form-group">
							<label for="int">Harga</label>
							<?php if ($type == 0) { ?>
								<input type="text" class="form-control" name="price" id="price" value="0" readonly/>
							<?php } elseif ($type == 1) { ?>
								<input type="text" class="form-control" name="price" id="price" placeholder="Harga" required/>
							<?php } ?>
						</div>

						<input type="hidden" name="event" value="<?= $id; ?>" />
                </div>
                <div class="modal-footer">
					<button type="submit" class="btn btn-primary">Tambah</button> 
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</form>
                </div>
            </div>
        </div>
    </div>
<!-- Modal Tiket Create End -->

<!-- Modal Tiket Update Start -->
<?php foreach ($tiket as $row) { ?>
	<div class="modal fade" id="tiketformupdate<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="tiketformupdate<?= $ticket_id ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tiketformupdate<?= $row->id ?>">Update Tiket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<form action="<?= site_url('manage/'.$id.'/edit-tiket/'.$row->id) ?>" method="post">
						<div class="form-group">
							<label for="varchar">Nama Tiket</label>
							<input type="text" class="form-control" name="name" id="name" placeholder="Nama Tiket" value="<?= $row->name ?>" required/>
						</div>
						<div class="form-group">
							<label for="description">Deskripsi Tiket</label>
							<textarea class="form-control" rows="3" name="description" id="description" placeholder="Deskripsi Tiket" required><?= $row->description ?></textarea>
						</div>
						<div class="form-group">
							<label for="int">Kuota Tiket</label>
							<input type="text" class="form-control" name="quota" id="quota" placeholder="Kuota Tiket" value="<?= $row->quota ?>" required/>
						</div>
						<div class="form-group">
							<label for="int">Harga</label>
							<?php if ($type == 0) { ?>
								<input type="text" class="form-control" name="price" value="<?= $row->price ?>" readonly/>
							<?php } elseif ($type == 1) { ?>
								<input type="text" class="form-control" name="price" placeholder="Harga" value="<?= $row->price ?>" required/>
							<?php } ?>
						</div>

						<input type="hidden" name="event" value="<?= $row->event; ?>" />
                </div>
                <div class="modal-footer">
					<button type="submit" class="btn btn-warning">Update</button> 
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</form>
                </div>
            </div>
        </div>
	</div>
	<?php  }?>
<!-- Modal Tiket Update End -->

<!-- Footer -->
<?php $this->load->view('_partials/footer'); ?>
<!-- End Footer -->

<!-- JS -->
<?php $this->load->view('_partials/js'); ?>
<!-- End JS -->

<!-- Footer -->
<?php $this->load->view('_partials/endfile'); ?>
<!-- End Footer -->