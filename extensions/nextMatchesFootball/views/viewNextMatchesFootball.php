<?php
	$nextMatches = $content['content']['fixture'];
	if (isset($nextMatches) && is_array($nextMatches) && count($nextMatches) > 0) {
?>
<!-- Next matches football -->
<section class="nextmatchesfootball">
	<h2><?= $content['title'];?></h2>
	<div class="nextmatchesfootball-content <?php if ($slider) {?>swiper-container<?php }?>">
		<?php if ($navigation) {?>
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
		<?php }?>

		<!-- Next matches -->
		<div class="competition <?php if ($slider) {?>swiper-wrapper<?php }?>">
			<?php
				foreach ($nextMatches as $key => $competitionDays) {
					if ($slider) {
			?>
				<!-- Slider -->
					<div class="swiper-slide">
				<?php }?>
				<div class="date-matches"><?php if (is_numeric($key)) { echo 'Fecha '.$key; } else { echo $content['titles']['phases'][$key][COUNTRY_CODE];}?></div>
				<div class="competition-divider"></div>
				<!-- List of matches / Football sport / Next matches-->
				<ul>
					<?php 
						/* Matches of competitions dates */
						foreach ($competitionDays as $match) {
							/* Switch of each status */
							switch ($match['status']) {
								case 'Por comenzar':
									$match['status'] = 'to start';
									break;
								case 'En vivo':
									$match['status'] = 'live';
									break;
								case 'Finalizado':
									$match['status'] = 'end';
									break;	
							}
					?>
					<!-- Match -->
					<li class="row match <?= $match['status']?>">
						<div class="col-12">
							<a href="/<?= strtolower($this->normalizeString($content['section'][COUNTRY_CODE]))?>/<?= strtolower($this->normalizeString($content['titles']['match'][COUNTRY_CODE]))?>/<?= $match['id']?>/<?php echo Widgets::normalizeString($match['team_local']).'-vs-'.Widgets::normalizeString($match['team_visit'])?>" name="<?php echo $match['team_local'] . ' vs ' . $match['team_visit']?>">
								<div class="competition-date"><?= strftime('%d de %B', strtotime($match['date_begin']));?></div>
								<div class="row match-teams">
									<div class="col-5 match-team">
										<div class="team">
											<div class="shield left"><img src="<?=$match['team_image_local']?>" name="local" title="" alt=""></div>
											<div class="team-name left" style="width: 101px;">
												<div class="team-name-container">
													<div class="cell"><?=$match['team_local']?></div>
												</div>
											</div>
										</div>
										<?php if (isset($match['penalties']) && !empty($match['penalties'])) {?>
										<div class="penalties left">
											<div class="shoot goal"></div>
											<div class="shoot no-goal"></div>
											<div class="shoot goal"></div>
											<div class="shoot goal"></div>
											<div class="shoot goal"></div>
										</div>
										<?php }?>
									</div>
									<div class="col-2 match-info">
										<?php if ($match['status'] == 'live' || $match['status'] == 'end') {?>
											<?php if ($match['status'] == 'live'){?><div class="playing-status"><span class="situation"></span> En vivo</div><?php }?>
										<div class="time-playing"><?php if ($match['status'] == 'live'){?><span><?php if ($match['minutes'] < 45) {?>PT<?php } else { ?>ST<?php }?></span> <time><?= $match['match_time']['minutes'] . ':' . $match['match_time']['seconds']?></time><?php } else {?>Final<?php }?></div>
											<div class="match-divider">
												<div class="match-divider-content">
													<div class="result football">
														<span class="number"><?=$match['gol_local'];?></span> - <span class="number"><?=$match['gol_visit'];?></span>
													</div>
												</div>
											</div>
											<?php if (isset($match['penalties']) && !empty($match['penalties'])) {?>
											<div class="penalty-score">(<?=$match['penalties']['gol_local']?>) - (<?=$match['penalties']['gol_visit']?>)</div>
											<?php }?>
										<?php } else {?>
											<div class="match-divider">
												<div class="match-divider-content">
													<div class="time-to-play"><?=date('H:i', strtotime($match['datetime']))?></div>
												</div>
											</div>
										<?php }?>
									</div>
									<div class="col-5 match-team">
										<div class="team">
											<div class="shield right"><img src="<?=$match['team_image_visit']?>" name="visit" title="" alt=""></div>
											<div class="team-name right" style="width: 101px;">
												<div class="team-name-container">
													<div class="cell"><?=$match['team_visit']?></div>
												</div>
											</div>
										</div>
										<?php if (isset($match['penalties']) && !empty($match['penalties'])) {?>
										<div class="penalties right">
											<div class="shoot no-goal"></div>
											<div class="shoot no-goal"></div>
											<div class="shoot goal"></div>
											<div class="shoot goal"></div>
											<div class="shoot"></div>
										</div>
										<?php }?>
									</div>
								</div>
							</a>
						</div>
					</li>
					<!-- Eof Match -->
					<?php 
						} /* Eof foreach matches */
					?>
				</ul>
				<!-- Eof list of matches / Football sport / Next matches-->
			
				<!-- Slider -->
				<?php if ($slider) {?>
				</div>
			<?php 
					}
				} /* Eof foreach competition days */
			?>
		</div>
		<!-- Eof next matches -->
	</div>
</section>
<!-- Eof Next matches-->
<?php }?>