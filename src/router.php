<?php
namespace Cheatze\Library;
use Cheatze\Library\AuthenticationController;

class Router
{
    // Array of all paths
    private array $routes = [
        ['get', 'book/:id', 'bookController', 'show'],
        ['get', 'index', 'bookController', 'index'],
        ['get', '', 'mainController', 'menu'],
        ['post', 'book', 'bookController', 'delete'],
        ['get', 'author', 'bookController', 'showAuthors'],
        ['get', 'author/:id', 'bookController', 'showByAuthor'],
        ['get', 'menu', 'mainController', 'menu'],
        ['get', 'form', 'bookController', 'form'],
        ['post', 'add', 'bookController', 'add'],
        ['get', 'magazineIndex', 'magazineController', 'magazineIndex'],
        ['get', 'magazine/:id', 'magazineController', 'showMagazine'],
        ['get', 'magazineForm', 'magazineController', 'magazineForm'],
        ['post', 'addMagazine', 'magazineController', 'addMagazine'],
        ['post', 'magazine', 'magazineController', 'deleteMagazine'],
        ['get', 'boardgameIndex', 'boardgameController', 'boardgameIndex'],
        ['get', 'boardgame/:id', 'boardgameController', 'showBoardgame'],
        ['get', 'boardgameForm', 'boardgameController', 'boardgameForm'],
        ['post', 'addBoardgame', 'boardgameController', 'addBoardgame'],
        ['post', 'boardgame', 'boardgameController', 'deleteBoardgame'],
        ['get', 'itemindex', 'itemController', 'showAllItems'],
        ['get', 'itemsearch', 'itemController', 'itemSearchForm'],
        ['post', 'search', 'itemController', 'itemSearch'],
        ['get', 'registrationPage', 'showRegistration'],
        ['get', 'loginPage', 'authenticationController', 'showLogin'],
        ['post', 'register', 'authenticationController', 'register'],
        ['post', 'login', 'authenticationController', 'login'],
        ['get', 'logout', 'authenticationController', 'logout'],
        ['post', 'borrow', 'loanController', 'borrowItem'],
        ['post', 'return', 'loanController', 'returnItem'],
    ];

    private array $pathPieces;
    private BookController $bookController;
    private MainController $mainController;
    private MagazineController $magazineController;
    private BoardgameController $boardgameController;
    private ItemController $itemController;
    private AuthenticationController $authenticationController;
    private LoanController $loanController;

    public function __construct()
    {
        $this->bookController = new BookController();
        $this->mainController = new MainController();
        $this->magazineController = new MagazineController();
        $this->boardgameController = new BoardgameController();
        $this->itemController = new ItemController();
        $this->authenticationController = new AuthenticationController();
        $this->loanController = new LoanController();

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
            [$routeMethod, $routePath, $class, $routeAction] = $route;
            if ($method === $routeMethod && $this->matchRoute($routePath)) {

                if (isset($this->pathPieces[1])) {
                    $string = $this->pathPieces[1];
                    preg_match('/\d+$/', $string, $matches);
                    $numbersAtEnd = $matches[0];
                    $id = (int) $numbersAtEnd;

                    $this->$class->$routeAction($id);
                    return;
                }
                if ($routeMethod == 'post') {
                    $this->$class->$routeAction($_POST);
                    return;
                }
                $this->$class->$routeAction();
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
