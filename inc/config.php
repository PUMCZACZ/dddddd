<?php

if (stristr(htmlentities($_SERVER['PHP_SELF']), "config.php"))
{
	header("Location: index.php");
	die();
}

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'tirjobs2');
define('DB_PORT', 0);

define('DB_PREFIX', 'jmlnet');

define('ADMIN_FILE', 'admin-panel');

?>
