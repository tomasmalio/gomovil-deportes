<!-- Next matches-->
<section class="next-matches">
	<h2><?= $content['title'];?></h2>
	<div class="date-matches"><?= strftime('%d de %B', strtotime($date));?></div>
	<!-- Football Sport / Next matches -->
	<?php if (isset($content['content']['football']) && $content['content']['football']['display']) {?>
	<a href="<?=$content['content']['football']['url']?>" class="sport football"><i class="<?= $content['content']['football']['icon_name']?>"></i> <span><?= $content['content']['football']['name'];?></span></a>
	<?php foreach ($content['content']['football']['tournaments'] as $tournament) {?>
	<div class="competition">
		<a href="<?= $tournament['url']?>" class="competition-name"><span><?= $tournament['name']?></span></a>
		<div class="competition-divider"></div>
		<?php if (isset($tournament['step']) && !empty($tournament['step'])) {?>
		<div class="competition-situation"><?= $tournament['step']?></div>
		<?php }?>
		<!-- List of matches / Football sport / Next matches-->
		<ul>
			<?php 
				$i = 0;
				foreach ($tournament['matches'] as $match) {
			?>
			<!-- Match -->
			<li class="row match <?= $match['status']?>">
				<div class="col-12">
					<a href="<?= $match['url']?>" name="<?php echo $match['team_local'] . ' vs ' . $match['team_visit']?>">
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
									<div class="shield right"><img src="<?=$match['team_image_local']?>" name="visit" title="" alt=""></div>
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
				} /* Eof foreach matches */
			?>
		</ul>
		<!-- Eof list of matches / Football sport / Next matches-->
	</div>
	<?php } /* Eof foreach tournaments */?>
	<?php } /* Eof if football sport */?>
	<!-- Eof football sport / Next matches -->

	<!-- Basketball sport / Next matches -->
	<?php if (isset($content['content']['basket']) && $content['content']['basket']['display'] && count($content['content']['basket']) > 0) {?>
	<a href="<?=$content['content']['basket']['url']?>" class="sport basket"><i class="<?= $content['content']['basket']['icon_name']?>"></i> <span><?= $content['content']['basket']['name'];?></span></a>
	<?php foreach ($content['content']['basket']['tournaments'] as $tournament) {?>
	<div class="competition">
		<?php /*
		<a href="<?= $tournament['url']?>" class="competition-name"><span><span><?= $tournament['name']?></span></a>
		<div class="competition-divider"></div>
		<?php if (isset($tournament['step']) && !empty($tournament['step'])) {?>
		<div class="competition-situation"><?= $tournament['step']?></div>
		<?php }?>
		*/?>
		<!-- List of matches / Basketball sport / Next matches-->
		<ul>
			<?php foreach ($tournament['matches'] as $match) {?>
			<!-- Match -->
			<li class="row match <?= $match['status']?>">
				<div class="col-12">
					<a href="#" name="<?php echo $match['home'] . ' vs ' . $match['away']?>">
						<div class="row match-teams">
							<div class="col-5 match-team">
								<div class="team">
									<div class="shield left"><img src="<?=$match['homeImage']?>" name="local" title="" alt=""></div>
									<div class="team-name left" style="width: 101px;">
										<div class="team-name-container">
											<div class="cell"><?=$match['home']?></div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-2 match-info">
								<?php if ($match['status'] == 'Not Starterd' || $match['status'] == 'Finished') {?>
								<?php if (is_numeric($match['status'])){?><div class="playing-status"><span class="situation"></span> En vivo</div><?php }?>
								<div class="time-playing"><?php if (is_numeric($match['status'])){?><span><?php if (is_numeric($match['status']) && $match['status'] <= 4) { echo $match['status']; }?></span> | <time><?php /* $match['match_time']['minutes'] . ':' . $match['match_time']['seconds']*/?></time><?php } else {?>Final<?php }?></div>
									<div class="match-divider">
										<div class="match-divider-content">
											<div class="result basket">
												<span class="number"><?=$match['home_total'];?></span> - <span class="number"><?=$match['away_total'];?></span>
											</div>
										</div>
									</div>
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
									<div class="shield right"><img src="<?=$match['awayImage']?>" name="local" title="" alt=""></div>
									<div class="team-name right" style="width: 101px;">
										<div class="team-name-container">
											<div class="cell"><?=$match['away']?></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
			</li>
			<!-- Eof Match -->
			<?php } /* Eof foreach matches */?>
			
		</ul>
		<!-- Eof list of matches / Basketball sport / Next matches-->
	</div>
	<?php } /* Eof foreach tournaments */?>
	<?php } /* Eof if basket sport */?>
	<!-- Eof basketball sport / Next matches -->
	<!-- Tenis sport / Next matches -->
	<?php if (isset($content['content']['tenis']) && $content['content']['tenis']['display'] && count($content['content']['tenis']) > 0) {?>
	<a href="<?=$content['content']['tenis']['url']?>" class="sport tenis"><i class="<?= $content['content']['tenis']['icon_name']?>"></i> <span><?= $content['content']['tenis']['name'];?></span></a>
	<?php foreach ($content['content']['tenis']['tournaments'] as $tournament) {?>
	<div class="competition">
		<a href="<?= $tournament['url']?>" class="competition-name"><span><span><?= $tournament['name']?></span></a>
		<div class="competition-divider"></div>
		<div class="competition-situation"><?=$tournament['step']?></div>
		<!-- List of matches / Tenis sport / Next matches-->
		<ul>
			<?php foreach ($tournament['matches'] as $match) {?>
			<li>
				<!-- Match -->
				<div class="row match">
					<div class="col-12">
						<a href="#">
							<div class="row match-tenis">
								<div class="col-12"><time class="time"><?= date('H:i', strtotime($match['datetime']))?> hs</time></div>
								<?php if ($tournament['type'] == 'single'){?>
								<div class="col-6">
									<div class="player-info">
										<div class="flag float-left"><img src="<?=$match['player_image_first']?>" name="" alt="" title=""></div>
										<div class="player float-left"><?=$match['player_first']?></div>
									</div>
									<div class="player-info">
										<div class="flag float-left"><img src="<?=$match['player_image_second']?>" name="" alt="" title=""></div>
										<div class="player float-left"><?=$match['player_second']?></div>
									</div>
								</div>
								<div class="col-6">
									<div class="results-player">
										<?php if ($match['status'] === 'live') {?>
										<div class="playing-ball"></div>
										<div class="match-points float-left">40</div>
										<?php }?>
										<?php foreach ($match['score']['player_first'] as $score) {?>
											<div class="column <?php if (isset($score['tie_break'])) {?>tie-break<?php }?> float-left"><?= $score['point'];?> <?php if (isset($score['tie_break'])){?> <span>(<?= $score['tie_break'];?>)</span><?php }?></div>
										<?php }?>
									</div>
									<div class="results-player">
										<?php if ($match['status'] === 'live') {?>
										<div class="match-points float-left">15</div>
										<?php }?>
										<?php foreach ($match['score']['player_second'] as $score) {?>
											<div class="column <?php if (isset($score['tie_break'])) {?>tie-break<?php }?> float-left"><?= $score['point'];?> <?php if (isset($score['tie_break'])){?> <span>(<?= $score['tie_break'];?>)</span><?php }?></div>
										<?php }?>
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
			<?php }?>
		</ul>
		<!-- Eof list of matches / Tenis sport / Next matches-->
	</div>
	<?php } /* Eof foreach tournaments */?>
	<?php } /* Eof if tenis sport */?>
	<!-- Eof tenis sport / Next matches -->

	<a href="#" class="btn-more-content"><?=$content['titleCalendar']?></a>
</section>
<!-- Eof Next matches-->