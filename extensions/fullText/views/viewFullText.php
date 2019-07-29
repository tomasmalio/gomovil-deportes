<section class="fulltext">
	<div class="container-fluid">
		<?php if (isset($content['title']) && $content['title'] <> ''){?>
		<div class="row">
			<div class="col-12"><h1><?=$content['title']?></h1></div>
		</div>
		<?php }?>
		<?php 
			$contentText = $content['text'];
			// Validata for content getting content
			if (count($contentText) > 0){
				foreach ($contentText as $text) {
		?>
		<div class="row">
			<div class="col-12"><h2><?=$text['title']?></h2></div>
			<div class="col-12"><p><?=$text['text']?></p></div>
		</div>
		<?php
				}
			}
		?>
	</div>
</section>