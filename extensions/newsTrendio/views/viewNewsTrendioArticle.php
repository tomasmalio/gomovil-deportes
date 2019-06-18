<?php print_r($content)?>
<?php $article = $content['data'][0]?>
<section class="newstrendio">
	<h2><?=$article['title']?></h2>
	<div class="newstrendio-content">
		<p><?=$article['summary']?></p>
	</div>
</section>