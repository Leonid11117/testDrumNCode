##  Реалізація проєкту:
* реалізовано реєстрація та авторизація - App/Http/Controller/Auth
  * реєстрація - App/Http/Controller/Auth/RegisterController.php
  * авторизація - App/Http/Controller/Auth/LoginController.php
* отримати список своїх завдань відповідно до фільтра - App/Http/Controller/Tasks/IndexController.php
* створити своє завдання - App/Http/Controller/Tasks/CreateController.php
* редагувати своє завдання - App/Http/Controller/Tasks/UpdateController.php
* відзначити своє завдання як виконане - App/Http/Controller/Tasks/UpdateController.php
* видалити своє завдання - App/Http/Controller/Tasks/DeleteController.php
* видалити своє завдання - App/Http/Controller/Tasks/DeleteController.php


## Встановлення збірки:
1. Клонування репозиторію:
```sh
git clone https://github.com/Leonid11117/testDrumNCode.git
```
* Створюємо файл .env з файлу .env.example
2. Виконнання команди на формування контейнерів для докеру, це потрібно робити в папці проєкту:
```sh
docker-compose build
```
3. Запуск контейнерів:
```sh
docker-compose up -d 
```
4. Заходимо в контейнер php:
```sh
docker exec -it php bash
```
5. Встановлюємо всі допоміжні файли в контейнері:
```sh
composer install
```
6. Виконуємо команду для генерування ключа в контейнері:
```sh
php artisan key:generate
```
7. Запуск міграцій:
```sh
php artisan migrate
```
8. Потім генеруємо api документацію:
```sh
php artisan l5-swagger:generate
```
## Api:
1) http://localhost:8001/api/documentation/ - Api документація.
2) http://localhost:8001/api/register/ - реєстрація.
3) http://localhost:8001/api/login/ - авторизація

## Компоненти:
* Для виконання фільтрації скористався пакетом - https://github.com/spatie/laravel-query-builder
* Для створення api документації використовував пакет - https://github.com/DarkaOnLine/L5-Swagger
