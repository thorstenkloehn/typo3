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
sudo chown -R www-data:www-data /var/www/typo3
find typo3 -type d -exec chmod 755 {} \;
find typo3 -type f -exec chmod 644 {} \;

```

Erstelle die folgende nginx-Konfigurationsdatei:

```bash
sudo nano /etc/nginx/conf.d/typo3.conf
```

Folgende ein
```

server {
    listen 80;
    server_name typo3.localhost;
    root /var/www/typo3/public;

    index index.php index.html;

#    include /etc/nginx/conf.d/nginx.conf;

    location ~ \.js\.gzip$ {
        add_header Content-Encoding gzip;
        gzip off;
        types { text/javascript gzip; }
    }
    location ~ \.css\.gzip$ {
        add_header Content-Encoding gzip;
        gzip off;
        types { text/css gzip; }
    }

    # TYPO3 - Rule for versioned static files, configured through:
    # - $GLOBALS['TYPO3_CONF_VARS']['BE']['versionNumberInFilename']
    # - $GLOBALS['TYPO3_CONF_VARS']['FE']['versionNumberInFilename']
    if (!-e $request_filename) {
        rewrite ^/(.+)\.(\d+)\.(php|js|css|png|jpg|gif|gzip)$ /$1.$3 last;
    }

    # TYPO3 - Block access to composer files
    location ~* composer\.(?:json|lock) {
        deny all;
    }

    # TYPO3 - Block access to flexform files
    location ~* flexform[^.]*\.xml {
        deny all;
    }

    # TYPO3 - Block access to language files
    location ~* locallang[^.]*\.(?:xml|xlf)$ {
        deny all;
    }

    # TYPO3 - Block access to static typoscript files
    location ~* ext_conf_template\.txt|ext_typoscript_constants\.txt|ext_typoscript_setup\.txt {
        deny all;
    }

    # TYPO3 - Block access to miscellaneous protected files
    location ~* /.*\.(?:bak|co?nf|cfg|ya?ml|ts|typoscript|tsconfig|dist|fla|in[ci]|log|sh|sql|sqlite)$ {
        deny all;
    }

    # TYPO3 - Block access to recycler and temporary directories
    location ~ _(?:recycler|temp)_/ {
        deny all;
    }

    # TYPO3 - Block access to configuration files stored in fileadmin
    location ~ fileadmin/(?:templates)/.*\.(?:txt|ts|typoscript)$ {
        deny all;
    }

    # TYPO3 - Block access to libraries, source and temporary compiled data
    location ~ ^(?:vendor|typo3_src|typo3temp/var) {
        deny all;
    }

    # TYPO3 - Block access to protected extension directories
    location ~ (?:typo3conf/ext|typo3/sysext|typo3/ext)/[^/]+/(?:Configuration|Resources/Private|Tests?|Documentation|docs?)/ {
        deny all;
    }

    location / {
        try_files $uri $uri/ /index.php$is_args$args;
    }

    location = /typo3 {
        rewrite ^ /typo3/;
    }

    location /typo3/ {
        absolute_redirect off;
        try_files $uri /typo3/index.php$is_args$args;
    }

    location ~ [^/]\.php(/|$) {
        fastcgi_split_path_info ^(.+?\.php)(/.*)$;
        if (!-f $document_root$fastcgi_script_name) {
            return 404;
        }
        fastcgi_buffer_size 32k;
        fastcgi_buffers 8 16k;
        fastcgi_connect_timeout 240s;
        fastcgi_read_timeout 240s;
        fastcgi_send_timeout 240s;

        include              snippets/fastcgi-php.conf;
        fastcgi_pass         unix:/var/run/php/php8.4-fpm.sock;
    }
}
```

## Server übetragen




Um die TYPO3-Installation auf einen anderen Server zu übertragen, kannst du folgenden `rsync`-Befehl verwenden:

```bash
rsync -avz --exclude 'config/sites/' \
    --exclude 'config/system/' \
    --exclude 'var/' \
    --exclude '.git/' \
    --exclude '.gitignore' \
    --exclude 'composer.json' \
    --exclude 'composer.lock' \
    /var/www/typo3/ user@server:/var/www/typo3/
```

Passe `user@server` entsprechend deiner Zielumgebung an. Weitere Ausschlüsse können je nach Bedarf ergänzt werden, z.B. für temporäre Dateien oder Backups.
```

Erstelle die folgende nginx-Konfigurationsdatei:

```bash
sudo nano /etc/nginx/conf.d/typo3.conf
```

Folgende ein
```

server {
Listen 443 ssl http2;
listen [::]:443 ssl http2;
server_name typo3.ahrensburg.city;
ssl_certificate /etc/letsencrypt/live/ahrensburg.city/fullchain.pem;
ssl_certificate_key /etc/letsencrypt/live/ahrensburg.city/privkey.pem;
    server_name typo3.localhost;
    root /var/www/typo3/public;

    index index.php index.html;

#    include /etc/nginx/conf.d/nginx.conf;

    location ~ \.js\.gzip$ {
        add_header Content-Encoding gzip;
        gzip off;
        types { text/javascript gzip; }
    }
    location ~ \.css\.gzip$ {
        add_header Content-Encoding gzip;
        gzip off;
        types { text/css gzip; }
    }

    # TYPO3 - Rule for versioned static files, configured through:
    # - $GLOBALS['TYPO3_CONF_VARS']['BE']['versionNumberInFilename']
    # - $GLOBALS['TYPO3_CONF_VARS']['FE']['versionNumberInFilename']
    if (!-e $request_filename) {
        rewrite ^/(.+)\.(\d+)\.(php|js|css|png|jpg|gif|gzip)$ /$1.$3 last;
    }

    # TYPO3 - Block access to composer files
    location ~* composer\.(?:json|lock) {
        deny all;
    }

    # TYPO3 - Block access to flexform files
    location ~* flexform[^.]*\.xml {
        deny all;
    }

    # TYPO3 - Block access to language files
    location ~* locallang[^.]*\.(?:xml|xlf)$ {
        deny all;
    }

    # TYPO3 - Block access to static typoscript files
    location ~* ext_conf_template\.txt|ext_typoscript_constants\.txt|ext_typoscript_setup\.txt {
        deny all;
    }

    # TYPO3 - Block access to miscellaneous protected files
    location ~* /.*\.(?:bak|co?nf|cfg|ya?ml|ts|typoscript|tsconfig|dist|fla|in[ci]|log|sh|sql|sqlite)$ {
        deny all;
    }

    # TYPO3 - Block access to recycler and temporary directories
    location ~ _(?:recycler|temp)_/ {
        deny all;
    }

    # TYPO3 - Block access to configuration files stored in fileadmin
    location ~ fileadmin/(?:templates)/.*\.(?:txt|ts|typoscript)$ {
        deny all;
    }

    # TYPO3 - Block access to libraries, source and temporary compiled data
    location ~ ^(?:vendor|typo3_src|typo3temp/var) {
        deny all;
    }

    # TYPO3 - Block access to protected extension directories
    location ~ (?:typo3conf/ext|typo3/sysext|typo3/ext)/[^/]+/(?:Configuration|Resources/Private|Tests?|Documentation|docs?)/ {
        deny all;
    }

    location / {
        try_files $uri $uri/ /index.php$is_args$args;
    }

    location = /typo3 {
        rewrite ^ /typo3/;
    }

    location /typo3/ {
        absolute_redirect off;
        try_files $uri /typo3/index.php$is_args$args;
    }

    location ~ [^/]\.php(/|$) {
        fastcgi_split_path_info ^(.+?\.php)(/.*)$;
        if (!-f $document_root$fastcgi_script_name) {
            return 404;
        }
        fastcgi_buffer_size 32k;
        fastcgi_buffers 8 16k;
        fastcgi_connect_timeout 240s;
        fastcgi_read_timeout 240s;
        fastcgi_send_timeout 240s;

        include              snippets/fastcgi-php.conf;
        fastcgi_pass         unix:/var/run/php/php8.4-fpm.sock;
    }
}


