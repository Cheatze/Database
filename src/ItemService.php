<?php
namespace Cheatze\Library;
use \DateTimeImmutable;

class ItemService
{

    public BookService $bookService;
    public MagazineService $magazineService;
    public BoardgameService $boardgameService;

    public function __construct()
    {
        $this->bookService = new BookService();
        $this->magazineService = new MagazineService();
        $this->boardgameService = new BoardgameService();
    }

    /**
     * Retuns every item from the three database tables and merges the resulting arrays and returns the merged array
     * @return array
     */
    public function getAllItems()
    {
        $books = $this->bookService->getAll();
        $magazines = $this->magazineService->getAllMagazines();
        $boardgames = $this->boardgameService->getAllBoardgames();
        return array_merge($books, $magazines, $boardgames);
    }

    /**
     * Searches each of the three database tables on the form search term and merges the resulting arrays and retuns that array
     * @param mixed $data
     * @return array
     */
    public function searchAllItems($data)
    {
        $search = $data['item'];
        $items = [];
        $books = $this->bookService->searchBooks($search);
        $magazines = $this->magazineService->searchMagazines($search);
        $boardgames = $this->boardgameService->searchBoardgames($search);

        $items = array_merge($items, $books, $magazines, $boardgames);
        return $items;

    }


}
