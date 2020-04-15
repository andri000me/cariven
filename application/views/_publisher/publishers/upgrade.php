<?php $this->load->view('_partials/header'); ?>

<?php $this->load->view('_partials/navbar'); ?>

<div class="popular_courses"></div>

<div id="main">
	<div class="container">
        <div class="row">
            <div class="col-6">
                <h3>Jadi Publisher</h3>
				<small>Dengan mendaftar jadi publisher, anda dapat membuat event</small>
            </div>
        </div>
		<div class="row mb-5">
			<div class="col-6">
				<form action="" method="post" enctype="multipart/form-data">
					<label for="name" style="margin-top: 20px;">Nama Event Organizer</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><img src="<?= base_url('assets/icons/icons/person.svg') ?>" width="24" height="24"></span>
						</div>
						<input type="name" name="name" class="form-control" value="<?= $name ?>" placeholder="nama event organizer" required> <br>
					</div>
                    <small class="text-danger"><?= form_error('name') ?></small>
					
                    <label for="tel" style="margin-top: 20px;">No Telepon Bisnis</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><img src="<?= base_url('assets/icons/icons/person.svg') ?>" width="24" height="24"></span>
						</div>
						<input type="tel" name="business_number" class="form-control" value="<?= $business_number ?>" placeholder="nomor bisnis" required> <br>
					</div>
                    <small class="text-danger"><?= form_error('business_number') ?></small>
                    
                    <label for="email" style="margin-top: 20px;">Email Bisnis</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><img src="<?= base_url('assets/icons/icons/person.svg') ?>" width="24" height="24"></span>
						</div>
						<input type="email" name="business_email" class="form-control" value="<?= $business_email ?>" placeholder="email bisnis" required> <br>
					</div>
                    <small class="text-danger"><?= form_error('business_email') ?></small>
                    
                    <label for="short_bio" style="margin-top: 20px;">Biodata Singkat</label>
					<div class="input-group">
						<textarea name="short_bio" class="form-control" required><?= $short_bio ?></textarea>
					</div>
                    <small class="text-danger"><?= form_error('short_bio') ?></small>
                    
                    <label for="location" style="margin-top: 20px;">Alamat</label>
					<div class="input-group">
						<textarea name="location" class="form-control" required><?= $location ?></textarea>
					</div>
                    <small class="text-danger"><?= form_error('location') ?></small>

                    <label for="image" style="margin-top: 20px;">Logo Event Organizer</label> <br>
                    <input type="file" name="image" accept="image/*" required> <br>
					<small>*format jpeg/jpg/png</small> <br>
					<small class="text-danger"><?= form_error('image') ?></small>
                    
                    <label for="tdup" style="margin-top: 20px;">TDUP (Tanda Daftar Usaha Pariwisata) / Dokumen Pendukung</label> <br>
                    <input type="file" name="tdup" accept="image/*, application/pdf" required> <br>
					<small>*format pdf/jpeg/jpg/png</small> <br>
					<small class="text-danger"><?= form_error('tdup') ?></small>

                    <button class="btn primary-btn btn-block" style="margin: 20px 0 10px 0;">Submit</button>

				</form>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('_partials/footer'); ?>

<?php $this->load->view('_partials/js'); ?>

<?php $this->load->view('_partials/endfile'); ?>