<?php
namespace Cheatze\Library;

class BookService
{
    private BookRepository $bookRepository;

    /**
     * Instantiates the querybuilder with the book class and table
     */
    public function __construct()
    {
        $this->bookRepository = new BookRepository();
    }

    /**
     * Returns an array copied from the session array
     * @param none
     * @return array
     */
    public function getAll()
    {
        return $books = $this->bookRepository->getAll();
    }

    /**
     * Searches the books database table on title publisher and author and returns an array of results
     * @param string $search
     * @return array
     */
    public function searchBooks(string $search)
    {
        $books = $this->bookRepository->searchBooks($search);
        return $books;
    }


}