<?php

// ----- Settings -----
// ----- Paramètres -----

// EN: Time in seconds after which the QR code will be deleted when a page loads.
// Default: 60 * 60 * 24 * 7 (one week)
// FR : Temps en secondes après lequel le code QR sera supprimé lors du chargement d'une page.
// Par défaut : 60 * 60 * 24 * 7 (une semaine)
$timeBeforeDeletion = 60 * 60 * 24 * 7;

// EN: Theme's name (must be in the themes directory)
// FR : Nom du thème (doit être dans le dossier themes)
$theme = "libreqr";

// EN: Language used if those requested by the user are not available
// FR : Langue utilisée si celles demandées par l'utilisateurice ne sont pas disponibles
$locale = "en";

// EN: Should the locales requested by the user be ignored?
// FR : Faut-il ignorer les langues demandées par l'utilisateurice ?
$forceLocale = false;

// EN: Lenght of the QR code filename
// FR : Longueur du nom du fichier du code QR
$fileNameLenght = 32;

// EN: Will be printed at the bottom of the interface
// FR : Sera affiché en bas de l'interface
$customTextEnabled = false;
$customText = "This LibreQR instance is hosted by <a href='https://foo.bar'>foo</a>.";
