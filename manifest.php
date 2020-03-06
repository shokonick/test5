<?php require "config.inc.php"; ?>
{
	"dir": "ltr",
	"lang": "fr",
	"name": "LibreQR",
	"short_name": "LibreQR",
	"description": "Générer un code QR rapidement",
	"start_url": "<?php echo $instPath; ?>",
	"scope": "<?php echo $instPath; ?>",
	"display": "standalone",
	"theme_color": "<?php echo $variablesTheme["bg"]; ?>",
	"background_color": "<?php echo $variablesTheme["bg"]; ?>",
  "orientation": "portrait",
	"icons":
	[
<?php for ($i = 0; $i < (count($themeDimensionsIcons) - 1); $i++) { ?>
		{
			"src": "themes/<?php echo $theme; ?>/icons/<?php echo $themeDimensionsIcons[$i]; ?>.png",
			"sizes": "<?php echo $themeDimensionsIcons[$i]; ?>x<?php echo $themeDimensionsIcons[$i]; ?>",
			"type": "image/png"
		},
<?php } ?>
		{
			"src": "themes/<?php echo $theme; ?>/icons/<?php echo $themeDimensionsIcons[$i]; ?>.png",
			"sizes": "<?php echo $themeDimensionsIcons[$i]; ?>x<?php echo $themeDimensionsIcons[$i]; ?>",
			"type": "image/png"
		}
	]
}
