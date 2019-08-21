<!-- Featured Content -->
<section class="newssportsgomovil featured">
	<div class="newssportsgomovil-content">
		<a href="/<?= (isset($content['titles']['news'][COUNTRY_CODE])) ? strtolower($content['titles']['news'][COUNTRY_CODE]) : strtolower($content['titles']['news']['default']) . '/'. (isset($content['titles']['news'][COUNTRY_CODE])) ? strtolower($content['titles']['article'][COUNTRY_CODE]) : strtolower($content['titles']['article']['default']) .'/'.$news['id'] .'/'. Widgets::normalizeString($news['title']);?>" title="<?=$news['title']?>">
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