# Server voorbereieden
- LAMP Stack aanmaken (Linux, Apache2, MySQL, PHP)
- Sox installeren (```apt install sox```)
- PHP Modules installeren (```php7.0-mysql```, ```php7.0-intl```, ```php7.0-mbstring```)
- Composer installeren (```apt install composer```)
- Database aanmaken 

# App installeren
- Broncode ophalen (```wget https://github.com/rmens/regio/archive/master.zip```)
- Uitpakken in dir (voorbeeld: ```/var/www/regio/```)
- Config invullen (```/config/app.default.php``` opslaan als ```/config/app.php```)
- Composer draaien in uitgepakte dir (```composer install```)
- Database patchen in uitgepakte dir (```./bin/cake migrations migrate```)
