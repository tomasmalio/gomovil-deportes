<section class="scores-list">
	<?php if (isset($content['title'])){?><h2><?=$content['title']?></h2><?php }?>
	<div class="content-list-players">
		<div class="titles-list">
			<div class="title-player-name"><?= $content['titles']['player'][COUNTRY_CODE]?></div>
			<div class="title-goals"><?= $content['titles']['goals'][COUNTRY_CODE]?></div>
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