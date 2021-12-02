<?php

declare(strict_types = 1);
/** @var array $genres */
/** @var array $movies */
/** @var array $config */
/** @var array $menu */
require_once './lib/database-functions.php';
require_once './lib/helper-functions.php';
require_once "./config/cfg.php";
require_once "./lib/template-functions.php";

$database = connectDatabase(
	[
		$config['hostname'],
		$config['username'],
		$config['password'],
		$config['databaseName']
	]
);
$genres = getGenres($database);
require_once "./data/menu.php";
$config += ['menu' => $menu];

$result = renderTemplate('./res/pages/favorite.php');

renderLayout($result, [
	'config' => $config,
]);