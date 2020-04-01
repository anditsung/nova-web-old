# INSTALL NOVA TO LARAVEL
# add nova repositories to composer.json
composer config repositories.nova path nova
# add require laravel/nova to composer.json
composer require laravel/nova="*"
# update the composer with new config
composer update
# install nova
php artisan nova:install

# INSTALL NOVA-WEB TO LARAVEL
# add nova web repositories to composer.json
composer config repositories.nova-web path nova-web
# add require anditsung/nova-web to composer.json
composer require anditsung/nova-web="*"
# install nova-web
php artisan novaweb:install
