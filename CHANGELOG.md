# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/).

## Unreleased

### Added

* Indonesian localization
* Basque localization

### Changed

* Update dependencies

## 2.0.0 - 2022-06-07

### Added

* Occitan l10n (PR [#10](https://code.antopie.org/miraty/libreqr/pulls/10))
* Composer

### Changed

* Replace GET by POST for QR codes generation request (privacy enhancement)
* Output generated QR code with `data:` URI
* Change the QR code generation library
* Use less.php instead of lesserphp
* Use the prefers-color-scheme CSS feature to let the client choose its preferred theme (dark/light)

### Removed

* Ubuntu font (use system font instead)
* OpenSearch plugin (because LibreQR is not a search engine)
* WebManifest (because LibreQR is not a progressive web app)

## 1.3.0 - 2020-11-03

### Added

* i18n system
* English l10n
* Changelog

### Changed

* Use lesserphp instead of lessphp
* Move license info and "What's a QR code" at bottom of the page

## 1.2.0 - 2020-03-23

### Added

* Ability to chooses QR code colors

### Changed

* The software is now named LibreQR
* Parameters now uses GET instead of POST
* The OpenSearch plugin now generate QR codes with arguments used when added

## 1.1.0 - 2019-03-29

### Added

* OpenSearch
* WebManifest

### Changed

* Server-side LESS compilation
* Icons are now themed and in multiple dimensions

### Fixed

* Placeholder font

## 1.0.0 - 2019-02-13

Initial release
