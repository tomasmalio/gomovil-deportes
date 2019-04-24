<script type="text/javascript" async>
	//<![CDATA[
	$(document).ready(function(){

		new jPlayerPlaylist({
			jPlayer: "#jquery_jplayer_1",
			cssSelectorAncestor: "#jp_container_1"
			}, 
			<?php print_r(json_encode($this->videos));?>,
			{
				playlistOptions: {
					<?php if ($videoList->controls['autoPlay']) {?>
					autoPlay: <?=$videoList->controls['autoPlay']?>,
					<?php }?>
				},
				swfPath: "./assets/jplayer/dist/jplayer",
				supplied: "m4v",
				useStateClassSkin: true,
				autoBlur: false,
				smoothPlayBar: true,
				keyEnabled: true,
				<?php if ($videoList->controls['loop']) {?>
				loop: <?=$videoList->controls['loop']?>,
				<?php }?>
				<?php if (!$videoList->controls['displayControls']) {?>
				autohide: {
					restored: true,
				},
				<?php }?>
				<?php if ($videoList->controls['muted']) {?>
				muted: <?=$videoList->controls['muted']?>,
				<?php }?>
			},
			
		);
	});
	//]]>
</script>
<section id="jp_container_1" class="jp-container jp-video jp-video-full" role="application" aria-label="media player">
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
			<div class="jp-gui">
				<div class="jp-video-play">
					<button class="jp-video-play-icon" role="button" tabindex="0">play</button>
				</div>
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
					<div class="jp-details">
						<div class="jp-title" aria-label="title">&nbsp;</div>
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