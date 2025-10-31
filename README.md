# TYPO3 CMS 

Erstelle eine neue SQLite3-Datenbank mit PHP:

```bash
sudo apt-get install php-sqlite3
sudo systemctl restart nginx
```

Oder erstelle eine neue PostgreSQL-Datenbank:

```bash
sudo -u postgres -i
createdb -E UTF8 -O thorsten typo3
exit
```

## Herunterladen und Installieren

Lade das Repository herunter und installiere die Abhängigkeiten:

```bash
git clone https://github.com/thorstenkloehn/typo3.git
sudo chmod 777 -R typo3
cd typo3
composer install
```

Erstelle die folgende nginx-Konfigurationsdatei:

```bash
sudo nano /etc/nginx/conf.d/typo3
```

Folgende ein




