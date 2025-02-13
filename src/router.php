<?php
namespace Cheatze\Library;
//use Cheatze\Library\BookController
// class Router
// {

//     //Array of all paths
//     private array $routes = [
//         ['get', 'book/:id', [BookController::class, 'show']],
//         ['get', 'index', [BookController::class, 'index']],
//         ['get', '', [MainController::class, 'menu']],
//         ['post', 'book', [BookController::class, 'delete']],
//         ['get', 'author', [BookController::class, 'showAuthors']],
//         ['get', 'author/:id', [BookController::class, 'showByAuthor']],
//         ['get', 'menu', [MainController::class, 'menu']],
//         ['get', 'form', [BookController::class, 'form']],
//         ['post', 'add', [BookController::class, 'add']],
//     ];

//     private array $pathPieces;

//     public function __construct()
//     {
//         if (isset($_SERVER['PATH_INFO'])) {
//             $pathInfo = $_SERVER['PATH_INFO'];
//         } else {
//             $pathInfo = '';
//         }
//         $this->pathPieces = explode('/', substr($pathInfo, 1));
//     }

//     public function processRoute(): void
//     {
//         $method = strtolower($_SERVER['REQUEST_METHOD']);
//         foreach ($this->routes as $route) {
//             [$routeMethod, $routePath, $routeAction] = $route;
//             if ($method === $routeMethod && $this->matchRoute($routePath)) {
//                 if (isset($this->pathPieces[1])) {
//                     $string = $this->pathPieces[1];
//                     preg_match('/\d+$/', $string, $matches);
//                     $numbersAtEnd = $matches[0];
//                     $id = (int) $numbersAtEnd;
//                     $routeAction($id);
//                     return;
//                 }
//                 if ($routeMethod == 'post') {
//                     $routeAction($_POST);
//                     return;
//                 }
//                 $routeAction();
//                 return;
//             }
//         }
//         header('HTTP/1.1 404 Not Found');
//         print '404 Not Found';
//     }

//     private function matchRoute(string $routePath): bool
//     {
//         $routePathParts = explode('/', $routePath);
//         if (count($routePathParts) !== count($this->pathPieces)) {
//             return false;
//         }
//         foreach ($routePathParts as $key => $routePathPart) {
//             if (@$routePathPart[0] === ':') {
//                 continue;
//             }
//             if ($routePathPart !== $this->pathPieces[$key]) {
//                 return false;
//             }
//         }
//         return true;
//     }


// }
class Router
{
    // Array of all paths
    private array $routes = [
        ['get', 'book/:id', 'show'],
        ['get', 'index', 'index'],
        ['get', '', 'menu'],
        ['post', 'book', 'delete'],
        ['get', 'author', 'showAuthors'],
        ['get', 'author/:id', 'showByAuthor'],
        ['get', 'menu', 'menu'],
        ['get', 'form', 'form'],
        ['post', 'add', 'add'],
    ];

    private array $pathPieces;
    private BookController $bookController;
    private MainController $mainController;

    public function __construct()
    {
        $this->bookController = new BookController();
        $this->mainController = new MainController();

        if (isset($_SERVER['PATH_INFO'])) {
            $pathInfo = $_SERVER['PATH_INFO'];
        } else {
            $pathInfo = '';
        }
        $this->pathPieces = explode('/', substr($pathInfo, 1));
    }

    public function processRoute(): void
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        foreach ($this->routes as $route) {
            [$routeMethod, $routePath, $routeAction] = $route;
            if ($method === $routeMethod && $this->matchRoute($routePath)) {
                if (isset($this->pathPieces[1])) {
                    $string = $this->pathPieces[1];
                    preg_match('/\d+$/', $string, $matches);
                    $numbersAtEnd = $matches[0];
                    $id = (int) $numbersAtEnd;

                    // Call the method on the BookController instance
                    $this->bookController->{$routeAction}($id);
                    return;
                }
                if ($routeMethod == 'post') {
                    $this->bookController->{$routeAction}($_POST);
                    return;
                }

                // Call the method on the appropriate controller instance
                if ($routeAction === 'menu') {
                    $this->mainController->menu();
                } else {
                    $this->bookController->{$routeAction}();
                }
                return;
            }
        }
        header('HTTP/1.1 404 Not Found');
        print '404 Not Found';
    }

    private function matchRoute(string $routePath): bool
    {
        $routePathParts = explode('/', $routePath);
        if (count($routePathParts) !== count($this->pathPieces)) {
            return false;
        }
        foreach ($routePathParts as $key => $routePathPart) {
            if (@$routePathPart[0] === ':') {
                continue;
            }
            if ($routePathPart !== $this->pathPieces[$key]) {
                return false;
            }
        }
        return true;
    }
}