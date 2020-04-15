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
<!-- Datatable End -->
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample10" aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-md-end" id="navbarsExample10">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="" data-toggle="tooltip" data-placement="top" title="Refresh">
                        <i class="fa fa-refresh"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= site_url('manage/'.$event_id.'/kedatangan') ?>">
                        <i class="fa fa-reply"></i> Kembali
                    </a>
                </li>
            </ul>
        </div>
    </nav>

<main id="main">
    <div class="container" style="margin-top:30px">
        <div class="row">
            <div class="col-12" style="margin-bottom: 20px; margin-left:15px">
                <h2>Scan Kedatangan</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="row justify-content-center">
                    <div class="col-11">
                        <div class="card shadow">
                            <div class="card-body text-center">
                                <h5 class="text-center">Masukan kode booking</h5>
                                <hr>
                                <form action="<?= site_url('Publisher/ManageEvent/scan_kedatangan_action/'.$event_id) ?>" method="post">
                                    <small>Masukan QR Code yang terdapat di tiket</small> <br> <br>
                                    <input type="text" name="qrcode" id="qrcode" class="form-control" maxlength="5" placeholder="misal: QRC0d3" autofocus required>
                                    <br>
                                    <button type="submit" name="submit" class="btn btn-primary btn-block mt-30">SUBMIT</button>
                                </form>
                            </div>
                            <?php 
                            if ($this->session->userdata('kedatangan-msg') <> '') { ?>
                                <div class="card-footer">
                                    <div class="alert alert-danger" role="alert">
                                        <?= $this->session->userdata('kedatangan-msg') ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <table class="table table-striped table-bordered table-hover" id="kedatangan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Waktu Datang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $start = 0;
                        foreach ($kedatangan_data as $row) { ?>
                            <tr>
                                <td style="text-align: center;width:50px"><?= ++$start ?></td>
                                <td style="width:400px"><?= $row->name ?></td>
                                <td style="text-align: center"><?= $row->attend_time ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Header -->
    <?php $this->load->view('_partials/js'); ?>
<!-- End Header -->


<!-- Datatable Start -->
<script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.bootstrap4.min.js') ?>"></script>
<script>
$(document).ready(function() {
   $('#kedatangan').DataTable() ;
});
</script>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

<!-- Header -->
    <?php $this->load->view('_partials/endfile'); ?>
<!-- End Header -->
