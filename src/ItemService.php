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

    public function getAllItems()
    {
        $items = [];
        $books = $this->bookService->getAll();
        $magazines = $this->magazineService->getAllMagazines();
        $boardgames = $this->boardgameService->getAllBoardgames();
        $items = array_merge($items, $books, $magazines, $boardgames);
        return $items;
    }

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

    //Meak how?
    public function returnItem()
    {

    }

}