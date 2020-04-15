<!-- Header -->
<?php $this->load->view('_partials_admin/header'); ?>
<!-- End Header -->
<style>
    table,tr>th {
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
    <div class="flash-data" data-name="Kategori Artikel" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    <section class="content-header">
    <!-- Breadcrumb -->
    <?php $this->load->view('_partials_admin/breadcrumb'); ?>
    <!-- End Breadcrumb -->
    </section>
    <section class="content">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 style="margin-top:0px"><i class="fa fa-list-ul"></i> Kategori Artikel</h3>
            </div>    
            <div class="box-body">
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-md-4">
                        <?php if ($_SESSION['role'] == 'adm') { ?>
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambah_kategori">Tambah <i class="fa fa-plus"></i></a>
                        <?php } ?>
                    </div>
                    <div class="col-md-4 text-center">
                        <div style="margin-top: 8px" id="message">
                            <?= $this->session->userdata('message'); ?>
                        </div>
                    </div>
                    <div class="col-md-4 text-right">
                    </div>
                </div>
                <table class="table table-bordered table-hover table-striped" id="tabel-news-category" style="margin-bottom: 10px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori Artikel</th>
                            <th>Di Pakai</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $start = 0;
                        foreach ($news_category_data as $news_category) { ?>
                            <tr>
                                <td style="width:10%"><?= ++$start ?></td>
                                <td style="text-align:left;width:55%"><?= $news_category->name ?></td>
                                <td style="width:20%"><?= $news_category->JumlahArtikel ?></td>
                                <?php if ($_SESSION['role'] == 'adm') { ?>
                                    <td style="text-align:center" width="200px">
                                        <a href="#" class="btn-xs btn-warning" data-toggle="modal" data-target="#edit_kategori<?= $news_category->id ?>">Edit</i></a>
                                        <a href="<?= site_url('Admin/News_category/delete/'.$news_category->id) ?>" class="btn-xs btn-danger tombol-hapus">Hapus</i></a>
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
                <form class="form-horizontal" action="<?= site_url('Admin/News_category/create') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kategori" class="col-sm-4 control-label">Kategori</label>
                        <div class="col-sm-7">
                            <input type="text" name="ncategory_name" class="form-control" id="ncategory_name" placeholder="Kategori Artikel" required>
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

<!-- Modal Edit kategori start -->
    <?php foreach ($news_category_data as $row) {
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
                <form class="form-horizontal" action="<?= site_url('Admin/News_category/update/'.$kategori_id) ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kategori" class="col-sm-4 control-label">Kategori</label>
                        <div class="col-sm-7">
                            <input type="hidden" name="ncategory_name" value="<?= $kategori_id ?>">
                            <input type="text" name="ncategory_name" class="form-control" id="ncategory_name" placeholder="Kategori Artikel" value="<?= $kategori_name ?>" required>
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
<!--  Modal Edit kategori end -->

<!-- JS -->
<?php $this->load->view('_partials_admin/js'); ?>
<!-- End JS -->

<script>
  $(function () {
    $('#tabel-news-category').DataTable()
  })
</script>
<!-- Footer -->
<?php $this->load->view('_partials_admin/footer'); ?>
<!-- End Footer -->