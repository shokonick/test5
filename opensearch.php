<?php require "config.inc.php"; ?>
<?xml version="1.0" encoding="UTF-8" ?>
<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/">
  <ShortName>Générer un code QR</ShortName>
  <Description>Générez des codes QR depuis votre barre de recherche ou d'adresse</Description>
<?php
  foreach($themeDimensionsIcons as $dimIcon) {
    echo '  <Image height="' . $dimIcon . '" width="' . $dimIcon . '" type="image/png">' . $instPath . 'themes/' . $theme . '/icons/' . $dimIcon . '.png</Image>' . "\n";
  } ?>
  <Language>fr</Language>
  <InputEncoding>UTF-8</InputEncoding>
  <Url type="text/html" template="<?php echo $instPath; ?>&#63;txt={searchTerms}&amp;redondancy=<?php if (isset($_GET['redondancy'])) { echo $_GET['redondancy']; } ?>&amp;margin=<?= $_GET['margin'] ?>&amp;size=<?= $_GET['size'] ?>&amp;bgColor=<?= urlencode($_GET['bgColor']) ?>&amp;mainColor=<?= urlencode($_GET['mainColor']) ?>"/>
  <Url type="application/opensearchdescription+xml" rel="self" template="<?php echo $instPath; ?>opensearch.php" />
</OpenSearchDescription>
