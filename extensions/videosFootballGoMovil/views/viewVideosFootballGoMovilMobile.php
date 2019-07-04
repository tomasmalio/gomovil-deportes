<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
	<?php 
		$quantity = 0;
		foreach ($content as $video) {
	?>
	$("#jquery_jplayer_<?=$quantity?>").jPlayer({
		ready: function () {
			$(this).jPlayer("setMedia", {
				title: "<?=$video->nombre;?>",
				m4v: "<?=$video->video;?>",
				poster: "<?=$video->preview;?>"
			});
		},
		play: function() { // To avoid multiple jPlayers playing together.
			$(this).jPlayer("pauseOthers");
		},
		swfPath: "./assets/jplayer/dist/jplayer",
		supplied: "m4v",
		useStateClassSkin: true,
		cssSelectorAncestor: "#jp_container_<?=$quantity?>",
		autoBlur: false,
		smoothPlayBar: true,
		keyEnabled: true,
	});
	<?php 
			$quantity++;
			if (isset($items) && $quantity === $items) {
				break;
			}	
		}
	?>
});
//]]>
</script>
<section class="videos-container">
<?php 
	$i = 0;
	$close = true;

	foreach ($videos as $video) {
		//echo $i . ' / '. $items;
		if ($slider && $i == 0) {
?>
	<div class="swiper-container swiper-container-video">
		<ul class="video-list swiper-wrapper">
<?php 
		}
		if ($slider) {
?>
			<li <?php if ($slider) {?>class="swiper-slide"<?php }?>>
<?php 
		}
?>
				<div id="jp_container_<?=$i?>" class="jp-container jp-video jp-video-full" role="application" aria-label="media player">
					<div class="jp-type-single">
						<div id="jquery_jplayer_<?=$i?>" class="jp-jplayer"></div>
						<div class="jp-gui">
							<div class="jp-interface">
								<div class="jp-progress">
									<div class="jp-seek-bar">
										<div class="jp-play-bar"></div>
									</div>
								</div>
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
										<div class="jp-volume-bar">
											<div class="jp-volume-bar-value"></div>
										</div>
									</div>
									<div class="jp-toggles">
										<button class="jp-full-screen" role="button" tabindex="0">full screen</button>
									</div>
								</div>
							</div>
						</div>
						
						<div class="jp-no-solution">
							<span>Update Required</span>
							To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
						</div>
					</div>
				</div>
<?php 
		if ($slider) {
?>
			</li>
<?php 
		}
		$i++;
		if (isset($items) && $i === $items) {
?>
		</ul>
	</div>
	<!-- Eof Swiper container -->
<?php
			$close = false;
			break;
		}
	}
	// Eof foreach
	if (isset($items) && $i < $items && $close) {
?>
	</ul>
<!-- </div> -->
<?php
	}
?>
</section>