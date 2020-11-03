<?php require "inc.php"; ?>
{
	"dir": "ltr",
	"lang": "<?= $locale ?>",
	"name": "LibreQR",
	"short_name": "LibreQR",
	"description": "<?= $loc['subtitle'] ?>",
	"start_url": "<?= $rootPath; ?>",
	"scope": "<?= $rootPath; ?>",
	"display": "standalone",
	"theme_color": "<?= $variablesTheme["bg"]; ?>",
	"background_color": "<?= $variablesTheme["bg"]; ?>",
	"orientation": "portrait",
	"icons":
	[
<?php for ($i = 0; $i < (count($themeDimensionsIcons) - 1); $i++) { ?>
		{
			"src": "themes/<?= $theme; ?>/icons/<?= $themeDimensionsIcons[$i]; ?>.png",
			"sizes": "<?= $themeDimensionsIcons[$i]; ?>x<?= $themeDimensionsIcons[$i]; ?>",
			"type": "image/png"
		},
<?php } ?>
		{
			"src": "themes/<?= $theme; ?>/icons/<?= $themeDimensionsIcons[$i]; ?>.png",
			"sizes": "<?= $themeDimensionsIcons[$i]; ?>x<?= $themeDimensionsIcons[$i]; ?>",
			"type": "image/png"
		}
	]
}
