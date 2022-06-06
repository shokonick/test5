<?php // This file is part of LibreQR, which is distributed under the GNU AGPLv3+ license
$loc = array(
	'subtitle' => "QR codes generator",
	'description' => "Generate QR codes freely. Choose content, size, colors…",

	'label_content' => "Text to encode",
	'label_redundancy' => "Redundancy rate",
	'label_margin' => "Margin size",
	'label_size' => "Image size",
	'label_bgColor' => "Background color",
	'label_fgColor' => "Foreground color",

	'placeholder' => "Enter the text to encode in the QR code",

	'help_content' => "
<p>You can encode whatever text you want.</p>
<p>Software which decodes these QR codes could suggest to open them with dedicated software, depending on their <a href='https://en.wikipedia.org/wiki/List_of_URI_schemes' hreflang='en' rel='help external noreferrer'>URI scheme</a>.</p>
<p>For instance, to open a webpage: <code>https://www.example/</code></p>
<p>To send an email: <code>mailto:contact@email.example</code></p>
<p>To share geographic coordinates: <code>geo:48.867564,2.364057</code></p>
",
	'help_redundancy' => "Redundancy is the duplication of information in the QR code to correct errors during decoding. A higher rate will produce a bigger QR code, but will have a better chance of being decoded correctly.",
	'help_margin' => "Number of pixels in each white band around the QR code.",
	'help_size' => "Image width and height in pixels, without the margin.",

	'button_create' => "Generate",
	'button_download' => "Save this QR code",

	'title_showOnlyQR' => "Show this QR code only",

	'alt_QR_before' => 'QR code meaning "',
	'alt_QR_after' => '"',

	'metaText_qr' => "
		<h3>What's a QR code?</h3>
		A QR code is a 2 dimensional barcode in which text is written in binary. It can be decoded with a device equipped with a photo sensor and an adequate software.
		<a href='https://en.wikipedia.org/wiki/QR_code' hreflang='en' rel='help external noreferrer'>QR code on Wikipedia</a>.
	",
	'metaText_legal' => "LibreQR " . LIBREQR_VERSION . " is a free software whose <a href='https://code.antopie.org/miraty/libreqr/' rel='external noreferrer'>source code</a> is available under the terms of the <abbr title='GNU Affero General Public License version 3 or any later version'><a href='LICENSE.html' hreflang='en' rel='license'>AGPLv3</a>+</abbr>.",

	'error_generation' => "An error occurred while generating the QR code. Try with different parameters.",
);
