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
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 style="margin-top:0px"><i class="fa fa-users"></i> User</h3>
            </div>    
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped" id="tabel-user" style="margin-bottom: 10px">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No Telepon</th>
                        <th>Email</th>
                        <th>Status User</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $start = 0;
                    foreach ($users_data as $users) { 
                        $status = ($users->status == 1) ? "<label class='badge bg-green'><i class='fa fa-check'></i> Aktif</label>" : 
                            "<label class='badge bg-red'><i class='fa fa-power-off'></i> Non-Aktif</label>";
                        ?>
                        <tr>
                            <td><?= ++$start ?></td>
                            <td><?= $users->name ?></td>
                            <td><?= $users->phone_number ?></td>
                            <td><?= $users->email ?></td>
                            <td style="text-align: center"><?= $status ?></td>
                            <td style="text-align:center" width="200px">
                                <a href="<?= site_url('admin/peserta/'.$users->id) ?>" class="btn-xs btn-primary"><i class="fa fa-eye"></i> Lihat</a>
                                <?php if ($_SESSION['role'] == 'adm') { ?>
                                    <?php if ($users->status == 1) { ?>
                                        <a href="<?= site_url('admin/peserta/'.$users->id.'/block') ?>" class="btn-xs btn-danger">
                                            <i class="fa fa-power-off"></i> Blokir</a>
                                    <?php } else { ?>
                                        <a href="<?= site_url('admin/peserta/'.$users->id.'/unblock') ?>" class="btn-xs btn-success">
                                            <i class="fa fa-power-off"></i> Buka</a>
                                <?php } } ?>
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
    $('#tabel-user').DataTable()
  })
</script>
<!-- Footer -->
<?php $this->load->view('_partials_admin/footer'); ?>
<!-- End Footer -->