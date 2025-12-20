# TYPO3 CMS Basis-Distribution

Schnell loslegen mit TYPO3 CMS.

## Voraussetzungen

* PHP 8.2
* [Composer](https://getcomposer.org/download/)

## Schnellstart

* `composer create-project typo3/cms-base-distribution projektname ^13`
* `cd projektname`

Beachte, dass diese Distribution die meisten, aber nicht alle TYPO3 CMS Core-Extensions installiert.
Je nach Bedarf möchtest du eventuell weitere TYPO3-Extensions von
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

Obwohl empfohlen wird, einen vollwertigen Webserver wie Apache 2 oder Nginx zu verwenden,
kannst du das Projekt sofort mit dem in PHP integrierten
[Webserver](https://secure.php.net/manual/de/features.commandline.webserver.php) starten.

* `TYPO3_CONTEXT=Development php -S localhost:8000 -t public`
* Öffne deinen Browser unter "http://localhost:8000"

Beachte, dass der eingebaute Webserver nur einen Thread nutzt und ausschließlich für die Entwicklung gedacht ist.

## Nächste Schritte

* [Erste Schritte mit TYPO3](https://docs.typo3.org/permalink/t3start:start)
* [Ein Site Package erstellen](https://docs.typo3.org/permalink/t3sitepackage:start)

## Lizenz

GPL-2.0 oder später

