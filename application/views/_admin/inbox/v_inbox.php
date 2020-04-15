<!-- Header -->
<?php $this->load->view('_partials_admin/header'); ?>
<!-- End Header -->
<style>
table th {
    text-align: center;
}
</style>
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
        <?= $this->session->flashdata('email_send') ?>

        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 style="margin-top:0px"><i class="fa fa-envelope"></i> Kotak Masuk</h3>
            </div>    
            <div class="box-body">

            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-12 col-xs-12">
                    <div style="margin-top: 8px" id="message">
                        <?= $this->session->userdata('message'); ?>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-hover table-striped" id="tabel-inbox" style="margin-bottom: 10px">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Isi / Pesan</th>
                        <th>Dikirim</th>
                        <th>Status</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $start = 0;
                    foreach ($inbox_data as $inbox) { 
                        $inboxCreated = date('d M Y H:i:s', strtotime($inbox->created_at));
                    ?>
                        <tr>
                            <td><?= ++$start ?></td>
                            <td><?= $inbox->name ?></td>
                            <td><?= $inbox->email ?></td>
                            <td><?= $inbox->content ?></td>
                            <td><?= $inboxCreated ?></td>
                            <td>
                            <?php if ($inbox->is_read == 1) { 
                                if ($inbox->reply_message == NULL) { ?>
                                    <label class='badge bg-green'><i class='fa fa-check'></i> Dibaca</label> <br>
                                    <label class='badge bg-orange'><i class='fa fa-clock-o'></i> Belum dibalas</label>
                                <?php } else { ?>
                                    <label class='badge bg-green'><i class='fa fa-check'></i> Dibaca</label> <br>
                                    <label class='badge bg-blue'><i class='fa fa-check'></i> Dibalas</label>
                                <?php } } else { ?>
                                    <label class='badge'>Belum dibaca</label>
                            <?php } ?>
                            </td>
                            <td style="text-align:center" width="100px">
                                <?php if ($_SESSION['role'] == 'adm') { ?>
                                    <a href="<?= site_url('admin/pesan-masuk/'.$inbox->id) ?>" class="btn btn-primary"
                                        data-toggle="tooltip" data-placement="top" title="Balas">
                                        <i class="fa fa-reply"></i>
                                    </a>
                                <?php } elseif ($_SESSION['role'] == 'man') { ?>
                                    <a href="<?= site_url('admin/pesan-masuk/'.$inbox->id) ?>" class="btn btn-primary"
                                        data-toggle="tooltip" data-placement="top" title="Lihat">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                <?php } ?>
                                <a href="<?= site_url('admin/pesan-masuk/'.$inbox->id.'/hapus') ?>" class="btn btn-danger" onclick="return confirm('Apakah anda ingin menghapus ?')"
                                    data-toggle="tooltip" data-placement="top" title="Hapus">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>    
            </div>
        </div>
    </section>
</div>

<!-- JS -->
<?php $this->load->view('_partials_admin/js'); ?>
<!-- End JS -->
<script>
  $(function () {
    $('#tabel-inbox').DataTable()
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
<!-- Footer -->
<?php $this->load->view('_partials_admin/footer'); ?>
<!-- End Footer -->