<?php require "options.inc.php"; ?>
{
	"dir": "ltr",
	"lang": "fr-FR",
	"name": "LibreQR",
	"short_name": "LibreQR",
	"description": "Générer un code QR rapidement",
	"start_url": "<?php echo $cheminInstall; ?>",
	"scope": "<?php echo $cheminInstall; ?>",
	"display": "standalone",
	"theme_color": "<?php echo $variablesTheme["bg"]; ?>",
	"background_color": "<?php echo $variablesTheme["bg"]; ?>",
  "orientation": "portrait",
	"icons":
	[
<?php for ($i = 0; $i < (count($themeDimensionsFavicons) - 1); $i++) { ?>
		{
			"src": "themes/<?php echo $theme; ?>/favicons/<?php echo $themeDimensionsFavicons[$i]; ?>.png",
			"sizes": "<?php echo $themeDimensionsFavicons[$i]; ?>x<?php echo $themeDimensionsFavicons[$i]; ?>",
			"type": "image/png"
		},
<?php } ?>
		{
			"src": "themes/<?php echo $theme; ?>/favicons/<?php echo $themeDimensionsFavicons[$i]; ?>.png",
			"sizes": "<?php echo $themeDimensionsFavicons[$i]; ?>x<?php echo $themeDimensionsFavicons[$i]; ?>",
			"type": "image/png"
		}
	]
}
