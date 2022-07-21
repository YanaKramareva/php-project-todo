start:
	php artisan serve --host 0.0.0.0

setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate
	php artisan migrate:fresh --seed
	npm ci

watch:
	npm run watch

migrate:
	php artisan migrate

console:
	php artisan tinker

log:
	tail -f storage/logs/laravel.log

test:
	composer exec --verbose phpunit tests

deploy:
	git push heroku

lint:
	composer exec phpcs -- --standard=PSR12 app routes tests

lint-fix:
	composer exec phpcbf -- --standard=PSR12 app routes tests database

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

install:
	composer install

validate:
	composer validate

db-prepare:
	php artisan migrate:fresh --seed
