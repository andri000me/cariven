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
            <div class="row justify-content-center" style="margin-bottom: 100px">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <h4><?= $title ?></h4>
                            <ul class="nav nav-tabs mb-3" id="tab" role="tablist">
                                <?php $this->load->view('_partials/navbar_manage'); ?>
                            </ul>
                            <div class="tab-content" id="tabContent">
                                <div class="tab-pane fade show active" id="kedatangan" role="tabpanel" aria-labelledby="pills-kedatangan-tab">
                                    <div class="row">
                                        <div class="col-6">
                                            <h3 style="margin-bottom: 0px">Scan kedatangan by sistem</h3>
                                            <a href="<?= site_url('manage/'.$id.'/scan-kedatangan') ?>" class="btn btn-dark my-3">
                                                <i class="fa fa-qrcode"></i> Scan Kedatangan
                                            </a>
                                            <hr>
                                            <h3 style="margin-bottom: 0px">Absnesi Manual</h3>
                                            <a href="<?= site_url('manage/'.$id.'/absensi-manual') ?>" class="btn btn-success my-3">
                                                <i class="fa fa-download"></i> Absensi Manual
                                            </a> <br>
                                            <small>Untuk melakukan absensi manual, silahkan download file diatas</small>
                                        </div>
                                        <div class="col-6">
                                            <div class="card border-dark mb-3">
                                                <div class="card-body text-dark">
                                                    <h5 class="card-title">Perhatian</h5>
                                                    <p class="card-text">
                                                        <ul>
                                                            <li>
                                                                <b style="color:inherit">Scan kedatangan by sistem</b> adalah fungsi yang kami sediakan untuk melakukan scan kehadiran
                                                                menggunakan sistem ini, publisher diharapkan menyediakan alat scan qrcode. Saat ini kami 
                                                                sedang mengembangkan alat scan berupa aplikasi android. <b style="color:inherit">Fungsi ini hanya bisa digunakan pada hari event dimulai.</b>
                                                            </li>
                                                            <li>
                                                                <b style="color:inherit">Absensi manual</b> adalah alternatif presensi kehadiran dengan cara membubuhkan tanda tangan
                                                            </li>
                                                        </ul>
                                                    </p>
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
</main>

<!-- modal upload background -->
<div class="modal fade" id="uploadBackground" tabindex="-1" role="dialog" aria-labelledby="uploadBackgroundLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadBackgroundLabel">Upload Background</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ini nanti halaman upload background
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- modal show template -->
<div class="modal fade" id="showTemplate" tabindex="-1" role="dialog" aria-labelledby="showTemplateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="showTemplateLabel">Contoh Template</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ini nanti halaman contoh template
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
</script>

<!-- Footer -->
<?php $this->load->view('_partials/endfile'); ?>
<!-- End Footer -->