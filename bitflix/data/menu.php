<?php
/** @var array $genres */
require_once './data/movies.php';

$menu = [
	[
		'name' => 'main',
		'title' => 'Главная',
	],
];

foreach ($genres as $genre => $genreTitle):
	array_push($menu, [
		'name' => $genre,
		'title' => $genreTitle,
	]);
endforeach;

array_push($menu, [
	'name' => 'favorite',
	'title' => 'Избранное',
]);
