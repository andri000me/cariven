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
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 style="margin-top:0px"><i class="fa fa-user"></i> Admin</h3>
            </div>    
            <div class="box-body">
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-md-4">
                        <?= anchor(site_url('admin/admin/tambah'),'Tambah <i class="fa fa-plus"></i>', 'class="btn btn-primary"'); ?>
                    </div>
                    <div class="col-md-4 text-center">
                        <div style="margin-top: 8px" id="message">
                            <?= $this->session->userdata('message'); ?>
                        </div>
                    </div>
                    <div class="col-md-4 text-right">
                    </div>
                </div>
                <table class="table table-bordered table-hover table-striped" id="tabel-admin" style="margin-bottom: 10px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>No HP</th>
                            <th>Foto Profil</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $start = 0;
                        foreach ($admin_data as $admin) {
                            $status = ($admin->status == 1) ? "<label class='badge bg-green'><i class='fa fa-check'></i> Aktif</label>" : "<label class='badge bg-black'><i class='fa fa-power-off'></i> Non-Aktif</label>" ;
                            ?>
                            <tr>
                                <td><?= ++$start ?></td>
                                <td><?= $admin->name ?></td>
                                <td><?= $admin->email ?></td>
                                <td><?= $admin->password ?></td>
                                <td><?= $admin->phone_number ?></td>
                                <td><img src="<?= base_url('assets/images/images-user/'.$admin->profile_picture) ?>" width="150" height="100"></td>
                                <td><?= $status ?></td>
                                <td style="text-align:center" width="200px">
                                    <a href="<?= site_url('admin/admin/'.$admin->id.'/edit') ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <a href="<?= site_url('admin/admin/'.$admin->id.'/delete') ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="return confirm('Apakah ingin mengahapus data ini ?')"> <i class="fa fa-trash-o"></i>
                                    </a> <br>
                                    <?php if ($admin->status == 1) { ?>
                                        <a href="#" class="btn btn-sm btn-success" disabled>Buka</a>
                                        <a href="<?= site_url('admin/admin/'.$admin->id.'/block') ?>" class="btn btn-sm btn-github" onclick="return confirm('Apakah ingin menonaktifkan admin ini ?')">Blokir</a>
                                    <?php } else { ?>
                                        <a href="<?= site_url('admin/admin/'.$admin->id.'/unblock') ?>" class="btn btn-sm btn-success" onclick="return confirm('Apakah ingin mengaktifkan admin ini ?')">Buka</a>
                                        <a href="#" class="btn btn-sm btn-github" disabled>Blokir</a>
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
    $('#tabel-admin').DataTable()
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
<!-- Footer -->
<?php $this->load->view('_partials_admin/footer'); ?>
<!-- End Footer -->