<!-- Next matches-->
<?php 
	$nextMatches = $content['content'];
	$date = date('Y-m-d');

	// Validate if we want to show a type of soccer and we've matches
	if (((isset($nextMatches['football']) && $nextMatches['football']['display']) && $nextMatches['football']['matches'] != null) || ((isset($nextMatches['tennis']) && $nextMatches['tennis']['display']) && $nextMatches['tennis']['matches'] != null)) {
?>
<section class="nextmatches">
	<h2><?= (isset($content['title'])) ? $content['title'] : ((isset($content['titles']['next_matches'][COUNTRY_CODE])) ? $content['titles']['next_matches'][COUNTRY_CODE] : $content['titles']['next_matches']['default']);?></h2>
	<?php 
		/***************************************
		 * FOOTBALL
		 ***************************************/
		if (isset($nextMatches['football']) && $nextMatches['football']['display']) {
			foreach ($nextMatches['football']['matches'] as $keyDate => $matches) {
	?>
	<div class="date-matches"><?= strftime('%d de %B', strtotime($keyDate));?></div>
	<!-- Football Sport / Next matches -->
	<?php if (isset($content['display_sport_name']) && $content['display_sport_name'] || !isset($content['display_sport_name'])){?>
	<a href="<?=$nextMatches['football']['url']?>" class="sport football"><i class="<?= $nextMatches['football']['icon_name']?>"></i> <span><?= $nextMatches['football']['name'];?></span></a>
	<?php }?>
	<!-- Tournament / Football Sport / Next matches -->
	<?php
				$tournaments = [];

				foreach ($matches as $match) {
					if (in_array($match['tournament_key'], $_SESSION['clientConfig']->sports->football->available_tournaments)) {
						if (!is_array($tournaments[$match['tournament_key']])) {
							$tournaments[$match['tournament_key']] = [];
						}
						array_push($tournaments[$this->normalizeString($match['tournament_key'])], $match);
					}
				}
				// Tournaments
				foreach ($tournaments as $key => $tournament) {
	?>
	<div class="competition">
		<?php
					$first 	= true;
					$i 		= 0;

					foreach ($tournament as $match) {
						// If First we display info
						if ($first) {
		?>
		<a href="/<?=$nextMatches['football']['url'];?>/torneos/<?= $this->normalizeString($match['type']);?>/<?= Widgets::normalizeString($match['tournament_key']);?>" class="competition-name"><span><?= $match['tournament']?></span></a>
		<div class="competition-divider"></div>
		<?php 
							if (isset($match['step']) && !empty($match['step'])) {
		?>
		<div class="competition-situation"><?= $tournament['step']?></div>
		<ul>
		<?php 				}
						} // Eof if first match of competition

					/* Switch of each status */
					switch ($match['status']) {
						case 'Por comenzar':
							$match['status'] = 'to-start';
							break;
						case 'En vivo':
						case 'En Juego':
							$match['status'] = 'live';
							break;
						case 'Finalizado':
							$match['status'] = 'end';
							break;	
					}

					if (isset($_SESSION['clientConfig']->sports->football->display_original_image) && $_SESSION['clientConfig']->sports->football->display_original_image) {
						$team_image_local = $_SESSION['clientConfig']->sports->football->url_images . Widgets::normalizeString($match['country_local']) . '/' . Widgets::normalizeString($match['team_local']) .'.png';
						$team_image_visit = $_SESSION['clientConfig']->sports->football->url_images . Widgets::normalizeString($match['country_visit']) . '/' . Widgets::normalizeString($match['team_visit']) .'.png';
					} else {
						$team_image_local = $match['team_image_local'];
						$team_image_visit = $match['team_image_visit'];
					}
		?>
			<!-- Match -->
			<li class="row match <?= $match['status']?>">
				<div class="col-12">
					<a href="<?=$nextMatches['football']['url'];?>/partido/<?php echo $match['id']?>/<?php echo Widgets::normalizeString($match['team_local']).'-vs-'.Widgets::normalizeString($match['team_visit'])?>" name="<?php echo $match['team_local'] . ' vs ' . $match['team_visit']?>" name="<?php echo $match['team_local'] . ' vs ' . $match['team_visit']?>">
						<div class="row match-teams">
							<div class="col-5 match-team">
								<div class="team">
									<div class="shield left"><img src="<?=$team_image_local;?>" name="local" title="" alt=""></div>
									<div class="team-name left">
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
								<div class="time-playing"><?php if ($match['status'] == 'live'){?><span><?php if ($match['minutes'] < 45) {?>PT<?php } else { ?>ST<?php }?></span> <time><?= $match['minutes']?>:<?php if (isset($match['seconds'])) { echo $match['seconds'];} else { echo '00';}?></time><?php } else {?>Final<?php }?></div>
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
											<div class="time-to-play"><?php if (isset($match['date_begin'])) { echo date('H:i', strtotime($match['date_begin']));}?></div>
										</div>
									</div>
								<?php }?>
							</div>
							<div class="col-5 match-team">
								<div class="team">
									<div class="shield right"><img src="<?=$team_image_visit;?>" name="visit" title="" alt=""></div>
									<div class="team-name right">
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
					if (isset($content['football']['items']) && $i == $content['football']['items']) {
						break;
					}
					$first = false;
			?>
		<!-- Eof list of matches / Tournament / Football Sport / Next matches -->
		<?php 
				} // Eof Matches of tournament
		?>
		</ul>
	</div>
<?php 			
				} // Eof tournament
			} // Eof football content
		} // Eof display football content 
?>
<?php 
	/***************************************
	 * TENNIS
	 ***************************************/
	if (isset($nextMatches['tennis']) && $nextMatches['tennis']['display']) {
		foreach ($nextMatches['tennis']['matches'] as $keyDate => $matches) {
?>
	<div class="date-matches"><?= strftime('%d de %B', strtotime($keyDate));?></div>
	<!-- Football Sport / Next matches -->
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
		<a href="#" class="competition-name"><span><?= $tournament['name']?></span></a>
		<?php /*<a href="/<?=$nextMatches['tennis']['url'];?>/<?= Widgets::normalizeString($tournament['name']);?>" class="competition-name"><span><?= $tournament['name']?></span></a>*/?>
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
						$match['status'] = 'to-start';
						break;
					case 'En juego':
					default:
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
								<div class="col-5 player-content">
									<div class="player-info">
										<div class="flag float-left"><img src="<?=$match['player_first']['flag']?>" name="" alt="<?=$match['player_first']['name']?>" title="<?=$match['player_first']['name']?>"></div>
										<div class="player float-left"><?=$match['player_first']['name']?><?php if (is_numeric($match['player_first']['ranking'])) {?> <span class="ranking">(<?=$match['player_first']['ranking']?>)</span><?php }?></div>
									</div>
									<div class="player-info">
										<div class="flag float-left"><img src="<?=$match['player_second']['flag']?>" name="" alt="<?=$match['player_second']['name']?>" title="<?=$match['player_second']['name']?>"></div>
										<div class="player float-left"><?=$match['player_second']['name']?><?php if (is_numeric($match['player_second']['ranking'])) {?> <span class="ranking">(<?=$match['player_second']['ranking']?>)</span><?php }?></div>
									</div>
								</div>
								<div class="col-7">
									<div class="results-player">
										<?php if ($match['status'] === 'live') {?>
										<?php if ($match['serving'] === $match['player_first']['name']){?><div class="playing-ball"></div><?php }?>
										<!-- <div class="match-points float-left">40</div> -->
										<?php }?>
										<div class="column float-left<?php if (strpos($match['player_first']['set_1'], '.') == true) {?> tie-break<?php }?><?php if ($match['player_first']['set_1'] == ''){?> not-play<?php }?>"><?php if (strpos($match['player_first']['set_1'], '.') == true) {?><?= (explode('.', $match['player_first']['set_1']))[0];?><span>(<?php echo (explode('.', $match['player_first']['set_1']))[1];?>)</span><?php } else { echo $match['player_first']['set_1'];}?></div>
										<div class="column float-left<?php if (strpos($match['player_first']['set_2'], '.') == true) {?> tie-break<?php }?><?php if ($match['player_first']['set_2'] == ''){?> not-play<?php }?>"><?php if (strpos($match['player_first']['set_2'], '.') == true) {?><?= (explode('.', $match['player_first']['set_2']))[0];?><span>(<?php echo (explode('.', $match['player_first']['set_2']))[1];?>)</span><?php } else { echo $match['player_first']['set_2'];}?></div>
										<div class="column float-left<?php if (strpos($match['player_first']['set_3'], '.') == true) {?> tie-break<?php }?><?php if ($match['player_first']['set_3'] == ''){?> not-play<?php }?>"><?php if (strpos($match['player_first']['set_3'], '.') == true) {?><?= (explode('.', $match['player_first']['set_3']))[0];?><span>(<?php echo (explode('.', $match['player_first']['set_3']))[1];?>)</span><?php } else { echo $match['player_first']['set_3'];}?></div>
										<div class="column float-left<?php if (strpos($match['player_first']['set_4'], '.') == true) {?> tie-break<?php }?><?php if ($match['player_first']['set_4'] == ''){?> not-play<?php }?>"><?php if (strpos($match['player_first']['set_4'], '.') == true) {?><?= (explode('.', $match['player_first']['set_4']))[0];?><span>(<?php echo (explode('.', $match['player_first']['set_4']))[1];?>)</span><?php } else { echo $match['player_first']['set_4'];}?></div>
										<div class="column float-left<?php if (strpos($match['player_first']['set_5'], '.') == true) {?> tie-break<?php }?><?php if ($match['player_first']['set_5'] == ''){?> not-play<?php }?>"><?php if (strpos($match['player_first']['set_5'], '.') == true) {?><?= (explode('.', $match['player_first']['set_5']))[0];?><span>(<?php echo (explode('.', $match['player_first']['set_5']))[1];?>)</span><?php } else { echo $match['player_first']['set_5'];}?></div>
									</div>
									<div class="results-player">
										<?php if ($match['status'] === 'live') {?>
										<?php if ($match['serving'] === $match['player_second']['name']){?><div class="playing-ball"></div><?php }?>
										<!-- <div class="match-points float-left">15</div> -->
										<?php }?>
										<div class="column float-left<?php if (strpos($match['player_second']['set_1'], '.') == true) {?> tie-break<?php }?><?php if ($match['player_second']['set_1'] == ''){?> not-play<?php }?>"><?php if (strpos($match['player_second']['set_1'], '.') == true) {?><?= (explode('.', $match['player_second']['set_1']))[0];?><span>(<?php echo (explode('.', $match['player_second']['set_1']))[1];?>)</span><?php } else { echo $match['player_second']['set_1'];}?></div>
										<div class="column float-left<?php if (strpos($match['player_second']['set_2'], '.') == true) {?> tie-break<?php }?><?php if ($match['player_second']['set_2'] == ''){?> not-play<?php }?>"><?php if (strpos($match['player_second']['set_2'], '.') == true) {?><?= (explode('.', $match['player_second']['set_2']))[0];?><span>(<?php echo (explode('.', $match['player_second']['set_2']))[1];?>)</span><?php } else { echo $match['player_second']['set_2'];}?></div>
										<div class="column float-left<?php if (strpos($match['player_second']['set_3'], '.') == true) {?> tie-break<?php }?><?php if ($match['player_second']['set_3'] == ''){?> not-play<?php }?>"><?php if (strpos($match['player_second']['set_3'], '.') == true) {?><?= (explode('.', $match['player_second']['set_3']))[0];?><span>(<?php echo (explode('.', $match['player_second']['set_3']))[1];?>)</span><?php } else { echo $match['player_second']['set_3'];}?></div>
										<div class="column float-left<?php if (strpos($match['player_second']['set_4'], '.') == true) {?> tie-break<?php }?><?php if ($match['player_second']['set_4'] == ''){?> not-play<?php }?>"><?php if (strpos($match['player_second']['set_4'], '.') == true) {?><?= (explode('.', $match['player_second']['set_4']))[0];?><span>(<?php echo (explode('.', $match['player_second']['set_4']))[1];?>)</span><?php } else { echo $match['player_second']['set_4'];}?></div>
										<div class="column float-left<?php if (strpos($match['player_second']['set_5'], '.') == true) {?> tie-break<?php }?><?php if ($match['player_second']['set_5'] == ''){?> not-play<?php }?>"><?php if (strpos($match['player_second']['set_5'], '.') == true) {?><?= (explode('.', $match['player_second']['set_5']))[0];?><span>(<?php echo (explode('.', $match['player_second']['set_5']))[1];?>)</span><?php } else { echo $match['player_second']['set_5'];}?></div>
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
			} // Foreach 
		?>
		</ul>
	</div>
<?php 
		} // Eof foreach tennis
	} // Eof if display tennis content
?>
</section>
<?php }?>