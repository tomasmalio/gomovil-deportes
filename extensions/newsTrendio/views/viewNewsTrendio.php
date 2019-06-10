<section class="newstrendio">
	<h2><?= $content['title']?></h2>
	<div class="newstrendio-content <?php if ($slider) {?>swiper-container<?php }?>">
		<ul class="<?php if (!$slider) {?>row <?php }?>list-trendio <?php if ($slider) {?>swiper-wrapper<?php }?>">
			<?php 
				$quantity = 0;
				foreach ($content['data'] as $news) {
			?>
			<li class="<?php if ($slider) {?>swiper-slide<?php } else {?>col-lg-3 col-md-3 col-sm-6 col-xs-12<?php }?>">
				<?php if (!$slider) {?>
				<div class="content">
				<?php }?>
					<a href="<?=$news['external_link']?>" title="<?= $new['title']?>">
						<div class="row">
							<div class="col-12">
								<div class="content-image">
									<div class="img-wrap ratio-16-9">
										<div class="image ">
											<img src="<?= $news['image']?>" name="<?= $new['title']?>" alt="<?= $new['title']?>" title="<?= $new['title']?>" />
										</div>
									</div>
								</div>
								<div class="news-content">
									<time datetime="<?= $news['created_at']?>"><?= strftime('%d %B - %H:%M', strtotime($news['created_at']))?></time>
									<h3><?=$news['title']?></h3>
									<h4><?php if (strlen($news['sub_title']) > 180) { echo substr($news['sub_title'],0,strpos($news['sub_title'],' ',180)).'...'; } else { echo $news['sub_title'];}?></h4>
								</div>
							</div>
						</div>
					</a>
				<?php if (!$slider) {?>
				</div>
				<?php }?>
			</li>
			<?php 
					$quantity++;
					if (isset($items) && $quantity === $items) {
						break;
					}
				}
			?>
		</ul>
		<div class="swiper-pagination"></div>
	</div>
</section>