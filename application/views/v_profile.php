<!-- Header -->
<?php $this->load->view('_partials/header'); ?>
<!-- End Header -->

<!-- Navbar -->
<?php $this->load->view('_partials/navbar'); ?>
<!-- End Navbar -->

<div class="popular_courses section_gap_top">
    <div class="container" style="margin-bottom:20vh">
        <div class="row">
            <div class="col-lg-12">
                <div class="main_title text-left">
                    <?php if ($this->session->flashdata('success_update') <> ''): ?>
                        <div class="alert alert-success alert-dismissible fade show" id="success_pass" role="alert">
                            <?= $this->session->flashdata('success_update') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif ?>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card" style="width: 18rem;">
                                <img src="<?= base_url('assets/images/images-user/'.$user->profile_picture) ?>" class="card-img-top" alt="Image of <?= $user->name ?>">
                                <div class="card-body text-center">
                                    <small><a href="<?= site_url('ubah-profil') ?>" style="text-decoration:none; color: inherit;"><i class="fa fa-edit"></i>ubah profile</a></small> <br> <br>
                                    <p class="font-weight-bold" style="margin-bottom:0px">My Bio</p>
                                    <p class="card-text"><?= $user->short_bio ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" 
                                    href="#nav-profile" role="tab" aria-controls="nav-home" aria-selected="true"> 
                                    <i class="fa fa-user-o"></i> Profil Saya</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <table class="table table-hover table-striped">
                                        <tr>
                                            <td>Nama</td>
                                            <td style="width:30px">:</td>
                                            <td><?= $user->name ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td><?= $user->email ?></td>
                                        </tr>
                                        <tr>
                                            <td>No Hp</td>
                                            <td>:</td>
                                            <td><?= $user->phone_number ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td><?= $user->address ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" 
                                    href="#nav-event" role="tab" aria-controls="nav-home" aria-selected="true"> 
                                    <i class="fa fa-calendar-check-o"></i> Event yang diikuti</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-event" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <table class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width:50px">No</th>
                                                <th>Nama Event</th>
                                                <th style="width:100px">Hadir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $start = 0;
                                            foreach($user_events as $event): ?>
                                            <tr>
                                                <td><?= ++$start ?></td>
                                                <td><a href="<?= site_url('event/v/'.$event->event_slug) ?>" style="text-decoration:none; color: inherit;">
                                                <?= $event->event_name ?></a></td>
                                                <td><?= $retVal = ($event->user_attend == 1) ? "ya" : "tidak" ; ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>        
                        </div>
                    </div>

                    <?php if ($is_publisher === true): ?>
                        <div class="row mt-3">
                            <div class="col-12"><hr></div>
                            <div class="col-12">
                            <?php if ($publisher->image == 'default.png') { ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                     Silahkan lengkapi <strong>profil publisher</strong> anda untuk membuat event :)
                                </div>
                            <?php } ?>
                            <h3>Profil Publisher</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card" style="width: 18rem;">
                                    <img src="<?= base_url('assets/images/images-publisher/'.$publisher->image) ?>" class="card-img-top" style="height:250px" alt="Image of <?= $publisher->name ?>">
                                    <div class="card-body text-center">
                                        <small><a href="<?= site_url('p/ubah-profil') ?>" style="text-decoration:none; color: inherit;"><i class="fa fa-edit"></i>ubah profile</a></small> <br> <br>
                                        <p class="font-weight-bold" style="margin-bottom:0px">My Bio</p>
                                        <p class="card-text"><?= $publisher->short_bio ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" 
                                        href="#nav-profile" role="tab" aria-controls="nav-home" aria-selected="true"> 
                                        <i class="fa fa-user"></i> Profil Publisher</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <table class="table table-hover table-striped">
                                            <tr>
                                                <td>Nama</td>
                                                <td style="width:30px">:</td>
                                                <td><?= $publisher->name ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td><?= $publisher->business_email ?></td>
                                            </tr>
                                            <tr>
                                                <td>No Hp</td>
                                                <td>:</td>
                                                <td><?= $publisher->business_number ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>:</td>
                                                <td><?= $publisher->location ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" 
                                        href="#nav-event" role="tab" aria-controls="nav-home" aria-selected="true"> 
                                        <i class="fa fa-calendar-check"></i> Event yang dimiliki</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-event" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <table class="table table-hover table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width:50px">No</th>
                                                    <th>Nama Event</th>
                                                    <th style="width:100px">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $start = 0;
                                                foreach($publisher_events as $event): ?>
                                                <tr>
                                                    <td><?= ++$start ?></td>
                                                    <td><a href="<?= site_url('manage/'.$event->id) ?>" style="text-decoration:none; color: inherit;">
                                                    <?= $event->title ?></a></td>
                                                    <td><?= $event->status ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>        
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
	<?php $this->load->view('_partials/footer'); ?>
<!-- End Footer -->

<!-- JS -->
    <?php $this->load->view('_partials/js'); ?>
<!-- End JS -->

<script>
$("#success_pass").fadeTo(2000, 500).slideUp(500, function(){
    $("#success_pass").slideUp(300);
});
</script>

<!-- JS -->
    <?php $this->load->view('_partials/endfile'); ?>
<!-- End JS -->