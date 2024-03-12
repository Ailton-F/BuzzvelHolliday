setup:
	@make build
	@make up
	@make composer-update
build:
	docker-compose build --no-cache --force-rm
stop:
	docker-compose stop
up:
	docker-compose up -d
composer-update:
	docker exec buzzvel bash -c "composer update"
data:
	docker exec buzzvel bash -c "php artisan migrate"
	docker exec buzzvel bash -c "php artisan db:seed"
