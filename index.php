<?php require "options.inc.php"; ?>
<!--
 _     _ _               ___  ____
| |   (_| |__  _ __ ___ / _ \|  _ \
| |   | | '_ \| '__/ _ | | | | |_) |
| |___| | |_) | | |  __| |_| |  _ <
|_____|_|_.__/|_|  \___|\__\_|_| \_\


LibreQR version 1.2.0
Créé par Miraty et diffusé sous AGPLv3+
Code source : https://code.antopie.org/miraty/qr

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
if (!isset($_GET['text']) AND !isset($_GET['size']) AND !isset($_GET['redondancy']) AND !isset($_GET['margin']) AND !isset($_GET['bgColor']) AND !isset($_GET['mainColor'])) {
$arguments = $_SERVER['REQUEST_URI'];
$arguments = preg_replace('#(manifest|opensearch|index).php$#i', '', $arguments);
$arguments = preg_replace('#.*/#i', '', $arguments);

//$allVars = array("text", "redondancy")
//if (!isset($_GET['text'])) {

  header('Location: ' . $cheminInstall . "?text=" . $_GET['text'] . "&redondancy=" . $_GET['redondancy'] . "&margin=" . $_GET['margin'] . "&size=" . $_GET['size'] . "&bgColor=" . $_GET['bgColor'] . "&mainColor=" . $_GET['mainColor']);
/*
  if (empty($arguments)) {
    header('Location: ' . $cheminInstall . $arguments . '?text=');
  } else {
    header('Location: ' . $cheminInstall . $arguments . '&text=');
  }
  */
//}

}

?>

<!DOCTYPE HTML>
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
    $less->setVariables($variablesTheme); // Rends ces couleurs utilisables dans style.less

    // Minimise et met en cache style.less dans style.min.css
    $less->setFormatter("compressed");
    $less->checkedCompile("style.less", "style.min.css");
    ?>
    <link type="text/css" rel="stylesheet" href="style.min.css" />
    <link type="text/css" rel="stylesheet" href="ubuntu/ubuntu.min.css" />

    <?php
    foreach($themeDimensionsFavicons as $dimFav) { // Indique toutes les dimensions de favicons
        echo '    <link rel="icon" type="image/png" href="themes/' . $theme . '/favicons/' . $dimFav . '.png" sizes="' . $dimFav . 'x' . $dimFav . '">' . "\n";
    } ?>

  </head>

    <body lang="fr">

      <div class="center">

        <header>
          <a id="titre" href="<?php echo $cheminInstall; ?>"><img id="logo" src="themes/<?php echo $theme; ?>/favicons/48.png" alt="Logo de code QR"> <h1>Générateur de codes QR</h1></a>
        </header>



        <form method="get" action="./">

          <div id="firstWrapper">

          <div class="param">
            <label for="text">Texte à encoder</label>
            <span class="conteneurAide">
              <span class="boutonAide" tabindex="0"><?php include "aide.svg"; ?></span>
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
            <textarea rows="8" required="" id="text" placeholder="Entrez le texte à encoder dans le code QR" name="text"><?php

            if (isset($_GET['text'])) {
                echo $_GET['text'];
            }

             ?></textarea>
          </div>


                  <div id="menusDeroulants">


                    <div class="param">
                      <label for="redondancy">Taux de redondance</label>
                      <span class="conteneurAide">
                        <span class="boutonAide" tabindex="0"><?php include "aide.svg"; ?></span>
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
                        <span class="boutonAide" tabindex="0"><?php include "aide.svg"; ?></span>
                        <span class="contenuAide">Nombre de pixels des bandes blanches autour du code QR.</span>
                      </span>
                      <br>
                      <select id="margin" name="margin">
                        <option <?php if (isset($_GET['margin']) AND ($_GET['margin'] == "0")) {echo 'selected="" ';} ?>value="0">0</option>
                        <option <?php if (isset($_GET['margin']) AND ($_GET['margin'] == "1")) {echo 'selected="" ';} ?>value="1">1</option>
                        <option <?php if ((isset($_GET['margin']) AND ($_GET['margin'] == "2")) OR (!isset($_GET['margin']) OR empty($_GET['margin']))) {echo 'selected="" ';} ?>value="2">2 - par défaut</option>
                        <option <?php if (isset($_GET['margin']) AND ($_GET['margin'] == "3")) {echo 'selected="" ';} ?>value="3">3</option>
                        <option <?php if (isset($_GET['margin']) AND ($_GET['margin'] == "5")) {echo 'selected="" ';} ?>value="5">5</option>
                        <option <?php if (isset($_GET['margin']) AND ($_GET['margin'] == "10")) {echo 'selected="" ';} ?>value="10">10</option>
                      </select>
                    </div>

                    <div class="param">
                      <label for="size">Taille de l'image</label>
                      <span class="conteneurAide">
                        <span class="boutonAide" tabindex="0"><?php include "aide.svg"; ?></span>
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
                        <option <?php if (isset($_GET['size']) AND ($_GET['size'] == 7)) {echo 'selected="" ';} ?>value="7">7</option>
                        <option <?php if (isset($_GET['size']) AND ($_GET['size'] == 8)) {echo 'selected="" ';} ?>value="8">8</option>
                        <option <?php if (isset($_GET['size']) AND ($_GET['size'] == 10)) {echo 'selected="" ';} ?>value="10">10</option>
                        <option <?php if (isset($_GET['size']) AND ($_GET['size'] == 15)) {echo 'selected="" ';} ?>value="15">15</option>
                        <option <?php if (isset($_GET['size']) AND ($_GET['size'] == 20)) {echo 'selected="" ';} ?>value="20">20</option>
                      </select>
                    </div>

                  </div>

                </div>


                  <div id="couleurs">

                    <div class="param">
                      <label for="bgColor">Couleur de fond</label>
                      <div class="conteneurInputColor">
                        <input type="color" name="bgColor" id="bgColor" value="<?php if (!empty($_GET['bgColor'])) {echo $_GET['bgColor'];} else {echo "#FFFFFF";} ?>">
                      </div>
                    </div>

                    <div class="param">
                      <label for="mainColor">Couleur de premier plan</label>
                      <div class="conteneurInputColor">
                        <input type="color" name="mainColor" id="mainColor" value="<?php if (!empty($_GET['mainColor'])) {echo $_GET['mainColor'];} else {echo "#000000";} ?>">
                      </div>
                    </div>

                  </div>

          <br>
          <div class="centrer">
            <input class="bouton" type="submit" value="Générer" />
          </div>

        </form>

    <?php

    if (!empty($_GET['text']) AND !empty($_GET['size']) AND !empty($_GET['redondancy']) AND !empty($_GET['margin']) AND !empty($_GET['bgColor']) AND !empty($_GET['mainColor'])) {
      if (isset($_GET['text']) AND isset($_GET['size']) AND isset($_GET['redondancy']) AND isset($_GET['margin']) AND isset($_GET['bgColor']) AND isset($_GET['mainColor'])) {
        require "phpqrcode.php";

        $cheminImage = "temp/" . generateRandomString(64) . ".png";

        QRcode::png($_GET['text'], $cheminImage); ?>
        <img src="<?= $cheminImage ?>"/>
        <div class="centrer">
          <a href="<?php echo $cheminImage; ?>" class="bouton" download="<?php echo htmlspecialchars($_GET['text']); ?>.png">Télécharger ce code QR</a>
        </div>
        <br><br>
        <div class="centrer">
          <a title="Cliquez pour afficher uniquement ce code QR" href="<?php echo $cheminImage; ?>"><img alt='Un code QR contenant "<?php echo htmlspecialchars($_GET['text']); ?>"' id="codeQR" src="<?php echo $cheminImage; ?>"/></a>
        </div>
        <?php
      }
    }
        ?>

    </div>

    <section class="info">
      <strong>Qu'est-ce qu'un code QR ?</strong><br>
      Un code QR est un code-barres en 2 dimensions dans lequel est inscrit en binaire du texte. Il peut être décodé avec un appareil muni d'un capteur photo et d'un logiciel adéquat.
      <a href="https://fr.wikipedia.org/wiki/Code_QR">Code QR sur Wikipédia</a>
    </section>

    <footer>
      LibreQR 1.2.0 est un logiciel libre dont le <a href="https://code.antopie.org/miraty/qr/">code source</a> est disponible
       selon les termes de l'<abbr title="GNU Affero General Public License version 3 ou toute version ultérieure"><a href="LICENSE.html">AGPLv3</a>+</abbr>.
    </footer>

  </body>
</html>
