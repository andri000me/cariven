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
    <div class="flash-data" data-name="Bank" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    <section class="content-header">
    <!-- Breadcrumb -->
    <?php $this->load->view('_partials_admin/breadcrumb'); ?>
    <!-- End Breadcrumb -->
    </section>
    <section class="content">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 style="margin-top:0px"><i class="fa fa-bank"></i> Bank</h3>
            </div>    
            <div class="box-body">
                
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-md-4">
                        <?php if ($_SESSION['role'] == 'adm') { ?>
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambah_bank">Tambah <i class="fa fa-plus"></i></a>
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
                <table class="table table-bordered table-hover table-striped" id="tabel-bank" style="margin-bottom: 10px">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bank</th>
                        <th>Nama Rekening</th>
                        <th>No Rekening</th>
                        <th>Jumlah Transfer</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $start = 0;
                    foreach ($bank_data as $bank) { ?>
                        <tr>
                            <td style="width:10%"><?= ++$start ?></td>
                            <td style="text-align:left;width: 20%"><?= $bank['bank_name'] ?></td>
                            <td style="width:20%"><?= $bank['account_name'] ?></td>
                            <td style="width:20%"><?= $bank['account_number'] ?></td>
                            <td style="width:20%"><?= $bank['jumlah'] ?></td>
                            <?php if ($_SESSION['role'] == 'adm') { ?>
                                <td style="text-align:center" width="200px">
                                    <a href="#" class="btn-xs btn-warning" data-toggle="modal" data-target="#edit_bank<?= $bank['id'] ?>">Edit</i></a>
                                    <a href="<?= site_url('Admin/Bank/delete/'.$bank['id']) ?>" class="btn-xs btn-danger tombol-hapus">Hapus</i></a>
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
    <div class="modal fade" id="tambah_bank" tabindex="-1" role="dialog" aria-labelledby="tambah_bankLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="tambah_bankLabel">Add Bank</h4>
                </div>
                <form class="form-horizontal" action="<?= site_url('Admin/Bank/create') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kategori" class="col-sm-4 control-label">Bank</label>
                        <div class="col-sm-7">
                            <input type="text" name="bank_name" class="form-control" id="bank_name" placeholder="Misal: CIMB NIAGA" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kategori" class="col-sm-4 control-label">Nama Rekening</label>
                        <div class="col-sm-7">
                            <input type="text" name="bank_accname" class="form-control" placeholder="Masukan Nama Pemegang Rekening" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kategori" class="col-sm-4 control-label">No Rekening</label>
                        <div class="col-sm-7">
                            <input type="number" name="bank_accno" class="form-control" placeholder="Masukan Nomor Rekening" required>
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
    <?php foreach ($bank_data as $row) {
        $bank_id = $row['id'];
        $bank_name = $row['bank_name'];
        $bank_accname = $row['account_name'];
        $bank_accno = $row['account_number'];
    ?>
    <div class="modal fade" id="edit_bank<?= $bank_id ?>" tabindex="-1" role="dialog" aria-labelledby="edit_bankLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="edit_bankLabel">Update Bank</h4>
                </div>
                <form class="form-horizontal" action="<?= site_url('Admin/Bank/update/'.$bank_id) ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kategori" class="col-sm-4 control-label">Bank</label>
                        <div class="col-sm-7">
                            <input type="text" name="bank_name" class="form-control" id="bank_name" placeholder="Misal: CIMB NIAGA" value="<?= $bank_name ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kategori" class="col-sm-4 control-label">Nama Rekening</label>
                        <div class="col-sm-7">
                            <input type="text" name="bank_accname" class="form-control" id="bank_accname" placeholder="Misal: CIMB NIAGA" value="<?= $bank_accname ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kategori" class="col-sm-4 control-label">No Rekening</label>
                        <div class="col-sm-7">
                            <input type="text" name="bank_accno" class="form-control" id="bank_accno" placeholder="Misal: CIMB NIAGA" value="<?= $bank_accno ?>" required>
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
    $('#tabel-bank').DataTable()
  })
</script>
<!-- Footer -->
<?php $this->load->view('_partials_admin/footer'); ?>
<!-- End Footer -->