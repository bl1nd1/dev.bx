<?php

function formatDuration(int $duration): string
{
	return $duration . ' мин. / ' . ((string)(int)($duration / 60)) . ':' . (str_pad(
			(string)$duration % 60,
			2,
			"0",
			STR_PAD_LEFT
		));
}

function formatRating(float $rating): string
{
	return str_pad((string)$rating, 3, ".0");
}

function sortMoviesByGenre(array $movies, string $genre = ""): array
{
	if ($genre === "")
	{
		return $movies;
	}
	$sortedMoviesByGenre = [];
	foreach ($movies as $movie)
	{
		if (isset($genre) && in_array($genre, $movie['genres'], true))
		{
			$sortedMoviesByGenre[] = $movie;
		}
	}
	return $sortedMoviesByGenre;
}

function findMovieByID(array $movies, int $id)
{
	foreach ($movies as $movie)
	{
		if ($movie['id'] === $id)
		{
			return $movie;
		}
	}
	return false;
}

function contains(string $str, string $substr): bool
{
	return (stristr($str, $substr));
}

function sortMoviesByUserRequest(array $movies, string $request): array
{
	if ($request === "")
	{
		return $movies;
	}
	$sortedMovies = [];
	$request = mb_strtolower($request);
	foreach ($movies as $movie)
	{
		if (contains(mb_strtolower($movie['title'] . $movie['original-title']), $request))
		{
			$sortedMovies[] = $movie;
		}
	}
	return $sortedMovies;
}

function printGenres(array $movieGenres):string
{
	$genres = '';
	foreach ($movieGenres as $genre):
		$genres .= $genre . ', ';
	endforeach;
	return substr($genres, 0, -2);
}
