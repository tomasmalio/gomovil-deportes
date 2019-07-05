<!-- News -->
<section class="newssportsgomovil">
	<div class="newssportsgomovil-content <?php if ($slider) {?>swiper-container<?php }?>">
		<ul class="list-news <?php if ($slider) {?>swiper-wrapper<?php }?>">
			<?php 
				$quantity = 0;
				foreach ($content as $key => $value) {
					if ($key == 'content') {
						foreach ($value as $news) {
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<a href="/<?= strtolower($content['title']['news'][COUNTRY_CODE]) . '/'. strtolower($content['title']['article'][COUNTRY_CODE]) .'/'.$news['id'] .'/'. Widgets::normalizeString($news['title']);?>" title="<?=$news['title']?>">
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
								<?php if (isset($news['created_at'])) {?>
								<time datetime="<?= $news['created_at']?>"><?= $news['created_at']?></time>
								<?php }?>
								<h2><?= $news['title']?></h2>
								<h3><?php if (strlen($news['summary']) > 180) { echo substr($news['summary'],0,strpos($news['summary'],' ',180)).'...'; } else { echo $news['summary'];}?></h3>
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
					}
				}
			?>
		</ul>
		<?php if ($pagination) {?>
		<div class="swiper-pagination"></div>
		<?php }?>
		<?php if ($navigation) {?>
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
		<?php }?>
	</div>
</section>
<!-- Eof News -->