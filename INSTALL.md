# Server voorbereieden
- LAMP Stack aanmaken (Linux, Apache2, MySQL, PHP)
- Sox en ffmpeg installeren (```apt install sox ffmpeg```)
- PHP Modules installeren (```php7.0-mysql```, ```php7.0-intl```, ```php7.0-mbstring```)
- Composer installeren (```apt install composer```)
- Database aanmaken 

# App installeren
- Broncode ophalen (```wget https://github.com/rmens/regio/archive/master.zip```)
- Uitpakken in dir (voorbeeld: ```/var/www/regio/```)
- Config invullen (```/config/app.default.php``` opslaan als ```/config/app.php```)
- Composer draaien in uitgepakte dir (```composer install```)
- Database patchen in uitgepakte dir (```./bin/cake migrations migrate```)
- Uploads directory maken (```mkdir /var/www/regio/uploads/```)
- Uploads directory ```chmod 777``` geven en chownen op ```www-data:www-data```

# Webserver configureren
- Nieuwe vhost aanmaken en die de webroot ```/var/www/regio/webroot/``` geven
- Gemaakte vhost enablen (```a2ensite 001-regio.conf```)
- Rewrite module aanzetten (```a2enmod rewrite```)
- PHP settings aanpassen: ```upload_max_filesize = 1000M;``` en ```post_max_size = 1000M;```

# Voorbeeld virtualhost
```
<VirtualHost *:80>
	ServerName zuidwestupdate.nl
	ServerAlias www.zuidwestupdate.nl
	ServerAdmin info@zuidwestfm.nl
	DocumentRoot /var/www/regio/webroot

	LogLevel warn
	ErrorLog ${APACHE_LOG_DIR}/regio.error.log
	CustomLog ${APACHE_LOG_DIR}/regio.access.log combined

       <Directory />
           Options FollowSymLinks
           AllowOverride All
       </Directory>

       <Directory /var/www>
           Options Indexes FollowSymLinks MultiViews
           AllowOverride All
           Order Allow,Deny
           Allow from all
        </Directory>
</VirtualHost>
```

# Cron voor cleaning aanmaken
Om oude berichten automatisch op te ruimen, dient een cronjob ingesteld te worden. Je kunt zelf de frequentie bepalen. Voeg dit op bijvoorbeeld Debian aan ```/etc/cron.daily``` toe: ```/var/www/regio/bin/cake prune```
