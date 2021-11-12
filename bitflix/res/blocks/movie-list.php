<?php
/** @var array $content */
/** @var array $movies */
/** @var array $genres */

foreach ($movies as $movie): ?>
	<div class="movie-list-item">
		<div class="movie-list-item--overlay">
			<a href="bitflix-detailed-film.php?id=<?= $movie['id'] ?>" class="movie-list-item--overlay-button">Подробнее</a>
		</div>
		<div class="movie-list-item--image" style="background-image: url(./res/img/<?= $movie['id'] ?>.jpg)"></div>
		<div class="movie-list-item--head">
			<div class="movie-list-item--title"><?= mb_strimwidth($movie['title'], 0, 19, "...") . ' (' . $movie['release-date'] . ')' ?></div>
			<div class="movie-list-item--subtitle"><?= $movie['original-title'] ?></div>
		</div>
		<div class="movie-list-item--description"><?= $movie['description']; ?></div>
		<div class="movie-list-item--bottom">
			<div class="movie-list-item--time">
				<div class="movie-list-item--time-icon" style=""></div>
				<?= formatDuration($movie['duration']) ?>
			</div>
			<div class="movie-list-item--genres">
				<?php $genres = '';
				foreach ($movie['genres'] as $genre)
				{
					$genres .= $genre . ', ';
				}
				echo substr($genres, 0, -2);?>
			</div>
		</div>
	</div>
<?php
endforeach; ?>