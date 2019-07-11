<?php $socialContent = $content['content']['data'];?>
<section class="socialpostfootball">
	<?php 
		foreach ($socialContent as $c) {
	?>
	<div class="row socialpostfootball-content">
		<div class="col-12">
			<div class="interaction-situation">
				<div class="number"><?= $c['name']?></div>
			</div>
		</div>
		<?php
				$items = $c['items'];
				foreach ($items as $social) {
		?>
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<div class="social-post">
				<?php if (isset($social['media_video']) || isset($social['media'])) {?>	
				<div class="social-media">
					<?php if (isset($social['media_video'])) {?>
					<video style="max-height:234px; width:100%" x-webkit-airplay="allow" ng-switch-when="2" class="videoPlayer" preload="metadata" controls="" poster="<?=$social['media']?>">
						<source src="<?=$social['media_video']?>" type="video/mp4">
					</video>
					<?php } else {?>
					<img src="<?=$social['media']?>" name="" alt="" title="">
					<?php }?>
				</div>	
				<?php }?>
				<div class="social-content">
					<div class="icon"><a href="<?=current(Widgets::getLinks($social['text']))[0]?>" target="_blank"><i class="social-icon <?=$social['provider']?>"></i></a></div>
					<div class="user-content clearfix">
						<div class="user-image float-left"><a href="<?=$social['user_url']?>"><img src="<?=$social['profile_image_url']?>" name="" alt="<?=$social['user_name']?>" title="<?=$social['user_name']?>"></a></div>
						<div class="user-info float-left">
							<div class="user-name"><a href="<?=$social['user_url']?>" target="_blank"><?=$social['user_name']?></a></div>
							<div class="user-screen-name"><a href="<?=$social['user_url']?>" target="_blank">@<?=$social['screen_name']?></a></div>
						</div>
					</div>
					<div class="text-content"><?=Widgets::convertSocialLinks($social['text'], strtolower($social['provider']))?></div>
				</div>
				<div class="social-actions"></div>
			</div>
		</div>
		<?php 
				}
		?>
	</div>
	<?php 
		}
	?>
</section>