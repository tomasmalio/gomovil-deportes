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
				<a href="/<?= strtolower($content['title']['news'][COUNTRY_CODE]) . '/'. strtolower($content['title']['article'][COUNTRY_CODE]) .'/'.$news['nota_id'] .'/'. Widgets::normalizeString($news['titulo']);?>" title="<?=$news['titulo']?>">
					<div class="row">
						<div class="col-12">
							<div class="content-image">
								<div class="img-wrap ratio-16-9">
									<div class="image ">
										<img src="<?= $news['imagen']?>" name="<?= $news['titulo']?>" alt="<?= $news['titulo']?>" title="<?= $news['titulo']?>" />
									</div>
								</div>
							</div>
							<div class="news-content">
								<?php if (isset($news['fechaPublicacion'])) {?>
								<time datetime="<?= $news['fechaPublicacion']?>"><?= $news['fechaPublicacion']?></time>
								<?php }?>
								<h2><?= $news['titulo']?></h2>
								<h3><?php if (strlen($news['nota']) > 180) { echo substr($news['nota'],0,strpos($news['nota'],' ',180)).'...'; } else { echo $news['nota'];}?></h3>
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