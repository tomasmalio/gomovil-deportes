<section class="leagueslist">
	<?php if (isset($content['search']['display']) && $content['search']['display']) {?>
	<div class="content-league">
		<div class="league-image"><img src="<?=$content['tournaments'][$content['search']['type']][$content['search']['tournament']]['image']?>" name="" alt="<?= (isset($content['tournaments'][$content['search']['type']][$content['search']['tournament']]['name'][COUNTRY_CODE])) ? $content['tournaments'][$content['search']['type']][$content['search']['tournament']]['name'][COUNTRY_CODE] : $content['tournaments'][$content['search']['type']][$content['search']['tournament']]['name']['default']?>" title="<?= (isset($content['tournaments'][$content['search']['type']][$content['search']['tournament']]['name'][COUNTRY_CODE])) ? $content['tournaments'][$content['search']['type']][$content['search']['tournament']]['name'][COUNTRY_CODE] : $content['tournaments'][$content['search']['type']][$content['search']['tournament']]['name']['default']?>"></div>
		<div class="league-name"><?= (isset($content['tournaments'][$content['search']['type']][$content['search']['tournament']]['name'][COUNTRY_CODE])) ? $content['tournaments'][$content['search']['type']][$content['search']['tournaments']]['name'][COUNTRY_CODE] : $content['tournaments'][$content['search']['type']][$content['search']['tournaments']]['name']['default'];?></div>
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
				foreach ($content['tournaments']['leagues'] as $key => $leagues) {
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<a href="?s=torneos&filter1=ligas&filter2=<?=$key?>" class="content-league">
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
				foreach ($content['tournaments']['cups'] as $key => $cups) {
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<a href="?s=torneos&filter1=copas&filter2=<?=$key?>" class="content-league">
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
						foreach ($content['tournaments']['selections'] as $key => $selections) {
					?>
					<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
						<a href="?s=torneos&filter1=selecciones&filter2=<?=$key?>" class="content-league">
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