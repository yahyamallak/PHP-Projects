<?php

class Router
{
    private $routes = [];
    private $middleware = [];
    private $namedRoutes = [];

    public function add($method, $path, $callback, $name = null)
    {
        $route = [
            'method' => $method,
            'path' => $this->convertToRegex($path),
            'callback' => $callback
        ];

        if ($name) {
            $this->namedRoutes[$name] = $path;
        }

        $this->routes[] = $route;
    }

    public function addMiddleware($callback)
    {
        $this->middleware[] = $callback;
    }

    public function dispatch($method, $uri)
    {
        foreach ($this->middleware as $middleware) {
            call_user_func($middleware, $method, $uri);
        }

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($route['path'], $uri, $matches)) {
                array_shift($matches); // Remove the full match
                call_user_func_array($route['callback'], $matches);
                return;
            }
        }

        // No route matched
        echo "404 Not Found";
    }

    public function route($name, $params = [])
    {
        if (!isset($this->namedRoutes[$name])) {
            throw new Exception("No route named $name");
        }

        $path = $this->namedRoutes[$name];

        foreach ($params as $key => $value) {
            $path = str_replace('{' . $key . '}', $value, $path);
        }

        return $path;
    }

    private function convertToRegex($path)
    {
        return '/^' . str_replace('/', '\/', preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $path)) . '$/';
    }
}
