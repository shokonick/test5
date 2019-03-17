<?php
  require "options.inc.php";
 ?>
<?xml version="1.0" encoding="UTF-8" ?>
<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/">
  <ShortName>Générer un code QR</ShortName>
  <Description>Générez des codes QR depuis votre barre de recherche ou d'adresse</Description>
  <Image height="16" width="16" type="image/png"><?php echo $cheminInstall; ?>favicons/<?php echo $theme; ?>-16.png</Image>
  <Image height="32" width="32" type="image/png"><?php echo $cheminInstall; ?>favicons/<?php echo $theme; ?>-32.png</Image>
  <Image height="48" width="48" type="image/png"><?php echo $cheminInstall; ?>favicons/<?php echo $theme; ?>-48.png</Image>
  <Image height="64" width="64" type="image/png"><?php echo $cheminInstall; ?>favicons/<?php echo $theme; ?>-64.png</Image>
  <Image height="96" width="96" type="image/png"><?php echo $cheminInstall; ?>favicons/<?php echo $theme; ?>-96.png</Image>
  <Image height="128" width="128" type="image/png"><?php echo $cheminInstall; ?>favicons/<?php echo $theme; ?>-128.png</Image>
  <Image height="192" width="192" type="image/png"><?php echo $cheminInstall; ?>favicons/<?php echo $theme; ?>-192.png</Image>
  <Image height="256" width="256" type="image/png"><?php echo $cheminInstall; ?>favicons/<?php echo $theme; ?>-256.png</Image>
  <Image height="384" width="384" type="image/png"><?php echo $cheminInstall; ?>favicons/<?php echo $theme; ?>-384.png</Image>
  <Image height="512" width="512" type="image/png"><?php echo $cheminInstall; ?>favicons/<?php echo $theme; ?>-512.png</Image>
  <Language>fr</Language>
  <InputEncoding>UTF-8</InputEncoding>
  <Url type="text/html" template="<?php echo $cheminInstall; ?>?texte={searchTerms}"/>
</OpenSearchDescription>
