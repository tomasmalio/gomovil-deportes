<?php
	/**
	 * Widget class
	 */
	class Widgets {
		public function renderPhpFile($filename, $vars = null) {
			if (is_array($vars) && !empty($vars)) {
				extract($vars);
			}
			ob_start();
			include $filename;
			return ob_get_clean();
		}
		
	}
?>