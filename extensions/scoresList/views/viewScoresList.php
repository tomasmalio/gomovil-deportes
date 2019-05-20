<?php //print_r($content)?>
<section class="scores-list">
	<h2><?=$title?></h2>
	<div class="content-list-players">
		<div class="titles-list">
			<div class="title-player-name">Jugador</div>
			<div class="title-goals">Goles</div>
			<div class="clearfix"></div>
		</div>
		<div class="results-list">
			<?php foreach ($content as $score) {?>
			<div class="result">
				<div class="position"><?=$score['position']?></div>
				<div class="team-shield"><img src="<?=$score['team_shield']?>" name="" alt="" title=""></div>
				<div class="player"><?=$score['player_complete_name']?></div>
				<div class="goals"><?=$score['goals']?></div>
				<div class="clearfix"></div>
			</div>
			<?php }?>
		</div>
	</div>
</section>