<?php
echo "<pre>";
print_r($content);
echo "</pre>";
// exit;
// $_SESSION['clientConfig']->sports->football->available_tournaments
?>
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
				foreach ($content['content']['tournaments']['leagues'] as $key => $leagues) {
					$validateName = '';
					if (isset($leagues['name'][COUNTRY_CODE])){
						$validateName = $this->normalizeString($leagues['name'][COUNTRY_CODE]);
					} else {
						$validateName = $this->normalizeString($leagues['name']['default']);
					}
				
					if (in_array($validateName, $_SESSION['clientConfig']->sports->football->available_tournaments)) {
						$url = DOMAIN . '/' . ((isset($content['section'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['section'][COUNTRY_CODE])) : strtolower($this->normalizeString($content['section']['default']))) . '/' . ((isset($content['titles']['tournaments'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['titles']['tournaments'][COUNTRY_CODE])) :  strtolower($this->normalizeString($content['titles']['tournaments']['default']))) . '/' . ((isset($content['titles']['leagues'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['titles']['leagues'][COUNTRY_CODE])) :  strtolower($this->normalizeString($content['titles']['leagues']['default']))) . '/' . $key;
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<a href="<?=$url?>" class="<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>content-league<?php }?>">
					<?php if (isset($content['position']) && $content['position'] == 'horizontal') {?>
					<div class="card">
					<?php }?>
					<div class="<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>league-image<?php } else {?>card-img<?php }?>"><img src="<?=$leagues['image']?>" name="" alt="" title=""></div>
					<?php if (isset($content['position']) && $content['position'] == 'horizontal') {?>
					</div>
					<?php }?>
					<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>
					<div class="league-name"><?= (isset($leagues['name'][COUNTRY_CODE])) ? $leagues['name'][COUNTRY_CODE] : $leagues['name']['default'];?></div>
					<?php } else {?>
					<h5><?= (isset($leagues['name'][COUNTRY_CODE])) ? $leagues['name'][COUNTRY_CODE] : $leagues['name']['default'];?></h5>
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
				foreach ($content['content']['tournaments']['cups'] as $key => $cups) {
					$validateName = '';
					if (isset($cups['name'][COUNTRY_CODE])){
						$validateName = $this->normalizeString($cups['name'][COUNTRY_CODE]);
					} else {
						$validateName = $this->normalizeString($cups['name']['default']);
					}
					if (in_array($validateName, $_SESSION['clientConfig']->sports->football->available_tournaments)) {
						$url = DOMAIN . '/' . ((isset($content['section'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['section'][COUNTRY_CODE])) : strtolower($this->normalizeString($content['section']['default']))) . '/' . ((isset($content['titles']['tournaments'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['titles']['tournaments'][COUNTRY_CODE])) :  strtolower($this->normalizeString($content['titles']['tournaments']['default']))) . '/' . ((isset($content['titles']['cups'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['titles']['cups'][COUNTRY_CODE])) :  strtolower($this->normalizeString($content['titles']['cups']['default']))) . '/' . $key;
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<a href="<?=$url?>" class="<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>content-league<?php }?>">
					<?php if (isset($content['position']) && $content['position'] == 'horizontal') {?>
					<div class="card">
					<?php }?>
					<div class="<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>league-image<?php } else {?>card-img<?php }?>"><img src="<?=$cups['image']?>" name="" alt="" title=""></div>
					<?php if (isset($content['position']) && $content['position'] == 'horizontal') {?>
					</div>
					<?php }?>
					<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>
					<div class="league-name"><?= (isset($cups['name'][COUNTRY_CODE])) ? $cups['name'][COUNTRY_CODE] : $cups['name']['default'];?></div>
					<?php } else {?>
					<h5><?= (isset($cups['name'][COUNTRY_CODE])) ? $cups['name'][COUNTRY_CODE] : $cups['name']['default'];?></h5>
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
					
					foreach ($content['content']['tournaments']['selections'] as $key => $selections) {
						$validateName = '';
						if (isset($selections['name'][COUNTRY_CODE])){
							$validateName = $this->normalizeString($selections['name'][COUNTRY_CODE]);
						} else {
							$validateName = $this->normalizeString($selections['name']['default']);
						}
						if (in_array($validateName, $_SESSION['clientConfig']->sports->football->available_tournaments)) {
							$url = DOMAIN . '/' . ((isset($content['section'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['section'][COUNTRY_CODE])) : strtolower($this->normalizeString($content['section']['default']))) . '/' . ((isset($content['titles']['tournaments'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['titles']['tournaments'][COUNTRY_CODE])) :  strtolower($this->normalizeString($content['titles']['tournaments']['default']))) . '/' . ((isset($content['titles']['selections'][COUNTRY_CODE])) ? strtolower($this->normalizeString($content['titles']['selections'][COUNTRY_CODE])) :  strtolower($this->normalizeString($content['titles']['selections']['default']))) . '/' . $key;
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<a href="<?=$url?>" class="<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>content-league<?php }?>">
					<?php if (isset($content['position']) && $content['position'] == 'horizontal') {?>
					<div class="card">
					<?php }?>
					<div class="<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>league-image<?php } else {?>card-img<?php }?>"><img src="<?=$selections['image']?>" name="" alt="" title=""></div>
					<?php if (isset($content['position']) && $content['position'] == 'horizontal') {?>
					</div>
					<?php }?>
					<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>
					<div class="league-name"><?= (isset($selections['name'][COUNTRY_CODE])) ? $selections['name'][COUNTRY_CODE] : $selections['name']['default'];?></div>
					<?php } else {?>
					<h5><?= (isset($selections['name'][COUNTRY_CODE])) ? $selections['name'][COUNTRY_CODE] : $selections['name']['default'];?></h5>
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