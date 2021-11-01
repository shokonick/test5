<?php require "inc.php"; ?>
<!--
 _     _ _               ___  ____
| |   (_| |__  _ __ ___ / _ \|  _ \
| |   | | '_ \| '__/ _ | | | | |_) |
| |___| | |_) | | |  __| |_| |  _ <
|_____|_|_.__/|_|  \___|\__\_|_| \_\
A PHP Web interface for generating QR codes

Source code: https://code.antopie.org/miraty/libreqr

This file is part of LibreQR.

  LibreQR is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

  LibreQR is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.

  You should have received a copy of the GNU Affero General Public License along with this program. If not, see <https://www.gnu.org/licenses/>.

-->
<?php

$params = array(
  "txt" => "",
  "redondancy" => DEFAULT_REDONDANCY,
  "margin" => DEFAULT_MARGIN,
  "size" => DEFAULT_SIZE,
  "bgColor" => DEFAULT_BGCOLOR,
  "mainColor" => DEFAULT_MAINCOLOR,
);

if (
  isset($_POST['txt'])
  AND isset($_POST['redondancy'])
  AND isset($_POST['margin'])
  AND isset($_POST['size'])
  AND isset($_POST['bgColor'])
  AND isset($_POST['mainColor'])
) {

  if (strlen($_POST['txt']) >= 1 AND strlen($_POST['txt']) <= 4096)
    $params['txt'] = $_POST['txt'];
  else
    exit("Wrong value for txt");

  if ($_POST['redondancy'] === "low" OR $_POST['redondancy'] === "medium" OR $_POST['redondancy'] === "quartile" OR $_POST['redondancy'] === "high")
    $params['redondancy'] = $_POST['redondancy'];
  else
    exit("Wrong value for redondancy");

  if (is_numeric($_POST['margin']) AND $_POST['margin'] >= 0 AND $_POST['margin'] <= 1024)
    $params['margin'] = $_POST['margin'];
  else
    exit("Wrong value for margin");

  if (is_numeric($_POST['size']) AND $_POST['size'] >= 1 AND $_POST['size'] <= 1024)
    $params['size'] = $_POST['size'];
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

}

require "barcode-generator/Utils/QrCode.php";
use CodeItNow\BarcodeBundle\Utils\QrCode;

?>
<!DOCTYPE html>
<html lang="<?= $locale ?>">
  <head>
    <meta charset="UTF-8">
    <title>LibreQR · <?= $loc['subtitle'] ?></title>
    <meta name="description" content="<?= $loc['description'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="manifest.php">
    <link rel="search" type="application/opensearchdescription+xml" title="LibreQR" href="opensearch.php&#63;redondancy=<?= $params['redondancy'] ?>&amp;margin=<?= $params['margin'] ?>&amp;size=<?= $params['size'] ?>&amp;bgColor=<?= urlencode($params['bgColor']) ?>&amp;mainColor=<?= urlencode($params['mainColor']) ?>">
<?php
    // If style.min.css exists
    if (file_exists("temp/style.min.css"))
      // And if it's older than theme.php or config.inc.php (so not up to date)
      if (filemtime("themes/" . $theme . "/theme.php") > filemtime("temp/style.min.css") OR filemtime("config.inc.php") > filemtime("temp/style.min.css"))
        // Then delete it
        unlink("temp/style.min.css");

    require_once "less.php/lib/Less/Autoloader.php";
    Less_Autoloader::register();

    $options = array('cache_dir' => 'temp/', 'compress' => true);
    $cssFileName = Less_Cache::Get(array("style.less" => ""), $options, $colorScheme);

    ?>
    <link type="text/css" rel="stylesheet" href="temp/<?= $cssFileName ?>">
<?php
    foreach($themeDimensionsIcons as $dimFav) { // Set all icons dimensions
        echo '    <link rel="icon" type="image/png" href="themes/' . $theme . '/icons/' . $dimFav . '.png" sizes="' . $dimFav . 'x' . $dimFav . '">' . "\n";
    } ?>
  </head>

  <body>

    <main>

      <header>
        <a id="linkTitles" href="./">
          <img alt="" id="logo" src="themes/<?php echo $theme; ?>/icons/128.png">
          <div id="titles">
            <h1>LibreQR</h1>
            <h2><?= $loc['subtitle'] ?></h2>
          </div>
        </a>
      </header>

      <form method="post" action="./">

        <div id="firstWrapper">

          <div class="param" id="txtParam">
            <label for="txt">
              <details>
                <summary><?= $loc['label_content'] ?></summary>
                <p class="helpText">
                  <?= $loc['help_content'] ?>
                </p>
              </details>
            </label>
            <textarea rows="8" required="" id="txt" placeholder="<?= $loc['placeholder'] ?>" name="txt" minlenght="5" maxlenght="50"><?= htmlspecialchars($params['txt']) ?></textarea>
          </div>

          <div id="sideParams">

            <div class="param">
              <label for="redondancy">
                <details>
                  <summary><?= $loc['label_redondancy'] ?></summary>
                  <p class="helpText">
                    <?= $loc['help_redondancy'] ?>
                  </p>
                </details>
              </label>
              <select id="redondancy" name="redondancy">
                <option <?php if ($params['redondancy'] === "low") echo 'selected="" '; ?>value="low">L - 7%</option>
                <option <?php if ($params['redondancy'] === "medium") echo 'selected="" '; ?>value="medium">M - 15%</option>
                <option <?php if ($params['redondancy'] === "quartile") echo 'selected="" '; ?>value="quartile">Q - 25%</option>
                <option <?php if ($params['redondancy'] === "high") echo 'selected="" '; ?>value="high">H - 30%</option>
              </select>
            </div>

            <div class="param">
              <label for="margin">
                <details>
                  <summary><?= $loc['label_margin'] ?></summary>
                  <p class="helpText">
                    <?= $loc['help_margin'] ?>
                  </p>
                </details>
              </label>
              <input type="number" id="margin" placeholder="2" name="margin" min="0" max="1024" value="<?= htmlspecialchars($params['margin']) ?>">
            </div>

            <div class="param">
              <label for="size">
                <details>
                  <summary><?= $loc['label_size'] ?></summary>
                  <p class="helpText">
                    <?= $loc['help_size'] ?>
                  </p>
                </details>
              </label>
              <input type="number" id="size" placeholder="4" name="size" min="1" max="1024" value="<?= htmlspecialchars($params['size']) ?>">
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

      <section id="output">

        <?php

        if (!empty($params['txt'])) {
          $qrCode = new QrCode();
          $qrCode
            ->setText($params['txt'])
            ->setSize($params['size'])
            ->setPadding($params['margin'])
            ->setErrorCorrection($params['redondancy'])
            ->setForegroundColor(array(
              'r' => hexdec(substr($params['mainColor'],0,2)),
              'g' => hexdec(substr($params['mainColor'],2,2)),
              'b' => hexdec(substr($params['mainColor'],4,2)),
            ))
            ->setBackgroundColor(array(
              'r' => hexdec(substr($params['bgColor'],0,2)),
              'g' => hexdec(substr($params['bgColor'],2,2)),
              'b' => hexdec(substr($params['bgColor'],4,2)),
            ))
            ->setImageType(QrCode::IMAGE_TYPE_PNG);
          $base64 = $qrCode->generate();

          ?>
          <div class="centered" id="downloadQR">
            <a href="data:image/png;base64,<?= $base64 ?>" class="button" download="<?= htmlspecialchars($params['txt']); ?>.png"><?= $loc['button_download'] ?></a>
          </div>

          <div class="centered" id="showOnlyQR">
            <a title="<?= $loc['title_showOnlyQR'] ?>" href="data:image/png;base64,<?= $base64 ?>"><img alt='<?= $loc['alt_QR_before'] ?><?= htmlspecialchars($params['txt']); ?><?= $loc['alt_QR_after'] ?>' id="qrCode" src="data:image/png;base64,<?= $base64 ?>"></a>
          </div>

        <?php } ?>

        </section>

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
