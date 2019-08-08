<?php 
	$toptrends = $content['content']['data'];
	if ($toptrends) {
		if (isset($content['columns']['desktop']) || isset($content['columns']['mobile'])) {
			if (isset($content['columns']['mobile']) && IS_MOBILE) {
				$col = 12 / $content['columns']['mobile'];
			} elseif (isset($content['columns']['desktop']) && !IS_MOBILE) {
				$col = 12 / $content['columns']['desktop'];
			}
		} else {
			if (IS_MOBILE) {
				$col = 12 / 1;
			} else {
				$col = 12 / 4;
			}
		}
		//$col = ((strpos($val, '.')) ? (ceil($val)) : $val);
?>
<section class="toptrendssocial">
	<?php if (isset($content['title'])) {?><h3><?= $content['title']?></h3><?php }?>
	<div class="row grid-social">
		<script type="text/javascript">
			var q = 1;
		</script>
		<?php 
			$quantity = 0;
			foreach ($toptrends as $social) {
				if ((!isset($content['social_image'])) || (isset($content['social_image']) && $content['social_image'] && ($social['image'] != '' || $social['video'] != ''))) {
					if ($social['image']) {
						$quantity++;
						$imageSize = getimagesize($social['image']);
					}
		?>
		<div class="grid-item-social col-<?=$col?>" <?php if (isset($social['video']) && $social['video']){?>data-video="true" data-source="<?=$social['video']?>"<?php }?>>
			<div class="social-post <?php if ($social['video'] == '' && $social['image'] == ''){?>only-text<?php }?>">
				<div class="card">
					<?php if (isset($social['video']) && $social['video']){?>
						<div class="card-video social-card-<?=$quantity?>">
						<div class="video-image">
							<div class="play-content">
								<div class="box">
									<div class="button-play">
										<div class="circle">
											<div class="play"></div>
										</div>
									</div>
								</div>
							</div>
							<?php if (isset($social['image']) && $social['image']){?>
							<img src="<?=$social['image']?>" name="image" alt="" title="" class="social-video-image-<?=$quantity?>" />
							<?php }?>
						</div>
					</div>
					<?php } elseif (isset($social['image']) && $social['image']){?>
					<div class="card-image">
						<div class="image-container">
							<img src="<?=$social['image']?>" name="image" alt="" title="" class="social-image-<?=$quantity?>" />
						</div>
					</div>
					<?php }?>
					<div class="card-content">
						<div class="author">
							<div class="author-image">
								<?php 
									$url = @file_get_contents($social['profile_image']);
									if (strpos($http_response_header[0], "200")) {
								?>
								<img src="<?=$social['profile_image']?>" name="" alt="" title="">
								<?php } else {?>
								<img src="https://i.ibb.co/dPdG7pb/no-user-image.jpg" name="imagedefault" alt="" title="">
								<?php }?>
							</div>
							<div class="author-name float-left">
								<div class="author-complete-name"><?=$social['username']?></div>
								<?php if (strtolower($social['origen']) != 'youtube') {?><div class="author-username"><?=$social['screen_name']?></div><?php }?>
							</div>
						</div>
						<?php /*<p class="text"><?=Widgets::convertSocialLinks(Widgets::makeLinks($social['text']), strtolower($social['origen']))?></p>*/?>
						<p class="text"><?=$social['text'];?></p>
					</div>
					<div class="card-footer">
						<div class="social-datetime float-left"><?=$social['fecha']?></div>
						<div class="social-source float-right"><a href="<?php echo current(Widgets::getLinks($social['text']))[0]?>" target="_blank"><i class="social-icon <?= strtolower($social['origen'])?>"></i></a></div>
					</div>
				</div>
				<!-- Eof card -->
				<?php 
					if ($social['image']) {
				?>
				<script type="text/javascript">
					var mediaSize = imageResize(<?=$imageSize[0]?>, <?=$imageSize[1]?>, $(".social-post").innerWidth());
					var socialCard = $(".social-card-"+q);
					var socialVideoImage = $(".social-video-image-"+q);
					var socialImage = $(".social-image-"+q);
					$(socialCard).css({'width': mediaSize['width']+'px', 'height': mediaSize['height']+'px'});
					$(socialVideoImage).css({'width': mediaSize['width']+'px', 'height': mediaSize['height']+'px'});
					$(socialImage).css({'width': mediaSize['width']+'px', 'height': mediaSize['height']+'px'});
					console.log(q + ' w:' + mediaSize['width'] + ' h:' + mediaSize['height']);
					q++;
				</script>
				<?php }?>
			</div>
		</div>
		<?php
				}
				if (isset($content['limit']) && $quantity == $content['limit']) {
					break;
				}
			} // Eof foreach
		?>
	</div>
</section>
<?php }?>