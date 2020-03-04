<?php
	$scorers = $content['content'];
	if (isset($scorers) && count($scorers) > 0) {
?>
<section class="scorerslistfootball">
	<h2><?php if (isset($content['titles']['scorers'][COUNTRY_CODE])) { echo $content['titles']['scorers'][COUNTRY_CODE]; } else { echo $content['titles']['scorers']['default'];}?></h2>
	<div class="content-list-teams">
		<div class="titles-list">
			<div class="title-team"><?php if (isset($content['titles']['player'][COUNTRY_CODE])) { echo $content['titles']['player'][COUNTRY_CODE]; } else { echo $content['titles']['player']['default'];}?></div>
			<div class="title-points"><?php if (isset($content['titles']['goals'][COUNTRY_CODE])) { echo $content['titles']['goals'][COUNTRY_CODE]; } else { echo $content['titles']['goals']['default'];}?></div>
			<div class="clearfix"></div>
		</div>
		<div class="results-list">
			<?php
				$i = 1;
				foreach ($scorers as $s => $player) {
					if (isset($_SESSION['clientConfig']->sports->football->display_original_image) && $_SESSION['clientConfig']->sports->football->display_original_image) {
						$team_image = $_SESSION['clientConfig']->sports->football->url_images . Widgets::normalizeString($player['country']) . '/' . Widgets::normalizeString($player['name']) .'.png';
					} else {
						$team_image = $player['team_shield'];
					}
			?>
			<div class="result">
				<div class="position"><?=$i?></div>
				<div class="team-shield"><img src="<?=$team_image?>" name="scorer" alt="<?=$player['team']?>" title="<?=$player['team']?>"></div>
				<div class="team-name"><?=$player['name']?></div>
				<div class="results-points"><?=$player['goals']?></div>
				<div class="clearfix"></div>
			</div>
			<?php
					if (isset($content['max_players']) && $content['max_players'] == $i) {
						break;
					}
					$i++;
				}
			?>
		</div>
	</div>
</section>
<?php }?>