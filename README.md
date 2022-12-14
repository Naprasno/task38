## Задание 38
Приложение SF-AdTech — это трекер трафика, созданный для организации взаимодействия компаний (рекламодателей), которые хотят привлечь к себе на сайт посетителей и покупателей (клиентов), и владельцев сайтов (веб-мастеров), на которые люди приходят, например, чтобы почитать новости или пообщаться на форуме.

Рекламодатель создаёт предложение (offer), определяя URL страницы, на которую он хочет приводить людей. Например, это страница товара, который он хочет продавать. В offer-е он также определяет стоимость перехода по ссылке. Скажем, 1 рубль за переход.

Веб-мастера в системе видят создаваемые офферы, подписываются на них, после чего система выдаёт им специальные ссылки, которые они должны разместить в любом виде у себя на ресурсе. Ссылка эта ведёт не на целевой URL, а на систему-редиректор, которая фиксирует переход, а затем перенаправляет клиента на страницу сайта рекламодателя.

imgПо итогам рекламодатель получает N посетителей и платит за это системе N рублей (согласно ставке в 1 рубль за переход).

Система определяет комиссию (например, 20%) за свои услуги. Таким образом, веб-мастер за привлечение клиентов, получит 0.8*N рублей, а система заработает 0.2*N рублей.
---

## Пользователи
Существует 3 типа пользователей, определяемые столбцом type_user в таблице users

тестовые пользователи:
0. Рекламодатель 
логин: adv
пароль: 123

1. Веб-мастер 
логин: web
пароль: 123

10. Администратор 
логин: admin 
пароль: admin

### Рекламодатель может:
- Зарегистрироваться в системе;
- Авторизоваться в системе;
- Посмотреть список созданных им offer-ов;
- Увидеть кол-во веб-мастеров, подписанных на каждый из offer-ов;
- Создать новый offer:
    - Указать имя offer-а;
    - Указать стоимость перехода;
    - Указать целевой URL;
    - Определить темы сайта;
- Посмотреть расходы и кол-во переходов по offer-у за выбранный интервал дат


### Веб-мастер может:
- Зарегистрироваться в системе;
- Авторизоваться в системе;
- Посмотреть список offer-ов, на которые он подписан;
- Подписаться на новый offer:
- Получить ссылку системы;
- Отписаться от offer-а;
- Посмотреть доходы и кол-во переходов по offer-у за выбранный интервал дат

### Администратор может:
- Авторизовывать новых рекламодателей и веб-мастеров;
- отключать их;
- Видеть статистику по:
    - выданным ссылкам;
    - переходам;
    - отказам в переходе 
    - общий доход системы;
- задать коммисию


---
## Основные таблицы

### offers
записываются все созданные оффера рекламодателями

- user_id - ид рекламодателя, добавившего оффер
- name - название оффера
- price - установленная рекламодателем цена перехода
- url - целевой адрес
- theme - тема сайта
- enable - активный(1) / деактивированный оффер(0)
- total_clicks - общее количество переходов на целевой адрес

### subscriptions
записываются подписки веб-мастеров на офферы рекламодателей

- offer_id - ид оффера, добавленного рекламодателем
- subscriber_id - ид веб-мастера, который подписался на оффер
- new_url - ссылка для веб-мастера для размещений
- count_clicks - количество переходов по этой ссылке

### clicks 
записывается удачная переадресация с ссылки веб-мастера на целевой адрес

- id_offer - ид оффера
- id_sub - ид веб мастера
- date - дата перехода

### reject
записывается неудачные переадресация с ссылки веб-мастера на целевой адрес

- offer_id - ид оффера
- subscriber_id - ид веб мастера
- date_log - дата перехода

### commission
записывается комиссия системы

- summ - сумма комиссии 
- date_change - дата изменения комиссии

### users
пользователи

- login - логин
- password - пароль с md5
- type_user - тип пользователя
- enable - активность




