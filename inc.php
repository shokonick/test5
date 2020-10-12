<?php // ----- This file is included everywhere -----

require "config.inc.php";

// Defines the locale used
if ($forceLocale == false) {
  $clientLocales = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
  $clientLocales = preg_replace("#[A-Z0-9]|q=|;|-|\.#", "", $clientLocales);
  $clientLocales = explode(',', $clientLocales);
  $availableLocales = array('fr', 'en', 'template');
  foreach ($clientLocales as $clientLocale) {
    if (in_array($clientLocale, $availableLocales)) {
      $locale = $clientLocale;
      break;
    }
  }
}
require "locales/" . $locale . ".php";

// Defines the root URL
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')
  $protocol = "https";
else
  $protocol = "http";
$rootPath = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$rootPath = preg_replace('#\?.*$#', '', $rootPath);
$rootPath = preg_replace('#(manifest|opensearch|index).php$#i', '', $rootPath);

require "themes/" . $theme . "/theme.php"; // Load theme

// Used to generate the filename of the QR code
function generateRandomString($length) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

// Deletes images in temp/ older than the specified time in seconds
function deleteOldQR($deleteAfter) {
  $files = array_diff(scandir("temp"), array('..', '.', '.gitkeep'));
  foreach($files as $file) {
    // If this actual time (in Posix time) less last modification image date is greater than time asked
    if ((time() - filemtime("temp/" . $file)) > $deleteAfter) {
      unlink("temp/" . $file); // Deletes this image
    }
  }
}
