<?php
	$match = $content['content'];
	$interactions = $content['content']['interaction'];

	/* Switch of each status */
	switch ($match['status']) {
		case 'Por comenzar':
			$match['status'] = 'to start';
			break;
		case 'En vivo':
		case 'En Juego':
			$match['status'] = 'live';
			break;
		case 'Finalizado':
			$match['status'] = 'end';
			break;	
	}
?>
<section class="matchfootballdetails">
	<div class="matchfootballdetails-content">
		<!-- Match info -->
		<div class="row">
			<div class="col-12">
				<div class="match-info">
					<?php if (isset($match['datetime']) && $math['datetime'] !== '') {?>
					<span><?= date('d F, Y | H:i', strtotime($match['datetime']))?></span>
					<?php
							$before = true; 
						}
						if (isset($match['datime']) && $math['datime'] !== '') {
							if ($before) {
					?>
						|
					<?php
							}
					?>
					<span><?= date('d-m-Y H:i', strtotime($match['datetime']))?></span>
					<?php
							$last = true; 
						}
						if (isset($match['stadium']) && $match['stadium'] != '') {
							if ($last || ($before && !$last)) {
					?>
								|
					<?php
							}
					?>
					<span><?= $match['stadium']?></span>
					<?php }?>
				</div>
			</div>
		</div>
		<!-- Eof match info -->
		<!-- Match teams -->
		<div class="row match-teams">
			<div class="col-5 match-team">
				<div class="team">
					<div class="shield left"><img src="<?=$match['local_image']?>" name="local" title="" alt=""></div>
					<div class="team-name left">
						<div class="team-name-container">
							<div class="cell"><?=$match['local_team']?></div>
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
					<?php if ($match->status == 'live'){?><div class="playing-status"><span class="situation"></span> En vivo</div><?php }?>
				<div class="time-playing"><?php if ($match['status'] == 'live'){?><span><?php if ($match['minutes'] < 45) {?>PT<?php } else { ?>ST<?php }?></span> <time><?= $match['minutes']?>'</time><?php } else {?>Final<?php }?></div>
					<div class="match-divider">
						<div class="match-divider-content">
							<div class="result football">
								<span class="number"><?=$match['local_gol'];?></span> - <span class="number"><?=$match['visit_gol'];?></span>
							</div>
						</div>
					</div>
					<?php if ((isset($match['local_penalty']) && !empty($match['local_penalty'])) && (isset($match['visit_penalty']) && !empty($match['visit_penalty']))) {?>
					<div class="penalty-score">(<?=$match['local_gol']?>) - (<?=$match['visit_gol']?>)</div>
					<?php }?>
				<?php } else {?>
					<div class="match-divider">
						<div class="match-divider-content">
							<div class="time-to-play"><?= date('H:i', strtotime($match['datetime']))?></div>
						</div>
					</div>
				<?php }?>
			</div>
			<div class="col-5 match-team">
				<div class="team">
					<div class="shield right"><img src="<?=$match['visit_image']?>" name="visit" title="" alt=""></div>
					<div class="team-name right">
						<div class="team-name-container">
							<div class="cell"><?=$match['visit_team']?></div>
						</div>
					</div>
				</div>
				<?php if ((isset($match['penal_local']) && !empty($match['penal_local'])) && (isset($match['penal_visit']) && !empty($match['penal_visit']))) {?>
				<div class="penalties right">
					<div class="shoot no-goal"></div>
					<div class="shoot no-goal"></div>
					<div class="shoot goal"></div>
					<div class="shoot goal"></div>
					<div class="shoot"></div>
				</div>
				<?php }?>
			</div>
			<?php /*if ($match['status'] != 'live' || $match['status'] != 'end') {?>
			<div class="col-12">
				<div class="votes">
					<p><?=$titleVote?></p>
					<button class="vote" type="button">Votar</button>
				</div>
			</div>
			<?php }*/?>
		</div>
		<!-- Eof match teams -->
		<!-- Match interactions -->
		<div class="row">
			<div class="col-12">
				<div class="match-interactions">
					<?php 
						foreach ($interactions as $interaction) {
							$double = false;
							switch (Widgets::normalizeString($interaction['interaction'])) {
								case 'gol':
								case 'goal':
										$icon = 'sports-football-icon goal';
									break;
								case 'modificacion':
								case 'modification':
								case 'change':
										$double = true;
										$icon = 'sports-football-icon change change';
									break;
								case 'amarilla':
								case 'tarjeta-amarilla':
								case 'yellow-card':
										$icon = 'sports-football-icon cardreferee yellow-card';
									break;
								case 'roja':
								case 'tarjeta-roja':
								case 'red-card':
										$icon = 'sports-football-icon cardreferee red-card';
									break;
							}
					?>
					<div class="row interaction">
						<?php if ($interaction['team_condition'] == 'local') {?>
						<div class="col-6 interaction-description left"><?=$interaction['player'] . ' ('.$interaction['minutes'].')';?></div>
						<div class="interaction-type"><?php if ($double) {?><i class="<?= $icon;?>-out"></i><i class="<?= $icon;?>-in"></i><?php } else {?><i class="<?= $icon;?>"></i><?php }?></div>
						<div class="col-6"></div>
						<?php } else {?>
						<div class="col-6"></div>
						<div class="interaction-type"><?php if ($double) {?><i class="<?= $icon;?>-out"></i><i class="<?= $icon;?>-in"></i><?php } else {?><i class="<?= $icon;?>"></i><?php }?></div>
						<div class="col-6 interaction-description right"><?= '('.$interaction['minutes'].') '. $interaction['player'];?></div>
						<?php }?>
					</div>
					<?php }?>
				</div>
			</div>
		</div>
		<!-- Eof match interactions -->
	</div>
</section>