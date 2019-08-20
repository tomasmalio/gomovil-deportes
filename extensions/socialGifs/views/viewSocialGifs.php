<div class="social-gifs">
	<?php
		$gifs = $content['content'];
		if ($gifs) {
	?>
	<?php if (isset($content['title'])){?><h3><?=$content['title']?></h3><?php }?>
	<div class="row">
		<?php
				foreach ($gifs as $gif) {
		?>
		<div class="col-12">
			<div class="post-gif">
				<a href="whatsapp://send?text=Te%20invitó%20a%20descargar%20este%20GIF:%20<?=$gif['images']['downsized_large']['url']?>" data-action="share/whatsapp/share" target="_blank"><img src="<?=$gif['images']['downsized_large']['url'];?>" name="<?=$gif['slug']?>" width="<?=$gif['images']['downsized_large']['width'];?>" height="<?=$gif['images']['downsized_large']['height'];?>"></a>
			</div>
		</div>
		<?php 
				}
			}
		?>
	</div>
</div>