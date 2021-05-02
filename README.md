# Currency Api test task

## Info:

Чтобы развернуть приложение локально

```
git clone git@github.com:happyendik/currency-api-test-task.git

./init

composer install
```

Настроить подключение к БД в `common/config/main-local`

```
./yii migrate
```

./yii currency/refresh-rates

## Cron Jobs:

Обновление курсов валют

```
./yii currency/refresh-rates
```
## API Interface:

Протестировать: ``

### Получение всех валют с пагинацией

Request: `/v1/currencies`

Response:
```
[
    {
        "name":"usd",
        "rate":"1.123123000000000",
        },
    {
        "name":"eur",
        "rate":"1.333330000000000",
    }
]
```
### Получение конкретной валюты по имени

Request: `/v1/currency/{name}`

Response:
```
{"rate":"1.123123000000000"}
```
### Для тестирования локально

Нужно добавить запись в таблицу `user` и значение `auth_key` использовать для Bearer-авторизации

`curl -i -H "Authorization: Bearer {auth_key}" "http://beststocks.test/v1/currencies"`

`curl -i -H "Authorization: Bearer {auth_key}" "http://beststocks.test/v1/currency/usd"`
