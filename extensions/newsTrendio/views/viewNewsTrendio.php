<section class="newstrendio">
	<h2><?= $content['title']?></h2>
	<div class="newstrendio-content <?php if ($slider) {?>swiper-container<?php }?>">
		<?php if ($content['news']) {?>
		<ul class="<?php if (!$slider) {?>row <?php }?>list-trendio <?php if ($slider) {?>swiper-wrapper<?php }?>">
			<?php 
				$quantity = 0;
				foreach ($content['data'] as $news) {
			?>
			<li class="<?php if ($slider) {?>swiper-slide<?php } else {?>col-lg-3 col-md-3 col-sm-6 col-xs-12<?php }?>" itemscope itemtype="http://schema.org/NewsArticle">
				<?php if (!$slider) {?>
				<div class="content">
				<?php }?>
					<a href="/noticia/<?=$news['id'] . "/" . $news['inner_link']?>" title="<?= $new['title']?>" itemprop="url">
						<div class="row">
							<div class="col-12">
								<div class="content-image">
									<div class="img-wrap ratio-16-9">
										<div class="image" itemprop="image">
											<img src="<?= $news['image']?>" name="<?= $new['title']?>" alt="<?= $new['title']?>" title="<?= $new['title']?>" />
										</div>
									</div>
								</div>
								<div class="news-content">
									<div class="author" itemprop="author"><?= $news['credit']?></div>
									<time datetime="<?= $news['created_at']?>"><?= strftime('%d %B - %H:%M', strtotime($news['created_at']))?></time>
									<meta itemprop="datePublished" value="<?= date('Y-m-d\TH:i:s\Z', strtotime($news['created_at']))?>">
									<h3 itemprop="about"><?=$news['title']?></h3>
									<h4 itemprop="alternativeHeadline"><?php if (strlen($news['sub_title']) > 180) { echo substr($news['sub_title'],0,strpos($news['sub_title'],' ',180)).'...'; } else { echo $news['sub_title'];}?></h4>
								</div>
							</div>
						</div>
					</a>
				<?php if (!$slider) {?>
				</div>
				<?php }?>
			</li>
			<?php 
					$quantity++;
					if (isset($items) && $quantity === $items) {
						break;
					}
				}
			?>
		</ul>
		<?php if ($pagination) {?>
		<div class="swiper-pagination"></div>
		<?php }?>
		<?php 
			} else {
		?>
		<div class="row grid-social">
			<?php
				foreach ($content['data'] as $news) {
			?>
				<div class="grid-item-social col-lg-3 col-md-3 col-sm-12 col-xs-12" <?php if (isset($news['video']) && $news['video']){?>data-video="true" data-source="<?=$news['video']?>"<?php }?>>
					<div class="social-post <?php if (!isset($news['video']) && !isset($news['video'])){?>only-text<?php }?>">
						<div class="card">
							<?php if (isset($news['video']) && $news['video']){?>
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
									<?php if (isset($news['image']) && $news['image']){?>
									<img src="<?=$news['image']?>" name="image" alt="" title="" />
									<?php }?>
								</div>
							</div>
							<?php } elseif (isset($news['image']) && $news['image']){?>
							<div class="card-image">
								<div class="image-container">
									<img src="<?=$news['image']?>" name="image" alt="" title="" />
								</div>
							</div>
							<?php }?>
							<div class="card-content">
								<div class="author">
									<div class="author-image"><img src="<?=$news['credit_image']?>" name="" alt="" title=""></div>
									<div class="author-name float-left">
										<div class="author-complete-name"><?=$news['credit_name']?></div>
										<div class="author-username">@<?=$news['credit']?></div>
									</div>
								</div>
								<p class="text"><?php //Widgets::convertSocialLinks(Widgets::makeLinks($news['summary']), strtolower($news['social_network']))?><?= $news['summary']?></p>
							</div>
							<div class="card-footer">
								<div class="social-datetime float-left"><?php 
									if (date('Y-m-d') == date('Y-m-d', strtotime($news['created_at']))) {
										echo "Hoy";
									} elseif (date('Y-m-d', strtotime( '-1 days' )) == date('Y-m-d', strtotime($news['created_at']))) {
										echo "Ayer";
									} else {
										echo strftime('%d %B - %H:%M', strtotime($news['created_at']));
									}	
								?></div>
								<div class="social-source float-right"><a href="<?= $news['external_link']?>"><i class="social-icon <?= strtolower($news['social_network'])?>"></i></a></div>
							</div>
						</div>
					</div>
				</div>
			<?php }?>
		</div>
		<?php }?>
	</div>
</section>