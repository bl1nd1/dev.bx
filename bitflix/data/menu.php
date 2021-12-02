<?php
/** @var array $genres */

$menu = [
	[
		'name' => 'main',
		'title' => 'Главная',
	],
];

foreach ($genres as $genre)
{
	array_push($menu, [
		'name' => $genre['CODE'],
		'title' => $genre['NAME'],
	]);
}

array_push($menu, [
	'name' => 'favorite',
	'title' => 'Избранное',
]);
