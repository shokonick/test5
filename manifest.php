<?php require "options.inc.php"; ?>
{
	"dir": "ltr",
	"lang": "fr-FR",
	"name": "Générateur de code QR",
	"short_name": "Code QR",
	"description": "Générez un code QR rapidement",
	"start_url": "<?php echo $cheminInstall; ?>",
	"scope": "<?php echo $cheminInstall; ?>"
	"display": "standalone",
	"theme_color": "<?php echo $couleurPrincipale; ?>",
	"background_color": "<?php echo $couleurPrincipale; ?>",
  "orientation": "portrait",
	"icons":
	[
		{
			"src": "favicons/<?php echo $theme; ?>-16.png",
			"sizes": "16x16",
			"type": "image/png"
		},
		{
			"src": "favicons/<?php echo $theme; ?>-32.png",
			"sizes": "32x32",
			"type": "image/png"
		},
		{
			"src": "favicons/<?php echo $theme; ?>-48.png",
			"sizes": "48x48",
			"type": "image/png"
		},
		{
			"src": "favicons/<?php echo $theme; ?>-64.png",
			"sizes": "64x64",
			"type": "image/png"
		},
		{
			"src": "favicons/<?php echo $theme; ?>-96.png",
			"sizes": "96x96",
			"type": "image/png"
		},
		{
			"src": "favicons/<?php echo $theme; ?>-128.png",
			"sizes": "128x128",
			"type": "image/png"
		},
		{
			"src": "favicons/<?php echo $theme; ?>-192.png",
			"sizes": "192x192",
			"type": "image/png"
		},
		{
			"src": "favicons/<?php echo $theme; ?>-256.png",
			"sizes": "256x256",
			"type": "image/png"
		},
		{
			"src": "favicons/<?php echo $theme; ?>-384.png",
			"sizes": "384x384",
			"type": "image/png"
		},
		{
			"src": "favicons/<?php echo $theme; ?>-512.png",
			"sizes": "512x512",
			"type": "image/png"
		}
	]
}
