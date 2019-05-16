<?php 
setlocale(LC_TIME, 'es_ES', 'esp_esp'); 
?>
<!-- News Google -->
<section class="news-google">
	<div class="news-google-content <?php if ($slider) {?>swiper-container<?php }?>">
		<ul class="list-news <?php if ($slider) {?>swiper-wrapper<?php }?>">
			<?php 
				$quantity = 0;
				foreach ($content as $news) {
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<a href="<?=$news['link']?>" title="<?=$news['title']?>" target="_blank">
					<div class="row">
						<div class="col-12">
							<?php if (isset($news['image'])) {?>
							<div class="content-image">
								<div class="img-wrap ratio-16-9">
									<div class="image ">
										<img src="<?=$news['image']?>" name="<?=$news['title']?>" alt="<?=$news['title']?>" title="<?=$news['title']?>" />
									</div>
								</div>
							</div>	
							<?php }?>
							<div class="news-content">
								<h2><?= $news['title']?></h2>
								<?php if (isset($options['display']['source']) && $options['display']['source']) {?>
								<div class="source"><?= $news['source']?></div>
								<time datetime="<?= $news['datetime']?>">
									<?php 
										if (date('Y-m-d') == date('Y-m-d', strtotime($news['datetime']))) {
											echo "Hoy";
										} elseif (date('Y-m-d', strtotime( '-1 days' )) == date('Y-m-d', strtotime($news['datetime']))) {
											echo "Ayer";
										} else {
											echo strftime('%d %B - %H:%M', strtotime($news['datetime']));
										}
									?>
									</time>
								<?php }?>
								<?php if (isset($options['display']['description']) && $options['display']['description']) {?>
								<h3><?php if (strlen($news['description']) > 180) { echo substr($news['description'], 0, strpos($news['description'],' ',180)).'...'; } else { echo $news['description'];}?></h3>
								<?php }?>
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
		<div class="swiper-pagination"></div>
	</div>
</section>
<!-- Eof News Google -->