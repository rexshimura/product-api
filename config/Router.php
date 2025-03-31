<?php

require_once __DIR__ . '/../controllers/ProductController.php';

class Router {
    private array $routes = [];

    public function __construct() {
        $this->defineRoutes();
    }

    private function defineRoutes() {
        $this->routes = [
            'GET' => [
                '' => [ProductController::class, 'welcome'],
                'Product/{id}' => [ProductController::class, 'GetProductById'],
                'Product' => [ProductController::class, 'GetAllProduct'],
                'Product/LatestPrice' =>[ProductController::class, 'GetLatestPriceOfTheProduct'],
            ],
        ];
    }
    
    public function handleRequest() {
        $requestMethod = $_SERVER['REQUEST_METHOD']; 
        $requestUri = $this->getProcessedUri();
    
        if (!isset($this->routes[$requestMethod])) {
            $this->sendNotFound();
            return;
        }
    
        foreach ($this->routes[$requestMethod] as $route => $handler) {
            $pattern = $this->convertToRegex($route);
    
            if (preg_match($pattern, $requestUri, $matches)) {
                array_shift($matches); // Remove full match
    
                // Only pass request data for POST and PUT methods
                if ($requestMethod === 'POST' || $requestMethod === 'PUT') {
                    $requestData = $this->getRequestData();
                    $this->dispatch($handler, array_merge([$requestData], $matches));
                } else {
                    $this->dispatch($handler, $matches);
                }
                return;
            }
        }
    
        $this->sendNotFound();
    }    

    private function getProcessedUri(): string {
        $requestUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $scriptName = dirname($_SERVER["SCRIPT_NAME"]);
        return trim(str_replace($scriptName, "", $requestUri), "/");
    }

    private function convertToRegex(string $route): string {
        $pattern = preg_replace('/\{(\w+)\}/', '(\\d+)', $route); 
        return '/^' . str_replace('/', '\/', $pattern) . '$/';
    }
    
    private function getRequestData() {
        $data = json_decode(file_get_contents('php://input'), true);
        return is_array($data) ? $data : []; // Ensure it's an array
    }

    private function dispatch(array $handler, array $params) {
        [$controllerClass, $method] = $handler;
        $controller = new $controllerClass();
        call_user_func_array([$controller, $method], $params);
    }

    private function sendNotFound() {
        header("HTTP/1.0 404 Not Found");
        echo json_encode(["message" => "Route not found"]);
    }
}