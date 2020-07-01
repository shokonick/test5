<?php

// ----- Settings -----
// ----- Paramètres -----

// EN: Time in seconds after which the QR code will be deleted when a page loads.
// Default: 60 * 60 * 24 * 7 (one week)
// FR : Temps en secondes après lequel le code QR sera supprimé lors du chargement d'un page.
// Par défaut : 60 * 60 * 24 * 7 (une semaine)
deleteOldQR(60 * 60 * 24 * 7);

// EN: Theme's name (must be in the themes directory)
// FR : Nom du thème (doit être dans le dossier themes)
$theme = "dark";

// EN: Language used if those wanted by the user are not available
// FR : Langue utilisée si celles demandées par l'utilisateurice ne sont pas disponibles
$locale = "fr"; // fr ou en

$fileNameLenght = 32; // Longueur du nom du fichier du code QR

//$additionalText = "This LibreQR instance is hosted by <a href='https://foo.bar'>foo</a>.";
