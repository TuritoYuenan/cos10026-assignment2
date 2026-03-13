<?php
	// MySQL settings
	define('Hostname', getenv('DB_HOSTNAME') ?: 'localhost');
	define('Username', getenv('DB_USERNAME') ?: 'root');
	define('Password', getenv('DB_PASSWORD') ?: '');
	define('Database', getenv('DB_DATABASE') ?: 'mysql');
?>
