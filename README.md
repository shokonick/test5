# ![](themes/dark/icons/32.png) LibreQR

[Lire ceci en français](README_fr.md)

A PHP Web interface for generating QR codes.

## Demo

A LibreQR instance is available at <https://qr.antopie.org>.

## How it works

LibreQR includes an [OpenSearch](https://developer.mozilla.org/docs/Web/OpenSearch) plugin, which allows to add it as a search engine in Firefox and to save settings.
You can thus generate a QR code directly from your search bar with the LibreQR's settings used at the time of adding as search engine.

A [WebManifest](https://developer.mozilla.org/docs/Web/Manifest) is also included, which allows better system integration using  Fennec (Firefox Android) ou Chromium.

QR codes generated are located in the temp/ directory, named with the number of random characters set in config.inc.php (32 by default), and then deleted after the time set in config.inc.php (2 days by default).

See `config.inc.php` for more settings.

## Installation

### Generic

Just place this source code in a Web server with PHP.

`wget https://code.antopie.org/miraty/libreqr/archive/1.3.0.zip`

GD extension is required.

`apt install php7.3-gd`

LibreQR need writing rights on the `temp/` directory.

```
chown -R www-data:www-data /var/www/libreqr/temp
chmod -R 600 /var/www/libreqr/temp
```

### YunoHost

There is [a package](https://code.antopie.org/miraty/qr_ynh/) for [YunoHost](https://yunohost.org/).

For historical reasons, LibreQR is technically named `qr` in YunoHost.

You can install it from the WebAdmin or with this command :

```
sudo yunohost app install qr
```

## Themes

### Change theme

In config.inc.php, set $theme to the wanted theme.

By default, 3 themes are offered:

* dark, the default dark theme. Used here: <https://qr.antopie.org>
* light, the light theme.
* parinux, a blue theme, made for [Bastet](https://bastet.parinux.org), the [Parinux](https://parinux.org)'s CHATON. Used here: <https://codeqr.parinux.org>

### Make a theme

* Copy themes/dark to themes/[new theme's name]
* Fill theme.php according to CSS colors you want
* Change the source.png image according to your theme
* To automatically generate favicons with the rights sizes, use `php themes/resize.php [theme's name]`

This last step will need [ImageMagick](https://imagemagick.org) and [pngquant](https://pngquant.org) to be installed.

```apt install imagemagick pngquant```

## Contribute

If you want to report a bug, you can open an issue at <https://code.antopie.org/miraty/libreqr/issues> after creating an account (prefered method) or contact me in another way.

## Contact

If you want to contact me, for instance to report a bug or ask me a question about installing or using LibreQR, you can get my contact details on <https://miraty.antopie.org>.

## Libraries

This source code includes:

* [phpqrcode](https://github.com/t0k4rt/phpqrcode) to generate QR codes
* [less.php](https://github.com/wikimedia/less.php) to compile [Less](http://lesscss.org)

## License

[AGPLv3+](https://code.antopie.org/miraty/libreqr/src/branch/main/LICENSE)

LibreQR is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

LibreQR is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License along with this program. If not, see <https://www.gnu.org/licenses/>.
