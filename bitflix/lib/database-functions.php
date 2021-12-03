<?php

function connectDatabase(array $databaseConfig) : mysqli
{
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$database = mysqli_init();
	mysqli_real_connect(
		$database,
		$databaseConfig['hostname'],
		$databaseConfig['username'],
		$databaseConfig['password'],
		$databaseConfig['databaseName']
	);
	mysqli_set_charset($database, 'utf8');
	return $database;
}

function getGenres(mysqli $database) : array
{
	$query = "SELECT * FROM bitflix.genre";
	$result = mysqli_query($database, $query);
	$genres = [];
	while ($row = mysqli_fetch_assoc($result))
	{
		$genres[$row['ID']] = [
			'CODE' => $row['CODE'],
			'NAME' => $row['NAME']
		];
	}
	return $genres;
}

function mainQuery(): string
{
	return "SELECT bitflix.movie.ID, TITLE, ORIGINAL_TITLE, DESCRIPTION, DURATION, AGE_RESTRICTION, RELEASE_DATE, RATING,
       (SELECT GROUP_CONCAT(GENRE_ID) FROM bitflix.movie_genre mg WHERE mg.MOVIE_ID = bitflix.movie.ID) as GENRES_ID,
       (SELECT GROUP_CONCAT(ACTOR_ID) FROM bitflix.movie_actor ma WHERE ma.MOVIE_ID = bitflix.movie.ID) as CAST,
       d.NAME FROM bitflix.movie
JOIN bitflix.director d on d.ID = movie.DIRECTOR_ID
";
}

function getMoviesByGenre(mysqli $database, $genres, $genreID = null): array
{
	$query = mainQuery();
	if ($genreID != null)
	{
		$query .= "JOIN bitflix.movie_genre mg on movie.ID = mg.MOVIE_ID
JOIN bitflix.genre g on mg.GENRE_ID = g.ID
WHERE g.ID = '$genreID'";
	}
	$result = mysqli_query($database, $query);
	$movies = [];

	while ($row = mysqli_fetch_assoc($result))
	{
		$movies[$row['ID']] = [
			'TITLE' => $row['TITLE'],
			'ORIGINAL_TITLE' => $row['ORIGINAL_TITLE'],
			'DESCRIPTION' => $row['DESCRIPTION'],
			'DURATION' => $row['DURATION'],
			'RELEASE_DATE' => $row['RELEASE_DATE'],
			'GENRES' => genresIDToGenresName(explode(",", $row['GENRES_ID']), $genres)
		];
	}
	return $movies;
}

function getMovieByID(mysqli $database, $id, $genres): array
{
	$query = mainQuery();
	$actors = getActors($database);
	$query .= "WHERE movie.ID = $id";
	$result = mysqli_query($database, $query);
	$row = mysqli_fetch_assoc($result);
	if (!empty($row))
	{
		$movie = [
			'TITLE' => $row['TITLE'],
			'ORIGINAL_TITLE' => $row['ORIGINAL_TITLE'],
			'DESCRIPTION' => $row['DESCRIPTION'],
			'DURATION' => $row['DURATION'],
			'RELEASE_DATE' => $row['RELEASE_DATE'],
			'GENRES' => genresIDToGenresName(explode(",", $row['GENRES_ID']), $genres),
			'CAST' => actorIDToActorName(explode(",", $row['CAST']), $actors),
			'DIRECTOR' => $row['NAME'],
			'RATING' => $row['RATING'],
			'AGE_RESTRICTION' => $row['AGE_RESTRICTION']
		];
	}
	else
	{
		$movie = [];
	}
	return $movie;
}

function getMoviesByUserRequest(array $movies, string $request): array
{
	if ($request === "")
	{
		return $movies;
	}
	$filteredMovies = [];
	$request = mb_strtolower($request);
	foreach ($movies as $id => $movie)
	{
		if (stristr(mb_strtolower($movie['TITLE'] . $movie['ORIGINAL_TITLE']), $request))
		{
			$filteredMovies[$id] = $movie;
		}
	}
	return $filteredMovies;
}

function getActors(mysqli $database): array
{
	$actorQuery = "SELECT * FROM bitflix.movie_actor ma JOIN bitflix.actor a on a.ID = ma.ACTOR_ID";
	$actorsResult = mysqli_query($database, $actorQuery);
	$actors = [];
	while ($row = mysqli_fetch_assoc($actorsResult))
		$actors += [$row['ACTOR_ID'] => $row['NAME']];
	return $actors;
}