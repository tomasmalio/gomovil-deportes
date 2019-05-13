<div class="row grid-social">
	<?php foreach ($content as $social) {?>
	<div class="grid-item-social col-lg-4 col-md-4 col-sm-12 col-xs-12" <?php if (isset($social->video) && $social->video){?>data-video="true" data-source="<?=$social->video?>"<?php }?>>
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
				<!-- <a href="#" target="_blank"> -->
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
				<!-- </a>	 -->
			</div>
		</div>
	</div>
	<?php }?>
</div>

<?php /***
<div class="row grid-social">
	<?php foreach ($socials as $social) {?>
	<div class="grid-item-social col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<div class="social-post">
			<div class="card">
				<div class="card-image">
					<div class="image-container">
						<img src="https://pbs.twimg.com/card_img/1118953968925847553/WySJcv4d?format=jpg&name=600x314" name="image" alt="" title="" />
					</div>
				</div>
				<a href="https://twitter.com/user/status/1119244471940648970" target="_blank">
					<div class="card-content">
						<div class="author">
							<div class="author-image"><img src="<?=$social->profile_image?>" name="" alt="" title=""></div>
							<div class="author-name float-left">
								<div class="author-complete-name"><?=$social->username?></div>
								<div class="author-username">@<?=$social->screen_name?></div>
							</div>
						</div>
						<p class="text"><?=$social->text?></p>
					</div>
					<div class="card-footer">
						<div class="social-datetime float-left"><?=$social->username?></div>
						<div class="social-source float-right"><i class="social-icon youtube"></i></div>
					</div>
				</a>	
			</div>
		</div>
	</div>
	<?php }?>
	<div class="grid-item-social col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<div class="social-post only-text">
			<div class="card">
				<a href="https://twitter.com/user/status/1119244471940648970" target="_blank">
					<div class="card-content">
						<div class="author">
							<div class="author-image"><img src="https://pbs.twimg.com/profile_images/1105087235869892609/XePDW768_400x400.jpg" name="" alt="" title=""></div>
							<div class="author-name float-left">
								<div class="author-complete-name">FC Barcelona</div>
								<div class="author-username">@FCBarcelona_es</div>
							</div>
						</div>
						<p class="text"> Hoy hace 100 años de un <span>@RealSociedad</span> - <span>#Barça</span> que guarda una historia curiosa... 😜</p>
					</div>
					<div class="card-footer">
						<div class="social-datetime float-left">9:15 AM - 20 Mar 2019</div>
						<div class="social-source float-right"><i class="social-icon instagram"></i></div>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class="grid-item-social col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<div class="social-post">
			<div class="card">
				<div class="card-image">
					<div class="image-container">
						<img src="http://pbs.twimg.com/media/D4wNMb8XsAAhgME.jpg" name="image" alt="" title="" />
						<!-- <span style="background-image:url('https://pbs.twimg.com/card_img/1118953968925847553/WySJcv4d?format=jpg&name=600x314');"></span> -->
					</div>
				</div>
				<a href="https://twitter.com/user/status/1119244471940648970" target="_blank">
					<div class="card-content">
						<div class="author">
							<div class="author-image"><img src="http://pbs.twimg.com/profile_images/1053546602248523776/sAcoqHG-_normal.jpg" name="" alt="" title=""></div>
							<div class="author-name float-left">
								<div class="author-complete-name">MARCA</div>
								<div class="author-username">@marca</div>
							</div>
						</div>
						<p class="text"> Mbappé verá los partidos de Zidane y el Real Madrid... como admirador https://t.co/VrC10M0wom</p>
					</div>
					<div class="card-footer">
						<div class="social-datetime float-left">9:15 AM - 20 Mar 2019</div>
						<div class="social-source float-right"><i class="social-icon facebook"></i></div>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class="grid-item-social col-lg-4 col-md-4 col-sm-12 col-xs-12" data-video="true" data-source="https://video.twimg.com/ext_tw_video/1119629492497068033/pu/vid/720x1280/gQUuSuaRGN5IVKyZ.mp4?tag=8">
		<div class="social-post only-text">
			<div class="card">
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
						<img src="http://pbs.twimg.com/ext_tw_video_thumb/1119629492497068033/pu/img/Nw2lr41Hhb22RXaD.jpg" name="" alt="" title="" />
					</div>
				</div>
				<a href="https://twitter.com/user/status/1119244471940648970">
					<div class="card-content">
						<div class="author">
							<div class="author-image"><img src="https://pbs.twimg.com/profile_images/1105087235869892609/XePDW768_400x400.jpg" name="" alt="" title=""></div>
							<div class="author-name float-left">
								<div class="author-complete-name">FC Barcelona</div>
								<div class="author-username">@FCBarcelona_es</div>
							</div>
						</div>
						<p class="text"> Hoy hace 100 años de un <span>@RealSociedad</span> - <span>#Barça</span> que guarda una historia curiosa... 😜</p>
					</div>
					<div class="card-footer">
						<div class="social-datetime float-left">9:15 AM - 20 Mar 2019</div>
						<div class="social-source float-right"><i class="social-icon twitter"></i></div>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class="grid-item-social col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<div class="social-post">
			<div class="card">
				<div class="card-image">
					<div class="image-container">
						<img src="https://pbs.twimg.com/card_img/1118953968925847553/WySJcv4d?format=jpg&name=600x314" name="image" alt="" title="" />
						<!-- <span style="background-image:url('https://pbs.twimg.com/card_img/1118953968925847553/WySJcv4d?format=jpg&name=600x314');"></span> -->
					</div>
				</div>
				<a href="https://twitter.com/user/status/1119244471940648970" target="_blank">
					<div class="card-content">
						<div class="author">
							<div class="author-image"><img src="https://pbs.twimg.com/profile_images/1105087235869892609/XePDW768_400x400.jpg" name="" alt="" title=""></div>
							<div class="author-name float-left">
								<div class="author-complete-name">FC Barcelona</div>
								<div class="author-username">@FCBarcelona_es</div>
							</div>
						</div>
						<p class="text"> Hoy hace 100 años de un <span>@RealSociedad</span> - <span>#Barça</span> que guarda una historia curiosa... 😜</p>
					</div>
					<div class="card-footer">
						<div class="social-datetime float-left">9:15 AM - 20 Mar 2019</div>
						<div class="social-source float-right"><i class="social-icon youtube"></i></div>
					</div>
				</a>	
			</div>
		</div>
	</div>
	<div class="grid-item-social col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<div class="social-post">
			<div class="card">
				<div class="card-image">
					<div class="image-container">
						<img src="https://pbs.twimg.com/card_img/1118953968925847553/WySJcv4d?format=jpg&name=600x314" name="image" alt="" title="" />
						<!-- <span style="background-image:url('https://pbs.twimg.com/card_img/1118953968925847553/WySJcv4d?format=jpg&name=600x314');"></span> -->
					</div>
				</div>
				<a href="https://twitter.com/user/status/1119244471940648970" target="_blank">
					<div class="card-content">
						<div class="author">
							<div class="author-image"><img src="https://pbs.twimg.com/profile_images/1105087235869892609/XePDW768_400x400.jpg" name="" alt="" title=""></div>
							<div class="author-name float-left">
								<div class="author-complete-name">FC Barcelona</div>
								<div class="author-username">@FCBarcelona_es</div>
							</div>
						</div>
						<p class="text"> Hoy hace 100 años de un <span>@RealSociedad</span> - <span>#Barça</span> que guarda una historia curiosa... 😜</p>
					</div>
					<div class="card-footer">
						<div class="social-datetime float-left">9:15 AM - 20 Mar 2019</div>
						<div class="social-source float-right"><i class="social-icon youtube"></i></div>
					</div>
				</a>	
			</div>
		</div>
	</div>
	<div class="grid-item-social col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<div class="social-post">
			<div class="card">
				<div class="card-image">
					<div class="image-container">
						<img src="https://pbs.twimg.com/card_img/1118953968925847553/WySJcv4d?format=jpg&name=600x314" name="image" alt="" title="" />
						<!-- <span style="background-image:url('https://pbs.twimg.com/card_img/1118953968925847553/WySJcv4d?format=jpg&name=600x314');"></span> -->
					</div>
				</div>
				<a href="https://twitter.com/user/status/1119244471940648970" target="_blank">
					<div class="card-content">
						<div class="author">
							<div class="author-image"><img src="https://pbs.twimg.com/profile_images/1105087235869892609/XePDW768_400x400.jpg" name="" alt="" title=""></div>
							<div class="author-name float-left">
								<div class="author-complete-name">FC Barcelona</div>
								<div class="author-username">@FCBarcelona_es</div>
							</div>
						</div>
						<p class="text"> Hoy hace 100 años de un <span>@RealSociedad</span> - <span>#Barça</span> que guarda una historia curiosa... 😜</p>
					</div>
					<div class="card-footer">
						<div class="social-datetime float-left">9:15 AM - 20 Mar 2019</div>
						<div class="social-source float-right"><i class="social-icon youtube"></i></div>
					</div>
				</a>	
			</div>
		</div>
	</div>
	<div class="grid-item-social col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<div class="social-post">
			<div class="card">
				<div class="card-image">
					<div class="image-container">
						<img src="https://pbs.twimg.com/card_img/1118953968925847553/WySJcv4d?format=jpg&name=600x314" name="image" alt="" title="" />
						<!-- <span style="background-image:url('https://pbs.twimg.com/card_img/1118953968925847553/WySJcv4d?format=jpg&name=600x314');"></span> -->
					</div>
				</div>
				<a href="https://twitter.com/user/status/1119244471940648970" target="_blank">
					<div class="card-content">
						<div class="author">
							<div class="author-image"><img src="https://pbs.twimg.com/profile_images/1105087235869892609/XePDW768_400x400.jpg" name="" alt="" title=""></div>
							<div class="author-name float-left">
								<div class="author-complete-name">FC Barcelona</div>
								<div class="author-username">@FCBarcelona_es</div>
							</div>
						</div>
						<p class="text"> Hoy hace 100 años de un <span>@RealSociedad</span> - <span>#Barça</span> que guarda una historia curiosa... 😜</p>
					</div>
					<div class="card-footer">
						<div class="social-datetime float-left">9:15 AM - 20 Mar 2019</div>
						<div class="social-source float-right"><i class="social-icon youtube"></i></div>
					</div>
				</a>	
			</div>
		</div>
	</div>
</div>
*/?>