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
        ['get', 'magazineIndex', 'magazineIndex'],
        ['get', 'magazine/:id', 'showMagazine'],
        ['get', 'magazineForm', 'magazineForm'],
        ['post', 'addMagazine', 'addMagazine'],
        ['post', 'magazine', 'deleteMagazine'],
    ];

    private array $pathPieces;
    private BookController $bookController;
    private MainController $mainController;
    private MagazineController $magazineController;

    public function __construct()
    {
        $this->bookController = new BookController();
        $this->mainController = new MainController();
        $this->magazineController = new MagazineController();

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
                if ($routeAction === "magazineIndex") {
                    $this->magazineController->magazineIndex();
                    return;
                } elseif ($routeAction === "magazineForm") {
                    $this->magazineController->magazineForm();
                    return;
                }

                if (isset($this->pathPieces[1])) {
                    $string = $this->pathPieces[1];
                    preg_match('/\d+$/', $string, $matches);
                    $numbersAtEnd = $matches[0];
                    $id = (int) $numbersAtEnd;

                    if ($routeAction === "showMagazine") {
                        $this->magazineController->showMagazine($id);
                        return;
                    }

                    // Call the method on the BookController instance
                    $this->bookController->{$routeAction}($id);
                    return;
                }
                if ($routeAction === "addMagazine") {
                    $this->magazineController->addMagazine($_POST);
                    return;
                } elseif ($routeAction === "deleteMagazine") {
                    $this->magazineController->deleteMagazine($_POST);
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