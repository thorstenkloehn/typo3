# TYPO3 CMS Basis-Distribution

Schnell mit TYPO3 CMS starten.

## Voraussetzungen

* PHP 8.2
* [Composer](https://getcomposer.org/download/)

## Schnellstart

* `composer create-project typo3/cms-base-distribution projekt-name ^13`
* `cd projekt-name`

Beachte, dass diese Distribution die meisten, aber nicht alle TYPO3 CMS Core-Erweiterungen installiert.
Je nach Bedarf möchtest du eventuell weitere TYPO3-Erweiterungen von
[packagist.org](https://packagist.org/?type=typo3-cms-framework) installieren.

### Einrichtung

Um eine interaktive Installation zu starten, führe folgenden Befehl aus und folge dem Assistenten:

```bash
composer exec typo3 setup
```

### Unbeaufsichtigte Einrichtung (optional)

Fortgeschrittene Nutzer können die unbeaufsichtigte Installation nutzen.
Führe dazu folgenden Befehl aus und passe die Argumente an deine Umgebung an.

```bash
export TYPO3_SETUP_ADMIN_PASSWORD=$(tr -dc "_A-Za-z0-9#=$()/" < /dev/urandom | head -c24)
composer exec -- typo3 setup \
    --no-interaction \
    --server-type=other \
    --driver=sqlite \
    --admin-username=admin \
    --admin-email="info@example.com" \
    --project-name="Mein TYPO3 Projekt" \
    --create-site="http://localhost:8000/"
echo "Admin-Passwort: ${TYPO3_SETUP_ADMIN_PASSWORD}"
```

### Entwicklungsserver

Es wird empfohlen, einen leistungsfähigeren Webserver wie
Apache 2 oder Nginx zu verwenden. Du kannst das Projekt aber auch direkt mit dem eingebauten
[Webserver](https://secure.php.net/manual/de/features.commandline.webserver.php) von PHP starten.

* `TYPO3_CONTEXT=Development php -S localhost:8000 -t public`
* Öffne deinen Browser unter "http://localhost:8000"

Beachte, dass der eingebaute Webserver nur einen Thread verwendet und ausschließlich für die Entwicklung gedacht ist.

## Nächste Schritte

* [Erste Schritte mit TYPO3](https://docs.typo3.org/permalink/t3start:start)
* [Ein Site-Paket erstellen](https://docs.typo3.org/permalink/t3sitepackage:start)

## Lizenz

GPL-2.0 oder neuer
