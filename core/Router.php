<?php

require_once './utils/auth.php';

class Router
{
    private $routes = [];

    public function __construct()
    {
        // Define your routes here as 'path' => [controller, method, auth_required]
        $this->routes = [
            'login' => ['LoginController', 'showLoginForm', false],
            'authenticate' => ['LoginController', 'authenticate', false],
            'inventory' => ['InventoryController', 'showInventory', true],
            'inventory_update' => ['InventoryController', 'updateInventory', true],
            'inventory_delete' => ['InventoryController', 'deleteInventory', true],
            'logout' => [null, 'logout', false],
        ];
    }


    public function route()
    {
        $path = $_GET['path'] ?? 'login';
        session_start();

        if (!array_key_exists($path, $this->routes)) {
            header('Location: 404.php');
            exit();
        }

        [$controllerName, $methodName, $requiresAuth] = $this->routes[$path];

        // Check authentication if required
        if ($requiresAuth) {
            requireAuth();
        }

        if ($controllerName) {
            // Dynamically load the controller and call the method
            require_once "controllers/$controllerName.php";
            $controller = new $controllerName();
            $controller->$methodName();
        } else {
            // Handle special cases like logout
            $this->$methodName();
        }
    }

    private function logout()
    {
        session_unset();
        session_destroy();
        header('Location: ?path=login');
        exit();
    }
}
