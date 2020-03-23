<?php require "config.inc.php"; ?>
<!--
 _     _ _               ___  ____
| |   (_| |__  _ __ ___ / _ \|  _ \
| |   | | '_ \| '__/ _ | | | | |_) |
| |___| | |_) | | |  __| |_| |  _ <
|_____|_|_.__/|_|  \___|\__\_|_| \_\

LibreQR version 1.2.0
Créé par Miraty et diffusé sous AGPLv3+
Code source : https://code.antopie.org/miraty/libreqr

Ce fichier fait partie de LibreQR.

  LibreQR est un logiciel libre ; vous pouvez le redistribuer ou le modifier
  suivant les termes de la GNU Affero General Public License
  telle que publiée par la Free Software Foundation ; soit la version 3
  de la licence, soit (à votre gré) toute version ultérieure.

  LibreQR est distribué dans l'espoir qu'il sera utile,
  mais SANS AUCUNE GARANTIE ; sans même la garantie tacite de
  QUALITÉ MARCHANDE ou d'ADÉQUATION à UN BUT PARTICULIER.
  Consultez la GNU Affero General Public License pour plus de détails.

  Vous devez avoir reçu une copie de la GNU Affero General Public License
  en même temps que LibreQR ; si ce n'est pas le cas,
  consultez <https://www.gnu.org/licenses/>.

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
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Générateur de codes QR</title>
    <meta name="description" content="Générez des codes QR librement. Choisissez le contenu, la taille, la couleur...">
    <meta name="theme-color" content="<?php echo $variablesTheme['bg']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="manifest.php">
    <link rel="search" type="application/opensearchdescription+xml" title="Générer un code QR" href="opensearch.php&#63;redondancy=<?= $_GET['redondancy'] ?>&amp;margin=<?= $_GET['margin'] ?>&amp;size=<?= $_GET['size'] ?>&amp;bgColor=<?= urlencode($_GET['bgColor']) ?>&amp;mainColor=<?= urlencode($_GET['mainColor']) ?>">
    <?php
    // If style.min.css exists
    if (file_exists("style.min.css"))
      // And if it's older than theme.php or config.inc.php (so not up to date)
      if (filemtime("themes/" . $theme . "/theme.php") > filemtime("style.min.css") OR filemtime("config.inc.php") > filemtime("style.min.css"))
        // Then delete it
        unlink("style.min.css");

    require "lessphp/lessc.inc.php";
    $less = new lessc;
    $less->setVariables($variablesTheme); // Rends ces couleurs utilisables dans style.less
    $less->setFormatter("compressed");
    $less->checkedCompile("style.less", "style.min.css"); // Compile, minimise et met en cache style.less dans style.min.css
    ?>
    <link type="text/css" rel="stylesheet" href="style.min.css">
    <link type="text/css" rel="stylesheet" href="ubuntu/ubuntu.min.css">

    <?php
    foreach($themeDimensionsIcons as $dimFav) { // Indique toutes les dimensions d'icones
        echo '    <link rel="icon" type="image/png" href="themes/' . $theme . '/icons/' . $dimFav . '.png" sizes="' . $dimFav . 'x' . $dimFav . '">' . "\n";
    } ?>

  </head>

  <body>

    <div class="center">

      <header>
        <a id="lienTitres" href="./">
          <img id="logo" src="themes/<?php echo $theme; ?>/icons/128.png" alt="Code QR stylisé">
          <div id="titres">
            <h1>LibreQR</h1>
            <h2>Générateur de codes QR</h2>
          </div>
        </a>
      </header>

      <form method="get" action="./">

        <div id="firstWrapper">

          <div class="param">
            <label for="txt">Texte à encoder</label>
            <span class="conteneurAide">
              <span class="boutonAide" tabindex="0"><img id="helpImg" src="help.svg.php?clr=<?= $variablesTheme["text"] ?>" alt="Aide"></span>
              <span class="contenuAide">
                Vous pouvez encoder ce que vous voulez sous forme de texte.<br>
                Les logiciels qui décodent ces codes QR pourraient proposer de les ouvrir avec un logiciel dédié, en fonction de leur <a href="https://fr.wikipedia.org/wiki/Sch%C3%A9ma_d%27URI">schéma d'URI</a>.<br><br>
                Par exemple, pour ouvrir une page Web :<br>
                https://www.domaine.tld/<br><br>
                Pour envoyer un mail :<br>
                mailto:contact@domaine.tld<br><br>
                Pour partager des coordonnées géographique :<br>
                geo:48.867564,2.364057<br><br>
                Pour appeler un numéro de téléphone :<br>
                tel:0639981871
              </span>
            </span>
            <br>
            <textarea rows="8" required="" id="txt" placeholder="Entrez le texte à encoder dans le code QR" name="txt"><?php

            if (isset($_GET['txt'])) {
              echo htmlspecialchars($_GET['txt']);
            }

             ?></textarea>
          </div>

          <div id="menusDeroulants">

            <div class="param">
              <label for="redondancy">Taux de redondance</label>
              <span class="conteneurAide">
                <span class="boutonAide" tabindex="0"><img id="helpImg" src="help.svg.php?clr=<?= $variablesTheme["text"] ?>" alt="Aide"></span>
                <span class="contenuAide">La redondance est le "doublement" des informations dans le code QR afin de corriger les erreurs lors du décodage. Un taux plus élevé produira un code QR plus grand, mais aura plus de chance d'être décodé correctement.</span>
              </span>
              <br>
              <select id="redondancy" name="redondancy">
                <option <?php if (isset($_GET['redondancy']) AND ($_GET['redondancy'] == "L")) {echo 'selected="" ';} ?>value="L">L - 7% de redondance</option>
                <option <?php if (isset($_GET['redondancy']) AND ($_GET['redondancy'] == "M")) {echo 'selected="" ';} ?>value="M">M - 15% de redondance</option>
                <option <?php if (isset($_GET['redondancy']) AND ($_GET['redondancy'] == "Q")) {echo 'selected="" ';} ?>value="Q">Q - 25% de redondance</option>
                <option <?php if ((isset($_GET['redondancy']) AND ($_GET['redondancy'] == "H")) OR (!isset($_GET['redondancy']) OR empty($_GET['redondancy']))) {echo 'selected="" ';} ?>value="H">H - 30% de redondance</option>
              </select>
            </div>

            <div class="param">
              <label for="margin">Taille de la marge</label>
              <span class="conteneurAide">
                <span class="boutonAide" tabindex="0"><img id="helpImg" src="help.svg.php?clr=<?= $variablesTheme["text"] ?>" alt="Aide"></span>
                <span class="contenuAide">Nombre de pixels des bandes blanches autour du code QR.</span>
              </span>
              <br>
              <select id="margin" name="margin">
                <option <?php if (isset($_GET['margin']) AND ($_GET['margin'] == "0")) {echo 'selected="" ';} ?>value="0">0</option>
                <option <?php if (isset($_GET['margin']) AND ($_GET['margin'] == "1")) {echo 'selected="" ';} ?>value="1">1</option>
                <option <?php if ((isset($_GET['margin']) AND ($_GET['margin'] == "2")) OR (!isset($_GET['margin']) OR empty($_GET['margin']))) {echo 'selected="" ';} ?>value="2">2 - par défaut</option>
                <option <?php if (isset($_GET['margin']) AND ($_GET['margin'] == "3")) {echo 'selected="" ';} ?>value="3">3</option>
                <option <?php if (isset($_GET['margin']) AND ($_GET['margin'] == "4")) {echo 'selected="" ';} ?>value="4">4</option>
                <option <?php if (isset($_GET['margin']) AND ($_GET['margin'] == "5")) {echo 'selected="" ';} ?>value="5">5</option>
                <option <?php if (isset($_GET['margin']) AND ($_GET['margin'] == "8")) {echo 'selected="" ';} ?>value="8">8</option>
                <option <?php if (isset($_GET['margin']) AND ($_GET['margin'] == "10")) {echo 'selected="" ';} ?>value="10">10</option>
              </select>
            </div>

            <div class="param">
              <label for="size">Taille de l'image</label>
              <span class="conteneurAide">
                <span class="boutonAide" tabindex="0"><img id="helpImg" src="help.svg.php?clr=<?= $variablesTheme["text"] ?>" alt="Aide"></span>
                <span class="contenuAide">Par combien les dimensions de l'image seront-elles multipliées ?</span>
              </span>
              <br>
              <select id="size" name="size">
                <option <?php if (isset($_GET['size']) AND ($_GET['size'] == 1)) {echo 'selected="" ';} ?>value="1">1</option>
                <option <?php if (isset($_GET['size']) AND ($_GET['size'] == 2)) {echo 'selected="" ';} ?>value="2">2</option>
                <option <?php if (isset($_GET['size']) AND ($_GET['size'] == 3)) {echo 'selected="" ';} ?>value="3">3</option>
                <option <?php if ((isset($_GET['size']) AND ($_GET['size'] == 4)) OR (!isset($_GET['size']) OR empty($_GET['size']))) {echo 'selected="" ';} ?>value="4">4 - par défaut</option>
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
            <label for="bgColor">Couleur de fond</label>
            <div class="conteneurInputColor">
                        <input type="color" name="bgColor" id="bgColor" value="<?php if (!empty($_GET['bgColor'])) {echo htmlspecialchars($_GET['bgColor']);} else {echo "#FFFFFF";} ?>">
            </div>
          </div>

          <div class="param">
            <label for="mainColor">Couleur de premier plan</label>
            <div class="conteneurInputColor">
              <input type="color" name="mainColor" id="mainColor" value="<?php if (!empty($_GET['mainColor'])) {echo htmlspecialchars($_GET['mainColor']);} else {echo "#000000";} ?>">
            </div>
          </div>
        </div>

        <div class="centrer">
          <input class="bouton" type="submit" value="Générer" />
        </div>

      </form>

    <?php

    if (!empty($_GET['txt']) AND !empty($_GET['size']) AND !empty($_GET['redondancy']) AND !empty($_GET['margin']) AND !empty($_GET['bgColor']) AND !empty($_GET['mainColor'])) {
      if (isset($_GET['txt']) AND isset($_GET['size']) AND isset($_GET['redondancy']) AND isset($_GET['margin']) AND isset($_GET['bgColor']) AND isset($_GET['mainColor'])) {

        require "phpqrcode.php";

        $cheminImage = "temp/" . generateRandomString($fileNameLenght) . ".png";
        QRcode::png($_GET['txt'], $cheminImage, $_GET['redondancy'], $_GET['size'], $_GET['margin'], false, hexdec($_GET['bgColor']), hexdec($_GET['mainColor']));
        ?>
        <div class="centrer">
          <a href="<?php echo $cheminImage; ?>" class="bouton" download="<?php echo htmlspecialchars($_GET['txt']); ?>.png">Télécharger ce code QR</a>
        </div>

        <div class="centrer" id="showOnlyQR">
          <a title="Cliquez pour afficher uniquement ce code QR" href="<?php echo $cheminImage; ?>"><img alt='Un code QR contenant "<?php echo htmlspecialchars($_GET['txt']); ?>"' id="qrCode" src="<?php echo $cheminImage; ?>"/></a>
        </div>
        <?php
      }
    }
        ?>

    </div>

    <div id="metaTexts">

      <section id="info" class="metaText">
        <h3>Qu'est-ce qu'un code QR ?</h3>
        Un code QR est un code-barres en 2 dimensions dans lequel est inscrit en binaire du texte. Il peut être décodé avec un appareil muni d'un capteur photo et d'un logiciel adéquat.
        <a href="https://fr.wikipedia.org/wiki/Code_QR">Code QR sur Wikipédia</a>
      </section>

      <footer class="metaText">
        LibreQR 1.2.0 est un logiciel libre dont le <a href="https://code.antopie.org/miraty/libreqr/">code source</a> est disponible
        selon les termes de l'<abbr title="GNU Affero General Public License version 3 ou toute version ultérieure"><a href="LICENSE.html">AGPLv3</a>+</abbr>.
      </footer>

    </div>

  </body>
</html>
