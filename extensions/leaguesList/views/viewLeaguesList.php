<?php 
	print_r($content['content']);
	$type = '';
	switch ($content['search']['type']) {
		case 'liga':
		case 'ligas':
			$type = 'leagues';
			break;
		case 'copa':
		case 'copas':
			$type = 'cups';
			break;
		case 'seleccion':
		case 'selecciones':
			$type = 'selections';
			break;
	}
?>
<section class="leagueslist">
	<?php if (isset($content['content']['search']['display']) && $content['content']['search']['display']) {?>
	<div class="content-league">
		<div class="league-image"><img src="http://images.degoles.com/tournaments/<?=$content['key']?>.png" name="tournamentlogo" alt=""></div>
		<div class="league-name"><?= (isset($content['tournaments'][$type][$leagues['key']]['name'][COUNTRY_CODE])) ? $content['tournaments'][$type][$leagues['key']]['name'][COUNTRY_CODE] : (isset($content['tournaments'][$type][$leagues['key']]['name']['default'])) ? $content['tournaments'][$type][$leagues['key']]['name']['default'] : $content['content']['name'];?></div>
	</div>
	<?php 
		} else {
	?>
	<div class="leagueslist-content <?php if ($slider) {?>swiper-container<?php }?>">
		<ul class="list-leagues<?php if ($slider) {?>-slider swiper-wrapper<?php } elseif (isset($content['position']) && $content['position'] == 'horizontal') {?>-horizontal<?php }?>">
			<?php
				// Leagues
				if (!$slider) {
					if (isset($content['titles']['leagues'][COUNTRY_CODE]) && $content['titles']['leagues'][COUNTRY_CODE] != '') {
						if ((isset($content['leagues_display_name']) && $content['leagues_display_name']) || !isset($content['leagues_display_name'])) {
			?>
			<h2><?=$content['titles']['leagues'][COUNTRY_CODE]?></h2>
			<?php 
						}
					} else if (isset($content['titles']['leagues']['default']) && $content['titles']['leagues']['default'] != '') {
						if ((isset($content['leagues_display_name']) && $content['leagues_display_name']) || !isset($content['leagues_display_name'])) {
			?>
			<h2><?=$content['titles']['leagues']['default']?></h2>
			<?php
						}
					}
				}
				foreach ($content['content']['leagues'] as $leagues) {
					if (in_array($leagues['key'], $_SESSION['clientConfig']->sports->football->available_tournaments)) {
						$url = DOMAIN . '/' . ((isset($content['section'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['section'][COUNTRY_CODE])) : strtolower($this->normalizeString($content['section']['default']))) . '/' . ((isset($content['titles']['tournaments'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['titles']['tournaments'][COUNTRY_CODE])) :  strtolower($this->normalizeString($content['titles']['tournaments']['default']))) . '/' . ((isset($content['titles']['leagues'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['titles']['leagues'][COUNTRY_CODE])) :  strtolower($this->normalizeString($content['titles']['leagues']['default']))) . '/' . $leagues['key'];
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<a href="<?=$url?>" class="<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>content-league<?php }?>">
					<?php if (isset($content['position']) && $content['position'] == 'horizontal') {?>
					<div class="card">
					<?php }?>
					<div class="<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>league-image<?php } else {?>card-img<?php }?>"><img src="http://images.degoles.com/tournaments/<?=$leagues['key']?>.png" name="" alt="" title=""></div>
					<?php if (isset($content['position']) && $content['position'] == 'horizontal') {?>
					</div>
					<?php }?>
					<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>
					<div class="league-name"><?= (isset($leagues['name'][COUNTRY_CODE])) ? $leagues['name'][COUNTRY_CODE] : $leagues['name']['default'];?></div>
					<?php } else {?>
					<h5><?= (isset($content['tournaments']['leagues'][$leagues['key']]['name'][COUNTRY_CODE])) ? $content['tournaments']['leagues'][$leagues['key']]['name'][COUNTRY_CODE] : (isset($content['tournaments']['leagues'][$leagues['key']]['name']['default'])) ? $content['tournaments']['leagues'][$leagues['key']]['name']['default'] : $leagues['name'];?></h5>
					<?php }?>
				</a>
			</li>
			<?php 
					}
				}
				// Cups
				if (!$slider) {
					if (isset($content['titles']['cups'][COUNTRY_CODE]) && $content['titles']['cups'][COUNTRY_CODE] != '') {
						if ((isset($content['leagues_display_name']) && $content['leagues_display_name']) || !isset($content['leagues_display_name'])) {
			?>
			<h2><?=$content['titles']['cups'][COUNTRY_CODE]?></h2>
			<?php 
						}
					} else if (isset($content['titles']['cups']['default']) && $content['titles']['cups']['default'] != '') {
						if ((isset($content['leagues_display_name']) && $content['leagues_display_name']) || !isset($content['leagues_display_name'])) {
			?>
			<h2><?=$content['titles']['cups']['default']?></h2>
			<?php
						}
					}
				}
				foreach ($content['content']['cups'] as $key => $cups) {
					if (in_array($cups['key'], $_SESSION['clientConfig']->sports->football->available_tournaments)) {
						$url = DOMAIN . '/' . ((isset($content['section'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['section'][COUNTRY_CODE])) : strtolower($this->normalizeString($content['section']['default']))) . '/' . ((isset($content['titles']['tournaments'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['titles']['tournaments'][COUNTRY_CODE])) :  strtolower($this->normalizeString($content['titles']['tournaments']['default']))) . '/' . ((isset($content['titles']['cups'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['titles']['cups'][COUNTRY_CODE])) :  strtolower($this->normalizeString($content['titles']['cups']['default']))) . '/' . $cups['key'];
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<a href="<?=$url?>" class="<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>content-league<?php }?>">
					<?php if (isset($content['position']) && $content['position'] == 'horizontal') {?>
					<div class="card">
					<?php }?>
					<div class="<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>league-image<?php } else {?>card-img<?php }?>"><img src="http://images.degoles.com/tournaments/<?=$cups['key']?>.png" name="" alt="" title=""></div>
					<?php if (isset($content['position']) && $content['position'] == 'horizontal') {?>
					</div>
					<?php }?>
					<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>
					<div class="league-name"><?= (isset($cups['name'][COUNTRY_CODE])) ? $cups['name'][COUNTRY_CODE] : $cups['name']['default'];?></div>
					<?php } else {?>
					<h5><?= (isset($content['tournaments']['cups'][$cups['key']]['name'][COUNTRY_CODE])) ? $content['tournaments']['cups'][$cups['key']]['name'][COUNTRY_CODE] : (isset($content['tournaments']['cups'][$cups['key']]['name']['default'])) ? $content['tournaments']['cups'][$cups['key']]['name']['default'] : $cups['name'];?></h5>
					<?php }?>
				</a>
			</li>
			<?php 
					}
				}
				// Soccer Team
				if (!$slider) {
					if (isset($content['titles']['selections'][COUNTRY_CODE]) && $content['titles']['selections'][COUNTRY_CODE] != '') {
						if ((isset($content['leagues_display_name']) && $content['leagues_display_name']) || !isset($content['leagues_display_name'])) {
			?>
			<h2><?=$content['titles']['selections'][COUNTRY_CODE]?></h2>
			<?php 
						}
					} else if (isset($content['titles']['selections']['default']) && $content['titles']['selections']['default'] != '') {
						if ((isset($content['leagues_display_name']) && $content['leagues_display_name']) || !isset($content['leagues_display_name'])) {
			?>
			<h2><?=$content['titles']['selections']['default']?></h2>
			<?php
							}
						}
					}
					
					foreach ($content['content']['selections'] as $key => $selections) {
						if (in_array($selections['key'], $_SESSION['clientConfig']->sports->football->available_tournaments)) {
							$url = DOMAIN . '/' . ((isset($content['section'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['section'][COUNTRY_CODE])) : strtolower($this->normalizeString($content['section']['default']))) . '/' . ((isset($content['titles']['tournaments'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['titles']['tournaments'][COUNTRY_CODE])) :  strtolower($this->normalizeString($content['titles']['tournaments']['default']))) . '/' . ((isset($content['titles']['selections'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['titles']['selections'][COUNTRY_CODE])) :  strtolower($this->normalizeString($content['titles']['selections']['default']))) . '/' . $selections['key'];
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<a href="<?=$url?>" class="<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>content-league<?php }?>">
					<?php if (isset($content['position']) && $content['position'] == 'horizontal') {?>
					<div class="card">
					<?php }?>
					<div class="<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>league-image<?php } else {?>card-img<?php }?>"><img src="http://images.degoles.com/tournaments/<?=$selections['key']?>.png" name="" alt="" title=""></div>
					<?php if (isset($content['position']) && $content['position'] == 'horizontal') {?>
					</div>
					<?php }?>
					<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>
					<div class="league-name"><?= (isset($selections['name'][COUNTRY_CODE])) ? $selections['name'][COUNTRY_CODE] : $selections['name']['default'];?></div>
					<?php } else {?>
					<h5><?= (isset($content['tournaments']['selection'][$selections['key']]['name'][COUNTRY_CODE])) ? $content['tournaments']['selections'][$selections['key']]['name'][COUNTRY_CODE] : (isset($content['tournaments']['selections'][$selections['key']]['name']['default'])) ? $content['tournaments']['selections'][$selections['key']]['name']['default'] : $selections['name'];?></h5>
					<?php }?>
				</a>
			</li>
			<?php
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
	<?php } ?>
</section>