# corporate.loc
<br>Laravel 5.7
<br><b>Задача:</b>
<br>Сделать сайт на laravel в рамках учебного курса. 
<br>Исправить структуру кода (добавить services, переработать контроллеры, модели, репозитории)

<br><b>Установка:</b>
<br>composer install
<br>Подправить .env с доступом к БД
<br>php artisan key:generate
<br>php artisan migrate --seed

<br><b>Для входа в админ панель нужно использовать:</b>
<br><b>login:</b>
<br>user
<br><b>password:</b>
<br>123456 

<br><b>Особенности проекта:</b>
1. Для создания и заполнения базы данных использовались миграции и Laravel seeder.
2. Реализована основная функциональность сайта (страницы со статьями, портфолио, возможность комментировать статьи)
<br>Главная страница:
<br>![alt text](public/white/images/readme/2.png)
<br>Страница со статьями:
<br>![alt text](public/white/images/readme/1.png)
3. Реализована админ панель сайта:
<br>- добавление/удаление/редактирование статьей и портфолио;
<br>- возможность добавлять новых пользователей;
<br>- менять роли и привилегии пользователей;
<br>Панель администратора:
<br>![alt text](public/white/images/readme/3.png)