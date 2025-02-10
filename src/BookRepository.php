<?php
namespace Cheatze\Library;

/**
 * BookRepository
 * Contains the book array and deals with it.
 * Adds, gets all, filters by id, returns by id, removes by id, checks for id 
 */
class BookRepository
{

    /**
     * Add the given book object to the session array
     * @param Book $newBook
     * @return void
     */
    public static function add(Book $newBook)
    {
        $_SESSION['books'][] = $newBook;
        $_SESSION['id'] += 1;
    }

    /**
     * Returns an array copied from the session array
     * @param none
     * @return array
     */
    public static function getAll()
    {
        $books = $_SESSION['books'];
        return $books;
    }

    /**
     * Filters the books session array by author id and returns filtered array
     * @param int $chosenAuthorId
     * @return array
     */
    public static function filterById(int $chosenAuthorId)
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
    public static function returnById(int $id)
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
    public static function removeById(int $id)
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
    public static function checkForId(int $id)
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