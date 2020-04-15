`<?php $this->load->view('_partials/header'); ?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<?php $this->load->view('_partials/navbar'); ?>

<div class="popular_courses"></div>

<main id="main">
	<section id="about">
		<div class="container mb-50">
			<div class="card shadow">
				<div class="card-body">
					<h2>Edit Event</h2>
					<small>Maksimalkan eventmu semenarik mungkin yaks ^_^</small>
					<form action="" method="post" enctype="multipart/form-data">
						<div class="row justify-content-center my-3">
							<div class="col-md-6">
                                <div class="my-2">
                                    <label for="title">Nama Event</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><img
                                                    src="<?= base_url('assets/icons/icons/person.svg') ?>" width="24"
                                                    height="24"></span>
                                        </div>
                                        <input type="title" name="title" class="form-control" value="<?= $title ?>"
                                            placeholder="nama event" required>
                                    </div>
                                    <small class="text-danger"><?= form_error('title') ?></small> 
                                </div>

                                <div class="my-2">
                                    <label for="category">Kategori</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><img
                                                    src="<?= base_url('assets/icons/icons/grid.svg') ?>" width="24"
                                                    height="24"></span>
                                        </div>
                                        <select name="category" class="form-control" required>
                                            <option value="">Pilih kategori</option>
                                            <?php foreach ($category_list as $row) { ?>
                                            <option value="<?= $row['id'] ?>"
                                                <?= ($row['id'] == $category) ? "selected" : ""?>>
                                                <?= $row['name'] ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <small class="text-danger"><?= form_error('category') ?></small> 
                                </div>

                                <?php
                                    $startDate = date('Y-m-d',strtotime($start_time));
                                    $endDate   = date('Y-m-d',strtotime($end_time));
                                    $startTime = date('H:i',strtotime($start_time));
                                    $endTime   = date('H:i',strtotime($end_time));
                                ?>

								<div class="form-group my-3">
									<div class="row">
										<div class="col">
											<label for="start_date">Tanggal Mulai </label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><img
															src="<?= base_url('assets/icons/icons/calendar.svg') ?>"
															width="24" height="24"></span>
												</div>
												<?php $startMinDate = new DateTime('+0 day'); ?>
												<input type="date" class="form-control" name="start_date"
													min="<?= $startMinDate->format('Y-m-d') ?>"
													value="<?= $startDate; ?>" <?= ($status == 'draft') ? 'required' : 'readonly' ?> />
											</div>
											<small class="text-danger"><?= form_error('start_date') ?></small>
										</div>
										<div class="col">
											<label for="end_date">Tanggal Selesai </label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><img
															src="<?= base_url('assets/icons/icons/calendar.svg') ?>"
															width="24" height="24"></span>
												</div>
												<?php $endMinDate = new DateTime('+0 day'); ?>
												<input type="date" class="form-control" name="end_date"
													min="<?= $endMinDate->format('Y-m-d') ?>" value="<?= $endDate; ?>"
													<?= ($status == 'draft') ? 'required' : 'readonly' ?> />
											</div>
											<small class="text-danger"><?= form_error('start_date') ?></small>
										</div>
									</div>
								</div> 

								<div class="form-group my-1">
									<div class="row">
										<div class="col">
											<label for="start_time">Jam Mulai </label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><img
															src="<?= base_url('assets/icons/icons/clock.svg') ?>"
															width="24" height="24"></span>
												</div>
												<input type="time" class="form-control" name="start_time"
													value="<?= $startTime; ?>" <?= ($status == 'draft') ? 'required' : 'readonly' ?> />
											</div>
										</div>
										<div class="col">
											<label for="end_time">Jam Selesai </label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><img
															src="<?= base_url('assets/icons/icons/clock.svg') ?>"
															width="24" height="24"></span>
												</div>
												<input type="time" class="form-control" name="end_time"
													value="<?= $endTime; ?>" <?= ($status == 'draft') ? 'required' : 'readonly' ?> />
											</div>
										</div>
									</div>
								</div>

                                <div class="my-2">
                                    <label for="location">Alamat Lengkap</label>
                                    <div class="input-group">
                                        <textarea name="location" class="form-control" placeholder="Alamat lengkap"><?= $location ?></textarea>
                                    </div>
                                    <small class="text-danger"><?= form_error('location') ?></small> 
                                </div>

                                <div class="my-2">
                                    <label for="city">Kota</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><img
                                                    src="<?= base_url('assets/icons/icons/grid.svg') ?>" width="24"
                                                    height="24"></span>
                                        </div>
                                        <select name="city" id="city" class="form-control" required>
                                            <option value="">Pilih Kota</option>
                                            <?php foreach ($city_list as $row) { ?>
                                            <option value="<?= $row['id'] ?>"
                                                <?= ($row['id'] == $city) ? "selected" : ""?>>
                                                <?= $row['name'] ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <small class="text-danger"><?= form_error('category') ?></small> 
                                </div>
							</div>
							<div class="col-md-6">
                                <div class="my-2">
                                    <label for="file">Banner Event <?= form_error('event_image') ?></label> <br>
                                    <img id="showingImage" src="<?= base_url('assets/images/images-event/'.$image) ?>" width="100%" height="250px" alt="masukan gambar event"/> <br> <br>
                                    <input type="file" name="image_new" onchange="showImage(this);" accept="image/*"/> <br>
                                    <input type="hidden" name="image" value="<?= $image; ?>">
                                    <small class="text-danger">*Ukuran maksimal 1 Mb</small>
                                </div>
                                <div class="my-2">
                                    <div class="form-group">
                                        <label for="tinyint">Tipe Event <br>
                                        <?php $readonly = ($status == 'draft') ? '' : 'readonly'; ?>
                                        <input type="radio" name="type" value="0"<?php if($type == 0) echo "checked" ?> <?= $readonly ?> > Free / Gratis
                                        <input type="radio" name="type" value="1"<?php if($type == 1) echo "checked" ?> <?= $readonly ?>> Paid / Berbayar <br>

                                    </div>
                                </div>
                                <div class="my-2">
                                    <div class="form-group">
                                        <label for="sertifikat">Klik pada kotak jika anda membutuhkan presensi
                                            sertifikat</label><br>
                                        <input type="checkbox" name="certificate" value="1"
                                            <?php if($certificate == 1) echo "checked" ?>> Ya, saya membutuhkannya
                                    </div>
                                </div>
							</div>
						</div>
						<div class="row justify-content-center my-2">
							<div class="col-12">
                                <label for="description">Deskripsi Event</label>
								<div class="form-group">
									<textarea class="form-control" rows="15" name="description"
										id="description"><?= $description; ?></textarea>
								</div>

                                <input type="hidden" name="id" value="<?= $id ?>">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <button onclick="history.go(-1)" class="btn btn-dark">Batal</button>
                                </div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</main>

<div class="mb-5"></div>

<!-- Footer -->
<?php $this->load->view('_partials/footer'); ?>
<!-- End Footer -->

<!-- JS -->
<?php $this->load->view('_partials/js'); ?>
<!-- End JS -->

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script>
	$(function () {
		$('#city').selectpicker();
	});

    function showImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#showingImage')
                    .attr('src', e.target.result)
                    .width('100%')
                    .height(250);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script src="<?= base_url('assets/js/tinymce/tinymce.min.js') ?>"></script>
<script>
	tinymce.init({
		selector: '#description'
	});
</script>


<!-- Footer -->
<?php $this->load->view('_partials/endfile'); ?>
<!-- End Footer -->`