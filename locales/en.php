<?php
$loc = array(
  'subtitle' => "QR codes generator",
  'description' => "Generate QR codes freely. Choose content, size, colors...",

  'label_content' => "Text to encode",
  'label_redondancy' => "Redondancy rate",
  'label_margin' => "Margin size",
  'label_size' => "Image size",
  'label_bgColor' => "Background color",
  'label_mainColor' => "Foreground color",

  'placeholder' => "Enter the text to encode in the QR code",

  'value_default' => "default",

  'help_content' => "
    You can only encode whatever text you want.<br>
    Softwares which decode these QR codes could suggest to open them with dedicated software, depending on their <a href='https://en.wikipedia.org/wiki/List_of_URI_schemes'>URI scheme</a>.<br><br>
    For instance, to open a webpage:<br>
    https://www.domain.tld/<br><br>
    To send an email:<br>
    mailto:contact@domain.tld<br><br>
    To share geographic coordinates:<br>
    geo:48.867564,2.364057<br><br>
    To call a phone number:<br>
    tel:+33639981871
  ",
  'help_redondancy' => "Redundancy is the duplication of information in the QR code to correct errors during decoding. A higher rate will produce a bigger QR code, but will have a better chance of being decoded correctly.",
  'help_margin' => "Number of pixels in the white bands around the QR code.",
  'help_size' => "By how much will the dimensions of the image be multiplied?",

  'button_create' => "Generate",
  'button_download' => "Download this QR code",

  'title_showOnlyQR' => "Show this QR code only",

  'alt_help' => "Help",
  'alt_QR_before' => 'QR code meaning "',
  'alt_QR_after' => '"',

  'metaText_qr' => "
    <h3>What's a QR code?</h3>
    A QR code is a 2 dimensions barcode in which a text is written in binary. It can be decoded with a device equipped with a photo sensor and an adequate software.
    <a href='https://en.wikipedia.org/wiki/QR_code'>QR code on Wikipedia</a>
  ",
  'metaText_legal' => "LibreQR " . $libreqrVersion . " is a free software whose <a href='https://code.antopie.org/miraty/libreqr/'>source code</a> is available under the terms of the <abbr title='GNU Affero General Public License version 3 or any later version'><a href='LICENSE.html'>AGPLv3</a>+</abbr>.",

  'opensearch_description' => "Generate QR codes from your search or address bar",
  'opensearch_actionName' => "Generate QR codes from your search or address bar",
);
