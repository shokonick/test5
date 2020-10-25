<?php require "inc.php"; ?>
<!--
 _     _ _               ___  ____
| |   (_| |__  _ __ ___ / _ \|  _ \
| |   | | '_ \| '__/ _ | | | | |_) |
| |___| | |_) | | |  __| |_| |  _ <
|_____|_|_.__/|_|  \___|\__\_|_| \_\
A PHP Web interface for generating QR codes

Source code : https://code.antopie.org/miraty/libreqr

This file is part of LibreQR.

  LibreQR is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

  LibreQR is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.

  You should have received a copy of the GNU Affero General Public License along with this program. If not, see <https://www.gnu.org/licenses/>.

-->
<?php

function badQuery() { // Check if browser must be redirected

  // Check if parameters are set
  if (!isset($_GET['txt']))
    return true;
  else if (!isset($_GET['size']))
    return true;
  else if (!isset($_GET['redondancy']))
    return true;
  else if (!isset($_GET['margin']))
    return true;
  else if (!isset($_GET['bgColor']))
    return true;
  else if (!isset($_GET['mainColor']))
    return true;

  // Check parameters's types
  else if (!is_numeric($_GET['size']))
    return true;
  else if (!is_string($_GET['redondancy']))
    return true;
  else if (!is_numeric($_GET['margin']))
    return true;
  else if (!is_string($_GET['bgColor']))
    return true;
  else if (!is_string($_GET['mainColor']))
    return true;

  // Check if redondancy value is correct
  else if ($_GET['redondancy'] != "L" AND $_GET['redondancy'] != "M" AND $_GET['redondancy'] != "Q" AND $_GET['redondancy'] != "H")
    return true;

  else
    return false;
}

if (badQuery()) {

  parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $params);

  if (!isset($params['txt']))
    $params['txt'] = "";

  if (!isset($params['redondancy']) OR !is_string($params['redondancy']) OR ($params['redondancy'] != "L" AND $params['redondancy'] != "M" AND $params['redondancy'] != "Q" AND $params['redondancy'] != "H"))
    $params['redondancy'] = "H";

  if (!isset($params['margin']) OR !is_numeric($params['margin']))
    $params['margin'] = 2;

  if (!isset($params['size']) OR !is_numeric($params['size']))
    $params['size'] = 4;

  if (!isset($params['bgColor']) OR !is_string($params['bgColor']))
    $params['bgColor'] = "#FFFFFF";

  if (!isset($params['mainColor']) OR !is_string($params['mainColor']))
    $params['mainColor'] = "#000000";

  header('Location: ' . $instPath . "?" . http_build_query($params));
  exit;
}

?>
<!DOCTYPE html>
<html lang="<?= $locale ?>">
  <head>
    <meta charset="UTF-8">
    <title>LibreQR · <?= $loc['subtitle'] ?></title>
    <meta name="description" content="<?= $loc['description'] ?>">
    <meta name="theme-color" content="<?php echo $variablesTheme['bg']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="manifest.php">
    <link rel="search" type="application/opensearchdescription+xml" title="<?= $loc['opensearch_actionName'] ?>" href="opensearch.php&#63;redondancy=<?= $_GET['redondancy'] ?>&amp;margin=<?= $_GET['margin'] ?>&amp;size=<?= $_GET['size'] ?>&amp;bgColor=<?= urlencode($_GET['bgColor']) ?>&amp;mainColor=<?= urlencode($_GET['mainColor']) ?>">
    <?php
    // If style.min.css exists
    if (file_exists("style.min.css"))
      // And if it's older than theme.php or config.inc.php (so not up to date)
      if (filemtime("themes/" . $theme . "/theme.php") > filemtime("style.min.css") OR filemtime("config.inc.php") > filemtime("style.min.css"))
        // Then delete it
        unlink("style.min.css");

    require "lesserphp/lessc.inc.php";
    $less = new lessc;
    $less->setVariables($variablesTheme); // Make these colors available in style.less
    $less->setFormatter("compressed");
    $less->checkedCompile("style.less", "style.min.css"); // Compile, minimise and cache style.less into style.min.css
    ?>
    <link type="text/css" rel="stylesheet" href="style.min.css">
    <link type="text/css" rel="stylesheet" href="ubuntu/ubuntu.min.css">

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

      <form method="get" action="./">

        <div id="firstWrapper">

          <div class="param">
            <label for="txt"><?= $loc['label_content'] ?></label>
            <span class="helpContainer">
              <span class="helpButton" tabindex="0"><img class="helpImg" src="help.svg.php?clr=<?= urlencode($variablesTheme["text"]) ?>" alt="<?= $loc['alt_help'] ?>"></span>
              <span class="helpContent">
                <?= $loc['help_content'] ?>
              </span>
            </span>
            <br>
            <textarea rows="8" required="" id="txt" placeholder="<?= $loc['placeholder'] ?>" name="txt"><?php

            if (isset($_GET['txt'])) {
              echo htmlspecialchars($_GET['txt']);
            }

             ?></textarea>
          </div>

          <div id="menusDeroulants">

            <div class="param">
              <label for="redondancy"><?= $loc['label_redondancy'] ?></label>
              <span class="helpContainer">
                <span class="helpButton" tabindex="0"><img class="helpImg" src="help.svg.php?clr=<?= urlencode($variablesTheme["text"]) ?>" alt="<?= $loc['alt_help'] ?>"></span>
                <span class="helpContent"><?= $loc['help_redondancy'] ?></span>
              </span>
              <br>
              <select id="redondancy" name="redondancy">
                <option <?php if (isset($_GET['redondancy']) AND ($_GET['redondancy'] == "L")) {echo 'selected="" ';} ?>value="L">L - 7%</option>
                <option <?php if (isset($_GET['redondancy']) AND ($_GET['redondancy'] == "M")) {echo 'selected="" ';} ?>value="M">M - 15%</option>
                <option <?php if (isset($_GET['redondancy']) AND ($_GET['redondancy'] == "Q")) {echo 'selected="" ';} ?>value="Q">Q - 25%</option>
                <option <?php if ((isset($_GET['redondancy']) AND ($_GET['redondancy'] == "H")) OR (!isset($_GET['redondancy']) OR empty($_GET['redondancy']))) {echo 'selected="" ';} ?>value="H">H - 30%</option>
              </select>
            </div>

            <div class="param">
              <label for="margin"><?= $loc['label_margin'] ?></label>
              <span class="helpContainer">
                <span class="helpButton" tabindex="0"><img class="helpImg" src="help.svg.php?clr=<?= urlencode($variablesTheme["text"]) ?>" alt="<?= $loc['alt_help'] ?>"></span>
                <span class="helpContent"><?= $loc['help_margin'] ?></span>
              </span>
              <br>
              <select id="margin" name="margin">
                <option <?php if (isset($_GET['margin']) AND ($_GET['margin'] == "0")) {echo 'selected="" ';} ?>value="0">0</option>
                <option <?php if (isset($_GET['margin']) AND ($_GET['margin'] == "1")) {echo 'selected="" ';} ?>value="1">1</option>
                <option <?php if ((isset($_GET['margin']) AND ($_GET['margin'] == "2")) OR (!isset($_GET['margin']) OR empty($_GET['margin']))) {echo 'selected="" ';} ?>value="2">2 - <?= $loc['value_default'] ?></option>
                <option <?php if (isset($_GET['margin']) AND ($_GET['margin'] == "3")) {echo 'selected="" ';} ?>value="3">3</option>
                <option <?php if (isset($_GET['margin']) AND ($_GET['margin'] == "4")) {echo 'selected="" ';} ?>value="4">4</option>
                <option <?php if (isset($_GET['margin']) AND ($_GET['margin'] == "5")) {echo 'selected="" ';} ?>value="5">5</option>
                <option <?php if (isset($_GET['margin']) AND ($_GET['margin'] == "8")) {echo 'selected="" ';} ?>value="8">8</option>
                <option <?php if (isset($_GET['margin']) AND ($_GET['margin'] == "10")) {echo 'selected="" ';} ?>value="10">10</option>
              </select>
            </div>

            <div class="param">
              <label for="size"><?= $loc['label_size'] ?></label>
              <span class="helpContainer">
                <span class="helpButton" tabindex="0"><img class="helpImg" src="help.svg.php?clr=<?= urlencode($variablesTheme["text"]) ?>" alt="<?= $loc['alt_help'] ?>"></span>
                <span class="helpContent"><?= $loc['help_size'] ?></span>
              </span>
              <br>
              <select id="size" name="size">
                <option <?php if (isset($_GET['size']) AND ($_GET['size'] == 1)) {echo 'selected="" ';} ?>value="1">1</option>
                <option <?php if (isset($_GET['size']) AND ($_GET['size'] == 2)) {echo 'selected="" ';} ?>value="2">2</option>
                <option <?php if (isset($_GET['size']) AND ($_GET['size'] == 3)) {echo 'selected="" ';} ?>value="3">3</option>
                <option <?php if ((isset($_GET['size']) AND ($_GET['size'] == 4)) OR (!isset($_GET['size']) OR empty($_GET['size']))) {echo 'selected="" ';} ?>value="4">4 - <?= $loc['value_default'] ?></option>
                <option <?php if (isset($_GET['size']) AND ($_GET['size'] == 5)) {echo 'selected="" ';} ?>value="5">5</option>
                <option <?php if (isset($_GET['size']) AND ($_GET['size'] == 6)) {echo 'selected="" ';} ?>value="6">6</option>
                <option <?php if (isset($_GET['size']) AND ($_GET['size'] == 8)) {echo 'selected="" ';} ?>value="8">8</option>
                <option <?php if (isset($_GET['size']) AND ($_GET['size'] == 10)) {echo 'selected="" ';} ?>value="10">10</option>
                <option <?php if (isset($_GET['size']) AND ($_GET['size'] == 15)) {echo 'selected="" ';} ?>value="15">15</option>
                <option <?php if (isset($_GET['size']) AND ($_GET['size'] == 20)) {echo 'selected="" ';} ?>value="20">20</option>
              </select>
            </div>

          </div>

        </div>

        <div id="colors">

          <div class="param">
            <label for="bgColor"><?= $loc['label_bgColor'] ?></label>
            <div class="inputColorContainer">
                        <input type="color" name="bgColor" id="bgColor" value="<?php if (!empty($_GET['bgColor'])) {echo htmlspecialchars($_GET['bgColor']);} else {echo "#FFFFFF";} ?>">
            </div>
          </div>

          <div class="param">
            <label for="mainColor"><?= $loc['label_mainColor'] ?></label>
            <div class="inputColorContainer">
              <input type="color" name="mainColor" id="mainColor" value="<?php if (!empty($_GET['mainColor'])) {echo htmlspecialchars($_GET['mainColor']);} else {echo "#000000";} ?>">
            </div>
          </div>
        </div>

        <div class="centered">
          <input class="button" type="submit" value="<?= $loc['button_create'] ?>" />
        </div>

      </form>

    <?php

    if (!empty($_GET['txt']) AND !empty($_GET['size']) AND !empty($_GET['redondancy']) AND !empty($_GET['margin']) AND !empty($_GET['bgColor']) AND !empty($_GET['mainColor'])) {
      if (isset($_GET['txt']) AND isset($_GET['size']) AND isset($_GET['redondancy']) AND isset($_GET['margin']) AND isset($_GET['bgColor']) AND isset($_GET['mainColor'])) {

        require "phpqrcode.php";

        $cheminImage = "temp/" . generateRandomString($fileNameLenght) . ".png";
        QRcode::png($_GET['txt'], $cheminImage, $_GET['redondancy'], $_GET['size'], $_GET['margin'], false, hexdec($_GET['bgColor']), hexdec($_GET['mainColor']));
        ?>
        <div class="centered">
          <a href="<?php echo $cheminImage; ?>" class="button" download="<?php echo htmlspecialchars($_GET['txt']); ?>.png"><?= $loc['button_download'] ?></a>
        </div>

        <div class="centered" id="showOnlyQR">
          <a title="<?= $loc['title_showOnlyQR'] ?>" href="<?php echo $cheminImage; ?>"><img alt='<?= $loc['alt_QR_before'] ?><?php echo htmlspecialchars($_GET['txt']); ?><?= $loc['alt_QR_after'] ?>' id="qrCode" src="<?php echo $cheminImage; ?>"/></a>
        </div>
        <?php
      }
    }
        ?>

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

      </div>
    </main>

  </body>
</html>
