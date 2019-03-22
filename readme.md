Тестовое задание
===

Используя Laravel, реализовать приложение, которое является агрегатором данных из access логов apache с сохранением в БД.

Разбор файлов должен выполняться по cron'у.

В приложении реализовать такие функции:
* авторизация (пользователи в БД)
* просмотр данных сохраненных в БД (группировка по IP, по дате, выборка по промежутку дат)
* API для получения данных в виде JSON (смысл тот же: получение данных по временному промежутку, возможность группировать/фильтровать по IP)
* конфигурация через файл настроек (где лежат логи, маска файлов, и все, что Вам потребуется для настройки приложения)
