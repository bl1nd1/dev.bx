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
$result = renderTemplate('./res/pages/addMovie.php');

renderLayout($result, [
	'currentMenuItem' => $currentMenuItem,
	'config' => $config,
]);