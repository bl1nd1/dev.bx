<?php

declare(strict_types=1);
/** @var array $genres */
/** @var array $movies */
/** @var array $config */
require_once './lib/helper-functions.php';
require_once "./config/cfg.php";
require_once "./data/movies.php";
require_once "./lib/template-functions.php";

$currentPage = "./res/pages/main.php";
$result = '';
$currentMenuItem = $_GET['menuItem'] ?? 'main';
$genre = array_key_exists($currentMenuItem, $genres) ? $genres[$currentMenuItem] : '';
$isFavorite = $_GET['favorite'];
$addMovie = isset($_GET['addMovie']);

$request = $_GET['request'] ?? "";

if (isset($_GET['id']))
{
	$id = (int)$_GET['id'];
	$currentMovie = findMoviesByID($movies, $id);

	if ($currentMovie)
	{
		$currentPage = "./res/pages/detailed-film.php";
			$result = renderTemplate($currentPage, [
				'movie' => $currentMovie,
				'$currentPage' => $currentPage
			]);
	}
	else
	{
		$currentPage = "./res/pages/movie404.php";
		$result = renderTemplate($currentPage);
	}
}
elseif ($currentMenuItem === $config['menu'][array_key_last($config['menu'])]['name'])
{
	$currentPage = "./res/pages/favorite.php";
	$result = renderTemplate($currentPage);
}
elseif ($addMovie)
{
	$currentPage = "./res/pages/addMovie.php";
	$result = renderTemplate($currentPage);
}
else
{
	$sortedMovie = sortMoviesByGenre($movies, $genre);
	$sortedMovie = sortMoviesByUserRequest($sortedMovie, $request);
	if (!empty($sortedMovie))
	{
		$currentPage = "./res/pages/main.php";
		$result = renderTemplate($currentPage, [
			'movies' => $sortedMovie,
		]);
	}
	else
	{
		$currentPage = "./res/pages/movie404.php";
		$result = renderTemplate($currentPage);
	}
}

renderLayout($result, [
	'currentMenuItem' => $currentMenuItem,
	'config' => $config
]);