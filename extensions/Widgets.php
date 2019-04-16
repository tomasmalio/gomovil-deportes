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
		public function renderViewHtml ($array) {
			return $this->renderPhpFile(lcfirst(get_class($this)) .'/views/view' . get_class($this) . '.php', $array);
		}

		/**
		 * Render PHP file
		 * @filename String
		 * @vars array
		 */
		public function renderPhpFile ($filename, $vars = null) {
			if (is_array($vars) && !empty($vars)) {
				extract($vars);
			}
			ob_start();
			include $filename;
			return ob_get_clean();
		}

		/**
		 * Compile LESS file
		 * @filename String
		 */
		public function compileAssets ($filename) {
			$less = new lessc;
			try {
				$directoryFrom 		= 'extensions/'.lcfirst(get_class($this)) . '/assets/less';
				$directoryTo 		= 'assets/' . strtolower(get_class($this)) . '/css';

				// Check if the directory with the name already exists
				if (!is_dir($directoryTo)) {
					//Create our directory if it does not exist
					mkdir($directoryTo, 0755, true);
				}
				// Compile the less but first verify if the css exist
				$less->checkedCompile($directoryFrom . '/'. $filename . '.less', $directoryTo .'/'. $filename . '.css');
				return $directoryTo . '/'. $filename . '.css';
			} catch (exception $e) {
				echo "Error message: " . $e->getMessage();
			}
		}
		
	}
?>