name := tasks

compose = docker-compose -f ./.dev/docker-compose.yml -p="$(name)"
app = $(compose) exec -T app

up:
	$(compose) up -d
install: up
	$(app) composer install
down:
	$(compose) down
destroy:
	$(compose) down -v
	docker image rm "$(name)_app" "$(name)_nginx" "$(name)_postgres"