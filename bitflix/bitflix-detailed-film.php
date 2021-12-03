<?php

declare(strict_types = 1);
/** @var array $genres */
/** @var array $menu */
/** @var array $movies */
/** @var array $config */
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
if (isset($_GET['id']) && is_string($_GET['id']))
{
	$id = (int)htmlspecialchars($_GET['id']);
	$currentMovie = getMovieByID($database, $id, $genres);
	if (!empty($currentMovie))
	{
		$currentPage = "./res/pages/detailed-film.php";
		$result = renderTemplate($currentPage, [
			'id' => $id,
			'movie' => $currentMovie,
			'genres' => $genres
		]);
	}
	else
	{
		$currentPage = "./res/pages/movie404.php";
		$result = renderTemplate($currentPage);
	}
}
else
{
	$currentPage = "./res/pages/movie404.php";
	$result = renderTemplate($currentPage);
}

renderLayout($result, [
	'config' => $config
]);