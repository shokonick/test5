# ![Logo](favicons/defaut-32.png) Générateur de codes QR

## Présentation

Une interface Web pour générer des codes QR en PHP.

## Démo

Une instance de ce service est disponible à l'adresse [https://qr.antopie.org](https://qr.antopie.org).

## Installation

Je développe directement dans master, donc en production téléchargez plutôt une version stable dans [l'onglet Versions](https://code.antopie.org/miraty/qr/releases) ou avec le tag.

Placez ce code source dans un serveur Web avec PHP, tout simplement.

## Thèmes

### Changer de thème

Dans options.inc.php, donnez à $theme le nom du thème voulu.

Par défaut, deux thèmes sont proposés :

* defaut, le thème par défaut, sombre. Il est utilisé ici : <https://qr.antopie.org>
* parinux, un thème bleu, créé pour [Bastet](https://bastet.parinux.org/), le chaton de [Parinux](https://parinux.org/). Il est utilisé ici : <https://qrcode.parinux.org>

### Créer un thème

* Copiez themes/defaut vers themes/[nom de votre thème]
* Depuis ce nouveau dossier, créez les icônes dans favicons/[longueur du côté de l'icone].png
* Complétez theme.php en fonctions des favicons créees précédemment et des couleurs CSS voulues dans l'interface 

## Bibliothèques tierces

Ce code source inclus :

* [phpqrcode](https://github.com/t0k4rt/phpqrcode) pour générer les codes QR
* [La police Ubuntu packagée pour le Web](https://github.com/earaujoassis/ubuntu-fontface)
* [lessphp](http://leafo.net/lessphp) pour compiler le [Less](http://lesscss.org/)

## Licence

[AGPLv3+](https://code.antopie.org/miraty/qr/src/branch/master/LICENSE)

Ce générateur de codes QR est un logiciel libre ; vous pouvez le diffuser et le modifier suivant les termes de la GNU Affero General Public License telle que publiée par la Free Software Foundation ; soit la version 3 de cette licence, soit (à votre convenance) une version ultérieure.

Ce générateur de codes QR est diffusé dans l’espoir qu’il sera utile, mais SANS AUCUNE GARANTIE ; sans même une garantie implicite de COMMERCIALISATION ou d’ADÉQUATION À UN USAGE PARTICULIER. Voyez la GNU Affero General Public License pour plus de détails.

Vous devriez avoir reçu une copie de la GNU Affero General Public License avec ce code. Sinon, consultez <https://www.gnu.org/licenses/>
