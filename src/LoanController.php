<?php
namespace Cheatze\Library;

class LoanController
{

    public BookRepository $bookRepository;
    public MagazineRepository $magazineRepository;

    public function __construct()
    {
        $this->bookRepository = new BookRepository();
        $this->magazineRepository = new MagazineRepository();
    }

    //Put duplicated code of the other two methods here here and return the borrowItem;
    public function getBorrowItem($data): array|Book|Magazine|null
    {
        $id = $data['id'];
        $id = intval($id);
        $type = $data['type'];
        $type = basename($type);

        if ($type == "Book") {
            $borrowItem = $this->bookRepository->returnById($id);
        } elseif ($type == "Magazine") {
            $borrowItem = $this->magazineRepository->returnMagazineById($id);
        }
        return $borrowItem;
    }

    /**
     * Retrieves a book or magazine object on basis of post form data and calls the borrowItem method on that object.
     * Then includes the menu html
     * @param mixed $data
     * @return void
     */
    public function borrowItem($data): void
    {
        $borrowItem = $this->getBorrowItem($data);
        $borrowItem->borrowItem();
        include_once "html/menu.html";
    }

    /**
     * Retrieves a book or magazine object on basis of post form data and calls the returnItem method on that object
     * Then includes and returns view to the menu
     * @param mixed $data
     * @return void
     */
    public function returnItem($data): void
    {
        $borrowItem = $this->getBorrowItem($data);
        $borrowItem->returnItem();
        include_once "html/menu.html";
    }


}
