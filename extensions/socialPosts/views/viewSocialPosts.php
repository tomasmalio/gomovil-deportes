<?php 
	if (!isset($content['columns']['desktop'])) {
		$content['columns']['desktop'] = 3;
	}
	if (!isset($content['columns']['mobile'])) {
		$content['columns']['mobile'] = 1;
	}
?>
<div class="row grid-social">
	<?php foreach ($content['content'] as $social) {?>
	<div class="grid-item-social col-lg-<?= (12 / $content['columns']['desktop'])?> col-md-<?= ( 12 / $content['columns']['desktop'])?> col-sm-<?= (12 / $content['columns']['mobile'])?> col-xs-<?= (12 / $content['columns']['mobile'])?>" <?php if (isset($social->video) && $social->video){?>data-video="true" data-source="<?=$social->video?>"<?php }?>>
		<div class="social-post <?php if (!isset($social->video) && !isset($social->video)){?>only-text<?php }?>">
			<div class="card">
				<?php if (isset($social->video) && $social->video){?>
				<div class="card-video">
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
						<img src="<?=$social->image?>" name="image" alt="" title="" />
						<?php }?>
					</div>
				</div>
				<?php } elseif (isset($social->image) && $social->image){?>
				<div class="card-image">
					<div class="image-container">
						<img src="<?=$social->image?>" name="image" alt="" title="" />
					</div>
				</div>
				<?php }?>
				<div class="card-content">
					<div class="author">
						<div class="author-image"><img src="<?=$social->profile_image?>" name="" alt="" title=""></div>
						<div class="author-name float-left">
							<div class="author-complete-name"><?=$social->username?></div>
							<div class="author-username">@<?=$social->screen_name?></div>
						</div>
					</div>
					<p class="text"><?=SocialPosts::convertSocialLinks(SocialPosts::makeLinks($social->text), strtolower($social->origen))?></p>
				</div>
				<div class="card-footer">
					<div class="social-datetime float-left"><?=$social->fecha?></div>
					<div class="social-source float-right"><a href="<?php echo current(SocialPosts::getLinks($social->text))[0]?>"><i class="social-icon <?= strtolower($social->origen)?>"></i></a></div>
				</div>
			</div>
		</div>
	</div>
	<?php }?>
</div>