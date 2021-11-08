<?php
/** @var string $config */
/** @var string $content */
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?= $config['title'] ?></title>
	<link rel="stylesheet" href="./res/css/reset.css">
	<link rel="stylesheet" href="./res/css/style.css">
</head>
<body>

<div class="wrapper">
	<?php include "./res/blocks/sidebar.php"; ?>

	<div class = "content">
		<?php include "./res/blocks/searchbar.php";?>
		<?= $content ?>
	</div>
</div>


</body>
</html>
