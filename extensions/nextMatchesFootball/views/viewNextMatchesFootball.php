<?php
	$nextMatches = $content['content']['fixture'];
	// print_r($nextMatches);
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
				<div class="date-matches"><?php 
					if (is_numeric($key)) { 
						echo 'Fecha '.$key; 
					} else {
						if (isset($content['titles']['phases'][$key][COUNTRY_CODE])) {
							echo $content['titles']['phases'][$key][COUNTRY_CODE];
						} else {
							echo $content['titles']['phases'][$key]['default'];
						}
					}
				?></div>
				<div class="competition-divider"></div>
				<!-- List of matches / Football sport / Next matches-->
				<ul>
					<?php 
						/* Matches of competitions dates */
						foreach ($competitionDays as $match) {
							// print_r($match);
							// exit;
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
							<?php $url = DOMAIN . '/' . (isset($content['section'][COUNTRY_CODE]) ? (strtolower($this->normalizeString($content['section'][COUNTRY_CODE]))) : (strtolower($this->normalizeString($content['section']['default'])))). '/' . (isset($content['titles']['match'][COUNTRY_CODE]) ? (strtolower($this->normalizeString($content['titles']['match'][COUNTRY_CODE]))) : (strtolower($this->normalizeString($content['titles']['match']['default'])))). '/'. $match['id'] . '/'.  ($this->normalizeString($match['team_local'])) . '-vs-' . ($this->normalizeString($match['team_visit']));?>
							<a href="<?=$url?>" name="<?php echo $match['team_local'] . ' vs ' . $match['team_visit']?>">
								<div class="competition-date"><?= strftime('%d de %B', strtotime($match['day']));?></div>
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
<script type="text/javascript">
	var swiper<?= get_class($this) . $this->extensionId?> = new Swiper('.<?= strtolower(get_class($this))?>-content', {
		slidesPerView: 'auto',
		loop: true,
		spaceBetween: 30,
		mousewheel: true,
		initialSlide: <?= ($content['content']['slider_position'] - 1)?>,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
	});
</script>
<!-- Eof Next matches-->
<?php }?>