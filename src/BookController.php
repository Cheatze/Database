<?php
namespace Cheatze\Library;
use Cheatze\Library\MainController;
use \DateTimeImmutable;

class BookController
{

    public BookRepository $repository;// = new BookRepository();
    public $main;// = new MainController();

    public function __construct()
    {
        $this->repository = new BookRepository();
        $this->main = new MainController();
    }

    /**
     * Assigns the books session variable array to $books through the repository and includes index.html
     * @return void
     */
    public function index()
    {
        // if (isset($_SESSION['books'])) {
        $books = $this->repository->getAll();
        // } else {
        //     $books = [];
        // }
        include_once 'html/bookindex.html';
    }

    /**
     * Assigns the book with id of $id to $book through the reopository and includes the book.html
     * @param int $id
     * @return void
     */
    public function show(int $id)
    {
        $book = $this->repository->returnById($id);
        include_once 'html/book.html';

    }

    /**
     *Removes the book with post id value from the session through the repository and calls the index method
     * @return void
     */
    public function delete(array $id)
    {

        $id = intval($id['id']);

        $this->repository->removeById($id);
        BookController::index();
    }

    /**
     * Assings the session authors array to $authors and includes the auhtor.html
     * @return void
     */
    public function showAuthors()
    {
        $authors = $_SESSION['authors'];
        include_once 'html/bookauthor.html';
    }

    /**
     * Assigns an array filtered by the id of the author through the reposotory to $books and includes the listByAuthor.html
     * @param mixed $id
     * @return void
     */
    public function showByAuthor($id)
    {
        $books = $this->repository->filterById($id);
        include_once 'html/listByAuthor.html';
    }

    /**
     * Includes the form for adding books
     * @return void
     */
    public function form()
    {
        include_once 'html/bookform.html';
    }

    /**
     * Assigns all the POST values to variables using the name of the author to get the right author object from the author session array.
     * Creates a new Book object and adds it to the books session variable through the repository.
     * Calls the index method to return to the list of all books
     * @return void
     */
    public function add($data)
    {
        //Change stuff here
        // Retrieve form data
        $bookTitle = $data['title'];
        foreach ($_SESSION['authors'] as $auth) {
            if ($auth->getId() == $data['author']) {
                $author = $auth;
                break;
            }
        }
        $isbn = $data['isbn'];
        $publisher = $data['publisher'];
        $publicationDate = new DateTimeImmutable($data['publicationDate']);
        //$publicationDate = DateTime::createFromFormat('Y-m-d', $data['publishedAt']);
        $pageCount = $data['pageCount'];
        $id = $_SESSION['id'];

        // Create a new Book object
        $newBook = new Book($bookTitle, $author, $isbn, $publisher, $publicationDate, $pageCount, $id);

        $this->repository->add($newBook);

        $this->index();
    }
}