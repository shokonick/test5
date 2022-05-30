# LibreQR

A PHP Web interface for generating QR codes.

## Demo

A LibreQR instance is available at <https://qr.antopie.org>.

## Installation

### Generic

Just place this source code in a Web server with PHP.

PHP extensions GD and iconv are required.

LibreQR need writing rights on the `css/` directory.

#### Security hardening

Your HTTP server can reply the following headers:
```
Content-Security-Policy: default-src 'none'; img-src 'self' data:; style-src 'self'; frame-ancestors 'none'; form-action 'self';
Referrer-Policy: no-referrer
```

### YunoHost

There is [a package](https://code.antopie.org/miraty/qr_ynh/) for [YunoHost](https://yunohost.org/).

For historical reasons, LibreQR is technically named `qr` in YunoHost.

You can install it from the WebAdmin or with this command :

```
sudo yunohost app install qr
```

## Themes

Themes are located in `themes/*`, the default theme is in `themes/libreqr/`.

You can customize your LibreQR instance look by changing the colors in `theme.php`, the logo in `logo.less` or the icons in `icons/<size>.png` (then list the sizes in `theme.php`).

## Contribute

If you want to report a bug, you can open an issue at <https://code.antopie.org/miraty/libreqr/issues> after creating an account (prefered method) or contact me in another way.

## Contact

If you want to contact me, for instance to report a bug or ask me a question about installing or using LibreQR, you can get my contact details on <https://miraty.antopie.org>.

## License

LibreQR is published under [AGPLv3+](https://code.antopie.org/miraty/libreqr/src/branch/main/LICENSE). Librairies located in the `vendor` subdirectory use their own licenses.

LibreQR is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

LibreQR is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License along with this program. If not, see <https://www.gnu.org/licenses/>.
