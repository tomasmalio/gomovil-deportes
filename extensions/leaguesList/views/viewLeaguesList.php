<section class="leagueslist">
	<?php if (isset($content['search']['display']) && $content['search']['display']) {?>
	<a href="tournament.php?filter1=<?=$content['search']['type'];?>&filter2=<?=$content['search']['tournament'];?>" class="content-league">
		<div class="league-image"><img src="<?=$content['tournament'][$content['search']['type']][$content['search']['tournament']]['image']?>" name="" alt="" title=""></div>
		<div class="league-name"><?= (isset($content['tournament'][$content['search']['type']][$content['search']['tournament']]['name'][COUNTRY_CODE])) ? $content['tournament'][$content['search']['type']][$content['search']['tournament']]['name'][COUNTRY_CODE] : $content['tournament'][$content['search']['type']][$content['search']['tournament']]['name']['default'];?></div>
	</a>
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
				foreach ($content['tournament']['leagues'] as $key => $leagues) {
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<a href="?s=tournament&filter1=leagues&filter2=<?=$key?>" class="content-league">
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
				foreach ($content['tournament']['cups'] as $key => $cups) {
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<a href="?s=tournament&filter1=cups&filter2=<?=$key?>" class="content-league">
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
						foreach ($content['tournament']['selections'] as $key => $selections) {
					?>
					<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
						<a href="?s=tournament&filter1=selections&filter2=<?=$key?>" class="content-league">
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