<div class="blog_right_sidebar">
	<aside class="single_sidebar_widget search_widget">
		<form action="<?= site_url('artikel/cari') ?>" method="get">
			<div class="input-group">
				<input type="text" class="form-control" name="v" placeholder="Search Posts">
				<span class="input-group-btn">
					<button class="btn btn-default" type="submit"><i class="ti-search"></i></button>
				</span>
			</div>
		</form>
		<div class="br"></div>
	</aside>
	<aside class="single_sidebar_widget author_widget">
		<p>Positive thinking is a valuable tool that can help you overcome obstacles, deal with pain,
			and reach new goals..</p>
		<div class="br"></div>
	</aside>
	<aside class="single_sidebar_widget popular_post_widget">
		<h3 class="widget_title">Popular Posts</h3>
		<?php foreach ($popular as $row): $dateCreated = date("Y-m-d", strtotime($row->created_at)); ?>
		<div class="media post_item">
			<img src="<?= base_url('assets/images/images-berita/'.$row->image) ?>" alt="post"
				style="width:40px; height: 40px;">
			<div class="media-body">
				<a href="<?= site_url('artikel/'.$row->slug) ?>">
					<h3><?= $row->title ?></h3>
				</a>
				<p><?= date_indo($dateCreated) . ' | ' . $row->views_count . ' views' ?></p>
			</div>
		</div>
		<?php endforeach ?>
		<div class="br"></div>
	</aside>
	<aside class="single_sidebar_widget post_category_widget">
		<h4 class="widget_title">Post Catgories</h4>
		<ul class="list cat-list">
			<?php foreach ($category as $row): ?>
			<li>
				<a href="<?= site_url('artikel/kategori/'.strtolower($row->name)) ?>"
					class="d-flex justify-content-between">
					<p><?= $row->name ?></p>
					<p><?= $row->jumlah_artikel ?></p>
				</a>
			</li>
			<?php endforeach ?>
		</ul>
	</aside>
</div>