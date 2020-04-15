<!-- Header -->
<?php 
	$this->load->view('_partials/header');
?>
<!-- End Header -->

<!-- Navbar -->
<?php 
	$this->load->view('_partials/navbar');
?>
<!-- End Navbar -->
<?php
    error_reporting(0);
    function limit_words($string, $word_limit){
        $words = explode(" ",$string);
        return implode(" ",array_splice($words,0,$word_limit));
    }
    $dateCreated = date("Y-m-d", strtotime($latest->created_at));
?>

<!--================Blog Area =================-->
<section class="blog_area section_gap">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="blog_left_sidebar">
					<?php foreach ($news_data as $row): 
                        $dateCreated = date("Y-m-d", strtotime($row->created_at));
                         ?>
					<article class="row blog_item">
						<div class="col-md-3">
							<div class="blog_info text-right">
								<div class="post_tag">
									<a href="#"><?= $row->category_name ?></a>
								</div>
								<ul class="blog_meta list">
									<li><a href="#"><?= $row->user_name ?><i class="ti-user"></i></a></li>
									<li><a href="#"><?= date_indo($dateCreated) ?><i class="ti-calendar"></i></a></li>
									<li><a href="#"><?= $row->views_count ?> Views<i class="ti-eye"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-9">
							<div class="blog_post">
								<img src="<?= base_url('assets/images/images-berita/'.$row->image) ?>" class="img-fluid"
									style="width: 542px; height: 272px">
								<div class="blog_details">
									<a href="<?= site_url('artikel/'.$row->slug) ?>">
										<h2><?= $row->news_title ?></h2>
									</a>
									<p style="text-align: justify">
										<?= limit_words(strip_tags($row->content),20).'...' ?></p>
									<a href="<?= site_url('artikel/'.$row->slug) ?>" class="blog_btn">Selengkapnya</a>
								</div>
							</div>
						</div>
					</article>
					<?php endforeach; ?>
					<?= $this->pagination->create_links() ?>
				</div>
			</div>
			<div class="col-lg-4">
				<?php $this->load->view('_partials/section-right-artikel'); ?>
			</div>
		</div>
	</div>
</section>
<!--================Blog Area =================-->

<!-- Footer -->
<?php 
	$this->load->view('_partials/footer');
?>
<!-- End Footer -->

<!-- JS -->
<?php 
	$this->load->view('_partials/js');
?>
<!-- End JS -->

<script type="text/javascript">
	$(document).ready(function () {
		$('#btncari').hide();
	});
</script>

<!-- Footer -->
<?php 
	$this->load->view('_partials/endfile');
?>
<!-- End Footer -->