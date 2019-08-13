<?php require "options.inc.php"; ?>
<?xml version="1.0" encoding="UTF-8" ?>
<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/">
  <ShortName>Générer un code QR</ShortName>
  <Description>Générez des codes QR depuis votre barre de recherche ou d'adresse</Description>
<?php
  foreach($themeDimensionsFavicons as $dimFav) {
    echo '  <Image height="' . $dimFav . '" width="' . $dimFav . '" type="image/png">' . $cheminInstall . 'themes/' . $theme . '/favicons/' . $dimFav . '.png</Image>' . "\n";
  }
  ?>
  <Language>fr</Language>
  <InputEncoding>UTF-8</InputEncoding>
  <Url type="text/html" template="<?php echo $cheminInstall; ?>?texte={searchTerms}"/>
  <Url type="application/opensearchdescription+xml" rel="self" template="<?php echo $cheminInstall; ?>opensearch.php" />
</OpenSearchDescription>
