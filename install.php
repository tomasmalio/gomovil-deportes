<?php
	echo 'Installing software\n';
	echo 'Downloading composer\n';
	shell_exec('php -r "copy(\'https://getcomposer.org/installer\', \'composer-setup.php\');"');
	shell_exec('php -r "copy(\'https://getcomposer.org/installer\', \'composer-setup.php\');"');
	shell_exec('php -r "if (hash_file(\'sha384\', \'composer-setup.php\') === \'48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5\') { echo \'Installer verified\'; } else { echo \'Installer corrupt\'; unlink(\'composer-setup.php\'); } echo PHP_EOL;"');
	shell_exec('php composer-setup.php');
	shell_exec('php -r "unlink(\'composer-setup.php\');"');
	echo 'Installing PHP Composer...\n';
	shell_exec('php composer install');
	echo 'Installation ended successfully\n';
?>