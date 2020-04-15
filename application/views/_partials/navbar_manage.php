<li class="nav-item">
    <?php if ($navbar_manage == 'description') { ?>
	    <a class="nav-link active" id="deskripsi-tab" data-toggle="tab" href="#deskripsi" style="color:inherit" role="tab">
        <i class="fa fa-calendar"></i> <u style="color:inherit">Informasi Event</u></a>
    <?php } else { ?>
        <a class="nav-link" href="<?= site_url('manage/'.$id) ?>" style="color:inherit">
		<i class="fa fa-calendar"></i> Informasi Event</a>
    <?php } ?>
</li>
<li class="nav-item">
    <?php if ($navbar_manage == 'ticket') { ?>
	    <a class="nav-link active" id="tiket-tab" data-toggle="tab" href="#tiket" style="color:inherit"
		role="tab"><i class="fa fa-ticket"></i> <u style="color:inherit">Tiket</u></a>
    <?php } else { ?>
        <a class="nav-link" href="<?= site_url('manage/'.$id.'/tiket') ?>" style="color:inherit">
		<i class="fa fa-ticket"></i> Tiket</a>
    <?php } ?>
</li>
<li class="nav-item">
    <?php if ($navbar_manage == 'ticket-sales') { ?>
	    <a class="nav-link active" id="selltiket-tab" data-toggle="tab" href="#selltiket" style="color:inherit" role="tab"><i class="fa fa-money"></i> <u style="color:inherit">Penjualan Tiket</u></a>
    <?php } else { ?>
        <a class="nav-link" href="<?= site_url('manage/'.$id).'/penjualan-tiket' ?>" style="color:inherit">
		<i class="fa fa-money"></i> Penjualan Tiket</a>
    <?php } ?>
</li>
<li class="nav-item">
    <?php if ($navbar_manage == 'audience') { ?>
	    <a class="nav-link active" id="peserta-tab" data-toggle="tab" href="#peserta" style="color:inherit" role="tab"><i class="fa fa-user-o"></i> <u style="color:inherit">Peserta</u></a>
    <?php } else { ?>
        <a class="nav-link" href="<?= site_url('manage/'.$id.'/peserta') ?>" style="color:inherit">
		<i class="fa fa-user-o"></i> Peserta</a>
    <?php } ?>
</li>
<li class="nav-item">
    <?php if ($navbar_manage == 'attendance') { ?>
	    <a class="nav-link active" id="kedatangan-tab" data-toggle="tab" href="#kedatangan" style="color:inherit" role="tab"><i class="fa fa-qrcode"></i> <u style="color:inherit">Kedatangan</u></a>
    <?php } else { ?>
        <a class="nav-link" href="<?= site_url('manage/'.$id.'/kedatangan') ?>" style="color:inherit">
		<i class="fa fa-qrcode"></i> Kedatangan</a>
    <?php } ?>
</li>
<?php if ($certificate == 1) { ?>
<li class="nav-item">
    <?php if ($navbar_manage == 'certificate') { ?>
	    <a class="nav-link active" id="sertifikat-tab" data-toggle="tab" href="#sertifikat" style="color:inherit" role="tab"><i class="fa fa-certificate"></i> <u style="color:inherit">Sertifikat</u></a>
    <?php } else { ?>
        <a class="nav-link" href="<?= site_url('manage/'.$id.'/sertifikat') ?>" style="color:inherit">
        <i class="fa fa-certificate"></i> Sertifikat</a>
    <?php } ?>
</li>
<?php } ?>
<li class="nav-item">
    <?php if ($navbar_manage == 'report') { ?>
	    <a class="nav-link active" id="setting-tab" data-toggle="tab" href="#setting" role="tab" style="color:inherit"> <i class="fa fa-book"></i> <u style="color:inherit">Report</u></a>
    <?php } else { ?>
        <a class="nav-link" href="<?= site_url('manage/'.$id.'/laporan') ?>" style="color:inherit">
		<i class="fa fa-book"></i> Report</a>
    <?php } ?>
</li>