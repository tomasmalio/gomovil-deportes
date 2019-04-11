<?php
	/**
	 * VideosList
	 */
	class VideosList extends Widgets {
		
		public function renderView () {
			return Widgets::renderViewHtml(get_class($this), [
					
				]
			);
		}
	}
?>