<!-- Featured Content -->
<section class="newssportsgomovil featured">
	<div class="newssportsgomovil-content">
		<a href="/<?= strtolower($content['title']['news'][COUNTRY_CODE]) . '/'. strtolower($content['title']['article'][COUNTRY_CODE]) .'/'.$content['content']['id'] .'/'. Widgets::normalizeString($content['content']['title']);?>" title="<?=$content['content']['title']?>">
			<div class="content" style="background-image: url('<?=$content['content']['image']?>');">
				<h3>
					<span><?=$content['label']?></span>
				</h3>
				<h2><?=$content['content']['title']?></h2>
			</div>
		</a>
	</div>
</section>
<!-- Eof Featured Content -->