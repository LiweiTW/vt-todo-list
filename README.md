# vt-todo-list API接口



## API 列表

- get all to-do lists
- get one to-do list
- create one to-do list
- update one to-do list
- delete one to-do list
- delete all to-do list
- generate a new token
- get token status (Only if tokens with TTL or RefreshToken)



## API 規格

### :: 取得 Auth Token

- **使用方式** 

  `POST` `/api/token`

- **參數**

  Body

  `email=[string]`

  `password=[string]`

- **範例**

```bash
curl -X POST \
  -H 'Content-Type: application/json' \
  -d '{"email":"liwei@gmail.com","password":"Dnm97Katf5R6adax"}'     https://vt.liweitw.com/api/token
```

- **結果**

```
{
    "token": "751274df-4bc2-4634-b6b5-a23465045e60"
}
```



### :: 檢查 Auth Token 有效性

- **使用方式** 

  `POST` `/api/token/{token}`

- **參數**

  URL

  `token=[string]`

- **範例**

```bash
curl --request GET \
  --url https://vt.liweitw.com/api/token/7fbc201c-d073-4093-9515-831c1acd151d
```

- **結果**

```
{
    "isValid": true,
    "userId": 1,
    "expiredAt": "2019-04-06T05:54:17+00:00"
}
```



### :: 建立一筆 Todo

- **使用方式** 

  `POST` `/api/todo/`

- **參數**

  Header

  `todo-token=[string]`

  Body

  `title=[string]`

  `content=[string]`

  `attachment=[string]`

- **範例**

```bash
curl --request POST \
  --url https://vt.liweitw.com/api/todo \
  --header 'todo-token: 7fbc201c-d073-4093-9515-831c1acd151d' \
  --form 'title=買牛奶' \
  --form 'content=冰箱沒牛奶了，要買兩罐' \
  --form 'attachment=https://zh.wikipedia.org/wiki/%E7%89%9B%E5%A5%B6#/media/File:Milk_glass.jpg'
```

- **結果**

```
{
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "title": "買牛奶",
            "content": "冰箱沒牛奶了，要買兩罐",
            "attachment": "https://zh.wikipedia.org/wiki/%E7%89%9B%E5%A5%B6#/media/File:Milk_glass.jpg",
            "done_at": 0,
            "deleted_at": null,
            "created_at": "2019-03-30 06:07:51",
            "updated_at": "2019-03-30 06:07:51"
        }
    ]
}
```



### :: 取得特定 Todo

- **使用方式** 

  `GET` `/api/todo/{todo_id}`

- **參數**

  URL

  `todo_id=[string]`

  Header

  `todo-token=[string]`

- **範例**

```bash
curl --request GET \
  --url https://vt.liweitw.com/api/todo/1 \
  --header 'todo-token: 7fbc201c-d073-4093-9515-831c1acd151d'
```

- **結果**

```
{
    "data": {
        "id": 1,
        "user_id": 1,
        "title": "買牛奶",
        "content": "冰箱沒牛奶了，要買兩罐",
        "attachment": "https://zh.wikipedia.org/wiki/%E7%89%9B%E5%A5%B6#/media/File:Milk_glass.jpg",
        "done_at": 0,
        "deleted_at": null,
        "created_at": "2019-03-30 06:07:51",
        "updated_at": "2019-03-30 06:07:51"
    }
}
```



### :: 取得所有 Todo

- **使用方式** 

  `GET` `/api/todo/`

- **參數**

  Header

  `todo-token=[string]`

- **範例**

```bash
curl --request GET \
  --url https://vt.liweitw.com/api/todo \
  --header 'todo-token: 7fbc201c-d073-4093-9515-831c1acd151d'

```

- **結果**

```
{
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "title": "買牛奶",
            "content": "冰箱沒牛奶了，要買兩罐",
            "attachment": "https://zh.wikipedia.org/wiki/%E7%89%9B%E5%A5%B6#/media/File:Milk_glass.jpg",
            "done_at": 0,
            "deleted_at": null,
            "created_at": "2019-03-30 06:07:51",
            "updated_at": "2019-03-30 06:07:51"
        }
    ]
}

```



### :: 更新特定 Todo

- **使用方式** 

  `POST` `/api/todo/{todo_id}`

- **參數**

  URL

  `todo_id=[string]`

  Header

  `todo-token=[string]`

  Body

  `title=[string]`

  `content=[string]`

  `attachment=[string]`

  `dontAt=[timestamp]`

- **範例**

```bash
curl --request POST \
  --url https://vt.liweitw.com/api/todo/1 \
  --header 'todo-token: 7fbc201c-d073-4093-9515-831c1acd151d' \
  --form 'title=要買咖啡豆' \
  --form 'content=買一包' \
  --form 'attachment=https://zh.wikipedia.org/wiki/%E5%92%96%E5%95%A1#/media/File:A_small_cup_of_coffee.JPG' \
  --form doneAt=1553926743
```

- **結果**

```
{
    "hasSuccess": true,
    "data": {
        "id": 1,
        "user_id": 1,
        "title": "要買咖啡豆",
        "content": "買一包",
        "attachment": "https://zh.wikipedia.org/wiki/%E5%92%96%E5%95%A1#/media/File:A_small_cup_of_coffee.JPG",
        "done_at": "1553926743",
        "deleted_at": null,
        "created_at": "2019-03-30 06:07:51",
        "updated_at": "2019-03-30 06:20:24"
    }
}
```



### :: 刪除特定 Todo

- **使用方式** 

  `DELETE` `/api/todo/{todo_id}`

- **參數**

  URL

  `todo_id=[string]`

  Header

  `todo-token=[string]`

- **範例**

```bash
curl --request DELETE \
  --url https://vt.liweitw.com/api/todo/1 \
  --header 'todo-token: 7fbc201c-d073-4093-9515-831c1acd151d'
```

- **結果**

```
{
    "hasSuccess": true,
    "data": {
        "id": 1,
        "user_id": 1,
        "title": "要買咖啡豆",
        "content": "買一包",
        "attachment": "https://zh.wikipedia.org/wiki/%E5%92%96%E5%95%A1#/media/File:A_small_cup_of_coffee.JPG",
        "done_at": 1553926743,
        "deleted_at": null,
        "created_at": "2019-03-30 06:07:51",
        "updated_at": "2019-03-30 06:20:24"
    }
}
```



### :: 刪除所有 Todo

- **使用方式** 

  `DELETE` `/api/todo/`

- **參數**

  URL

  `todo_id=[string]`

  Header

  `todo-token=[string]`

- **範例**

```bash
curl --request DELETE \
  --url https://vt.liweitw.com/api/todo/ \
  --header 'todo-token: 7fbc201c-d073-4093-9515-831c1acd151d'
```

- **結果**

```
{
    "deleted": 2
}
```
