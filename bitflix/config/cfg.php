<?php
/** @var array $menu */
require_once './data/menu.php';

$config = [
	'title' => 'Bitflix',
	'menu' => $menu,
	'search-items' => ['title', 'original-title', 'description', 'genres', 'director'],
];