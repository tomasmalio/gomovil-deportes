<?php
	if (count($content['content']) > 0) {
		// print_r($content);
		// exit;
		if (isset($content['social_image']) && $content['social_image']) {
			$showImages = true;
		} else {
			$showImages = false;
		}

		// Define columns sizes
		$val = 12 / $items;
		$col = ((strpos($val, '.')) ? (ceil($val)) : $val);
?>
<div class="row grid-social">
	<script type="text/javascript">
		var q = 1;
	</script>
	<?php
		/**
		 * Social Posts
		 */
		$quantity = 0;
		$contentSocial = $content['content'];
		foreach ($contentSocial as $key => $social) {
			if ((!isset($content['social_image'])) || (isset($content['social_image']) && $content['social_image'] && ($social->image != '' || $social->video != ''))) {
				if ($social->image) {
					$quantity++;

					$output = @file_get_contents($social->image, false);
					if (strpos($http_response_header[0], "200")) {
						$imageSize = getimagesize($social->image);
						if ($imageSize) {
							//$social->image = '';
						} else {
							$imageSize = ['width' => '250', 'height' => '250'];
						}
					} else {
						$social->image = '';
					}
				}
	?>
		<div class="grid-item-social col-<?=$col?>" <?php if (isset($social->video) && $social->video){?>data-video="true" data-source="<?=$social->video?>"<?php }?>>
			<div class="social-post<?php if (!isset($social->video) && !isset($social->image)){?> only-text<?php }?>">
			<!-- Card -->
			<div class="card">
				<?php if (isset($social->video) && $social->video){?>
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
						<?php if (isset($social->image) && $social->image){?>
						<img src="<?=$social->image?>" name="image" alt="" title="" class="social-video-image-<?=$quantity?>" />
						<?php }?>
					</div>
				</div>
				<?php } elseif (isset($social->image) && $social->image){?>
				<div class="card-image">
					<div class="image-container">
					<a href="<?= current(SocialPosts::getLinks($social->text))[0]?>" target="_blank"><img src="<?=$social->image?>" name="image" alt="" title="" class="social-image-<?=$quantity?>" /></a>
					</div>
				</div>
				<?php }?>
				<div class="card-content">
					<div class="author">
						<div class="author-image"><a href="<?= current(SocialPosts::getLinks($social->text))[0]?>" target="_blank"><img src="<?=$social->profile_image?>" name="" alt="" title=""></a></div>
						<div class="author-name float-left">
							<div class="author-complete-name"><a href="<?= current(SocialPosts::getLinks($social->text))[0]?>" target="_blank"><?=$social->username?></a></div>
							<div class="author-username"><a href="<?= current(SocialPosts::getLinks($social->text))[0]?>" target="_blank">@<?=$social->screen_name?></a></div>
						</div>
					</div>
					<p class="text"><?=SocialPosts::convertSocialLinks(SocialPosts::makeLinks($social->text), strtolower($social->origen))?></p>
				</div>
				<div class="card-footer">
					<div class="social-datetime float-left"><?=$social->fecha?></div>
					<div class="social-source float-right"><a href="<?= current(SocialPosts::getLinks($social->text))[0]?>" target="_blank"><i class="social-icon <?= strtolower($social->origen)?>"></i></a></div>
				</div>
			</div>
			<!-- Eof card -->
			<?php 
				if ($social->image) {
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
		}
	?>
</div>
<?php }?>