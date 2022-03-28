up:
	docker compose up -d
build:
	docker compose build --no-cache --force-rm
copy-env:
ifdef IP
	cp .env.example .env
ifeq ($(OS),Windows_NT)
	sed -i -e 's/127.0.0.1/$(IP)/g' .env
else
ifeq ($(shell uname),Linux)
	sed -i -e 's/127.0.0.1/$(IP)/g' .env
endif
ifeq ($(shell uname),Darwin)
	sed -i '' -e 's/127.0.0.1/$(IP)/g' .env
endif
endif
endif
create-project:
	@make copy-env
	@make build
	@make up
	docker compose exec app mkdir app-tmp
	docker compose exec app composer create-project --prefer-dist laravel/laravel app-tmp
	docker compose exec app mv app-tmp/* . --no-clobber
	docker compose exec app rm -rf app-tmp
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan storage:link
	docker compose exec app chmod -R 777 storage bootstrap/cache
	@make fresh
init:
	@make copy-env
	docker compose up -d --build
	@make composer-install
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan storage:link
	docker compose exec app chmod -R 777 storage bootstrap/cache
	@make fresh
remake:
	@make destroy
	@make init
stop:
	docker compose stop
down:
	docker compose down --remove-orphans
restart:
	@make down
	@make up
destroy:
	docker compose down --rmi all --volumes --remove-orphans
destroy-volumes:
	docker compose down --volumes --remove-orphans
ps:
	docker compose ps
logs:
	docker compose logs
logs-watch:
	docker compose logs --follow
log-web:
	docker compose logs web
log-web-watch:
	docker compose logs --follow web
log-app:
	docker compose logs app
log-app-watch:
	docker compose logs --follow app
log-db:
	docker compose logs db
log-db-watch:
	docker compose logs --follow db
web:
	docker compose exec web ash
ap:
	docker compose exec app bash
db:
	docker compose exec db bash

##### Composer #####
composer-install:
	docker compose exec app composer install
composer-update:
	docker compose exec app composer update

##### Laravelコマンド #####
# マイグレーションを適用
migrate:
	docker compose exec app php artisan migrate
# DB初期化
fresh:
	docker compose exec app php artisan migrate:fresh --seed
# 初期データ投入
seed:
	docker compose exec app php artisan make:seeder InitSeeder

###### デプロイコマンド #####
deploy:
	git log -1
	git pull
	@make migrate
	git log -1
