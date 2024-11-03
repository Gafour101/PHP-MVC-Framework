<?php

namespace gaf\phpmvc;

use gaf\phpmvc\exception\NotFoundException;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];
    protected string $prefix = '';
    protected array $middlewares = [];
    protected ?string $name = '';

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
            throw new NotFoundException();
        }

        if (is_string($callback)) {
            return Application::$app->view->renderView($callback);
        }

        if (is_array($callback)) {
            /** @var \gaf\phpmvc\Controller $controller */
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
            $callback[0] = $controller;
        }

        return call_user_func($callback, $this->request, $this->response);
    }

    // Additional Features

    public function group($prefix, callable $callback, ?string $groupName = null)
{
    $oldPrefix = $this->prefix;
    $oldMiddlewares = $this->middlewares;
    $oldName = $this->name;

    $this->prefix = $oldPrefix . '/' . trim($prefix, '/');
    $this->middlewares = [];

    // Store the current group name in the router instance
    $this->name = $groupName !== null ? $groupName : '';

    call_user_func($callback, $this);

    $this->prefix = $oldPrefix;
    $this->middlewares = $oldMiddlewares;

    // Reset the name property to an empty string after the group is executed
    $this->name = $oldName !== null ? $oldName : '';
}



    public function middleware(\gaf\phpmvc\middlewares\AuthMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
        return $this;
    }

    public function getFullRoute($path)
    {
        return rtrim($this->prefix, '/') . '/' . ltrim($path, '/');
    }

    public function url(string $name, array $params = [])
    {
        $route = $this->findRouteByName($name);
        if ($route) {
            $path = $route['path'];
            foreach ($params as $key => $value) {
                $path = str_replace("($key)", $value, $path);
            }
            return $this->getFullRoute($path);
        }
        return '';
    }

    public function name(string $name)
    {
        $this->name = $name;
        return $this->name;
    }

    private function findRouteByName(string $name)
    {
        foreach ($this->routes as $method => $routes) {
            foreach ($routes as $path => $callback) {
                if (isset($callback['name']) && $callback['name'] === $name) {
                    return ['method' => $method, 'path' => $path];
                }
            }
        }
        return null;
    }

    // Helper methods to define routes with dynamic segments and named routes

    public function any($path, $callback)
    {
        $this->addRoute('any', $path, $callback);
    }

    public function getWithParams($path, $callback)
    {
        $this->addRoute('getWithParams', $path, $callback);
    }

    public function postWithParams($path, $callback)
    {
        $this->addRoute('postWithParams', $path, $callback);
    }

    private function addRoute($method, $path, $callback)
    {
        $this->routes[$method][$path] = $callback;
    }

    // Helper method to handle URL redirections
    public function redirect(string $url)
    {
        $this->response->redirect($url);
    }

    // Helper method to handle 404 Not Found errors
    public function fallback(callable $callback)
    {
        $this->routes['fallback'] = $callback;
    }
}

