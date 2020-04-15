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
    <div class="flash-data" data-name="Artikel" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    <section class="content-header">
    <!-- Breadcrumb -->
    <?php $this->load->view('_partials_admin/breadcrumb'); ?>
    <!-- End Breadcrumb -->
    </section>
    <section class="content">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 style="margin-top:0px"><i class="fa fa-newspaper-o"></i> Berita</h3>
            </div>    
            <div class="box-body">
            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-4">
                    <?php if ($_SESSION['role'] == 'adm') { ?>
                    <a href="<?= site_url('admin/artikel/tambah') ?>" class="btn btn-primary">
                        Tambah <i class="fa fa-plus"></i>
                    </a>
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
            <table class="table table-bordered table-hover table-striped" id="tabel-news" style="margin-bottom: 10px">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>By</th>
                        <th>Dibaca</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $start = 0;
                    foreach ($news_data as $news) { 
                        $dateCreated = date("H:i M d, Y", strtotime($news->created_at));
                        ?>
                        <tr>
                            <td style="text-align:center;width:80px"><?= ++$start ?></td>
                            <td style="text-align:center"><?= $news->title ?></td>
                            <td style="text-align:center"><?= $news->category_name ?></td>
                            <td style="text-align:center"><?= $dateCreated ?></td>
                            <td style="text-align:center"><?= $news->created_by ?></td>
                            <td style="text-align: center"><?= number_format($news->views_count,'0','',',') ?></td>
                            <td style="text-align:center" width="120px">
                                <?php if ($_SESSION['role'] == 'adm') { ?>
                                    <a href="<?= site_url('admin/artikel/'.$news->id.'/edit') ?>" class="btn-xs btn-warning">
                                        <i class="fa fa-pencil"></i> Edit</a>
                                    <a href="<?= site_url('admin/artikel/'.$news->id.'/hapus') ?>" class="btn-xs btn-danger tombol-hapus"><i class="fa fa-trash-o"></i> hapus</a>
                                <?php } else { ?>
                                    <a href="#" class="btn-xs btn-primary" data-toggle="modal" data-target="#lihat_artikel<?= $news->id ?>">
                                        <i class="fa fa-eye"></i> Lihat Artikel</a>
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

<!-- Modal lihat berita start -->
    <?php foreach ($news_data as $row) {
        $news_id    = $row->id;
        $judul      = $row->title;
        $isi_berita = $row->content;
        $gambar = $row->image;
    ?>
    <div class="modal fade" id="lihat_artikel<?= $news_id ?>" tabindex="-1" role="dialog" aria-labelledby="hapus_bankLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="hapus_bankLabel"><?= $judul ?></h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <p><img src="<?= base_url('assets/images/images-berita/'.$gambar) ?>" width="100%" height="400" alt="" srcset="">
                            <?= $isi_berita ?></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
<!-- Modal lihat berita end -->

<!-- JS -->
<?php $this->load->view('_partials_admin/js'); ?>
<!-- End JS -->

<script>
  $(function () {
    $('#tabel-news').DataTable()
  })
</script>
<!-- Footer -->
<?php $this->load->view('_partials_admin/footer'); ?>
<!-- End Footer -->
    