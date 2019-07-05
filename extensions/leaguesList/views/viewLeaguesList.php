<section class="leagueslist">
	<?php if (isset($content['content']['search']['display']) && $content['content']['search']['display']) {?>
	<div class="content-league">
		<div class="league-image"><img src="<?=$content['content']['tournaments'][$content['content']['search']['type']][$content['content']['search']['tournament']]['image']?>" name="" alt="<?= (isset($content['content']['tournaments'][$content['content']['search']['type']][$content['content']['search']['tournament']]['name'][COUNTRY_CODE])) ? $content['tournaments'][$content['search']['type']][$content['content']['search']['tournament']]['name'][COUNTRY_CODE] : $content['content']['tournaments'][$content['content']['search']['type']][$content['content']['search']['tournament']]['name']['default']?>" title="<?= (isset($content['content']['tournaments'][$content['content']['search']['type']][$content['content']['search']['tournament']]['name'][COUNTRY_CODE])) ? $content['content']['tournaments'][$content['content']['search']['type']][$content['content']['search']['tournament']]['name'][COUNTRY_CODE] : $content['content']['tournaments'][$content['content']['search']['type']][$content['content']['search']['tournament']]['name']['default']?>"></div>
		<div class="league-name"><?= (isset($content['content']['tournaments'][$content['content']['search']['type']][$content['content']['search']['tournament']]['name'][COUNTRY_CODE])) ? $content['content']['tournaments'][$content['content']['search']['type']][$content['content']['search']['tournaments']]['name'][COUNTRY_CODE] : $content['content']['tournaments'][$content['content']['search']['type']][$content['content']['search']['tournaments']]['name']['default'];?></div>
	</div>
	<?php 
		} else {
	?>
	<div class="leagueslist-content <?php if ($slider) {?>swiper-container<?php }?>">
		<ul class="list-leagues<?php if ($slider) {?>-slider swiper-wrapper<?php }?>">
			<?php
				// Leagues
				if (isset($content['title']['leagues'][COUNTRY_CODE]) && $content['title']['leagues'][COUNTRY_CODE] != '' && !$slider) {
			?>
			<h2><?=$content['title']['leagues'][COUNTRY_CODE]?></h2>
			<?php 
				}
				foreach ($content['content']['tournaments']['leagues'] as $key => $leagues) {
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<a href="<?= strtolower($this->normalizeString($content['section'][COUNTRY_CODE]))?>/<?= strtolower($this->normalizeString($content['title']['tournaments'][COUNTRY_CODE]))?>/<?= strtolower($this->normalizeString($content['title']['leagues'][COUNTRY_CODE]))?>/<?=$key?>" class="content-league">
					<div class="league-image"><img src="<?=$leagues['image']?>" name="" alt="" title=""></div>
					<div class="league-name"><?= (isset($leagues['name'][COUNTRY_CODE])) ? $leagues['name'][COUNTRY_CODE] : $leagues['name']['default'];?></div>
				</a>
			</li>
			<?php 
				}
				// Cups
				if (isset($content['title']['cups'][COUNTRY_CODE]) && $content['title']['cups'][COUNTRY_CODE] != '' && !$slider) {
			?>
			<h2><?=$content['title']['cups'][COUNTRY_CODE]?></h2>
			<?php 
				}
				foreach ($content['content']['tournaments']['cups'] as $key => $cups) {
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<a href="<?= strtolower($this->normalizeString($content['section'][COUNTRY_CODE]))?>/<?= strtolower($this->normalizeString($content['title']['tournaments'][COUNTRY_CODE]))?>/<?= strtolower($this->normalizeString($content['title']['cups'][COUNTRY_CODE]))?>/<?=$key?>" class="content-league">
					<div class="league-image"><img src="<?=$cups['image']?>" name="" alt="" title=""></div>
					<div class="league-name"><?= (isset($cups['name'][COUNTRY_CODE])) ? $cups['name'][COUNTRY_CODE] : $cups['name']['default'];?></div>
				</a>
			</li>
			<?php 
				}
				// Soccer Team
				if (isset($content['title']['selections'][COUNTRY_CODE]) && $content['title']['selections'][COUNTRY_CODE] != '' && !$slider) {
					?>
					<h2><?=$content['title']['selections'][COUNTRY_CODE]?></h2>
					<?php 
						}
						foreach ($content['content']['tournaments']['selections'] as $key => $selections) {
					?>
					<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
					<a href="<?= strtolower($this->normalizeString($content['section'][COUNTRY_CODE]))?>/<?= strtolower($this->normalizeString($content['title']['tournaments'][COUNTRY_CODE]))?>/<?= strtolower($this->normalizeString($content['title']['selections'][COUNTRY_CODE]))?>/<?=$key?>" class="content-league">
							<div class="league-image"><img src="<?=$selections['image']?>" name="" alt="" title=""></div>
							<div class="league-name"><?= (isset($selections['name'][COUNTRY_CODE])) ? $selections['name'][COUNTRY_CODE] : $selections['name']['default'];?></div>
						</a>
					</li>
					<?php 
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
	<?php } ?>
</section>