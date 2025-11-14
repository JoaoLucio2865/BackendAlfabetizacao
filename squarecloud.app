[APPLICATION]
NAME=BackendAlfabetizacao
DESCRIPTION=API Laravel
SUBDOMAIN=backend-alfabetizacao
MAIN=public/index.php
START=composer install --no-dev --optimize-autoloader && php artisan serve --host=0.0.0.0 --port=$PORT
