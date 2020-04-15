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
    <div class="flash-data" data-name="Kategori Event" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    <section class="content-header">
    <!-- Breadcrumb -->
    <?php $this->load->view('_partials_admin/breadcrumb'); ?>
    <!-- End Breadcrumb -->
    </section>
    <section class="content">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 style="margin-top:0px"><i class="fa fa-list"></i> Kategori Event</h3>
            </div>    
            <div class="box-body">
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-md-4">
                        <?php if ($_SESSION['role'] == 'adm') { ?>
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambah_kategori">Tambah <i class="fa fa-plus"></i></a>
                        <?php }?>
                    </div>
                    <div class="col-md-8">
                        <div style="margin-top: 8px" id="message">
                            <?= $this->session->userdata('message'); ?>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-hover table-striped" id="tabel-category" style="margin-bottom: 10px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Jumlah digunakan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $start = 0;   
                    foreach ($category_data as $category) { ?>
                        <tr>
                            <td style="width:10%"><?= ++$start ?></td>
                            <td style="text-align:left;width:55%"><?= $category->name ?></td>
                            <td style="text-align:center;width:20%"><?= $category->JumlahEvent ?></td>
                            <?php if ($_SESSION['role'] == 'adm') { ?>
                                <td style="text-align:center" width="200px">
                                    <a href="#" class="btn-xs btn-warning" data-toggle="modal" data-target="#edit_kategori<?= $category->id ?>">Edit</i></a>
                                    <a href="<?= site_url('Admin/Category/delete/'.$category->id) ?>" class="btn-xs btn-danger tombol-hapus">Hapus</i></a>
                                </td>
                            <?php } else { ?><td>-</td><?php } ?>
                        </tr>
                    <?php } ?>
                    </tbody> 
                </table>
            </div>
        </div>
    </section>
</div>

<!-- Modal tambah kategori start -->
    <div class="modal fade" id="tambah_kategori" tabindex="-1" role="dialog" aria-labelledby="tambah_kategoriLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="tambah_kategoriLabel">Add Kategori</h4>
                </div>
                <form class="form-horizontal" action="<?= site_url('Admin/Category/create') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kategori" class="col-sm-4 control-label">Kategori</label>
                        <div class="col-sm-7">
                            <input type="text" name="category_name" class="form-control" id="category_name" placeholder="Kategori" required>
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
<!--  Modal tambah kategori end -->

<!-- Modal update kategori start -->
    <?php foreach ($category_data as $row) {
        $kategori_id = $row->id;
        $kategori_name = $row->name;
    ?>
    <div class="modal fade" id="edit_kategori<?= $kategori_id ?>" tabindex="-1" role="dialog" aria-labelledby="edit_kategoriLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="edit_kategoriLabel">Update Kategori</h4>
                </div>
                <form class="form-horizontal" action="<?= site_url('Admin/Category/update/'.$kategori_id) ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kategori" class="col-sm-4 control-label">Kategori</label>
                        <div class="col-sm-7">
                            <input type="hidden" name="category_id" value="<?= $kategori_id ?>">
                            <input type="text" name="category_name" class="form-control" id="category_name" placeholder="Kategori" value="<?= $kategori_name ?>" required>
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
<!-- Modal update kategori end -->


<!-- JS -->
<?php $this->load->view('_partials_admin/js'); ?>
<!-- End JS -->

<script>
  $(function () {
    $('#tabel-category').DataTable()
  })
</script>
<!-- Footer -->
<?php $this->load->view('_partials_admin/footer'); ?>
<!-- End Footer -->