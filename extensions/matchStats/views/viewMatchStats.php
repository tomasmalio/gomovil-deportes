<?php
	$stats = $content['content'];
?>
<section class="match-stats">
	<!-- Match stats / Stats / Match / Match container -->
	<!-- <div class="title-section">Estadísticas del partido</div> -->
	<h2><?php if (isset($content['titles']['match_statistics'][COUNTRY_CODE])) { echo $content['titles']['match_statistics'][COUNTRY_CODE]; } else { echo $content['titles']['match_statistics']['default'];}?></h2>
	<div class="col-12 stats-content">
		<div class="row">
			<div class="col-12 center-block progress-content">
				<div class="row">
					<div class="col-6">
						<div class="progress-content-team d-none d-md-block">
							<span class="progress-content-team-shield-left"><img src="http://image.futmovil.com/56a26c0c6274c.png" title="Newell's" alt="Newell's"></span>
							<div class="progress-content-team-name left"><?=$stats['local_team']?></div>
						</div>
					</div>
					<div class="col-6">
						<div class="progress-content-team d-none d-md-block">
							<span class="progress-content-team-shield-right"><img src="http://image.futmovil.com/56a26ad5f32a7.png" title="Colón" alt="Colón"></span>
							<div class="progress-content-team-name right"><?=$stats['visit_team']?></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 center-block progress-content">
				<div class="row progress-result-info">
					<div class="col-2 stats-progress-result left"><?=$stats['stats']['local_team']['possession']?></div>
					<div class="col-8 stats-progress-description"><?php if (isset($content['titles']['ball_possession'][COUNTRY_CODE])) { echo $content['titles']['ball_possession'][COUNTRY_CODE]; } else { echo $content['titles']['ball_possession']['default'];}?></div>
					<div class="col-2 stats-progress-result right"><?=$stats['stats']['visit_team']['possession']?></div>
				</div>
				<div class="row">
					<div class="col-6 progress-bars-column left">
						<div class="progress flex-row-reverse">
							<div class="progress-bar progress-bar-success" role="progressbar" style="width: <?=$stats['stats']['local_team']['possession']?>;"></div>
						</div>
					</div>
					<div class="col-6 progress-bars-column right">
						<div class="progress">
							<div class="progress-bar progress-bar-success" role="progressbar" style="width: <?=$stats['stats']['visit_team']['possession']?>;"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- Goals -->
			<div class="col-12 center-block progress-content">
				<div class="row progress-result-info">
					<div class="col-2 stats-progress-result left" ng-bind="local_score"><?=$stats['local_gol']?></div>
					<div class="col-8 stats-progress-description"><?php if (isset($content['titles']['goals'][COUNTRY_CODE])) { echo $content['titles']['goals'][COUNTRY_CODE]; } else { echo $content['titles']['goals']['default'];}?></div>
					<div class="col-2 stats-progress-result right" ng-bind="visitor_score"><?=$stats['visit_gol']?></div>
				</div>
				<div class="row">
					<div class="col-6 progress-bars-column left">
						<div class="progress flex-row-reverse">
							<div class="progress-bar progress-bar-success" role="progressbar" style="width: <?=($stats['local_gol'] * 100)/ ($stats['local_gol'] + $stats['visit_gol']);?>%"></div>
						</div>
					</div>
					<div class="col-6 progress-bars-column right">
						<div class="progress">
							<div class="progress-bar progress-bar-success" role="progressbar" style="width: <?=($stats['visit_gol'] * 100)/ ($stats['local_gol'] + $stats['visit_gol']);?>%"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- Eof Goals  -->
			<!-- Total Shots on gol -->
			<div class="col-12 center-block progress-content">
				<div class="row progress-result-info">
					<div class="col-2 stats-progress-result left"><?=$stats['stats']['local_team']['shots_on_target']?></div>
					<div class="col-8 stats-progress-description"><?php if (isset($content['titles']['shots_on_target'][COUNTRY_CODE])) { echo $content['titles']['shots_on_target'][COUNTRY_CODE]; } else { echo $content['titles']['shots_on_target']['default'];}?></div>
					<div class="col-2 stats-progress-result right"><?=$stats['stats']['visit_team']['shots_on_target']?></div>
				</div>
				<div class="row">
					<div class="col-6 progress-bars-column left">
						<div class="progress flex-row-reverse">
							<div class="progress-bar progress-bar-success" role="progressbar" style="width: <?=($stats['stats']['local_team']['shots_on_target'] * 100) / ($stats['stats']['local_team']['shots_on_target'] + $stats['stats']['visit_team']['shots_on_target']);?>%"></div>
						</div>
					</div>
					<div class="col-6 progress-bars-column right">
						<div class="progress">
							<div class="progress-bar progress-bar-success" role="progressbar" style="width: <?=($stats['stats']['visit_team']['shots_on_target'] * 100) / ($stats['stats']['local_team']['shots_on_target'] + $stats['stats']['visit_team']['shots_on_target']);?>%"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- Eof Total Shots on gol -->
			<!-- Total Shots -->
			<div class="col-12 center-block progress-content">
				<div class="row progress-result-info">
					<div class="col-2 stats-progress-result left"><?=$stats['stats']['local_team']['shots']?></div>
					<div class="col-8 stats-progress-description"><?php if (isset($content['titles']['total_shots'][COUNTRY_CODE])) { echo $content['titles']['total_shots'][COUNTRY_CODE]; } else { echo $content['titles']['totals_shots']['default'];}?></div>
					<div class="col-2 stats-progress-result right"><?=$stats['stats']['visit_team']['shots']?></div>
				</div>
				<div class="row">
					<div class="col-6 progress-bars-column left">
						<div class="progress flex-row-reverse">
							<div class="progress-bar progress-bar-success" role="progressbar" style="width: <?=($stats['stats']['local_team']['shots'] * 100) / ($stats['stats']['local_team']['shots'] + $stats['stats']['visit_team']['shots']);?>%"></div>
						</div>
					</div>
					<div class="col-6 progress-bars-column right">
						<div class="progress">
							<div class="progress-bar progress-bar-success" role="progressbar" style="width: <?=($stats['stats']['visit_team']['shots'] * 100) / ($stats['stats']['local_team']['shots'] + $stats['stats']['visit_team']['shots']);?>%"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- Eof Total Shots -->
			<!-- Total Saves -->
			<div class="col-12 center-block progress-content">
				<div class="row progress-result-info">
					<div class="col-2 stats-progress-result left"><?=$stats['stats']['local_team']['tied']?></div>
					<div class="col-8 stats-progress-description"><?php if (isset($content['titles']['tied'][COUNTRY_CODE])) { echo $content['titles']['tied'][COUNTRY_CODE]; } else { echo $content['titles']['tied']['default'];}?></div>
					<div class="col-2 stats-progress-result right"><?=$stats['stats']['visit_team']['tied']?></div>
				</div>
				<div class="row">
					<div class="col-6 progress-bars-column left">
						<div class="progress flex-row-reverse">
							<div class="progress-bar progress-bar-success" role="progressbar" style="width: <?=($stats['stats']['local_team']['tied'] * 100) / ($stats['stats']['local_team']['tied'] + $stats['stats']['visit_team']['tied']);?>%"></div>
						</div>
					</div>
					<div class="col-6 progress-bars-column right">
						<div class="progress">
							<div class="progress-bar progress-bar-success" role="progressbar" style="width: <?=($stats['stats']['visit_team']['tied'] * 100) / ($stats['stats']['local_team']['tied'] + $stats['stats']['visit_team']['tied']);?>%"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- EOF Total Saves -->
			<!-- Total Fouls-->
			<div class="col-12 center-block progress-content">
				<div class="row progress-result-info">
					<div class="col-2 stats-progress-result left">4</div>
					<div class="col-8 stats-progress-description"><?php if (isset($content['titles']['fouls_committed'][COUNTRY_CODE])) { echo $content['titles']['fouls_committed'][COUNTRY_CODE]; } else { echo $content['titles']['fouls_committed']['default'];}?></div>
					<div class="col-2 stats-progress-result right">4</div>
				</div>
				<div class="row">
					<div class="col-6 progress-bars-column left">
						<div class="progress flex-row-reverse">
							<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
						</div>
					</div>
					<div class="col-6 progress-bars-column right">
						<div class="progress">
							<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- EOF Total Fouls-->
			<!-- Total Offside-->
			<div class="col-12 center-block progress-content">
				<div class="row progress-result-info">
					<div class="col-2 stats-progress-result left"><?=$stats['stats']['local_team']['offsides']?></div>
					<div class="col-8 stats-progress-description"><?php if (isset($content['titles']['offsides'][COUNTRY_CODE])) { echo $content['titles']['offsides'][COUNTRY_CODE]; } else { echo $content['titles']['offsides']['default'];}?></div>
					<div class="col-2 stats-progress-result right"><?=$stats['stats']['visit_team']['offsides']?></div>
				</div>
				<div class="row">
					<div class="col-6 progress-bars-column left">
						<div class="progress flex-row-reverse">
							<div class="progress-bar progress-bar-success" role="progressbar" style="width: <?=($stats['stats']['local_team']['offsides'] * 100) / ($stats['stats']['local_team']['offsides'] + $stats['stats']['visit_team']['offsides']);?>%"></div>
						</div>
					</div>
					<div class="col-6 progress-bars-column right">
						<div class="progress">
							<div class="progress-bar progress-bar-success" role="progressbar" style="width: <?=($stats['stats']['visit_team']['offsides'] * 100) / ($stats['stats']['local_team']['offsides'] + $stats['stats']['visit_team']['offsides']);?>%"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- EOF Total Offside-->
			<!-- Total Yellow cards-->
			<div class="col-12 center-block progress-content">
				<div class="row progress-result-info">
					<div class="col-2 stats-progress-result left"><?=$stats['stats']['local_team']['yellow_card']?></div>
					<div class="col-8 stats-progress-description"><?php if (isset($content['titles']['yellow_card'][COUNTRY_CODE])) { echo $content['titles']['yellow_card'][COUNTRY_CODE]; } else { echo $content['titles']['yellow_card']['default'];}?></div>
					<div class="col-2 stats-progress-result right"><?=$stats['stats']['visit_team']['yellow_card']?></div>
				</div>
				<div class="row">
					<div class="col-6 progress-bars-column left">
						<div class="progress flex-row-reverse">
							<div class="progress-bar progress-bar-success" role="progressbar" style="width: <?=($stats['stats']['local_team']['yellow_card'] * 100) / ($stats['stats']['local_team']['yellow_card'] + $stats['stats']['visit_team']['yellow_card']);?>%"></div>
						</div>
					</div>
					<div class="col-6 progress-bars-column right">
						<div class="progress">
							<div class="progress-bar progress-bar-success" role="progressbar" style="width: <?=($stats['stats']['visit_team']['yellow_card'] * 100) / ($stats['stats']['local_team']['yellow_card'] + $stats['stats']['visit_team']['yellow_card']);?>%"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- EOF  Total Yellow cards-->
			<!-- Total Red cards-->
			<div class="col-12 center-block progress-content">
				<div class="row progress-result-info">
					<div class="col-2 stats-progress-result left"><?=$stats['stats']['local_team']['red_card']?></div>
					<div class="col-8 stats-progress-description"><?php if (isset($content['titles']['red_card'][COUNTRY_CODE])) { echo $content['titles']['red_card'][COUNTRY_CODE]; } else { echo $content['titles']['red_card']['default'];}?></div>
					<div class="col-2 stats-progress-result right"><?=$stats['stats']['visit_team']['red_card']?></div>
				</div>
				<div class="row">
					<div class="col-6 progress-bars-column left">
						<div class="progress flex-row-reverse">
							<div class="progress-bar progress-bar-success" role="progressbar" style="width: <?=($stats['stats']['local_team']['red_card'] * 100) / ($stats['stats']['local_team']['red_card'] + $stats['stats']['visit_team']['red_card']);?>%"></div>
						</div>
					</div>
					<div class="col-6 progress-bars-column right">
						<div class="progress">
							<div class="progress-bar progress-bar-success" role="progressbar" style="width: <?=($stats['stats']['visit_team']['red_card'] * 100) / ($stats['stats']['local_team']['red_card'] + $stats['stats']['visit_team']['red_card']);?>%"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- EOF Total Red cards-->
		</div>
	</div>
	<!-- Eof match stats / Stats / Match / Match container -->
</section>