<!-- Featured Content -->
<?php print_r($content)?>
<section class="newssportsgomovil featured">
	<div class="newssportsgomovil-content">
		<?php 
			$url = '';
			if (isset($content['titles']['news'][COUNTRY_CODE])) { 
				$url .= strtolower($content['titles']['news'][COUNTRY_CODE]); 
			} else { 
				$url .= strtolower($content['titles']['news']['default']);
			}
			$url .= '/';
			if (isset($content['titles']['news'][COUNTRY_CODE])) {
				$url .= strtolower($content['titles']['article'][COUNTRY_CODE]);
			} else {
				$url .= strtolower($content['titles']['article']['default']);
			}
			$url .= '/';
			$url .= $content['id'] .'/'. $this->normalizeString($content['title']);
		?>	
		<a href="<?=$url?>" title="<?=$news['title']?>">
			<div class="content" style="background-image: url('<?=$content['image']?>');">
				<h3>
					<span><?=$content['label']?></span>
				</h3>
				<h2><?=$content['title']?></h2>
			</div>
		</a>
	</div>
</section>
<!-- Eof Featured Content -->