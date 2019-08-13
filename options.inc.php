<?php

// ----- Paramètres -----
supprimerVieuxQR(60 * 60 * 24 * 7); // Indique le temps en secondes après lequel le code qr sera supprimé quand quelqu'un chargera la page
$theme = "defaut"; // defaut ou parinux
$env = "dev"; // dev ou prod

// ----- Trucs nécessaires partout -----

{ // Définit l'URL racine
  if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    $protocole = "https://";
  } else {
    $protocole = "http://";
  }

  $cheminInstall = $protocole . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; // L'adresse racine complète depuis laquelle le générateur sera accessible (avec le slash final)


  $cheminInstall = preg_replace('#(manifest|opensearch|index).php$#i', '', $cheminInstall);
  $cheminInstall = preg_replace('#\?.*$#', '', $cheminInstall);
}

require "lessphp/lessc.inc.php";
$less = new lessc;
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

function supprimerVieuxQR($tempsDeSuppression) {
  /*
    Cette fonction supprime les fichiers (normalement des images de codes QR) dans temp/ plus vieux que le temps en seconde passé en argument
  */
  $listeCodesQR = new DirectoryIterator("temp");
  foreach($listeCodesQR as $listeCodesQR) {
    if ($listeCodesQR->getFilename() != "." AND $listeCodesQR->getFilename() != ".." AND $listeCodesQR->getFilename() != "UoD3X0SUSLDF4K8V67igQozAaw7fOTStC8IO5gcMLd3OyW1r0b.png") {
      if ((time() - filemtime("temp/" . $listeCodesQR->getFilename())) > $tempsDeSuppression) { // Si le temps actuel (en heure Posix) moins la date de dernière modification de l'image est supérieur à la durée de vie demandée de l'image
        unlink("temp/" . $listeCodesQR->getFilename()); // Alors supprimer cette image
      }
    }
  }
}


?>
