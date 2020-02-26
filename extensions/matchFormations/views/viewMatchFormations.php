<section class="matchformations">
	<h2><?php if (isset($content['titles']['formations'][COUNTRY_CODE])) { echo $content['titles']['formations'][COUNTRY_CODE]; } else { echo $content['titles']['formations']['default'];}?></h2>
	<div class="alignment-content">
		<div class="row" style="position:relative;">
			<!-- First team -->
			<div class="col-6 positions-left">
				<?php foreach ($content['content']['local'] as $team_local) {?>
				<div class="player-account">
					<div class="player">
						<i class="number"><?=$team_local['number'];?></i> 
						<div class="player-name"><?=$team_local['player_name'] . " " . $team_local['player_last_name'];?></div>
					</div>
				</div>
				<?php }?>
			</div>
			<!-- Eof first team -->
			<div class="vertical-line"></div>
			<div class="versus" style="left: 183.5px; top: 137px;">vs</div>
			<script type="text/javascript">
				// Alignment of the versus icon
				$(document).ready(function () { 
					$(".alignment-content .versus").css("left", ($(".alignment-content").innerWidth() / 2));
					$(".alignment-content .versus").css("top", ($(".alignment-content").innerHeight() / 2));
				});
			</script>
			<!-- Second team -->
			<div class="col-6 positions-right">
				<?php foreach ($content['content']['visit'] as $team_visit) {?>
				<div class="player-account">
					<div class="player">
						<div class="player-name"><?=$team_visit['player_name'] . " " . $team_visit['player_last_name'];?></div>
						<i class="number"><?=$team_visit['number'];?></i> 
					</div>
				</div>
				<?php }?>
			</div>
		</div>
	</div>
</section>