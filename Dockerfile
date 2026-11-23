FROM httpd:2.4
COPY . /usr/local/apache2/htdocs/
EXPOSE 80
CMD composer install ; php artisan generate:key ; php artisan migrate ;  php artisan serve  
