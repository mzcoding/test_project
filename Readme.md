Установка

P.S: Перед началом установки: В каталоге **docker** необходимо создать каталог **mysql**

1. Установите Docker && Docker Compose
2. Откройте терминал и выполните команду: `make compose-build`
3. Обновите зависимости, выполните: `make compose-dep-update`
4. Наконец скопируем файл конфигурации: `make compose-env`, а так-же необходимо сгенерировать ключ приложения: `make compose-key-generate`
5. В итоге мы можем открыть наш сайт по адресу: http://localhost:8000
6. Далее запустите миграции `make compose-migrate` и сиды `make compose-seed`
7. Используем запросы из [коллекции Postman](https://github.com/mzcoding/test_project/blob/main/Product%20service%20API.postman_collection.json) при необходимости, заменить Bearer token на ваш в авторизованных эндпоинтах

**Опционально:**
 - Swagger: http://localhost:8000/api/documentation#/  (Генерация через команду `make compose-swagger`)
 - Команда обновления статуса заказа (после истечения аренды товара):
 - Статический анализатор: `make compose-pint`
 - Запуск тестов `make compose-test`

   TODO:
    1) Дописать команду обновления статусов заказа (окончание аренды)
    2) Дописать тесты
    3) Реализовать фронтенд
