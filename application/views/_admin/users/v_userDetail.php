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
        <div class="box">
            <div class="box-header with-border">
				<h4><i class="fa fa-user-o"></i> Detail <?= $user_name ?> 
                    <?php if($publisher): ?>
                        <?php if($publisher->status == 'submitted'): ?>
                            <small class="label label-sm bg-primary">
                                <i class="fa fa-star"></i>
                                publisher
                            </small> &nbsp
                            <small class="label label-sm bg-yellow">
                                butuh approval
                            </small>
                        <?php elseif($publisher->status == 'approved'): ?>
                            <small class="label label-sm bg-primary">
                                <i class="fa fa-star"></i>
                                publisher
                            </small>
                        <?php endif ?>
                    <?php endif ?>
                </h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <img src="<?= base_url('assets/images/images-user/'.$user_image) ?>" width="300" height="300">
                    </div>
                    <div class="col-md-6">
                        <table class="table table-striped table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td style="width: 1em">:</td>
                                    <td style="text-align: left"><?= $user_name ?></td>
                                </tr>
                                <tr>
                                    <td>No. Telepon</td>
                                    <td style="width: 1em">:</td>
                                    <td style="text-align: left"><?= $user_tel ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td style="width: 1em">:</td>
                                    <td style="text-align: left"><?= $user_email ?></td>
                                </tr>
                                <tr>
                                    <td>Biodata Singkat</td>
                                    <td style="width: 1em">:</td>
                                    <td style="text-align: left"><?= $user_bio ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td style="width: 1em">:</td>
                                    <td style="text-align: left"><?= $user_address ?></td>
                                </tr>
                                <tr>
                                    <td>Bergabung</td>
                                    <td style="width: 1em">:</td>
                                    <td style="text-align: left"><?= date('d M Y H:i:s',strtotime($joindate)) ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="<?= site_url('admin/peserta') ?>" class="btn btn-danger"> <i class="fa  fa-arrow-circle-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="box-header with-border">
				<h4><i class="fa fa-ticket"></i> event yang diikuti </h4>
            </div>
            <div class="box-body">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Event</th>
                            <th>Tipe Event</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $start = 0;
                        foreach ($tiket_data as $row) { ?>
                            <tr>
                                <td><?= ++$start ?></td>
                                <td><?= $row->title ?></td>
                                <td><?= $eventType = ($row->type == 0) ? "Free Event" : "Paid Event" ; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Data publisher -->
        <?php if($publisher): ?>
            <div class="box">
                <div class="box-header with-border">
                    <h4><i class="fa fa-user-o"></i> Data Publisher
                    </h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <img src="<?= base_url('assets/images/images-publisher/'.$publisher->image) ?>" width="300" height="300">
                        </div>
                        <div class="col-md-6">
                            <table class="table table-striped table-hover table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Nama</td>
                                        <td style="width: 1em">:</td>
                                        <td style="text-align: left"><?= $publisher->name ?></td>
                                    </tr>
                                    <tr>
                                        <td>No. Telepon</td>
                                        <td style="width: 1em">:</td>
                                        <td style="text-align: left"><?= $publisher->business_number ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td style="width: 1em">:</td>
                                        <td style="text-align: left"><?= $publisher->business_email ?></td>
                                    </tr>
                                    <tr>
                                        <td>Biodata Singkat</td>
                                        <td style="width: 1em">:</td>
                                        <td style="text-align: left"><?= $publisher->short_bio ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td style="width: 1em">:</td>
                                        <td style="text-align: left"><?= $publisher->location ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td style="width: 1em">:</td>
                                        <td style="text-align: left">
                                            <?php if($publisher->status == 'submitted'): ?>
                                            <?= $publisher->status ?> <a href="<?= site_url('admin/publisher/'.$publisher->id.'/approve') ?>" class="label bg-green">approve</a> <a href="#" data-toggle="modal" data-target="#reject" class="label bg-red">reject</a>
                                            <?php elseif($publisher->status == 'approved'): ?>
                                            <a href="#" class="label bg-green"><?= $publisher->status ?> </a> <small>(<?= $publisher->status_description ?>)</small>
                                            <?php else: ?>
                                            <a href="#" class="label bg-red"><?= $publisher->status ?> </a> <small>(<?= $publisher->status_description ?>)</small>   
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bergabung</td>
                                        <td style="width: 1em">:</td>
                                        <td style="text-align: left"><?= date('d M Y H:i:s',strtotime($publisher->created_at)) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="<?= site_url('admin/peserta') ?>" class="btn btn-danger"> <i class="fa  fa-arrow-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <?php if($publisher): ?>
            <?php if($publisher->status == 'approved'): ?>
                <?php if($events_data): ?>
                    <div class="box">
                        <div class="box-header with-border">
                            <h4><i class="fa fa-ticket"></i> event yang dikelola </h4>
                        </div>
                        <div class="box-body">
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Event</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tipe Event</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $start = 0;
                                    foreach ($events_data as $row) { ?>
                                        <tr>
                                            <td><?= ++$start ?></td>
                                            <td><?= $row->title ?></td>
                                            <td><?= date('H:i, d M Y',strtotime($row->start_time)) ?></td>
                                            <td><?= $eventType = ($row->type == 0) ? "Free Event" : "Paid Event" ; ?></td>
                                            <td><?= $row->status ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif ?>
            <?php endif ?>
        <?php endif ?>
    </section>
</div>

<div class="modal fade" id="reject">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Publisher Reject</h4>
			</div>
            <form action="<?= site_url('admin/publisher/'.$publisher->id.'/reject') ?>" method="post">
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
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Reject</button>
                </div>
            </form>
		</div>
	</div>
</div>

<!-- JS -->
<?php $this->load->view('_partials_admin/js'); ?>
<!-- End JS -->

<!-- Footer -->
<?php $this->load->view('_partials_admin/footer'); ?>
<!-- End Footer -->