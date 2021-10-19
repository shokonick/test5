<?php require "inc.php"; ?>
<?xml version="1.0" encoding="UTF-8" ?>
<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/">
  <ShortName>LibreQR</ShortName>
  <Description><?= $loc['description'] ?></Description>
<?php
  foreach($themeDimensionsIcons as $dimIcon) {
    echo '  <Image height="' . $dimIcon . '" width="' . $dimIcon . '" type="image/png">' . $rootPath . 'themes/' . $theme . '/icons/' . $dimIcon . '.png</Image>' . "\n";
  } ?>
  <Language>*</Language>
  <InputEncoding>UTF-8</InputEncoding>
<?php
  $redondancy = htmlspecialchars((isset($_GET['redondancy'])) ? $_GET['redondancy'] : DEFAULT_REDONDANCY);
  $margin = htmlspecialchars((isset($_GET['margin'])) ? $_GET['margin'] : DEFAULT_MARGIN);
  $size = htmlspecialchars((isset($_GET['size'])) ? $_GET['size'] : DEFAULT_SIZE);
  $bgColor = htmlspecialchars(urlencode((isset($_GET['bgColor'])) ? $_GET['bgColor'] : "%23" . DEFAULT_BGCOLOR));
  $mainColor = htmlspecialchars(urlencode((isset($_GET['mainColor'])) ? $_GET['mainColor'] : "%23" . DEFAULT_MAINCOLOR));
?>
  <Url type="text/html" method="post" template="<?= $rootPath ?>">
    <Param name="txt" value="{searchTerms}"/>
    <Param name="redondancy" value="<?= $redondancy ?>"/>
    <Param name="margin" value="<?= $margin ?>"/>
    <Param name="size" value="<?= $size ?>"/>
    <Param name="bgColor" value="<?= $bgColor ?>"/>
    <Param name="mainColor" value="<?= $mainColor ?>"/>
  </Url>
  <Url type="application/opensearchdescription+xml" rel="self" template="<?= $rootPath ?>opensearch.php">
    <Param name="redondancy" value="<?= $redondancy ?>"/>
    <Param name="margin" value="<?= $margin ?>"/>
    <Param name="size" value="<?= $size ?>"/>
    <Param name="bgColor" value="<?= $bgColor ?>"/>
    <Param name="mainColor" value="<?= $mainColor ?>"/>
  </Url>
</OpenSearchDescription>
