<div class="social-gifs">
	<?php
		$gifs = $content['content'];
		foreach ($gifs as $gif) {
	?>
	<div class="col-12">
		<div class="post-gif">
			<img src="<?=$gif['images']['fixed_height_downsampled']['url'];?>" name="<?=$gif['slug']?>" width="<?=$gif['images']['fixed_height_downsampled']['width'];?>" height="<?=$gif['images']['fixed_height_downsampled']['height'];?>">
		</div>
	</div>
	<?php 
		}
	?>
</div>