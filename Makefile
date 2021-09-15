init: docker-down docker-build docker-up

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-build:
	docker-compose up --build -d

test:
	docker-compose exec api-php-cli vendor/bin/phpunit

queue:
	docker-compose exec api-php-cli php artisan queue:work

db-migrate:
	docker-compose exec api-php-cli php artisan migrate

db-migrate-seed:
	docker-compose exec api-php-cli php artisan migrate --seed

db-refresh:
	docker-compose exec api-php-cli php artisan migrate:refresh --seed

create-admin:
	docker-compose exec api-php-cli php artisan create:admin

npm-install:
	docker-compose exec frontend-nodejs npm install

npm-build:
	docker-compose exec frontend-nodejs npm run build