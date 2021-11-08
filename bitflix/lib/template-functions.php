<?php

function renderTemplate(string $path, array $templateData = []): string
{
	if (!file_exists($path))
	{
		return "";
	}
	ob_start();
	extract($templateData, EXTR_OVERWRITE);
	include $path;
	return ob_get_clean();
}

function renderLayout(string $content, array $templateData = []): void
{
	$data = array_merge($templateData, [
		'content' => $content,
	]);
	$result = renderTemplate("./res/pages/layout.php", $data);
	echo $result;
}