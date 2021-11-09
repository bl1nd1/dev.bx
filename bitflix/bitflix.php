<?php

declare(strict_types = 1);
/** @var array $genres */
/** @var array $movies */
/** @var array $config */
require_once './lib/helper-functions.php';
require_once "./config/cfg.php";
require_once "./data/movies.php";
require_once "./lib/template-functions.php";

$currentMenuItem = $_GET['menuItem'] ?? 'main';
$genre = array_key_exists($currentMenuItem, $genres) ? $genres[$currentMenuItem] : '';
$request = $_GET['request'] ?? "";

$filteredMovie = filterMoviesByGenre($movies, $genre);
$filteredMovie = filterMoviesByUserRequest($filteredMovie, $request);
if (!empty($filteredMovie))
{
	$result = renderTemplate("./res/pages/main.php", [
		'movies' => $filteredMovie,
	]);
}
else
{
	$result = renderTemplate("./res/pages/movie404.php");
}

renderLayout($result, [
	'currentMenuItem' => $currentMenuItem,
	'config' => $config,
]);