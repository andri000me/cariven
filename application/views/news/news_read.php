<!-- Header -->
<?php 
	$this->load->view('_partials/header');
?>
<!-- End Header -->

<!-- Navbar -->
<?php 
    $this->load->view('_partials/navbar');
    $dateCreated = date("Y-m-d", strtotime($news_created));
?>
<!-- End Navbar -->

<!--================Blog Area =================-->
<section class="blog_area single-post-area section_gap">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 posts-list">
				<div class="single-post row">
					<div class="col-lg-12">
						<div class="feature-img">
							<img class="img-fluid" src="<?= base_url('assets/images/images-berita/'.$news_image) ?>"
								style="width: 730px; height: 340px">
						</div>
					</div>
					<div class="col-lg-3  col-md-3">
						<div class="blog_info text-right">
							<div class="post_tag">
								<a href="#"><?= $news_category ?></a>
							</div>
							<ul class="blog_meta list">
								<li><a href="#"><?= $news_admin ?><i class="ti-user"></i></a></li>
								<li><a href="#"></i> <?= date_indo($dateCreated) ?><i class="ti-calendar"></i></a></li>
								<li><a href="#"><?= $news_count ?> Views<i class="ti-eye"></i></a></li>
							</ul>
							<ul class="social-links">
								<li><a href="#"><i class="ti-facebook"></i></a></li>
								<li><a href="#"><i class="ti-twitter"></i></a></li>
								<li><a href="#"><i class="ti-linkedin"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-9 col-md-9 blog_details">
						<h2><?= $news_title ?></h2>
						<p class="excert"><?= $news_content ?></p>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
                <?php $this->load->view('_partials/section-right-artikel'); ?>
			</div>
		</div>
	</div>
</section>
<!--================Blog Area =================-->

<?php $this->load->view('_partials/footer'); ?>
<!-- End Footer -->

<!-- JS -->
<?php $this->load->view('_partials/js'); ?>
<!-- End JS -->
<script type="text/javascript">
	$(document).ready(function () {
		$('#btncari').hide();
	});
</script>
<!-- Footer -->
<?php $this->load->view('_partials/endfile');?>
<!-- End Footer -->