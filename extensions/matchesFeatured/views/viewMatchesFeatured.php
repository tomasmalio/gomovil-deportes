<!-- Match Featured -->
<section class="matchfeatured">
	<h3>
		<span><?=$label?></span>
	</h3>
	<a href="#" class="sport football">
		<i class="fas fa-futbol football"></i> <span>Fútbol</span>
	</a>
	<div class="matchesfeatured-content <?php if ($slider) {?>swiper-container<?php }?>">
		<ul class="<?php if ($slider) {?>swiper-wrapper<?php }?>">
			<?php 
				$quantity = 0;
				foreach ($content['content'] as $match) {
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<div class="match-featured">
					<a href="#" name="<?php echo $match['team_local'] . ' vs ' . $match['team_visit']?>">
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
											<div class="time-to-play"><?= date('H:i', strtotime($match['datetime_start']))?></div>
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
							<?php if ($match['status'] != 'live' || $match['status'] != 'end') {?>
							<div class="col-12">
								<div class="votes">
									<p><?=$titleVote?></p>
									<button class="vote" type="button">Votar</button>
								</div>
							</div>
							<?php }?>
						</div>
					</a>
				</div>
			</li>
			<?php 
					$quantity++;
					if (isset($items) && $quantity === $items) {
						break;
					}
				}
				// Foreach matches
			?>
		</ul>
		<?php if ($pagination) {?>
		<div class="swiper-pagination"></div>
		<?php }?>
		<?php if ($navigation) {?>
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
		<?php }?>
	</div>
	<!-- Eof swiper container -->
</section>
<!-- Eof Match Featured -->