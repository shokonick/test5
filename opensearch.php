<?php require "inc.php"; ?>
<?xml version="1.0" encoding="UTF-8" ?>
<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/">
  <ShortName>LibreQR</ShortName>
  <Description><?= $loc['opensearch_actionName'] ?></Description>
<?php
  foreach($themeDimensionsIcons as $dimIcon) {
    echo '  <Image height="' . $dimIcon . '" width="' . $dimIcon . '" type="image/png">' . $rootPath . 'themes/' . $theme . '/icons/' . $dimIcon . '.png</Image>' . "\n";
  } ?>
  <Language>*</Language>
  <InputEncoding>UTF-8</InputEncoding>
<?php
  $redondancy = htmlspecialchars((isset($_GET['redondancy'])) ? $_GET['redondancy'] : 'H');
  $margin = htmlspecialchars((isset($_GET['margin'])) ? $_GET['margin'] : '2');
  $size = htmlspecialchars((isset($_GET['size'])) ? $_GET['size'] : '4');
  $bgColor = htmlspecialchars(urlencode((isset($_GET['bgColor'])) ? $_GET['bgColor'] : '%23FFFFFF'));
  $mainColor = htmlspecialchars(urlencode((isset($_GET['mainColor'])) ? $_GET['mainColor'] : '%23000000'));
?>
  <Url type="text/html" template="<?= $rootPath; ?>">
    <Param name="txt" value="{searchTerms}"/>
    <Param name="redondancy" value="<?= $redondancy ?>"/>
    <Param name="margin" value="<?= $margin ?>"/>
    <Param name="size" value="<?= $size ?>"/>
    <Param name="bgColor" value="<?= $bgColor ?>"/>
    <Param name="mainColor" value="<?= $mainColor ?>"/>
  </Url>
  <Url type="application/opensearchdescription+xml" rel="self" template="<?= $rootPath; ?>opensearch.php">
    <Param name="redondancy" value="<?= $redondancy ?>"/>
    <Param name="margin" value="<?= $margin ?>"/>
    <Param name="size" value="<?= $size ?>"/>
    <Param name="bgColor" value="<?= $bgColor ?>"/>
    <Param name="mainColor" value="<?= $mainColor ?>"/>
  </Url>
</OpenSearchDescription>
