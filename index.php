<?php // This file is part of LibreQR, which is distributed under the GNU AGPLv3+ license

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelMedium;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelQuartile;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Color\Color;

require "config.inc.php";
require "vendor/autoload.php";

define("LIBREQR_VERSION", "2.0.0dev");

// Defines the locale to be used
$locale = DEFAULT_LOCALE;
if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
	$clientLocales = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$clientLocales = preg_replace("#[A-Z0-9]|q=|;|-|\.#", "", $clientLocales);
	$clientLocales = explode(',', $clientLocales);
	foreach (array_diff(scandir("locales"), array('..', '.')) as $key => $localeFile)
		$availableLocales[$key] = basename($localeFile, ".php");
	foreach ($clientLocales as $clientLocale) {
		if (in_array($clientLocale, $availableLocales)) {
			$locale = $clientLocale;
			break;
		}
	}
}
require "locales/" . $locale . ".php";

$params = array(
	"txt" => "",
	"redundancy" => DEFAULT_REDUNDANCY,
	"margin" => DEFAULT_MARGIN,
	"size" => DEFAULT_SIZE,
	"bgColor" => DEFAULT_BGCOLOR,
	"fgColor" => DEFAULT_FGCOLOR,
);

$validFormSubmitted = false;

if (
	isset($_POST['txt'])
	AND isset($_POST['redundancy'])
	AND isset($_POST['margin'])
	AND isset($_POST['size'])
	AND isset($_POST['bgColor'])
	AND isset($_POST['fgColor'])
) {

	if (strlen($_POST['txt']) >= 1 AND strlen($_POST['txt']) <= 4096) {
		$params['txt'] = $_POST['txt'];
	} else {
		http_response_code(400);
		exit("Wrong value for txt");
	}

	if ($_POST['redundancy'] === "low" OR $_POST['redundancy'] === "medium" OR $_POST['redundancy'] === "quartile" OR $_POST['redundancy'] === "high") {
		$params['redundancy'] = $_POST['redundancy'];
	} else {
		http_response_code(400);
		exit("Wrong value for redundancy");
	}

	if (is_numeric($_POST['margin']) AND $_POST['margin'] >= 0 AND $_POST['margin'] <= 1024) {
		$params['margin'] = $_POST['margin'];
	} else if (empty($_POST['margin'])) {
		$params['margin'] = NULL;
	} else {
		http_response_code(400);
		exit("Wrong value for margin");
	}

	if (is_numeric($_POST['size']) AND $_POST['size'] >= 1 AND $_POST['size'] <= 4096) {
		$params['size'] = $_POST['size'];
	} else if (empty($_POST['size'])) {
		$params['size'] = NULL;
	} else {
		http_response_code(400);
		exit("Wrong value for size");
	}

	if (preg_match("/^#[abcdefABCDEF0-9]{6}$/", $_POST['bgColor'])) {
		$params['bgColor'] = substr($_POST['bgColor'], -6);
	} else {
		http_response_code(400);
		exit("Wrong value for bgColor");
	}

	if (preg_match("/^#[abcdefABCDEF0-9]{6}$/", $_POST['fgColor'])) {
		$params['fgColor'] = substr($_POST['fgColor'], -6);
	} else {
		http_response_code(400);
		exit("Wrong value for fgColor");
	}

	$validFormSubmitted = true;
}

?>
<!DOCTYPE html>
<html lang="<?= $locale ?>">
	<head>
		<meta charset="utf-8">
		<title>LibreQR · <?= $loc['subtitle'] ?></title>
		<meta name="description" content="<?= $loc['description'] ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="color-scheme" content="dark light">
		<meta name="application-name" content="LibreQR">
		<meta name="referrer" content="no-referrer">
		<meta http-equiv="Content-Security-Policy" content="default-src 'none'; img-src 'self' data:; style-src 'self'; form-action 'self';">
<?php
require "themes/" . THEME . "/theme.php";
$colorScheme['theme'] = THEME;

$options = array('cache_dir' => 'css/', 'compress' => true);
$cssFileName = Less_Cache::Get(array("style.less" => ""), $options, $colorScheme);
?>
		<link rel="stylesheet" media="screen" href="css/<?= $cssFileName ?>">
<?php
foreach($themeDimensionsIcons as $dimFav) // Set all icons dimensions
	echo '		<link rel="icon" type="image/png" href="themes/' . THEME . '/icons/' . $dimFav . '.png" sizes="' . $dimFav . 'x' . $dimFav . '">' . "\n";
?>
	</head>

	<body>

		<header>
			<a id="linkTitles" href="./">
				<div id="titles">
					<h1>LibreQR</h1>
					<h2><?= $loc['subtitle'] ?></h2>
				</div>
			</a>
		</header>

		<form method="post" action="./#output">

			<div class="param" id="txtParam">
				<details>
					<summary><label for="txt"><?= $loc['label_content'] ?></label></summary>
					<div class="helpText">
						<?= $loc['help_content'] ?>
					</div>
				</details>
				<textarea rows="3" required="" id="txt" placeholder="<?= $loc['placeholder'] ?>" name="txt"><?= htmlspecialchars($params['txt']) ?></textarea>
			</div>

			<div id="sideParams">

				<div class="param">
					<details>
						<summary><label for="redundancy"><?= $loc['label_redundancy'] ?></label></summary>
						<p class="helpText">
							<?= $loc['help_redundancy'] ?>
						</p>
					</details>
					<select id="redundancy" name="redundancy">
						<option <?php if ($params['redundancy'] === "low") echo 'selected="" '; ?>value="low">L - 7%</option>
						<option <?php if ($params['redundancy'] === "medium") echo 'selected="" '; ?>value="medium">M - 15%</option>
						<option <?php if ($params['redundancy'] === "quartile") echo 'selected="" '; ?>value="quartile">Q - 25%</option>
						<option <?php if ($params['redundancy'] === "high") echo 'selected="" '; ?>value="high">H - 30%</option>
					</select>
				</div>

				<div class="param">
					<details>
						<summary><label for="margin"><?= $loc['label_margin'] ?></label></summary>
						<p class="helpText">
							<?= $loc['help_margin'] ?>
						</p>
					</details>
					<input type="number" id="margin" placeholder="<?= DEFAULT_MARGIN ?>" name="margin" required="" min="0" max="1024" value="<?= htmlspecialchars($params['margin']) ?>">
				</div>

				<div class="param">
					<details>
						<summary><label for="size"><?= $loc['label_size'] ?></label></summary>
						<p class="helpText">
							<?= $loc['help_size'] ?>
						</p>
					</details>
					<input type="number" id="size" placeholder="<?= DEFAULT_SIZE ?>" name="size" required="" min="1" max="4096" value="<?= htmlspecialchars($params['size']) ?>">
				</div>

			</div>

			<div id="colors">
				<div class="param">
					<label for="bgColor"><?= $loc['label_bgColor'] ?></label>
					<input type="color" name="bgColor" id="bgColor" value="#<?= htmlspecialchars($params['bgColor']) ?>">
				</div>
				<div class="param">
					<label for="fgColor"><?= $loc['label_fgColor'] ?></label>
					<input type="color" name="fgColor" id="fgColor" value="#<?= htmlspecialchars($params['fgColor']) ?>">
				</div>
			</div>

			<div class="centered">
				<input class="button" type="submit" value="<?= $loc['button_create'] ?>" />
			</div>

		</form>

<?php

if ($validFormSubmitted) {

	$rgbBgColor = array(
		'r' => hexdec(substr($params['bgColor'],0,2)),
		'g' => hexdec(substr($params['bgColor'],2,2)),
		'b' => hexdec(substr($params['bgColor'],4,2)),
	);

	$qrCode = Builder::create()
		->data($params['txt']);
	if (!is_null($params['margin']))
		$qrCode->margin($params['margin']);
	if (!is_null($params['size']))
		$qrCode->size($params['size']);

	if ($params['redundancy'] === "high")
		$qrCode->errorCorrectionLevel(new ErrorCorrectionLevelHigh());
	else if ($params['redundancy'] === "quartile")
		$qrCode->errorCorrectionLevel(new ErrorCorrectionLevelQuartile());
	else if ($params['redundancy'] === "medium")
		$qrCode->errorCorrectionLevel(new ErrorCorrectionLevelMedium());
	else if ($params['redundancy'] === "low")
		$qrCode->errorCorrectionLevel(new ErrorCorrectionLevelLow());

	$qrCode
		->backgroundColor(new Color(
			$rgbBgColor['r'],
			$rgbBgColor['g'],
			$rgbBgColor['b']
		))
		->foregroundColor(new Color(
			hexdec(substr($params['fgColor'],0,2)),
			hexdec(substr($params['fgColor'],2,2)),
			hexdec(substr($params['fgColor'],4,2))
		));

	$result = $qrCode->build();

	$dataUri = $result->getDataUri();

	$qrSize = $params['size'] + 2 * $params['margin'];

?>

			<section id="output">
				<div class="centered" id="downloadQR">
					<a href="<?= $dataUri ?>" class="button" download="<?= htmlspecialchars($params['txt']); ?>.png"><?= $loc['button_download'] ?></a>
				</div>

				<div class="centered" id="showOnlyQR">
					<a title="<?= $loc['title_showOnlyQR'] ?>" href="<?= $dataUri ?>"><img width="<?= $qrSize ?>" height="<?= $qrSize ?>" alt='<?= $loc['alt_QR_before'] ?><?= htmlspecialchars($params['txt']); ?><?= $loc['alt_QR_after'] ?>' id="qrCode"<?php

	// Compute the difference between the QR code and theme background colors
	$diffLight = abs($rgbBgColor['r']-hexdec(substr($colorScheme['bg-light'],-6,2))) + abs($rgbBgColor['g']-hexdec(substr($colorScheme['bg-light'],-4,2))) + abs($rgbBgColor['b']-hexdec(substr($colorScheme['bg-light'],-2,2)));
	$diffDark = abs($rgbBgColor['r']-hexdec(substr($colorScheme['bg-dark'],-6,2))) + abs($rgbBgColor['g']-hexdec(substr($colorScheme['bg-dark'],-4,2))) + abs($rgbBgColor['b']-hexdec(substr($colorScheme['bg-dark'],-2,2)));

	// Determine whether a CSS corner is needed to let the user see the margin of the QR code
	$contrastThreshold = 64;
	if ($diffLight < $contrastThreshold)
		echo " class='needLightContrast'";
	if ($diffDark < $contrastThreshold)
		echo " class='needDarkContrast'";
	?> src="<?= $dataUri ?>"></a>
				</div>
			</section>

<?php } ?>

		<footer>

			<section id="info" class="metaText">
				<?= $loc['metaText_qr'] ?>
			</section>

<?php if (CUSTOM_TEXT_ENABLED) { ?>
			<section class="metaText">
				<?= CUSTOM_TEXT ?>
			</section>
<?php } ?>

			<section class="metaText">
				<small><?= $loc['metaText_legal'] ?></small>
			</section>

		</footer>

	</body>
</html>
