<?php
namespace Cheatze\Library;

class BookService
{
    private QueryBuilder $queryBuilder;

    /**
     * Instantiates the querybuilder with the book class and table
     */
    public function __construct()
    {
        $this->queryBuilder = new QueryBuilder(Book::class, 'books');
    }

    /**
     * Returns an array copied from the session array
     * @param none
     * @return array
     */
    public function getAll()
    {
        return $books = $this->queryBuilder->select(['*'])->get();
    }

    /**
     * Filters the books array by author id and returns filtered array
     * @param int $chosenAuthorId
     * @return array
     */
    public function filterById(int $chosenAuthorId)
    {
        $books = $this->queryBuilder->select(['*'])->get();
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
        $book = $this->queryBuilder->select(['*'])->where(['Id' => $id])->get();

        return $book[0];

    }

    /**
     * Searches the books database table on title publisher and author and returns an array of results
     * @param string $search
     * @return array
     */
    public function searchBooks(string $search)
    {
        $books = [];
        $titles = $this->queryBuilder->select(['*'])->where(['Title' => $search])->get();
        $publishers = $this->queryBuilder->select(['*'])->where(['Publisher' => $search])->get();
        $authors = $this->queryBuilder->select(['*'])->where(['Author' => $search])->get();
        $books = array_merge($books, $titles, $publishers, $authors);
        return $books;
    }


}