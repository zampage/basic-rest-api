# BASIC REST API

This is a basic REST API free to use.

Create an API class and start processing requests.

```php
class API extends REST
{
    function __construct(){
        $this->process();
    }
}
new API();
```

Add custom request functions to your API class and generate responses.

```php
function customers(){
    $customers = array(1, 2, 3);
    $this->respond($customers, 200);
}
```

Send a GET request to your Service like this:
```
http://your-api/customers
```

And receive the following response:

```
HTTP/1.1 200 OK
Date: Sun, 16 Oct 2016 14:09:53 GMT
Server: Apache/2.4.18 (Ubuntu)
Content-Length: 7
Keep-Alive: timeout=5, max=100
Connection: Keep-Alive
Content-Type: application/json
```

```json
[1,2,3]
```