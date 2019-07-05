<?php //print_r($content)?>
<?php
	$scorers = $content['content'];
	if (isset($scorers) && count($scorers) > 0) {
?>
<section class="scorerslistfootball">
	<h2><?=$content['title']?></h2>
	<div class="content-list-teams">
		<div class="titles-list">
			<div class="title-team">Equipo</div>
			<div class="title-points">Pts</div>
			<div class="title-lost">PP</div>
			<div class="title-tied">PE</div>
			<div class="title-won">PG</div>
			<div class="title-played">PJ</div>
			<div class="clearfix"></div>
		</div>
		<div class="results-list">
			<?php 
				foreach ($scorers as $player) {
			?>
			<div class="result">
				<div class="position"><?=$score['position']?></div>
				<div class="team-shield"><img src="<?=$score['team_shield']?>" name="" alt="" title=""></div>
				<div class="team-name"><?=$score['team']?></div>
				<div class="results-points"><?=$score['points']?></div>
				<div class="results-lost"><?=$score['lost']?></div>
				<div class="results-tied"><?=$score['tied']?></div>
				<div class="results-won"><?=$score['won']?></div>
				<div class="results-played"><?=$score['played']?></div>
				<div class="clearfix"></div>
			</div>
			<?php }?>
		</div>
	</div>
</section>
<?php }?>