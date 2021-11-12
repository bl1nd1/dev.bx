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

function filterMoviesByGenre(array $movies, string $genre = ""): array
{
	if ($genre === "")
	{
		return $movies;
	}
	$filteredMoviesByGenre = [];
	foreach ($movies as $movie)
	{
		if (isset($genre) && in_array($genre, $movie['genres'], true))
		{
			$filteredMoviesByGenre[] = $movie;
		}
	}
	return $filteredMoviesByGenre;
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

function filterMoviesByUserRequest(array $movies, string $request): array
{
	if ($request === "")
	{
		return $movies;
	}
	$filteredMovies = [];
	$request = mb_strtolower($request);
	foreach ($movies as $movie)
	{
		if (stristr(mb_strtolower($movie['title'] . $movie['original-title']), $request))
		{
			$filteredMovies[] = $movie;
		}
	}
	return $filteredMovies;
}

function printGenres(array $movieGenres):string
{
	$genres = '';
	foreach ($movieGenres as $genre):
		$genres .= $genre . ', ';
	endforeach;
	return substr($genres, 0, -2);
}