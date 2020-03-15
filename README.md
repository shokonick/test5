# ![](themes/dark/icons/32.png) LibreQR

## Présentation

Une interface Web pour générer des codes QR en PHP.

## Démo

Une instance de ce service est disponible à l'adresse [https://qr.antopie.org](https://qr.antopie.org).

## Fonctionnement

LibreQR inclus un plugin [OpenSearch](https://developer.mozilla.org/docs/Web/OpenSearch), ce qui permet de l'ajouter comme moteur de recherche dans Firefox et de sauvegarder vos paramètres.
Vous pouvez ainsi générer un code QR directement depuis la barre de recherche avec les réglages de LibreQR utilisés lors de l'ajout comme moteur de recherche.

Un [WebManifest](https://developer.mozilla.org/docs/Web/Manifest) est également inclus, ce qui permet de mieux l'intégrer au système via Fennec (Firefox Android) ou Chromium.

## Installation

### Générique

Je développe directement dans master, donc en production téléchargez plutôt une version stable dans [l'onglet Versions](https://code.antopie.org/miraty/qr/releases).

Placez ce code source dans un serveur Web avec PHP, tout simplement.

### YunoHost

J'ai créé un [paquet](https://code.antopie.org/miraty/qr_ynh/) pour [YunoHost](https://yunohost.org/).

Vous pouvez l'installer depuis l'interface d'administration ou avec cette commande :

```
sudo yunohost app install https://code.antopie.org/miraty/qr_ynh/
```

## Thèmes

### Changer de thème

Dans config.inc.php, donnez à $theme le nom du thème voulu.

Par défaut, trois thèmes sont proposés :

* dark, le thème par défaut, sombre. Il est utilisé ici : <https://qr.antopie.org>
* light, thème clair
* parinux, un thème bleu, créé pour [Bastet](https://bastet.parinux.org/), le CHATON de [Parinux](https://parinux.org/). Il est utilisé ici : <https://codeqr.parinux.org>

### Créer un thème

* Copiez themes/dark vers themes/[nom de votre thème]
* Complétez theme.php en fonction des couleurs CSS voulues dans l'interface
* Modifiez l'image source.png en fonction de votre thème

* Pour générer automatiquement les icônes aux tailles correctes, utilisez

```
php themes/resize.php [nom de votre thème]
```

Cela nécessitera d'avoir installé [ImageMagick](https://imagemagick.org)  et
[pngquant](https://pngquant.org).

## Bibliothèques tierces

Ce code source inclus :

* [phpqrcode](https://github.com/t0k4rt/phpqrcode) pour générer les codes QR
* [La police Ubuntu packagée pour le Web](https://github.com/earaujoassis/ubuntu-fontface)
* [lessphp](http://leafo.net/lessphp) pour compiler le [Less](http://lesscss.org/)

## Licence

[AGPLv3+](https://code.antopie.org/miraty/qr/src/branch/master/LICENSE)

LibreQR est un logiciel libre ; vous pouvez le diffuser et le modifier suivant les termes de la GNU Affero General Public License telle que publiée par la Free Software Foundation ; soit la version 3 de cette licence, soit (à votre convenance) une version ultérieure.

LibreQR est diffusé dans l’espoir qu’il sera utile, mais SANS AUCUNE GARANTIE ; sans même une garantie implicite de COMMERCIALISATION ou d’ADÉQUATION À UN USAGE PARTICULIER. Voyez la GNU Affero General Public License pour plus de détails.

Vous devriez avoir reçu une copie de la GNU Affero General Public License avec ce code. Sinon, consultez <https://www.gnu.org/licenses/>
