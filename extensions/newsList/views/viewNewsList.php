<!-- News -->
<section class="last-news">
	<ul class="list-news">
		<?php foreach ($newsList as $news) {?>
		<li>
			<a href="<?= $news['url']?>" title="<?= $news['title']?>">
				<div class="row">
					<div class="col-12">
						<div class="image float-left">
							<img src="https://s3.us-east-2.amazonaws.com/bitel/deportes/nota/jhon-viafara-deportivo-cali-festejo-gol-afp_1000x500.jpg" name="news" alt="" title="" />
						</div>
						<div class="news-content float-left">
							<time datetime="<?= $news['date']?>"><?= date('d \d\e F, Y', strtotime($news['date']))?></time>
							<h2><?= $news['title']?></h2>
							<h3><?= $news['description']?></h3>
						</div>
					</div>
				</div>
			</a>
		</li>
		<?php }?>
	</ul>
</section>
<!-- Eof News -->