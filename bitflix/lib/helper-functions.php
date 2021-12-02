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

function genresIDToGenresName(array $genresID, array $genres): string
{
	$genresName = '';
	foreach ($genresID as $genreID)
	{
		$genresName .= $genres[$genreID]['NAME'] . ', ';
	}
	return substr($genresName, 0, -2);
}

function actorIDToActorName(array $actorsID, array $actors): string
{
	$actorsName = '';
	foreach ($actorsID as $actorID)
	{
		$actorsName .= $actors[$actorID] . ', ';
	}
	return substr($actorsName, 0, -2);
}