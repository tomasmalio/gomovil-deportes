<!-- Next matches-->
<pre>
<?php //print_r($content);?>
</pre>
<?php 
//exit;
	$nextMatches = $content['content'];
	$date = date('Y-m-d');

	// if (isset($nextMatches['football'][$date])) {
	// }
?>
<section class="nextmatches">
	<h2><?= $content['title'];?></h2>
	<?php foreach ($nextMatches['football']['matches'] as $keyDate => $matches) {?>
	<div class="date-matches"><?= strftime('%d de %B', strtotime($keyDate));?></div>
	
	<!-- Football Sport / Next matches -->
	<?php if (isset($nextMatches['football']) && $nextMatches['football']['display']) {?>
	<a href="<?=$nextMatches['football']['url']?>" class="sport football"><i class="<?= $nextMatches['football']['icon_name']?>"></i> <span><?= $nextMatches['football']['name'];?></span></a>
	<!-- Tournament / Football Sport / Next matches -->
		<div class="competition">
			<?php 
				$tournament = [];
				$firstTournamnet = false;
				foreach ($matches as $match) {
					if (count($tournament) == 0) {
						$tournament['name'] = $match['tournament'];
			?>
			<a href="/<?=$nextMatches['football']['url'];?>//<?= Widgets::normalizeString($tournament['name']);?>" class="competition-name"><span><?= $tournament['name']?></span></a>
			<div class="competition-divider"></div>
			<?php if (isset($tournament['step']) && !empty($tournament['step'])) {?>
			<div class="competition-situation"><?= $tournament['step']?></div>
			<?php }?>

			<!-- List of matches / Tournament / Football Sport / Next matches -->
			<?php if (!$firstTournamnet) {?></ul><?php }?>
			<ul>
				<?php 
					}
					// Starting showing
					$i = 0;

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
						<a href="<?=$nextMatches['football']['url'];?>/partido/<?php echo $match['id']?>/<?php echo Widgets::normalizeString($match['team_local']).'-vs-'.Widgets::normalizeString($match['team_visit'])?>" name="<?php echo $match['team_local'] . ' vs ' . $match['team_visit']?>" name="<?php echo $match['team_local'] . ' vs ' . $match['team_visit']?>">
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
									<div class="time-playing"><?php if ($match['status'] == 'live'){?><span><?php if ($match['match_time']['minutes'] < 45) {?>PT<?php } else { ?>ST<?php }?></span> <time><?= $match['match_time']['minutes'] . ':' . $match['match_time']['seconds']?></time><?php } else {?>Final<?php }?></div>
										<div class="match-divider">
											<div class="match-divider-content">
												<div class="result football">
													<span class="number"><?=$match['score']['gol_local'];?></span> - <span class="number"><?=$match['score']['gol_visit'];?></span>
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
						$i++;
						if ($i == $content['football']['items']) {
							break;
						}
				?>
			</ul>
			<!-- Eof list of matches / Tournament / Football Sport / Next matches -->
			<?php 
					$firstTournamnet = true;
				}
				//
			?>
		</div>
	<?php }?>
	<!-- Eof ournament / Football Sport / Next matches -->
	<?php }?>
	<!-- Eof football sport / Next matches -->
</section>