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
