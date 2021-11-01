# ![](themes/dark/icons/32.png) LibreQR

[Read this in english](README.md)

Une interface Web en PHP pour générer des codes QR.

## Démo

Une instance de LibreQR est disponible sur <https://qr.antopie.org>.

## Fonctionnement

LibreQR inclus un plugin [OpenSearch](https://developer.mozilla.org/docs/Web/OpenSearch), ce qui permet de l'ajouter comme moteur de recherche dans Firefox et de sauvegarder vos paramètres.
Vous pouvez ainsi générer un code QR directement depuis la barre de recherche avec les réglages de LibreQR utilisés lors de l'ajout comme moteur de recherche.

Un [WebManifest](https://developer.mozilla.org/docs/Web/Manifest) est également inclus, ce qui permet de mieux l'intégrer au système via Fennec (Firefox Android) ou Chromium.

Les codes QR générés sont placés dans le dossier temp/, nommés avec le nombre de caractères aléatoires indiqué dans config.inc.php (32 par défaut), puis supprimés après le temps indiqué dans config.inc.php (2 jours par défaut).

Voir `config.inc.php` pour plus de paramètres.

## Installation

### Générique

Placez simplement ce code source dans un serveur Web avec PHP.

`wget https://code.antopie.org/miraty/libreqr/archive/1.3.0.zip`

L'extension GD est requise.

`apt install php7.3-gd`

LibreQR a besoin des permissions d'écriture dans le dossier `temp/`.

```
chown -R www-data:www-data /var/www/libreqr/temp
chmod -R 600 /var/www/libreqr/temp
```

### YunoHost

Il y a [un paquet](https://code.antopie.org/miraty/qr_ynh/) pour [YunoHost](https://yunohost.org/).

Pour des raisons historiques, LibreQR est techniquement nommée `qr` dans YunoHost.

Vous pouvez l'installer depuis l'interface Web d'administration ou avec cette commande :

```
sudo yunohost app install qr
```

## Thèmes

### Changer de thème

Dans config.inc.php, donnez à $theme le nom du thème voulu.

Par défaut, trois thèmes sont proposés :

* dark, le thème par défaut, sombre. Il est utilisé ici : <https://qr.antopie.org>
* light, thème clair
* parinux, un thème bleu, créé pour [Bastet](https://bastet.parinux.org), le CHATON de [Parinux](https://parinux.org). Il est utilisé ici : <https://codeqr.parinux.org>

### Créer un thème

* Copiez themes/dark vers themes/[nom de votre thème]
* Complétez theme.php en fonction des couleurs CSS voulues dans l'interface
* Modifiez l'image source.png en fonction de votre thème
* Pour générer automatiquement les icônes aux tailles correctes, utilisez `php themes/resize.php [nom du thème]`

Cette dernière étape nécessite d'avoir installé [ImageMagick](https://imagemagick.org) et [pngquant](https://pngquant.org).

```apt install imagemagick pngquant```

## Contribuer

Si vous souhaitez rapporter un bug, vous pouvez ouvrir un ticket sur <https://code.antopie.org/miraty/libreqr/issues> après vous être créé un compte (méthode préférée) ou me contacter d'une autre manière.

## Contact

Si vous voulez me contacter, par exemple pour signaler un bug ou me poser une question sur l'installation ou l'utilisation de LibreQR, vous trouverez des moyens de me contacter sur <https://miraty.antopie.org>.

## Bibliothèques tierces

Ce code source inclus :

* [CodeItNow Barcode & QrCode Generator](https://github.com/codeitnowin/barcode-generator) pour générer les codes QR
* [less.php](https://github.com/wikimedia/less.php) pour compiler le [Less](http://lesscss.org)

## Licence

[AGPLv3+](https://code.antopie.org/miraty/libreqr/src/branch/main/LICENSE)

LibreQR est un logiciel libre ; vous pouvez le diffuser et le modifier suivant les termes de la GNU Affero General Public License telle que publiée par la Free Software Foundation ; soit la version 3 de cette licence, soit (à votre convenance) une version ultérieure.

LibreQR est diffusé dans l’espoir qu’il sera utile, mais SANS AUCUNE GARANTIE ; sans même une garantie implicite de COMMERCIALISATION ou d’ADÉQUATION À UN USAGE PARTICULIER. Voyez la GNU Affero General Public License pour plus de détails.

Vous devriez avoir reçu une copie de la GNU Affero General Public License avec ce code. Sinon, consultez <https://www.gnu.org/licenses/>
