-include .env
.PHONY: test seed setup bash up stop deploy exec

# the first target is the one that executed by default
# run all containers
up:
	@cd laradock && sudo docker-compose up -d --build --scale nginx=3

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
	@cd laradock && docker-compose exec --user=laradock workspace npm run watch

scout-import:
	@cd laradock && docker-compose exec --user=laradock workspace php artisan scout:import App\\Job

scout-flush:
	@cd laradock && docker-compose exec --user=laradock workspace php artisan scout:flush App\\Job

# stop all containers
down:
	@cd laradock && docker-compose down

deploy:
	@cd laradock && docker-compose exec --user=laradock workspace bash -c '~/.composer/vendor/bin/envoy run deploy'

# execute a command on the container
exec:
ifndef command
	$(error command is required)
endif
	@cd laradock && docker-compose exec --user=laradock workspace $(command)