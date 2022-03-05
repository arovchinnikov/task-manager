name := task_manager

compose = docker-compose -f ./.dev/docker-compose.yml -p="$(name)"
app = $(compose) exec -T app

container:
	$(compose) exec app bash
up:
	$(compose) up -d
install: up
	$(app) composer install
down:
	$(compose) down
destroy:
	$(compose) down -v
	docker image rm "$(name)_app" "$(name)_nginx" "$(name)_postgres"
