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
                <h3 style="margin-top:0px"><i class="fa fa-money"></i> Pencairan Dana</h3>
            </div>
            <div class="box-body">

                <div class="row" style="margin-bottom: 10px">
                    <div class="col-md-12 text-center">
                        <div style="margin-top: 8px" id="message">
                            <?= $this->session->userdata('message') ?>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-hover table-striped" id="tabel-pencairan" style="margin-bottom: 10px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Publisher</th>
                            <th>Nama Event</th>
                            <th>Tanggal Mulai</th>
                            <th>Status</th>
                            <th>Pendapatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $start = 0;
                        foreach ($withdraw as $wh) { ?>
                        <tr>
                            <td style="text-align: center"><?= ++$start ?></td>
                            <td><?= $wh['name'] ?></td>
                            <td><?= $wh['title'] ?></td>
                            <td style="text-align: center"><?= date_indo(date("Y-m-d", strtotime($wh['start_time']))) ?></td>
                            <td style="text-align: center">
                                <?php
                                switch ($wh['status']) {
                                    case 'approved':
                                        echo "<label class='badge bg-green'>".$wh['status']."</label>";
                                        break;
                                    case 'rejected':
                                        echo "<label class='badge bg-red'>".$wh['status']."</label>";
                                        break;
                                    default:
                                        echo "<label class='badge bg-yellow'>".$wh['status']."</label>";
                                        break;
                                }
                                ?>
                            </td>
                            <td style="text-align: right"><?= 'Rp. ' . number_format($wh['total_income'],'0','','.') ?></td>
                            <td style="text-align: center">
                                <a href="<?= site_url('admin/pencairan-dana/'.$wh['id']) ?>" class="btn bg-purple btn-xs">
                                    <i class="fa fa-eye"></i>
                                    detail
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
    $(function() {
        $('#tabel-pencairan').DataTable()
    })
</script>
<!-- Footer -->
<?php $this->load->view('_partials_admin/footer'); ?>
<!-- End Footer -->