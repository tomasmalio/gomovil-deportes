<!-- News -->
<section class="newssportsgomovil">
	<?php if (isset($content['title'])){?><h3><?=$content['title']?></h3><?php }?>
	<div class="newssportsgomovil-content <?php if ($slider) {?>swiper-container<?php }?>">
		<ul class="list-news <?php if ($slider) {?>swiper-wrapper<?php } else { if (isset($content['position']) && $content['position'] === 'horizontal') {?>row<?php } else {?> clearfix<?php } }?>">
			<?php 
				$quantity = 0;
				$newsContent = $content['content'];
				
				foreach ($newsContent as $news) {
					if (!isset($content['article']) || (isset($content['article']) && $content['article'] != $news['id'])) {
						/**
						 * Creating the type of display content we
						 * want to do.
						 * Options:
						 * 	- slider: true | false
						 * 	- position: horizontal | vertical
						 **/ 
						$className = '';
						if ($slider) {
							$className = 'swiper-slide';
						} else {
							if (isset($content['position']) && $content['position'] === 'horizontal') {
								if (isset($content['columns']['mobile']) || isset($content['columns']['desktop'])) {
									if (isset($content['columns']['mobile']) && IS_MOBILE) {
										$val = 12 / $content['columns']['mobile'];
									} elseif (isset($content['columns']['desktop']) && !IS_MOBILE)  {
										$val = 12 / $content['columns']['desktop'];
									}
								} else {
									$val = 12 / $items;
								}
								$q = ((strpos($val, '.')) ? (ceil($val)) : $val);
								$className = 'horizontal col-'.$q;
							}
						}
			?>
			<li class="<?=$className;?>">
				<?php
					$url = '';
					$url .= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
					echo $_SERVER['HTTP_HOST'];
					// echo $url;
					$url .= '/';
					if (isset($content['titles']['news'][COUNTRY_CODE])) { 
						$url .= strtolower($content['titles']['news'][COUNTRY_CODE]); 
					} else { 
						$url .= strtolower($content['titles']['news']['default']);
					}
					$url .= '/';
					if (isset($content['titles']['news'][COUNTRY_CODE])) {
						$url .= strtolower($content['titles']['article'][COUNTRY_CODE]);
					} else {
						$url .= strtolower($content['titles']['article']['default']);
					}
					$url .= '/';
					$url .= $news['id'] .'/'. $this->normalizeString($news['title']);
				?>
				<a href="<?= $url?>" title="<?=$news['title']?>">
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