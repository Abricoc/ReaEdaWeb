# API Documentation 
Регистрация
--- 
##### Адрес: `/api/register`
##### Метод: `POST` 
##### Параметры: `firstname, email, password`

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
##### Параметры: `email, password`
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
[
    {
        "product": {
            "id": 3,
            "name_product": "Мясо по-французски",
            "price": "170",
            "text": "<p><strong>Мясо по-французски</strong></p>",
            "photo": "/storage/products/Z2E32a0b8FqdwHRlbH0Ol7FmmpqTHjDLqsQv4w3G.jpeg",
            "day_of_the_wish": 0
        },
        "count": 2,
        "price": 340
    },
    {
        "product": {
            "id": 4,
            "name_product": "Мясо по-французки",
            "price": "170",
            "text": "<p>Мясо по-французки</p>",
            "photo": "/storage/products/wGYUh2mwqY0kJYBrwcFTHyRqdTjzdbYfAY0gyDSz.jpeg",
            "day_of_the_wish": 0
        },
        "count": 1,
        "price": 170
    }
]
```
Добавление товара в "Корзину"
--- 
##### Адрес: `/api/cart`
##### Заголовки: 
- Authorization: Bearer {token}
##### Параметры:
- productId - идентификатор продукта
##### Метод: `POST` 
``` 
ok
```

Удаление товара из "Корзины"
--- 
##### Адрес: `/api/cart`
##### Заголовки: 
- Authorization: Bearer {token}
##### Параметры:
- productId - идентификатор продукта
##### Метод: `DELETE` 
``` 
ok
```
