<?php // This file is part of LibreQR, which is distributed under the GNU AGPLv3+ license
require "inc.php";
// EN: This file is used to inform users of the settings of your LibreQR instance. If you want to edit these settings, edit config.inc.php.
// FR : Ce fichier est utilisé pour informer les utilisateurices des paramètres de votre instance LibreQR. Si vous voulez modifier ces paramètres, modifiez config.inc.php.
?>
libreqrVersion: "<?= $libreqrVersion ?>"
timeBeforeDeletion: <?= $timeBeforeDeletion . "\n" ?>
theme: "<?= $theme ?>"
locale: "<?= $locale ?>"
forceLocale: "<?= $forceLocale ? 'true' : 'false' ?>"
fileNameLenght: <?= $fileNameLenght . "\n" ?>
