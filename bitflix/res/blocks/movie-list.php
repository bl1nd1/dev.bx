<?php
/** @var array $movies */
/** @var array $genres */

foreach ($movies as  $id => $movie): ?>
	<div class="movie-list-item">
		<div class="movie-list-item--overlay">
			<a href="bitflix-detailed-film.php?id=<?= $id ?>" class="movie-list-item--overlay-button">Подробнее</a>
		</div>
		<div class="movie-list-item--image" style="background-image: url(./res/img/<?= $id ?>.jpg)"></div>
		<div class="movie-list-item--head">
			<div class="movie-list-item--title"><?= mb_strimwidth($movie['TITLE'], 0, 19, "...") . ' (' . $movie['RELEASE_DATE'] . ')' ?></div>
			<div class="movie-list-item--subtitle"><?= $movie['ORIGINAL_TITLE'] ?></div>
		</div>
		<div class="movie-list-item--description"><?= $movie['DESCRIPTION']; ?></div>
		<div class="movie-list-item--bottom">
			<div class="movie-list-item--time">
				<div class="movie-list-item--time-icon" style=""></div>
				<?= formatDuration($movie['DURATION']) ?>
			</div>
			<div class="movie-list-item--genres">
				<?= $movie['GENRES'] ?>
			</div>
		</div>
	</div>
<?php
endforeach; ?>