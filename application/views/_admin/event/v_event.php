<!-- Header -->
<?php $this->load->view('_partials_admin/header'); ?>
<!-- End Header -->

<style>
th {
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
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 style="margin-top:0px"><i class="fa fa-calendar-o"></i> Event</h3>
            </div>    
            <div class="box-body">

            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-12 text-center">
                    <div style="margin-top: 8px" id="message">
                        <?= $this->session->userdata('message'); ?>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-hover table-striped" id="tabel-event" style="margin-bottom: 10px">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Event</th>
                        <th>Publisher</th>
                        <th>Tanggal Mulai</th>
                        <th>Tipe Event</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $start = 0;
                    foreach ($event_data as $event) { 
                        $newDate = date_indo(date("Y-m-d", strtotime($event->start_time)));
                        ?>
                        <tr>
                            <td style="text-align:center"><?= ++$start ?></td>
                            <td><?= $event->title ?></td>
                            <td style="text-align:center"><?= $event->name ?></td>
                            <td style="text-align:center"><?= $newDate ?></td>
                            <td style="text-align:center"><?= $tipeEvent = ($event->type == 0) ? "Gratis" : "Berbayar" ; ?></td>
                            <?php if ($event->status == "submitted") { ?>
                                <td><label class="badge bg-yellow"><?= $event->status ?></label></td>
                            <?php } elseif($event->status == "approved") { ?>
                                <td><label class="badge bg-green"><?= $event->status ?></label></td>
                            <?php } elseif($event->status == "rejected") { ?>
                                <td><label class="badge bg-red"><?= $event->status ?></label></td>
                            <?php } ?>
                            <td style="text-align:center" width="130px">
                                    <a href="<?= site_url('admin/event/'.$event->event_id) ?>" class="btn-xs btn-primary">
                                        <i class="fa fa-eye"></i> Lihat</a>
                                <?php if ($event->status != 'approved') { ?>
                                    <a href="<?= site_url('admin/event/'.$event->event_id.'/hapus') ?>" class="btn-xs btn-danger tombol-hapus"><i class="fa fa-trash-o"></i> Hapus</a>
                                <?php } ?>
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
    $('#tabel-event').DataTable()
  })
</script>
<!-- Footer -->
<?php $this->load->view('_partials_admin/footer'); ?>
<!-- End Footer -->