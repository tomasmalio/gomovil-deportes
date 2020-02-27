<?php
	$news = $content['content'];
	
	foreach ($news['articles'] as $article) {
		echo $article['title'];
		echo $article['description'];
		echo '<img src="'.$article['urlToImage'].'" title="">';
	}

?>