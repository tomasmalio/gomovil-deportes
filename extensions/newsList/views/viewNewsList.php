<!-- News -->
<section class="news-list">
	<?php if ($slider) {?><div class="swiper-container"><?php }?>
		<ul class="list-news <?php if ($slider) {?>swiper-wrapper<?php }?>">
			<?php 
				$quantity = 0;
				foreach ($newsList as $news) {
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<a href="<?= $news['url']?>" title="<?= $news['title']?>">
					<div class="row">
						<div class="col-12">
							<div class="content-image">
								<div class="img-wrap ratio-16-9">
									<div class="image ">
										<img src="<?= $news['image']?>" name="<?= $news['title']?>" alt="<?= $news['title']?>" title="<?= $news['title']?>" />
									</div>
								</div>
							</div>
							<div class="news-content">
								<time datetime="<?= $news['date']?>"><?= date('d \d\e F, Y', strtotime($news['date']))?></time>
								<h2><?= $news['title']?></h2>
								<h3><?= $news['description']?></h3>
							</div>
						</div>
					</div>
				</a>
			</li>
			<?php 
					$quantity++;
					if (isset($items) && $quantity === $items) {
						break;
					}
				}
			?>
		</ul>
	<?php if ($slider) {?></div><?php }?>

	<div class="swiper-pagination"></div>
</section>
<!-- Eof News -->