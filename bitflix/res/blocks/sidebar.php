<?php
/** @var string $currentMenuItem */
/** @var string $content */
/** @var array $config */
?>
<?php
?>
<div class = "sidebar">
	<div class = "sidebar-header">
		<?= $config['title'] ?>
	</div>
	<ul class = "menu">
		<?php foreach ($config['menu'] as $menuItem):?>
			<li class = "menu-item <?=
			($currentMenuItem === $menuItem['name']) ? "menu-item--active" : "" ?>">
				<a href="bitflix.php?menuItem=<?= $menuItem['name']?>">
					<?= $menuItem['title'] ?>
				</a>
			</li>
		<?php endforeach;?>
	</ul>
</div>