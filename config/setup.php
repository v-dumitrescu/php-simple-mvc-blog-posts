<?php

use app\helpers\Url;

$dotenv = Dotenv\Dotenv::createImmutable(Url::rootDir());
$dotenv->load();

define('DB_HOST', $_ENV['DB_HOST']);
define('DB_USERNAME', $_ENV['DB_USERNAME']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('DB_NAME', $_ENV['DB_NAME']);
define('IMAGES_UPLOAD_DIRECTORY_PATH', '/home/vali/uploads/');
