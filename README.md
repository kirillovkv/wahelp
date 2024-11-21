# Старт проекта 
### Прописать в файл .env в папке docker
### Прописать в файл .env в папке src

# Зайти в Adminer http://localhost:8181

### Бд PostgreSql
### Сервер db
### Логин (который указали в docker/.env)
### Пароль (который указали в docker/.env)

### Выбрать базу, и выполнить sql запрос из файла docker/postgres/bd.sql

```docker-compose -f docker/docker-compose.yml -p test up --build```

# Создание пользователей

curl --location 'localhost/api/import' \
--form 'file=@"/Users/Admin/Downloads/Telegram Desktop/Данные для тестового.csv"'


# Создание рассылки

curl --location 'localhost/api/mailing' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'title=Скидки' \
--data-urlencode 'content=11.11 скидки 60%'

# Запуск рассылки
```docker exec -it wahelp-app-1 php -f commands/sendMailing.php ```