<?php
	$stats = $content['content'];
	print_r($stats);
?>
<div class="col-12 match-stats center-block" ng-show="showStats" center-block="" aria-hidden="false">
	<!-- Match stats / Stats / Match / Match container -->
	<div class="title-section">Estadísticas del partido</div>
	<div class="stats-content">
		<div class="card">
			<div class="row">
				<div class="col-12 center-block progress-content">
					<div class="row">
						<div class="col-6">
							<div class="progress-content-team d-none d-md-block">
								<span class="progress-content-team-shield-left"><img ng-src="http://image.futmovil.com/56a26c0c6274c.png" title="Newell's" alt="Newell's" src="http://image.futmovil.com/56a26c0c6274c.png"></span>
								<div class="progress-content-team-name left"><?=$stats['local_team']?></div>
							</div>
						</div>
						<div class="col-6">
							<div class="progress-content-team d-none d-md-block">
								<span class="progress-content-team-shield-right"><img ng-src="http://image.futmovil.com/56a26ad5f32a7.png" title="Colón" alt="Colón" src="http://image.futmovil.com/56a26ad5f32a7.png"></span>
								<div class="progress-content-team-name right"><?=$stats['visit_team']?></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 center-block progress-content">
					<div class="row progress-result-info">
						<div class="col-2 stats-progress-result left"><?=$stats['stats']['local_team']['possession']?></div>
						<div class="col-8 stats-progress-description">Posesión de la pelota</div>
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
						<div class="col-2 stats-progress-result left ng-binding" ng-bind="local_score"><?=$stats['local_gol']?></div>
						<div class="col-8 stats-progress-description">Goles</div>
						<div class="col-2 stats-progress-result right ng-binding" ng-bind="visitor_score"><?=$stats['visit_gol']?></div>
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
						<div class="col-2 stats-progress-result left ng-binding"><?=$stats['stats']['local_team']['shots_on_target']?></div>
						<div class="col-8 stats-progress-description">Tiros al arco</div>
						<div class="col-2 stats-progress-result right ng-binding"><?=$stats['stats']['visit_team']['shots_on_target']?></div>
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
						<div class="col-2 stats-progress-result left ng-binding"><?=$stats['stats']['local_team']['shots']?></div>
						<div class="col-8 stats-progress-description">Tiros Totales</div>
						<div class="col-2 stats-progress-result right ng-binding"><?=$stats['stats']['visit_team']['shots']?></div>
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
						<div class="col-2 stats-progress-result left ng-binding"><?=$stats['stats']['local_team']['tied']?></div>
						<div class="col-8 stats-progress-description">Atajadas</div>
						<div class="col-2 stats-progress-result right ng-binding"><?=$stats['stats']['visit_team']['tied']?></div>
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
						<div class="col-2 stats-progress-result left ng-binding">4</div>
						<div class="col-8 stats-progress-description">Faltas cometidas</div>
						<div class="col-2 stats-progress-result right ng-binding">4</div>
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
						<div class="col-2 stats-progress-result left ng-binding">0</div>
						<div class="col-8 stats-progress-description">Posición adelantadas</div>
						<div class="col-2 stats-progress-result right ng-binding">0</div>
					</div>
					<div class="row">
						<div class="col-6 progress-bars-column left">
							<div class="progress flex-row-reverse">
								<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="NaN" aria-valuemin="0" aria-valuemax="100" style="width: NaN%;"></div>
							</div>
						</div>
						<div class="col-6 progress-bars-column right">
							<div class="progress">
								<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="NaN" aria-valuemin="0" aria-valuemax="100" style="width: NaN%"></div>
							</div>
						</div>
					</div>
				</div>
				<!-- EOF Total Offside-->
				<!-- Total Yellow cards-->
				<div class="col-12 center-block progress-content">
					<div class="row progress-result-info">
						<div class="col-2 stats-progress-result left ng-binding">0</div>
						<div class="col-8 stats-progress-description">Tarjetas amarillas</div>
						<div class="col-2 stats-progress-result right ng-binding">1</div>
					</div>
					<div class="row">
						<div class="col-6 progress-bars-column left">
							<div class="progress flex-row-reverse">
								<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
							</div>
						</div>
						<div class="col-6 progress-bars-column right">
							<div class="progress">
								<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
							</div>
						</div>
					</div>
				</div>
				<!-- EOF  Total Yellow cards-->
				<!-- Total Red cards-->
				<div class="col-12 center-block progress-content">
					<div class="row progress-result-info">
						<div class="col-2 stats-progress-result left ng-binding">0</div>
						<div class="col-8 stats-progress-description">Tarjetas Rojas</div>
						<div class="col-2 stats-progress-result right ng-binding">0</div>
					</div>
					<div class="row">
						<div class="col-6 progress-bars-column left">
							<div class="progress flex-row-reverse">
								<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="NaN" aria-valuemin="0" aria-valuemax="100" style="width: NaN%;"></div>
							</div>
						</div>
						<div class="col-6 progress-bars-column right">
							<div class="progress">
								<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="NaN" aria-valuemin="0" aria-valuemax="100" style="width: NaN%"></div>
							</div>
						</div>
					</div>
				</div>
				<!-- EOF Total Red cards-->
			</div>
		</div>
	</div>
	<!-- Eof match stats / Stats / Match / Match container -->
	<!-- Interactions / Stats/ Match / Match container -->
	<div class="title-section">Interacciones</div>
	<div class="stats-content">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="row">
						<div class="col-4 progress-circle-left">
							<div class="progress-circle-users-local" data-progress="NaN">
								<div class="circle">
									<div class="mask full">
										<div class="fill"></div>
									</div>
									<div class="mask half">
										<div class="fill"></div>
										<div class="fill fix"></div>
									</div>
									<div class="shadow"></div>
								</div>
								<div class="inset d-none d-md-block"><span class="progress-circle-team-shield left"><img ng-src="http://image.futmovil.com/56a26c0c6274c.png" title="Newell's" alt="Newell's" src="http://image.futmovil.com/56a26c0c6274c.png"></span></div>
								<div class="inset d-md-none ng-binding">NaN%</div>
							</div>
							<div class="progress-circle-result d-none d-md-block ng-binding">NaN%</div>
						</div>
						<div class="col-4">
							<div class="number-interactions-content">
								<div class="number-interactions">
									<p class="number ng-binding" ng-bind="tweets">0</p>
									<p class="number-description">Interacciones</p>
								</div>	
							</div>
						</div>
						<div class="col-4 progress-circle-right">
							<div class="progress-circle-users-visitor" data-progress="NaN">
								<div class="circle">
									<div class="mask full">
										<div class="fill"></div>
									</div>
									<div class="mask half">
										<div class="fill"></div>
										<div class="fill fix"></div>
									</div>
									<div class="shadow"></div>
								</div>
								<div class="inset d-none d-md-block"><span class="progress-circle-team-shield left"><img ng-src="http://image.futmovil.com/56a26ad5f32a7.png" title="Colón" alt="Colón" src="http://image.futmovil.com/56a26ad5f32a7.png"></span></div>
								<div class="inset d-md-none ng-binding">NaN%</div>
							</div>
							<div class="progress-circle-result d-none d-md-block ng-binding">NaN%</div>
						</div>
						<script type="text/javascript">
							$(document).ready(function(){
								//$('head style[type="text/css"]').attr('type', 'text/less');
								less.refreshStyles();
								window.randomize = function() {
									$('.progress-circle-users-local').attr('data-progress');
									$('.progress-circle-users-visitor').attr('data-progress');
								}
								setTimeout(window.randomize, 100000);
							});
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Eof interactions / Stats/ Match / Match container -->
	<!-- Min per min / Stats/ Match / Match container -->
	<div class="title-section">Minuto a minuto social</div>
	<div ng-controller="instogramController" class="stats-content ng-scope">
		<div class="card">
			<div id="instogram" style="width:100%; margin:0 auto;" data-highcharts-chart="0"><div class="highcharts-container" id="highcharts-0" style="position: relative; overflow: hidden; width: 397px; height: 400px; text-align: left; line-height: normal; z-index: 0; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); touch-action: none;"><svg version="1.1" style="font-family:&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, Arial, Helvetica, sans-serif;font-size:12px;" xmlns="http://www.w3.org/2000/svg" width="397" height="400"><desc>Created with Highstock 2.1.1</desc><defs><clipPath id="highcharts-1"><rect x="0" y="0" width="353" height="338"></rect></clipPath></defs><rect x="0" y="0" width="397" height="400" strokeWidth="0" fill="#FFFFFF" class=" highcharts-background"></rect><g class="highcharts-grid" zIndex="1"></g><g class="highcharts-grid" zIndex="1"></g><g class="highcharts-axis" zIndex="2"><path fill="none" d="M 34 348.5 L 387 348.5" stroke="#C0D0E0" stroke-width="1" zIndex="7" visibility="visible"></path></g><g class="highcharts-axis" zIndex="2"><text x="24" zIndex="7" text-anchor="middle" transform="translate(0,0) rotate(270 24 179)" class=" highcharts-yaxis-title" style="color:#707070;fill:#707070;" visibility="visible" y="179">Values</text></g><g class="highcharts-series-group" zIndex="3"><g class="highcharts-series" visibility="visible" zIndex="0.1" transform="translate(34,10) scale(1 1)" clip-path="url(http://ar.degoles.com/#highcharts-1)"><path fill="none" d="M 0 0" stroke-linejoin="round" visibility="visible" stroke="rgba(192,192,192,0.0001)" stroke-width="22" zIndex="2" class=" highcharts-tracker" style=""></path></g><g class="highcharts-markers highcharts-tracker" visibility="visible" zIndex="0.1" transform="translate(34,10) scale(1 1)" clip-path="url(http://ar.degoles.com/#highcharts-2)" style=""></g><g class="highcharts-series" visibility="visible" zIndex="0.1" transform="translate(34,10) scale(1 1)" clip-path="url(http://ar.degoles.com/#highcharts-1)"><path fill="none" d="M 0 0" stroke-linejoin="round" visibility="visible" stroke="rgba(192,192,192,0.0001)" stroke-width="22" zIndex="2" class=" highcharts-tracker" style=""></path></g><g class="highcharts-markers highcharts-tracker" visibility="visible" zIndex="0.1" transform="translate(34,10) scale(1 1)" clip-path="url(http://ar.degoles.com/#highcharts-2)" style=""></g></g><g class="highcharts-legend" zIndex="7" transform="translate(116,360)"><g zIndex="1"><g><g class="highcharts-legend-item" zIndex="1" transform="translate(8,3)"><path fill="none" d="M 0 11 L 16 11" stroke="#008c00" stroke-width="2"></path><path fill="#008c00" d="M 8 7 C 13.328 7 13.328 15 8 15 C 2.6719999999999997 15 2.6719999999999997 7 8 7 Z"></path><text x="21" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start" zIndex="2" y="15">Newell's</text></g><g class="highcharts-legend-item" zIndex="1" transform="translate(100.203125,3)"><path fill="none" d="M 0 11 L 16 11" stroke="#00d200" stroke-width="2"></path><path fill="#00d200" d="M 8 7 L 12 11 8 15 4 11 Z"></path><text x="21" y="15" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start" zIndex="2">Colón</text></g></g></g></g><g class="highcharts-axis-labels highcharts-xaxis-labels" zIndex="7"></g><g class="highcharts-axis-labels highcharts-yaxis-labels" zIndex="7"></g><g class="highcharts-tooltip" zIndex="8" style="cursor:default;padding:0;white-space:nowrap;" transform="translate(0,-9999)"><path fill="none" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0" isShadow="true" stroke="black" stroke-opacity="0.049999999999999996" stroke-width="5" transform="translate(1, 1)"></path><path fill="none" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0" isShadow="true" stroke="black" stroke-opacity="0.09999999999999999" stroke-width="3" transform="translate(1, 1)"></path><path fill="none" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0" isShadow="true" stroke="black" stroke-opacity="0.15" stroke-width="1" transform="translate(1, 1)"></path><path fill="rgba(249, 249, 249, .85)" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0"></path><text x="8" zIndex="1" style="font-size:12px;color:#333333;fill:#333333;" y="20"></text></g><text x="387" text-anchor="end" zIndex="8" style="cursor:pointer;color:#909090;font-size:9px;fill:#909090;" y="395">Highcharts.com</text></svg></div></div>
		</div>
	</div>
	<!-- Eof min per min / Stats/ Match / Match container -->
	
	<!-- Players more mention / Stats/ Match / Match container -->
	<div class="title-section">Los jugadores del partido</div>
	<div class="stats-content">
		<div class="card">
			<div class="row ng-scope" ng-controller="twitterEntitiesController">
				<div class="col-6">
					<div class="player-of-the-team">
						<img>
						<p class="ng-binding"> <span class="ng-binding">NaN</span></p>
					</div>

				</div>
				<!-- Best player / Players more mention / Stats/ Match / Match container -->
				<div class="col-6">
					<div class="player-more-mentions">
						<img>
					</div>
					<div class="player-more-mentions-name ng-binding"><span class="number-player ng-binding">NaN</span></div>
				</div>
				<!-- Eof best player / Players more mention / Stats/ Match / Match container -->
				<!-- Other players / Players more mention / Stats/ Match / Match container -->
				<div class="col-6">
					<!-- ngRepeat: entitie in twitterEntities| limitTo: 5 | limitTo: -4 -->
				</div>
				<!-- Eof other players / Players more mention / Stats/ Match / Match container -->
			</div>
		</div>
	</div>
	<!-- Eof players more mention / Stats/ Match / Match container -->
</div>