<?php

// Paramètres :
supprimerVieuxQR(60 * 60 * 24 * 7); // Indique le temps en secondes après lequel le code qr sera supprimé quand qq chargera la page
$theme = "defaut"; // defaut ou parinux
$cheminInstall = "https://example.org"; // L'adresse racine depuis laquelle le générateur sera accessible (avec le slash final)



if ($theme == "defaut") {
  $couleurPrincipale = "#2D2F34";
} else if ($theme == "parinux") {
  $couleurPrincipale = "#157097";
}

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
  $listeCodesQR = new DirectoryIterator("temp");
  foreach($listeCodesQR as $listeCodesQR) {
    if ($listeCodesQR->getFilename() != "." AND $listeCodesQR->getFilename() != "..") {
      if ((time() - filemtime("temp/" . $listeCodesQR->getFilename())) > $tempsDeSuppression) { // Si le temps actuel (en heure Posix) moins la date de dernière modification de l'image est supérieur à la durée de vie demandée de l'image
        unlink("temp/" . $listeCodesQR->getFilename()); // Alors supprimer cette image
      }
    }
  }
}


?>
