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
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-chrome"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Chrome</span>
              <span class="info-box-number"><?= $total_chrome ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-opera"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Opera</span>
              <span class="info-box-number"><?= $total_opera ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-firefox"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Firefox</span>
              <span class="info-box-number"><?= $total_firefox ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-bug"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Other</span>
              <span class="info-box-number"><?= $total_other ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
        <!-- ./col -->
      </div>

      <!-- fetch data from database -->
      <?php foreach ($statistik as $result) {
          $bulan[] = $result->tanggal;
          $nilai[] = (float) $result->jumlah;
      } ?>
      
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <span class="pull-right">Total Pengunjung: <b><?= $totalVisitor ?></b> orang</span>
                <h3 style="margin-top:0px"><i class="fa fa-bar-chart"></i> Grafik Pengunjung
                </h3>
            </div>    
            <div class="box-body">
              <canvas id="canvas" width="1000px" height="250px"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8">
          <div class="box box-success">
            <div class="box-header with-border">
            <a href="<?= site_url('event') ?>" class="btn-xs btn-success pull-right" data-toggle="tooltip" data-placement="top" title="Semua Event">
                <i class="fa fa-calendar-o"></i></a>
                <h3 style="margin-top:0px"><i class="fa fa-calendar-o"></i> Event baru</h3>
            </div>    
            <div class="box-body">
              <table class="table table-bordered table-hover table-striped" id="tabel-event">
                <thead>
                  <tr>
                    <th>Nama Event</th>
                    <th>Publisher</th>
                    <th>Tanggal</th>
                    <th>Lihat</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($events as $event) { 
                    $eventCreated = date('d M Y H:i:s', strtotime($event->created_at));
                    ?>
                    <tr>
                      <td><?= $event->title ?></td>
                      <td><?= $event->name ?></td>
                      <td><?= $eventCreated  ?></td>
                      <td><a href="<?= site_url('admin/event/'.$event->event_id) ?>" class="btn-xs btn-primary"> Lihat</a></td>  
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info-box bg-yellow">
              <span class="info-box-icon"><i class="fa fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total User</span>
                <span class="info-box-number"><?= $total_user ?></span>
                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                  <span class="progress-description">
                    Hari ini bertambah +<?= $user_this_day ?> user
                  </span>
              </div>
            <!-- /.info-box-content -->
          </div>
          <div class="info-box bg-red">
              <span class="info-box-icon"><i class="fa fa-user-o"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Publisher</span>
                <span class="info-box-number"><?= $total_pub ?></span>
                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                  <span class="progress-description">
                    Hari ini bertambah +<?= $pub_this_day ?> publisher
                  </span>
              </div>
            <!-- /.info-box-content -->
          </div>
          <div class="info-box bg-green">
              <span class="info-box-icon"><i class="fa fa-calendar-check-o"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Event</span>
                <span class="info-box-number"><?= $total_event ?></span>
                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                  <span class="progress-description">
                    Hari ini bertambah +<?= $event_this_day ?> event
                  </span>
              </div>
            <!-- /.info-box-content -->
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-5">
          <div class="box box-warning">
            <div class="box-header with-border">
              <a href="<?= site_url('pesan-masuk') ?>" class="btn-xs btn-warning pull-right" data-toggle="tooltip" data-placement="top" title="Semua pesan">
                <i class="fa fa-envelope-o"></i></a>
              <h3 style="margin-top:0px"><i class="fa fa-envelope-o"></i> Pesan Masuk</h3>
            </div>    
            <div class="box-body">
              <table class="table table-bordered table-hover table-striped">
                <thead>
                  <tr>
                    <th>Dari</th>
                    <th>Isi</th>
                    <?= $role = ($_SESSION['role'] == 'adm') ? '<th>Lihat</th>' : '' ; ?>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($inbox as $result) { ?>
                    <tr>
                      <td><?= $result->name ?></td>
                      <td><?= $result->content ?></td>
                      <?php if ($_SESSION['role'] == 'adm') { ?>
                      <td><a href="<?= site_url('pesan-masuk/'.$result->id) ?>" class="btn-xs btn-primary">Lihat</a></td>
                      <?php } else { } ?>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="box box-danger">
            <div class="box-header with-border">
            <a href="<?= site_url('artikel') ?>" class="btn-xs btn-danger pull-right" data-toggle="tooltip" data-placement="top" title="Semua Artikel">
                <i class="fa fa-align-left"></i></a>
                <h3 style="margin-top:0px"><i class="fa fa-align-left"></i> Posting populer</h3>
            </div>    
            <div class="box-body">
              <table class="table table-bordered table-hover table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul Berita</th>
                    <th>Dilihat</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no = 0;
                  foreach ($artikels as $artikel) { ?>
                  <tr>
                    <td><?= ++$no ?></td>
                    <td><?= $artikel->title ?></td>
                    <td><?= $artikel->views_count .' views' ?></td>
                  </tr>  
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>


<!-- JS -->
<?php $this->load->view('_partials_admin/js'); ?>
<!-- End JS -->

<!-- ChartJS 1.0.1 -->
<script src="<?= base_url()?>assets/AdminLTE/bower_components/chart.js/Chart.js"></script>


<script>
  $(function () {
    $('#tabel-event').DataTable({
      "lengthMenu": [[5,10, -1], [5,10, "All"]],
      "pageLength": 5
    });
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>

<script>
  $(function () {
    var lineChartData = {
      labels : <?php echo json_encode($bulan);?>,
      datasets : [        
        {
          fillColor            : "rgba(60,141,188,0.9)",
          strokeColor          : "rgba(60,141,188,0.8)",
          pointColor           : "#3b8bba",
          pointStrokeColor     : "#fff",
          pointHighlightFill   : "#fff",
          pointHighlightStroke : "rgba(152,235,239,1)",
          data : <?php echo json_encode($nilai);?>
        }
      ]      
    }
  var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);
    var canvas = new Chart(myLine).Line(lineChartData, {
        scaleBeginAtZero        : true,
        scaleShowGridLines      : true,
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        scaleGridLineWidth      : 1,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines  : true,
        barShowStroke           : true,
        barStrokeWidth          : 2,
        barValueSpacing         : 5,
        barDatasetSpacing       : 1,
        legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        responsive              : true,
        maintainAspectRatio     : true
    });
  });
</script>

<!-- Footer -->
<?php $this->load->view('_partials_admin/footer'); ?>
<!-- End Footer -->