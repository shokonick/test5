<?php // This file is part of LibreQR, which is distributed under the GNU AGPLv3+ license
$loc = array(
	'subtitle' => "Générer des codes QR",
	'description' => "Générer des codes QR librement. Choix du contenu, de la taille, des couleurs…",

	'label_content' => "Texte à encoder",
	'label_redundancy' => "Taux de redondance",
	'label_margin' => "Taille de la marge",
	'label_size' => "Taille de l'image",
	'label_bgColor' => "Couleur de fond",
	'label_fgColor' => "Couleur de premier plan",

	'placeholder' => "Entrez le texte à encoder dans le code QR",

	'help_content' => "
<p>Vous pouvez encoder ce que vous voulez sous forme de texte.</p>
<p>Les logiciels qui décodent ces codes QR pourraient proposer de les ouvrir avec un logiciel dédié, en fonction de leur <a href='https://fr.wikipedia.org/wiki/Sch%C3%A9ma_d%27URI' hreflang='fr' rel='help external noreferrer'>schéma d'URI</a>.</p>
<p>Par exemple, pour ouvrir une page Web : <code>https://www.example/</code></p>
<p>Pour envoyer un mail : <code>mailto:contact@email.example</code></p>
<p>Pour partager des coordonnées géographique : <code>geo:48.867564,2.364057</code></p>
",
	'help_redundancy' => "La redondance est la duplication des informations dans le code QR afin de corriger les erreurs lors du décodage. Un taux plus élevé produira un code QR plus grand, mais aura plus de chance d'être décodé correctement.",
	'help_margin' => "Nombre de pixels de chaque bande blanche autour du code QR.",
	'help_size' => "Largeur et hauteur de l'image en pixels, sans la marge.",

	'button_create' => "Générer",
	'button_download' => "Enregistrer ce code QR",

	'title_showOnlyQR' => "Afficher uniquement ce code QR",

	'alt_QR_before' => "Code QR signifiant « ",
	'alt_QR_after' => " »",

	'metaText_qr' => "
		<h3>Qu'est-ce qu'un code QR ?</h3>
		Un code QR est un code-barres en 2 dimensions dans lequel du texte est inscrit en binaire. Il peut être décodé avec un appareil muni d'un capteur photo et d'un logiciel adéquat.
		<a href='https://fr.wikipedia.org/wiki/Code_QR' hreflang='fr' rel='help external noreferrer'>Code QR sur Wikipédia</a>.
	",
	'metaText_legal' => "LibreQR " . LIBREQR_VERSION . " est un logiciel libre dont le <a href='https://code.antopie.org/miraty/libreqr/' rel='external noreferrer'>code source</a> est disponible selon les termes de l'<abbr title='GNU Affero General Public License version 3 ou toute version ultérieure'><a href='LICENSE.html' hreflang='en' rel='license'>AGPLv3</a>+</abbr>.",

	'error_generation' => "Une erreur a eu lieu lors de la génération du code QR. Essayez avec des paramètres différents.",
);
