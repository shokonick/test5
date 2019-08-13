<?php require "options.inc.php";
$locale = "fr_FR";

    if (defined('LC_MESSAGES')) {
        setlocale(LC_MESSAGES, $locale); // Linux
        bindtextdomain("messages", "./locale");
    } else {
        putenv("LC_ALL={$locale}"); // windows
        bindtextdomain("messages", "./locale");
    }


    textdomain("messages");
?>
<!--
   _____                                  _                              _                            _                _____ ______
  |  __ \   //           //              | |                            | |                          | |              |  _  || ___ \
  | |  \/  ___  _ __    ___  _ __   __ _ | |_   ___  _   _  _ __      __| |  ___      ___   ___    __| |  ___  ___    | | | || |_/ /
  | | __  / _ \| '_ \  / _ \| '__| / _` || __| / _ \| | | || '__|    / _` | / _ \    / __| / _ \  / _` | / _ \/ __|   | | | ||    /
  | |_\ \|  __/| | | ||  __/| |   | (_| || |_ |  __/| |_| || |      | (_| ||  __/   | (__ | (_) || (_| ||  __/\__ \   \ \/' /| |\ \
   \____/ \___||_| |_| \___||_|    \__,_| \__| \___| \__,_||_|       \__,_| \___|    \___| \___/  \__,_| \___||___/    \_/\_\\_| \_|

  Version 1.2.0dev
  Créé par Miraty et diffusé sous AGPLv3+
  Code source : https://code.antopie.org/miraty/qr
-->

<!DOCTYPE HTML>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Générateur de codes QR</title>
    <meta name="description" content="Générez des codes QR librement. Choisissez le contenu, la taille, la couleur...">
    <meta name="theme-color" content="<?php echo $variablesTheme['fond']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="manifest.php">
    <link rel="search" type="application/opensearchdescription+xml" title="Générer un code QR" href="opensearch.php">

    <style>
    <?php
    $less->setVariables($variablesTheme); // Rends ces couleurs utilisables dans style.less


      if ($env == "prod") { // En production : minimise et met en cache style.less dans style.css
        $less->setFormatter("compressed");
        $less->checkedCompile("style.less", "style.css");
        echo file_get_contents("ubuntu/ubuntu.min.css") . file_get_contents("style.css"); // Inclus toutes les CSS dans le document HTML (= moins de requêtes HTTP)

      } else if ($env == "dev") { // En développement : compile style.less a chaque chargement de page
        echo file_get_contents("ubuntu/ubuntu.min.css") . $less->compileFile("style.less");

      } else {
        echo "Erreur : $env doit valoir prod ou dev dans options.inc.php";
      } ?>
    </style>
    <?php

        foreach($themeDimensionsFavicons as $dimFav) { // Indique toutes les dimensions de favicons
            echo '    <link rel="icon" type="image/png" href="themes/' . $theme . '/favicons/' . $dimFav . '.png" sizes="' . $dimFav . 'x' . $dimFav . '">' . "\n";
        } ?>

  </head>

    <body lang="fr">

      <header>
        <a href="<?php echo $cheminInstall; ?>"><img id="logo" src="themes/<?php echo $theme; ?>/favicons/48.png" alt="Logo de code QR"> <h1><?php echo gettext("thisisatest"); ?>Générateur de codes QR</h1></a>
      </header>

  <?php if (!isset($_GET["texte"])) { // Si OpenSearch n'a pas été utilisé ?>

      <form method="post">

        <div class="param">
          <label for="texte"><?php echo gettext("ieatbanana"); ?>Texte à encoder</label>
          <span class="conteneurAide">
            <span class="boutonAide"><?php include "aide.svg"; ?></span>
            <span class="contenuAide">Vous pouvez encoder ce que vous voulez sous forme de texte.</span>
          </span>
          <br>
          <textarea rows="8" required="" id="texte" placeholder="Entrez le texte à encoder dans le code QR" name="texte"><?php

          if (isset($_POST['texte'])) {
              echo $_POST['texte'];
          }

           ?></textarea>
        </div>


                <div id="couleurs">

                  <div class="param">
                    <label for="couleurFond">Couleur de fond</label>
                    <span class="conteneurAide">
                      <span class="boutonAide"><?php include "aide.svg"; ?></span>
                      <span class="contenuAide">Par combien les dimensions de l'image seront-elles multipliées ?</span>
                    </span>
                    <br>
                    <div class="conteneurInputColor">
                      <input type="color" name="couleurFond" id="couleurFond" value="<?php if (isset($_POST['couleurFond'])) {echo $_POST['couleurFond'];} else {echo "#FFFFFF";} ?>">
                    </div>
                  </div>

                  <div class="param">
                    <label for="couleurPrincipale">Couleur de premier plan</label>
                    <span class="conteneurAide">
                      <span class="boutonAide"><?php include "aide.svg"; ?></span>
                      <span class="contenuAide">Nombre de pixels des bandes blanches autour du code QR.</span>
                    </span>
                    <br>
                    <div class="conteneurInputColor">
                      <input type="color" name="couleurPrincipale" id="couleurPrincipale" value="<?php if (isset($_POST['couleurPrincipale'])) {echo $_POST['couleurPrincipale'];} else {echo "#000000";} ?>">
                    </div>
                  </div>

                </div>


        <div id="menusDeroulants">
          <div class="param">
            <label for="taille">Taille de l'image</label>
            <span class="conteneurAide">
              <span class="boutonAide"><?php include "aide.svg"; ?></span>
              <span class="contenuAide">Par combien les dimensions de l'image seront-elles multipliées ?</span>
            </span>
            <br>
            <select id="taille" name="taille">
              <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 1)) {echo 'selected="" ';} ?>value="1">1</option>
              <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 2)) {echo 'selected="" ';} ?>value="2">2</option>
              <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 3)) {echo 'selected="" ';} ?>value="3">3</option>
              <option <?php if ((isset($_POST['taille']) AND ($_POST['taille'] == 4)) OR (!isset($_POST['taille']))) {echo 'selected="" ';} ?>value="4">4 - par défaut</option>
              <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 5)) {echo 'selected="" ';} ?>value="5">5</option>
              <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 6)) {echo 'selected="" ';} ?>value="6">6</option>
              <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 7)) {echo 'selected="" ';} ?>value="7">7</option>
              <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 8)) {echo 'selected="" ';} ?>value="8">8</option>
              <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 10)) {echo 'selected="" ';} ?>value="10">10</option>
              <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 15)) {echo 'selected="" ';} ?>value="15">15</option>
              <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 20)) {echo 'selected="" ';} ?>value="20">20</option>
            </select>
          </div>

          <div class="param">
            <label for="redondance">Taux de redondance</label>
            <span class="conteneurAide">
              <span class="boutonAide"><?php include "aide.svg"; ?></span>
              <span class="contenuAide">La redondance est le "doublement" des informations dans le code QR afin de corriger les erreurs lors du décodage. Un taux plus élevé produira un code QR plus grand, mais aura plus de chance d'être décodé correctement.</span>
            </span>
            <br>
            <select id="redondance" name="redondance">
              <option <?php if (isset($_POST['redondance']) AND ($_POST['redondance'] == "L")) {echo 'selected="" ';} ?>value="L">L - 7% de redondance</option>
              <option <?php if (isset($_POST['redondance']) AND ($_POST['redondance'] == "M")) {echo 'selected="" ';} ?>value="M">M - 15% de redondance</option>
              <option <?php if (isset($_POST['redondance']) AND ($_POST['redondance'] == "Q")) {echo 'selected="" ';} ?>value="Q">Q - 25% de redondance</option>
              <option <?php if ((isset($_POST['redondance']) AND ($_POST['redondance'] == "H")) OR (!isset($_POST['redondance']))) {echo 'selected="" ';} ?>value="H">H - 30% de redondance</option>
            </select>
          </div>

          <div class="param">
            <label for="marge">Taille de la marge</label>
            <span class="conteneurAide">
              <span class="boutonAide"><?php include "aide.svg"; ?></span>
              <span class="contenuAide">Nombre de pixels des bandes blanches autour du code QR.</span>
            </span>
            <br>
            <select id="marge" name="marge">
              <option <?php if (isset($_POST['marge']) AND ($_POST['marge'] == "0")) {echo 'selected="" ';} ?>value="0">0</option>
              <option <?php if (isset($_POST['marge']) AND ($_POST['marge'] == "1")) {echo 'selected="" ';} ?>value="1">1</option>
              <option <?php if ((isset($_POST['marge']) AND ($_POST['marge'] == "2")) OR (!isset($_POST['marge']))) {echo 'selected="" ';} ?>value="2">2 - par défaut</option>
              <option <?php if (isset($_POST['marge']) AND ($_POST['marge'] == "3")) {echo 'selected="" ';} ?>value="3">3</option>
              <option <?php if (isset($_POST['marge']) AND ($_POST['marge'] == "5")) {echo 'selected="" ';} ?>value="5">5</option>
              <option <?php if (isset($_POST['marge']) AND ($_POST['marge'] == "10")) {echo 'selected="" ';} ?>value="10">10</option>
            </select>
          </div>

        </div>

        <br>

        <div class="centrer">
          <input type="submit" class="bouton" value="Générer" />
        </div>
        <br>
        <br>


      </form>

  <?php

    if (isset($_POST['texte']) AND isset($_POST['taille']) AND isset($_POST['redondance']) AND isset($_POST['marge']) AND isset($_POST['couleurFond']) AND isset($_POST['couleurPrincipale'])) {
      require "phpqrcode.php";

      $cheminImage = "temp/" . generateRandomString(50) . ".png";


      QRcode::png($_POST['texte'], $cheminImage, $_POST['redondance'], $_POST['taille'], $_POST['marge'], false, hexdec($_POST['couleurFond']), hexdec($_POST['couleurPrincipale'])); ?>

      <div class="centrer">
        <a href="<?php echo $cheminImage; ?>" class="bouton" download="<?php echo htmlspecialchars($_POST['texte']); ?>.png">Télécharger ce code QR</a>
      </div>
      <br><br>
      <div class="centrer">
        <a title="Cliquez pour afficher uniquement ce code QR" href="<?php echo $cheminImage; ?>"><img alt='Un code QR contenant "<?php echo htmlspecialchars($_POST['texte']); ?>"' id="codeQR" src="<?php echo $cheminImage; ?>"/></a>
      </div>
      <?php
    }
      ?>

  <?php } else if (isset($_GET["texte"])) { // Si OpenSearch a été utilisé

    if (empty($_GET["texte"])) { // Si rien n'a été recherché ?>

    <span style="font-size: 30px;">Erreur : vous ne pouvez pas générer un code QR vide !

    <?php } else {

      require "phpqrcode.php";
      $cheminImage = "temp/" . generateRandomString(50) . ".png";

      QRcode::png($_GET['texte'], $cheminImage, "H", 4, 2); ?>

      <br>

      Vous avez créé un code QR contenant :
      <div class="contenuQR"><?php echo htmlspecialchars($_GET['texte']); ?></div>

      <br>

      <div class="centrer">
        <a href="<?php echo $cheminImage; ?>" class="bouton" download="<?php echo htmlspecialchars($_GET['texte']); ?>.png">Télécharger ce code QR</a>
      </div>
      <br><br>
      <div class="centrer">
        <a title="Cliquez pour afficher uniquement ce code QR" href="<?php echo $cheminImage; ?>"><img alt='Un code QR contenant "<?php echo htmlspecialchars($_GET['texte']); ?>"' id="codeQR" src="<?php echo $cheminImage; ?>"/></a>
      </div>



    <?php } } ?>

    <section class="info">
      <strong>Qu'est-ce qu'un code QR ?</strong><br>
      Un code QR est une image en 2 dimensions dans laquelle est inscrite en binaire des informations textuelles.<br>
      Un pixel blanc représente un 0 et un pixel noir représente un 1.<br>
      <a href="https://fr.wikipedia.org/wiki/Code_QR">Code QR sur Wikipédia</a>
    </section>

    <footer>
      <a class="topRight" href="https://code.antopie.org/miraty/qr/">Code source</a>
    </footer>



  </body>
</html>
