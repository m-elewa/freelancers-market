#!/bin/bash

-include .env

test-database: .env
	@cd laradock && docker-compose exec mysql mysql -u$(DB_USERNAME) -p$(DB_PASSWORD) -e \
		'CREATE DATABASE IF NOT EXISTS `test` CHARACTER SET utf8 COLLATE utf8_general_ci'

test:
	@cd laradock && docker-compose exec --user=laradock workspace php artisan test

seed:
	@cd laradock && docker-compose exec --user=laradock workspace php artisan migrate:fresh --seed

setup:
	@cd laradock && docker-compose exec --user=laradock workspace composer setup

bash:
	@cd laradock && docker-compose exec --user=laradock workspace bash

npm-watch:
	@cd laradock && docker-compose exec --user=laradock workspace bash -c 'npm run watch'

scout-import:
	@cd laradock && docker-compose exec --user=laradock workspace php artisan scout:import App\\Job

scout-flush:
	@cd laradock && docker-compose exec --user=laradock workspace php artisan scout:flush App\\Job

docker-up:
	@cd laradock && docker-compose up -d --build --scale nginx=3 nginx mysql phpmyadmin workspace portainer redis laravel-horizon laravel-echo-server traefik ide-theia

docker-stop:
	@cd laradock && docker-compose stop

deploy:
	@cd laradock && docker-compose exec --user=laradock workspace bash -c '~/.composer/vendor/bin/envoy run deploy'