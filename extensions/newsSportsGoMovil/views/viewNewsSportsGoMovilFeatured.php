<!-- Featured Content -->
<section class="newssportsgomovil featured">
	<div class="newssportsgomovil-content">
		<a href="/<?= strtolower($content['news'][COUNTRY_CODE]) . '/'. strtolower($content['article'][COUNTRY_CODE]) .'/'.$content['content']['nota_id'] .'/'. Widgets::normalizeString($content['content']['titulo']);?>" title="<?=$content['content']['titulo']?>">
			<div class="content" style="background-image: url('<?=$content['content']['imagen']?>');">
				<h3>
					<span><?=$content['label']?></span>
				</h3>
				<h2><?=$content['content']['titulo']?></h2>
			</div>
		</a>
	</div>
</section>
<!-- Eof Featured Content -->