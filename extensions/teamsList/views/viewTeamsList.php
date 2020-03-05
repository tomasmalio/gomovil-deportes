<section class="teamslist">
	<div class="content-teams <?php if ($slider) {?>swiper-container<?php }?>">
		<ul class="list-teams<?php if ($slider) {?>-slider swiper-wrapper<?php } if (isset($content['position']) && $content['position'] == 'horizontal') {?> horizontal<?php }?>">
			<?php
				foreach ($content['content'] as $team) {
					if (isset($_SESSION['clientConfig']->sports->football->display_original_image) && $_SESSION['clientConfig']->sports->football->display_original_image) {
						$team_image = $_SESSION['clientConfig']->sports->football->url_images . Widgets::normalizeString($team['country']) . '/' . Widgets::normalizeString($team['name']) .'.png';
					} else {
						$team_image = $team['team_shield'];
					}
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<a href="<?=$url?>" class="<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>content-league<?php }?>">
					<div class="<?php if ((isset($content['position']) && $content['position'] == 'vertical') || !isset($content['position'])) {?>team-image<?php } else {?>card-img<?php }?>">
						<img src="<?=$team_image?>" name="<?=Widgets::normalizeString($team['name']);?>" alt="<?=$team['name']?>" title="<?=$team['name']?>">
					</div>
				</a>
			</li>
			<?php }?>
		</ul>
	</div>
</section>