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
				if (!$slider) {
					if (isset($content['titles']['leagues'][COUNTRY_CODE]) && $content['titles']['leagues'][COUNTRY_CODE] != '') {
			?>
			<h2><?=$content['titles']['leagues'][COUNTRY_CODE]?></h2>
			<?php 
					} else if (isset($content['titles']['leagues']['default']) && $content['titles']['leagues']['default'] != '') {
			?>
			<h2><?=$content['titles']['leagues']['default']?></h2>
			<?php
					}
				}
				foreach ($content['content']['tournaments']['leagues'] as $key => $leagues) {
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
			<?php 
				// $url = '';
				// $url .= 
				$url = DOMAIN . '/'. (isset($content['section'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['section'][COUNTRY_CODE])) : strtolower($this->normalizeString($content['section']['default'])) . '/' . (isset($content['titles']['tournaments'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['titles']['tournaments'][COUNTRY_CODE])) : $content['titles']['tournaments']['default'] . '/' . (isset($content['titles']['leagues'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['titles']['leagues'][COUNTRY_CODE])) : $content['titles']['leagues']['default'] . '/' . $key; 
				// $url .= ;
				// $url .= ;
				// $url .= ;
				// $url .= ;
				// $url .= ;
				// $url .= ;
			?>
				<a href="<?=$url?>" class="content-league">
					<div class="league-image"><img src="<?=$leagues['image']?>" name="" alt="" title=""></div>
					<div class="league-name"><?= (isset($leagues['name'][COUNTRY_CODE])) ? $leagues['name'][COUNTRY_CODE] : $leagues['name']['default'];?></div>
				</a>
			</li>
			<?php 
				}
				if (!$slider) {
					if (isset($content['titles']['cups'][COUNTRY_CODE]) && $content['titles']['cups'][COUNTRY_CODE] != '') {
			?>
			<h2><?=$content['titles']['cups'][COUNTRY_CODE]?></h2>
			<?php 
					} else if (isset($content['titles']['cups']['default']) && $content['titles']['cups']['default'] != '') {
			?>
			<h2><?=$content['titles']['cups']['default']?></h2>
			<?php
					}
				}
				foreach ($content['content']['tournaments']['cups'] as $key => $cups) {
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<a href="<?= strtolower($this->normalizeString($content['section'][COUNTRY_CODE]))?>/<?= strtolower($this->normalizeString($content['titles']['tournaments'][COUNTRY_CODE]))?>/<?= strtolower($this->normalizeString($content['titles']['cups'][COUNTRY_CODE]))?>/<?=$key?>" class="content-league">
					<div class="league-image"><img src="<?=$cups['image']?>" name="" alt="" title=""></div>
					<div class="league-name"><?= (isset($cups['name'][COUNTRY_CODE])) ? $cups['name'][COUNTRY_CODE] : $cups['name']['default'];?></div>
				</a>
			</li>
			<?php 
				}
				// Soccer Team
				if (!$slider) {
					if (isset($content['titles']['selections'][COUNTRY_CODE]) && $content['titles']['selections'][COUNTRY_CODE] != '') {
			?>
			<h2><?=$content['titles']['selections'][COUNTRY_CODE]?></h2>
			<?php 
					} else if (isset($content['titles']['selections']['default']) && $content['titles']['selections']['default'] != '') {
			?>
			<h2><?=$content['titles']['selections']['default']?></h2>
			<?php
					}
				}
				foreach ($content['content']['tournaments']['selections'] as $key => $selections) {
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
			<a href="<?= strtolower($this->normalizeString($content['section'][COUNTRY_CODE]))?>/<?= strtolower($this->normalizeString($content['titles']['tournaments'][COUNTRY_CODE]))?>/<?= strtolower($this->normalizeString($content['titles']['selections'][COUNTRY_CODE]))?>/<?=$key?>" class="content-league">
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