## Запуск проекта
Установить Make: ```apt-get -y install make```
Выполнить в консоли:
- ```make init-project```
- ```make db-migrate``` 

Отправить POST запрос по ```/api/receive-event``` с телом:
```json
{
    "account_id": "ID аккаунта",
    "event_id": "ID события"
}
```

## Используемые технологии
- PHP 8.3
- Laravel 10
- RabbitMQ 3.12
- MySQL 8.2
