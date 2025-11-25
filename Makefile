.PHONY: help up down build restart logs logs-backend logs-frontend ps \
        backend-install backend-update backend-migrate \
        test cache-clear db-create schema-update fixtures shell \
        frontend-install frontend-build frontend-dev frontend-check frontend-shell \
        pgsql db-dump db-restore \
        setup install clean prod-build prod-up status update check

# Цвета для вывода
GREEN  := \033[0;32m
YELLOW := \033[0;33m
NC     := \033[0m

help: ## Показать эту справку
	@echo "$(GREEN)=== Run Tracker - Команды разработки ===$(NC)"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  $(YELLOW)%-20s$(NC) %s\n", $$1, $$2}'

# ============================================
# Docker команды
# ============================================

up: ## Запустить все сервисы в development режиме
	docker-compose up -d
	@echo "$(GREEN)✓ Сервисы запущены$(NC)"
	@echo "  Backend:  http://localhost:8000"
	@echo "  Frontend: http://localhost:5173"

down: ## Остановить все сервисы
	docker-compose down
	@echo "$(GREEN)✓ Сервисы остановлены$(NC)"

build: ## Пересобрать Docker образы
	docker-compose build --no-cache
	@echo "$(GREEN)✓ Образы пересобраны$(NC)"

restart: down up ## Перезапустить все сервисы

logs: ## Показать логи всех сервисов
	docker-compose logs -f

logs-backend: ## Показать логи backend (PHP-FPM + Nginx)
	docker-compose logs -f php-fpm nginx

logs-frontend: ## Показать логи frontend
	docker-compose logs -f frontend

ps: ## Показать статус контейнеров
	docker-compose ps

# ============================================
# Backend команды
# ============================================

backend-install: ## Установить зависимости backend
	docker-compose exec php-fpm composer install
	@echo "$(GREEN)✓ Backend зависимости установлены$(NC)"

backend-update: ## Обновить зависимости backend
	docker-compose exec php-fpm composer update
	@echo "$(GREEN)✓ Backend зависимости обновлены$(NC)"

test: ## Запустить тесты backend
	docker-compose exec php-fpm php bin/phpunit
	@echo "$(GREEN)✓ Backend тесты выполнены$(NC)"

cache-clear: ## Очистить кэш Symfony
	docker-compose exec php-fpm php bin/console cache:clear
	@echo "$(GREEN)✓ Кэш очищен$(NC)"

backend-migrate: ## Выполнить миграции базы данных
	docker-compose exec php-fpm php bin/console doctrine:migrations:migrate --no-interaction
	@echo "$(GREEN)✓ Миграции выполнены$(NC)"

backend-migrate-test:
	docker compose exec -u 1000:1000 php-fpm php bin/console doctrine:migrations:migrate --no-interaction --env=test
	@echo "$(GREEN)✓ Миграции для тестовой базы данных выполнены$(NC)"

db-create: ## Создать базу данных
	docker-compose exec php-fpm php bin/console doctrine:database:create --if-not-exists
	@echo "$(GREEN)✓ База данных создана$(NC)"

schema-update: ## Обновить схему базы данных
	docker-compose exec php-fpm php bin/console doctrine:schema:update --force
	@echo "$(GREEN)✓ Схема обновлена$(NC)"

fixtures: ## Загрузить фикстуры
	docker-compose exec php-fpm php bin/console doctrine:fixtures:load --no-interaction
	@echo "$(GREEN)✓ Фикстуры загружены$(NC)"

shell: ## Войти в контейнер PHP-FPM
	docker-compose exec php-fpm sh

# ============================================
# Frontend команды
# ============================================

frontend-install: ## Установить зависимости frontend
	cd frontend && pnpm install
	@echo "$(GREEN)✓ Frontend зависимости установлены$(NC)"

frontend-build: ## Собрать production версию frontend
	cd frontend && pnpm build
	@echo "$(GREEN)✓ Frontend собран$(NC)"

frontend-dev: ## Запустить frontend dev server локально (вне Docker)
	cd frontend && pnpm dev

frontend-check: ## Проверить типы TypeScript
	cd frontend && pnpm check
	@echo "$(GREEN)✓ Типы проверены$(NC)"

frontend-shell: ## Войти в контейнер frontend
	docker-compose exec frontend sh

# ============================================
# Database команды
# ============================================

pgsql: ## Войти в PostgreSQL через psql
	docker-compose exec postgres psql -U app -d app

db-dump: ## Создать дамп базы данных
	docker-compose exec postgres pg_dump -U app app > backup_$$(date +%Y%m%d_%H%M%S).sql
	@echo "$(GREEN)✓ Дамп создан$(NC)"

db-restore: ## Восстановить базу из дампа (передать файл: make db-restore FILE=backup.sql)
	@if [ -z "$(FILE)" ]; then echo "$(YELLOW)Укажите файл: make db-restore FILE=backup.sql$(NC)"; exit 1; fi
	docker-compose exec -T postgres psql -U app -d app < $(FILE)
	@echo "$(GREEN)✓ База восстановлена$(NC)"

db-test-create: ## Создать тестовую базу данных
	@echo "$(GREEN)Создание тестовой базы данных...$(NC)"
	docker-compose exec -T postgres psql -U app -d postgres -c "CREATE DATABASE app_test;" || echo "База уже существует"
	@echo "$(GREEN)✅ Тестовая БД создана$(NC)"

# ============================================
# Общие команды
# ============================================

setup: ## Первоначальная настройка проекта
	@echo "$(GREEN)=== Настройка Run Tracker ===$(NC)"
	@if [ ! -f .env ]; then cp .env.example .env; echo "$(YELLOW)✓ .env создан из .env.example$(NC)"; fi
	docker-compose build
	docker-compose up -d
	@echo "$(YELLOW)Ожидание запуска PostgreSQL...$(NC)"
	sleep 5
	$(MAKE) backend-install
	$(MAKE) db-create
	$(MAKE) backend-migrate
	$(MAKE) frontend-install
	@echo "$(GREEN)"
	@echo "╔════════════════════════════════════════╗"
	@echo "║  ✓ Проект успешно настроен!           ║"
	@echo "║                                        ║"
	@echo "║  Backend:  http://localhost:8000       ║"
	@echo "║  Frontend: http://localhost:5173       ║"
	@echo "╚════════════════════════════════════════╝"
	@echo "$(NC)"

install: backend-install frontend-install ## Установить все зависимости

# test уже определен выше в секции Backend команды

clean: ## Очистить временные файлы и кэш
	docker-compose down -v
	rm -rf backend/var/cache/*
	rm -rf backend/var/log/*
	rm -rf frontend/.svelte-kit
	rm -rf frontend/build
	@echo "$(GREEN)✓ Проект очищен$(NC)"

prod-build: ## Собрать production версию
	@echo "$(GREEN)=== Сборка production версии ===$(NC)"
	$(MAKE) frontend-build
	@if [ ! -f .env.prod ]; then echo "$(YELLOW)⚠ .env.prod не найден, создайте его из .env.prod.example$(NC)"; exit 1; fi
	@echo "$(GREEN)✓ Production версия готова$(NC)"
	@echo "$(YELLOW)Для запуска:$(NC)"
	@echo "  1. cp .env.prod .env"
	@echo "  2. mv docker-compose.override.yml docker-compose.override.yml.disabled"
	@echo "  3. docker-compose up -d"

prod-up: ## Запустить в production режиме
	@if [ ! -f .env ]; then echo "$(YELLOW)⚠ Создайте .env из .env.prod.example$(NC)"; exit 1; fi
	@if [ -f docker-compose.override.yml ]; then \
		mv docker-compose.override.yml docker-compose.override.yml.disabled; \
		echo "$(YELLOW)✓ Dev override отключен$(NC)"; \
	fi
	docker-compose up -d
	@echo "$(GREEN)✓ Production сервисы запущены на http://localhost$(NC)"

# ============================================
# Дополнительные команды
# ============================================

status: ps ## Alias для ps

update: backend-update frontend-install ## Обновить все зависимости

check: ## Проверить состояние проекта
	@echo "$(GREEN)=== Проверка состояния ===$(NC)"
	@docker-compose ps
	@echo ""
	@echo "$(YELLOW)Backend endpoints:$(NC)"
	@curl -s -o /dev/null -w "  http://localhost:8000 - %{http_code}\n" http://localhost:8000 || echo "  Недоступен"
	@echo ""
	@echo "$(YELLOW)Frontend:$(NC)"
	@curl -s -o /dev/null -w "  http://localhost:5173 - %{http_code}\n" http://localhost:5173 || echo "  Недоступен"

# ============================================
# Качество кода
# ============================================

lint: ## Проверить код на соответствие стандартам (PHP CS Fixer)
	docker-compose exec php-fpm ./vendor/bin/php-cs-fixer fix --dry-run --diff --verbose

lint-fix: ## Автоматически исправить стиль кода (PHP CS Fixer)
	docker-compose exec php-fpm ./vendor/bin/php-cs-fixer fix

deptrac-layers: ## Проверить код на соответствие слоев архитектурным стандартам
	docker-compose exec php-fpm ./vendor/bin/deptrac --config-file=deptrac-layers.yaml

deptrac-modules: ## Проверить код на соответствие модулей архитектурным стандартам
	docker-compose exec php-fpm ./vendor/bin/deptrac --config-file=deptrac-modules.yaml

stan: ## Запустить статический анализ кода (PHPStan)
	docker-compose exec php-fpm ./vendor/bin/phpstan analyse src tests --memory-limit=2G

ci: lint deptrac-layers deptrac-modules stan test ## Комбо для локальной проверки перед git push