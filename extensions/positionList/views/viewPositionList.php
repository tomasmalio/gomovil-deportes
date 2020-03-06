<?php
	$positions = $content['content']['positions'];
	// Validate that there're position content
	if (isset($positions) && count($positions) > 0 && $positions != NULL) {
?>
<section class="positionlist">
	<h2><?=$content['title']?></h2>
	<?php 
	/**
	 * Positions for leagues
	 */
	if ($content['type'] == 'leagues' || $content['type'] == 'liga' || $content['type'] == 'ligas'){
	?>
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
			
				foreach ($positions as $score) {
					if (isset($_SESSION['clientConfig']->sports->football->display_original_image) && $_SESSION['clientConfig']->sports->football->display_original_image) {
						$team_image = $_SESSION['clientConfig']->sports->football->url_images . Widgets::normalizeString($score['country']) . '/' . Widgets::normalizeString($score['team']) .'.png';
					} else {
						$team_image = $score['team_shield'];
					}
			?>
			<div class="result">
				<div class="position"><?=$score['position']?></div>
				<div class="team-shield"><img src="<?=$team_image;?>" name="<?=Widgets::normalizeString($score['position'])?>" alt="<?=$score['team']?>" title="<?=$score['team']?>"></div>
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
	<?php 
	}
	/**
	 * Positions for Cups & Selections
	 */
	else {
		print_r($positions);
	?>
		<?php foreach ($positions as $key => $group) {?>
 		<div class="content-list-teams">
			<h3><?=$key?></h3>
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
					$positions = $content['content']['positions'];
					foreach ($group as $score) {
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
				<?php 
					}
				?>
			</div>
		</div>
		<?php }?>
	<?php }?>
</section>
<?php } // Eof position list?>