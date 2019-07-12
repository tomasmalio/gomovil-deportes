<div class="social-gifs">
	<?php
		$gifs = $content['content'];
		if ($gifs) {
			foreach ($gifs as $gif) {
	?>
	<div class="col-12">
		<div class="post-gif">
			<img src="<?=$gif['images']['downsized_large']['url'];?>" name="<?=$gif['slug']?>" width="<?=$gif['images']['downsized_large']['width'];?>" height="<?=$gif['images']['downsized_large']['height'];?>">
		</div>
	</div>
	<?php 
			}
		}
	?>
</div>