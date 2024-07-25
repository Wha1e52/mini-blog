# Mini Blog Project

Этот проект представляет собой мини-блог, созданный на PHP с использованием MySQL для хранения данных и Docker для контейнеризации.

## Структура проекта

Проект состоит из следующих основных файлов и директорий:
- `mysql/init.sql` — файл для инициализации базы данных.
- `php/Dockerfile` — для создания образа Docker.
- `php/src/classes/Database.php` — класс для подключения к базе данных.
- `php/src/classes/PostManager.php` — класс для взаимодействия с базой данных.
- `php/src/...` — файлы для отображения страниц.
- `docker-compose.yml` — для управления контейнерами.


## Запуск проекта с помощью Docker

### Шаг 1: Установите Docker

Прежде чем начать, убедитесь, что у вас установлен Docker. Вы можете загрузить его с официального сайта:
- [Docker](https://www.docker.com/get-started)

### Шаг 2. Клонирование репозитория

Для начала склонируйте этот репозиторий на ваш локальный компьютер. Введите следующую команду в вашем терминале:

```bash
git clone https://github.com/Wha1e52/mini-blog.git
```
Перейдите в директорию проекта, используя следующую команду:
```bash
cd mini-blog
```

### Шаг 3. Запуск контейнеров
Для сборки и запуска контейнеров выполните команду:

```bash
docker-compose up -d
```

### Шаг 4. Перейдите по ссылке для просмотра проекта
http://localhost:8080/


Чтобы остановить контейнеры, выполните команду:

```bash
docker-compose down
```