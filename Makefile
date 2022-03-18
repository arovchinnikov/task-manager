name := task_manager

compose = docker-compose -f ./.dev/docker-compose.yml -p="$(name)"
app = $(compose) exec -T app
migration = $(app) vendor/bin/doctrine-migrations

container:
	$(compose) exec app bash
test:
	$(app) vendor/bin/phpunit tests/
cs:
	$(app) vendor/bin/phpcs -v
cs-fix:
	$(app) vendor/bin/phpcbf



up:
	$(compose) up -d
install: up
	$(app) composer install --dev
	$(migration) migrate -q
	npm install
update:
	$(app) composer update
	npm update
down:
	$(compose) down
destroy:
	$(compose) down -v
	docker image rm "$(name)_app" "$(name)_nginx" "$(name)_postgres"



migrate:
	$(migration) migrate
create-migration:
	$(migration) generate