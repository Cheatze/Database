<?php
namespace Cheatze\Library;

/**
 * BookRepository
 * Contains the book array and deals with it.
 * Adds, gets all, filters by id, returns by id, removes by id, checks for id 
 */
class BookRepository
{

    private QueryBuilder $queryBuilder;

    public function __construct()
    {
        $this->queryBuilder = new QueryBuilder(Book::class, 'books');
    }

    /**
     * Add the given book object to the session array
     * @param Book $newBook
     * @return void
     */
    public function add(Book $newBook)
    {
        $keyValuePairs = $newBook->toArray();
        // foreach($_SESSION['authors'] as $author){
        //     if($keyValuePairs[])
        // }
        //self::$queryBuilder->insert($keyValuePairs);
        $this->queryBuilder->insert($keyValuePairs);
        $_SESSION['books'][] = $newBook;
        $_SESSION['id'] += 1;
    }

    /**
     * Returns an array copied from the session array
     * @param none
     * @return array
     */
    public function getAll()
    {
        $books = $this->queryBuilder->select(['*'])->get();
        //$books = $_SESSION['books'];
        return $books;
    }

    /**
     * Filters the books session array by author id and returns filtered array
     * @param int $chosenAuthorId
     * @return array
     */
    public function filterById(int $chosenAuthorId)
    {
        $books = $_SESSION['books'];
        $filteredBooks = array_filter($books, function ($book) use ($chosenAuthorId) {
            return $book->getAuthor()->getId() === $chosenAuthorId;
        });
        return $filteredBooks;
    }

    /**
     * Returns a book with a certain id
     * @param int $id
     * @return array
     */
    public function returnById(int $id)
    {
        $books = $_SESSION['books'];
        foreach ($books as $book) {
            if ($book->getid() == $id) {
                return $book;
            }
        }
    }

    /**
     * Removes a book with a certain id from the session array
     * @param int $id
     * @return void
     */
    public function removeById(int $id)
    {
        $books = $_SESSION['books'];
        foreach ($books as $index => $book) {
            if ($book->getId() === $id) {
                // Remove the object at this index
                unset($_SESSION['books'][$index]);
                break;
            }
        }
    }

    //Unused
    //Checks if a book exists at a certain index and returns bool
    public function checkForId(int $id)
    {
        $books = $_SESSION['books'];
        foreach ($books as $book) {
            if ($book->getId() === $id) {
                return true;
            }
        }
        return false;
    }

}