<section class="leagues-list">
	<?php if (isset($content['search']['display']) && $content['search']['display']) {?>
	<a href="tournament.php?type=<?=$content['search']['type'];?>&tournament=<?=$content['search']['tournament'];?>" class="content-league">
		<div class="league-image"><img src="<?=$content['tournaments'][$content['search']['type']][$content['search']['tournament']]['image']?>" name="" alt="" title=""></div>
		<div class="league-name"><?=$content['tournaments'][$content['search']['type']][$content['search']['tournament']]['name']?></div>
	</a>
	<?php 
		} else {
	?>
	<div class="leagues-list-content <?php if ($slider) {?>swiper-container<?php }?>">
		<ul class="list-leagues<?php if ($slider) {?>-slider swiper-wrapper<?php }?>">
			<?php
				// Leagues
				if (isset($title['ligas']) && $title['ligas'] != '' && !$slider) {
			?>
			<h2><?=$title['ligas']?></h2>
			<?php 
				}
				foreach ($content['tournaments']['ligas'] as $key => $leagues) {
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<a href="tournament.php?type=ligas&tournament=<?=$key?>" class="content-league">
					<div class="league-image"><img src="<?=$leagues['image']?>" name="" alt="" title=""></div>
					<div class="league-name"><?=$leagues['name']?></div>
				</a>
			</li>
			<?php 
				}
				// Cups
				if (isset($title['copas']) && $title['copas'] != '' && !$slider) {
			?>
			<h2><?=$title['copas']?></h2>
			<?php 
				}
				foreach ($content['tournaments']['copas'] as $key => $copas) {
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<a href="tournament.php?type=copas&tournament=<?=$key?>" class="content-league">
					<div class="league-image"><img src="<?=$copas['image']?>" name="" alt="" title=""></div>
					<div class="league-name"><?=$copas['name']?></div>
				</a>
			</li>
			<?php 
				}
				// Soccer Team
				if (isset($title['selecciones']) && $title['selecciones'] != '' && !$slider) {
					?>
					<h2><?=$title['selecciones']?></h2>
					<?php 
						}
						foreach ($content['tournaments']['selecciones'] as $key => $selecciones) {
					?>
					<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
						<a href="tournament.php?type=selecciones&tournament=<?=$key?>" class="content-league">
							<div class="league-image"><img src="<?=$selecciones['image']?>" name="" alt="" title=""></div>
							<div class="league-name"><?=$selecciones['name']?></div>
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