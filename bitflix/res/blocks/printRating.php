<?php
/** @var array $movie */

?>

<div class="detailed-movie-item--body-info-rating">
	<?php
	for ($i = 0; $i < round($movie['rating']); $i++): ?>
		<div class="info-rating-rectangle-active"></div>
	<?php
	endfor; ?>
	<?php
	for ($i = 0; $i < 11 - round($movie['rating']); $i++): ?>
		<div class="info-rating-rectangle"></div>
	<?php
	endfor; ?>
	<div class="info-rating-circle">
		<div class="circle-number">
			<?= formatRating($movie['rating']) ?>
		</div>
	</div>
</div>