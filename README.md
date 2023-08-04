# SimplyRouter

A simple routing system in PHP

## Notes

- built for learning purpose
- it is a very simple router. For more powerful features like route naming and middleware implementations, go for League Route or Symfony router
- suitable only for small projects

## Usage

```php
include 'src/Router.php'; // or use composer: require 'vendor/autoload.php'

$route = new \SimplyDi\SimplyRouter\Router();

$route->match('/', function () {
    echo "Welcome us";
});

$route->match('/about', function () {
    echo "About us";
});

$route->match('/policy/privacy', function () {
    echo "PRIVACY us";
});

$route->match('/post/{slug}', function ($params) {
    $slug = $params['slug'];
    echo "Post with slug: " . $slug;
});

$route->run(); // run the router
```