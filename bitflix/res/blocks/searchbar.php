<?php

/** @var string $request */
?>


<div class="searchbar">
	<form action="bitflix.php" method="get" enctype="multipart/form-data" class="search-form">
		<div class="search-wrapper">
		<input placeholder="Поиск по категориям..." name="request" id="request" type="text" class="searchbar-item" value="<?= $request ?>">
			<div class="searchbar-item--icon"></div>
		</input>
		</div>
		<input type="submit" class="search-button" value="Искать">
	</form>
	<a href="bitflix.php?addMovie=true" class="add-button">Добавить фильм</a>
</div>