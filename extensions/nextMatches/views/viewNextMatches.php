<!-- Next matches-->
<pre>
<?php //print_r($content);?>
</pre>
<?php 
	$nextMatches = $content['content'];
	$date = date('Y-m-d');
?>
<section class="nextmatches">
	<h2><?= $content['title'];?></h2>
	<?php 
		if (isset($nextMatches['football']) && $nextMatches['football']['display']) {
		
			foreach ($nextMatches['football']['matches'] as $keyDate => $matches) {
	?>
	<div class="date-matches"><?= strftime('%d de %B', strtotime($keyDate));?></div>
	<!-- Football Sport / Next matches -->
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
	<?php 
			}
			// Eof foreach match
		}
	?>

	<?php foreach ($nextMatches['tennis']['matches'] as $keyDate => $matches) {?>
	<div class="date-matches"><?= strftime('%d de %B', strtotime($keyDate));?></div>
	<!-- Football Sport / Next matches -->
	<?php if (isset($nextMatches['tennis']) && $nextMatches['tennis']['display']) {?>
	<a href="<?=$nextMatches['tennis']['url']?>" class="sport tennis"><i class="<?= $nextMatches['tennis']['icon_name']?>"></i> <span><?= $nextMatches['tennis']['name'];?></span></a>
	<!-- Tournament / Football Sport / Next matches -->
		<div class="competition">
			<?php 
				$tournament = [];
				$closeTournament = false;
				
				foreach ($matches as $match) {
					if ($match['tournament'] !== $tournament['name']) {
						$tournament['name'] = $match['tournament'];
						if ($closeTournament) {
			?>
			</ul>
			<?php
						 }
			?>
			<a href="/<?=$nextMatches['tennis']['url'];?>//<?= Widgets::normalizeString($tournament['name']);?>" class="competition-name"><span><?= $tournament['name']?></span></a>
			<div class="competition-divider"></div>
			<?php if (isset($tournament['step']) && !empty($tournament['step'])) {?>
			<div class="competition-situation"><?= $tournament['step']?></div>
			<?php }?>
			<!-- List of matches / Tournament / Football Sport / Next matches -->
			<ul>
				<?php 
						$closeTournament = true;
					}

					// Starting showing
					$i = 0;

					/* Switch of each status */
					switch ($match['status']) {
						case 'Por comenzar':
							$match['status'] = 'to start';
							break;
						case 'En juego':
							$match['status'] = 'live';
							break;
						case 'Finalizado':
							$match['status'] = 'end';
							break;	
					}
				?>
				<li>
					<!-- Match -->
					<div class="row match">
						<div class="col-12">
							<a href="#">
								<div class="row match-tenis">
									<div class="col-12"><time class="time"><?= $match['time']?> hs</time></div>
									<?php if (!isset($tournament['type']) || $tournament['type'] == 'single'){?>
									<div class="col-5">
										<div class="player-info">
											<div class="flag float-left"><img src="<?=$match['player_first']['flag']?>" name="" alt="<?=$match['player_first']['name']?>" title="<?=$match['player_first']['name']?>"></div>
											<div class="player float-left"><?=$match['player_first']['name']?></div>
										</div>
										<div class="player-info">
											<div class="flag float-left"><img src="<?=$match['player_second']['flag']?>" name="" alt="<?=$match['player_second']['name']?>" title="<?=$match['player_second']['name']?>"></div>
											<div class="player float-left"><?=$match['player_second']['name']?></div>
										</div>
									</div>
									<div class="col-7">
										<div class="results-player">
											<?php if ($match['status'] === 'live') {?>
											<?php if ($match['serving'] === $match['player_first']['name']){?><div class="playing-ball"></div><?php }?>
											<!-- <div class="match-points float-left">40</div> -->
											<?php }?>
											<div class="column float-left <?php if ($match['player_first']['set_1'] == ''){?>not-play<?php }?>"><?= $match['player_first']['set_1'];?></div>
											<div class="column float-left <?php if ($match['player_first']['set_2'] == ''){?>not-play<?php }?>"><?= $match['player_first']['set_2'];?></div>
											<div class="column float-left <?php if ($match['player_first']['set_3'] == ''){?>not-play<?php }?>"><?= $match['player_first']['set_3'];?></div>
											<div class="column float-left <?php if ($match['player_first']['set_4'] == ''){?>not-play<?php }?>"><?= $match['player_first']['set_4'];?></div>
											<div class="column float-left <?php if ($match['player_first']['set_5'] == ''){?>not-play<?php }?>"><?= $match['player_first']['set_5'];?></div>
											
											<?php /*foreach ($match['score']['player_first'] as $score) {?>
												<div class="column <?php if (isset($score['tie_break'])) {?>tie-break<?php }?> float-left"><?= $score['point'];?> <?php if (isset($score['tie_break'])){?> <span>(<?= $score['tie_break'];?>)</span><?php }?></div>
											<?php }*/?>
										</div>
										<div class="results-player">
											<?php if ($match['status'] === 'live') {?>
											<?php if ($match['serving'] === $match['player_second']['name']){?><div class="playing-ball"></div><?php }?>
											<!-- <div class="match-points float-left">15</div> -->
											<?php }?>
											<div class="column float-left <?php if ($match['player_second']['set_1'] == ''){?>not-play<?php }?>"><?= $match['player_second']['set_1'];?></div>
											<div class="column float-left <?php if ($match['player_second']['set_2'] == ''){?>not-play<?php }?>"><?= $match['player_second']['set_2'];?></div>
											<div class="column float-left <?php if ($match['player_second']['set_3'] == ''){?>not-play<?php }?>"><?= $match['player_second']['set_3'];?></div>
											<div class="column float-left <?php if ($match['player_second']['set_4'] == ''){?>not-play<?php }?>"><?= $match['player_second']['set_4'];?></div>
											<div class="column float-left <?php if ($match['player_second']['set_5'] == ''){?>not-play<?php }?>"><?= $match['player_second']['set_5'];?></div>
											<?php /*foreach ($match['score']['player_second'] as $score) {?>
												<div class="column <?php if (isset($score['tie_break'])) {?>tie-break<?php }?> float-left"><?= $score['point'];?> <?php if (isset($score['tie_break'])){?> <span>(<?= $score['tie_break'];?>)</span><?php }?></div>
											<?php }*/?>
										</div>
									</div>
									<?php } elseif ($tournament['type'] == 'double') {?>
									<div class="col-5">
										<div class="player-info double">
											<div class="row">
												<div class="col-12">
												<div class="flag float-left"><img src="<?=$match['team_double_first']['player_image_one']?>" name="" alt="" title=""></div>
													<div class="player float-left"><?=$match['team_double_first']['player_one']?></div>
												</div>
												<div class="col-12">
													<div class="flag float-left"><img src="<?=$match['team_double_first']['player_image_second']?>" name="" alt="" title=""></div>
													<div class="player float-left"><?=$match['team_double_first']['player_second']?></div>
												</div>
											</div>
										</div>
										<div class="player-info double">
											<div class="row">
												<div class="col-12">
												<div class="flag float-left"><img src="<?=$match['team_double_second']['player_image_one']?>" name="" alt="" title=""></div>
													<div class="player float-left"><?=$match['team_double_second']['player_one']?></div>
												</div>
												<div class="col-12">
													<div class="flag float-left"><img src="<?=$match['team_double_second']['player_image_second']?>" name="" alt="" title=""></div>
													<div class="player float-left"><?=$match['team_double_second']['player_second']?></div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-7 <?php if ($match['score']['sets']){?>match-to-five<?php }?>">
										<div class="row">
											<div class="col-12">
												<div class="results-player double">
													<div class="playing-ball"></div>
													<div class="match-points float-left">15</div>
													<?php foreach ($match['score']['team_double_first'] as $score) {?>
														<div class="column <?php if (isset($score['tie_break'])) {?>tie-break<?php }?> float-left"><?= $score['point'];?> <?php if (isset($score['tie_break'])){?> <span>(<?= $score['tie_break'];?>)</span><?php }?></div>
													<?php }?>
												</div>
												<div class="results-player double">
												<div class="match-points float-left">30</div>
													<?php foreach ($match['score']['team_double_second'] as $score) {?>
														<div class="column <?php if (isset($score['tie_break'])) {?>tie-break<?php }?> float-left"><?= $score['point'];?> <?php if (isset($score['tie_break'])){?> <span>(<?= $score['tie_break'];?>)</span><?php }?></div>
													<?php }?>
												</div>
											</div>
										</div>
									</div>
									<?php }?>
								</div>
							</a>
						</div>
					</div>
					<!-- Eof Match -->
				</li>
				<!-- Eof Match -->
				<?php 
						$i++;
						if ($i == $content['tennis']['items']) {
							break;
						}
				?>
			<!-- Eof list of matches / Tournament / Tennis Sport / Next matches -->
			<?php 
				}
				//
			?>
			</ul>
		</div>
	<?php 
			}
			// Eof foreach match
		}
	?>
</section>