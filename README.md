## Запуск проекта
Установить Make: `apt-get -y install make`
Выполнить в консоли:
- `make init-project`
- `make db-migrate`

Отправить POST запрос по `/api/receive-event` с телом:
```json
{
    "account_id": "ID аккаунта",
    "event_id": "ID события"
}
```

Для изменения количества воркеров,
работающих одновременно для обработки очередей,
достаточно изменить поле `ACCOUNT_EVENT_MAX_QUEUES_COUNT`
в файле .env

## Используемые технологии
- PHP 8.3
- Laravel 10
- RabbitMQ 3.12
- MySQL 8.2
