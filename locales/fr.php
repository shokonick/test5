<?php
$loc = array(
  'subtitle' => "Générateur de codes QR",
  'description' => "Générer des codes QR librement. Choix du contenu, de la taille, des couleurs…",

  'label_content' => "Texte à encoder",
  'label_redondancy' => "Taux de redondance",
  'label_margin' => "Taille de la marge",
  'label_size' => "Taille de l'image",
  'label_bgColor' => "Couleur de fond",
  'label_mainColor' => "Couleur de premier plan",

  'placeholder' => "Entrez le texte à encoder dans le code QR",

  'help_content' => "
    Vous pouvez encoder ce que vous voulez sous forme de texte.<br>
    Les logiciels qui décodent ces codes QR pourraient proposer de les ouvrir avec un logiciel dédié, en fonction de leur <a href='https://fr.wikipedia.org/wiki/Sch%C3%A9ma_d%27URI'>schéma d'URI</a>.<br><br>
    Par exemple, pour ouvrir une page Web :<br>
    https://www.example/<br><br>
    Pour envoyer un mail :<br>
    mailto:contact@email.example<br><br>
    Pour partager des coordonnées géographique :<br>
    geo:48.867564,2.364057
  ",
  'help_redondancy' => "La redondance est la duplication des informations dans le code QR afin de corriger les erreurs lors du décodage. Un taux plus élevé produira un code QR plus grand, mais aura plus de chance d'être décodé correctement.",
  'help_margin' => "Nombre de pixels des bandes blanches autour du code QR.",
  'help_size' => "Par combien les dimensions de l'image seront-elles multipliées ?",

  'button_create' => "Générer",
  'button_download' => "Télécharger ce code QR",

  'title_showOnlyQR' => "Afficher uniquement ce code QR",

  'alt_QR_before' => "Code QR signifiant « ",
  'alt_QR_after' => " »",

  'metaText_qr' => "
    <h3>Qu'est-ce qu'un code QR ?</h3>
    Un code QR est un code-barres en 2 dimensions dans lequel du texte est inscrit en binaire. Il peut être décodé avec un appareil muni d'un capteur photo et d'un logiciel adéquat.
    <a href='https://fr.wikipedia.org/wiki/Code_QR'>Code QR sur Wikipédia</a>.
  ",
  'metaText_legal' => "LibreQR " . $libreqrVersion . " est un logiciel libre dont le <a href='https://code.antopie.org/miraty/libreqr/'>code source</a> est disponible selon les termes de l'<abbr title='GNU Affero General Public License version 3 ou toute version ultérieure'><a href='LICENSE.html'>AGPLv3</a>+</abbr>.",

  'opensearch_description' => "Générez des codes QR depuis votre barre de recherche ou d'adresse",
);
