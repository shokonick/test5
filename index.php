<!--
  Code publié sous licence Apache 2.0
  https://code.antopie.org/miraty/qr
-->
<?php
  supprimerVieuxQR(60 * 60 * 24 * 7); // Indique le temps en secondes après lequel le code qr sera supprimé quand qq chargera la page
  $theme = "defaut"; // defaut ou parinux

  if ($theme == "defaut") {
    $couleurPrincipale = "#2D2F34";
  } else if ($theme == "parinux") {
    $couleurPrincipale = "#157097";
  }

  require("lessphp/lessc.inc.php");
  $less = new lessc;

?>

<!DOCTYPE HTML>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <title>Générateur de codes QR</title>
    <meta name="description" content="Générez des codes QR scannables avec ce générateur de codes QR"/>
    <link rel="icon" type="image/png" href="favicons/<?php echo $theme; ?>-16.png" sizes="16x16"/>
    <link rel="icon" type="image/png" href="favicons/<?php echo $theme; ?>-32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="favicons/<?php echo $theme; ?>-48.png" sizes="48x48"/>
    <link rel="icon" type="image/png" href="favicons/<?php echo $theme; ?>-64.png" sizes="64x64"/>
    <link rel="icon" type="image/png" href="favicons/<?php echo $theme; ?>-96.png" sizes="96x96"/>
    <link rel="icon" type="image/png" href="favicons/<?php echo $theme; ?>-128.png" sizes="128x128"/>
    <link rel="icon" type="image/png" href="favicons/<?php echo $theme; ?>-192.png" sizes="192x192"/>
    <link rel="icon" type="image/png" href="favicons/<?php echo $theme; ?>-256.png" sizes="256x256"/>
    <link rel="icon" type="image/png" href="favicons/<?php echo $theme; ?>-384.png" sizes="384x384"/>
    <link rel="icon" type="image/png" href="favicons/<?php echo $theme; ?>-512.png" sizes="512x512"/>
    <meta name="theme-color" content="<?php echo $couleurPrincipale; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    <?php echo $less->compileFile("themes/" . $theme . ".less"); ?>
    </style>
  </head>

  <body lang="fr">
    <header>
      <h1><a href=""><img id="logo" src="parinux.png" alt="Logo de Parinux"> Générateur de codes QR</a></h1>
    </header>

    <form method="post">

      <div class="param">
        <label for="texte">Texte à encoder</label>
        <br>
        <textarea rows="8" required="" id="texte" placeholder="Entrez le texte à encoder dans le code QR" name="texte"><?php

        if (isset($_POST['texte'])) {
            echo $_POST['texte'];
        }

         ?></textarea>
      </div>

      <div id="menusDeroulants">
        <div class="param">
          <label for="taille">Taille de l'image</label>
          <span class="conteneurAide">
            <img src="aide.svg" alt="Aide">
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
            <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 9)) {echo 'selected="" ';} ?>value="9">9</option>
            <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 10)) {echo 'selected="" ';} ?>value="10">10</option>
            <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 20)) {echo 'selected="" ';} ?>value="20">20</option>
          </select>
        </div>

        <div class="param">
          <label for="redondance">Taux de redondance</label>

               <span class="conteneurAide">
                 <img src="aide.svg" alt="Aide">
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
            <img src="aide.svg" alt="Aide">
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
      <br/>

      <div class="centrer">
        <input type="submit" value="Générer" />
      </div>
      <br/>
      <br/>


    </form>

<?php

  function generateRandomString($length) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }


  if (isset($_POST['texte']) and isset($_POST['taille']) and isset($_POST['redondance']) and isset($_POST['marge'])) {
    include "phpqrcode/qrlib.php";

    $cheminImage = "temp/" . generateRandomString(50) . ".png";

    QRcode::png($_POST['texte'], $cheminImage, $_POST['redondance'], $_POST['taille'], $_POST['marge']); ?>

    <div class="centrer">
      <a href="<?php echo $cheminImage; ?>" class="bouton" download="<?php echo $_POST['texte']; ?>.png">Télécharger ce code QR</a>
    </div>
    <br><br>
    <div class="centrer">
      <a href="<?php echo $cheminImage; ?>"><img id="codeQR" src="<?php echo $cheminImage; ?>"/></a>
    </div>
    <?php
  }
    ?>

    <footer>
      <a class="lienCodeSource" href="https://code.antopie.org/miraty/qr">Code source</a>
    </footer>

  </body>





  <?php

  function supprimerVieuxQR($tempsDeSuppression) {

    $listeCodesQR = new DirectoryIterator("temp");

    foreach($listeCodesQR as $listeCodesQR) {

      if ($listeCodesQR->getFilename() != "." AND $listeCodesQR->getFilename() != "..") {

        if ((time() - filemtime("temp/" . $listeCodesQR->getFilename())) > $tempsDeSuppression) {

          unlink("temp/" . $listeCodesQR->getFilename());

        }


      }




    }

  }


  ?>
