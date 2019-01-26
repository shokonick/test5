
<!DOCTYPE HTML>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <title>Générateur de codes QR</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="description" content="Générateur de codes QR"/>
    <link rel="icon" type="image/png" href="favicon.png"/>
  </head>

  <body lang="fr">
    <form method="post" action="index.php">

      <div class="param">
        <label for="texte">Texte à encoder</label>
        <span class="conteneurAide">
          <img src="aide.svg" alt="Aide">
          <span class="contenuAide">Entrez le texte à encoder dans le code QR</span>
        </span>
        <br>
        <textarea rows="10" cols="35" required="" id="texte" placeholder="Entrez le texte à encoder dans le code QR" name="texte"><?php

        if (isset($_POST['texte'])) {
            echo $_POST['texte'];
        }

         ?></textarea>
      </div>


      <div class="param">
        <label for="taille">Taille de l'image</label>
        <span class="conteneurAide">
          <img src="aide.svg" alt="Aide">
          <span class="contenuAide">Par combien les dimensions de l'image seront-elles multipliées ?</span>
        </span>
        <br>
        <select id="taille" name="taille">
          <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 1)) {echo 'selected=""';} ?> value="1">1</option>
          <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 2)) {echo 'selected=""';} ?> value="2">2</option>
          <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 3)) {echo 'selected=""';} ?> value="3">3</option>
          <option <?php if ((isset($_POST['taille']) AND ($_POST['taille'] == 4)) OR (!isset($_POST['taille']))) {echo 'selected=""';} ?> value="4">4 - par défaut</option>
          <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 5)) {echo 'selected=""';} ?> value="5">5</option>
          <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 6)) {echo 'selected=""';} ?> value="6">6</option>
          <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 7)) {echo 'selected=""';} ?> value="7">7</option>
          <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 8)) {echo 'selected=""';} ?> value="8">8</option>
          <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 9)) {echo 'selected=""';} ?> value="9">9</option>
          <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 10)) {echo 'selected=""';} ?> value="10">10</option>
          <option <?php if (isset($_POST['taille']) AND ($_POST['taille'] == 20)) {echo 'selected=""';} ?> value="20">20</option>
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
          <option <?php if (isset($_POST['redondance']) AND ($_POST['redondance'] == "L")) {echo 'selected=""';} ?> value="L">L - 7% de redondance</option>
          <option <?php if (isset($_POST['redondance']) AND ($_POST['redondance'] == "M")) {echo 'selected=""';} ?> value="M">M - 15% de redondance</option>
          <option <?php if (isset($_POST['redondance']) AND ($_POST['redondance'] == "Q")) {echo 'selected=""';} ?> value="Q">Q - 25% de redondance</option>
          <option <?php if ((isset($_POST['redondance']) AND ($_POST['redondance'] == "H")) OR (!isset($_POST['redondance']))) {echo 'selected=""';} ?> value="H">H - 30% de redondance</option>
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
          <option value="0">0</option>
          <option value="1">1</option>
          <option selected="" value="2">2 - par défaut</option>
          <option value="3">3</option>
          <option value="5">5</option>
          <option value="10">10</option>

        </select>
      </div>

        <input type="submit" class="bouton" value="Générer" />



    </form>

<?php

  if (isset($_POST['texte']) and isset($_POST['taille']) and isset($_POST['redondance']) and isset($_POST['marge'])) {
      include "phpqrcode/qrlib.php";

      $cheminImage = "temp/" . $_POST['taille'] . $_POST['redondance'] . $_POST['marge'] . "-" . mt_rand(0, 10000000) . ".png";

      QRcode::png($_POST['texte'], $cheminImage, $_POST['redondance'], $_POST['taille'], $_POST['marge']); ?><a href="<?php echo $cheminImage; ?>" class="bouton" download="">Télécharger ce code QR</a>

    <br><br>
    <a href="<?php echo $cheminImage; ?>"><img src="<?php echo $cheminImage; ?>"/></a>


    <?php
  }
    ?>




  </body>
