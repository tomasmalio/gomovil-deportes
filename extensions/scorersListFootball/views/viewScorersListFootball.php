<?php
	$scorers = $content['content'];
	if (isset($scorers) && count($scorers) > 0) {
?>
<section class="scorerslistfootball">
	<h2><?=$content['title']?></h2>
	<div class="content-list-teams">
		<div class="titles-list">
			<div class="title-team">Nombre</div>
			<div class="title-points">Goles</div>
			<div class="clearfix"></div>
		</div>
		<div class="results-list">
			<?php
				$i = 1;
				foreach ($scorers as $s => $player) {
			?>
			<div class="result">
				<div class="position"><?=$i?></div>
				<div class="team-shield"><img src="<?=$player['team_shield']?>" name="" alt="" title=""></div>
				<div class="team-name"><?=$player['name']?></div>
				<div class="results-points"><?=$player['goals']?></div>
				<div class="clearfix"></div>
			</div>
			<?php 
					$i++;
				}
			?>
		</div>
	</div>
</section>
<?php }?>