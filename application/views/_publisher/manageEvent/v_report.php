<!-- Header -->
<?php $this->load->view('_partials/header'); ?>
<!-- End Header -->

<!-- Navbar -->
<?php $this->load->view('_partials/navbar'); ?>
<!-- End Navbar -->

<div class="popular_courses"></div>

<main id="main">
    <section id="about">
        <div class="container">
			<div class="row justify-content-center" style="margin-bottom: 100px">
				<div class="col-md-12">
					<div class="card shadow">
                        <div class="card-body">
                            <h4><?= $title ?></h4>
                            <ul class="nav nav-tabs mb-3" id="tab" role="tablist">
                                <?php $this->load->view('_partials/navbar_manage'); ?>
                            </ul>
                            <div class="tab-content" id="tabContent">
                                <div class="tab-pane fade show active" id="setting" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h3 style="margin-bottom: 10px">Generate Report</h3>
                                            <a href="<?= site_url('Publisher/ManageEvent/generateReport/'.$id.'/print') ?>" 
                                                class="btn btn-primary" style="margin-bottom: 30px">
                                                <i class="fa fa-download"></i> Generate Report
                                            </a>

                                            <h3 style="margin-bottom: 10px">Hiburan / Doorprize</h3>
                                            <p style="margin-bottom: 10px">Fitur tambahan untuk memulai hiburan atau pembagian doorprize, <br>
                                                kami bekerjasama dengan kahoot untuk melakukannya. Klik tombol dibawah untuk memulai
                                            </p>
                                            <a href="https://create.kahoot.it/register" target="_blank" class="btn btn-dark">Kahoot.it</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Footer -->
<?php $this->load->view('_partials/footer'); ?>
<!-- End Footer -->

<!-- JS -->
<?php $this->load->view('_partials/js'); ?>
<!-- End JS -->

<!-- Footer -->
<?php $this->load->view('_partials/endfile'); ?>
<!-- End Footer -->