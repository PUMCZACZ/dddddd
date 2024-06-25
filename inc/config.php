<?php

if (stristr(htmlentities($_SERVER['PHP_SELF']), "config.php"))
{
	header("Location: index.php");
	die();
}

define('DB_HOST', 'localhost');
define('DB_USER', 'host720720_medtalento');
define('DB_PASS', 'BugcERMQfDzVM4ZG');
define('DB_NAME', 'host720720_medtalento');
define('DB_PORT', 0);

define('DB_PREFIX', 'jmlnet');

define('ADMIN_FILE', 'admin-panel');

?>
