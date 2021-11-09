<?php
/** @var array $movie */

?>

<div class="detailed-movie-item--body-info-rating">
	<?php
	for ($i = 0; $i < 10; $i++): ?>
		<div class="info-rating-rectangle<?= (round($movie['rating']) > $i)? '-active' : '' ?>"></div>
	<?php
	endfor; ?>
	<div class="info-rating-circle">
		<div class="circle-number">
			<?= formatRating($movie['rating']) ?>
		</div>
	</div>
</div>