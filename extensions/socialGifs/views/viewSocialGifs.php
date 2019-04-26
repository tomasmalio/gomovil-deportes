<div class="social-gifs">
	<?php
		// print_r($gifs); 
		foreach ($gifs as $gif) {
			foreach ($gif as $media) {
	?>
	<div class="col-12">
		<div class="post-gif">
			<img src="<?=$media->images->fixed_height_downsampled->url;?>" name="<?=$media->slug?>" width="<?=$media->images->fixed_height_downsampled->width;?>" height="<?=$media->images->fixed_height_downsampled->height;?>">
		</div>
	</div>
	<?php 
			}
		}
	?>
</div>