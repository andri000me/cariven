<?php $this->load->view('_partials_admin/header'); ?>

<style>
    th {
        text-align: center;
    }
</style>

<?php $this->load->view('_partials_admin/navbar'); ?>
<?php $this->load->view('_partials_admin/sidebar'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <!-- Breadcrumb -->
        <?php $this->load->view('_partials_admin/breadcrumb'); ?>
        <!-- End Breadcrumb -->
    </section>
    <section class="content">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 style="margin-top:0px"><i class="fa fa-calendar-o"></i> Pembayaran</h3>
                <small>Untuk melakukan approval Pembayaran, silahkan masuk ke menu detail</small>
            </div>
            <div class="box-body">

                <div class="row" style="margin-bottom: 10px">
                    <div class="col-md-12 text-center">
                        <div style="margin-top: 8px" id="message">
                            <?= $this->session->userdata('message'); ?>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-hover table-striped" id="tabel-pembayaran" style="margin-bottom: 10px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Booking</th>
                            <th>Nama Pengirim</th>
                            <th>Nama Event</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $start = 0;
                        foreach ($payment as $row) { ?>

                            <tr>
                                <td style="text-align:center"><?= ++$start ?></td>
                                <td style="text-align:center; width: 130px"><?= $row['booking_id'] ?></td>
                                <td><?= $row['user_name'] ?></td>
                                <td><?= $row['title'] ?></td>
                                <td style="text-align:center"><?= $row['created_at'] ?></td>
                                <td style="text-align:center">
                                    <?php
                                    switch ($row['status']) {
                                        case 'booking':
                                            echo "<small class='badge bg-purple'>" . $row['status'] . "</small>";
                                            break;
                                        case 'paid':
                                            echo "<small class='badge bg-yellow'>" . $row['status'] . "</small>";
                                            break;
                                        case 'approved':
                                            echo "<small class='badge bg-green'>" . $row['status'] . "</small>";
                                            break;
                                        case 'rejected':
                                            echo "<small class='badge bg-red'>" . $row['status'] . "</small>";
                                            break;
                                        default:
                                            echo "<small class='badge bg-grey'>" . $row['status'] . "</small>";
                                            break;
                                    }
                                    ?>
                                </td>
                                <td style="text-align:center">
                                    <a href="<?= site_url('admin/pembayaran/'.$row['id']) ?>" class="label bg-primary">
                                        <i class="fa fa-eye"></i>
                                        Detail
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

<?php $this->load->view('_partials_admin/js'); ?>

<script>
    $(function() {
        $('#tabel-pembayaran').DataTable()
    })
</script>

<?php $this->load->view('_partials_admin/footer'); ?>