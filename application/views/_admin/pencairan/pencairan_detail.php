<!-- Header -->
<?php $this->load->view('_partials_admin/header'); ?>
<!-- End Header -->

<!-- Navbar -->
<?php $this->load->view('_partials_admin/navbar'); ?>
<!-- End Navbar -->

<style>
    th {
        text-align: center;
    }
</style>

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
                <a href="<?= site_url('admin/pencairan-dana') ?>" class="btn btn-default pull-right"><i class="fa fa-reply"></i> Kembali</a>
                <h3 style="margin-top:0px"><i class="fa fa-money"></i> Pencairan Detail</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <img src="<?= base_url('assets/images/images-event/' . $event->image) ?>" width="100%" height="230">
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <?php
                        $startDate = date_indo(date("Y-m-d", strtotime($event->start_time)));
                        $endDate   = date_indo(date("Y-m-d", strtotime($event->end_time)));
                        $createAt  = date("d M Y, H:i:s", strtotime($event->created_at));
                        $startTime = date("H:i", strtotime($event->start_time));
                        $endTime   = date("H:i", strtotime($event->end_time));
                        ?>
                        <h3><?= $event->title ?></h3>
                        <p>
                            <i class="fa fa-calendar"></i> <?= ' ' . $tanggal_event = ($startDate == $endDate) ? $startDate : $startDate . ' - ' . $endDate; ?>
                            <i class="fa fa-clock-o"></i> <?= ' ' . $startTime . ' - ' . $endTime; ?>
                        </p>
                        <p>
                            <i class="fa fa-home"> </i> Alamat<br>
                            <?= $event->location . ', ' . $event->city_name ?>
                        </p>
                        <p>
                            <i class="fa fa-link"></i> <a href="<?= $wd['link'] ?>" target="_blank"> link to drive</a>
                        </p>
                        <p>
                            <i class="fa fa-user"> </i> Publisher: <?= $event->publisher_name ?>
                        </p>
                        <p>
                            <i class="fa fa-money"> </i> <b>Total Dana: <?= 'Rp '. number_format($event->total_income,'0','','.') ?></b>
                        </p>
                        <?php if ($wd['status'] == 'submitted') { ?>
                            <a href="<?= site_url('admin/pencairan-dana/' .$wd['id']. '/approve') ?>" class="btn btn-success" onclick="return confirm('Apakah yakin menyetujui pengajuan ini?')">Disetujui</a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectModal">Ditolak</button>    
                        <?php } else { ?>
                            <button type="button" class="btn btn-success" disabled>Disetujui</button>
                            <button type="button" class="btn btn-danger" disabled>Ditolak</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 style="margin-top:0px">Detail Penjualan tiket</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama ticket</th>
                                    <th>Stok (Sisa)</th>
                                    <th>Terjual</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $start = 0;
                                foreach ($payout_ticket as $pt) {
                                    $stok = $pt->Terjual + $pt->quota;
                                    ?>
                                <tr>
                                    <td style="text-align: center"><?= ++$start ?></td>
                                    <td><?= $pt->ticket_name ?></td>
                                    <td style="text-align: center"><?= number_format($stok, '0', '', '.') . ' (' . number_format($stok - $pt->Terjual, '0', '', '.') . ')' ?></td>
                                    <td style="text-align: center"><?= number_format($pt->Terjual, '0', '', '.') ?></td>
                                    <td style="text-align: right"><?= '@ ' . 'Rp ' . number_format($pt->price, '0', '', '.') ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 style="margin-top:0px">Detail Pembeli tiket</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-hover" id="detail_pembeli">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Booking No</th>
                                    <th>Pembeli</th>
                                    <th>Harga Tiket <i>(asli)</i></th>
                                    <th>Fee Admin</th>
                                    <th>Final Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $start = 0;
                                foreach ($history_payment as $hp) { ?>
                                <tr>
                                    <td style="text-align: center"><?= ++$start ?></td>
                                    <td style="text-align: center"><?= $hp['id'] ?></td>
                                    <td><?= $hp['user_name'] ?></td>
                                    <td style="text-align: right"><?= 'Rp ' . number_format($hp['ticket_price'], '0', '', '.') ?></td>
                                    <td style="text-align: right"><?= 'Rp ' . number_format($hp['fee_admin'], '0', '', '.') ?></td>
                                    <td style="text-align: right"><?= 'Rp ' . number_format($hp['final_price'], '0', '', '.') ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="rejectModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Berikan alasan untuk penolakan ini</h4>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('admin/pencairan-dana/' .$wd['id'].'/reject') ?>" method="post">
                <select name="message" class="form-control" required>
                    <option value="">Pilih alasan</option>
                    <option value="Link tidak valid">Link tidak valid</option>
                    <option value="Event belum selesai">Event belum selesai</option>
                    <option value="Informasi bank publisher tidak valid">Informasi bank publisher tidak valid</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Tolak Pengajuan <i class="fa fa-arrow-right"></i></button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- JS -->
<?php $this->load->view('_partials_admin/js'); ?>
<!-- End JS -->

<script>
    $(function() {
        $('#tabel-peserta').DataTable()
        $('#detail_pembeli').DataTable()
    })
</script>

<!-- Footer -->
<?php $this->load->view('_partials_admin/footer'); ?>
<!-- End Footer -->