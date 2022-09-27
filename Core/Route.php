<?php

namespace Core;
use Controllers;
/**
 * Route
 */
class Route
{
    protected array $routes;
    private $notFound;
    private const METHOD_GET = 'GET';
    private const METHOD_POST = 'POST';

    public function get(string $path, $route): void
    {
        $this->addRoute(self::METHOD_GET, $path, $route);
    }
    public function post(string $path, $route): void
    {
        $this->addRoute(self::METHOD_POST, $path, $route);
    }
    private function addRoute(string $method, string $path, $route):void
    {
        $this->routes[$method . $path] = [
          'path' => $path,
          'method' => $method,
          'route' => $route,
        ];
    }
    public function notFoundRoute($route): void
    {
        $this->notFound = $route;
    }
    public function dispatch()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $method = $_SERVER['REQUEST_METHOD'];
        $callback = null;
        foreach ($this->routes as $route){
             if($route['path'] === $requestPath && $method === $route['method']){
                $callback = $route['route'];
             }
        }

        if(is_string($callback)){
            $parts = explode('@', $callback);
            if(is_array($parts)){
                $className = 'Controllers\\' . array_shift($parts);
                $route = new $className;
                $method = array_shift($parts);
                $callback = [$route, $method];
            }
        }
        if(!$callback){
            header("HTTP/1.0 404 Not Found");
            if(!empty($this->notFound)){
                $callback = $this->notFound;
            }
        }

        call_user_func_array($callback, [
            array_merge($_GET, $_POST)
        ]);
    }
}