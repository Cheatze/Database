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
        //$items = [];
        $items = $this->bookRepository->getAll();
        $items += $this->magazineRepository->getAllMagazines();
        $items += $this->boardgameRepository->getAllBoardgames();
        return $items;
    }



}