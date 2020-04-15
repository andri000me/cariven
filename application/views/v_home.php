<?php $this->load->view('_partials/header');?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<?php $this->load->view('_partials/navbar'); ?>

    <!--================ Start Home Banner Area =================-->
    <section class="home_banner_area">
      <div class="banner_inner">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="banner_content text-center">
                <p class="text-uppercase">
                  Tempat terbaik untuk menemukan event
                </p>
                <h2 class="text-uppercase mt-4 mb-5" >
                  Satu Langkah Mudah Ikuti Event
                </h2>
                <div>
                  <!-- <a href="#" class="primary-btn2 mb-3 mb-sm-0">learn more</a> -->
                  <a href="<?= site_url('cari-event?keyword=&kategori=&kota=') ?>" class="primary-btn ml-sm-3 ml-0">Lihat Event</a> <br> <br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ End Home Banner Area =================-->

    <!--================ Start Feature Area =================-->
    <section class="feature_area section_gap_top">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3">Fitur Aplikasi</h2>
              <p>
                Kami menyediakan beberapa fitur yang memudahkan anda dalam membuat atau mengikuti event
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="single_feature">
              <i class="fa fa-ticket fa-3x"></i>
              <div class="desc">
                <h4 class="mt-3 mb-2">Penjualan Tiket Online</h4>
                <p>
                  Penjualan tiket secara online dapat menghindari dari calo
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="single_feature">
              <i class="fa fa-qrcode fa-3x"></i>
              <div class="desc">
                <h4 class="mt-3 mb-2">QR Code</h4>
                <p>
                  Presensi kehadiran mendukung QR Code
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="single_feature">
              <i class="fa fa-certificate fa-3x"></i>
              <div class="desc">
                <h4 class="mt-3 mb-2">Cetak sertifikat</h4>
                <p>
                  Cariven mendukung penetakan sertifikat secara langsung
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ End Feature Area =================-->

    <!--================ Start Popular Courses Area =================-->
    <div class="popular_courses">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3">Event Terbaru</h2>
              <p>
                Temukan event terbaikmu disini
              </p>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <!-- single course -->
          <div class="col-lg-12">
          <?php if ($event_data): ?>
            <div class="owl-carousel active_course">

                <?php foreach ($event_data as $row):
                    $startDate = date('Y-m-d',strtotime($row->start_time));
                    $startTime = date('H:i',strtotime($row->start_time));
                    $endTime   = date('H:i',strtotime($row->end_time)); ?>

                <div class="single_course">
                    <div class="course_head">
                        <img class="img-fluid" src="<?= base_url('assets/images/images-event/'.$row->image) ?>" style="height:180px !important" />
                    </div>
                    <div class="course_content" style="min-height:310px">
                        <?php $tagPrice = ($row->type == 0) ? '<span class="price">Free</span>' : '' ; ?>
                        <span class="tag mb-4 d-inline-block"><?= $row->category_name ?></span>
                        <h4 class="mb-3">
                            <a href="<?= site_url('event/v/'.$row->slug) ?>"><?= $row->title ?></a>
                        </h4>
                        <p>
                            <table>
                                <tr>
                                    <td style="font-size: 14px;"><i class="fa fa-calendar-check-o"></i> Tanggal</td>
                                    <td> : </td>
                                    <td style="font-size: 14px;"><?= date_indo($startDate) ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px;"><i class="fa fa-clock-o"></i> Jam</td>
                                    <td> : </td>
                                    <td style="font-size: 14px;"><?= $startTime . ' - '. $endTime ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px;"><i class="fa fa-map-marker"></i> Lokasi</td>
                                    <td> : </td>
                                    <td style="font-size: 14px;"><?= $row->city_name ?></td>
                                </tr>
                            </table>
                        </p>
                        <div class="course_meta d-flex justify-content-lg-between align-items-lg-center flex-lg-row flex-column mt-4">
                            <div class="authr_meta">
                                <img src="<?= base_url('assets/images/images-publisher/'.$row->publisher_image) ?>" style="height:30px !important" />
                                <span class="d-inline-block ml-2"><?= $row->publisher_name ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                    
                <?php endforeach ?>
            </div>
            <?php else: ?>
                <p align="center" class="mb-3">event sedang disiapkan, sabar ya kak :)</p>
            <?php endif ?>
          </div>

          <a href="<?= site_url('cari-event?keyword=&kategori=&kota=') ?>" class="genric-btn primary circle arrow">Lihat semua event<span class="ti-arrow-right"></span></a>
        </div>
      </div>
    </div>
    <!--================ End Popular Courses Area =================-->

    <!--================ Start Registration Area =================-->
    <div class="section_gap registration_area">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <div class="row clock_sec clockdiv" id="clockdiv">
              <div class="col-lg-12">
                <h1 class="mb-3">Daftar Sekarang</h1>
                <p>
                  Ayo daftarkan dirimu sekarang juga dan cari event terbaikmu, kami menyediakan 
                  banyak event dari berbagai Event Organizer ternama. Daftarkan dirimu sekarang 
                  dan temukan eventmu.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 offset-lg-1">
              <div class="row mt-4">
                <a href="<?= site_url('register') ?>" class="btn btn-warning btn-block"> 
                Daftar Sekarang <img src="<?= base_url('assets/icons/icons/arrow-right.svg') ?>" alt="" width="48" height="32"></a>
              </div>
          </div>
        </div>
      </div>
    </div>
    <!--================ End Registration Area =================-->

    <!--================ Start Trainers Area =================-->
    <section class="trainer_area section_gap_top">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3">Event Organizer</h2>
              <p>
                Kami telah bekerja sama dengan event organizer ternama seperti dibawah ini
              </p>
            </div>
          </div>
        </div>
        <div class="row justify-content-center d-flex align-items-center">
          <?php foreach($publisher as $pub):?>
          <div class="col-lg-3 col-md-6 col-sm-12 single-trainer">
            <div class="thumb d-flex justify-content-sm-center">
            <img class="img-fluid" src="<?= base_url('assets/images/images-publisher/'.$pub['image']) ?>" style="height: 216px; width:255px" />
            </div>
            <div class="meta-text text-sm-center">
              <h4><?= $pub['name'] ?></h4>
              <p class="designation"></p>
              <div class="mb-4">
                <p><?= $pub['short_bio'] ?></p>
              </div>
              <div class="align-items-center justify-content-center d-flex">
                <?= $pub['location'] ?>
              </div>
            </div>
          </div>
          <?php endforeach ?>
        </div>
      </div>
    </section>
    <!--================ End Trainers Area =================-->

    <!--================ Start Berita Area =================-->
    <div class="events_area">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3 text-white">Berita Terbaru</h2>
              <p>
                Selalu up to date dengan berita terbaru dari cariven.id
              </p>
            </div>
          </div>
        </div>
        <?php 
          function limit_words($string, $word_limit){
            $words = explode(" ",$string);
            return implode(" ",array_splice($words,0,$word_limit))."...";
          }
        ?>
        <div class="row">
          <?php foreach($berita as $row):
            $tgl = date('d',strtotime($row['created_at']));
            $bln = date('M',strtotime($row['created_at']));
            ?>
          <div class="col-lg-6 col-md-6">
            <div class="single_event position-relative">
              <div class="event_thumb">
                <img src="<?= base_url('assets/images/images-berita/'.$row['image']) ?>" style="height: 400px; width: 540px"/>
              </div>
              <div class="event_details">
                <div class="d-flex mb-4">
                  <div class="date"><span><?= $tgl ?></span> <?= $bln ?></div>

                  <div class="time-location">
                    <p class="float-right ml-2">
                      Dipublikasi oleh: <br>
                      Admin
                    </p>
                    <i class="fa fa-user-o fa-3x"></i>
                  </div>
                </div>
                <p> <?= strip_tags(limit_words($row['content'],10)) ?></p>
                <a href="<?= site_url('artikel/'.$row['slug']) ?>" class="primary-btn rounded-0 mt-3">Selengkapnya</a>
              </div>
            </div>
          </div>
          <?php endforeach ?>
          <div class="col-lg-12">
            <div class="text-center pt-lg-5 pt-3">
              <a href="<?= site_url('artikel') ?>" class="event-link">
                Lihat semua berita <img src="<?= base_url('assets/edustage/img/next.png') ?>" alt="" />
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--================ End Berita Area =================-->

    <!--================ Start Testimonial Area =================-->
    <div class="testimonial_area section_gap">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3">Testimoni</h2>
              <p>
                Mari kita dengar perkataan dari client
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="testi_slider owl-carousel">
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="<?= base_url('assets/edustage/img/testimonials/t1.jpg') ?>" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Elite Martin</h4>
                    <p>
                      Him, made can't called over won't there on divide there
                      male fish beast own his day third seed sixth seas unto.
                      Saw from
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="<?= base_url('assets/edustage/img/testimonials/t2.jpg') ?>" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Davil Saden</h4>
                    <p>
                      Him, made can't called over won't there on divide there
                      male fish beast own his day third seed sixth seas unto.
                      Saw from
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="<?= base_url('assets/edustage/img/testimonials/t1.jpg') ?>" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Elite Martin</h4>
                    <p>
                      Him, made can't called over won't there on divide there
                      male fish beast own his day third seed sixth seas unto.
                      Saw from
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="<?= base_url('assets/edustage/img/testimonials/t2.jpg') ?>" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Davil Saden</h4>
                    <p>
                      Him, made can't called over won't there on divide there
                      male fish beast own his day third seed sixth seas unto.
                      Saw from
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="<?= base_url('assets/edustage/img/testimonials/t1.jpg') ?>" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Elite Martin</h4>
                    <p>
                      Him, made can't called over won't there on divide there
                      male fish beast own his day third seed sixth seas unto.
                      Saw from
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="<?= base_url('assets/edustage/img/testimonials/t2.jpg') ?>" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Davil Saden</h4>
                    <p>
                      Him, made can't called over won't there on divide there
                      male fish beast own his day third seed sixth seas unto.
                      Saw from
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--================ End Testimonial Area =================-->


<?php $this->load->view('_partials/footer'); ?>

<?php $this->load->view('_partials/js'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<?php $this->load->view('_partials/endfile'); ?>