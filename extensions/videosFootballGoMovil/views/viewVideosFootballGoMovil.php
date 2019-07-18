<?php
	if (count($content['content']) > 0){
		if ($content['type' == 'grid']) {
			// Define columns sizes
			if (IS_MOBILE) {
				$col = 12 / $content['columns']['mobile'];
			} else {
				$col = 12 / $content['columns']['desktop'];
			}
?>
<section class="videosfootballgomovil">
	<div class="row videosfootballgomovil-content">
		<?php
			$quantity = 0;
			$videoContent = $content['content'];
			foreach ($videoContent as $video) {
		?>
		<div class="col-<?=$col?>">
			<div class="video-content">
				<video style="max-height:234px; width:100%" x-webkit-airplay="allow" ng-switch-when="2" class="videoPlayer" preload="metadata" controls="" poster="<?=$video->preview?>">
					<source src="<?=$video->video?>" type="video/mp4">
				</video>
				<div class="video-description"><?=$video->nombre?></div>
			</div>
		</div>
		<?php 
				$quantity++;
				if (isset($items) && $quantity === $items) {
					break;
				}
			}
		?>
	</div>
</div>
<?php
		} else {
			if (!IS_MOBILE) {
?>
<script type="text/javascript" async>
	//<![CDATA[
	$(document).ready(function(){
		new jPlayerPlaylist({
			jPlayer: "#jquery_jplayer_1",
			cssSelectorAncestor: "#jp_container_1"
			}, 
			[
				<?php 
					$quantity = 0;
					foreach ($content['content'] as $video) {?>
				{
					title: "<?=$video->nombre;?>",
					m4v: "<?=$video->video;?>",
					poster: "<?=$video->preview;?>"
				},
				<?php 
						$quantity++;
						if (isset($items) && $quantity === $items) {
							break;
						}	
					}
				?>
			],
			{
				playlistOptions: {
					<?php if ($options['controls']['autoPlay']) {?>
					autoPlay: <?=$options['controls']['autoPlay']?>,
					<?php }?>
				},
				swfPath: "./assets/jplayer/dist/jplayer",
				supplied: "m4v",
				useStateClassSkin: true,
				autoBlur: false,
				smoothPlayBar: true,
				keyEnabled: true,
				<?php 
					if ($options['controls']['loop']) {
				?>
				loop: <?=$options['controls']['loop']?>,
				<?php 
					}
					if (!$options['controls']['displayControls'] || ($options['controls']['autoPlay'] === false)) {
				?>
				autohide: {
					restored: true,
				},
				<?php 
					}
					if ($options['controls']['muted']) {
				?>
				muted: <?=$options['controls']['muted']?>,
				<?php }?>
				fullScreen: true
			},
		);
	});
	//]]>
</script>
<section id="jp_container_1" class="jp-container jp-video jp-video-full" role="application" aria-label="media player">
	<?php if ($content['title']){?><h3><?=$content['title']?></h3><?php }?>
	<div class="row jp-type-playlist">
		<!-- Playlist -->
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 playlist-content">
			<div class="jp-playlist">
				<ul>
					<!-- The method Playlist.displayPlaylist() uses this unordered list -->
					<li>&nbsp;</li>
				</ul>
			</div>
		</div>
		<!-- Eof Playlist -->
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 player-content">
			<div id="jquery_jplayer_1" class="jp-jplayer"></div>
			
			<div class="jp-video-play">
				<div class="play-icon">
					<button class="jp-video-play-icon" role="button" tabindex="0"></button>
				</div>
			</div>
			
			<div class="jp-gui">
				<div class="jp-interface">
					<div class="jp-progress">
						<div class="jp-seek-bar">
							<div class="jp-play-bar"></div>
						</div>
					</div>
					<!--<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
					<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>-->
					<div class="jp-controls-holder">
						<div class="jp-controls">
							<button class="jp-previous" role="button" tabindex="0">previous</button>
							<button class="jp-play" role="button" tabindex="0">play</button>
							<button class="jp-next" role="button" tabindex="0">next</button>
							<button class="jp-stop" role="button" tabindex="0">stop</button>
							<div class="current-time">
								<span class="jp-current-time" role="timer" aria-label="time">&nbsp;</span> <span class="divider">/</span> <span class="jp-duration" role="timer" aria-label="duration">&nbsp;</span>
							</div>
						</div>
						<div class="jp-volume-controls">
							<button class="jp-mute" role="button" tabindex="0">mute</button>
							<!--<button class="jp-volume-max" role="button" tabindex="0">max volume</button>-->
							<div class="jp-volume-bar">
								<div class="jp-volume-bar-value"></div>
							</div>
						</div>
						<div class="jp-toggles">
							<!--<button class="jp-repeat" role="button" tabindex="0">repeat</button>
							<button class="jp-shuffle" role="button" tabindex="0">shuffle</button>-->
							<button class="jp-full-screen" role="button" tabindex="0">full screen</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 jp-no-solution">
			<span>Update Required</span>
			To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
		</div>
	</div>
</section>
<?php } else {?>
<section class="videosfootballgomovil">
	<?php if ($content['title']){?><h3><?=$content['title']?></h3><?php }?>
	<div class="videosfootballgomovil-content <?php if ($slider) {?>swiper-container<?php }?>">
		<ul class="list-videos <?php if ($slider) {?>swiper-wrapper<?php }?>">
			<?php 
				$quantity = 0;
				$videoContent = $content['content'];
				foreach ($videoContent as $video) {
			?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
				<div class="video-content">
					<video style="max-height:234px; width:100%" x-webkit-airplay="allow" ng-switch-when="2" class="videoPlayer" preload="metadata" controls="" poster="<?=$video->preview?>">
						<source src="<?=$video->video?>" type="video/mp4">
					</video>
					<div class="video-description"><?=$video->nombre?></div>
				</div>
			</li>
			<?php 
					$quantity++;
					if (isset($items) && $quantity === $items) {
						break;
					}
				}
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
</section>
<?php
			} // Eof type
		} // Eof validation mobile or desktop
	}
?>