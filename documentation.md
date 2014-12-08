FORMAT: 1A
HOST: http://192.168.56.101.xip.io/api/v1

# Todo App API (v1)

# Group Resources

## Todos [/todos/:id]

### List todos [GET]
ID is not necessary here

+ Request (application/json)

+ Response 200 (application/json)

        [
          {
            "id":"5",
            "name":"lorem ipsum",
            "created_at":"2014-12-08 20:24:49",
            "updated_at":"2014-12-08 20:24:49"
          },
          {
            "id":"6",
            "name":"lorem ipsum",
            "created_at":"2014-12-08 20:24:53",
            "updated_at":"2014-12-08 20:24:53"
          },
          {
            "id":"7",
            "name":"lorem ipsum",
            "created_at":"2014-12-08 20:25:01",
            "updated_at":"2014-12-08 20:25:01"
          },
          {
            "id":"8",
            "name":"lorem ipsum",
            "created_at":"2014-12-08 20:43:26",
            "updated_at":"2014-12-08 20:43:26"
          },
          {
            "id":"9",
            "name":"lorem todo 1",
            "created_at":"2014-12-08 20:43:27",
            "updated_at":"2014-12-08 20:43:27"
          },
          {
            "id":"10",
            "name":"lorem todo 2",
            "created_at":"2014-12-08 20:43:27",
            "updated_at":"2014-12-08 20:43:27"
          },
          {
            "id":"11",
            "name":"lorem todo 3",
            "created_at":"2014-12-08 20:43:27",
            "updated_at":"2014-12-08 20:43:27"
          }
        ]

### Create todo [POST]
ID is not necessary here

+ Request (application/json)
    + Body

            {
                name: "lorem ipsum"
            }

+ Response 201 (application/json)

        {
            "name":"new todo",
            "updated_at":"2014-12-08 20:52:05",
            "created_at":"2014-12-08 20:52:05",
            "id":12
        }

### Delete todo [DELETE]
ID is required here

+ Request (application/json)
+ Response 200 (application/json)

        {
            "name":"new todo",
            "updated_at":"2014-12-08 20:52:05",
            "created_at":"2014-12-08 20:52:05",
            "id":12
        }