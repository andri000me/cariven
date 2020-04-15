<!-- Header -->
<?php $this->load->view('_partials_admin/header'); ?>
<!-- End Header -->
<style>
    table, tr>th {
        text-align:center;
    }
</style>
<!-- Navbar -->
<?php $this->load->view('_partials_admin/navbar'); ?>
<!-- End Navbar -->

<!-- Sidebar -->
<?php $this->load->view('_partials_admin/sidebar'); ?>
<!-- End Sidebar -->

<div class="content-wrapper">
    <div class="flash-data" data-name="Kota" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    <section class="content-header">
    <!-- Breadcrumb -->
    <?php $this->load->view('_partials_admin/breadcrumb'); ?>
    <!-- End Breadcrumb -->
    </section>
    <section class="content">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 style="margin-top:0px"><i class="fa fa-home"></i> Kota</h3>
            </div>    
            <div class="box-body">
            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-4">
                    <?php if ($_SESSION['role'] == 'adm') { ?>
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambah_kota">Tambah <i class="fa fa-plus"></i></a>
                    <?php }?>
                </div>
                <div class="col-md-4 text-center">
                    <div style="margin-top: 8px" id="message">
                        <?= $this->session->userdata('message'); ?>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                </div>
            </div>
            <table class="table table-bordered table-hover table-striped" id="tabel-city" style="margin-bottom: 10px">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kota</th>
                        <th>Di Pakai</th>
                        <th>Aksi</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php
                    $start = 0;
                    foreach ($city_data as $city) { ?>
                        <tr>
                            <td style="width: 10%"><?= ++$start ?></td>
                            <td style="text-align:left;width: 45%"><?= $city->name ?></td>
                            <td style="text-align:center;width: 20%"><?= $city->JumlahEvent ?></td>
                            <?php if ($_SESSION['role'] == 'adm') { ?>
                                <td style="text-align:center" width="200px">
                                    <a href="#" class="btn-xs btn-warning" data-toggle="modal" data-target="#edit_kota<?= $city->id ?>">Edit</a>
                                    <a href="<?= site_url('Admin/City/delete/'.$city->id) ?>" class="btn-xs btn-danger tombol-hapus">Hapus</a>
                                </td>
                            <?php } else { ?><td>-</td><?php } ?>
                        </tr>
                    <?php } ?>
                </table>
                </tbody>   
            </div>
        </div>
    </section>
</div>

<!-- Modal tambah kota start -->
    <div class="modal fade" id="tambah_kota" tabindex="-1" role="dialog" aria-labelledby="tambah_kotaLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="tambah_kotaLabel">Add Kota</h4>
                </div>
                <form class="form-horizontal" action="<?= site_url('Admin/City/create') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kategori" class="col-sm-4 control-label">Kota</label>
                        <div class="col-sm-7">
                            <input type="text" name="city_name" class="form-control" id="city_name" placeholder="Misal: Solo" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btn-flat" id="simpan">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<!--  Modal tambah kota end -->

<!-- Modal update kota start -->
    <?php foreach ($city_data as $i) {
        $kota_id = $i->id;
        $kota_nama = $i->name;
    ?>
    <div class="modal fade" id="edit_kota<?= $kota_id ?>" tabindex="-1" role="dialog" aria-labelledby="edit_kotaLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="edit_kotaLabel">Update Kota</h4>
                </div>
                <form class="form-horizontal" action="<?= site_url('Admin/City/update/'.$kota_id) ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kategori" class="col-sm-4 control-label">Kota</label>
                        <div class="col-sm-7">
                            <input type="text" name="city_name" class="form-control" id="city_name" value="<?= $kota_nama ?>" placeholder="Misal: Solo" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning btn-flat" id="simpan">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>
<!--  Modal update kota end -->


<!-- JS -->
<?php $this->load->view('_partials_admin/js'); ?>
<!-- End JS -->

<script>
  $(function () {
    $('#tabel-city').DataTable()
  })
</script>
<!-- Footer -->
<?php $this->load->view('_partials_admin/footer'); ?>
<!-- End Footer -->