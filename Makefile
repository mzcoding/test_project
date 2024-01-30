compose-build:
	docker-compose up --build keepcode-nginx -d

compose-start:
	docker-compose up

compose-stop:
	docker-compose down

compose-bash:
	docker-compose exec keepcode-php /bin/sh

compose-migrate:
	docker-compose exec keepcode-php /bin/sh -c "php artisan migrate"

compose-seed:
	docker-compose exec keepcode-php /bin/sh -c "php artisan db:seed"

compose-test:
	docker-compose exec keepcode-php /bin/sh -c "php artisan test"

compose-dep-install:
	docker-compose exec -it keepcode-php /bin/sh -c "composer install"

compose-dep-update:
	docker-compose exec -it keepcode-php /bin/sh -c "composer update"

compose-key-generate:
	docker-compose exec -it keepcode-php /bin/sh -c "php artisan key:generate"

compose-env:
	docker-compose exec -it keepcode-php /bin/sh -c "cp ./.env.example ./.env"

compose-pint:
	docker-compose exec -it keepcode-php /bin/sh -c "./vendor/bin/pint"

compose-swagger:
	docker-compose exec -it keepcode-php /bin/sh -c "php artisan l5-swagger:generate"
