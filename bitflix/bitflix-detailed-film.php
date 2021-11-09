<?php

declare(strict_types = 1);
/** @var array $genres */
/** @var array $movies */
/** @var array $config */
require_once './lib/helper-functions.php';
require_once "./config/cfg.php";
require_once "./data/movies.php";
require_once "./lib/template-functions.php";

$currentMenuItem = $_GET['menuItem'];

if (isset($_GET['id']))
{
	$id = (int)$_GET['id'];
	$currentMovie = findMovieByID($movies, $id);

	if ($currentMovie)
	{
		$currentPage = "./res/pages/detailed-film.php";
		$result = renderTemplate($currentPage, [
			'movie' => $currentMovie
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
	'config' => $config,
]);