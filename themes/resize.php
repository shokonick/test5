<?php // This file is part of LibreQR, which is distributed under the GNU AGPLv3+ license

/*
  A small script that can be used to generate LibreQR's icons
*/

if (php_sapi_name() == "cli") {
  if (isset($argv[1])) {
    $done = array();
    $line = "";
    $theme = $argv[1];

    for ($pow = 0; $pow <= 3; $pow++) {
      for ($mult = 1; $mult <= 4; $mult++) {
        $size = $mult * 2**(4+$pow);
        if (!in_array($size, $done)) {
          shell_exec("convert themes/" . $theme . "/icons/source.png -scale " . $size . "x" . $size . " themes/" . $theme . "/icons/" . $size . ".png");
          shell_exec("pngquant -f themes/" . $theme . "/icons/" . $size . ".png --output themes/" . $theme . "/icons/" . $size . ".png");
          $done[] = $size;
        }
      }
    }

    foreach ($done as $done) {
      $line = $line . ", " . $done;
    }

    echo substr($line, 2) . "\n";

  } else {
    echo "Usage: php themes/resize.php <theme name>\n";
  }

} else {
  echo "Available only via CLI for security reasons. Use 'php themes/resize.php <theme name>'";
}
