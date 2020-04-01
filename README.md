# Install NovaWeb To Laravel
this application require laravel version 6 and laravel nova version 2



### Install Laravel
* composer create-project laravel/larevel=^6 [PROJECT_NAME]


### Install Laravel Nova
* extract the application to project root folder and rename it to nova
* add laravel nova to composer repositories
> composer config repositories.nova path nova
* add laravel nova to composer.json 
> composer require laravel/nova="*"
* install nova to laravel 
> php artisan nova:install


### Install NovaWeb
* add nova-web to composer repositories
> composer config repositories.nova-web path nova-web
* add nova-web to composer.json
> composer require anditsung/nova-web="*"
* install nova-web
> php artisan novaweb:install
