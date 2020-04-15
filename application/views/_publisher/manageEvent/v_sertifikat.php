<!-- Header -->
<?php $this->load->view('_partials/header'); ?>
<!-- End Header -->

<style>
table th {
    text-align: center;
}
</style>

<!-- Datatable Start -->
<link rel="stylesheet" href="<?= base_url('assets/css/dataTables.bootstrap4.min.css') ?>">

<!-- Navbar -->
<?php $this->load->view('_partials/navbar'); ?>
<!-- End Navbar -->

<div class="popular_courses"></div>

<main id="main">
    <section id="about">
        <div class="container">
            <div class="row justify-content-center" style="margin-bottom: 100px">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <h4><?= $title ?></h4>
                            <ul class="nav nav-tabs mb-3" id="tab" role="tablist">
                                <?php $this->load->view('_partials/navbar_manage'); ?>
                            </ul>
                            <div class="tab-content" id="tabContent">
                                <div class="tab-pane fade show active" id="sertifikat" role="tabpanel" aria-labelledby="pills-sertifikat-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <?= $this->session->flashdata('message'); ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <img src="<?= base_url('assets/images/images-certificate/'.$bgcertificate) ?>" alt="image" 
                                            width="100%" height="250rem">
                                        </div>
                                        <div class="col-lg-6">
                                            <a href="" class="btn btn-warning my-2"  data-toggle="modal" data-target="#uploadBackground"><i class="fa fa-edit"></i> Upload Background</a>
                                            <a href="<?= site_url('manage/'.$id.'/ambil-sertifikat') ?>" class="btn btn-dark my-2"><i class="fa fa-qrcode"></i> Scan Pengambilan</a>
                                            <a href="<?= site_url('manage/'.$id.'/sertifikat') ?>" class="btn btn-outline-primary my-2"><i class="fa fa-refresh"></i></a>
                                            <div class="card border-dark mb-3">
                                                <div class="card-body text-dark">
                                                    <h5 class="card-title">Perhatian</h5>
                                                    <p class="card-text">Kami sudah menyediakan template bawaan <strong>sebagai alternatif</strong>, publisher
                                                        hanya tinggal melakukan upload background sesuai event yang sedang dikelola.
                                                        Pastikan sudah ada tanda tangan. lihat template <a href="" data-toggle="modal" data-target="#showTemplate">klik disini</a>
                                                        atau <a href="<?= site_url('Publisher/ManageEvent/download_sertifikat') ?>">unduh disini</a>.
                                                    </p>
                                                </div>
                                            </div>
                                            <?php if ($bgcertificate != 'certif-bg-default.png') { ?>
                                                <a href="<?= site_url('manage/'.$id.'/tes-print') ?>" data-toggle="tooltip" data-placement="top" title="Tes print sertifikat"
                                                    class="badge badge-primary"><i class="fa fa-edit"></i> Tes Print
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row my-3">
                                        <div class="col-12">
                                            <h3>Data Peserta</h3>
                                            <table id="tabel-peserta" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kode</th>
                                                        <th>Nama Peserta</th>
                                                        <th>Waktu Datang</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $start = 0;
                                                    foreach ($peserta as $row) { ?>
                                                    <tr>
                                                        <td style="width:50px;text-align:center"><?= ++$start ?></td>
                                                        <td style="text-align:center"><?= $row->id ?></td>
                                                        <td><?= $row->name ?></td>
                                                        <td style="text-align:center"><?= $tanggal = ($row->attend == 1) ? date('H:i - d M Y', strtotime($row->attend_time)) : '-'; ?></td>
                                                        <td style="width:150px; text-align: center">
                                                            <?php
                                                            if ($bgcertificate != 'certif-bg-default.png') { ?>
                                                                <a href="<?= site_url('manage/'.$row->id.'/print-for-user') ?>" class="badge badge-primary">
                                                                <i class="fa fa-print"></i> Cetak</a>
                                                            <?php } else { ?>
                                                                <label class="badge badge-secondary"><i class="fa fa-print"></i> Cetak</label>
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

<!-- modal upload background -->
<div class="modal fade" id="uploadBackground" tabindex="-1" role="dialog" aria-labelledby="uploadBackgroundLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= site_url('manage/'.$id.'/tambah-sertifikat') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadBackgroundLabel">Upload Background</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="uploadBackground">Silahkan upload background sertifikat anda</label>
                    <input type="file" name="bgcertificate" id="bgcertificate" class="form-control-file" required>
                    <small class="text-danger">* Ukuran maksimal 500kb</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- modal show template -->
<div class="modal fade" id="showTemplate" tabindex="-1" role="dialog" aria-labelledby="showTemplateLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showTemplateLabel">Contoh Template</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url('assets/images/images-certificate/templates.png') ?>" 
                alt="image" width="100%" height="100%">
                <p style="margin-bottom: 0px">Ukuran A4 Landscape (L: 2.480px, P: 3.508px / L: 21cm, P: 29.7cm) <br>
                    Sesuaikan background anda dengan mengikuti template diatas
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

<!-- Datatable Start -->
<script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.bootstrap4.min.js') ?>"></script>

<script>
    $(document).ready(function() {
        $('#tabel-peserta').DataTable();
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $("#message").fadeTo(2000, 500).slideUp(500, function(){
        $("#message").slideUp(500);
    });
</script>
<!-- Footer -->
<?php $this->load->view('_partials/endfile'); ?>
<!-- End Footer -->