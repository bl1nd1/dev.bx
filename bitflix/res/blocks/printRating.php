<?php
/** @var array $movie */

?>

<div class="detailed-movie-item--body-info-rating">
	<?php
	for ($i = 0; $i < 10; $i++): ?>
		<div class="detailed-movie-item--body-info-rating-list-item<?= (round($movie['rating']) > $i)? '-active' : '' ?>"></div>
	<?php
	endfor; ?>
	<div class="detailed-movie-item--body-info-rating-circle"><?= formatRating($movie['rating']) ?>

	</div>
</div>