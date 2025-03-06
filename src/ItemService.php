<?php
namespace Cheatze\Library;
use \DateTimeImmutable;

class ItemService
{

    public BookRepository $bookRepository;
    public MagazineRepository $magazineRepository;
    public BoardgameRepository $boardgameRepository;

    public function __construct()
    {
        $this->bookRepository = new BookRepository();
        $this->magazineRepository = new MagazineRepository();
        $this->boardgameRepository = new BoardgameRepository();
    }

    public function getAllItems()
    {
        $items = [];
        $books = $this->bookRepository->getAll();
        $magazines = $this->magazineRepository->getAllMagazines();
        $boardgames = $this->boardgameRepository->getAllBoardgames();
        $items = array_merge($items, $books, $magazines, $boardgames);
        return $items;
    }

    public function searchAllItems($data)
    {
        $search = $data['item'];
        $items = [];
        $books = $this->bookRepository->searchBooks($search);
        $magazines = $this->magazineRepository->searchMagazines($search);
        $boardgames = $this->boardgameRepository->searchBoardgames($search);

        $items = array_merge($items, $books, $magazines, $boardgames);
        return $items;

    }

}