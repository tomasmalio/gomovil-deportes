<div class="social-gifs">
	<?php
		$gifs = $content['content'];
		if ($gifs) {
	?>
	<?php if (isset($content['title'])){?><h3><?=$content['title']?></h3><?php }?>
	<button type="button" class="button small share-btn" style="display:block;width:150px;height:40px;" share-title="Te comparto" share-text="acaca" share-ul="https://localhost/">Share me!</button>
	<div class="row">
		<?php
				foreach ($gifs as $gif) {
		?>
		<div class="col-12">
			<div class="post-gif">
				<?php if (IS_MOBILE) {?>
					<?php /*<a href="whatsapp://send?text=Te invitó a descargar este GIF: <?=$gif['images']['downsized_large']['url']?>" data-action="share/whatsapp/share" target="_blank"><img src="<?=$gif['images']['downsized_large']['url'];?>" name="<?=$gif['slug']?>" width="<?=$gif['images']['downsized_large']['width'];?>" height="<?=$gif['images']['downsized_large']['height'];?>"></a>*/?>
					<img src="<?=$gif['images']['downsized_large']['url'];?>" name="<?=$gif['slug']?>" width="<?=$gif['images']['downsized_large']['width'];?>" height="<?=$gif['images']['downsized_large']['height'];?>">
				<?php } else {?>
					<img src="<?=$gif['images']['downsized_large']['url'];?>" name="<?=$gif['slug']?>" width="<?=$gif['images']['downsized_large']['width'];?>" height="<?=$gif['images']['downsized_large']['height'];?>">
				<?php }?>
			</div>
		</div>
		<?php 
				}
			}
		?>
	</div>
</div>

<script>
	const shareBtn = document.querySelector('.share-btn');
	console.log(self.getAttributeValue());
	shareBtn.addEventListener('click', () => {
		var share = {
			title: self.getAttributeValue( target, "share-title" ),
			text: self.getAttributeValue( target, "share-text" ),
			url: self.getAttributeValue( target, "share-url" )
		};

		navigator.share( share )
			.then( function () {
				console.log( 'Successful share' )
			} )
			.catch( function ( error ) {
				console.log( 'Error sharing', error )
			});
	});
// 	const shareBtn = document.querySelector('.share-btn');
// const ogBtnContent = shareBtn.textContent;
// const title = document.querySelector('h1').textContent;
// const url = document.querySelector('link[rel=canonical]') &&
//             document.querySelector('link[rel=canonical]').href ||
//             window.location.href;

// shareBtn.addEventListener('click', () => {
//   if (navigator.share) {
//     navigator.share({
//       title,
//       url
//     }).then(() => {
//       showMessage(shareBtn, 'Thanks! 😄');
//     })
//     .catch(err => {
//       showMessage(shareBtn, `Couldn't share 🙁`);
//     });
//   } else {
//     showMessage(shareBtn, 'Not supported 🙅‍');
//   }
// });

// function showMessage(element, msg) {
//   element.textContent = msg;
//   setTimeout(() => {
//     element.textContent = ogBtnContent;
//   }, 2000);
// }
	// const shareBtn = document.querySelector('.share-btn');
	// const ogBtnContent = shareBtn.textContent;
	// const title = document.querySelector('h1').textContent;
	// const url = document.querySelector('link[rel=canonical]') && document.querySelector('link[rel=canonical]').href || window.location.href;
	// shareBtn.addEventListener('click', () => {
	// 	if (navigator.share) {
	// 		navigator.share({
	// 			title, url
	// 		}).then(() => {
	// 			showMessage(shareBtn, 'Thanks! 😄');
	// 		}).catch(err => {
	// 			showMessage(shareBtn, `Couldn't share 🙁`);
	// 		});
	// 	} else {
	// 		showMessage(shareBtn, 'Not supported 🙅&zwj;');
	// 	}
	// });

	// function showMessage(element, msg) {
	// 	element.textContent = msg;
	// 	setTimeout(() => {
	// 		element.textContent = ogBtnContent;
	// 	}, 2000);
	// }
</script>