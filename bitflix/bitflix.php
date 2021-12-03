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

$currentMenuItem = 'main';
if (isset($_GET['menuItem']))
{
	if (is_string($_GET['menuItem']))
	{
		$currentMenuItem = htmlspecialchars($_GET['menuItem']);
	}
}

$currentGenre = null;

foreach ($genres as $key => $genre)
{
	if ($genre['CODE'] === $currentMenuItem)
	{
		$currentGenre = $key;
		break;
	}
}

$movies = getMoviesByGenre($database, $genres, $currentGenre);

$request = '';
if (isset($_GET['request']))
{
	$request = $_GET['request'];
	$request = (is_string($request)) ? htmlspecialchars($request) : '';
}

$movies = getMoviesByUserRequest($movies, $request);

if (!empty($movies))
{
	$result = renderTemplate("./res/pages/main.php", [
		'movies' => $movies,
		'genres' => $genres
	]);
}
else
{
	$result = renderTemplate("./res/pages/movie404.php");
}

renderLayout($result, [
	'currentMenuItem' => $currentMenuItem,
	'config' => $config
]);