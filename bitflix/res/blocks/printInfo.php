<?php
/** @var array $movie */
?>

<h1 class="detailed-movie-item--body-info-about-film">О фильме</h1>
<div class="detailed-movie-item--body-info-about-film-more">
	<div class="detailed-movie-item--body-info-about-film-title">Год производства:</div>
	<div class="detailed-movie-item--body-info-about-film-text"><?= $movie['RELEASE_DATE'] ?></div>
</div>
<div class="detailed-movie-item--body-info-about-film-more">
	<div class="detailed-movie-item--body-info-about-film-title">Режиссер:</div>
	<div class="detailed-movie-item--body-info-about-film-text"><?= $movie['DIRECTOR'] ?></div>
</div>
<div class="detailed-movie-item--body-info-about-film-more">
	<div class="detailed-movie-item--body-info-about-film-title">В главных ролях:</div>
	<div class="detailed-movie-item--body-info-about-film-text"><?= $movie['CAST'] ?></div>
</div>
<h1 class="detailed-movie-item--body-info-about-film">Описание</h1>
<div class="detailed-movie-item--body-info-about-film-description">
	<?= $movie['DESCRIPTION'] ?>
</div>