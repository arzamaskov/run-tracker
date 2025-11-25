# Running Training Tracker Application

Полноценное приложение для отслеживания и анализа тренировок по бегу, построенное на Symfony (бэкенд) и Svelte (фронтенд).

## Структура проекта

```
run-tracker/
├── backend/                    # Symfony бэкенд
│   ├── config/                 # Конфигурационные файлы Symfony
│   ├── public/                 # Публичная директория (index.php)
│   ├── src/                    # Исходный код
│   │   ├── Identity/           # Bounded Context: Управление пользователями
│   │   │   ├── Domain/         # Доменный слой
│   │   │   │   ├── Entity/     # Entities
│   │   │   │   ├── ValueObject/# Value Objects
│   │   │   │   ├── Repository/ # Repository интерфейсы
│   │   │   │   └── Event/      # Domain Events
│   │   │   ├── Application/    # Слой приложения (CQRS)
│   │   │   │   ├── Command/    # Commands
│   │   │   │   ├── Query/      # Queries
│   │   │   │   └── Handler/    # Command/Query Handlers
│   │   │   └── Infrastructure/ # Инфраструктурный слой
│   │   │       ├── Persistence/# Doctrine implementations
│   │   │       └── Http/       # HTTP Controllers
│   │   └── Shared/             # Общий код
│   ├── tests/                  # PHPUnit тесты
│   └── var/                    # Временные файлы, кэш, логи
│
├── frontend/                   # Svelte фронтенд
│   ├── src/                    # Исходный код
│   │   ├── lib/                # Библиотеки и утилиты
│   │   ├── routes/             # SvelteKit маршруты
│   │   └── components/         # Переиспользуемые компоненты
│   ├── static/                 # Статические файлы
│   └── tests/                  # Тесты фронтенда
│
└── docker/                     # Docker конфигурация
    ├── nginx/                  # Nginx конфигурация
    ├── php/                    # PHP-FPM конфигурация
    └── postgres/               # PostgreSQL конфигурация
```

## Архитектурные принципы

### Hexagonal Architecture (Ports & Adapters)
- **Domain**: Бизнес-логика, независимая от инфраструктуры
- **Application**: Use Cases, Commands и Queries
- **Infrastructure**: Адаптеры для баз данных, API, и т.д.

### Domain-Driven Design (DDD)
- Организация по Bounded Contexts
- Использование Entities, Value Objects, Aggregates
- Domain Events для коммуникации между контекстами

### CQRS (Command Query Responsibility Segregation)
- Разделение команд (изменение состояния) и запросов (чтение данных)
- Command Handlers и Query Handlers

## Технологический стек

### Backend
- **Framework**: Symfony 7.x
- **Database**: PostgreSQL 16
- **ORM**: Doctrine
- **Testing**: PHPUnit
- **PHP**: 8.4 with Xdebug (dev)

### Frontend
- **Framework**: SvelteKit
- **Language**: TypeScript
- **Build Tool**: Vite
- **Package Manager**: pnpm

### DevOps
- **Containerization**: Docker & Docker Compose
- **Web Server**: Nginx with static caching
- **PHP**: PHP-FPM 8.4 (multi-stage builds)

## Начало работы

### Предварительные требования
- Docker & Docker Compose
- Make (для удобных команд)

### Быстрый старт

```bash
# Первоначальная настройка (один раз)
make setup

# Запуск в development режиме
make up

# Просмотр логов
make logs

# Остановка
make down
```

Все доступные команды: `make help`

**Endpoints**:
- Backend API: http://localhost:8000
- Frontend (Vite dev): http://localhost:5173
- PostgreSQL: localhost:5432

### Документация

- **[DEPLOYMENT.md](DEPLOYMENT.md)** - Deployment и Docker
- **[RELEASE.md](RELEASE.md)** - Процесс создания релизов
- **[Makefile](Makefile)** - Все доступные команды

## Тестирование

### Backend
```bash
make test
```

### Frontend
```bash
cd frontend
pnpm test
```

## Deployment

Production deployment автоматизирован через GitLab CI/CD.

Создайте тег и запустите release вручную через GitLab UI:
```bash
git tag v1.0.0
git push origin v1.0.0
# Затем в GitLab: Pipelines → выберите pipeline → нажмите "Play" на create-release
```

Подробности в [DEPLOYMENT.md](DEPLOYMENT.md)

## API Documentation

API документация будет доступна по адресу: `http://localhost:8000/api/doc`
