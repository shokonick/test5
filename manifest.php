<?php require "options.inc.php"; ?>
{
	"dir": "ltr",
	"lang": "fr-FR",
	"name": "Générateur de code QR",
	"short_name": "Code QR",
	"description": "Générez un code QR rapidement",
	"start_url": "<?php echo $cheminInstall; ?>",
	"scope": "<?php echo $cheminInstall; ?>",
	"display": "standalone",
	"theme_color": "<?php echo $variablesTheme["fond"]; ?>",
	"background_color": "<?php echo $variablesTheme["fond"]; ?>",
  "orientation": "portrait",
	"icons":
	[
<?php
		for ($i = 0; $i < (count($themeDimensionsFavicons) - 1); $i++) { ?>
			{
				"src": "themes/<?php echo $theme; ?>/favicons/<?php echo $themeDimensionsFavicons[$i]; ?>.png",
				"sizes": "<?php echo $themeDimensionsFavicons[$i]; ?>x<?php echo $themeDimensionsFavicons[$i]; ?>",
				"type": "image/png"
			},

			<?php

		}
		?>
		{
			"src": "themes/<?php echo $theme; ?>/favicons/<?php echo $themeDimensionsFavicons[$i]; ?>.png",
			"sizes": "<?php echo $themeDimensionsFavicons[$i]; ?>x<?php echo $themeDimensionsFavicons[$i]; ?>",
			"type": "image/png"
		}
	]
}
