<?php

	$match = $content['content'];
	print_r($match);
	$interactions = $content['content']['interaction'];

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
<section class="matchfootballdetails">
	<div class="matchfootballdetails-content">
		<!-- Match info -->
		<div class="row">
			<div class="col-12">
				<div class="match-info">
					<?php if (isset($match['time']) && $math['time'] !== '') {?>
					<span><?= $match['time']?></span>
					<?php
							$before = true; 
						}
						if (isset($match['date']) && $math['date'] !== '') {
							if ($before) {
					?>
						|
					<?php
							}
					?>
					<span><?= $match['date']?></span> 
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
					<div class="shield left"><img src="<?=$match['team_image_local']?>" name="local" title="" alt=""></div>
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
					<?php if ($match->status == 'live'){?><div class="playing-status"><span class="situation"></span> En vivo</div><?php }?>
				<div class="time-playing"><?php if ($match['status'] == 'live'){?><span><?php if ($match['minuto'] < 45) {?>PT<?php } else { ?>ST<?php }?></span> <time><?= $match['minuto'] . ':' . $match['minuto']?></time><?php } else {?>Final<?php }?></div>
					<div class="match-divider">
						<div class="match-divider-content">
							<div class="result football">
								<span class="number"><?=$match['gol_local'];?></span> - <span class="number"><?=$match['gol_visit'];?></span>
							</div>
						</div>
					</div>
					<?php if ((isset($match['penal_local']) && !empty($match['penal_local'])) && (isset($match['penal_visit']) && !empty($match['penal_visit']))) {?>
					<div class="penalty-score">(<?=$match['gol_local']?>) - (<?=$match['gol_visit']?>)</div>
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
					<div class="shield right"><img src="<?=$match['team_image_visit']?>" name="visit" title="" alt=""></div>
					<div class="team-name right">
						<div class="team-name-container">
							<div class="cell"><?=$match['team_visit']?></div>
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