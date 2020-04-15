<?php $this->load->view('_partials_admin/header'); ?>

<style>
    th {
        text-align: center;
    }
</style>

<?php $this->load->view('_partials_admin/navbar'); ?>
<?php $this->load->view('_partials_admin/sidebar'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <!-- Breadcrumb -->
        <?php $this->load->view('_partials_admin/breadcrumb'); ?>
        <!-- End Breadcrumb -->
    </section>
    <section class="content">
        <div class="box box-solid">
            <div class="box-header with-border">
                <a href="<?= site_url('admin/pembayaran') ?>" class="btn btn-default pull-right">
                    <i class="fa fa-reply"></i> Kembali
                </a>
                <h3 style="margin-top:0px"><i class="fa fa-money"></i> Detail pembayaran</h3>
                <small>Detail pembayaran untuk <b>kode booking : <?= $detail['booking_id'] ?> </b></small>
                <?php 
                switch ($detail['status']) {
                    case 'booking':
                        echo "<small class='badge bg-purple'> Status : " . $detail['status'] . "</small>";
                        break;
                    case 'paid':
                        echo "<small class='badge bg-yellow'> Status : " . $detail['status'] . "</small>";
                        break;
                    case 'approved':
                        echo "<small class='badge bg-green'> Status : " . $detail['status'] . "</small>";
                        break;
                    case 'rejected':
                        echo "<small class='badge bg-red'> Status : " . $detail['status'] . "</small>";
                        break;
                    default:
                        echo "<small class='badge bg-grey'> Status : " . $detail['status'] . "</small>";
                        break;
                }
                ?>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4><u>Identitas Pemesan</u></h4>
                        <table class="table table-striped">
                            <tr>
                                <td style="width:200px">Kode Booking</td>
                                <td style="width:20px">:</td>
                                <td><?= $detail['booking_id'] ?></td>
                            </tr>
                            <tr>
                                <td style="width:200px">Nama Pemesan</td>
                                <td style="width:20px">:</td>
                                <td><?= $detail['user_name'] ?></td>
                            </tr>
                            <tr>
                                <td style="width:200px">No Telepon</td>
                                <td style="width:20px">:</td>
                                <td><?= $detail['phone_number'] ?></td>
                            </tr>
                        </table>

                        <h4><u>Tiket yang dipesan</u></h4>
                        <table class="table table-striped">
                            <tr>
                                <td style="width:200px">Nama Event</td>
                                <td style="width:20px">:</td>
                                <td><?= $detail['title'] ?></td>
                            </tr>
                            <tr>
                                <td style="width:200px">Nama Tiket</td>
                                <td style="width:20px">:</td>
                                <td><?= $detail['ticket_name'] ?></td>
                            </tr>
                            <tr>
                                <td style="width:200px">Harga Tiket</td>
                                <td style="width:20px">:</td>
                                <td><?= 'Rp. ' . number_format($detail['price'], '0', '', '.') ?></td>
                            </tr>
                        </table>

                        <h4><u>Pembayaran</u></h4>
                        <table class="table table-striped">
                            <tr>
                                <td style="width:200px">Rekening Tujuan</td>
                                <td style="width:20px">:</td>
                                <td><?= $detail['bank_name'] ?></td>
                            </tr>
                            <tr>
                                <td style="width:200px">Nama Rekening Pengirim</td>
                                <td style="width:20px">:</td>
                                <td><?= $detail['account_name'] ?></td>
                            </tr>
                            <tr>
                                <td style="width:200px">Waktu Bayar</td>
                                <td style="width:20px">:</td>
                                <td><?= $detail['created_at'] ?></td>
                            </tr>
                            <tr>
                                <td style="width:200px">Message</td>
                                <td style="width:20px">:</td>
                                <td><?= $detail['message'] ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <a href="<?= base_url('assets/images/images-buktitf/' . $detail['image']) ?>" target="_blank">
                            <img src="<?= base_url('assets/images/images-buktitf/' . $detail['image']) ?>" width="100%" height="450px">
                        </a><br> <br>
                        <?php if ($detail['status'] == "paid") { ?>
                            <a href="<?= site_url('admin/pembayaran/'. $detail['booking_id'].'/setujui') ?>" class="btn btn-success" onclick="return confirm('Yakin ingin menyetujui pembayaran ini?')">Setujui</a>
                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#reject">Tolak</a>
                        <?php }  ?>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<!-- modal reject  -->
<div class="modal fade" id="reject">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tolak Pembayaran</h4>
			</div>
            <form action="<?= site_url('admin/pembayaran/'. $detail['booking_id'].'/tolak') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="radio">
                            <label>
                            <input type="radio" name="status_description" value="Data tidak valid">
                                Data Tidak Valid
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                            <input type="radio" name="status_description" value="Nominal Transfer Tidak Sesuai">
                                Nominal Transfer Tidak Sesuai
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                            <input type="radio" name="status_description" value="Nama Akun Bank Pengirim Tidak Sesuai">
                                Nama Akun Bank Pengirim Tidak Sesuai
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
<!-- end of modal reject -->
<?php $this->load->view('_partials_admin/js'); ?>
<?php $this->load->view('_partials_admin/footer'); ?>