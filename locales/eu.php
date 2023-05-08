<?php // This file is part of LibreQR, which is distributed under the GNU AGPLv3+ license
$loc = array(
	'subtitle' => "QR kode sortzailea",
	'description' => "Sortu QR kodeak nahieran. Aukeratu edukia, neurria, kolorea…",

	'label_content' => "Kodetzeko testua",
	'label_redundancy' => "Erredundantzia-tasa",
	'label_margin' => "Marjinaren tamaina",
	'label_size' => "Irudiaren neurria",
	'label_bgColor' => "Hondoaren kolorea",
	'label_fgColor' => "Kolore nagusia",

	'placeholder' => "Sartu QR kodean kodetzeko testua",

	'help_content' => "
<p>Nahi duzun testua kodetu dezakezu.</p>
<p>QR kode horiek deskodetzen dituen softwareak software dedikatuarekin irekitzea iradoki lezake, <a href='https://en.wikipedia.org/wiki/List_of_URI_schemes' hreflang='en' rel='help external noreferrer'>URI eskema</a>ren arabera.</p>
<p>Adibidez, webgune bat irekitzeko: <code>https://www.adibidea.eus/</code></p>
<p>ePosta bidaltzeko: <code>mailto:lur_axpe@adibidea.eus</code></p>
<p>Koordenatu geografikoak partekatzeko: <code>geo:42.895367,-2.167805</code></p>",
	'help_redundancy' => "Erredundantzia QR kodearen informazioa bikoiztean datza, deskodetzean akatsak zuzentzeko. Tasa altuagoak QR kode handiagoa sortuko du, baina behar bezala deskodetzeko aukera handiagoa izango du.
",
	'help_margin' => "QR kodearen inguruko banda zuriaren pixel kopurua.",
	'help_size' => "Irudiaren zabalera eta altuera pixeletan, marjinarik gabe.",

	'button_create' => "Sortu",
	'button_download' => "Gorde QR kodea",

	'title_showOnlyQR' => "Erakutsi QR kode hau bakarrik",

	'alt_QR_before' => 'QR kodearen esanahia "',
	'alt_QR_after' => '"',

	'metaText_qr' => "
		<h3>Zer da QR kode bat?</h3>
		QR kodea bi dimentsioko barra-kodea da, testua bitarrean idatzita duena. Argazki-sentsore bat eta software egokia dituen gailu batekin deskodetzen da.
		<a href='https://eu.wikipedia.org/wiki/QR_kode' hreflang='eu' rel='help external noreferrer'>QR kodea Wikipedian</a>.
	",
	'metaText_legal' => "LibreQR " . LIBREQR_VERSION . " software librea da, eta <a href='https://code.antopie.org/miraty/libreqr/' rel='external noreferrer'>iturburu-kodea</a> <abbr title='GNU Affero Lizentzia Publiko Orokorraren 3. bertsioaren edo ondorengo edozein bertsio'><a href='LICENSE.html' hreflang='en' rel='license'>AGPLv3</a>+</abbr>ren arabera dago eskuragarri.",

	'error_generation' => "Errorea gertatu da QR kodea sortzerakoan. Saiatu berriro parametro desberdinak erabiliz.",
);