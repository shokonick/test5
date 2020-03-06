<?php

// ----- Paramètres -----

deleteOldQR(60 * 60 * 24 * 7); // Temps en secondes après lequel le code QR sera supprimé lors du chargement d'un page

$theme = "dark"; // dark, light ou parinux

$fileNameLenght = 32; // Longueur du nom du fichier du code QR

// ----- Trucs nécessaires partout -----

// Définit l'URL racine
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')
  $protocol = "https";
else
  $protocol = "http";
$instPath = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$instPath = preg_replace('#\?.*$#', '', $instPath);
$instPath = preg_replace('#(manifest|opensearch|index).php$#i', '', $instPath);

require "themes/" . $theme . "/theme.php"; // Charge le thème graphique

function generateRandomString($length) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function deleteOldQR($tempsDeSuppression) {
  /*
    Cette fonction supprime les fichiers (normalement des images de codes QR)
    dans temp/ plus vieux que le temps en seconde passé en argument
  */
  $listeCodesQR = new DirectoryIterator("temp");
  foreach($listeCodesQR as $listeCodesQR) {
    if ($listeCodesQR->getFilename() != "." AND $listeCodesQR->getFilename() != ".." AND $listeCodesQR->getFilename() != ".gitkeep") {
      if ((time() - filemtime("temp/" . $listeCodesQR->getFilename())) > $tempsDeSuppression) { // Si le temps actuel (en heure Posix) moins la date de dernière modification de l'image est supérieur à la durée de vie demandée de l'image
        unlink("temp/" . $listeCodesQR->getFilename()); // Alors supprimer cette image
      }
    }
  }
}
