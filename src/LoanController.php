<?php
namespace Cheatze\Library;

class LoanController
{

    public BookRepository $bookRepository;
    public MagazineRepository $magazineRepository;
    public BorrowService $borrowService;

    public function __construct()
    {
        $this->borrowService = new BorrowService();
        $this->bookRepository = new BookRepository();
        $this->magazineRepository = new MagazineRepository();
    }

    /**
     * Retrieves a book or magazine object on basis of post form data and calls the borrowItem method on that object.
     * Then includes the menu html
     * @param mixed $data
     * @return void
     */
    public function borrowItem($data)
    {
        $id = $data['id'];
        $id = intval($id);
        $type = $data['type'];
        $type = basename($type);

        //echo "Type" . $type;

        if ($type == "Book") {
            $borrowItem = $this->bookRepository->returnById($id);
        } elseif ($type == "Magazine") {
            $borrowItem = $this->magazineRepository->returnMagazineById($id);
        }
        $borrowItem->borrowItem();
        include_once "html/menu.html";
    }

    /**
     * Retrieves a book or magazine object on basis of post form data and calls the returnItem method on that object
     * Then includes and returns view to the menu
     * @param mixed $data
     * @return void
     */
    public function returnItem($data)
    {
        $id = $data['id'];
        $type = $data['type'];
        $type = basename($type);
        if ($type == "Book") {
            $borrowItem = $this->bookRepository->returnById($id);
        } elseif ($type == "Magazine") {
            $borrowItem = $this->magazineRepository->returnMagazineById($id);
        }
        $borrowItem->returnItem();
        include_once "html/menu.html";

    }


}