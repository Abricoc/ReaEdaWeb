# API Documentation 
Регистрация
--- 
##### Адрес: `/api/register`
##### Метод: `POST` 
##### Параметры: `firstname, email, password, device_id (необязательный)`

```
{ 
    "data": "", 
    "errors": { 
        "firstname": "Имя пользователя обязательно для заполнения", 
        "email": "Email обязателен для заполнения", 
        "password": "Пароль обязателен для заполнения" 
    } 
}
```
##### Виды ошибок: 
- Имя пользователя обязательно для заполнения 
- Email обязателен для заполнения 
- Необходимо ввести валидный Email адрес
- Пользователь с таким Email адресом уже существует
- Пароль обязателен для заполнения
- Пароль должен минимум состоять из 8 символов

Авторизация
--- 
##### Адрес: `/api/login` 
##### Метод: `POST` 
##### Параметры: `email, password, device_id (необязательный)`
``` 
{ 
    "data": "", 
    "errors": { 
        "email": "Email обязателен для заполнения", 
        "password": "Пароль обязателен для заполнения" 
    } 
}
``` 
##### Виды ошибок: 
- Email обязателен для заполнения 
- Необходимо ввести валидный Email адрес
- Пароль обязателен для заполнения 
- Пароль должен минимум состоять из 8 символов

Получение всех ресторанов
--- 
##### Адрес: `/api/places` 
##### Метод: `GET` 
``` 
[
    {
        "id": 1,
        "place_name": "Пиццерия",
        "place_photo": "/images/places/94b40548b82a1b5b62192c5970544baf.jpg",
        "place_open": "08:00",
        "place_close": "18:00",
        "operating_mode": true
    }
]
``` 

Получение конкретного ресторана
--- 
##### Адрес: `/api/places/{id}` 
##### Метод: `GET` 
```
{
    "id": 1,
    "place_name": "Пиццерия",
    "place_photo": "/images/places/94b40548b82a1b5b62192c5970544baf.jpg",
    "place_open": "08:00",
    "place_close": "18:00",
    "operating_mode": true
}
```
Получение всех "Категорий"
--- 
##### Адрес: `/api/categorys` 
##### Метод: `GET` 
``` 
[
    {
        "id": 1,
        "category_name": "Мясные блюда"
    },
    {
        "id": 3,
        "category_name": "Салаты"
    },
    {
        "id": 4,
        "category_name": "Напитки"
    }
]
```
Получение всех "Продуктов" конкретной столовой
--- 
##### Адрес: `/api/products/{placeId}`
##### Параметры: placeId - ID столовой
##### Метод: `GET` 
``` 
[
    {
        "id": 3,
        "name_product": "Мясо по-французски",
        "price": "170",
        "text": "<p><strong>Мясо по-французски</strong></p>",
        "photo": "/storage/products/Z2E32a0b8FqdwHRlbH0Ol7FmmpqTHjDLqsQv4w3G.jpeg",
        "category": {
            "id": 1,
            "category_name": "Мясные блюда"
        },
        "place": {
            "id": 2,
            "place_name": "Нахимовский проспект, 21",
            "place_photo": "/storage/places/cpJHbuOZKWEoXYzsKy71aSXfEFoPNkfR3pIhBEZU.jpeg"
        }
    },
    {
        "id": 4,
        "name_product": "Мясо по-французки",
        "price": "170",
        "text": "<p>Мясо по-французки</p>",
        "photo": "/storage/products/wGYUh2mwqY0kJYBrwcFTHyRqdTjzdbYfAY0gyDSz.jpeg",
        "category": {
            "id": 1,
            "category_name": "Мясные блюда"
        },
        "place": {
            "id": 2,
            "place_name": "Нахимовский проспект, 21",
            "place_photo": "/storage/places/cpJHbuOZKWEoXYzsKy71aSXfEFoPNkfR3pIhBEZU.jpeg"
        }
    }
]
```
Получение всех "Продуктов" конкретной столовой и конкретной категории
--- 
##### Адрес: `/api/products/{placeId}/{categoryId}`
##### Параметры: 
- placeId - ID столовой 
- categoryId - ID категории
##### Метод: `GET` 
``` 
[
    {
        "id": 3,
        "name_product": "Мясо по-французски",
        "price": "170",
        "text": "<p><strong>Мясо по-французски</strong></p>",
        "photo": "/storage/products/Z2E32a0b8FqdwHRlbH0Ol7FmmpqTHjDLqsQv4w3G.jpeg",
        "category": {
            "id": 1,
            "category_name": "Мясные блюда"
        },
        "place": {
            "id": 2,
            "place_name": "Нахимовский проспект, 21",
            "place_photo": "/storage/places/cpJHbuOZKWEoXYzsKy71aSXfEFoPNkfR3pIhBEZU.jpeg"
        }
    },
    {
        "id": 4,
        "name_product": "Мясо по-французки",
        "price": "170",
        "text": "<p>Мясо по-французки</p>",
        "photo": "/storage/products/wGYUh2mwqY0kJYBrwcFTHyRqdTjzdbYfAY0gyDSz.jpeg",
        "category": {
            "id": 1,
            "category_name": "Мясные блюда"
        },
        "place": {
            "id": 2,
            "place_name": "Нахимовский проспект, 21",
            "place_photo": "/storage/places/cpJHbuOZKWEoXYzsKy71aSXfEFoPNkfR3pIhBEZU.jpeg"
        }
    }
]
```
Получение конкретного "Продукта"
--- 
##### Адрес: `/api/singleProduct/{id}`
##### Параметры: 
- id - ID продукта
##### Метод: `GET` 
``` 
{
    "id": 3,
    "name_product": "Мясо по-французски",
    "price": "170",
    "text": "<p><strong>Мясо по-французски</strong></p>",
    "photo": "/storage/products/Z2E32a0b8FqdwHRlbH0Ol7FmmpqTHjDLqsQv4w3G.jpeg",
    "category": {
        "id": 1,
        "category_name": "Мясные блюда"
    },
    "place": {
        "id": 2,
        "place_name": "Нахимовский проспект, 21",
        "place_photo": "/storage/places/cpJHbuOZKWEoXYzsKy71aSXfEFoPNkfR3pIhBEZU.jpeg"
    }
}
```

Получение "Корзины"
--- 
##### Адрес: `/api/cart`
##### Заголовки: 
- Authorization: Bearer {token}
##### Метод: `GET` 
``` 
{
    "Items": [
        {
            "product": {
                "id": 4,
                "name_product": "Мясо по-французки",
                "price": "170",
                "text": "<p>Мясо по-французки</p>",
                "photo": "/storage/products/wGYUh2mwqY0kJYBrwcFTHyRqdTjzdbYfAY0gyDSz.jpeg",
                "dish_of_the_day": 0
            },
            "count": 2,
            "price": 340
        },
        {
            "product": {
                "id": 3,
                "name_product": "Мясо по-французски",
                "price": "170",
                "text": "<p><strong>Мясо по-французски</strong></p>",
                "photo": "/storage/products/Z2E32a0b8FqdwHRlbH0Ol7FmmpqTHjDLqsQv4w3G.jpeg",
                "dish_of_the_day": 0
            },
            "count": 1,
            "price": 170
        }
    ],
    "TotalNumber": 3,
    "FinalAmount": 510,
    "CurrentCount": 1,
    "Place": 1
}
```
Добавление товара в "Корзину"
--- 
##### Адрес: `/api/cart`
##### Заголовки: 
- Authorization: Bearer {token}
##### Параметры:
- productId - идентификатор продукта
- count - количество такого товара (необязательный по умолчанию равен 1)
##### Метод: `POST` 
``` 
{
    "Items": [
        {
            "product": {
                "id": 4,
                "name_product": "Мясо по-французки",
                "price": "170",
                "text": "<p>Мясо по-французки</p>",
                "photo": "/storage/products/wGYUh2mwqY0kJYBrwcFTHyRqdTjzdbYfAY0gyDSz.jpeg",
                "dish_of_the_day": 0
            },
            "count": 2,
            "price": 340
        },
        {
            "product": {
                "id": 3,
                "name_product": "Мясо по-французски",
                "price": "170",
                "text": "<p><strong>Мясо по-французски</strong></p>",
                "photo": "/storage/products/Z2E32a0b8FqdwHRlbH0Ol7FmmpqTHjDLqsQv4w3G.jpeg",
                "dish_of_the_day": 0
            },
            "count": 1,
            "price": 170
        }
    ],
    "TotalNumber": 3,
    "FinalAmount": 510,
    "CurrentCount": 1,
    "Place": 1
}
```

Удаление товара из "Корзины"
--- 
##### Адрес: `/api/cart`
##### Заголовки: 
- Authorization: Bearer {token}
##### Параметры:
- productId - идентификатор продукта
- count - количество такого товара (необязательный по умолчанию равен 1)
##### Метод: `DELETE` 
``` 
{
    "Items": [
        {
            "product": {
                "id": 4,
                "name_product": "Мясо по-французки",
                "price": "170",
                "text": "<p>Мясо по-французки</p>",
                "photo": "/storage/products/wGYUh2mwqY0kJYBrwcFTHyRqdTjzdbYfAY0gyDSz.jpeg",
                "dish_of_the_day": 0
            },
            "count": 2,
            "price": 340
        },
        {
            "product": {
                "id": 3,
                "name_product": "Мясо по-французски",
                "price": "170",
                "text": "<p><strong>Мясо по-французски</strong></p>",
                "photo": "/storage/products/Z2E32a0b8FqdwHRlbH0Ol7FmmpqTHjDLqsQv4w3G.jpeg",
                "dish_of_the_day": 0
            },
            "count": 1,
            "price": 170
        }
    ],
    "TotalNumber": 3,
    "FinalAmount": 510,
    "CurrentCount": 1,
    "Place": 1
}
```

Полное очищение "Корзины"
--- 
##### Адрес: `/api/clearCart`
##### Заголовки: 
- Authorization: Bearer {token}
##### Метод: `POST` 
``` 
{
    "Items": null,
    "TotalNumber": 0,
    "FinalAmount": 0,
    "CurrentCount": 0,
    "Place": 0
}
```

Восстановление пароля
--- 
##### Адрес: `/api/resetPassword`
##### Параметры: 
- email - Email адрес пользователя
##### Метод: `POST` 
``` 

```

Изменение имени
--- 
##### Адрес: `/api/changeName`
##### Заголовки: 
- Authorization: Bearer {token}
##### Параметры: 
- firstname - Имя пользователя
##### Метод: `POST` 
``` 
{ 
    "data": "", 
    "errors": { 
        "firstname": "", 
        "email": "", 
        "password": "" 
    } 
}
```

Изменение электронной почты
--- 
##### Адрес: `/api/changeEmail`
##### Заголовки: 
- Authorization: Bearer {token}
##### Параметры: 
- email - Email адрес пользователя
##### Метод: `POST` 
``` 
{ 
    "data": "", 
    "errors": { 
        "firstname": "", 
        "email": "", 
        "password": "" 
    } 
}
```

Изменение пароля
--- 
##### Адрес: `/api/changePassword`
##### Заголовки: 
- Authorization: Bearer {token}
##### Параметры: 
- password - Новый пароль пользователя
##### Метод: `POST` 
``` 
{ 
    "data": "", 
    "errors": { 
        "firstname": "", 
        "email": "", 
        "password": "" 
    } 
}
```

Получение информации о профиле
--- 
##### Адрес: `/api/profile`
##### Заголовки: 
- Authorization: Bearer {token}
##### Метод: `GET` 
``` 
{
    "firstname": "Никита",
    "email": "n.s.mitasov@mpt.ru"
}
```

Оформление заказа
--- 
##### Адрес: `/api/checkout`
##### Заголовки: 
- Authorization: Bearer {token}
##### Параметры:
- comment - Комментарий к заказу
- select_date - Желаемая дата и время в формате "2020-05-20 14:00:00"
##### Метод: `POST` 
``` 
{
    "status": "Success"
}
```

Получение списка заказов
--- 
##### Адрес: `/api/orders`
##### Заголовки: 
- Authorization: Bearer {token}

##### Метод: `GET` 
``` 
[
    {
        "order": {
            "id": 7,
            "status": "Заказ принят в обработку",
            "place_name": "Стремянный переулок, 36",
            "comment": "Комментарий отсутствует",
            "products": [
                {
                    "product": {
                        "id": 3,
                        "name_product": "Мясо по-французски",
                        "price": "170",
                        "text": "<p>Мясо по-французски</p>",
                        "photo": "/storage/products/Z2E32a0b8FqdwHRlbH0Ol7FmmpqTHjDLqsQv4w3G.jpeg",
                        "dish_of_the_day": true
                    },
                    "count": 2,
                    "price": 340
                }
            ],
            "final_amount": 340,
            "select_date": null,
            "created_at": "26.05.2020 00:12"
        },
        "decline": false
    }
]
```

Отмена заказа клиентом
--- 
##### Адрес: `/api/orders`
##### Заголовки: 
- Authorization: Bearer {token}

##### Параметры
- orderID - уникальный номер заказа
##### Метод: `DELETE` 
``` 
{
    "status": "Заказ отменён"
}
```
