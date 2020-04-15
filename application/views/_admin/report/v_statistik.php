<!-- Header -->
<?php $this->load->view('_partials_admin/header'); ?>
<!-- End Header -->

<style>
.user-square {
  height: 10px;
  width: 20px;
  background-color: #f3c300;
  display:inline-block
}

.pub-square {
  height: 10px;
  width: 20px;
  background-color: #875692;
  display:inline-block
}

#user-publisher {
  width: 100%;
  height: 200px;
}
</style>

<!-- Navbar -->
<?php $this->load->view('_partials_admin/navbar'); ?>
<!-- End Navbar -->

<!-- Sidebar -->
<?php $this->load->view('_partials_admin/sidebar'); ?>
<!-- End Sidebar -->

<div class="content-wrapper">
    <div class="content">
        <!-- registrasi user dan publisher -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h4>Data Pengguna</h4>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>  
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div id="user-publisher"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-striped">
                                    <tr><td colspan="3"><div class="user-square"></div> User / Peserta Event</td></tr>
                                    <tr>
                                        <th width="100" style="text-align: center">Total User</th>
                                        <th width="100" style="text-align: center">User Aktif</th>
                                        <th width="100" style="text-align: center">User Non-aktif</th>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center"><?= $userGraph ?> Orang</td>
                                        <td style="text-align: center"><?= $userActive ?> Orang</td>
                                        <td style="text-align: center"><?= $userNonActive ?> Orang</td>
                                    </tr>
                                </table>

                                <table class="table table-striped">
                                    <tr><td colspan="3"><div class="pub-square"></div> Publisher / Penyelenggara Event</td></tr>
                                    <tr>
                                        <th width="100" style="text-align: center">Total Publisher</th>
                                        <th width="100" style="text-align: center">Submitted</th>
                                        <th width="100" style="text-align: center">Approved</th>
                                        <th width="100" style="text-align: center">Rejected</th>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center"><?= $pubGraph ?> Orang</td>
                                        <td style="text-align: center"><?= $pubSubmitted ?> Orang</td>
                                        <td style="text-align: center"><?= $pubApproved ?> Orang</td>
                                        <td style="text-align: center"><?= $pubRejected ?> Orang</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- laporan event -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4>Laporan Event</h4>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>  
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon"><i class="fa fa-calendar-o"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Draf</span>
                                        <span class="info-box-number"><?= $countDraf ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-aqua"><i class="fa fa-calendar-plus-o"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Diajukan</span>
                                        <span class="info-box-number"><?= $countDiajukan ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="fa fa-calendar-check-o"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Disetujui</span>
                                        <span class="info-box-number"><?= $countDisetujui ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-red"><i class="fa fa-calendar-times-o"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Ditolak</span>
                                        <span class="info-box-number"><?= $countDitolak ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="nav-tabs-custom my-5">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#top_peserta" data-toggle="tab">Event Peserta Terbanyak</a></li>
                                <li><a href="#top_penjualan" data-toggle="tab">Event Pendapatan terbanyak</a></li>
                                <li><a href="#top_kota_kategori" data-toggle="tab">Kategori dan Kota</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="top_peserta">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-dismissible" style="background-color: #D81B60; color: white">
                                                Event dengan <b>peserta</b> terbanyak
                                            </div>
                                            <table class="table table-striped table-hover table-bordered text-center" id="top-event-peserta">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Event</th>
                                                        <th>Tanggal Dimulai</th>
                                                        <th>Jummlah Peserta</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $start = 0;
                                                    foreach ($topPeserta as $row) { ?>
                                                    <tr>
                                                        <td><?= ++$start ?></td>
                                                        <td><?= $row->title ?></td>
                                                        <td><?= date('H:i M d, Y', strtotime($row->start_time)) ?></td>
                                                        <td><?= $row->jumlah_peserta ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="top_penjualan">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="alert bg-purple alert-dismissible">
                                            Event dengan <b>pendapatan</b> terbanyak
                                        </div>
                                            <table class="table table-striped table-hover table-bordered text-center" id="top-event-pendapatan">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Event</th>
                                                        <th>Tanggal Dimulai</th>
                                                        <th>Pendapatan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $start = 0;
                                                    $total = 0;
                                                    foreach ($topPendapatan as $row) { ?>
                                                    <tr>
                                                        <td><?= ++$start ?></td>
                                                        <td><?= $row->title ?></td>
                                                        <td><?= date('H:i M d, Y', strtotime($row->start_time)) ?></td>
                                                        <td style="text-align: left"><?= 'Rp ' . number_format($row->jumlah_pendapatan,'0','','.') .',-' ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="top_kota_kategori">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4>Top Kategori</h4>
                                            <table class="table table-striped table-hover table-bordered text-center">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kategori</th>
                                                        <th>Jumlah dipakai</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $start = 0;
                                                    foreach ($kategori_data as $row) { ?>
                                                        <tr>
                                                            <td><?= ++$start ?></td>
                                                            <td style="text-align: left"><?= $row->name ?></td>
                                                            <td><?= $row->jumlah_event ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <h4>Top Kota</h4>
                                            <table class="table table-striped table-hover table-bordered text-center">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kota</th>
                                                        <th>Jumlah ditempati</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $start = 0;
                                                    foreach ($kota_data as $row) { ?>
                                                        <tr>
                                                            <td><?= ++$start ?></td>
                                                            <td style="text-align: left"><?= $row->name ?></td>
                                                            <td><?= $row->jumlah_event ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
                        <div class="row">
                            <div class="col-md-12">
                                Total event yang tercatat dalam sistem adalah : <strong><?= number_format($countAllEvent,'0','','.') ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top user dan publisher -->
        <div class="row">
            <div class="col-xs-4">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <i class="fa fa-user-o"></i>Top Publisher
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>  
                    </div>
                    <div class="box-body" style="height:280px">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Publisher</th>
                                    <th>Jumlah Event</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $start = 0;
                                foreach ($publisher_data as $row) { ?>
                                <tr>
                                    <td><?= ++$start ?></td>
                                    <td><?= $row->name ?></td>
                                    <td class="text-center"><?= $row->jumlah_event ?>
                                    <a href="<?= site_url('admin/peserta/'.$row->pub_id) ?>" class="btn-xs btn-primary pull-right" data-toggle="tooltip" 
                                        data-placement="top" title="detail publisher"><i class="fa fa-eye"></i>
                                    </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <i class="fa fa-users"></i>Top usher
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>  
                    </div>
                    <div class="box-body" style="height:280px">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Jumlah Tiket</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $start = 0;
                                foreach ($user_data as $row) { ?>
                                    <tr>
                                        <td><?= ++$start ?></td>
                                        <td><?= $row->name ?></td>
                                        <td class="text-center"><?= $row->jumlah_tiket ?>
                                        <a href="<?= site_url('admin/peserta/'.$row->user_id) ?>" class="btn-xs btn-primary pull-right" data-toggle="tooltip" 
                                            data-placement="top" title="detail user"><i class="fa fa-eye"></i>
                                        </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <i class="fa fa-money"></i>Penjualan Tiket
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>  
                    </div>
                    <div class="box-body" style="height:280px">
                        <p>Total pendapatan tiket sampai tanggal <strong><?= date_indo(date('Y-m-d')) ?></strong></p>
                        <h3></h3>
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3><?= 'Rp ' . number_format($pendapatan_data['totalPendapatan'],'0','','.') . ',-' ?></h3>
                                <p><i>Dalam satuan rupiah</i></p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<?php $this->load->view('_partials_admin/js'); ?>
<!-- End JS -->

<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/kelly.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<?php
    $userTotal = json_encode($userGraph);
    $pubTotal  = json_encode($pubGraph);
?>

<script>
    am4core.ready(function() {
        am4core.useTheme(am4themes_kelly);
        am4core.useTheme(am4themes_animated);

        var chart = am4core.create("user-publisher", am4charts.PieChart);

        chart.data = [{
            "type": "User",
            "value": <?= $userTotal ?>
        }, {
            "type": "Publisher",
            "value": <?= $pubTotal ?>
        }];

        chart.innerRadius = am4core.percent(50);

        var series = chart.series.push(new am4charts.PieSeries());
        series.dataFields.value = "value";
        series.dataFields.category = "type";

        series.slices.template.cornerRadius = 10;
        series.slices.template.innerCornerRadius = 7;
        series.alignLabels = false;
        series.labels.template.padding(0,0,0,0);

        series.labels.template.bent = true;
        series.labels.template.radius = 4;

        series.slices.template.states.getKey("hover").properties.scale = 1.1;
        series.labels.template.states.create("hover").properties.fill = am4core.color("#fff");

        series.slices.template.events.on("over", function (event) {
            event.target.dataItem.label.isHover = true;
        })

        series.slices.template.events.on("out", function (event) {
            event.target.dataItem.label.isHover = false;
        })

        series.ticks.template.disabled = true;

        // this creates initial animation
        series.hiddenState.properties.opacity = 1;
        series.hiddenState.properties.endAngle = -90;
        series.hiddenState.properties.startAngle = -90;

        series.renderer.labels.template.disabled = true;

        chart.legend = new am4charts.Legend();

    });
</script>

<script>
    $(function () {
        $('#top-event-peserta').DataTable()
        $('#top-event-pendapatan').DataTable()
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<!-- Footer -->
<?php $this->load->view('_partials_admin/footer'); ?>
<!-- End Footer -->