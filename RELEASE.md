# Release Process

## 🚀 Создание релиза

### Быстрый способ (рекомендуется)

```bash
git tag v1.0.0 && git push origin v1.0.0
```

**Автоматически происходит:**
1. ✅ Генерация changelog из git commits
2. ✅ Создание GitHub Release
3. ✅ Сборка production Docker images
4. ✅ Деплой в production

### Формат тегов

✅ **Правильно:**
- `v1.0.0` - production release
- `v1.2.3` - production release
- `v2.0.0-beta.1` - pre-release (НЕ деплоится автоматически)
- `v1.0.0-rc.1` - release candidate (НЕ деплоится автоматически)

❌ **Неправильно:**
- `1.0.0` (нет префикса `v`)
- `v1.0` (нет patch версии)

---

## 📝 Semantic Versioning

Формат: `vMAJOR.MINOR.PATCH`

- **MAJOR** (v2.0.0): Breaking changes
- **MINOR** (v1.1.0): New features, backwards compatible
- **PATCH** (v1.0.1): Bug fixes

**Примеры:**
- `v1.0.0` → Первый релиз
- `v1.1.0` → Добавлена новая функция
- `v1.1.1` → Исправлен баг
- `v2.0.0` → Breaking changes в API

---

## 🎨 Commit Convention

Для красивого автоматического changelog используйте префиксы:

```bash
git commit -m "feat: добавлена аутентификация"      # → ✨ Features
git commit -m "fix: исправлена ошибка входа"        # → 🐛 Bug Fixes
git commit -m "docs: обновлена документация"        # → 📚 Documentation
git commit -m "chore: обновлены зависимости"        # → 🔧 Other Changes
```

**Группировка в changelog:**
- `feat:`, `feature:` → **✨ Features**
- `fix:` → **🐛 Bug Fixes**
- `docs:` → **📚 Documentation**
- остальные → **🔧 Other Changes**

---

## 🔥 Hotfix процесс

```bash
# 1. Создать hotfix ветку от main
git checkout main
git checkout -b hotfix/v1.0.1

# 2. Исправить, закоммитить, протестировать
git commit -m "fix: критический баг"
git push origin hotfix/v1.0.1

# 3. Создать PR и смержить в main (или напрямую если критично)
git checkout main
git merge hotfix/v1.0.1
git push origin main

# 4. Создать hotfix release
git tag v1.0.1 && git push origin v1.0.1

# 5. Удалить hotfix ветку
git branch -d hotfix/v1.0.1
git push origin --delete hotfix/v1.0.1
```

---

## 🧪 Pre-release / Beta

```bash
git tag v1.1.0-beta.1 && git push origin v1.1.0-beta.1
```

✅ Автоматически создаёт release, помеченный как **pre-release**  
⚠️ **НЕ деплоится** автоматически в production

---

## ❌ Удаление релиза

Если создали тег по ошибке:

```bash
# Удалить release и тег одной командой
gh release delete v1.0.0 --yes && git push origin --delete v1.0.0 && git tag -d v1.0.0
```

Или пошагово:

```bash
gh release delete v1.0.0 --yes    # Удалить GitHub release
git push origin --delete v1.0.0   # Удалить remote tag
git tag -d v1.0.0                 # Удалить local tag
```

---

## 🔄 Rollback

### Автоматический

При ошибке health check происходит автоматический откат к предыдущей версии.

### Ручной откат

```bash
ssh user@production-server

cd /var/www/runtracker
ls releases/  # Посмотреть доступные версии

# Переключиться на предыдущую версию
ln -sfn releases/v1.0.0 current
cd current
docker-compose up -d
```

---

## ✅ Best Practices

- ✅ Тестируйте код перед созданием тега
- ✅ Создавайте теги только от `main` branch
- ✅ Используйте semantic versioning
- ✅ Пишите понятные commit messages с префиксами
- ✅ Для pre-release используйте суффиксы `-beta`, `-rc`, `-alpha`
- ✅ Храните последние 5 релизов для быстрого отката

---

## 📊 Мониторинг

**Где смотреть прогресс:**
1. **GitHub Actions** → вкладка Actions → workflow runs
2. **Slack** уведомления (если настроено)
3. **Логи сервера**: `ssh user@server "docker-compose logs -f"`

**GitHub Secrets (required):**
- `DEPLOY_HOST` - IP/domain сервера
- `DEPLOY_USER` - SSH user
- `DEPLOY_KEY` - SSH private key
- `SLACK_WEBHOOK` - (опционально)

---

## 📚 См. также

- [DEPLOYMENT.md](DEPLOYMENT.md) - Полная документация по deployment
- [.github/workflows/release.yml](.github/workflows/release.yml) - Workflow автоматических релизов
