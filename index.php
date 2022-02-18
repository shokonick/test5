<?php // This file is part of LibreQR, which is distributed under the GNU AGPLv3+ license

use CodeItNow\BarcodeBundle\Utils\QrCode;

require "inc.php";

$params = array(
  "txt" => "",
  "redundancy" => DEFAULT_REDUNDANCY,
  "margin" => DEFAULT_MARGIN,
  "size" => DEFAULT_SIZE,
  "bgColor" => DEFAULT_BGCOLOR,
  "mainColor" => DEFAULT_MAINCOLOR,
);

$validFormSubmitted = false;

if (
  isset($_POST['txt'])
  AND isset($_POST['redundancy'])
  AND isset($_POST['margin'])
  AND isset($_POST['size'])
  AND isset($_POST['bgColor'])
  AND isset($_POST['mainColor'])
) {

  if (strlen($_POST['txt']) >= 1 AND strlen($_POST['txt']) <= 4096)
    $params['txt'] = $_POST['txt'];
  else
    exit("Wrong value for txt");

  if ($_POST['redundancy'] === "low" OR $_POST['redundancy'] === "medium" OR $_POST['redundancy'] === "quartile" OR $_POST['redundancy'] === "high")
    $params['redundancy'] = $_POST['redundancy'];
  else
    exit("Wrong value for redundancy");

  if (is_numeric($_POST['margin']) AND $_POST['margin'] >= 0 AND $_POST['margin'] <= 1024)
    $params['margin'] = $_POST['margin'];
  else if (empty($_POST['margin']))
    $params['margin'] = NULL;
  else
    exit("Wrong value for margin");

  if (is_numeric($_POST['size']) AND $_POST['size'] >= 1 AND $_POST['size'] <= 4096)
    $params['size'] = $_POST['size'];
  else if (empty($_POST['size']))
    $params['size'] = NULL;
  else
    exit("Wrong value for size");

  if (preg_match("/^#[abcdefABCDEF0-9]{6}$/", $_POST['bgColor']))
    $params['bgColor'] = substr($_POST['bgColor'], -6);
  else
    exit("Wrong value for bgColor");

  if (preg_match("/^#[abcdefABCDEF0-9]{6}$/", $_POST['mainColor']))
    $params['mainColor'] = substr($_POST['mainColor'], -6);
  else
    exit("Wrong value for mainColor");

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
    <meta http-equiv="Content-Security-Policy" content="default-src 'none'; img-src 'self' data:; style-src 'self'; manifest-src 'self'; form-action 'self';">
    <link rel="manifest" href="manifest.php">
    <?php
    require_once "less.php/lib/Less/Autoloader.php";
    Less_Autoloader::register();

    $colorScheme['theme'] = $theme;

    $options = array('cache_dir' => 'css/', 'compress' => true);
    $cssFileName = Less_Cache::Get(array("style.less" => ""), $options, $colorScheme);
    ?>
    <link rel="stylesheet" media="screen" href="css/<?= $cssFileName ?>">
    <?php
    foreach($themeDimensionsIcons as $dimFav) { // Set all icons dimensions
        echo '    <link rel="icon" type="image/png" href="themes/' . $theme . '/icons/' . $dimFav . '.png" sizes="' . $dimFav . 'x' . $dimFav . '">' . "\n";
    }
    ?>
  </head>

  <body>

    <main>

      <header>
        <a id="linkTitles" href="./">
          <div id="titles">
            <h1>LibreQR</h1>
            <h2><?= $loc['subtitle'] ?></h2>
          </div>
        </a>
      </header>

      <form method="post" action="./#output">

        <div id="firstWrapper">

          <div class="param" id="txtParam">
            <details>
              <summary><label for="txt"><?= $loc['label_content'] ?></label></summary>
              <div class="helpText">
                <?= $loc['help_content'] ?>
              </div>
            </details>
            <textarea rows="8" required="" id="txt" placeholder="<?= $loc['placeholder'] ?>" name="txt"><?= htmlspecialchars($params['txt']) ?></textarea>
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
              <input type="number" list="margins" id="margin" placeholder="<?= $loc['placeholder_pixels'] ?>" name="margin" min="0" max="1024" value="<?= htmlspecialchars($params['margin']) ?>">
              <datalist id="margins">
                <option value="16">
                <option value="32">
                <option value="64">
                <option value="128">
              </datalist>
            </div>

            <div class="param">
              <details>
                <summary><label for="size"><?= $loc['label_size'] ?></label></summary>
                <p class="helpText">
                  <?= $loc['help_size'] ?>
                </p>
              </details>
              <input type="number" list="sizes" id="size" placeholder="<?= $loc['placeholder_pixels'] ?>" name="size" min="1" max="4096" value="<?= htmlspecialchars($params['size']) ?>">
              <datalist id="sizes">
                <option value="128">
                <option value="256">
                <option value="512">
                <option value="1024">
              </datalist>
            </div>

          </div>

        </div>

        <div id="colors">

          <div class="param">
            <label for="bgColor"><?= $loc['label_bgColor'] ?></label>
            <div class="inputColorContainer">
                        <input type="color" name="bgColor" id="bgColor" value="#<?= htmlspecialchars($params['bgColor']) ?>">
            </div>
          </div>

          <div class="param">
            <label for="mainColor"><?= $loc['label_mainColor'] ?></label>
            <div class="inputColorContainer">
              <input type="color" name="mainColor" id="mainColor" value="#<?= htmlspecialchars($params['mainColor']) ?>">
            </div>
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

        require "barcode-generator/Utils/QrCode.php";
        $qrCode = new QrCode();
        if (!is_null($params['margin']))
          $qrCode->setPadding($params['margin']);
        $qrCode
          ->setText($params['txt'])
          ->setSize($params['size'])
          ->setErrorCorrection($params['redundancy'])
          ->setForegroundColor(array(
            'r' => hexdec(substr($params['mainColor'],0,2)),
            'g' => hexdec(substr($params['mainColor'],2,2)),
            'b' => hexdec(substr($params['mainColor'],4,2)),
          ))
          ->setBackgroundColor($rgbBgColor)
          ->setImageType(QrCode::IMAGE_TYPE_PNG);
        $dataUri = $qrCode->getDataUri();
        $qrSize = $qrCode->getSize() + 2 * $qrCode->getPadding();

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

          <?php if ($customTextEnabled) { ?>
            <section class="metaText">
              <?= $customText ?>
            </section>
          <?php } ?>

          <section class="metaText">
            <?= $loc['metaText_legal'] ?>
          </section>

        </footer>

    </main>

  </body>
</html>
