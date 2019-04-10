<?php
	/**
	 * Widget class
	 */
	class Widgets {
		
		/**
		 * Render View HTML
		 * @class String
		 * @array array
		 */
		public function renderViewHtml ($class, $array) {
			return $this->renderPhpFile(lcfirst($class) .'/views/view' . $class . '.php', $array);
		}

		/**
		 * Render PHP file
		 * @filename String
		 * @vars array
		 */
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