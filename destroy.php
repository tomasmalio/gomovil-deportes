<?php
    session_start();
    session_destroy();
    session_unset();
	unset($_SESSION);
	echo "Destroy at ". date('Y-m-d H:i:s');
?>