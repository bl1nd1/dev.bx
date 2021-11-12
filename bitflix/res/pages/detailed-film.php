<?php
/** @var array $movie */

?>

<div class="film-content">
	<div class="detailed-movie-item">
		<div class="detailed-movie-item--head">
			<input type="submit" value="" class="check-favorite<?= ($movie['favorite']) ? ' active' : '' ?>">
			<div class="detailed-movie-item--head-title">
				<?= $movie['title'] . " (" . $movie['release-date'] . ")" ?>
			</div>
			<div class="detailed-movie-item--head-subtitle">
				<div class="detailed-movie-item--head-subtitle-original-title"><?= $movie['original-title'] ?></div>
				<div class="detailed-movie-item--head-subtitle-age-restriction">
					<div class="age-restriction">
						<?= $movie['age-restriction'] . "+" ?>
					</div>
				</div>
			</div>
		</div>

		<div class="detailed-movie-item--body">
			<div class="detailed-movie-item--body-image"
				 style="background: url('./res/img/<?= $movie['id'] ?>.jpg') center no-repeat;background-size: cover;">
			</div>
			<div class="detailed-movie-item--body-info">
				<?php
				include "./res/blocks/printRating.php" ?>
				<?php
				include "./res/blocks/printInfo.php" ?>
			</div>
		</div>
	</div>
</div>