# API Documentation 
Регистрация
--- 
##### Адрес: `/api/register`
##### Метод: `POST` 
##### Параметры: `firstname, email, password, device_id`

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
##### Параметры: `email, password, device_id`
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

Получение всех "Столовых"
--- 
##### Адрес: `/api/places` 
##### Метод: `GET` 
``` 
[
    {
        "id": 2,
        "place_name": "Нахимовский проспект, 21",
        "place_photo": "places/cpJHbuOZKWEoXYzsKy71aSXfEFoPNkfR3pIhBEZU.jpeg"
    },
    {
        "id": 3,
        "place_name": "Нежинская, 7",
        "place_photo": "places/nIxfWgJuxoQmVSxSzYjuLq3XuHPkKvgAwsAQA1GL.jpeg"
    },
    {
        "id": 5,
        "place_name": "Нежинская, 71",
        "place_photo": "places/HvmIkHCkPZI2bM1JxM0OGnNg2BJHB9JZcQkA6Mcp.jpeg"
    },
    {
        "id": 9,
        "place_name": "werwerwe",
        "place_photo": "places/phfyywTEJClQcxXoN9gkO7jZ7AFGq0JNht9QQNnf.jpeg"
    }
]
``` 

Получение конкретной "Столовой"
--- 
##### Адрес: `/api/places/{id}` 
##### Метод: `GET` 
```
{
    "id": 2,
    "place_name": "Нахимовский проспект, 21",
    "place_photo": "places/cpJHbuOZKWEoXYzsKy71aSXfEFoPNkfR3pIhBEZU.jpeg"
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

##### Метод: `POST` 
``` 
[
    {
        "id": 1,
        "status": "Заказ принят в обработку",
        "comment": "пп",
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
                "count": 3,
                "price": 510
            },
            {
                "product": {
                    "id": 5,
                    "name_product": "Морс Фруктовый сад Клюква",
                    "price": "80",
                    "text": "<p>Морс Фруктовый сад Клюква\r\n</p>",
                    "photo": "/storage/products/151006.jpeg",
                    "dish_of_the_day": false
                },
                "count": 2,
                "price": 160
            }
        ],
        "created_at": "2020-05-19T15:25:22.000000Z"
    }
]
```
