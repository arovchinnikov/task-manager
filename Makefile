name := task_manager

compose = docker-compose -f ./.dev/docker-compose.yml -p="$(name)"
app = $(compose) exec -T app

container:
	$(compose) exec app bash
up:
	$(compose) up -d
install: up
	cp -n $(CURDIR)/.env.example $(CURDIR)/.env
	$(app) composer install
	npm install
down:
	$(compose) down
destroy:
	$(compose) down -v
	docker image rm "$(name)_app" "$(name)_nginx" "$(name)_postgres"
