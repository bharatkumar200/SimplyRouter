<?php

namespace SimplyDi\SimplyRouter;

class Router
{
    private $routes = [];

    public function match($uri, $callback) {
        // convert uri to regular expression
        $pattern = '#^' . preg_replace('/{([a-zA-Z]+)}/', '(?P<$1>[^/]+)', $uri) . '$#';

        $this->routes[$pattern] = $callback;
    }

    public function run() {
        $requestUri = $_SERVER['REQUEST_URI'];
        foreach ($this->routes as $pattern => $callback) {
            if (preg_match($pattern, $requestUri, $matches)) {
                // Remove the first element (the full match)
                array_shift($matches);

                if (is_callable($callback)) {
                    // Call the callback function and pass the matched parameters as an array
                    $callback($matches);
                } else {
                    // Return 404 if the route is matched but the callback is not callable.
                    http_response_code(404);
                    echo "404 Not Found";
                }

                return;
            }
        }

        // Return 404 if no route is matched.
        http_response_code(404);
        echo "404 Not Found";
    }
}
