# Deployment Guide

Руководство по развертыванию Run Tracker в development и production окружениях.

---

## 🚀 Быстрый старт

### Development
```bash
make setup   # Первоначальная настройка (один раз)
make up      # Запуск всех сервисов
```

**Доступ:**
- Backend API: http://localhost:8000
- Frontend: http://localhost:5173
- PostgreSQL: localhost:5432

### Production
```bash
make prod-build  # Собрать production версию
make prod-up     # Запустить в production режиме
```

**Доступ:**
- Application: http://localhost (Nginx отдает frontend + API)

---

## 📁 Docker Compose структура

### Файлы
- **`docker-compose.yml`** - базовая конфигурация (dev + prod)
- **`docker-compose.override.yml`** - development дополнения (frontend dev server)
- **`.env`** - переменные окружения (контролирует поведение)

### Сервисы

| Сервис | Development | Production |
|--------|-------------|------------|
| **postgres** | Exposed :5432 | Internal only |
| **php-fpm** | Xdebug enabled | Optimized build |
| **nginx** | Port 8000, API only | Port 80, API + Frontend |
| **frontend** | Vite dev server :5173 | Static files в nginx |

---

## ⚙️ Конфигурация окружений

### Development (`.env`)
```env
BUILD_TARGET=development
APP_ENV=dev
APP_DEBUG=1

NGINX_PORT=8000
NGINX_CONFIG=default.conf
FRONTEND_BUILD_PATH=./frontend

POSTGRES_PASSWORD=app_password
XDEBUG_MODE=debug,develop,coverage
```

### Production (`.env.prod` → `.env`)
```env
BUILD_TARGET=production
APP_ENV=prod
APP_DEBUG=0

NGINX_PORT=80
NGINX_CONFIG=production.conf
FRONTEND_BUILD_PATH=./frontend/build

POSTGRES_PASSWORD=SECURE_PASSWORD_HERE
XDEBUG_MODE=off
```

---

## 🛠️ Основные команды (Makefile)

### Docker
```bash
make up              # Запустить сервисы
make down            # Остановить сервисы
make restart         # Перезапустить
make logs            # Просмотр логов
make ps              # Статус контейнеров
```

### Backend
```bash
make backend-install # Установить зависимости
make test            # Запустить тесты
make cache-clear     # Очистить кэш Symfony
make shell           # Войти в контейнер PHP
```

### Database
```bash
make db-create       # Создать БД
make backend-migrate # Выполнить миграции
make schema-update   # Обновить схему
make pgsql           # Подключиться к PostgreSQL
make db-dump         # Создать дамп
```

### Frontend
```bash
make frontend-install # Установить зависимости
make frontend-build   # Собрать production
make frontend-check   # Проверить типы
```

### Общие
```bash
make setup           # Первоначальная настройка проекта
make install         # Установить все зависимости
make clean           # Очистить временные файлы
make check           # Проверить состояние
```

---

## 🏗️ Production развертывание

### Локальный Production режим

```bash
# 1. Собрать frontend
make frontend-build

# 2. Настроить окружение
cp .env.prod.example .env
nano .env  # Установить production значения

# 3. Отключить dev override
mv docker-compose.override.yml docker-compose.override.yml.disabled

# 4. Запустить
docker-compose up -d
```

### Production на сервере

Deployment автоматизирован через **GitLab CI/CD pipeline**.

**Требования на сервере:**
- Docker & Docker Compose
- SSH доступ
- 2GB RAM минимум

**GitLab CI/CD Variables (Settings → CI/CD → Variables):**
- `GITLAB_TOKEN` - Personal Access Token с правами `api` (для создания releases)
- `DEPLOY_HOST` - IP/domain сервера
- `DEPLOY_USER` - SSH username
- `DEPLOY_KEY` - SSH private key (тип: File)
- `SLACK_WEBHOOK` - (опционально) для уведомлений

**Процесс deployment:**
1. Создайте тег (`v1.0.0`)
2. Push тега в GitLab
3. В pipeline вручную запустите job `create-release` (кнопка "Play")
4. CD pipeline автоматически:
   - ✅ Соберет Docker images с version tags
   - ✅ Соберет frontend production bundle
   - ✅ Создаст backup текущей версии
5. Вручную запустите `deploy-production` для deployment (кнопка "Play")
6. Deployment:
   - ✅ Развернет новую версию
   - ✅ Выполнит миграции БД
   - ✅ Проверит health check
   - ✅ Откатится при ошибке
   - ✅ Отправит уведомление в Slack

**Структура на сервере:**
```
/var/www/runtracker/
├── current -> releases/v1.0.0
├── releases/
│   ├── v1.0.0/
│   ├── v1.0.1/
│   └── v1.1.0/
└── backup-YYYYMMDD-HHMMSS/
```

---

## 🔄 CI/CD Pipeline

### Stages

GitLab CI/CD pipeline состоит из 5 стадий:

**1. Test** (автоматически на push/MR):
- ✅ Backend тесты (PHPUnit + PostgreSQL)
- ✅ Frontend тесты (type check, build)

**2. Quality** (автоматически на Merge Requests):
- ✅ Code quality (PHPStan, PHP CS Fixer, ESLint)
- ✅ Security audit (composer, pnpm)

**3. Build** (автоматически на main + tags):
- ✅ Docker images build (php-fpm, nginx)
- ✅ Push в GitLab Container Registry

**4. Release** (вручную для тегов):
- ⏸️ Создание GitHub release с changelog (кнопка "Play")
- ⏸️ Валидация формата тега
- ⏸️ Группировка коммитов по типам

**5. Deploy** (вручную для production):
- ⏸️ Deployment на production (кнопка "Play")
- ⏸️ Миграции БД
- ⏸️ Health check + auto-rollback

**Процесс релиза:**
```bash
# 1. Создать и push тег
git tag v1.0.0
git push origin v1.0.0

# 2. В GitLab UI: Pipelines → выбрать pipeline → нажать Play на create-release
# 3. После проверки release: нажать Play на deploy-production (если нужен deployment)
```

---

## 🏛️ Архитектура

### Development
```
┌─────────────────┐  ┌──────────────────┐
│ Vite :5173      │  │ Nginx :8000      │
│ Frontend Dev    │  │ Backend API      │
└─────────────────┘  └──────────────────┘
          ↓                   ↓
     ┌────────────────────────────┐
     │ PostgreSQL :5432           │
     └────────────────────────────┘
```

### Production
```
┌───────────────────────────────────────┐
│  Nginx :80                            │
│  ┌─────────────────────────────────┐  │
│  │ /        → Frontend (SPA)       │  │
│  │ /api/*   → PHP-FPM Backend      │  │
│  │ /bundles → Static assets        │  │
│  └─────────────────────────────────┘  │
└───────────────────────────────────────┘
                 ↓
     ┌────────────────────────┐
     │ PostgreSQL (internal)  │
     └────────────────────────┘
```

---

## 🔧 Troubleshooting

### Frontend 404 в production
```bash
# Проверить что build существует
ls -la frontend/build/

# Проверить nginx конфиг
docker-compose exec nginx cat /etc/nginx/conf.d/default.conf

# Логи nginx
make logs-backend
```

### API не работает
```bash
# Проверить логи PHP-FPM
docker-compose logs php-fpm

# Проверить роутинг Symfony
docker-compose exec php-fpm php bin/console debug:router
```

### База данных
```bash
# Проверить подключение
make pgsql

# Пересоздать БД
make clean
make db-create
make backend-migrate
```

### Очистка и перезапуск
```bash
# Полная очистка
make clean

# Пересоздание с нуля
make setup
```

---

## 📊 Мониторинг

### Логи
```bash
make logs              # Все сервисы
make logs-backend      # PHP-FPM + Nginx
make logs-frontend     # Frontend dev server
```

### Статус
```bash
make ps                # Docker контейнеры
make check             # Health check endpoints
```

### GitLab Pipelines
- **CI/CD → Pipelines** → pipeline runs
- Email уведомления при ошибках
- Slack notifications (если настроено)
- Job logs для debugging

---

## 🔐 Безопасность

### Production checklist
- ✅ Изменить `APP_SECRET`
- ✅ Установить secure `POSTGRES_PASSWORD`
- ✅ Отключить `APP_DEBUG=0`
- ✅ HTTPS через Let's Encrypt
- ✅ Firewall настроен
- ✅ Regular backups

### HTTPS setup (опционально)
```bash
# 1. Получить SSL сертификат
certbot certonly --standalone -d yourdomain.com

# 2. Добавить в docker-compose.yml
nginx:
  volumes:
    - /etc/letsencrypt:/etc/nginx/ssl:ro
  ports:
    - "443:443"

# 3. Обновить nginx конфиг с SSL
```

---

## 📚 Дополнительная документация

- [README.md](README.md) - Общая информация о проекте
- [RELEASE.md](RELEASE.md) - Процесс создания релизов
- [Makefile](Makefile) - Все доступные команды
