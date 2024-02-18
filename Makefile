php_container = docker compose exec php-fpm
mysql_container = docker compose exec mysql

init-project:
	@make up
	@make init

up:
	docker-compose up -d --build

init:
	@make composer-install
	${php_container} php artisan key:generate

composer-install:
	@${php_container} composer install

connect:
	@${php_container} bash

db-connect:
	@${mysql_container} bash

down:
	docker-compose down --remove-orphans

build:
	@docker compose build

stop:
	@docker compose stop

composer-update:
	@${php_container} composer update

cache-clear:
	@${php_container} ./artisan cache:clear
	@${php_container} ./artisan config:clear

db-migrate:
	@${php_container} php artisan migrate

db-seed:
	@${php_container} php artisan db:seed

db-migrate-fresh:
	@${php_container} php artisan migrate:fresh --seed

stop-all:
	docker ps -q | xargs docker kill
