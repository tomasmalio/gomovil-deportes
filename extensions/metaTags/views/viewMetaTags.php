<?php if (isset($content['description'])) {?><meta name="description" content="<?= $content['description']?>" /><?php }?>
<?php if (isset($content['keywords'])) {?><meta name="keywords" content="<?= $content['keywords']?>" /><?php }?>
<?php if (isset($content['title']) && $content['title'] <> '') {?><meta itemprop="name" content="<?= $content['title']?>" /><?php }?>
<?php if (isset($content['description']) && $content['description'] <> '') {?><meta itemprop="description" content="<?= $content['description']?>" /><?php }?>
<?php if (isset($content['url']) && $content['url'] <> '') {?><meta itemprop="url" content="<?= $content['url']?>" /><?php }?>
<?php if (isset($content['image']) && $content['image'] <> '') {?><meta itemprop="image" content="<?= $content['image']?>" /><?php }?>
<?php if (isset($content['title']) && $content['title'] <> '') {?><meta name="schema:title" content="<?= $content['title']?>" /><?php }?>
<?php if (isset($content['description']) && $content['description'] <> '') {?><meta name="schema:description" content="<?= $content['description']?>" /><?php }?>
<?php if (isset($content['image']) && $content['image'] <> '') {?><meta name="schema:image" content="<?= $content['image']?>" /><?php }?>
<?php if (isset($content['title']) && $content['title'] <> '') {?><meta property="og:title" content="<?= $content['title']?>" /><?php }?>
<?php if (isset($content['description']) && $content['description'] <> '') {?><meta property="og:description" content="<?= $content['description']?>" /><?php }?>
<?php if (isset($content['type']) && $content['type'] <> '') {?><meta property="og:type" content="<?= $content['type']?>" /><?php }?>
<?php if (isset($content['image']) && $content['image'] <> '') {?><meta property="og:image" content="<?= $content['image']?>" /><?php }?>
<?php if (isset($content['title']) && $content['title'] <> '') {?><meta property="og:site_name" content="<?= $content['title']?>" /><?php }?>
<?php if (isset($content['facebookAppId']) && $content['facebookAppId'] <> '') {?><meta property="fb:app_id" content="<?= $content['facebookAppId']?>" /><?php }?>
<?php if (isset($content['card']) && $content['card'] <> '') {?><meta name="twitter:card" content="<?= $content['card']?>" /><?php }?>
<?php if (isset($content['title']) && $content['title'] <> '') {?><meta name="twitter:title" content="<?= $content['title']?>" /><?php }?>
<?php if (isset($content['description']) && $content['description'] <> '') {?><meta name="twitter:description" content="<?= $content['description']?>" /><?php }?>
<?php if (isset($content['url']) && $content['url'] <> '') {?><meta name="twitter:url" content="<?= $content['url']?>" /><?php }?>
<?php if (isset($content['twitterAccount']) && $content['twitterAccount'] <> '') {?>
<meta name="twitter:site" content="@<?= $content['twitterAccount']?>" />
<meta name="twitter:creator" content="@<?= $content['twitterAccount']?>" />
<?php }?>
<?php if (isset($content['image']) && $content['image'] <> '') {?><meta name="twitter:image" content="<?= $content['image']?>" /><?php }?>
<?php if (isset($content['twitterAccount']) && $content['twitterAccount'] <> '') {?><link itemprop="sameAs" id="sitelink-profile-twitter" href="https://www.twitter.com/<?= $content['twitterAccount']?>" /><?php }?>
<?php if (isset($content['facebookAccount']) && $content['facebookAccount'] <> '') {?><link itemprop="sameAs" id="sitelink-profile-facebook" href="https://www.facebook.com/<?= $content['facebookAccount']?>" /><?php }?>
<?php if (isset($content['url']) && $content['url'] <> '') {?><link rel="canonical" href="<?= $content['url']?>" /><?php }?>