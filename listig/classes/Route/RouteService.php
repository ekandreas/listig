<?php
namespace EkAndreas\Listig\Route;

class RouteService
{
    protected $routes = [];

    public function __construct(array $routeClasses)
    {
        foreach ($routeClasses as $route) {
            $this->register($route);
        }
        $this->boot();
    }

    private function register($route)
    {
        $interfaces = class_implements($route);
        if (!in_array(__NAMESPACE__ . '\RouteInterface', $interfaces)) {
            throw new \Exception("{$route} does not implement RouteInterface");
        }
        $this->routes[] = $route;
    }

    private function boot()
    {
        $routes = $this->routes;
        add_action('rest_api_init', function () use ($routes) {
            foreach ($routes as $route) {
                $route::routes();
            }
        });
    }
}
