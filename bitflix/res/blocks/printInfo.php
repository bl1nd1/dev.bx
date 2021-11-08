<?php
/** @var array $movie */
?>

<h1 class="detailed-movie-item--body-info-about-film">О фильме</h1>
<div class="detailed-movie-item--body-info-about-film-more">
	<div class="detailed-movie-item--body-info-about-film-title">Год производства:</div>
	<div class="detailed-movie-item--body-info-about-film-text"><?= $movie['release-date'] ?></div>
</div>
<div class="detailed-movie-item--body-info-about-film-more">
	<div class="detailed-movie-item--body-info-about-film-title">Режиссер:</div>
	<div class="detailed-movie-item--body-info-about-film-text"><?= $movie['director'] ?></div>
</div>
<div class="detailed-movie-item--body-info-about-film-more">
	<div class="detailed-movie-item--body-info-about-film-title">В главных ролях:</div>
	<div class="detailed-movie-item--body-info-about-film-text"><?= implode(', ', $movie['cast']) ?></div>
</div>
<h1 class="detailed-movie-item--body-info-about-film">Описание</h1>
<div class="detailed-movie-item--body-info-about-film-description">
	<?= $movie['description'] ?>
</div>